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
 * @package    Belvg_PreOrderProducts
 * @author    alexander simonchik
 * @site    http://module-presta.com
 * @support@belvg.com 
 * @copyright  Copyright (c) 2010 - 2012 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
 */

require_once(dirname(__FILE__) . '/../../../config/config.inc.php');
include_once(dirname(__FILE__) . '/../../../init.php');
require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");
require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductWait.php");

class AjaxController extends FrontController {

    public function run() {
        global $cookie, $smarty;

        $action = Tools::getValue('action', NULL);
        $id_product = Tools::getValue('id_product', NULL);
        $id_product_attribute = Tools::getValue('id_product_attribute', NULL);

        switch ($action) {
            case 'checkPPExists':
                $id_products = Tools::getValue('id_products');
                $available_array = array();
                foreach (json_decode($id_products) as $id_p) {
                    $qty = ProductPreorder::checkExistWithQtyStatic($id_p);
                    if ($qty > 0) {
                        $available_array[] = $id_p;
                    }
                }

                echo json_encode($available_array);
                break;

            case 'switchStatus':
                $this->switchStatus($id_product, $id_product_attribute);
                break;

            case 'checkWait':
                $this->checkWait($cookie->id_customer, $id_product, $id_product_attribute);
                break;

            case 'subscribe':
                if ($this->context->customer->isLogged(TRUE)) {
                    $id_customer = (int) $this->context->customer->id;
                    ProductWait::switchStatus($id_customer, $id_product, $id_product_attribute);
                }

                $this->checkWait($id_customer, $id_product, $id_product_attribute);
                break;
                
            default:
                break;
        }
    }

    function checkWait($id_customer, $id_product, $id_product_attribute) {
        $wait_id = ProductWait::checkExistStatic($id_customer, $id_product, $id_product_attribute);
        $waitObj = new ProductWait($wait_id);

        $this->context->smarty->assign(array(
            'waitObj' => $waitObj
        ));

        $rendered_content = $this->context->smarty->fetch(_PS_MODULE_DIR_ . 'belvg_preorderproducts/views/frontend/waitproducts_ajax.tpl');
        echo $rendered_content;
    }

    function switchStatus($id_product, $id_product_attribute) {
        $po_product_obj = new ProductPreorder();
        if ($id_obj = $po_product_obj->checkExist($id_product, $id_product_attribute)) {
            $po_product_obj = new ProductPreorder($id_obj);
            $po_product_obj->switchStatus();
        }

        return FALSE;
    }

}

$ajax = new AjaxController();
$ajax->run();