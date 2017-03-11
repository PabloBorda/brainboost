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

if (!defined('_PS_VERSION_') || !defined('_CAN_LOAD_FILES_')) {
    exit;
}

require_once ('autoloader.php');

class SocialLogin extends Module
{
    /**
     * @var string html content
     */
    private $html = '';

    /**
     * @var array networks names
     */
    public $array_networks = array();

    /**
     * @var array errors
     */
    protected $errors = array();

    public function __construct()
    {
        $this->name = 'sociallogin';
        $this->version = '1.0.30';
        $this->tab = 'social_networks';
        $this->author = 'Jorge Vargas';
        $this->bootstrap = true;
        $this->controllers = array('login', 'account');
        $this->module_key = 'ea12024d6ddc25c14ddb2e6e33d8249f';
        $this->push_filename = _PS_CACHE_DIR_.'push/social';

        parent::__construct();

        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Social Login');
        $this->description = $this->l(
            'Add Facebook, Google, LinkedIn, Microsoft, Paypal, Twitter, Yahoo social Connects'
        );
        $this->confirmUninstall = $this->l(
            'Are you sure you want to remove it? Be careful, all your configuration and your data will be lost'
        );

        if (!$this->checkIfTableExists()) {
            $this->warning = sprintf(
                $this->l('Database %s was not found, please try to reinstall module or contact support.'),
                _DB_PREFIX_.'social_login_customer'
            );
        }

        $this->array_networks = array(
            'facebook',
            'github',
            'google',
            'instagram',
            'linkedin',
            'microsoft',
            'paypal',
            'pinterest',
            'twitter',
            'yahoo'
        );
    }

    protected function checkIfTableExists()
    {
        return SocialLoginModel::checkIfTableExists();
    }

