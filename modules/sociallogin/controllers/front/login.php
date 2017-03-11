<?php
/**
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*/

require_once(_PS_MODULE_DIR_.'sociallogin/autoloader.php');

/**
 * @since 1.5.0
 */
class SocialLoginLoginModuleFrontController extends ModuleFrontController
{
    public $ssl = true;
    public $display_column_left = false;
    public $errors = array();
    protected $action;

    /**
     * @see FrontController::initContent()
     */
    public function initContent()
    {
        parent::initContent();
        $this->action = $this->getAction();

        // Save in cookie when this page is called from button action
        if (!($is_referer_saved = $this->context->cookie->__isset('social_login_referer'))) {
            $is_referer_saved = $this->setCookieReferer();
        }

        // Load saved url to redirect after success
        $url_target = $this->getCookieReferer();

        // Load some module vars
        $array_networks = $this->module->array_networks;
        // If is first time that call this page from button
        if ($is_referer_saved && isset($this->action) && in_array($this->action, $array_networks)) {
            // Define key and secret
            // Get configuration of each social network
            $array_config = $this->module->getConfigSocial();
            $client_id = $array_config[$this->action]['key'];
            $client_secret = $array_config[$this->action]['secret'];

            $client = new OauthClientClass();
            $client->client_id = $client_id;
            $client->client_secret = $client_secret;
            $client->server = $this->getServer($this->action);
            if ((bool)Configuration::get($this->module->name.'_DEBUG_MODE')) {
                $client->enableDebug();
            }

            // Validate key and secret
            if (!Validate::isGenericName($client->client_id) || !Validate::isGenericName($client->client_secret)) {
                $this->errors[] = 'Missing client key or secret for this network';
            }

            // Define redirect_uri for callback
            if ($this->action == 'microsoft') {
                $client->redirect_uri = $this->context->link->getModuleLink(
                    'sociallogin',
                    'login',
                    array(),
                    true
                );
            } else {
                $client->redirect_uri = $this->context->link->getModuleLink(
                    'sociallogin',
                    'login',
                    array('p' => $this->action),
                    true
                );
            }

            // Initizalize class oauth with predefined values of server
            if ($success = $client->initialize()) {
                if (($success = $client->process())) {
                    $user = '';
                    if (Tools::strlen($client->authorization_error)) {
                        $client->error = $client->authorization_error;
                        $success = false;
                    } elseif (Tools::strlen($client->access_token)) {
                        $success = $client->callAPI(
                            $client->url_credentials,
                            $client->method,
                            $client->parameters,
                            array('FailOnAccessError' => true),
                            $user
                        );
                    }
                }
                $success = $client->finalize($success);
            }

            if ($client->exit) {
                exit;
            }

            if ($success) {
                $is_customer = false;
                if ($client->debug) {
                    $client->outputDebug(print_r($user, true));
                }
                $data_profile = CustomerClass::decodeUser($user, Tools::ucfirst($this->action));
                if (empty($data_profile['user_code'])) {
                    $this->errors[] = sprintf(
                        $this->module->l('Impossible to get user id for %s network, data received: %s'),
                        Tools::ucfirst($this->action),
                        print_r($user, true)
                    );
                } else {
                    $is_customer = $this->userLog($data_profile);
                }

                if ($is_customer === false) {
                    $this->setCookieUser($data_profile);
                    $url_target = $this->getRegisterUrl($data_profile);
                } elseif ($is_customer === 'error') {
                    $this->errors[] = $this->module->l(
                        'An error ocurred when trying to connect your account to database'
                    );
                }
            } else {
                $this->errors[] = pSQL($client->getError());
            }

        } else {
            $this->erros[] = 'For security reasons this page is not accessible by typing url directly';
        }

        $this->context->cookie->__unset('social_login_action');

        if (isset($client) && $client->debug) {
            if (!$this->sendDebugEmail($client->getOutputDebug())) {
                $this->errors[] = 'An error ocurred when trying to send debug e-mail';
            }
        }

        if (count($this->errors)) {
            return $this->setTemplate('login.tpl');
        }
        // Unset referer cookie variable
        $this->context->cookie->__unset('social_login_referer');
        if ((bool)Configuration::get($this->module->name.'_POPUP')) {
            echo '<script>window.opener.location.href="'.Tools::secureReferrer($url_target).'";</script>';
            echo '<script>window.opener.focus();</script>';
            echo '<script>self.close();</script>';
            exit;
        } else {
            Tools::redirect($url_target);
        }
    }

    public function getAction()
    {
        if (Tools::getIsset('p')) {
            $action = pSQL(Tools::getValue('p'));
        } else {
            $action = 'microsoft';
        }

        return $action;
    }

    public function setAction($action)
    {
        $this->action = $action;
        return true;
    }

