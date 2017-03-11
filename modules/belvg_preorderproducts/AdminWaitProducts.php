<?php

/*
 * 2007-2012 PrestaShop
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
 * @package    Belvg_PreorderProducts
 * @author    Alexander Simonchik <support@belvg.com>
 * @site    
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

require_once(dirname(__FILE__) . '/belvg_preorderproducts.php');

class AdminWaitProducts extends ModuleAdminController {

    protected $_module = NULL;
    protected $waitListFields = array('fl_mail', 'id_belvg_preorder_wait_', 'firstname', 'lastname', 'email');
    protected $additWaitListFields = array('id_belvg_preorder_wait', 'product_name', 'attributes_name', 'customer_number', 'status');

    public function __construct() {
        $this->context = Context::getContext();
        $this->table = 'belvg_preorder_wait';
        $this->identifier = 'id_belvg_preorder_wait';
        $this->className = 'ProductWait';
        $this->_defaultOrderBy = 'customer_number';
		$this->bootstrap = TRUE;
        //$this->edit = TRUE;
        $this->actions = array(
            'view'
        );

        $this->fields_list = array(
            'id_belvg_preorder_wait' => array(
                'title' => $this->l('ID'),
                'width' => 25,
                'align' => 'center'
            ),
            'product_name' => array(
                'title' => $this->l('Product'),
                'width' => 'auto',
                'filter_key' => 'a!product_name',
                'align' => 'left'
            ),
            'attributes_name' => array(
                'title' => $this->l('Attribute Name'),
                'width' => 'auto',
                'orderby' => FALSE,
                'filter' => FALSE,
                'search' => FALSE,
                'align' => 'left'
            ),
            'customer_number' => array(
                'title' => $this->l('Count'),
                'width' => 25,
                'filter_key' => 'a!customer_number',
                'align' => 'center'
            ),
            'status' => array(
                'title' => $this->l('Status'),
                'width' => 80,
                'type' => 'bool',
                'activeVisu' => TRUE,
                'orderby' => FALSE,
                'filter' => FALSE,
                'search' => FALSE,
                'filter_key' => 'agl!status',
                'align' => 'center'
            ),
        );

        parent::__construct();
    }

    public function l($string) {
        if (is_null($this->_module)) {
            $this->_module = new belvg_preorderproducts();
        }

        return $this->_module->l($string, __CLASS__);
    }

    /* public function initHeader() {
        parent::initHeader();

        // Multishop
        $this->context->smarty->assign(array(
            'is_multishop' => FALSE,
        ));
    } */

    public function initToolbar() {
        switch ($this->display) {
            case 'add':
            case 'edit':
                // Default save button - action dynamically handled in javascript
                $this->toolbar_btn['save'] = array(
                    'href' => '#',
                    'desc' => $this->l('Save')
                );
                //no break
            case 'view':
                // Default cancel button - like old back link
                $back = Tools::safeOutput(Tools::getValue('back', ''));
                if (empty($back)) {
                    $back = self::$currentIndex . '&token=' . $this->token;
                }
                
                if (!Validate::isCleanHtml($back)) {
                    die(Tools::displayError());
                }
                
                if (!$this->lite_display) {
                    $this->toolbar_btn['back'] = array(
                        'href' => $back,
                        'desc' => $this->l('Back to list')
                    );
                }
                break;
                
            case 'options':
                $this->toolbar_btn['save'] = array(
                    'href' => '#',
                    'desc' => $this->l('Save')
                );
                break;
                
            /* case 'view':
                //Prestashop
                break; */
                
            default:
                // list
                break;
        }
    }

    public function initContent() {
        if (!$this->viewAccess()) {
            $this->errors[] = Tools::displayError('You do not have permission to view here.');
            return;
        }

        //belvg --begin
        $id_belvg_preorder_wait = Tools::getValue('id_belvg_preorder_wait');
        $submitFilterbelvg_preorder_wait_info = Tools::getIsset('submitFilterbelvg_preorder_wait_info');
        $view_arr = $this->waitListFields;
        if ($id_belvg_preorder_wait || $submitFilterbelvg_preorder_wait_info || (isset($_GET['belvg_preorder_waitOrderby']) && in_array($_GET['belvg_preorder_waitOrderby'], $view_arr))) {
            $this->display = 'view';
        }
        
        //belvg --end

        $this->getLanguages();
        // toolbar (save, cancel, new, ..)
        $this->initToolbar();
        if ($this->display == 'edit' || $this->display == 'add') {
            if (!$this->loadObject(TRUE)) {
                return;
            }

            $this->content .= $this->renderForm();
        } elseif ($this->display == 'view') {
            self::$currentIndex .= '&id_belvg_preorder_wait=' . Tools::getValue('id_belvg_preorder_wait');
            // Some controllers use the view action without an object
            if ($this->className) {
                $this->loadObject(TRUE);
            }
            
            $this->content .= $this->renderView();
        } elseif (!$this->ajax) {
            $this->content .= $this->renderList();
            $this->content .= $this->renderOptions();
            // if we have to display the required fields form
            if ($this->required_database) {
                $this->content .= $this->displayRequiredFields();
            }
        }

        $this->context->smarty->assign(array(
            'content' => $this->content,
            'url_post' => self::$currentIndex . '&token=' . $this->token,
        ));
    }

    public function getList($id_lang, $orderBy = NULL, $orderWay = NULL, $start = 0, $limit = NULL) {
        $cookie = $this->context->cookie;
        
        $use_limit = TRUE;
        if ($limit === FALSE) {
            $use_limit = FALSE;
        }

        /* Manage default params values */
        if (empty($limit)) {
            $limit = ((!isset($cookie->{$this->table . '_pagination'})) ? $this->_pagination[1] : $limit = $cookie->{$this->table . '_pagination'});
        }

        if (!Validate::isTableOrIdentifier($this->table)) {
            die(Tools::displayError('Table name is invalid:') . ' "' . $this->table . '"');
        }

        if (in_array($cookie->__get($this->table . 'Orderby'), $this->waitListFields)) {
            unset($cookie->{$this->table . 'Orderby'});
        }

        if (empty($orderBy)) {
            $orderBy = $cookie->__get($this->table . 'Orderby') ? $cookie->__get($this->table . 'Orderby') : $this->_defaultOrderBy;
        }
        
        if (empty($orderWay)) {
            $orderWay = $cookie->__get($this->table . 'Orderway') ? $cookie->__get($this->table . 'Orderway') : 'DESC';
        }

        $limit = (int) (Tools::getValue('pagination', $limit));
        $cookie->{$this->table . '_pagination'} = $limit;

        /* Check params validity */
        if (!Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay)
                OR !is_numeric($start) OR !is_numeric($limit)
                OR !Validate::isUnsignedId($id_lang)) {
            die(Tools::displayError('get list params is not valid'));
        }

        /* Determine offset from current page */
        if ((isset($_POST['submitFilter' . $this->table]) OR
                isset($_POST['submitFilter' . $this->table . '_x']) OR
                isset($_POST['submitFilter' . $this->table . '_y'])) AND
                !empty($_POST['submitFilter' . $this->table]) AND
                is_numeric($_POST['submitFilter' . $this->table])) {
            $start = (int) ($_POST['submitFilter' . $this->table] - 1) * $limit;
        }

        /* Cache */ 
        $this->_lang = (int) ($id_lang);
        $this->_orderBy = $orderBy;
        $this->_orderWay = Tools::strtoupper($orderWay);

        /* SQL table : orders, but class name is Order */
        $sqlTable = $this->table == 'order' ? 'orders' : $this->table;
        
        $shop_context = Shop::getContext();
        $context = Context::getContext();
        $store_id = '';
        if ($shop_context == Shop::CONTEXT_ALL || ($context->controller->multishop_context_group == FALSE && $shop_context == Shop::CONTEXT_GROUP)) {
            $this->errors[] = Tools::displayError('Please, select store view');
            return NULL;
        } else if ($shop_context == Shop::CONTEXT_GROUP) {
            $this->errors[] = Tools::displayError('Please, select store view');
            return NULL;
        } else {
            $store_id = Context::getContext()->shop->id;
        }

        /* Query in order to get results with all fields */
        $sql = '
            SELECT * FROM (SELECT tmp_table.`id_product`, tmp_table.product_name, tmp_table_2.attributes_name, tmp_table.id_belvg_preorder_wait,
            count(tmp_table.`id_product`) as customer_number, tmp_table.`product_quantity`, tmp_table.`id_product_attribute`, tmp_table_2.`attribute_quantity`, 
            IF(tmp_table.`active`!=\'\', IF(tmp_table_2.`attributes_name`!=\'\',(IF(tmp_table_2.`attribute_quantity`>0,1,0)),IF(tmp_table.`product_quantity`>0,1,0)),0)as status
            FROM(
              SELECT a.`id_product`, a.`id_product_attribute` as id_product_attribute, pl.`name` as product_name, p.out_of_stock as allow_oosp, p.active, p.available_for_order, p.quantity as product_quantity, a.id_belvg_preorder_wait
              FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` a
              JOIN `' . _DB_PREFIX_ . 'product` p ON (p.`id_product` = a.`id_product`)
              ' . Shop::addSqlAssociation('product', 'p') . '
              JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.`id_product` = a.`id_product` AND pl.`id_lang` = ' . (int) ($cookie->id_lang) . (!empty($store_id) ? ' AND pl.`id_shop` IN (' . $store_id . ') ' : '') . ')
              LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON pa.`id_product_attribute`=a.`id_product_attribute`
              WHERE 1 ' . (!empty($store_id) ? ' AND a.`id_shop` IN (' . $store_id . ') ' : '') . '
              ) as tmp_table
            LEFT JOIN (
              SELECT pa.`id_product_attribute` as tmp2_id_product_attribute, al.`name` AS attributes_name, pa.`quantity` AS "attribute_quantity"
              FROM `' . _DB_PREFIX_ . 'product_attribute_combination` pac
              LEFT JOIN `' . _DB_PREFIX_ . 'attribute` a ON (a.`id_attribute` = pac.`id_attribute`)
              LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group` ag ON (ag.`id_attribute_group` = a.`id_attribute_group`)
              LEFT JOIN `' . _DB_PREFIX_ . 'attribute_lang` al ON (a.`id_attribute` = al.`id_attribute` AND al.`id_lang` = ' . (int) ($cookie->id_lang) . ')
              LEFT JOIN `' . _DB_PREFIX_ . 'attribute_group_lang` agl ON (ag.`id_attribute_group` = agl.`id_attribute_group` AND agl.`id_lang` = ' . (int) ($cookie->id_lang) . ')
              LEFT JOIN `' . _DB_PREFIX_ . 'product_attribute` pa ON (pac.`id_product_attribute` = pa.`id_product_attribute`)
              GROUP BY pa.`id_product_attribute` 
            ) as tmp_table_2 ON tmp_table.`id_product_attribute`= tmp_table_2.`tmp2_id_product_attribute`
            GROUP BY tmp_table.`id_product`,tmp_table.`id_product_attribute`) as a' . '
            WHERE 1 ' . (isset($this->_where) ? $this->_where . ' ' : '') . ($this->deleted ? 'AND a.`deleted` = 0 ' : '') . (isset($this->_filter) ? $this->_filter : '') . '
            ORDER BY ' . (($orderBy == $this->identifier) ? 'a.' : '') . '`' . pSQL($orderBy) . '` ' . pSQL($orderWay);
            //print_r($sql); die; 
            //print_r($sql);
            $this->_listTotal = Db::getInstance()->ExecuteS($sql);
            $this->_listTotal = count($this->_listTotal);
            $sql .= (($use_limit === TRUE) ? ' LIMIT ' . (int)$start . ',' . (int)$limit : '');            
        $this->_list = Db::getInstance()->ExecuteS($sql);

        //improving attributes list
        for ($i = 0; $i < count($this->_list); ++$i) {
            $tmp_array = array();
            $attr_params = Product::getAttributesParams($this->_list[$i]['id_product'], $this->_list[$i]['id_product_attribute']);
            if (!empty($attr_params)) {
                foreach ($attr_params as $attr_param) {
                    $tmp_array[] = $attr_param['name'];
                }

                $this->_list[$i]['attributes_name'] = implode(', ', $tmp_array);
            } else {
                $this->_list[$i]['attributes_name'] = '';
            }

            $real_qty = StockAvailable::getQuantityAvailableByProduct($this->_list[$i]['id_product'], $this->_list[$i]['id_product_attribute'], (int)Context::getContext()->shop->id);
            $this->_list[$i]['status'] = $real_qty > 0 ? 1 : 0;
        }
    }

    public function getWaitList($id_lang, $orderBy = NULL, $orderWay = NULL, $start = 0, $limit = NULL) {
        $cookie = $this->context->cookie;

        $this->tmp_identifier = 'product';
        $this->_defaultOrderBy = 'id_belvg_preorder_wait';

        $id_belvg_preorder_wait = Tools::getValue('id_belvg_preorder_wait');
        $prepare_ids = $this->prepareIds($id_belvg_preorder_wait);
        $this->_where = ' AND a.`id_product` = ' . (int) $prepare_ids['id_product'] . ' AND a.`id_product_attribute` = ' . (int) $prepare_ids['id_product_attribute'];

        /* Manage default params values */
        if (empty($limit)) {
            $limit = ((!isset($cookie->{$this->table . '_pagination'})) ? $this->_pagination[1] : $limit = $cookie->{$this->table . '_pagination'});
        }

        if (!Validate::isTableOrIdentifier($this->table)) {
            die(Tools::displayError('Table name is invalid:') . ' "' . $this->table . '"');
        }

        if (in_array($cookie->__get($this->table . 'Orderby'), $this->additWaitListFields)) {
            unset($cookie->{$this->table . 'Orderby'});
        }

        if (empty($orderBy)) {
            $orderBy = $cookie->__get($this->table . 'Orderby') ? $cookie->__get($this->table . 'Orderby') : $this->_defaultOrderBy;
        }
        
        if (empty($orderWay)) {
            $orderWay = $cookie->__get($this->table . 'Orderway') ? $cookie->__get($this->table . 'Orderway') : 'DESC';
        }

        $limit = (int) (Tools::getValue('pagination', $limit));
        $cookie->{$this->table . '_pagination'} = $limit;

        /* Check params validity */
        if (!Validate::isOrderBy($orderBy) OR !Validate::isOrderWay($orderWay)
                OR !is_numeric($start) OR !is_numeric($limit)
                OR !Validate::isUnsignedId($id_lang)) {
            die(Tools::displayError('get list params is not valid'));
        }

        /* Determine offset from current page */
        if ((isset($_POST['submitFilter' . $this->table]) OR
                isset($_POST['submitFilter' . $this->table . '_x']) OR
                isset($_POST['submitFilter' . $this->table . '_y'])) AND
                !empty($_POST['submitFilter' . $this->table]) AND
                is_numeric($_POST['submitFilter' . $this->table])) {
            $start = (int) ($_POST['submitFilter' . $this->table] - 1) * $limit;
        }

        /* Cache */
        $this->_lang = (int) ($id_lang);
        $this->_orderBy = $orderBy;
        $this->_orderWay = Tools::strtoupper($orderWay);

        /* SQL table : orders, but class name is Order */
        $sqlTable = $this->table == 'order' ? 'orders' : $this->table;

        /* Query in order to get results with all fields */
        $sql = '
            SELECT a.*, a.id_belvg_preorder_wait as id_belvg_preorder_wait_, c.firstname, c.lastname, pl.name
            FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` a
            LEFT JOIN `' . _DB_PREFIX_ . 'customer` c ON (c.`id_customer` = a.`id_customer`)
            JOIN `' . _DB_PREFIX_ . 'product` p ON (p.`id_product` = a.`id_product`)
            ' . Shop::addSqlAssociation('product', 'p') . '
            JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (pl.`id_product` = a.`id_product` AND pl.`id_lang` = ' . (int) ($cookie->id_lang) . ')
            WHERE 1 AND a.`id_shop` = ' . (int) (Context::getContext()->shop->id) . ' AND pl.`id_shop` = ' . (int) (Context::getContext()->shop->id) . ' ' . (isset($this->_where) ? $this->_where . ' ' : '') . ($this->deleted ? 'AND a.`deleted` = 0 ' : '') . (isset($this->_filter) ? $this->_filter : '') . '
            ORDER BY ' . (($orderBy == $this->tmp_identifier) ? 'a.' : '') . '`' . pSQL($orderBy) . '` ' . pSQL($orderWay) . ' ';
        $this->_listTotal = Db::getInstance()->ExecuteS($sql);
        $this->_listTotal = count($this->_listTotal);
        $sql .= 'LIMIT ' . (int) ($start) . ',' . (int) ($limit);
        //print_r($sql); //  die;          
        $this->_list = Db::getInstance()->ExecuteS($sql);
        //$this->_listTotal = Db::getInstance()->getValue('SELECT FOUND_ROWS() AS `' . _DB_PREFIX_ . $this->table . '`');

        //improving attributes list
        for ($i = 0; $i < count($this->_list); ++$i) {
            $tmp_array = array();
            $attr_params = Product::getAttributesParams($this->_list[$i]['id_product'], $this->_list[$i]['id_product_attribute']);
            if (!empty($attr_params)) {
                foreach ($attr_params as $attr_param) {
                    $tmp_array[] = $attr_param['name'];
                }

                $this->_list[$i]['attributes_name'] = implode(', ', $tmp_array);
            } else {
                $this->_list[$i]['attributes_name'] = '';
            }
        }
    }

    public function renderView() {
        //$this->table = 'belvg_preorder_wait_info';
        $this->_defaultOrderBy = 'id_belvg_preorder_wait';
        $this->actions = array();
        $this->getWaitList($this->context->language->id);
        $helper = new HelperList();
        $helper->no_link = TRUE;
        $this->setHelperDisplay($helper);
        $helper->tpl_vars = $this->tpl_list_vars;
        $helper->tpl_delete_link_vars = $this->tpl_delete_link_vars;

        $this->assignNewListFields();
        $list = $helper->generateList($this->_list, $this->fields_list);

        return $list;
    }

    public function postProcess() {
        //belvg --begin
        $id_belvg_preorder_wait = Tools::getValue('id_belvg_preorder_wait');
        $submitFilterbelvg_preorder_wait_info = Tools::getIsset('submitFilterbelvg_preorder_wait_info');
        if ($id_belvg_preorder_wait || $submitFilterbelvg_preorder_wait_info) {
            $this->assignNewListFields();
        }
        
        //belvg --end
        return parent::postProcess();
    }

    public function assignNewListFields() {
        $this->fields_list = array(
            'id_belvg_preorder_wait_' => array(
                'title' => $this->l('ID'),
                'width' => 25,
                'filter_key' => 'a!id_belvg_preorder_wait',
                'align' => 'center'
            ),
            'name' => array(
                'title' => $this->l('Product'),
                'width' => 'auto',
                'orderby' => FALSE,
                'filter' => FALSE,
                'search' => FALSE,
                'align' => 'left'
            ),
            'attributes_name' => array(
                'title' => $this->l('Attribute Name'),
                'width' => 'auto',
                'orderby' => FALSE,
                'filter' => FALSE,
                'search' => FALSE,
                'align' => 'left'
            ),
            'firstname' => array(
                'title' => $this->l('Firstname'),
                'width' => 'auto',
                'align' => 'left'
            ),
            'lastname' => array(
                'title' => $this->l('Lastname'),
                'width' => 'auto',
                'align' => 'left'
            ),
            'email' => array(
                'title' => $this->l('Email'),
                'width' => 'auto',
                'filter_key' => 'a!email',
                'align' => 'left'
            ),
            'fl_mail' => array(
                'title' => $this->l('Mail flag'),
                'width' => 80,
                'type' => 'bool',
                'activeVisu' => TRUE,
                'filter_key' => 'fl_mail',
                'align' => 'center'
            ),
        );
    }

    public function prepareIds($id_belvg_preorder_wait) {
        $sql = '
            SELECT pw.id_product, pw.id_product_attribute
            FROM `' . _DB_PREFIX_ . 'belvg_preorder_wait` pw
            WHERE id_belvg_preorder_wait = ' . (int) $id_belvg_preorder_wait;
        return Db::getInstance()->getRow($sql);
    }

}

?>
