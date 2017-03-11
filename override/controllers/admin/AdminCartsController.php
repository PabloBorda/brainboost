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
class AdminCartsController extends AdminCartsControllerCore {
    /*
    * module: belvg_preorderproducts
    * date: 2016-08-26 12:34:57
    * version: 3.1.0
    */
    public function ajaxProcessUpdateQty() {
        require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");
        if ($this->tabAccess['edit'] === '1') {
            $errors = array();
            if (!$this->context->cart->id) {
                return;
            }
            
            if ($this->context->cart->OrderExists()) {
                $errors[] = Tools::displayError('An order has already been placed with this cart');
            } elseif (!($id_product = (int) Tools::getValue('id_product')) || !($product = new Product((int) $id_product, TRUE, $this->context->language->id))) {
                $errors[] = Tools::displayError('Invalid product');
            } elseif (!($qty = Tools::getValue('qty')) || $qty == 0) {
                $errors[] = Tools::displayError('Invalid quantity');
            }
            if (isset($product) && $product->id) {
                if (($id_product_attribute = Tools::getValue('id_product_attribute')) != 0) {
                    if (!Product::isAvailableWhenOutOfStock($product->out_of_stock) && !Attribute::checkAttributeQty((int) $id_product_attribute, (int) $qty) AND !ProductPreorder::checkActiveStatic($id_product, $id_product_attribute)) {
                        $errors[] = Tools::displayError('There is not enough product in stock');
                    }
                } else {
                    if (!$product->checkQty((int) $qty) AND !ProductPreorder::checkActiveStatic($id_product)) {
                        $errors[] = Tools::displayError('There is not enough product in stock');
                    }
                    
                    if (!($id_customization = (int) Tools::getValue('id_customization', 0)) && !$product->hasAllRequiredCustomizableFields()) {
                        $errors[] = Tools::displayError('Please fill in all required fields');
                    }
                }
                
                $this->context->cart->save();
            } else {
                $errors[] = Tools::displayError('Product can\'t be added to the cart');
            }
            
            if (!count($errors)) {
                if ((int) $qty < 0) {
                    $qty = str_replace('-', '', $qty);
                    $operator = 'down';
                } else {
                    $operator = 'up';
                }
                
                if (!($qty_upd = $this->context->cart->updateQty($qty, $id_product, (int) $id_product_attribute, (int) $id_customization, $operator))) {
                    $errors[] = Tools::displayError('You already have the maximum quantity available for this product.');
                } elseif ($qty_upd < 0) {
                    $minimal_qty = $id_product_attribute ? Attribute::getAttributeMinimalQty((int) $id_product_attribute) : $product->minimal_quantity;
                    $errors[] = sprintf(Tools::displayError('You must add a minimum of %d quantity', FALSE), $minimal_qty);
                }
            }
            echo Tools::jsonEncode(array_merge($this->ajaxReturnVars(), array('errors' => $errors)));
        }
    }
}
?>
