<?php

/*
 * 2007-2013 PrestaShop 
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 *         DISCLAIMER   *
 * *************************************** */
/* Do not edit or add to this file if you wish to upgrade Prestashop to newer
 * versions in the future.
 * ****************************************************
 * @category   Belvg
 * @package    Belvg_PreOrderProducts
 * @author    Alexander Simonchik <support@belvg.com>
 * @site    
 * @copyright  Copyright (c) 2010 - 2013 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt 
 */

class ProductWait extends ObjectModel {

    public $id_belvg_preorder_wait;
    public $id_customer;
    public $id_shop;
    public $email;
    public $id_product;
    public $id_product_attribute;
    public $id_lang;
    public $fl_mail;
    public $date_upd;
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'belvg_preorder_wait',
        'primary' => 'id_belvg_preorder_wait',
        'multilang' => FALSE,
        'fields' => array(
            'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'id_product_attribute' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'id_lang' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'email' => array('type' => self::TYPE_STRING, 'validate' => 'isEmail', 'required' => TRUE, 'size' => 128),
            'id_customer' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'fl_mail' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
        ),
    );

    public static function checkExistStatic($id_customer, $id_product, $id_product_attribute = NULL) {
        $sql = 'SELECT pw.`id_belvg_preorder_wait` FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` pw
            WHERE pw.`id_customer` = ' . (int) $id_customer . ' AND pw.`id_product` = ' . (int) $id_product . ' AND pw.`id_shop` = ' . (int) Context::getContext()->shop->id . ' ' . ( isset($id_product_attribute) ? ' AND pw.`id_product_attribute` = ' . (int) $id_product_attribute : '' );
        $result = Db::getInstance()->getRow($sql);

        if (isset($result['id_belvg_preorder_wait'])) {
            return $result['id_belvg_preorder_wait'];
        }

        return 0;
    }

    public function addProduct($id_product, $id_product_attribute = NULL) {
        if (Context::getContext()->customer->isLogged()) {
            $result = Db::getInstance()->AutoExecute(
                    _DB_PREFIX_ . 'belvg_preorder_wait', array(
                        'id_customer' => Context::getContext()->customer->id,
                        'id_shop' => Context::getContext()->shop->id,
                        'email' => Context::getContext()->customer->email,
                        'id_lang' => Context::getContext()->cookie->id_lang,
                        'id_product' => (int) $id_product,
                        'id_product_attribute' => (int) $id_product_attribute,
                        'date_add' => date("Y-m-d h:i:s")
                    ), 'INSERT'
            );

            return Db::getInstance()->Insert_ID();
        }

        return FALSE;
    }

    public function delProductById($id) {
        if (Context::getContext()->customer->isLogged()) {
            $this->clearMailingHistory(); //cleaning mail history
            $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait`
                WHERE id_customer = ' . (int) Context::getContext()->customer->id . ' AND id_belvg_preorder_wait = ' . (int) $id . ' AND id_shop = ' . Context::getContext()->shop->id;
            $result = Db::getInstance()->Execute($sql);

            return $result;
        }

        return FALSE;
    }

    public static function getIdByCustomer($id_customer, $id_product, $id_product_attribute) {
        $sql = 'SELECT pw.`id_belvg_preorder_wait` FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` pw
        WHERE pw.`id_customer` = ' . (int) $id_customer . ' AND id_product = ' . (int) $id_product . ' ' . ' AND id_shop = ' . Context::getContext()->shop->id . ' ' . ( isset($id_product_attribute) ? ' AND `id_product_attribute` = ' . (int) $id_product_attribute : '' );
        $result = Db::getInstance()->getRow($sql);

        if (isset($result['id_belvg_preorder_wait'])) {
            return $result['id_belvg_preorder_wait'];
        }

        return 0;
    }

    public static function getProductByIdCustomer($id_customer, $id_lang, $id_product = NULL, $quantity = FALSE) {
        if (!Validate::isUnsignedId($id_customer) OR
                !Validate::isUnsignedId($id_lang)) {
            die(Tools::displayError());
        }
        
        $sql = '
            SELECT wp.`id_belvg_preorder_wait`, wp.`id_product`, pl.`name`, wp.`id_product_attribute`, p.`quantity` as product_quantity, pa.`quantity` as attribute_quantity, pl.link_rewrite, cl.link_rewrite AS category_rewrite, p.active, p.out_of_stock as allow_oosp, p.available_for_order
            FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` wp
            LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON pa.`id_product_attribute`=wp.`id_product_attribute`
            JOIN `' . _DB_PREFIX_ . 'product` p ON p.`id_product` = wp.`id_product`
			' . Shop::addSqlAssociation('product', 'p') . '
            JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON pl.`id_product` = wp.`id_product`
            LEFT JOIN `' . _DB_PREFIX_ . 'category_lang` cl ON cl.`id_category` = p.`id_category_default` AND cl.id_lang=' . (int) $id_lang . '
            WHERE wp.`id_customer` = ' . (int) ($id_customer) . '
            AND wp.`id_shop` = ' . (int) (Context::getContext()->shop->id) . '
            AND cl.`id_shop` = ' . (int) (Context::getContext()->shop->id) . '
            AND pl.`id_shop` = ' . (int) (Context::getContext()->shop->id) . '
            AND pl.`id_lang` = ' . (int) ($id_lang) .
                (empty($id_product) === FALSE ? ' AND wp.`id_product` = ' . (int) ($id_product) : '') .
                ($quantity == TRUE ? ' AND p.`quantity` != 0' : '');
        $products = Db::getInstance()->ExecuteS($sql);

        if (empty($products) === TRUE OR !count($products)) {
            return array();
        }
        
        foreach ($products as &$product) {
            $product['availability'] = StockAvailable::getQuantityAvailableByProduct($product['id_product'], $product['id_product_attribute'], (int)Context::getContext()->shop->id);
        }

        for ($i = 0; $i < count($products); ++$i) {
            if (isset($products[$i]['id_product_attribute']) AND
                    Validate::isUnsignedInt($products[$i]['id_product_attribute'])) {
                $result = Db::getInstance()->ExecuteS('
                SELECT al.`name` AS attribute_name, pa.`quantity` AS "attribute_quantity"
                  FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON (a.`id_attribute` = pac.`id_attribute`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON (ag.`id_attribute_group` = a.`id_attribute_group`)
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON (a.`id_attribute` = al.`id_attribute` AND al.`id_lang` = ' . (int) ($id_lang) . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON (ag.`id_attribute_group` = agl.`id_attribute_group` AND agl.`id_lang` = ' . (int) ($id_lang) . ')
                LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON (pac.`id_product_attribute` = pa.`id_product_attribute`)
                WHERE pac.`id_product_attribute` = ' . (int) ($products[$i]['id_product_attribute']));

                $products[$i]['attributes_small'] = '';
                if ($result) {
                    foreach ($result AS $k => $row) {
                        $products[$i]['attributes_small'] .= $row['attribute_name'] . ', ';
                    }
                }
                
                $products[$i]['attributes_small'] = rtrim($products[$i]['attributes_small'], ', ');
            }
        }

        foreach ($products as &$product) {
            $product['availability'] = StockAvailable::getQuantityAvailableByProduct($product['id_product'], $product['id_product_attribute'], (int)Context::getContext()->shop->id);
        }

        return ($products);
    }

    public static function switchStatus($id_customer, $id_product, $id_product_attribute) {
        $wait_id = self::getIdByCustomer($id_customer, $id_product, $id_product_attribute);

        if ($wait_id) {
            $waitObj = new ProductWait($wait_id);
            $waitObj->delProductById($waitObj->id);
        } else {
            $waitObj = new ProductWait();
            $wait_id = $waitObj->addProduct($id_product, $id_product_attribute);
        }
    }

    public function clearMailingHistory() {
        $sql = 'DELETE FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait_mail`
            WHERE id_belvg_preorder_wait = ' . $this->id;
        $result = Db::getInstance()->Execute($sql);

        return $result;
    }

    public function addMailingHistory($id_belvg_preorder_wait) {
        $result = Db::getInstance()->AutoExecute(
                _DB_PREFIX_ . 'belvg_preorder_wait_mail', array(
                    'id_belvg_preorder_wait' => $id_belvg_preorder_wait,
                    'date_add' => date("Y-m-d h:i:s"),
                    'date_upd' => date("Y-m-d h:i:s")
                ), 'INSERT'
        );
        
        $this->checkFlMail($id_belvg_preorder_wait);

        return Db::getInstance()->Insert_ID();
    }

    public function checkFlMail($id_belvg_preorder_wait) {
        $sql = 'SELECT count(id_belvg_preorder_wait) FROM ' . _DB_PREFIX_ . 'belvg_preorder_wait_mail 
            WHERE id_belvg_preorder_wait = ' . (int)$id_belvg_preorder_wait . '
            GROUP BY id_belvg_preorder_wait';
        $cntr = Db::getInstance()->getValue( $sql );
        
        if ($cntr >= Configuration::get('belvg_pp_msg_max_count')) {
            $pwObj = new ProductWait($id_belvg_preorder_wait);
            $pwObj->fl_mail = 0;
            $pwObj->save();
        }
    }
    
    public function checkTimeAfterLastSend($id_belvg_preorder_wait) {
        $sql = 'SELECT date_add FROM ' . _DB_PREFIX_ . 'belvg_preorder_wait_mail 
            WHERE id_belvg_preorder_wait = ' . (int)$id_belvg_preorder_wait . '
            ORDER BY date_add DESC';
        
        $date_add = Db::getInstance()->getValue( $sql );
        
        $now = new DateTime();
        if ($now->getTimestamp() - strtotime($date_add) < Configuration::get('belvg_pp_msg_delay')) {
            return FALSE;
        }
        
        return TRUE;
    }

    public function sendNotificationEmails() {
        $waitingCollection = new Collection('ProductWait');
        if ($waitingCollection->count()) {
            $data = array();
            $product_list_ids_array = array();
            $ps_shop_name = Configuration::get('PS_SHOP_NAME');
            $ps_shop_email = Configuration::get('PS_SHOP_EMAIL');
            foreach ($waitingCollection->getResults() as $item) {
                $realQty = StockAvailable::getQuantityAvailableByProduct($item->id_product, $item->id_product_attribute, $item->id_shop);
                $productObj = new Product($item->id_product, NULL, $item->id_lang, $item->id_shop);

                //prepare data array
                if ($realQty > 0 && $item->fl_mail && $productObj->active && $this->checkTimeAfterLastSend($item->id)) {
                    $customerObj = new Customer($item->id_customer);
                    $link = Context::getContext()->link;
                    if (!isset($data[$item->id_customer])) {
                        $data[$item->id_customer] = array(
                            '{lastname}' => $customerObj->lastname, 
                            '{firstname}' => $customerObj->firstname, 
                            '{customer_email}' => $customerObj->email, 
                            '{id_lang}' => (int) $item->id_lang, 
                            '{product_list}' => '<a href="' . $link->getProductLink($productObj, NULL, NULL, NULL, NULL, $item->id_shop) . '">' . Product::getProductName($productObj->id, $item->id_product_attribute) . '</a>',
                            //'{product_list_ids_array}' => array($item->id),
                        );
                    } else {
                        $data[$item->id_customer]['{product_list}'] .= ', <a href="' . $link->getProductLink($productObj, NULL, NULL, NULL, NULL, $item->id_shop) . '">' . Product::getProductName($productObj->id, $item->id_product_attribute) . '</a>';
                    }

                    $product_list_ids_array[] = $item->id;
                }
            }

            //Send Mail(s)
            foreach ($data as $data_item) {
                Mail::Send($data_item['{id_lang}'], 'wait', Mail::l('Product from your waiting list has appeared in stock'), $data_item, $data_item['{customer_email}'], $data_item['{firstname}'] . ' ' . $data_item['{lastname}'], strval($ps_shop_email), strval($ps_shop_name), NULL, NULL, dirname(__FILE__) . '/../../../mails/');
            }

            foreach ($product_list_ids_array as $product_id) {
                $this->addMailingHistory($product_id);
            }
        }
    }

}
