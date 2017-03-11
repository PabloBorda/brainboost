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
class OrderDetail extends OrderDetailCore {
    /**
     * Check the order state
     * @param array $product
     * @param int $id_order_state
     */
    /*
    * module: belvg_preorderproducts
    * date: 2016-08-26 12:34:57
    * version: 3.1.0
    */
    protected function checkProductStock($product, $id_order_state) {
        require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");
        if ($id_order_state != Configuration::get('PS_OS_CANCELED') && $id_order_state != Configuration::get('PS_OS_ERROR')) {
            $update_quantity = TRUE;
            if (!StockAvailable::dependsOnStock($product['id_product'])) {
                $update_quantity = StockAvailable::updateQuantity($product['id_product'], $product['id_product_attribute'], -(int) $product['cart_quantity']);
            }
            if ($update_quantity) {
                $product['stock_quantity'] -= $product['cart_quantity'];
            }
            if ($product['stock_quantity'] < 0 && Configuration::get('PS_STOCK_MANAGEMENT') && !ProductPreorder::checkActiveStatic($product['id_product'], $product['id_product_attribute'])) {
                $this->outOfStock = TRUE;
            }
            Product::updateDefaultAttribute($product['id_product']);
        }
    }
}
