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

class SocialLoginModel extends ObjectModel
{
    /**
     * @var string $id_customer
     */
    public $id_customer;

    /**
     * @var string $user_code from network
     */
    public $user_code;

    /**
     * @var string $name of network
     */
    public $name;

    /**
     * @var string $id_shop
     */
    public $id_shop;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'social_login_customer',
        'primary' => 'id_customer',
        'fields' => array(
            'user_code' => array(
                'type' => self::TYPE_STRING,
                'lang' => true,
                'validate' => 'isCleanHtml',
                'required' => true,
                'size' => 255
            ),
            'name' => array(
                'type' => self::TYPE_STRING,
                'lang' => true,
                'validate' => 'isCleanHtml',
                'required' => true,
                'size' => 255
            ),
            'id_shop' => array(
                'type' => self::TYPE_INT,
                'validate' => 'isUnsignedInt',
                'required' => false
            )
        ),
    );

    /**
     *
     * @return bool
     */
    public function addCustomerLog()
    {
        if (is_null($this->id_customer) || is_null($this->user_code) || is_null($this->name)) {
            return;
        }

        $context = Context::getContext();
        $id_shop = $context->shop->id;

        // $res = parent::add($autodate, $null_values);
        $res = Db::getInstance()->insert(
            'social_login_customer',
            array(
                'id_customer' => (int)$this->id_customer,
                'user_code' => pSQL($this->user_code),
                'name' => pSQL($this->name),
                'id_shop' => (int)$id_shop,
            ),
            false,
            true,
            Db::INSERT_IGNORE
        );

        return $res;
    }

    /**
     *
     * @return bool
     */
    public function updateCustomerLog()
    {
        if (is_null($this->id_customer) || is_null($this->user_code) || is_null($this->name)) {
            return;
        }

        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $res = Db::getInstance()->update(
            'social_login_customer',
            array(
                'id_customer' => (int)$this->id_customer,
                'user_code' => pSQL($this->user_code),
                'name' => pSQL($this->name),
                'id_shop' => (int)$id_shop,
            ),
            '`id_customer`='.(int)$this->id_customer.'
                AND `id_shop`='.(int)$id_shop.'
            AND `name`=\''.pSQL($this->name).'\'',
            1
        );

        return $res;
    }

    /**
     *
     * @param intval $id_customer
     * @return bool
     */
    public static function getCustomerLog($id_customer = null)
    {
        if (!Validate::isNullOrUnsignedId($id_customer)) {
            return;
        }

        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $res = Db::getInstance()->executeS(
            'SELECT `name`, `user_code`
            FROM `'._DB_PREFIX_.'social_login_customer`
            WHERE `id_customer`='.(int)$id_customer.'
            AND `id_shop`='.(int)$id_shop
        );

        return $res;
    }

    /**
     *
     * @param strval $user_code
     * @param strval $name network
     * @return bool
     */
    public static function getCustomerByUserCode($user_code = null, $name = null)
    {
        if (is_null($user_code) || is_null($name)) {
            return;
        }

        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $res = Db::getInstance()->getRow(
            'SELECT `id_customer`
            FROM `'._DB_PREFIX_.'social_login_customer`
            WHERE `user_code` = \''.pSQL($user_code).'\'
            AND `name` = \''.pSQL($name).'\'
            AND `id_shop` = '.(int)$id_shop
        );

        return $res['id_customer'];
    }

    /**
     *
     * @param strval $date_from
     * @param strval $date_to
     * @return array $count
     */
    public static function countByNetwork($date_from, $date_to)
    {
        $customers = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
            'SELECT `id_customer`
                FROM `'._DB_PREFIX_.'customer`
            WHERE `date_add` BETWEEN "'.pSQL($date_from).'" AND "'.pSQL($date_to).'"
            '.Shop::addSqlRestriction(Shop::SHARE_ORDER)
        );

        $count = array('total' => count($customers));
        foreach ($customers as $customer) {
            $connections = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
                'SELECT `id_customer`, `name`
                FROM `'._DB_PREFIX_.'social_login_customer`'
            );

            foreach ($connections as $connection) {
                if ($customer['id_customer'] == $connection['id_customer']) {
                    if (array_key_exists($connection['name'], $count)) {
                        $count[$connection['name']] += 1;
                    } else {
                        $count[$connection['name']] = 1;
                    }
                }
            }
        }
        return $count;
    }

    /**
     *
     * @param strval $id_customer
     * @param strval $name network
     * @return bool
     */
    public static function deleteConnection($id_customer, $name)
    {
        if (!Validate::isNullOrUnsignedId($id_customer) || !Validate::isGenericName($name)) {
            return;
        }

        $context = Context::getContext();
        $id_shop = $context->shop->id;

        $res = Db::getInstance()->delete(
            'social_login_customer',
            'id_customer = '.(int)$id_customer.' AND name = \''.pSQL($name).'\' AND id_shop = '.(int)$id_shop
        );

        return $res;
    }

    /**
     *
     * @param strval $id_customer
     * @param strval $name network
     * @return bool
     */
    public static function deleteCustomer($id_customer)
    {
        if (!Validate::isNullOrUnsignedId($id_customer)) {
            return;
        }

        $res = Db::getInstance()->delete(
            'social_login_customer',
            'id_customer = '.(int)$id_customer
        );

        return $res;
    }

    /*
    public static function cleanDataBase()
    {
        $res = Db::getInstance()->execute(
            'DELETE FROM slc
            USING '._DB_PREFIX_.'social_login_customer as slc
            LEFT OUTER JOIN '._DB_PREFIX_.'customer as cus
            ON slc.id_customer = cus.id_customer
            WHERE cus.id_customer IS NULL
            '
        );

        return $res;
    }
    */

    /**
     * Check if database was successfully created
     * @return boolean true if exists
     */
    public static function checkIfTableExists()
    {
        $result = Db::getInstance()->executeS(
            'DESCRIBE `'._DB_PREFIX_.'social_login_customer`;',
            true,
            false
        );
        if (is_array($result)
        && count($result)) {
            return true;
        }

        return false;
    }
}