    public function install()
    {
        if (!function_exists('curl_init')) {
            $this->errors[] = ($this->l('Social Login needs the PHP Curl extension,
        please ask your hosting provider to enable it prior to install this module.'));
        }

        foreach ($this->array_networks as $value) {
            Configuration::updateValue($this->name.Tools::strtoupper($value).'_ACTIVE', 0);
        }

        Configuration::updateValue($this->name.'_BUTTON', 0);
        Configuration::updateValue($this->name.'_SIZE', 'st');
        Configuration::updateValue($this->name.'_POPUP', 1);
        Configuration::updateValue($this->name.'_SIGN_IN', 0);
        Configuration::updateValue($this->name.'_MANUALLY', 0);
        Configuration::updateValue($this->name.'_POSITIONS', serialize(array('authentication')));
        Configuration::updateValue($this->name.'_DEBUG_MODE', 0);
        Configuration::updateValue($this->name.'_DEBUG_EMAIL', Configuration::get('PS_SHOP_EMAIL'));
        Configuration::updateValue($this->name.'_VISUAL_EFFECTS', 0);
        Configuration::updateValue($this->name.'_BORDER_STYLE', 0);
        Configuration::updateValue($this->name.'_PILL', 0);
        Configuration::updateValue($this->name.'_REPLACE_AUTH', 0);

        include(dirname(__FILE__).'/sql/install.php');

        if (parent::install()
        && $this->registerHook('displayHeader')
        && $this->registerHook('displayCustomerAccount')
        && $this->registerHook('actionCustomerAccountAdd')
        && $this->registerHook('displayCustomerAccountFormTop')
        && $this->registerHook('displayRightColumnProduct')
        && $this->registerHook('displayAdminCustomers')
        && $this->registerHook('displayNav')
        && $this->registerHook('displaySocialLoginButtons')
        && $this->registerHook('displayOverrideTemplate')
        && $this->registerHook('displayBackOfficeHeader')
        && $this->registerHook('dashboardZoneOne')
        && $this->registerHook('actionObjectCustomerAddAfter')
        && $this->registerHook('dashboardData')
        && $this->registerHook('displayAuthenticateFormBottom')
        && $this->registerHook('displayCreateAccountEmailFormBottom')
        && $this->registerHook('actionObjectCustomerDeleteBefore')
        && $this->checkIfTableExists()) {
            return true;
        }

        return false;
    }

    public function uninstall()
    {
        foreach ($this->array_networks as $value) {
            Configuration::deleteByName($this->name.Tools::strtoupper($value).'_ACTIVE');
        }

        Configuration::deleteByName($this->name.'_BUTTON');
        Configuration::deleteByName($this->name.'_SIZE');
        Configuration::deleteByName($this->name.'_POPUP');
        Configuration::deleteByName($this->name.'_SIGN_IN');
        Configuration::deleteByName($this->name.'_MANUALLY');
        Configuration::deleteByName($this->name.'_POSITIONS');
        Configuration::deleteByName($this->name.'_DEBUG_MODE');
        Configuration::deleteByName($this->name.'_DEBUG_EMAIL');
        Configuration::deleteByName($this->name.'_VISUAL_EFFECTS');
        Configuration::deleteByName($this->name.'_BORDER_STYLE');
        Configuration::deleteByName($this->name.'_PILL');
        Configuration::deleteByName($this->name.'_REPLACE_AUTH');

        include(dirname(__FILE__).'/sql/uninstall.php');

        return parent::uninstall();
    }

    public function hookDisplayBackOfficeHeader()
    {
        if (Tools::getValue('controller') == 'AdminModules'
        && Tools::getValue('configure') == $this->name) {
            $this->context->controller->addCSS($this->getLocalPath().'views/css/admin.css', 'all');
            $this->context->controller->addJS('https://use.fontawesome.com/5b43f1fbfd.js');
        }
    }

    public function getContent()
    {
        $tab_array = array_merge(array('home'), $this->array_networks);
        $this->prepareCache();
        $this->context->smarty->assign(array(
            'link'          => $this->context->link,
            'shop'          => $this->context->shop,
            'shop_protocol' => Tools::getShopProtocol(),
            'module_path'   => $this->_path
        ));
        $tab_active = 'home';
        foreach ($tab_array as $item) {
            if (Tools::isSubmit('submit'.$item)) {
                $tab_active = $item;
            }
        }
        unset($item);
        $this->context->smarty->assign(array(
            'tab_active' => $tab_active
        ));

        // Tab header
        $this->html .= $this->display(__FILE__, 'views/templates/admin/admin_tabs.tpl');
        // End Tab header
        $this->html .= '<div class="clearfix"><div class="col-xs-10 tab-content">';
        foreach ($tab_array as $name) {
            // Tab content
            $this->html .= '<div id="'.$name.'" class="tab-pane '.($name == $tab_active ? 'active' : '').'">';
            if (Tools::isSubmit('submit'.$name)) {
                $this->context->smarty->assign(array(
                    'tab_active' => $name,
                ));

                $this->postValidation($name);
                if (!count($this->errors)) {
                    $this->postProcess($name);
                } else {
                    foreach ($this->errors as $err) {
                        $this->html .= $this->displayError($err);
                    }
                }
            }

            $this->html .= $this->renderForm($name);
            $this->html .= '</div>';
            // End tab content
        }

        $this->html .= '</div></div>';

        $this->html .= $this->display(__FILE__, 'views/templates/admin/footer.tpl');

        return $this->html;
    }

    private function postValidation($name)
    {
        if (!in_array($name, $this->array_networks)) {
            return;
        }

        if (Tools::isSubmit('submit'.$name)) {
            $value = array(
                'name' => $name,
                'active' => Tools::getValue(Tools::strtoupper($name).'_ACTIVE'),
                'key' => Tools::getValue(Tools::strtoupper($name).'_KEY'),
                'secret' => Tools::getValue(Tools::strtoupper($name).'_SECRET'),
            );
            if ($value['active'] && empty($value['key'])) {
                $this->errors[] = $value['name'].' '.$this->l('is active but App Key is empty');
            }

            if ($value['active'] && empty($value['secret'])) {
                $this->errors[] = $value['name'].' '.$this->l('is active but App Secret is empty');
            }
        }
    }

    private function postProcess($name)
    {
        if (Tools::isSubmit('submit'.$name) && 'submit'.$name == 'submithome') {
            $border_style = (int)Tools::getValue(Tools::strtoupper($name).'_BORDER_STYLE');
            Configuration::updateValue($this->name.'_BORDER_STYLE', $border_style);

            $button = (int)Tools::getValue(Tools::strtoupper($name).'_BUTTON');
            Configuration::updateValue($this->name.'_BUTTON', $button);

            $debug_email = pSQL(Tools::getValue(Tools::strtoupper($name).'_DEBUG_EMAIL'));
            Configuration::updateValue($this->name.'_DEBUG_EMAIL', $debug_email);

            $debug_mode = (int)Tools::getValue(Tools::strtoupper($name).'_DEBUG_MODE');
            Configuration::updateValue($this->name.'_DEBUG_MODE', $debug_mode);

            $manually = (int)Tools::getValue(Tools::strtoupper($name).'_MANUALLY');
            Configuration::updateValue($this->name.'_MANUALLY', $manually);

            $group = (int)Tools::getValue(Tools::strtoupper($name).'_GROUP');
            Configuration::updateValue($this->name.'_GROUP', $group);

            $pill = (int)Tools::getValue(Tools::strtoupper($name).'_PILL');
            Configuration::updateValue($this->name.'_PILL', $pill);

            $popup = (int)Tools::getValue(Tools::strtoupper($name).'_POPUP');
            Configuration::updateValue($this->name.'_POPUP', $popup);

            $positions = serialize(Tools::getValue(Tools::strtoupper($name).'_POSITIONS'));
            Configuration::updateValue($this->name.'_POSITIONS', $positions);

            $replace_auth = (int)Tools::getValue(Tools::strtoupper($name).'_REPLACE_AUTH');
            Configuration::updateValue($this->name.'_REPLACE_AUTH', $replace_auth);

            $sign_in = (int)Tools::getValue(Tools::strtoupper($name).'_SIGN_IN');
            Configuration::updateValue($this->name.'_SIGN_IN', $sign_in);

            $size = pSQL(Tools::getValue(Tools::strtoupper($name).'_SIZE'));
            Configuration::updateValue($this->name.'_SIZE', $size);

            $visual_effects = (int)Tools::getValue(Tools::strtoupper($name).'_VISUAL_EFFECTS');
            Configuration::updateValue($this->name.'_VISUAL_EFFECTS', $visual_effects);

            $this->html .= $this->displayConfirmation($this->l('Settings updated'));
        } elseif (Tools::isSubmit('submit'.$name) && in_array($name, $this->array_networks)) {
            $network = Tools::strtoupper($name);
            $value = array(
                $this->name.$network.'_ACTIVE' => (int)Tools::getValue($network.'_ACTIVE'),
                $this->name.$network.'_KEY' => pSQL(Tools::getValue($network.'_KEY')),
                $this->name.$network.'_SECRET' => pSQL(Tools::getValue($network.'_SECRET')),
            );

            foreach ($value as $key => $value) {
                Configuration::updateValue($key, $value);
            }

            $this->html .= $this->displayConfirmation($this->l('Settings updated'));
        }

        $this->clearCache();
    }

    private function clearCache()
    {
        $this->_clearCache('nav.tpl');
        $this->_clearCache('buttons.tpl');
        $this->_clearCache('product.tpl');
        $this->_clearCache('account.tpl');
        $this->_clearCache('order-opc.tpl');
        $this->_clearCache('authentication.tpl');
        $this->_clearCache('bottom_create.tpl');
        $this->_clearCache('bottom_login.tpl');
    }

    private function renderForm($name)
    {
        if ($name == 'home') {
            $description = null;
            if (file_exists($this->getLocalPath().'views/templates/admin/'.$name.'.tpl')) {
                $description = $this->display(__FILE__, 'views/templates/admin/'.$name.'.tpl');
            }

            $fields_form = array();
            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Home'),
                        'icon' => 'fa fa-home'
                    ),
                    'description' => $description
                )
            );

            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Buttons style'),
                        'icon' => 'fa fa-eye'
                    ),
                    'input' => array(
                        array(
                            'type' => 'radio',
                            'label' => $this->l('Type of button'),
                            'name' => Tools::strtoupper($name).'_BUTTON',
                            'desc' => $this->l('Select between button type icon or show text at right side'),
                            'values' => array(
                                array(
                                    'id' => 'icon',
                                    'value' => 1,
                                    'label' => $this->l('Icon')
                                ),
                                array(
                                    'id' => 'text',
                                    'value' => 0,
                                    'label' => $this->l('Icon with text')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'radio',
                            'label' => $this->l('Visual effects'),
                            'name' => Tools::strtoupper($name).'_VISUAL_EFFECTS',
                            'desc' => $this->l('Select between normal, shadow or border bottom'),
                            'values' => array(
                                array(
                                    'id' => 'normal',
                                    'value' => 0,
                                    'label' => $this->l('Normal')
                                ),
                                array(
                                    'id' => 'shadow-bottom',
                                    'value' => 1,
                                    'label' => $this->l('Shadow bottom')
                                ),
                                array(
                                    'id' => 'border-bottom',
                                    'value' => 2,
                                    'label' => $this->l('Border bottom')
                                ),
                                array(
                                    'id' => 'long-shadow',
                                    'value' => 3,
                                    'label' => $this->l('Long shadow')
                                ),
                            ),
                        ),
                    ),
                )
            );

            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Icon configuration'),
                        'icon' => 'fa fa-eye'
                    ),
                    'input' => array(
                        array(
                            'type' => 'radio',
                            'label' => $this->l('Size of button'),
                            'name' => Tools::strtoupper($name).'_SIZE',
                            'values' => array(
                                array(
                                    'id' => 'sm',
                                    'value' => 'sm',
                                    'label' => $this->l('Small')
                                ),
                                array(
                                    'id' => 'st',
                                    'value' => 'st',
                                    'label' => $this->l('Standard')
                                ),
                                array(
                                    'id' => 'lg',
                                    'value' => 'lg',
                                    'label' => $this->l('Large')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'radio',
                            'label' => $this->l('Border style'),
                            'name' => Tools::strtoupper($name).'_BORDER_STYLE',
                            'values' => array(
                                array(
                                    'id' => 'normal',
                                    'value' => 0,
                                    'label' => $this->l('Normal')
                                ),
                                array(
                                    'id' => 'r-square',
                                    'value' => 1,
                                    'label' => $this->l('Rounded border')
                                ),
                                array(
                                    'id' => 'circle',
                                    'value' => 2,
                                    'label' => $this->l('Circle')
                                ),
                            ),
                        ),
                    ),
                )
            );

            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Icon with text configuration'),
                        'icon' => 'fa fa-eye'
                    ),
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => $this->l('"Sign in with" text'),
                            'name' => Tools::strtoupper($name).'_SIGN_IN',
                            'desc' => $this->l(
                                'If set in "Yes" shows e.g. "Sign in with Facebook", else shows only name'
                            ),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'of',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Pill'),
                            'name' => Tools::strtoupper($name).'_PILL',
                            'desc' => $this->l('If set in "Yes" customer will see a pop-up window, else redirect'),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                    ),
                )
            );

            $groups = Group::getGroups((int)$this->context->language->id);
            foreach ($groups as $key => $value) {
                if ($value['id_group'] == (int)Configuration::get('PS_GUEST_GROUP')
                || $value['id_group'] == (int)Configuration::get('PS_UNIDENTIFIED_GROUP')) {
                    unset($groups[$key]);
                }
            }
            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Register process'),
                        'icon' => 'fa fa-user'
                    ),
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Pop-up window'),
                            'name' => Tools::strtoupper($name).'_POPUP',
                            'desc' => $this->l('If set in "Yes" customer will see a pop-up window, else redirect'),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Register manually'),
                            'name' => Tools::strtoupper($name).'_MANUALLY',
                            'desc' => $this->l('If set "Yes" customer must complete your register manually.'),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'of',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'select',
                            'label' => $this->l('Default group'),
                            'name' => Tools::strtoupper($name).'_GROUP',
                            'desc' => $this->l('Select default group for registered customer.'),
                            'options' => array(
                                'query' => $groups,
                                'id' => 'id_group',
                                'name' => 'name',
                            ),
                        ),
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Replace original registration form'),
                            'name' => Tools::strtoupper($name).'_REPLACE_AUTH',
                            'desc' => $this->l('If set in "Yes", you can use a custom registration form'),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                    ),
                )
            );

            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Positions'),
                        'icon' => 'fa fa-anchor'
                    ),
                    'input' => array(
                        array(
                            'type' => 'select',
                            'multiple' => true,
                            'label' => $this->l('Include in'),
                            'name' => Tools::strtoupper($name).'_POSITIONS[]',
                            'desc' => $this->l('Use "Ctrl" or "Cmd" key to select multiple'),
                            //'size' => 5,
                            'class' => ' fixed-width-xxl',
                            'options' => array(
                                'query' => array(
                                    array(
                                        'id_option' => 'authentication',
                                        'name' => $this->l('Authentication'),
                                    ),
                                    array(
                                        'id_option' => 'next_login',
                                        'name' => $this->l('Header user info'),
                                    ),
                                    array(
                                        'id_option' => 'product',
                                        'name' => $this->l('Product page'),
                                    ),
                                    array(
                                        'id_option' => 'bottom_login',
                                        'name' => $this->l('Authenticate form bottom'),
                                    ),
                                    array(
                                        'id_option' => 'bottom_create',
                                        'name' => $this->l('Create account email form bottom'),
                                    ),
                                ),
                                'id' => 'id_option',
                                'name' => 'name'
                            )
                        ),
                    ),
                )
            );

            $fields_form[] = array(
                    'form' => array(
                    'legend' => array(
                        'title' => $this->l('Debug'),
                        'icon' => 'fa fa-keyboard-o'
                    ),
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => $this->l('Debug mode'),
                            'name' => Tools::strtoupper($name).'_DEBUG_MODE',
                            'desc' => $this->l('Enable to send an e-mail with debug information'),
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => $this->l('Debug e-mail'),
                            'name' => Tools::strtoupper($name).'_DEBUG_EMAIL',
                            'desc' => $this->l('Send to this e-mail debug information.
                                You will can send this data to module technical support team.'),
                        ),
                    ),
                )
            );

            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => $this->l('Update'),
                        'icon' => 'fa fa-floppy-o'
                    ),
                    'submit' => array(
                        'title' => $this->l('Update settings'),
                        'name' => 'submithome'
                    ),
                )
            );

            $helper = $this->helperForm($name);
            $network = Tools::strtoupper($name);
            $helper->tpl_vars = array(
                'fields_value' => array(
                    $network.'_BORDER_STYLE' => Tools::getValue(
                        $network.'_BORDER_STYLE',
                        Configuration::get($this->name.'_BORDER_STYLE')
                    ),
                    $network.'_BUTTON' => Tools::getValue(
                        $network.'_BUTTON',
                        Configuration::get($this->name.'_BUTTON')
                    ),
                    $network.'_DEBUG_MODE' => Tools::getValue(
                        $network.'_DEBUG_MODE',
                        Configuration::get($this->name.'_DEBUG_MODE')
                    ),
                    $network.'_DEBUG_EMAIL' => Tools::getValue(
                        $network.'_DEBUG_EMAIL',
                        Configuration::get($this->name.'_DEBUG_EMAIL')
                    ),
                    $network.'_MANUALLY' => Tools::getValue(
                        $network.'_MANUALLY',
                        Configuration::get($this->name.'_MANUALLY')
                    ),
                    $network.'_GROUP' => Tools::getValue(
                        $network.'_GROUP',
                        Configuration::get($this->name.'_GROUP')
                    ),
                    $network.'_PILL' => Tools::getValue(
                        $network.'_PILL',
                        Configuration::get($this->name.'_PILL')
                    ),
                    $network.'_POPUP' => Tools::getValue(
                        $network.'_POPUP',
                        Configuration::get($this->name.'_POPUP')
                    ),
                    $network.'_POSITIONS[]' => Tools::getValue(
                        $network.'_POSITIONS',
                        Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'))
                    ),
                    $network.'_REPLACE_AUTH' => Tools::getValue(
                        $network.'_REPLACE_AUTH',
                        Configuration::get($this->name.'_REPLACE_AUTH')
                    ),
                    $network.'_SIGN_IN' => Tools::getValue(
                        $network.'_SIGN_IN',
                        Configuration::get($this->name.'_SIGN_IN')
                    ),
                    $network.'_SIZE' => Tools::getValue(
                        $network.'_SIZE',
                        Configuration::get($this->name.'_SIZE')
                    ),
                    $network.'_VISUAL_EFFECTS' => Tools::getValue(
                        $network.'_VISUAL_EFFECTS',
                        Configuration::get($this->name.'_VISUAL_EFFECTS')
                    ),
                ),
                'languages' => $this->context->controller->getLanguages(),
                'id_language' => $this->context->language->id
            );
        } else {
            $description = null;
            if (file_exists($this->getLocalPath().'views/templates/admin/'.$name.'.tpl')) {
                $description = $this->display(__FILE__, 'views/templates/admin/'.$name.'.tpl');
            }

            $fields_form = array();
            $fields_form[] = array(
                'form' => array(
                    'legend' => array(
                        'title' => Tools::ucfirst($name),
                        'icon' => 'fa fa-'.($name == 'microsoft' ? 'windows' : $name)
                    ),
                    'description' => $description,
                    'input' => array(
                        array(
                            'type' => 'switch',
                            'label' => Tools::ucfirst($name).' '.$this->l('is active'),
                            'name' => Tools::strtoupper($name).'_ACTIVE',
                            'values' => array(
                                array(
                                    'id' => 'on',
                                    'value' => 1,
                                    'label' => $this->l('On')
                                ),
                                array(
                                    'id' => 'off',
                                    'value' => 0,
                                    'label' => $this->l('Off')
                                ),
                            ),
                        ),
                        array(
                            'type' => 'text',
                            'label' => Tools::ucfirst($name).' '.$this->l('App key'),
                            'name' => Tools::strtoupper($name).'_KEY',
                        ),
                        array(
                            'type' => 'text',
                            'label' => Tools::ucfirst($name).' '.$this->l('App secret'),
                            'name' => Tools::strtoupper($name).'_SECRET',
                        ),
                    ),
                    'submit' => array(
                        'title' => $this->l('Update settings'),
                    ),
                ),
            );

            $helper = $this->helperForm($name);

            $active_name = Tools::strtoupper($name).'_ACTIVE';
            $active = Configuration::get($this->name.Tools::strtoupper($name).'_ACTIVE');

            $key_name = Tools::strtoupper($name).'_KEY';
            $key = Configuration::get($this->name.Tools::strtoupper($name).'_KEY');

            $secret_name = Tools::strtoupper($name).'_SECRET';
            $secret = Configuration::get($this->name.Tools::strtoupper($name).'_SECRET');

            $helper->tpl_vars = array(
                'fields_value' => array(
                    Tools::strtoupper($name).'_ACTIVE' => Tools::getValue($active_name, $active),
                    Tools::strtoupper($name).'_KEY' => Tools::getValue($key_name, $key),
                    Tools::strtoupper($name).'_SECRET' => Tools::getValue($secret_name, $secret),
                ),
                'languages' => $this->context->controller->getLanguages(),
                'id_language' => $this->context->language->id
            );
        }

        return $helper->generateForm($fields_form);
    }

    private function helperForm($name)
    {
        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true; // false -> remove toolbar
        $helper->toolbar_scroll = true; // yes -> Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$name;
        $helper->toolbar_btn = array(
            'save' => array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        return $helper;
    }

    public function hookDisplayAdminCustomers()
    {
        $id_customer = (int)Tools::getValue('id_customer');
        $customer = new Customer($id_customer);

        if (!Validate::isLoadedObject($customer)) {
            return;
        }

        $customer_log = SocialLoginModel::getCustomerLog((int)$id_customer);

        $customer_network = array();
        foreach ($customer_log as $value) {
            $customer_network[$value['name']] = $value['user_code'];
        }

        $array_customers = array();
        foreach ($this->array_networks as $value) {
            $array_customers[$value] = isset($customer_network[$value]) ? $customer_network[$value] : 0;
        }

        $this->context->smarty->assign(array(
            'customer_log' => $array_customers,
        ));

        return $this->display(__FILE__, 'views/templates/admin/customer.tpl');
    }

    public function hookDisplayRightColumnProduct()
    {
        $id_product = (int)Tools::getValue('id_product');
        $positions = Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'));
        if (!in_array('product', $positions)) {
            return;
        }

        return $this->display(__FILE__, 'product.tpl', $this->getCacheId($id_product));
    }

    public function getCacheId($id_product = null)
    {
        return parent::getCacheId().'|'.pSQL($id_product);
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'views/css/bootstrap-social.css', 'all');
        $this->context->controller->addJS($this->_path.'views/js/action.js');
        $this->context->controller->addCSS(
            'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
            'all'
        );
        $this->prepareCache();
    }

    public function hookActionCustomerAccountAdd($params)
    {
        $new_customer = $params['newCustomer'];
        if (!Validate::isLoadedObject($new_customer)) {
            return false;
        }

        // Update default group
        if (($id_default_group = (int)Configuration::get($this->name.'_GROUP'))) {
            $new_customer->id_default_group = $id_default_group;
            $new_customer->update();
            $new_customer->updateGroup(array($id_default_group));
        }

        $post_vars = $params['_POST'];
        if (isset($post_vars['user_code']) && isset($post_vars['network'])) {
            $model = new SocialLoginModel();
            $model->id_customer = (int)$new_customer->id;
            $model->user_code = pSQL($post_vars['user_code']);
            $model->name = pSQL($post_vars['network']);

            if ($model->addCustomerLog()) {
                Logger::AddLog(sprintf(
                    '[Info] Customer %s connected to newtwork %s with user %s',
                    (int)$new_customer->id,
                    pSQL($post_vars['network']),
                    pSQL($post_vars['user_code'])
                ));
            } else {
                Logger::AddLog(sprintf(
                    '[Error] Customer %s was not connected to newtwork %s with user %s',
                    (int)$new_customer->id,
                    pSQL($post_vars['network']),
                    pSQL($post_vars['user_code'])
                ));
            }
        }

        // Clear cookie variables
        $this->context->cookie->unsetFamily($this->name);
    }

    public function hookDisplayCustomerAccountForm()
    {
        if (Tools::getIsset('social_token')
        && Tools::getIsset('module')
        && Tools::getValue('module') == $this->name) {
            $token_received = Tools::getValue('social_token');

            // Load cookie variables
            $cookie_family = $this->context->cookie->getFamily($this->name);
            if (is_array($cookie_family)
            && count($cookie_family)) {
                foreach ($cookie_family as $key => $value) {
                    $cookie_family[Tools::substr($key, Tools::strlen($this->name))] = $value;
                    unset($cookie_family[$key]);
                }
                $first_name = $last_name = $email = $gender = $user_code = $action = null;
                extract($cookie_family);
                $var = array(
                    $this->id,
                    psQL($first_name),
                    pSQL($last_name),
                    pSQL($email),
                    pSQL($gender),
                    pSQL($user_code),
                    pSQL($action)
                );
                if ($token_received === Tools::encrypt(implode('|', $var))) {
                    $_POST['id_gender'] = (int)$gender;
                    $_POST['customer_firstname'] = $first_name;
                    $_POST['customer_lastname'] = $last_name;
                    $_POST['email'] = $email ? $email : "{$user_code}@{$action}.com";

                    $this->context->smarty->assign(array(
                        'user_code' => $user_code,
                        'network' => $action,
                    ));
                } else {
                    $this->errors[] = $this->l('An error ocurred in social login token validation');
                }
            } else {
                $this->errors[] = $this->l('An error ocurred in social login register process');
            }
        } elseif (Tools::isSubmit('submitAccount')) {
            if (Tools::getIsset('user_code')
            && Tools::getIsset('network')) {
                $this->context->smarty->assign(array(
                    'user_code' => Tools::getValue('user_code'),
                    'network' => Tools::getValue('network'),
                ));
            }
        }

        if (count($this->errors)) {
            $this->context->smarty->assign('errors', array_unique($this->errors));
        }

        return $this->display(__FILE__, 'register.tpl');
    }

    public function hookDisplayCustomerAccountFormTop()
    {
        return $this->hookDisplayCustomerAccountForm();
    }

    public function prepareCache()
    {
        $array_output = array();
        // To specific if at least one network is available
        $one_active_net = false;
        // Back url
        if (Tools::getIsset('back')) {
            $back = Tools::getValue('back');
        } elseif (isset($this->context->controller->page_name)
        && $this->context->controller->page_name == 'module-sociallogin-account') {
            $back = $this->context->controller->page_name;
        } else {
            $back = '';
        }
        $request_uri = $_SERVER['REQUEST_URI'];

        foreach ($this->array_networks as $value) {
            $app_active = Configuration::get($this->name.Tools::strtoupper($value).'_ACTIVE');
            $app_key = Configuration::get($this->name.Tools::strtoupper($value).'_KEY');
            $app_secret = Configuration::get($this->name.Tools::strtoupper($value).'_SECRET');
            $complete_config = false;

            if ($app_active && !empty($app_key) && !empty($app_secret)) {
                $complete_config = true;
                $one_active_net = true;
            }

            switch ($value) {
                case 'google':
                    $icons = array(
                        'icon_class' => 'google-plus',
                        'fa_icon' => 'google-plus'
                    );
                    break;
                case 'microsoft':
                    $icons = array(
                        'icon_class' => 'windows',
                        'fa_icon' => 'windows'
                    );
                    break;
                case 'facebook':
                case 'linkedin':
                case 'paypal':
                case 'twitter':
                case 'yahoo':
                default:
                    $icons = array(
                        'icon_class' => $value,
                        'fa_icon' => $value
                    );
            }

            $array_output[$value] = array(
                'name' => $value,
                'complete_config' => $complete_config,
                'connect' => $this->context->link->getModuleLink(
                    'sociallogin',
                    'login',
                    array(
                        'p' => $value,
                        'back' => pSQL($back),
                        'request_uri' => pSQL($request_uri),
                        'utm_source' => 'button',
                        'utm_medium' => $value,
                        'utm_campaign'=> 'social_login'
                    ),
                    true
                ),
                'icon_class' => $icons['icon_class'],
                'fa_icon' => $icons['fa_icon'],
            );

            // Link to delete button
            if (Validate::isLoadedObject($this->context->customer)
            && isset($this->context->controller->page_name)
            && $this->context->controller->page_name == 'module-sociallogin-account') {
                if ($this->context->customer->isLogged()) {
                    $delete = $this->context->link->getModuleLink(
                        'sociallogin',
                        'account',
                        array(
                            'delete' => 1,
                            'p' => $value,
                            'token_delete' => Tools::getToken($value)
                        ),
                        true
                    );
                    $array_output[$value]['delete'] = $delete;
                }
            }
        }

        if ($one_active_net) {
            $this->context->smarty->assign('show_authentication_block', $one_active_net);
        }

        $this->context->smarty->assign(array(
            'social_networks' => $array_output,
        ));

        switch (Configuration::get($this->name.'_SIZE')) {
            case 'lg':
                $size = '64';
                break;
            case 'st':
                $size = '48';
                break;
            case 'sm':
            default:
                $size = '32';
        }

        switch (Configuration::get($this->name.'_VISUAL_EFFECTS')) {
            case 3:
                $visual_effects = 'long-shadow';
                break;
            case 2:
                $visual_effects = 'border-bottom';
                break;
            case 1:
                $visual_effects = 'shadow-bottom';
                break;
            case 0:
            default:
                $visual_effects = 0;
        }

        switch (Configuration::get($this->name.'_BORDER_STYLE')) {
            case 2:
                $border_style = 'circle';
                break;
            case 1:
                $border_style = 'r-square';
                break;
            case 0:
            default:
                $border_style = 0;
        }

        $button = Configuration::get($this->name.'_BUTTON');
        $pill = Configuration::get($this->name.'_PILL');

        $button_class = '';
        $button_class .= $button ? '' : 'azm-btn';
        if ($button) {
            $button_class .= $border_style ? ' azm-'.$border_style : '';
            $button_class .= ' ';
            $button_class .= $size ? ' azm-size-'.$size : '';
        } else {
            $button_class .= $pill ? ' azm-pill' : '';
        }
        $button_class .= $visual_effects ? ' azm-'.$visual_effects : '';

        $positions = Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'));
        $this->context->smarty->assign(array(
            'border_style' => $border_style,
            'button' => $button,
            'pill' => Configuration::get($this->name.'_PILL'),
            'popup' => Configuration::get($this->name.'_POPUP'),
            'sign_in' => Configuration::get($this->name.'_SIGN_IN'),
            'size' => $size,
            'positions' => $positions,
            'visual_effects' => $visual_effects,
            'button_class' => $button_class,
            'replace_auth' => Configuration::get($this->name.'_REPLACE_AUTH'),
        ));
    }

    public function hookDisplayCustomerAccount()
    {
        return $this->display(__FILE__, 'my-account.tpl');
    }

    /**
     * @return array $array_output configuration of each network
     */
    public function getConfigSocial()
    {
        $array_output = array();
        foreach ($this->array_networks as $value) {
            $array_output[$value] = array(
                'name' => $value,
                'active' => Configuration::get($this->name.Tools::strtoupper($value).'_ACTIVE'),
                'key' => Configuration::get($this->name.Tools::strtoupper($value).'_KEY'),
                'secret' => Configuration::get($this->name.Tools::strtoupper($value).'_SECRET'),
            );
        }

        return $array_output;
    }

    public function hookDisplayOverrideTemplate($params)
    {
        if (!isset($params['controller']->php_self)) {
            return false;
        }

        if ($params['controller']->php_self == 'order-opc') {
            return $this->getTemplatePath('order-opc.tpl');
        } elseif ($params['controller']->php_self == 'authentication') {
            return $this->getTemplatePath('authentication.tpl');
        }

        return false;
    }

    public function hookDisplayAuthenticateFormBottom()
    {
        $positions = Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'));
        if (!in_array('bottom_login', $positions)) {
            return;
        }

        return $this->display(__FILE__, 'bottom_login.tpl', $this->getCacheId(Tools::getValue('back')));
    }

    public function hookDisplayCreateAccountEmailFormBottom()
    {
        $positions = Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'));
        if (!in_array('bottom_create', $positions)) {
            return;
        }

        return $this->display(__FILE__, 'bottom_create.tpl', $this->getCacheId(Tools::getValue('back')));
    }

    public function hookDisplayNav()
    {
        $positions = Tools::unSerialize(Configuration::get($this->name.'_POSITIONS'));
        if (!in_array('next_login', $positions)) {
            return;
        }

        return $this->display(__FILE__, 'nav.tpl', $this->getCacheId());
    }

    public function hookDisplaySocialLoginButtons()
    {
        return $this->display(__FILE__, 'buttons.tpl');
    }

    public function hookDashboardZoneOne()
    {
        $this->context->smarty->assign(
            array(
                'date_subtitle' => $this->l('(from %s to %s)'),
                'date_format' => $this->context->language->date_format_lite,
                'link' => $this->context->link,
                'networks' => $this->array_networks,
            )
        );
        return $this->display(__FILE__, 'dashboard_zone_one.tpl');
    }

    public function hookDashboardData($params)
    {
        if (Tools::strlen($params['date_from']) == 10) {
            $params['date_from'] .= ' 00:00:00';
        }
        if (Tools::strlen($params['date_to']) == 10) {
            $params['date_to'] .= ' 23:59:59';
        }

        $count = SocialLoginModel::countByNetwork(pSQL($params['date_from']), pSQL($params['date_to']));

        $return = array(
            'data_value' => array(
                'social_new_customers' => (int)$count['total'],
            ),
        );
        foreach ($this->array_networks as $item) {
            if (isset($count[$item])) {
                $return['data_value'][$item] = $count[$item];
            } else {
                $return['data_value'][$item] = 0;
            }
        }

        return $return;
    }

    public function hookActionObjectCustomerAddAfter($params)
    {
        return $this->hookActionObjectOrderAddAfter($params);
    }

    public function hookActionObjectOrderAddAfter($params)
    {
        Tools::changeFileMTime($this->push_filename);
    }

    /**
     * Hook action when delete customer
     * @return boolean
     */
    public function hookActionObjectCustomerDeleteBefore($params)
    {
        $customer = $params['object'];
        if (!Validate::isLoadedObject($customer)) {
            return false;
        }

        return SocialLoginModel::deleteCustomer((int)$customer->id);
    }
}
