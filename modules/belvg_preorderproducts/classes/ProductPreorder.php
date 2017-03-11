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

class ProductPreorder extends ObjectModel {

    /** @var string Name */
    public $id_belvg_preorder_product;

    /** @var integer */
    public $id_product;

    /** @var integer */
    public $id_product_attribute;
    
    public $id_shop;

    /** @var integer */
    public $quantity;
    public $expire_datetime = '2112-03-28 13:40:00';
    /* form values */
    public $date_avaliable = '2112-03-28';
    public $hourcombo = '13';
    public $mincombo = '40';
    public $seccombo = '00';
    public $countdown_active;
    public $active;
    public $date_upd;
    public $date_add;

    /**
     * @see ObjectModel::$definition
     */
    public static $definition = array(
        'table' => 'belvg_preorder_product',
        'primary' => 'id_belvg_preorder_product',
        'multilang' => FALSE,
        'fields' => array(
            'id_product' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'id_product_attribute' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'id_shop' => array('type' => self::TYPE_INT, 'validate' => 'isInt'),
            'quantity' => array('type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => TRUE),
            'expire_datetime' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'countdown_active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'active' => array('type' => self::TYPE_BOOL, 'validate' => 'isBool'),
            'date_add' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
            'date_upd' => array('type' => self::TYPE_DATE, 'validate' => 'isDateFormat'),
        ),
    );

    /* public function __construct($id = NULL, $id_lang = NULL, $id_shop = NULL) {
      parent::__construct($id, $id_lang, $id_shop);
      $this->switchStatus();
      } */

    public function checkExist($id_product, $id_product_attribute = NULL, $qty = FALSE, $active = FALSE) {
        return ProductPreorder::checkExistStatic($id_product, $id_product_attribute, $qty, $active);
    }

    public static function checkExistStatic($id_product, $id_product_attribute = NULL, $qty = FALSE, $active = FALSE) {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'belvg_preorder_product` bpp
			WHERE id_product = ' . (int) $id_product . ' AND bpp.`id_shop` = ' . (int) Context::getContext()->shop->id . ' ' . (isset($id_product_attribute) ? ' AND id_product_attribute = ' . (int) $id_product_attribute : '') . ($active ? ' AND active = 1 ' : '');
        $result = Db::getInstance()->getRow($sql);

        self::switchStatusById($result['id_belvg_preorder_product']);

        if ($qty) {
            $realQty = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute, Context::getContext()->shop->id);
            if ($realQty > 0) {
                return 0;
            } elseif ($realQty + $result['quantity'] > 0) {
                return $result['id_belvg_preorder_product'];
            } else {
                return 0;
            }
        }

        if (isset($result['id_belvg_preorder_product'])) {
            return $result['id_belvg_preorder_product'];
        }

        return 0;
    }

    public static function checkExistWithQtyStatic($id_product, $id_product_attribute = NULL) {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'belvg_preorder_product` bpp
			WHERE id_product = ' . (int) $id_product . ' AND bpp.`id_shop` = ' . (int) Context::getContext()->shop->id . ' ' . (isset($id_product_attribute) ? ' AND id_product_attribute = ' . (int) $id_product_attribute : '');
        //.' AND active = 1';
        $results = Db::getInstance()->ExecuteS($sql);

        foreach ($results as $result) {
            self::switchStatusById($result['id_belvg_preorder_product']);
            
            if (!empty($result) && $result['active'] == 1) {
                $id_product_a = ($id_product_attribute ? $id_product_attribute : $result['id_product_attribute']);
                $realQty = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_a, Context::getContext()->shop->id);
                if ($realQty > 0) {
                    return 0;
                } else {
                    return $realQty + $result['quantity'] - 1;
                }
            }
        }

