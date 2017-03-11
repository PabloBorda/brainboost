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


if (!defined('_PS_VERSION_')) {
    exit;
}

define('BPP_SHORT_MODULE_NAME', 'belvg_pp_');

require_once(dirname(__FILE__) . '/classes/ProductPreorder.php');
require_once(dirname(__FILE__) . '/classes/ProductWait.php');

class Belvg_PreOrderProducts extends Module {

    protected $_moduleParams = array(
        'allow_notify_me' => '1',
        'msg_delay' => '259200', //in days
        'msg_max_count' => '3',
        'product_tab' => '1',
        'active_cron' => '1'
    );
    protected $_templates = array(
        'productAdminTab' => 'views/admin/productAdminTab.tpl',
    );

    public function __construct() {
        $this->name = 'belvg_preorderproducts';
        $this->tab = 'front_office_features';
        $this->version = '3.1.0';
        $this->author = 'BelVG';
        $this->need_instance = 0;
		$this->bootstrap = TRUE;
        $this->module_key = "90d43f0b22281d6e472af3510748eded";

        parent::__construct();

        $this->displayName = $this->l('Pre-Order Products');
        $this->description = $this->l('With this extension you will be able to accept and easily manage pre-orders. For Prestashop v.1.6.x');
    }

    protected function _setModuleParam($param, $value) {
        return Configuration::updateValue(BPP_SHORT_MODULE_NAME . $param, abs((int) $value), FALSE, FALSE, FALSE);
    }

    protected function _getModuleParam($param) {
        return Configuration::get(BPP_SHORT_MODULE_NAME . $param);
    }

    public function getTemplate($id) {
        if (isset($this->_templates[$id])) {
            return $this->_templates[$id];
        }

        return FALSE;
    }

    public function install() {
        if (!parent::install() OR
                !$this->registerHook('displayFooterProduct') OR
                !$this->registerHook('actionProductOutOfStock') OR
                /* !$this->registerHook('newOrder') OR */
                !$this->registerHook('displayOrderConfirmation') OR
                !$this->registerHook('actionValidateOrder') OR
                !$this->registerHook('actionCartSave') OR
                !$this->registerHook('displayMyAccountBlock') OR
                !$this->registerHook('displayCustomerAccount') OR
                !$this->registerHook('displayBackOfficeFooter') OR
                !$this->registerHook('displayHeader') OR
                !$this->registerHook('displayAdminProductsExtra') OR
                !$this->registerHook('actionProductUpdate') OR
                !$this->registerHook('displayProductListFunctionalButtons') OR
                !$this->installConfiguration()
        ) {
            return FALSE;
        }

        $sql = array();
        include(dirname(__FILE__) . '/init/install_sql.php');
        foreach ($sql as $s) {
            if (!Db::getInstance()->Execute($s)) {
                return FALSE;
            }
        }

        $new_tab = new Tab();
        $new_tab->class_name = 'AdminWaitProducts';
        $new_tab->id_parent = Tab::getCurrentParentId();
        $new_tab->module = $this->name;
        $languages = Language::getLanguages();
        foreach ($languages as $language) {
            $new_tab->name[$language['id_lang']] = 'Waiting list';
        }

        $new_tab->add();

        //Add �Processing Pre-Order� to order statuses;
        $sql = 'SELECT id_order_state FROM `' . _DB_PREFIX_ . 'order_state_lang`
            WHERE name = \'Preorder\'';
        $issetPreorder = Db::getInstance()->getValue($sql);

        if (!$issetPreorder) {
            $data = array(
                'invoice' => 0,
                'send_email' => 1,
                'color' => '#FFDD99',
                'unremovable' => 1,
                'hidden' => 0,
                'logable' => 1,
                'delivery' => 0
            );
            Db::getInstance()->insert('order_state', $data, FALSE, TRUE, Db::REPLACE);
            $lastID = Db::getInstance()->Insert_ID();
            $languages = Language::getLanguages();
            foreach ($languages as $language) {
                $data = array(
                    'id_order_state' => $lastID,
                    'id_lang' => $language['id_lang'],
                    'template' => 'preorder',
                    'name' => 'Preorder'
                );
                Db::getInstance()->insert('order_state_lang', $data, FALSE, TRUE, Db::REPLACE);
            }

            if (!Configuration::updateValue(BPP_SHORT_MODULE_NAME . '_status_id', $lastID)) {
                return FALSE;
            }

            copy(dirname(__FILE__) . '/images/status.gif', dirname(__FILE__) . '/../../img/os/' . $lastID . '.gif');
            $this->copy_directory(dirname(__FILE__) . '/mails', dirname(__FILE__) . '/../../mails');
        }

        return TRUE;
    }