    /**
     * Get server name used in Oauth class
     *
     * @param string name
     * @return string ucfirst of name
     */
    protected function getServer($network)
    {
        switch ($network) {
            case 'linkedin':
                $server = 'LinkedIn';
                break;
            default:
                $server = Tools::ucfirst($network);
        }

        return $server;
    }

    /**
     * Send an email with debug output
     *
     * @param string $output debug output
     */
    protected function sendDebugEmail($output)
    {
        if (Validate::isEmail(Configuration::get($this->module->name.'_DEBUG_EMAIL'))) {
            $to = Configuration::get($this->module->name.'_DEBUG_EMAIL');
        } else {
            $to = Configuration::get('PS_SHOP_EMAIL');
        }

        $template_vars = array(
            '{firstname}' => 'SocialLogin',
            '{lastname}' => 'Support',
            '{message}' => $output
        );

        $response = Mail::send(
            (int)$this->context->language->id,
            'newsletter',
            Mail::l('Debug output for Social Login module'),
            $template_vars,
            $to,
            $this->module->displayName
        );

        if ($response) {
            return true;
        }

        return false;
    }

    /**
     * @return string url to redirect after login
     */
    protected function getCookieReferer()
    {
        return $this->context->cookie->__get('social_login_referer');
    }

    /**
     * Save in cookie an url to return after complete process
     *
     * @param $referrer string name of controller
     * @param $url string http_referer server
     * @return bool after save in cookie url to response
     */
    protected function setCookieReferer()
    {
        $network = Tools::getValue('p');

        // php_self or Controller name
        $back = pSQL(Tools::getValue('back'));
        $request_uri = pSQL(Tools::getValue('request_uri'));
        // Prevent access directly
        if (is_null($back) && is_null($request_uri)) {
            Tools::redirect('index.php?controller=authentication');
        }

        $return_url = '';
        if ($back) {
            $return_url = $this->getUrlReferer($back, $network);
        } elseif (Validate::isUrl($request_uri)) {
            $return_url = Tools::getCurrentUrlProtocolPrefix().Tools::getHttpHost().$request_uri;
        }

        if ($return_url && Validate::isUrl($return_url)) {
            $this->context->cookie->__set('social_login_referer', $return_url);
            return true;
        }

        return false;
    }

    /**
     * Get url to return after complete process
     *
     * @param  string $back
     * @param  string $network
     * @return $url is controller exists or false
     */
    protected function getUrlReferer($back, $network)
    {
        switch ($back) {
            case 'module-sociallogin-account':
                $url = $this->context->link->getModuleLink(
                    'sociallogin',
                    'account',
                    array(
                        'conf' => 1,
                        'p' => $network
                    ),
                    true
                );
                break;
            default:
                $url = $this->context->link->getPageLink($back, true);
        }

        return $url;
    }

    /**
     * Create an url to manually create a new customer
     * 
     * @param array $data_profile
     * @return string $url
     */
    protected function getRegisterUrl($data_profile)
    {
        $var = array(
            $this->module->id,
            pSQL($data_profile['first_name']),
            pSQL($data_profile['last_name']),
            pSQL($data_profile['email']),
            (int)$data_profile['gender'],
            pSQL($data_profile['user_code']),
            pSQL($this->action)
        );
        $parameters = implode('|', $var);
        $token = Tools::encrypt($parameters);

        return $this->context->link->getPageLink(
            'authentication',
            true,
            null,
            "create_account=1&module={$this->module->name}&social_token={$token}"
        );
    }

    /**
     * Save cookie variables to continue registration process
     *
     * @param array $data_profile
     * @return boolen true
     */
    protected function setCookieUser($data_profile)
    {
        $this->context->cookie->__set($this->module->name.'first_name', pSQL($data_profile['first_name']));
        $this->context->cookie->__set($this->module->name.'last_name', pSQL($data_profile['last_name']));
        $this->context->cookie->__set($this->module->name.'email', pSQL($data_profile['email']));
        $this->context->cookie->__set($this->module->name.'gender', (int)$data_profile['gender']);
        $this->context->cookie->__set($this->module->name.'user_code', pSQL($data_profile['user_code']));
        $this->context->cookie->__set($this->module->name.'action', $this->action);

        return true;
    }


    /**
    * @param array $data_profile = array(
    *    'first_name' => $first_name,
    *    'last_name' => $last_name,
    *    'email' => $email,
    *    'gender' => $gender,
    *    'user_code' => $id,
    *    'newtwork' => $action,
    * );
    * @return boolen|error true if complete, false to register manually or error
    */
    protected function userLog($data_profile)
    {
        $customer_log = new CustomerClass();
        foreach ($data_profile as $key => $value) {
            $customer_log->$key = $value;
        }

        $response = $customer_log->connectUserToCustomer();
        return $response;
    }
}