        return 0;
    }

    public static function getAvailablePreorderQty($id_product, $id_product_attribute = NULL) {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'belvg_preorder_product` bpp
			WHERE id_product = ' . (int) $id_product . ' AND bpp.`id_shop` = ' . (int) Context::getContext()->shop->id . ' ' . (isset($id_product_attribute) ? ' AND id_product_attribute = ' . (int) $id_product_attribute : '');
        //.' AND active = 1';
        $result = Db::getInstance()->getRow($sql);

        if (!empty($result) && $result['active'] == 1) {
            $realQty = StockAvailable::getQuantityAvailableByProduct($id_product, $id_product_attribute, Context::getContext()->shop->id);

            return $realQty + $result['quantity'] - 1;
        }

        return 0;
    }

    public static function checkActiveStatic($id_product, $id_product_attribute = NULL) {
        return self::checkExistStatic($id_product, $id_product_attribute, FALSE, FALSE);
    }

    public static function switchStatusById($id_belvg_preorder_product) {
        if ($id_belvg_preorder_product) {
            $ppObj = new ProductPreorder($id_belvg_preorder_product);
            $ppObj->switchStatus();
        }
    }

    public function switchStatus() {
        $now = new DateTime();
        $now = strtotime($now->format("Y-m-d H:i:s"));
        $end = strtotime($this->expire_datetime);

        if ($this->active && $this->countdown_active && $now > $end) {
            /* $qty = $this->quantity * $reason->sign;
            $product = new Product((int) ($this->id_product)); */
            $id_reason = 1; //Increase
            $reason = new StockMvtReason((int) $id_reason);
            $qty = $this->quantity * $reason->sign;
            $product = new Product((int) ($this->id_product), FALSE, NULL, $this->id_shop);

            if (!StockAvailable::updateQuantity($this->id_product, $this->id_product_attribute, $qty, $this->id_shop)) {
                die(Tools::displayError('An error occurred while updating qty.'));
            }

            Hook::exec('updateProduct', array('product' => $product));
            $this->checkOrders();
            $this->active = FALSE;
            $this->update();
            return TRUE;
        }

        return FALSE;
    }

    public function checkOrders() {
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'belvg_preorder_order` po 
			WHERE active = 1';
        $orders = Db::getInstance()->ExecuteS($sql);

        //get orders products
        foreach ($orders as $order) {
            $orderObj = new Order($order['id_order']);
            $order_detail = $orderObj->getProductsDetail();
            $product_count = 0;
            $product_active_count = 0;
            //$pp_array = array();
            foreach ($order_detail as $item) {
                $product_count++;
                $realQty = StockAvailable::getQuantityAvailableByProduct($item['product_id'], $item['product_attribute_id'], $item['id_shop']);
                if ($realQty > 0) {
                    $product_active_count++;
                    /* $pp_array[] = array(
                      'product_id' => $item['product_id'],
                      'product_attribute_id' => $item['product_attribute_id'],
                      'id_shop' => $item['id_shop'],
                      'quantity' => $realQty - $item['product_quantity'],
                      ); */
                }
            }

            if ($product_count && $product_active_count && $product_count == $product_active_count) {
                $objOrder = new Order($order['id_order']);
                $history = new OrderHistory();
                $history->id_order = (int) $objOrder->id;

                if ($objOrder->current_state == Configuration::get('belvg_pp__status_id')) {
                    //Preparation in progress - #3
                    $id_order_state = Db::getInstance()->ExecuteS('
						SELECT `id_order_state`
						FROM `' . _DB_PREFIX_ . 'order_history`
						WHERE `id_order` = ' . (int) ($objOrder->id) . '
						ORDER BY `date_add` DESC, `id_order_history` DESC
						LIMIT 2'
                    );

                    if (!$id_order_state[1]['id_order_state']) {
                        continue;
                    }

                    /* print_r($pp_array); die; 
                      return TRUE; */
                    $history->changeIdOrderState($id_order_state[1]['id_order_state'], $objOrder->id);
                    //Stock Management
                    /* foreach($pp_array as $item){
                      StockAvailable::setQuantity($item['product_id'], $item['product_attribute_id'], $item['quantity'], $item['id_shop']);
                      } */

                    $carrier = new Carrier((int) ($objOrder->id_carrier), (int) ($objOrder->id_lang));
                    $templateVars = array();

                    if ($history->id_order_state == Configuration::get('PS_OS_SHIPPING') AND $objOrder->shipping_number) {
                        $templateVars = array('{followup}' => str_replace('@', $objOrder->shipping_number, $carrier->url));
                    } elseif ($history->id_order_state == Configuration::get('PS_OS_CHEQUE')) {
                        $templateVars = array(
                            '{cheque_name}' => (Configuration::get('CHEQUE_NAME') ? Configuration::get('CHEQUE_NAME') : ''),
                            '{cheque_address_html}' => (Configuration::get('CHEQUE_ADDRESS') ? nl2br(Configuration::get('CHEQUE_ADDRESS')) : ''));
                    } elseif ($history->id_order_state == Configuration::get('PS_OS_BANKWIRE')) {
                        $templateVars = array(
                            '{bankwire_owner}' => (Configuration::get('BANK_WIRE_OWNER') ? Configuration::get('BANK_WIRE_OWNER') : ''),
                            '{bankwire_details}' => (Configuration::get('BANK_WIRE_DETAILS') ? nl2br(Configuration::get('BANK_WIRE_DETAILS')) : ''),
                            '{bankwire_address}' => (Configuration::get('BANK_WIRE_ADDRESS') ? nl2br(Configuration::get('BANK_WIRE_ADDRESS')) : ''));
                    }

                    if ($history->addWithemail(TRUE, $templateVars)) {
                        $result = Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'belvg_preorder_order', array('active' => '0'), 'UPDATE', '`id_preorder_order` = ' . (int) ($order['id_preorder_order']), 1);
                    }
                }
            }
        }

        return TRUE;
    }

    public static function saveOrder($products, $id_order) {
        $result = Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'belvg_preorder_order', array('id_order' => $id_order, 'active' => 1, 'date_add' => date("Y-m-d h:i:s"), 'date_upd' => date("Y-m-d h:i:s")), 'INSERT');
        $id_preorder_order = Db::getInstance()->Insert_ID();
        $preorder_products = array();
        $i = 0;
        foreach ($products as $product) {
            if ($id_belvg_preorder_product = ProductPreorder::checkExistStatic($product['product_id'], $product['product_attribute_id'])) {
                $preorder_products[$i]['product_id'] = (int) $product['product_id'];
                $preorder_products[$i]['id_belvg_preorder_product'] = (int) $id_belvg_preorder_product;
                $preorder_products[$i]['product_attribute_id'] = (int) $product['product_attribute_id'];
                $i++;
            }
        }

        if (count($preorder_products)) {
            foreach ($preorder_products as $preorder_product) {
                $result = Db::getInstance()->AutoExecute(_DB_PREFIX_ . 'belvg_preorder_order_product', array('id_preorder_order' => $id_preorder_order, 'date_add' => date("Y-m-d h:i:s"), 'date_upd' => date("Y-m-d h:i:s"), 'active' => 1, 'id_belvg_preorder_product' => $preorder_product['id_belvg_preorder_product'], 'product_id' => $preorder_product['product_id'], 'product_attribute_id' => $preorder_product['product_attribute_id']), 'INSERT');
            }
        }
    }
    
    public function checkPoProducts($checkOrders = FALSE) {
        $poCollection = new Collection('ProductPreorder');
        $now = new DateTime();
        $now = strtotime($now->format("Y-m-d H:i:s"));
        foreach ($poCollection->getResults() as $item) {
            if ($item->active && $now > strtotime($item->expire_datetime)) {
                $id_reason = 1; //Increase
                $reason = new StockMvtReason((int) $id_reason);
                $qty = $item->quantity * $reason->sign;
                $product = new Product((int) ($item->id_product), FALSE, Context::getContext()->cookie->id_lang, $item->id_shop);

                if (!StockAvailable::updateQuantity($item->id_product, $item->id_product_attribute, $qty, $item->id_shop)) {
                    die(Tools::displayError('An error occurred while updating qty.'));
                }

                Hook::exec('updateProduct', array('product' => $product));
                if ($checkOrders) {
                    $this->checkOrders();
                }
                
                $item->active = FALSE;
                $item->update();
            }
        }
    }

}