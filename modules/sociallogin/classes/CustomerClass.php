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

if (!defined('_PS_VERSION_')) {
    exit;
}

require_once(_PS_MODULE_DIR_.'sociallogin/autoloader.php');

class CustomerClass
{
    /**
     * @var string $first_name
     */
    public $first_name = '';

    /**
     * @var string $last_name
     */
    public $last_name = '';

    /**
     * @var string $email
     */
    public $email = '';

    /**
     * @var intval $gender
     */
    public $gender = 0;

    /**
     * @var string $user_code
     */
    public $user_code = null;

    /**
     * @var string $name of social network
     */
    public $name = '';

    /**
     * @var intval $id_customer
     */
    public $id_customer = null;

    public function __construct()
    {
        $this->context = Context::getContext();
        $this->module = Module::getInstanceByName('sociallogin');
    }

    /**
     *
     *
     * @return bool|str 'error', 'register', 'logged'
     */
    public function connectUserToCustomer()
    {
        if (!$this->name || !$this->user_code) {
            return false;
        }

        $is_logged = false;

        if (isset($this->context->customer) && $this->context->customer->isLogged()) {
            $customer = $this->context->customer;
            $this->id_customer = (int)$this->context->customer->id;
            $is_logged = true;
        } else {
            // If social account is connected to a customer id
            $this->id_customer = (int)SocialLoginModel::getCustomerByUserCode($this->user_code, $this->name);
            $customer = new Customer($this->id_customer);

            if (!Validate::isLoadedObject($customer)) {
                // Prevent deleted customers in older versions
                if (Validate::isNullOrUnsignedId($this->id_customer)) {
                    SocialLoginModel::deleteConnection($this->id_customer, $this->name);
                }

                // Validate is customer not logged must agree manually your information
                if (Configuration::get($this->module->name.'_MANUALLY')
                || !Validate::isEmail($this->email)
                || !Validate::isName($this->first_name)
                || !Validate::isName($this->last_name)) {
                    return false;
                }

                // If customer exists get id
                $this->id_customer = (int)$customer->customerExists($this->email, true, true);
                // If customer not exists create new user
                if (Validate::isNullOrUnsignedId($this->id_customer) && $this->id_customer == 0) {
                    $this->id_customer = (int)$this->createCustomer();
                }

                // If customer exists load object with email address
                $customer = new Customer($this->id_customer);
            }

            // If customer not logged then log in
            if (!$customer->isLogged()) {
                $is_logged = $this->loginCustomer($customer);
            }
        }

        if (self::registerUserData()
        && $is_logged) {
            return true;
        }

        return 'error';
    }

    /**
     * Save or update user information in database
     *
     * @return bool true if data added to database
     */
    public function registerUserData()
    {
        $model = new SocialLoginModel();
        $model->id_customer = $this->id_customer;
        $model->user_code = $this->user_code;
        $model->name = $this->name;

        return $model->addCustomerLog();
    }

    /**
     * Create a new customer
     *
     * @return intval $authentication->id is customer id
     */
    protected function createCustomer()
    {
        // Hook::exec('actionBeforeSubmitAccount');
        $customer = new Customer();
        $customer->firstname = pSQL($this->first_name);
        $customer->lastname = pSQL($this->last_name);
        $customer->email = pSQL($this->email);
        $customer->id_gender = (int)$this->gender;
        $customer->newsletter = true;
        $customer->optin = true;

        // generate passwd
        $real_passwd = Tools::passwdGen();
        $passwd = Tools::encrypt($real_passwd);
        $customer->passwd = $passwd;

        // Create customer
        $customer->add();

        // Get created user
        $authentication = $customer->getByEmail(trim($this->email), trim($real_passwd));
        if (!Validate::isLoadedObject($authentication)) {
            return false;
        }

        Mail::Send(
            (int)$this->context->cookie->id_lang,
            'account',
            Mail::l('Welcome!'),
            array(
                '{firstname}' => $authentication->firstname,
                '{lastname}' => $authentication->lastname,
                '{email}' => $authentication->email,
                '{passwd}' => $real_passwd
            ),
            $authentication->email,
            $authentication->firstname.' '.$authentication->lastname
        );

        Hook::exec(
            'actionCustomerAccountAdd',
            array(
                '_POST' => array(
                    'passwd' => $real_passwd,
                    'email' => $customer->email,
                    'firstname' => $customer->firstname,
                    'lastname' => $customer->lastname,
                    'id_gender' => $customer->id_gender,
                    'newsletter' => $customer->newsletter
                ),
                'newCustomer' => $customer
            )
        );

        return (int)$authentication->id;
    }

