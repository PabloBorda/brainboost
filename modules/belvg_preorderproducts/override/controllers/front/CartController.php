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

class CartController extends CartControllerCore {

    protected function processChangeProductInCart() {

        require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");

        $mode = (Tools::getIsset('update') && $this->id_product) ? 'update' : 'add';

        if ($this->qty == 0) {
            $this->errors[] = Tools::displayError('Null quantity');
        } else if (!$this->id_product) {
            $this->errors[] = Tools::displayError('Product not found');
        }    

        $product = new Product($this->id_product, TRUE, $this->context->language->id);
        if (!$product->id || !$product->active) {
            $this->errors[] = Tools::displayError('Product is no longer available.', FALSE);
            return;
        }

        // Check product quantity availability
        if ($this->id_product_attribute) {
            if (!Product::isAvailableWhenOutOfStock($product->out_of_stock) && !Attribute::checkAttributeQty($this->id_product_attribute, $this->qty) AND !ProductPreorder::checkActiveStatic($product->id, $this->id_product_attribute)) {
                $this->errors[] = Tools::displayError('There is not enough product in stock.');
            }
        } elseif ($product->hasAttributes()) {
            $minimumQuantity = ($product->out_of_stock == 2) ? !Configuration::get('PS_ORDER_OUT_OF_STOCK') : !$product->out_of_stock;
            $this->id_product_attribute = Product::getDefaultAttribute($product->id, $minimumQuantity);
            // @todo do something better than a redirect admin !!
            if (!$this->id_product_attribute) {
                Tools::redirectAdmin($this->context->link->getProductLink($product));
            } else if (!Product::isAvailableWhenOutOfStock($product->out_of_stock) && !Attribute::checkAttributeQty($this->id_product_attribute, $this->qty) AND !ProductPreorder::checkActiveStatic($product->id, $this->id_product_attribute)) {
                $this->errors[] = Tools::displayError('There is not enough product in stock.');
            }
        } elseif (!$product->checkQty($this->qty) AND !ProductPreorder::checkActiveStatic($product->id)) {
            $this->errors[] = Tools::displayError('There is not enough product in stock.');
        }

        // If no errors, process product addition
        if (!$this->errors && $mode == 'add') {
            // Add cart if no cart found
            if (!$this->context->cart->id) {
                $this->context->cart->add();
                if ($this->context->cart->id) {
                    $this->context->cookie->id_cart = (int) $this->context->cart->id;
                }    
            }

            // Check customizable fields
            if (!$product->hasAllRequiredCustomizableFields() && !$this->customization_id) {
                $this->errors[] = Tools::displayError('Please fill in all required fields, then save the customization.');
            }
            
            if (!$this->errors) {
                $cart_rules = $this->context->cart->getCartRules();
                $update_quantity = $this->context->cart->updateQty($this->qty, $this->id_product, $this->id_product_attribute, $this->customization_id, Tools::getValue('op', 'up'), $this->id_address_delivery);
                if ($update_quantity < 0) {
                    // If product has attribute, minimal quantity is set with minimal quantity of attribute
                    $minimal_quantity = ($this->id_product_attribute) ? Attribute::getAttributeMinimalQty($this->id_product_attribute) : $product->minimal_quantity;
                    $this->errors[] = sprintf(Tools::displayError('You must add %d minimum quantity', FALSE), $minimal_quantity);
                } elseif (!$update_quantity) {
                    $this->errors[] = Tools::displayError('You already have the maximum quantity available for this product.', FALSE);
                } elseif ((int) Tools::getValue('allow_refresh')) {
                    // If the cart rules has changed, we need to refresh the whole cart
                    $cart_rules2 = $this->context->cart->getCartRules();
                    if (count($cart_rules2) != count($cart_rules)) {
                        $this->ajax_refresh = TRUE;
                    } else {
                        $rule_list = array();
                        foreach ($cart_rules2 as $rule) {
                            $rule_list[] = $rule['id_cart_rule'];
                        }
                        
                        foreach ($cart_rules as $rule) {
                            if (!in_array($rule['id_cart_rule'], $rule_list)) {
                                $this->ajax_refresh = TRUE;
                                break;
                            }
                        }    
                    }
                }
            }
        }

        $removed = CartRule::autoRemoveFromCart();
        if (count($removed) && (int) Tools::getValue('allow_refresh')) {
            $this->ajax_refresh = TRUE;
        }
    }

}
