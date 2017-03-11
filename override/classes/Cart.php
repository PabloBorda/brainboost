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
class Cart extends CartCore {
    /*
    * module: belvg_preorderproducts
    * date: 2016-08-26 12:34:57
    * version: 3.1.0
    */
    public function checkQuantities() {
        require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");
        if (Configuration::get('PS_CATALOG_MODE')) {
            return FALSE;
        }
        foreach ($this->getProducts() as $product) {
            if (!$product['active']
                    || (
                    !$product['allow_oosp'] && $product['stock_quantity'] < $product['cart_quantity']
                    AND ($product['cart_quantity'] > ProductPreorder::getAvailablePreorderQty($product['id_product'], $product['id_product_attribute']))
                    )
                    || !$product['available_for_order']) {
                return FALSE;
            }
        }
        return TRUE;
    }
    /*
    * module: belvg_preorderproducts
    * date: 2016-08-26 12:34:57
    * version: 3.1.0
    */
    public function updateQty($quantity, $id_product, $id_product_attribute = NULL, $id_customization = FALSE, $operator = 'up', $id_address_delivery = 0, Shop $shop = NULL, $auto_add_cart_rule = TRUE) {
        require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/classes/ProductPreorder.php");
        if (!$shop) {
            $shop = Context::getContext()->shop;
        }
        
        if (Context::getContext()->customer->id) {
            if ($id_address_delivery == 0 && (int) $this->id_address_delivery) {
                $id_address_delivery = $this->id_address_delivery;
            } elseif ($id_address_delivery == 0) {
                $id_address_delivery = (int) Address::getFirstCustomerAddressId((int) Context::getContext()->customer->id);
            } elseif (!Customer::customerHasAddress(Context::getContext()->customer->id, $id_address_delivery)) {
                $id_address_delivery = 0;
            }
        }
        $quantity = (int) $quantity;
        $id_product = (int) $id_product;
        $id_product_attribute = (int) $id_product_attribute;
        $product = new Product($id_product, FALSE, Configuration::get('PS_LANG_DEFAULT'), $shop->id);
        if ($id_product_attribute) {
            $combination = new Combination((int) $id_product_attribute);
            if ($combination->id_product != $id_product) {
                return FALSE;
            }
        }
        
        if (!empty($id_product_attribute)) {
            $minimal_quantity = (int) Attribute::getAttributeMinimalQty($id_product_attribute);
        } else {
            $minimal_quantity = (int) $product->minimal_quantity;
        }
        
        if (!Validate::isLoadedObject($product)) {
            die(Tools::displayError());
        }
        
        if (isset(self::$_nbProducts[$this->id])) {
            unset(self::$_nbProducts[$this->id]);
        }
        if (isset(self::$_totalWeight[$this->id])) {
            unset(self::$_totalWeight[$this->id]);
        }
        if ((int) $quantity <= 0) {
            return $this->deleteProduct($id_product, $id_product_attribute, (int) $id_customization);
        } elseif (!$product->available_for_order || Configuration::get('PS_CATALOG_MODE')) {
            return FALSE;
        } else {
            
            $result = $this->containsProduct($id_product, $id_product_attribute, (int) $id_customization, (int) $id_address_delivery);
            
            if ($result) {
                if ($operator == 'up') {
                    $sql = 'SELECT stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity
							FROM ' . _DB_PREFIX_ . 'product p
							' . Product::sqlStock('p', $id_product_attribute, TRUE, $shop) . '
							WHERE p.id_product = ' . $id_product;
                    $result2 = Db::getInstance()->getRow($sql);
                    $product_qty = (int) $result2['quantity'];
                    if (Pack::isPack($id_product)) {
                        $product_qty = Pack::getQuantity($id_product, $id_product_attribute);
                    }
                    
                    $new_qty = (int) $result['quantity'] + (int) $quantity;
                    $qty = '+ ' . (int) $quantity;
                    if (!Product::isAvailableWhenOutOfStock((int) $result2['out_of_stock']) AND ($new_qty > ProductPreorder::getAvailablePreorderQty($id_product, $id_product_attribute))) {
                        if ($new_qty > $product_qty) {
                            return FALSE;
                        }
                    }
                } elseif ($operator == 'down') {
                    $qty = '- ' . (int) $quantity;
                    $new_qty = (int) $result['quantity'] - (int) $quantity;
                    if ($new_qty < $minimal_quantity && $minimal_quantity > 1) {
                        return -1;
                    }
                } else {
                    return FALSE;
                }
                
                
                if ($new_qty <= 0) {
                    return $this->deleteProduct((int) $id_product, (int) $id_product_attribute, (int) $id_customization);
                } else if ($new_qty < $minimal_quantity) {
                    return -1;
                } else {
                    Db::getInstance()->execute('
						UPDATE `' . _DB_PREFIX_ . 'cart_product`
						SET `quantity` = `quantity` ' . $qty . ', `date_add` = NOW()
						WHERE `id_product` = ' . (int) $id_product .
                            (!empty($id_product_attribute) ? ' AND `id_product_attribute` = ' . (int) $id_product_attribute : '') . '
						AND `id_cart` = ' . (int) $this->id . (Configuration::get('PS_ALLOW_MULTISHIPPING') && $this->isMultiAddressDelivery() ? ' AND `id_address_delivery` = ' . (int) $id_address_delivery : '') . '
						LIMIT 1'
                    );
                }
            } elseif ($operator == 'up') {
                
                $sql = 'SELECT stock.out_of_stock, IFNULL(stock.quantity, 0) as quantity
						FROM ' . _DB_PREFIX_ . 'product p
						' . Product::sqlStock('p', $id_product_attribute, TRUE, $shop) . '
						WHERE p.id_product = ' . $id_product;
                $result2 = Db::getInstance()->getRow($sql);
                if (Pack::isPack($id_product)) {
                    $result2['quantity'] = Pack::getQuantity($id_product, $id_product_attribute);
                }
                
                if (!Product::isAvailableWhenOutOfStock((int) $result2['out_of_stock']) AND ($quantity > ProductPreorder::getAvailablePreorderQty($id_product, $id_product_attribute))) {
                    if ((int) $quantity > $result2['quantity']) {
                        return FALSE;
                    }
                }
                if ((int) $quantity < $minimal_quantity) {
                    return -1;
                }
                $result_add = Db::getInstance()->insert('cart_product', array(
                    'id_product' => (int) $id_product,
                    'id_product_attribute' => (int) $id_product_attribute,
                    'id_cart' => (int) $this->id,
                    'id_address_delivery' => (int) $id_address_delivery,
                    'id_shop' => $shop->id,
                    'quantity' => (int) $quantity,
                    'date_add' => date('Y-m-d H:i:s')
                        ));
                if (!$result_add) {
                    return FALSE;
                }
            }
        }
        $this->_products = $this->getProducts(TRUE);
        $this->update(TRUE);
        $context = Context::getContext()->cloneContext();
        $context->cart = $this;
        if ($auto_add_cart_rule) {
            CartRule::autoAddToCart($context);
        }
        
        if ($product->customizable) {
            return $this->_updateCustomizationQuantity((int) $quantity, (int) $id_customization, (int) $id_product, (int) $id_product_attribute, (int) $id_address_delivery, $operator);
        } else {
            return TRUE;
        }
    }
}