    /**
     * Login customer created or obtained previously
     *
     * @param  class $customer
     * @return bool
     */
    protected function loginCustomer(Customer $customer)
    {
        if (!Validate::isLoadedObject($customer)) {
            return false;
        }

        //$customer->id = $this->id_customer;
        if (!isset($this->context->cookie->id_compare)) {
            $this->context->cookie->id_compare = CompareProduct::getIdCompareByIdCustomer($customer->id);
        }

        $this->context->cookie->id_customer = (int)$customer->id;
        $this->context->cookie->customer_lastname = $customer->lastname;
        $this->context->cookie->customer_firstname = $customer->firstname;
        $this->context->cookie->passwd = $customer->passwd;
        $this->context->cookie->logged = 1;
        $customer->logged = 1;
        $this->context->cookie->email = $customer->email;

        // Add customer to the context
        $this->context->customer = $customer;

        if (Configuration::get('PS_CART_FOLLOWING') && (empty($this->context->cookie->id_cart) ||
        Cart::getNbProducts($this->context->cookie->id_cart) == 0) &&
        $id_cart = (int)Cart::lastNoneOrderedCart($this->context->customer->id)) {
            $this->context->cart = new Cart($id_cart);
        } else {
            $id_carrier = (int)$this->context->cart->id_carrier;
            $this->context->cart->id_carrier = 0;
            $this->context->cart->setDeliveryOption(null);
            $this->context->cart->id_address_delivery = (int)Address::getFirstCustomerAddressId((int)$customer->id);
            $this->context->cart->id_address_invoice = (int)Address::getFirstCustomerAddressId((int)$customer->id);
        }
        $this->context->cart->id_customer = (int)$customer->id;
        $this->context->cart->secure_key = $customer->secure_key;

        if (isset($id_carrier) && $id_carrier && Configuration::get('PS_ORDER_PROCESS_TYPE')) {
            $delivery_option = array($this->context->cart->id_address_delivery => $id_carrier.',');
            $this->context->cart->setDeliveryOption($delivery_option);
        }

        $this->context->cart->save();
        $this->context->cookie->id_cart = (int)$this->context->cart->id;
        $this->context->cookie->write();
        $this->context->cart->autosetProductAddress();

        Hook::exec('actionAuthentication');

        // Login information have changed, so we check if the cart rules still apply
        CartRule::autoRemoveFromCart($this->context);
        CartRule::autoAddToCart($this->context);

        if ($this->context->customer->isLogged()) {
            return true;
        }

        return false;
    }

