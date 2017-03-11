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

class OauthClientClass extends oauth_client_class
{
    /**
    * @return boolean true
    */
    public function disableDebug()
    {
        $this->debug = false;
        return true;
    }

    /**
    * @return boolean true
    */
    public function enableDebug()
    {
        $this->debug = true;
        return true;
    }

    /**
    * @return string error
    */
    public function getError()
    {
        return $this->error;
    }

    /**
    * @return string debug info
    */
    public function getOutputDebug()
    {
        return $this->debug_output;
    }

    /**
     * Initialize the class variables and internal state. It must
     * be called before calling other class functions.
     *
     * Set the server variable before
     * calling this function to let it initialize the class variables to
     * work with the specified server type. Alternatively, you can set
     * other class variables manually to make it work with servers that
     * are not yet built-in supported.
     *
     * @return boolean true is load variables
     */
    public function initialize()
    {
        if (Tools::strlen($this->server) === 0) {
            return true;
        }

        $this->oauth_version =
        $this->dialog_url =
        $this->reauthenticate_dialog_url =
        $this->pin_dialog_url =
        $this->access_token_url =
        $this->request_token_url =
        $this->append_state_to_redirect_uri = '';
        $this->authorization_header = true;
        $this->url_parameters = false;
        $this->token_request_method = 'GET';
        $this->signature_method = 'HMAC-SHA1';
        $this->access_token_authentication = '';
        $this->access_token_parameter = '';
        $this->default_access_token_type = '';
        $this->store_access_token_response = false;
        $this->refresh_token_authentication = '';
        $this->grant_type = 'authorization_code';
        // User
        $this->oauth_user_agent = 'Prestashop_'._PS_VERSION_;
        $this->parameters = array();
        $this->scope = '';
        $this->method = 'GET';
        $query_header = 'client_id={CLIENT_ID}&redirect_uri={REDIRECT_URI}&scope={SCOPE}&state={STATE}';


        switch ($this->server) {
            case 'Facebook':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://www.facebook.com/v2.4/dialog/oauth?'.$query_header;
                $this->reauthenticate_dialog_url = 'https://www.facebook.com/v2.3/dialog/oauth?'.
                'auth_type=reauthenticate'.$query_header;
                $this->access_token_url = 'https://graph.facebook.com/oauth/access_token';
                $query = array('fields' => 'id,first_name,last_name,email,gender');
                // User
                $this->url_credentials = 'https://graph.facebook.com/v2.4/me?'.http_build_query($query);
                $this->scope = 'public_profile,email';
                break;

            case 'Google':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://accounts.google.com/o/oauth2/auth?response_type=code&'.$query_header;
                $this->offline_dialog_url = 'https://accounts.google.com/o/oauth2/auth?'.$query_header.
                '&response_type=code&access_type=offline&approval_prompt=force';
                $this->access_token_url = 'https://accounts.google.com/o/oauth2/token';
                // User
                $google_query = array('fields' => 'birthday,emails,gender,id,name(familyName,givenName)');
                $this->url_credentials = 'https://www.googleapis.com/plus/v1/people/me?';
                $this->url_credentials .= http_build_query($google_query);
                $this->scope = 'profile email';
                break;

            case 'Github':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://github.com/login/oauth/authorize?response_type=code&'.$query_header;
                $this->access_token_url = 'https://github.com/login/oauth/access_token';
                // User
                $this->url_credentials = 'https://api.github.com/user';
                $this->scope = 'user';
                break;

            case 'Instagram':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://api.instagram.com/oauth/authorize/?response_type=code&'.$query_header;
                $this->access_token_url = 'https://api.instagram.com/oauth/access_token';
                // User
                $this->url_credentials = 'https://api.instagram.com/v1/users/self/';
                $this->scope = 'basic';
                break;

            case 'LinkedIn':
                $this->oauth_version = '1.0a';
                $this->request_token_url = 'https://api.linkedin.com/uas/oauth/requestToken?scope={SCOPE}';
                $this->dialog_url = 'https://api.linkedin.com/uas/oauth/authenticate';
                $this->access_token_url = 'https://api.linkedin.com/uas/oauth/accessToken';
                $this->url_parameters = true;
                // User
                $query = ':(id,first-name,last-name,date-of-birth,email-address)';
                $query .= '?format=json';
                $this->url_credentials = 'http://api.linkedin.com/v1/people/~'.$query;
                $this->default_access_token_type = 'Bearer';
                $this->scope = 'r_basicprofile r_emailaddress';
                break;

            case 'Microsoft':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://login.live.com/oauth20_authorize.srf?response_type=code&'.$query_header;
                $this->access_token_url = 'https://login.live.com/oauth20_token.srf';
                // User
                $this->url_credentials = 'https://apis.live.net/v5.0/me';
                $this->scope = 'wl.basic wl.emails wl.birthday';
                break;

            case 'Paypal':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://www.paypal.com/webapps/auth/protocol/openidconnect/v1/authorize?';
                $this->dialog_url .= 'response_type=code&'.$query_header;
                $this->access_token_url = 'https://api.paypal.com/v1/identity/openidconnect/tokenservice';
                $this->access_token_authentication = 'basic';
                // User
                $this->url_credentials = 'https://api.paypal.com/v1/identity/openidconnect/userinfo/?schema=openid';
                $this->scope = 'openid profile email';
                break;

            case 'Pinterest':
                $this->oauth_version = '2.0';
                $this->dialog_url = 'https://api.pinterest.com/oauth/?response_type=code&'.$query_header;
                $this->access_token_url = 'https://api.pinterest.com/v1/oauth/token';
                // User
                $this->url_credentials = 'https://api.pinterest.com/v1/me/';
                $this->scope = 'read_public';
                break;

            case 'Twitter':
                $this->oauth_version = '1.0a';
                $this->request_token_url = 'https://api.twitter.com/oauth/request_token';
                $this->dialog_url = 'https://api.twitter.com/oauth/authenticate';
                $this->access_token_url = 'https://api.twitter.com/oauth/access_token';
                $this->parameters = array('include_email' => true, 'skip_status' => true, 'include_entities' => false);
                // User
                $this->url_credentials = 'https://api.twitter.com/1.1/account/verify_credentials.json?';
                break;

            case 'Yahoo':
                $this->oauth_version = '1.0a';
                $this->request_token_url = 'https://api.login.yahoo.com/oauth/v2/get_request_token';
                $this->dialog_url = 'https://api.login.yahoo.com/oauth/v2/request_auth';
                $this->access_token_url = 'https://api.login.yahoo.com/oauth/v2/get_token';
                $this->authorization_header = false;
                // User
                $this->url_credentials = 'https://query.yahooapis.com/v1/yql';
                $this->parameters = array(
                    'q'=>'SELECT * FROM social.profile WHERE guid=me',
                    'format'=>'json'
                );
                break;

            default:
                return ($this->setError($this->server.' is not yet a supported type of OAuth server.'));
        }

        return true;
    }

    /**
     * Used to generate string with debug messages
     *
     * @var    string  $message
     * @return boolean true
     */
    public function outputDebug($message)
    {
        if ($this->debug) {
            $message = $this->debug_prefix.$message;
            $this->debug_output .= '<p>'.pSQL($message).'</p>';
        }
        return true;
    }
}