    public function uninstall() {
        if (!parent::uninstall() OR
            !$this->unInstallConfiguration()
        ) {
            return FALSE;
        }

        $sql = array();
        include(dirname(__FILE__) . '/init/uninstall_sql.php');
        foreach ($sql as $s) {
            if (!Db::getInstance()->Execute($s)) {
                return FALSE;
            }
        }

        $idTabs = array();
        $idTabs[] = Tab::getIdFromClassName('AdminWaitProducts');
        foreach ($idTabs as $idTab) {
            if ($idTab) {
                $tab = new Tab($idTab);
                $tab->delete();
            }
        }

        return TRUE;
    }

    public function installConfiguration() {
        foreach ($this->_moduleParams as $param => $value) {
            if (!$this->_setModuleParam($param, $value)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function unInstallConfiguration() {
        foreach ($this->_moduleParams as $param => $value) {
            if (!Configuration::deleteByName(BPP_SHORT_MODULE_NAME . $param)) {
                return FALSE;
            }
        }

        return TRUE;
    }

    public function copy_directory($source, $destination) {
        if (is_dir($source)) {
            mkdir($destination);
            $directory = dir($source);
            while (FALSE !== ( $readdirectory = $directory->read() )) {
                if ($readdirectory == '.' || $readdirectory == '..') {
                    continue;
                }

                $PathDir = $source . '/' . $readdirectory;
                if (is_dir($PathDir)) {
                    $this->copy_directory($PathDir, $destination . '/' . $readdirectory);
                    continue;
                }

                copy($PathDir, $destination . '/' . $readdirectory);
            }

            $directory->close();
        } else {
            copy($source, $destination);
        }
    }

    public function hookDisplayHeader($params) {
        global $smarty, $cookie;

        $this->context->controller->addCSS(($this->_path) . 'css/belvg_preorder.css', 'all');
        $this->context->controller->addCSS(($this->_path) . 'css/jquery.countdown.css', 'all');
        $this->context->controller->addJS(($this->_path) . 'js/jquery.countdown.js');

        return $this->display(__FILE__, '/views/frontend/header.tpl');
    }

    public function hookDisplayAdminProductsExtra($params) {
        $id_product = (int) Tools::getValue('id_product');
        $productObj = new Product($id_product, FALSE, $this->context->language->id);
        $attributes_resume = $productObj->getAttributesResume($this->context->language->id);
        $poProductObj = new ProductPreorder();
        $prepare_smarty_data = array();
        if (!empty($attributes_resume)) {
            foreach ($attributes_resume as $attribute) {
                if ($id_obj = $poProductObj->checkExist($id_product, $attribute['id_product_attribute'])) {
                    $poProductObj = new ProductPreorder($id_obj);
                    $prepare_smarty_data['attributes_resume_prepare'][] = array(
                        'id_product_attribute' => $poProductObj->id_product_attribute,
                        'id_product' => $poProductObj->id_product,
                        'quantity' => $poProductObj->quantity,
                        'attr_quantity' => StockAvailable::getQuantityAvailableByProduct($id_product, $attribute['id_product_attribute']),
                        'attribute_designation' => $attribute['attribute_designation'],
                        'po_product' => $poProductObj,
                    );
                } else {
                    $prepare_smarty_data['attributes_resume_prepare'][] = $attribute;
                }
            }
        } else {
            if ($id_obj = $poProductObj->checkExist($id_product)) {
                $poProductObj = new ProductPreorder($id_obj);
            } else {
                $poProductObj = NULL;
            }

            $prepare_smarty_data['attributes_resume_prepare'][] = array(
                'id_product_attribute' => 0,
                'id_product' => $productObj->id,
                'quantity' => Product::getQuantity($productObj->id),
                'attribute_designation' => $productObj->name,
                'po_product' => $poProductObj,
            );
        }

        $prepare_smarty_data['attributes_resume'] = array();
        foreach ($prepare_smarty_data['attributes_resume_prepare'] as &$attr_resume) {
            if ((isset($attr_resume['attr_quantity']) && $attr_resume['attr_quantity'] > 0)
                    || ($attr_resume['quantity'] > 0 && !isset($attr_resume['po_product'])) 
                    || (!isset($attr_resume['attr_quantity']) && $attr_resume['quantity'] > 0 && isset($attr_resume['po_product']) && !$attr_resume['po_product']->active)
                    || (isset($attr_resume['attr_quantity']) && $attr_resume['attr_quantity'] > 0 && isset($attr_resume['po_product']) && !$attr_resume['po_product']->active)
                    || (isset($attr_resume['attr_quantity']) && $attr_resume['attr_quantity'] > 0 && isset($attr_resume['po_product']) && !$attr_resume['po_product']->active)
                    || !StockAvailable::getStockAvailableIdByProductId($attr_resume['id_product'], $attr_resume['id_product_attribute'], Context::getContext()->shop->id)) {
                continue;
            } else {
                $prepare_smarty_data['attributes_resume'][] = $attr_resume;
            }
        }

        unset($prepare_smarty_data['attributes_resume_prepare']);
        $now = new DateTime();
        $now->setTimezone(new DateTimeZone(Configuration::get('PS_TIMEZONE'))); //'Asia/Kuala_Lumpur'

        $this->context->smarty->assign(array(
            'belvg_pp_data' => $prepare_smarty_data,
            'base_dir' => Tools::getCurrentUrlProtocolPrefix() . Tools::getShopDomain() . '/',
            'id_product' => $id_product,
            'server_time_load' => $now->format("D, d M Y H:i:s"),
            'belvg_pp_errors' => ((isset($this->context->cookie->belvg_pp_errors) && !empty($this->context->cookie->belvg_pp_errors)) ? $this->context->cookie->belvg_pp_errors : ''),
        ));

        return $this->display(__FILE__, $this->getTemplate('productAdminTab'));
    }

    public function hookActionProductUpdate($params) {
        $id_product = Tools::getValue('id_product');
        $allow_pre_order = Tools::getValue('allow_pre_order');
        $allow_countdown = Tools::getValue('allow_countdown');
        $qty = Tools::getValue('qty');
        $expire_datetime = Tools::getValue('expire_datetime');

        $this->sanitize($id_product, $allow_pre_order);

        if (!empty($allow_pre_order)) {
            $data = array();
            $db = Db::getInstance();
            $now = new DateTime();
            $this->context->cookie->belvg_pp_errors = NULL;
            foreach ($allow_pre_order as $key => $id_attribute) {
                if (isset($allow_countdown[$key]) && strtotime($expire_datetime[$key]) < strtotime($now->format("Y-m-d H:i:s"))) {
                    $this->context->cookie->belvg_pp_errors = $this->displayError($this->l('One of the dates you entered is incorrect'));
                    continue;
                }
                
                $data = array(
                    'id_product' => (int) $id_product,
                    'id_shop' => (int) Context::getContext()->shop->id,
                    'quantity' => (int) ($qty[$key] > 0 ? $qty[$key] : 100),
                    'countdown_active' => isset($allow_countdown[$key]),
                    'active' => 1,
                    'expire_datetime' => $expire_datetime[$key],
                    'date_upd' => date("Y-m-d h:i:s"),
                    'date_add' => date("Y-m-d h:i:s"),
                );
                //print_r($data);  
                if ($id_attribute) {
                    $data['id_product_attribute'] = $id_attribute;
                    //check
                    $productObj = new Product($id_product, FALSE, $this->context->language->id);
                    if (Product::getRealQuantity($productObj->id, $id_attribute, 0, Context::getContext()->shop->id) > 0) {
                        continue;
                    }
                } else {
                    $data['id_product_attribute'] = 0;
                    //check
                    $productObj = new Product($id_product, FALSE, $this->context->language->id);
                    if (Product::getRealQuantity($productObj->id, 0, 0, Context::getContext()->shop->id) > 0) {
                        continue;
                    }
                }

                if (!$result = $db->insert('belvg_preorder_product', $data, FALSE, TRUE, Db::REPLACE)) {
                    return FALSE;
                }
            }
        }
    }

    //sanitize DB table
    public function sanitize($id_product, $arr_attr) {
        //check before adding new items [case: increase stock]
        $productObj = new Product($id_product, FALSE, $this->context->language->id);
        $attributes_resume = $productObj->getAttributesResume($this->context->language->id);
        if (!empty($attributes_resume)) {
            foreach ($attributes_resume as $attribute) {
                if ($attribute['quantity'] > 0 || !StockAvailable::getStockAvailableIdByProductId($id_product, $attribute['id_product_attribute'], Context::getContext()->shop->id)) {
                    Db::getInstance()->delete(
                        'belvg_preorder_product', '`id_shop` = ' . (int) Context::getContext()->shop->id . ' AND `id_product` = ' . (int) $id_product . ' AND id_product_attribute = ' . (int) $attribute['id_product_attribute']
                    );
                }
            }
        } else {
            $productObj = new Product($id_product, FALSE, $this->context->language->id);
            if (Product::getRealQuantity($productObj->id) > 0 || !StockAvailable::getStockAvailableIdByProductId($id_product, $attribute['id_product_attribute'], Context::getContext()->shop->id)) {
                Db::getInstance()->delete(
                    'belvg_preorder_product', '`id_shop` = ' . (int) Context::getContext()->shop->id . ' AND `id_product` = ' . (int) $id_product
                );
            }
        }

        if (empty($arr_attr)) {
            Db::getInstance()->update(
                    'belvg_preorder_product', array(
                        'active' => 0,
                        'countdown_active' => 0,
                    ), 
                    '`id_shop` = ' . (int) Context::getContext()->shop->id . ' AND `id_product` = ' . (int) $id_product
            );
            return TRUE;
        }

        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . 'belvg_preorder_product` WHERE `id_shop` = ' . (int) Context::getContext()->shop->id . ' AND id_product = ' . $id_product;
        $exesting_pp = Db::getInstance()->ExecuteS($sql);
        foreach ($exesting_pp as $item_pp) {
            if (!in_array($item_pp['id_product_attribute'], $arr_attr)) {
                Db::getInstance()->update(
                        'belvg_preorder_product', array(
                            'active' => 0,
                            //'countdown_active' => 0,
                        ), 
                        '`id_shop` = ' . (int) Context::getContext()->shop->id . ' AND `id_product` = ' . (int) $id_product . ' AND id_product_attribute = ' . (int) $item_pp['id_product_attribute']
                );
            }
        }

        return TRUE;
    }

    public function hookActionProductOutOfStock($params) {
        $product = $params['product'];
        $attributes_resume = $product->getAttributesResume($this->context->language->id);

        $poProductObj = new ProductPreorder();
        //$prepare_arr = array();
        if (!empty($attributes_resume)) {
            foreach ($attributes_resume as $key => &$attribute) {
                if ($id_obj = $poProductObj->checkExist($product->id, $attribute['id_product_attribute'], TRUE, TRUE)) {
                    $attribute['po_item'] = new ProductPreorder($id_obj);
                    //$prepare_arr[] = new ProductPreorder( $id_obj );
                } elseif (Product::getRealQuantity($product->id, $attribute['id_product_attribute']) > 0) {
                    //print_r($attribute);
                    unset($attributes_resume[$key]);
                }
            }
        } else {
            if ($id_obj = $poProductObj->checkExist($product->id, NULL, TRUE, TRUE)) {
                //$prepare_arr[] = new ProductPreorder( $id_obj );
                $attributes_resume[] = array(
                    'po_item' => new ProductPreorder($id_obj),
                    'id_product' => $product->id,
                    'id_product_attribute' => 0
                );
            } elseif (Product::getRealQuantity($product->id) <= 0) {
                $attributes_resume[] = array(
                    'id_product' => $product->id,
                    'id_product_attribute' => 0,
                );
            }
        }

        if (!empty($attributes_resume)) {
            foreach ($attributes_resume as &$item) {
                if (isset($item['po_item'])) {
                    $item['po_item']->expire_datetime = date("d F Y H:i:s", strtotime($item['po_item']->expire_datetime));
                    $item['po_item']->is_available = self::checkQty($item['po_item']);
                }

                $item['wait_id'] = ProductWait::checkExistStatic($this->context->cookie->id_customer, $item['id_product'], $item['id_product_attribute']);
            }
        }
  
        //'06 March 2012 16:32:22'
        //16:32:22
        $this->context->smarty->assign(array(
            //'po_items' => $prepare_arr,
            'po_items' => $attributes_resume,
            'isLogged' => (int) $this->context->customer->isLogged(TRUE),
            'allow_product_tab' => $this->_getModuleParam('product_tab'),
            'base_dir' => Tools::getCurrentUrlProtocolPrefix() . Tools::getShopDomain() . '/',
        ));

        return $this->display(__FILE__, 'views/frontend/preorderproducts.tpl');
    }

    public static function checkPreorder($objOrder) {
        $products = $objOrder->getProductsDetail();
        $preorder_fl = FALSE;
        //$i = 0;
        $preorder_id = NULL;
        $preorder_init_product_obj = NULL;
        //$exits_qty = 0;
        foreach ($products as $product) {
            if ($preorder_id = ProductPreorder::checkActiveStatic($product['product_id'], $product['product_attribute_id']) && $product['product_quantity_in_stock'] <= 0) {
                $preorder_init_product_obj = $product;
                $preorder_fl = TRUE;
                //$exits_qty = $preorder_init_product_obj['product_quantity_in_stock'];
                break;
            }
        }

        if ($preorder_fl /* && ($exits_qty <= 0) */) {
            ProductPreorder::saveOrder($products, (int) $objOrder->id);
            $history = new OrderHistory();
            $history->id_order = (int) $objOrder->id;
            $history->changeIdOrderState(Configuration::get(BPP_SHORT_MODULE_NAME . '_status_id'), $objOrder);
            //$carrier = new Carrier((int)($objOrder->id_carrier), (int)($objOrder->id_lang));
            $preorder = new ProductPreorder($preorder_id);
            $templateVars = array();
            $templateVars = array(
                '{date_avaliable}' => ($preorder->date_avaliable ? $preorder->date_avaliable : '')
            );
            self::addWithemail($history, TRUE, $templateVars);
        }
    }

    public static function checkQty($po_item) {
        $id_shop = NULL;
        if (Shop::isFeatureActive()) {
            $id_shop = Context::getContext()->shop->id;
        }

        $real_stock = StockAvailable::getQuantityAvailableByProduct($po_item->id_product, $po_item->id_product_attribute, $id_shop);
    }

    public function hookDisplayOrderConfirmation($params) {
        $objOrder = $params['objOrder'];
        /*Multishipping support*/
        $ordersCollectionResults = Order::getByReference($objOrder->reference)->getResults();
        foreach ($ordersCollectionResults as $itemOrderObj) {
            if ($itemOrderObj->current_state == Configuration::get(BPP_SHORT_MODULE_NAME . '_status_id')) {
                return TRUE;
            }

            self::checkPreorder($itemOrderObj);
        }
    }

    public static function addWithemail($history_obj, $autodate = TRUE, $templateVars = FALSE) {
        //$lastOrderState = $history_obj->getLastOrderState($history_obj->id_order); //deprecated

        if (!$history_obj->add($autodate)) {
            return FALSE;
        }

        $result = Db::getInstance()->getRow('
        SELECT osl.`template`, c.`lastname`, c.`firstname`, osl.`name` AS osname, c.`email`
        FROM `' . _DB_PREFIX_ . 'order_history` oh
        LEFT JOIN `' . _DB_PREFIX_ . 'orders` o ON oh.`id_order` = o.`id_order`
        LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON o.`id_customer` = c.`id_customer`
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state` os ON oh.`id_order_state` = os.`id_order_state`
        LEFT JOIN `' . _DB_PREFIX_ . 'order_state_lang` osl ON (os.`id_order_state` = osl.`id_order_state` AND osl.`id_lang` = o.`id_lang`)
        WHERE oh.`id_order_history` = ' . (int) ($history_obj->id) . ' AND os.`send_email` = 1');

        if (isset($result['template']) AND Validate::isEmail($result['email'])) {
            $topic = $result['osname'];
            $data = array('{lastname}' => $result['lastname'], '{firstname}' => $result['firstname'], '{id_order}' => (int) $history_obj->id_order);
            if ($templateVars) {
                $data = array_merge($data, $templateVars);
            }

            $order = new Order((int) $history_obj->id_order);
            $data['{total_paid}'] = Tools::displayPrice((float) $order->total_paid, new Currency((int) $order->id_currency), FALSE);
            $data['{order_name}'] = sprintf("#%06d", (int) $order->id);

            if (Validate::isLoadedObject($order)) {
                Mail::Send((int) $order->id_lang, 'preorder', Mail::l('Change order state [preorder]'), $data, $result['email'], $result['firstname'] . ' ' . $result['lastname'], strval(Configuration::get('PS_SHOP_EMAIL')), strval(Configuration::get('PS_SHOP_NAME')), NULL, NULL, dirname(__FILE__) . '/../../mails/');
            }
        }

        return TRUE;
    }

    public function hookDisplayMyAccountBlock($params) {
        /* $po_product_obj = new ProductPreorder();
          $po_product_obj->checkOrders(); */
        return $this->display(__FILE__, 'views/frontend/my-account.tpl');
    }

    public function hookDisplayCustomerAccount($params) {
        return $this->display(__FILE__, 'views/frontend/my-account.tpl');
    }
    
    private function initForm() {
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->toolbar_scroll = TRUE;
        $helper->toolbar_btn = $this->initToolbar();
        $helper->title = $this->displayName;
        $helper->submit_action = 'submitUpdate';

        $this->fields_form[0]['form'] = array(
            'tinymce' => TRUE,
            'legend' => array(
                'title' => $this->displayName,
                'image' => $this->_path . 'logo.gif'
            ),
            'submit' => array(
                'name' => 'submitUpdate',
                'title' => $this->l('   Save   '),
            ),
            'input' => array(
                /* array(
                  'type' => 'radio',
                  'label' => $this->l('Allow link "notify me":'),
                  'name' => 'allow_notify_me',
                  'class' => 't',
                  'required' => TRUE,
                  'is_bool' => TRUE,
                  'values' => array(
                  array(
                  'id' => 'allow_notify_me_on',
                  'value' => 1,
                  'label' => $this->l('Yes')),
                  array(
                  'id' => 'allow_notify_me_off',
                  'value' => 0,
                  'label' => $this->l('No')),
                  ),
                  'desc' => $this->l('Enable/disable link "Notify me when in stock"')
                  ), */
                array(
                    'type' => 'text',
                    'label' => $this->l('Delay between messages (in days):'),
                    'name' => 'msg_delay',
                //'desc' => $this->l('')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Number of messages:'),
                    'name' => 'msg_max_count',
                    'desc' => $this->l('Max. number of messages that will be sent to your customers')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Allow pre-order:'),
                    'name' => 'product_tab',
                    'class' => 't',
                    'required' => TRUE,
                    'is_bool' => TRUE,
                    'values' => array(
                        array(
                            'id' => 'product_tab_on',
                            'value' => 1,
                            'label' => $this->l('Yes')),
                        array(
                            'id' => 'product_tab_off',
                            'value' => 0,
                            'label' => $this->l('No')),
                    ),
                    'desc' => $this->l('Enable/disable the tab in a catalog and display/hide the button on front end')
                ),
                array(
                    'type' => 'switch',
                    'label' => $this->l('Active Cron:'),
                    'name' => 'active_cron',
                    'class' => 't',
                    'required' => TRUE,
                    'is_bool' => TRUE,
                    'values' => array(
                        array(
                            'id' => 'active_cron_on',
                            'value' => 1,
                            'label' => $this->l('Yes')),
                        array(
                            'id' => 'active_cron_off',
                            'value' => 0,
                            'label' => $this->l('No')),
                    ),
                    'desc' => array(
                        $this->l('Allow execution of cron.php'),
                        __PS_BASE_URI__ . 'modules/belvg_preorderproducts/controllers/cron.php'
                    )
                ),
            )
        );

        return $helper;
    }

    public function getContent() {
        $this->postProcess();
        $helper = $this->initForm();
        foreach ($this->fields_form[0]['form']['input'] as $input) {
            //if ($input['name'] != 'image') {
            $helper->fields_value[$input['name']] = $this->_getModuleParam($input['name']);
            //}
        }

        $helper->fields_value['msg_delay'] /= (3600 * 24);

        $this->_html .= $helper->generateForm($this->fields_form);

        return $this->_html;
    }

    protected function postProcess() {
        if (Tools::isSubmit('submitUpdate')) {
            $errors = '';
            $data = $_POST;
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    if (!array_key_exists($key, $this->_moduleParams)) {
                        continue;
                    }

                    $this->_setModuleParam($key, $value);
                }
            }

            $msg_delay = $this->_getModuleParam('msg_delay');
            $this->_setModuleParam('msg_delay', !$msg_delay || ($msg_delay > 365) ? 259200 : $msg_delay * 3600 * 24);
            $msg_max_count = $this->_getModuleParam('msg_max_count');
            $this->_setModuleParam('msg_max_count', !$msg_max_count ? 1 : $msg_max_count);

            if (empty($errors)) {
                Tools::redirectAdmin('index.php?tab=AdminModules&conf=4&configure=' . $this->name . '&token=' . Tools::getAdminToken('AdminModules' . (int) (Tab::getIdFromClassName('AdminModules')) . (int) $this->context->employee->id));
            }

            $this->_html .= $errors;
        }
    }

    private function initToolbar() {
        $this->toolbar_btn['save'] = array(
            'href' => '#',
            'desc' => $this->l('Save')
        );

        return $this->toolbar_btn;
    }

	public function hookDisplayProductListFunctionalButtons($params) {
		//TODO : Add cache
		if (ProductPreorder::checkExistStatic($params['product']['id_product'], NULL, FALSE, TRUE)) {
			return $this->display(__FILE__, 'views/frontend/product-list.tpl');
		}
	}

    
    /* public static function renderShopList()
    {
        return TRUE;
    } */

}