    /**
     * Received information from API required to be decoded as user information
     *
     * @param  array  $user data from api
     * @param  string $server name
     * @return array  $data_profile
     */
    public static function decodeUser($user, $server)
    {
        if (empty($user) || empty($server)) {
            return;
        }

        $id         = '';
        $first_name = '';
        $last_name  = '';
        $email      = '';

        $gender = 0;
        $birthday = null;

        if (isset($user->data)) {
            $user = $user->data;
        }

        // ID
        if (isset($user->id)
        && $user->id) {
            $id = pSQL($user->id);
        }

        // E-mail
        if (isset($user->email)
        && Validate::isEmail($user->email)) {
            $email = $user->email;
        }

        // First name
        if (isset($user->first_name)
        && Validate::isName($user->first_name)) {
            $first_name = $user->first_name;
        }

        // Last name
        if (isset($user->last_name)
        && Validate::isName($user->last_name)) {
            $last_name = $user->last_name;
        }

        // Gender
        if (isset($user->gender)) {
            if ($user->gender == 'M'
            || $user->gender == 'male') {
                $gender = 1;
            } elseif ($user->gender == 'F'
            || $user->gender == 'female') {
                $gender = 2;
            }
        }

        switch ($server) {
            case 'Facebook':
                break;
            case 'Github':
                if (isset($user->name)
                && Validate::isName($user->name)) {
                    $name = explode(' ', $user->name, 2);
                }
                if (isset($name) && count($name) == 2) {
                    $first_name = $name[0];
                    $last_name = $name[1];
                } elseif (isset($user->name)) {
                    $first_name = $user->name;
                    $last_name = $user->login;
                }
                break;
            case 'Google':
                if (isset($user->name->givenName)) {
                    $first_name = $user->name->givenName;
                }
                if (isset($user->name->familyName)) {
                    $last_name = $user->name->familyName;
                }
                if (isset($user->emails[0]->value)) {
                    $email = $user->emails[0]->value;
                }
                break;
            case 'Instagram':
                if (isset($user->username)
                && Validate::isName($user->username)) {
                    $name = explode(' ', $user->username, 2);
                }
                if (isset($name)
                && count($name) == 2) {
                    $first_name = $name[0];
                    $last_name = $name[1];
                } elseif (isset($name)) {
                    $first_name = $user->username;
                }
                break;
            case 'Linkedin':
                if (isset($user->firstName)) {
                    $first_name = $user->firstName;
                }
                if (isset($user->lastName)) {
                    $last_name = $user->lastName;
                }
                if (isset($user->emailAddress)) {
                    $email = $user->emailAddress;
                }
                break;
            case 'Microsoft':
                if (isset($user->emails->personal)) {
                    $email = $user->emails->personal;
                } elseif (isset($user->emails->preferred)) {
                    $email = $user->emails->preferred;
                } elseif (isset($user->emails->account)) {
                    $email = $user->emails->account;
                } elseif (isset($user->emails->business)) {
                    $email = $user->emails->business;
                }
                break;
            case 'Pinterest':
                break;
            case 'Paypal':
                if (isset($user->user_id)) {
                    $id = $user->user_id;
                }
                if (isset($user->family_name)) {
                    $last_name = $user->family_name;
                }
                if (isset($user->given_name)) {
                    $first_name = $user->given_name;
                }
                if (isset($user->birthday)
                && Validate::isDate($user->birthday)) {
                    $birthday = $user->birthday;
                }
                break;
            case 'Twitter':
                if (isset($user->name)
                && Validate::isName($user->name)) {
                    $name = explode(' ', $user->name, 2);
                }
                if (isset($name)
                && count($name) == 2) {
                    $first_name = $name[0];
                    $last_name = $name[1];
                } elseif (isset($name)) {
                    $first_name = $user->name;
                }
                break;
            case 'Yahoo':
                if (isset($user->query->count)
                && $user->query->count
                && isset($user->query->resultas->profile)) {
                    $user = $user->query->results->profile;
                    if (isset($user->guid)) {
                        $id = $user->guid;
                    }
                    if (isset($user->givenName)) {
                        $first_name = $user->givenName;
                    }
                    if (isset($user->familyName)) {
                        $last_name = $user->familyName;
                    }
                    if (is_array($user->emails)) {
                        $email = $user->emails[0]->handle;
                    }
                }
                break;
            default:
                return;
        }

        return array(
            'first_name' => Tools::ucwords(pSQL($first_name)),
            'last_name'  => Tools::ucwords(pSQL($last_name)),
            'email'      => pSQL(trim($email)),
            'gender'     => (int)$gender,
            'birthday'   => $birthday,
            'user_code'  => pSQL($id),
            'name'       => pSQL(Tools::strtolower($server))
        );
    }
}
