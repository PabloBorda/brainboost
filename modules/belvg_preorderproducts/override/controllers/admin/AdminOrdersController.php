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

class AdminOrdersController extends AdminOrdersControllerCore {

    public function postProcess() {
        // If id_order is sent, we instanciate a new Order object
        if (Tools::isSubmit('id_order') && Tools::getValue('id_order') > 0) {
            $order = new Order(Tools::getValue('id_order'));
            if (!Validate::isLoadedObject($order)) {
                throw new PrestaShopException('Can\'t load Order object');
            }
        }

        /* Update shipping number */
        if (Tools::isSubmit('submitShippingNumber') && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                $order_carrier = new OrderCarrier(Tools::getValue('id_order_carrier'));
                if (!Validate::isLoadedObject($order_carrier)) {
                    $this->errors[] = Tools::displayError('Order carrier ID is invalid');
                } elseif (!Validate::isTrackingNumber(Tools::getValue('tracking_number'))) {
                    $this->errors[] = Tools::displayError('Tracking number is incorrect');
                } else {
                    // update shipping number
                    // Keep these two following lines for backward compatibility, remove on 1.6 version
                    $order->shipping_number = Tools::getValue('tracking_number');
                    $order->update();

                    // Update order_carrier
                    $order_carrier->tracking_number = pSQL(Tools::getValue('tracking_number'));
                    if ($order_carrier->update()) {
                        // Send mail to customer
                        $customer = new Customer((int) $order->id_customer);
                        $carrier = new Carrier((int) $order->id_carrier, $order->id_lang);
                        if (!Validate::isLoadedObject($customer)) {
                            throw new PrestaShopException('Can\'t load Customer object');
                        }
                        
                        if (!Validate::isLoadedObject($carrier)) {
                            throw new PrestaShopException('Can\'t load Carrier object');
                        }
                        
                        $templateVars = array(
                            '{followup}' => str_replace('@', $order->shipping_number, $carrier->url),
                            '{firstname}' => $customer->firstname,
                            '{lastname}' => $customer->lastname,
                            '{id_order}' => $order->id
                        );
                        if (@Mail::Send((int) $order->id_lang, 'in_transit', Mail::l('Package in transit', (int) $order->id_lang), $templateVars, $customer->email, $customer->firstname . ' ' . $customer->lastname, NULL, NULL, NULL, NULL, _PS_MAIL_DIR_, TRUE)) {
                            Hook::exec('actionAdminOrdersTrackingNumberUpdate', array('order' => $order));
                            Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
                        } else {
                            $this->errors[] = Tools::displayError('An error occurred while sending e-mail to the customer.');
                        }    
                    } else {
                        $this->errors[] = Tools::displayError('Order carrier can\'t be updated');
                    }
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }    
        } elseif (Tools::isSubmit('submitState') && isset($order)) {
            /* Change order state, add a new entry in order history and send an e-mail to the customer if needed */
            if ($this->tabAccess['edit'] === '1') {
                $order_state = new OrderState(Tools::getValue('id_order_state'));

                if (!Validate::isLoadedObject($order_state)) {
                    $this->errors[] = Tools::displayError('Invalid new order status');
                } else {
                    $current_order_state = $order->getCurrentOrderState();
                    if ($current_order_state->id != $order_state->id) {
                        // Create new OrderHistory
                        $history = new OrderHistory();
                        $history->id_order = $order->id;
                        $history->id_employee = (int) $this->context->employee->id;
                        $history->changeIdOrderState($order_state->id, $order->id);

                        $carrier = new Carrier($order->id_carrier, $order->id_lang);
                        $templateVars = array();
                        if ($history->id_order_state == Configuration::get('PS_OS_SHIPPING') && $order->shipping_number) {
                            $templateVars = array('{followup}' => str_replace('@', $order->shipping_number, $carrier->url));
                        } elseif ($history->id_order_state == Configuration::get('PS_OS_CHEQUE')) {
                            $templateVars = array(
                                '{cheque_name}' => (Configuration::get('CHEQUE_NAME') ? Configuration::get('CHEQUE_NAME') : ''),
                                '{cheque_address_html}' => (Configuration::get('CHEQUE_ADDRESS') ? nl2br(Configuration::get('CHEQUE_ADDRESS')) : '')
                            );
                        } elseif ($history->id_order_state == Configuration::get('PS_OS_BANKWIRE')) {
                            $templateVars = array(
                                '{bankwire_owner}' => (Configuration::get('BANK_WIRE_OWNER') ? Configuration::get('BANK_WIRE_OWNER') : ''),
                                '{bankwire_details}' => (Configuration::get('BANK_WIRE_DETAILS') ? nl2br(Configuration::get('BANK_WIRE_DETAILS')) : ''),
                                '{bankwire_address}' => (Configuration::get('BANK_WIRE_ADDRESS') ? nl2br(Configuration::get('BANK_WIRE_ADDRESS')) : '')
                            );
                        }
                        
                        // Save all changes
                        if ($history->addWithemail(TRUE, $templateVars)) {
                            Tools::redirectAdmin(self::$currentIndex . '&id_order=' . (int) $order->id . '&vieworder&token=' . $this->token);
                        }
                        
                        $this->errors[] = Tools::displayError('An error occurred while changing the status or was unable to send e-mail to the customer.');
                    } else {
                        $this->errors[] = Tools::displayError('This order is already assigned this status');
                    }    
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }    
        } elseif (Tools::isSubmit('submitMessage') && isset($order)) {
            /* Add a new message for the current order and send an e-mail to the customer if needed */
            if ($this->tabAccess['edit'] === '1') {
                $customer = new Customer(Tools::getValue('id_customer'));
                if (!Validate::isLoadedObject($customer)) {
                    $this->errors[] = Tools::displayError('Customer is invalid');
                } elseif (!Tools::getValue('message')) {
                    $this->errors[] = Tools::displayError('Message cannot be blank');
                } else {
                    /* Get message rules and and check fields validity */
                    $rules = call_user_func(array('Message', 'getValidationRules'), 'Message');
                    foreach ($rules['required'] as $field) {
                        if (($value = Tools::getValue($field)) == FALSE && (string) $value != '0') {
                            if (!Tools::getValue('id_' . $this->table) || $field != 'passwd') {
                                $this->errors[] = Tools::displayError('field') . ' <b>' . $field . '</b> ' . Tools::displayError('is required.');
                            }
                        }
                    }
                    
                    foreach ($rules['size'] as $field => $maxLength) {
                        if (Tools::getValue($field) && Tools::strlen(Tools::getValue($field)) > $maxLength) {
                            $this->errors[] = Tools::displayError('field') . ' <b>' . $field . '</b> ' . Tools::displayError('is too long.') . ' (' . $maxLength . ' ' . Tools::displayError('chars max') . ')';
                        }
                    }
                    
                    foreach ($rules['validate'] as $field => $function) {
                        if (Tools::getValue($field)) {
                            if (!Validate::$function(htmlentities(Tools::getValue($field), ENT_COMPAT, 'UTF-8'))) {
                                $this->errors[] = Tools::displayError('field') . ' <b>' . $field . '</b> ' . Tools::displayError('is invalid.');
                            }
                        }
                    }

                    if (!count($this->errors)) {
                        //check if a thread already exist
                        $id_customer_thread = CustomerThread::getIdCustomerThreadByEmailAndIdOrder($customer->email, $order->id);
                        if (!$id_customer_thread) {
                            $customer_thread = new CustomerThread();
                            $customer_thread->id_contact = 0;
                            $customer_thread->id_customer = (int) $order->id_customer;
                            $customer_thread->id_shop = (int) $this->context->shop->id;
                            $customer_thread->id_order = (int) $order->id;
                            $customer_thread->id_lang = (int) $this->context->language->id;
                            $customer_thread->email = $customer->email;
                            $customer_thread->status = 'open';
                            $customer_thread->token = Tools::passwdGen(12);
                            $customer_thread->add();
                        } else {
                            $customer_thread = new CustomerThread((int) $id_customer_thread);
                        }    

                        $customer_message = new CustomerMessage();
                        $customer_message->id_customer_thread = $customer_thread->id;
                        $customer_message->id_employee = (int) $this->context->employee->id;
                        $customer_message->message = htmlentities(Tools::getValue('message'), ENT_COMPAT, 'UTF-8');
                        $customer_message->private = Tools::getValue('visibility');

                        if (!$customer_message->add()) {
                            $this->errors[] = Tools::displayError('An error occurred while saving message');
                        } elseif ($customer_message->private) {
                            Tools::redirectAdmin(self::$currentIndex . '&id_order=' . (int) $order->id . '&vieworder&conf=11&token=' . $this->token);
                        } else {
                            $message = $customer_message->message;
                            if (Configuration::get('PS_MAIL_TYPE') != Mail::TYPE_TEXT) {
                                $message = Tools::nl2br($customer_message->message);
                            }

                            $varsTpl = array(
                                '{lastname}' => $customer->lastname,
                                '{firstname}' => $customer->firstname,
                                '{id_order}' => $order->id,
                                '{message}' => $message
                            );
                            
                            if (@Mail::Send((int) $order->id_lang, 'order_merchant_comment', Mail::l('New message regarding your order', (int) $order->id_lang), $varsTpl, $customer->email, $customer->firstname . ' ' . $customer->lastname, NULL, NULL, NULL, NULL, _PS_MAIL_DIR_, TRUE)) {
                                Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=11' . '&token=' . $this->token);
                            }
                        }
                        
                        $this->errors[] = Tools::displayError('An error occurred while sending e-mail to the customer.');
                    }
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to delete here.');
            }
        } elseif (Tools::isSubmit('partialRefund') && isset($order)) {
            /* Partial refund from order */
            if ($this->tabAccess['edit'] == '1') {
                if (is_array($_POST['partialRefundProduct'])) {
                    $amount = 0;
                    $order_detail_list = array();
                    foreach ($_POST['partialRefundProduct'] as $id_order_detail => $amount_detail) {
                        if (isset($amount_detail) && !empty($amount_detail)) {
                            $amount += $amount_detail;
                            $order_detail_list[$id_order_detail]['quantity'] = (int) $_POST['partialRefundProductQuantity'][$id_order_detail];
                            $order_detail_list[$id_order_detail]['amount'] = (float) $amount_detail;
                        }
                    }
                    
                    $shipping_cost_amount = (float) Tools::getValue('partialRefundShippingCost');
                    if ($shipping_cost_amount > 0) {
                        $amount += $shipping_cost_amount;
                    }

                    if ($amount > 0) {
                        if (!OrderSlip::createPartialOrderSlip($order, $amount, $shipping_cost_amount, $order_detail_list)) {
                            $this->errors[] = Tools::displayError('Cannot generate partial credit slip');
                        }    
                    } else {
                        $this->errors[] = Tools::displayError('You have to write an amount if you want to do a partial credit slip');
                    }
                    
                    // Redirect if no errors
                    if (!count($this->errors)) {
                        Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=24&token=' . $this->token);
                    }    
                } else {
                    $this->errors[] = Tools::displayError('Partial refund data is incorrect');
                }    
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to delete here.');
            }    
        } elseif (Tools::isSubmit('cancelProduct') && isset($order)) {
            /* Cancel product from order */
            if ($this->tabAccess['delete'] === '1') {
                if (!Tools::isSubmit('id_order_detail')) {
                    $this->errors[] = Tools::displayError('You must select a product');
                } elseif (!Tools::isSubmit('cancelQuantity')) {
                    $this->errors[] = Tools::displayError('You must enter a quantity');
                } else {
                    $productList = Tools::getValue('id_order_detail');
                    $customizationList = Tools::getValue('id_customization');
                    $qtyList = Tools::getValue('cancelQuantity');
                    $customizationQtyList = Tools::getValue('cancelCustomizationQuantity');

                    $full_product_list = $productList;
                    $full_quantity_list = $qtyList;

                    if ($customizationList) {
                        foreach ($customizationList as $key => $id_order_detail) {
                            $full_product_list[$id_order_detail] = $id_order_detail;
                            $full_quantity_list[$id_order_detail] += $customizationQtyList[$key];
                        }
                    }    

                    if ($productList || $customizationList) {
                        if ($productList) {
                            $id_cart = Cart::getCartIdByOrderId($order->id);
                            $customization_quantities = Customization::countQuantityByCart($id_cart);

                            foreach ($productList as $key => $id_order_detail) {
                                $qtyCancelProduct = abs($qtyList[$key]);
                                if (!$qtyCancelProduct) {
                                    $this->errors[] = Tools::displayError('No quantity selected for product.');
                                }
                                
                                $order_detail = new OrderDetail($id_order_detail);
                                $customization_quantity = 0;
                                if (array_key_exists($order_detail->product_id, $customization_quantities) && array_key_exists($order_detail->product_attribute_id, $customization_quantities[$order_detail->product_id])) {
                                    $customization_quantity = (int) $customization_quantities[$order_detail->product_id][$order_detail->product_attribute_id];
                                }
                                
                                if (($order_detail->product_quantity - $customization_quantity - $order_detail->product_quantity_refunded - $order_detail->product_quantity_return) < $qtyCancelProduct) {
                                    $this->errors[] = Tools::displayError('Invalid quantity selected for product.');
                                }    
                            }
                        }
                        
                        if ($customizationList) {
                            $customization_quantities = Customization::retrieveQuantitiesFromIds(array_keys($customizationList));

                            foreach ($customizationList as $id_customization => $id_order_detail) {
                                $qtyCancelProduct = abs($customizationQtyList[$id_customization]);
                                $customization_quantity = $customization_quantities[$id_customization];

                                if (!$qtyCancelProduct) {
                                    $this->errors[] = Tools::displayError('No quantity selected for product.');
                                }
                                
                                if ($qtyCancelProduct > ($customization_quantity['quantity'] - ($customization_quantity['quantity_refunded'] + $customization_quantity['quantity_returned']))) {
                                    $this->errors[] = Tools::displayError('Invalid quantity selected for product.');
                                }    
                            }
                        }

                        if (!count($this->errors) && $productList) {
                            foreach ($productList as $key => $id_order_detail) {
                                $qty_cancel_product = abs($qtyList[$key]);
                                $order_detail = new OrderDetail((int) ($id_order_detail));

                                // Reinject product
                                if (!$order->hasBeenDelivered() || ($order->hasBeenDelivered() && Tools::isSubmit('reinjectQuantities'))) {
                                    $reinjectable_quantity = (int) $order_detail->product_quantity - (int) $order_detail->product_quantity_reinjected;
                                    $quantity_to_reinject = $qty_cancel_product > $reinjectable_quantity ? $reinjectable_quantity : $qty_cancel_product;

                                    // @since 1.5.0 : Advanced Stock Management
                                    $product_to_inject = new Product($order_detail->product_id, FALSE, $this->context->language->id, $order->id_shop);

                                    $product = new Product($order_detail->product_id);

                                    if (Configuration::get('PS_ADVANCED_STOCK_MANAGEMENT')
                                            && $product->advanced_stock_management
                                            && $order_detail->id_warehouse != 0) {
                                        $manager = StockManagerFactory::getManager();
                                        $movements = StockMvt::getNegativeStockMvts(
                                                        $order_detail->id_order, $order_detail->product_id, $order_detail->product_attribute_id, $quantity_to_reinject
                                        );

                                        foreach ($movements as $movement) {
                                            $manager->addProduct(
                                                    $order_detail->product_id, $order_detail->product_attribute_id, new Warehouse($movement['id_warehouse']), $movement['physical_quantity'], NULL, $movement['price_te'], TRUE
                                            );
                                        }
                                        
                                        StockAvailable::synchronize($order_detail->product_id);
                                    } else if ($order_detail->id_warehouse == 0) {
                                        StockAvailable::updateQuantity(
                                                $order_detail->product_id, $order_detail->product_attribute_id, $quantity_to_reinject, $order->id_shop
                                        );
                                    } else {
                                        $this->errors[] = Tools::displayError('Cannot re-stock product');
                                    }    
                                }

                                // Delete product
                                $order_detail = new OrderDetail((int) $id_order_detail);
                                if (!$order->deleteProduct($order, $order_detail, $qtyCancelProduct)) {
                                    $this->errors[] = Tools::displayError('An error occurred during deletion of the product.') . ' <span class="bold">' . $order_detail->product_name . '</span>';
                                }
                                
                                Hook::exec('actionProductCancel', array('order' => $order, 'id_order_detail' => $id_order_detail));
                            }
                        }
                        
                        if (!count($this->errors) && $customizationList) {
                            foreach ($customizationList as $id_customization => $id_order_detail) {
                                $order_detail = new OrderDetail((int) ($id_order_detail));
                                $qtyCancelProduct = abs($customizationQtyList[$id_customization]);
                                if (!$order->deleteCustomization($id_customization, $qtyCancelProduct, $order_detail)) {
                                    $this->errors[] = Tools::displayError('An error occurred during deletion of product customization.') . ' ' . $id_customization;
                                }    
                            }
                        }
                        
                        // E-mail params
                        if ((Tools::isSubmit('generateCreditSlip') || Tools::isSubmit('generateDiscount')) && !count($this->errors)) {
                            $customer = new Customer((int) ($order->id_customer));
                            $params['{lastname}'] = $customer->lastname;
                            $params['{firstname}'] = $customer->firstname;
                            $params['{id_order}'] = $order->id;
                        }

                        // Generate credit slip
                        if (Tools::isSubmit('generateCreditSlip') && !count($this->errors)) {
                            if (!OrderSlip::createOrderSlip($order, $full_product_list, $full_quantity_list, Tools::isSubmit('shippingBack'))) {
                                $this->errors[] = Tools::displayError('Cannot generate credit slip');
                            } else {
                                Hook::exec('actionOrderSlipAdd', array('order' => $order, 'productList' => $full_product_list, 'qtyList' => $full_quantity_list));
                                @Mail::Send(
                                                (int) $order->id_lang, 'credit_slip', Mail::l('New credit slip regarding your order', $order->id_lang), $params, $customer->email, $customer->firstname . ' ' . $customer->lastname, NULL, NULL, NULL, NULL, _PS_MAIL_DIR_, TRUE
                                );
                            }
                        }

                        // Generate voucher
                        if (Tools::isSubmit('generateDiscount') && !count($this->errors)) {
                            // @todo generate a voucher using cartrules
                            if (TRUE || !$voucher = Discount::createOrderDiscount($order, $full_product_list, $full_quantity_list, $this->l('Credit Slip for order #'), Tools::isSubmit('shippingBack'))) {
                                $this->errors[] = Tools::displayError('Cannot generate voucher');
                            } else {
                                $currency = $this->context->currency;
                                $params['{voucher_amount}'] = Tools::displayPrice($voucher->value, $currency, FALSE);
                                $params['{voucher_num}'] = $voucher->name;
                                @Mail::Send((int) $order->id_lang, 'voucher', Mail::l('New voucher regarding your order', (int) $order->id_lang), $params, $customer->email, $customer->firstname . ' ' . $customer->lastname, NULL, NULL, NULL, NULL, _PS_MAIL_DIR_, TRUE);
                            }
                        }
                    } else {
                        $this->errors[] = Tools::displayError('No product or quantity selected.');
                    }    

                    // Redirect if no errors
                    if (!count($this->errors)) {
                        Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=24&token=' . $this->token);
                    }    
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to delete here.');
            }    
        } elseif (Tools::isSubmit('messageReaded')) {
            Message::markAsReaded(Tools::getValue('messageReaded'), $this->context->employee->id);
        } elseif (Tools::isSubmit('submitAddPayment') && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                $amount = str_replace(',', '.', Tools::getValue('payment_amount'));
                $currency = new Currency(Tools::getValue('payment_currency'));
                $order_has_invoice = $order->hasInvoice();
                if ($order_has_invoice) {
                    $order_invoice = new OrderInvoice(Tools::getValue('payment_invoice'));
                } else {
                    $order_invoice = NULL;
                }
                
                if (!Validate::isLoadedObject($order)) {
                    $this->errors[] = Tools::displayError('Order can\'t be found');
                } elseif (!Validate::isPrice($amount)) {
                    $this->errors[] = Tools::displayError('Amount is invalid');
                } elseif (!Validate::isString(Tools::getValue('payment_method'))) {
                    $this->errors[] = Tools::displayError('Payment method is invalid');
                } elseif (!Validate::isString(Tools::getValue('payment_transaction_id'))) {
                    $this->errors[] = Tools::displayError('Transaction ID is invalid');
                } elseif (!Validate::isLoadedObject($currency)) {
                    $this->errors[] = Tools::displayError('Currency is invalid');
                } elseif ($order_has_invoice && !Validate::isLoadedObject($order_invoice)) {
                    $this->errors[] = Tools::displayError('Invoice is invalid');
                } elseif (!Validate::isDate(Tools::getValue('payment_date'))) {
                    $this->errors[] = Tools::displayError('Date is invalid');
                } else {
                    if (!$order->addOrderPayment($amount, Tools::getValue('payment_method'), Tools::getValue('payment_transaction_id'), $currency, Tools::getValue('payment_date'), $order_invoice)) {
                        $this->errors[] = Tools::displayError('An error occurred on adding order payment');
                    } else {
                        Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
                    }
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }    
        } elseif (Tools::isSubmit('submitEditNote')) {
            $note = Tools::getValue('note');
            $order_invoice = new OrderInvoice((int) Tools::getValue('id_order_invoice'));
            if (Validate::isLoadedObject($order_invoice) && Validate::isCleanHtml($note)) {
                if ($this->tabAccess['edit'] === '1') {
                    $order_invoice->note = $note;
                    if ($order_invoice->save()) {
                        Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order_invoice->id_order . '&vieworder&conf=4&token=' . $this->token);
                    } else {
                        $this->errors[] = Tools::displayError('Unable to save invoice note.');
                    }    
                } else {
                    $this->errors[] = Tools::displayError('You do not have permission to edit here.');
                }    
            } else {
                $this->errors[] = Tools::displayError('Unable to load invoice for edit note.');
            }    
        } elseif (Tools::isSubmit('submitAddOrder') && ($id_cart = Tools::getValue('id_cart')) &&
                ($module_name = Tools::getValue('payment_module_name')) &&
                ($id_order_state = Tools::getValue('id_order_state'))) {
            if ($this->tabAccess['edit'] === '1') {
                $payment_module = Module::getInstanceByName($module_name);
                $cart = new Cart((int) $id_cart);

                $payment_module->validateOrder((int) $cart->id, (int) $id_order_state, $cart->getOrderTotal(TRUE, Cart::BOTH), $payment_module->displayName, sprintf($this->l('Manual order - ID Employee :%d'), (int) Context::getContext()->cookie->id_employee), array(), NULL, FALSE, $cart->secure_key);

                /* BELVG PREORDER --begin */
                require_once(_PS_MODULE_DIR_ . "belvg_preorderproducts/belvg_preorderproducts.php");
                $products = $cart->getProducts();
                $preorder_fl = FALSE;
                foreach ($products as $product) {
                    if ($preorder_id = ProductPreorder::checkActiveStatic($product['id_product'], $product['id_product_attribute'])) {
                        $preorder_init_product_obj = $product;
                        $preorder_fl = TRUE;
                        //$exits_qty = $preorder_init_product_obj['product_quantity_in_stock'];
                        break;
                    }
                }

                if ($preorder_fl) {
                    $objOrder = new Order($payment_module->currentOrder);
                    Belvg_PreOrderProducts::checkPreorder($objOrder);
                    //$id_order_state = Configuration::get('belvg_pp_status_id');
                }

                /* BELVG PREORDER --end */

                if ($payment_module->currentOrder) {
                    Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $payment_module->currentOrder . '&vieworder' . '&token=' . $this->token);
                }    
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to add here.');
            }    
        } elseif ((Tools::isSubmit('submitAddressShipping') || Tools::isSubmit('submitAddressInvoice')) && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                $address = new Address(Tools::getValue('id_address'));
                if (Validate::isLoadedObject($address)) {
                    // Update the address on order
                    if (Tools::isSubmit('submitAddressShipping')) {
                        $order->id_address_delivery = $address->id;
                    } elseif (Tools::isSubmit('submitAddressInvoice')) {
                        $order->id_address_invoice = $address->id;
                    }
                    
                    $order->update();
                    Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
                } else {
                    $this->errors[] = Tools::displayErrror('This address can\'t be loaded');
                }    
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }
        } elseif (Tools::isSubmit('submitChangeCurrency') && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                if (Tools::getValue('new_currency') != $order->id_currency && !$order->valid) {
                    $old_currency = new Currency($order->id_currency);
                    $currency = new Currency(Tools::getValue('new_currency'));
                    if (!Validate::isLoadedObject($currency)) {
                        throw new PrestaShopException('Can\'t load Currency object');
                    }
                    
                    // Update order detail amount
                    foreach ($order->getOrderDetailList() as $row) {
                        $order_detail = new OrderDetail($row['id_order_detail']);
                        $order_detail->product_price = Tools::convertPriceFull($order_detail->product_price, $old_currency, $currency);
                        $order_detail->reduction_amount = Tools::convertPriceFull($order_detail->reduction_amount, $old_currency, $currency);
                        $order_detail->unit_price_tax_incl = Tools::convertPriceFull($order_detail->unit_price_tax_incl, $old_currency, $currency);
                        $order_detail->unit_price_tax_excl = Tools::convertPriceFull($order_detail->unit_price_tax_excl, $old_currency, $currency);
                        $order_detail->total_price_tax_incl = Tools::convertPriceFull($order_detail->product_price, $old_currency, $currency);
                        $order_detail->total_price_tax_excl = Tools::convertPriceFull($order_detail->product_price, $old_currency, $currency);
                        $order_detail->group_reduction = Tools::convertPriceFull($order_detail->product_price, $old_currency, $currency);
                        $order_detail->product_quantity_discount = Tools::convertPriceFull($order_detail->product_price, $old_currency, $currency);

                        $order_detail->update();
                    }

                    $id_order_carrier = Db::getInstance()->getValue('
						SELECT `id_order_carrier`
						FROM `' . _DB_PREFIX_ . 'order_carrier`
						WHERE `id_order` = ' . (int) $order->id);
                    $order_carrier = new OrderCarrier($id_order_carrier);
                    $order_carrier->shipping_cost_tax_excl = (float) Tools::convertPriceFull($order_carrier->shipping_cost_tax_excl, $old_currency, $currency);
                    $order_carrier->shipping_cost_tax_incl = (float) Tools::convertPriceFull($order_carrier->shipping_cost_tax_incl, $old_currency, $currency);
                    $order_carrier->update();

                    // Update order amount
                    $order->total_discounts = Tools::convertPriceFull($order->total_discounts, $old_currency, $currency);
                    $order->total_discounts_tax_incl = Tools::convertPriceFull($order->total_discounts_tax_incl, $old_currency, $currency);
                    $order->total_discounts_tax_excl = Tools::convertPriceFull($order->total_discounts_tax_excl, $old_currency, $currency);
                    $order->total_paid = Tools::convertPriceFull($order->total_paid, $old_currency, $currency);
                    $order->total_paid_tax_incl = Tools::convertPriceFull($order->total_paid_tax_incl, $old_currency, $currency);
                    $order->total_paid_tax_excl = Tools::convertPriceFull($order->total_discounts_tax_excl, $old_currency, $currency);
                    $order->total_paid_real = Tools::convertPriceFull($order->total_paid_real, $old_currency, $currency);
                    $order->total_products = Tools::convertPriceFull($order->total_products, $old_currency, $currency);
                    $order->total_products_wt = Tools::convertPriceFull($order->total_products_wt, $old_currency, $currency);
                    $order->total_shipping = Tools::convertPriceFull($order->total_shipping, $old_currency, $currency);
                    $order->total_shipping_tax_incl = Tools::convertPriceFull($order->total_shipping_tax_incl, $old_currency, $currency);
                    $order->total_shipping_tax_excl = Tools::convertPriceFull($order->total_shipping_tax_excl, $old_currency, $currency);
                    $order->total_wrapping = Tools::convertPriceFull($order->total_wrapping, $old_currency, $currency);
                    $order->total_wrapping_tax_incl = Tools::convertPriceFull($order->total_wrapping_tax_incl, $old_currency, $currency);
                    $order->total_wrapping_tax_excl = Tools::convertPriceFull($order->total_wrapping_tax_excl, $old_currency, $currency);

                    // Update currency in order
                    $order->id_currency = $currency->id;

                    $order->update();
                } else {
                    $this->errors[] = Tools::displayError('You cannot change the currency');
                }    
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }    
        } elseif (Tools::isSubmit('submitGenerateInvoice') && isset($order)) {
            if ($order->hasInvoice()) {
                $this->errors[] = Tools::displayError('This order already has an invoice');
            } else {
                $order->setInvoice();
                Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
            }
        } elseif (Tools::isSubmit('submitDeleteVoucher') && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                $order_cart_rule = new OrderCartRule(Tools::getValue('id_order_cart_rule'));
                if (Validate::isLoadedObject($order_cart_rule) && $order_cart_rule->id_order == $order->id) {
                    if ($order_cart_rule->id_order_invoice) {
                        $order_invoice = new OrderInvoice($order_cart_rule->id_order_invoice);
                        if (!Validate::isLoadedObject($order_invoice)) {
                            throw new PrestaShopException('Can\'t load Order Invoice object');
                        }
                        
                        // Update amounts of Order Invoice
                        $order_invoice->total_discount_tax_excl -= $order_cart_rule->value_tax_excl;
                        $order_invoice->total_discount_tax_incl -= $order_cart_rule->value;

                        $order_invoice->total_paid_tax_excl += $order_cart_rule->value_tax_excl;
                        $order_invoice->total_paid_tax_incl += $order_cart_rule->value;

                        // Update Order Invoice
                        $order_invoice->update();
                    }

                    // Update amounts of order
                    $order->total_discounts -= $order_cart_rule->value;
                    $order->total_discounts_tax_incl -= $order_cart_rule->value;
                    $order->total_discounts_tax_excl -= $order_cart_rule->value_tax_excl;

                    $order->total_paid += $order_cart_rule->value;
                    $order->total_paid_tax_incl += $order_cart_rule->value;
                    $order->total_paid_tax_excl += $order_cart_rule->value_tax_excl;

                    // Delete Order Cart Rule and update Order
                    $order_cart_rule->delete();
                    $order->update();
                    Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
                } else {
                    $this->errors[] = Tools::displayError('Cannot edit this Order Cart Rule');
                }    
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }    
        } elseif (Tools::getValue('submitNewVoucher') && isset($order)) {
            if ($this->tabAccess['edit'] === '1') {
                if (!Tools::getValue('discount_name')) {
                    $this->errors[] = Tools::displayError('You must specify a name in order to create a new discount');
                } else {
                    if ($order->hasInvoice()) {
                        // If the discount is for only one invoice
                        if (!Tools::isSubmit('discount_all_invoices')) {
                            $order_invoice = new OrderInvoice(Tools::getValue('discount_invoice'));
                            if (!Validate::isLoadedObject($order_invoice)) {
                                throw new PrestaShopException('Can\'t load Order Invoice object');
                            }    
                        }
                    }

                    $cart_rules = array();
                    switch (Tools::getValue('discount_type')) {
                        // Percent type
                        case 1:
                            if (Tools::getValue('discount_value') < 100) {
                                if (isset($order_invoice)) {
                                    $cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round($order_invoice->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
                                    $cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round($order_invoice->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);

                                    // Update OrderInvoice
                                    $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                } elseif ($order->hasInvoice()) {
                                    $order_invoices_collection = $order->getInvoicesCollection();
                                    foreach ($order_invoices_collection as $order_invoice) {
                                        $cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round($order_invoice->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
                                        $cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round($order_invoice->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);

                                        // Update OrderInvoice
                                        $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                    }
                                } else {
                                    $cart_rules[0]['value_tax_incl'] = Tools::ps_round($order->total_paid_tax_incl * Tools::getValue('discount_value') / 100, 2);
                                    $cart_rules[0]['value_tax_excl'] = Tools::ps_round($order->total_paid_tax_excl * Tools::getValue('discount_value') / 100, 2);
                                }
                            } else {
                                $this->errors[] = Tools::displayError('Discount value is invalid');
                            }
                            break;
                            
                        // Amount type
                        case 2:
                            if (isset($order_invoice)) {
                                if (Tools::getValue('discount_value') > $order_invoice->total_paid_tax_incl) {
                                    $this->errors[] = Tools::displayError('Discount value is greater than the order invoice total');
                                } else {
                                    $cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
                                    $cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);

                                    // Update OrderInvoice
                                    $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                }
                            } elseif ($order->hasInvoice()) {
                                $order_invoices_collection = $order->getInvoicesCollection();
                                foreach ($order_invoices_collection as $order_invoice) {
                                    if (Tools::getValue('discount_value') > $order_invoice->total_paid_tax_incl) {
                                        $this->errors[] = Tools::displayError('Discount value is greater than the order invoice total (Invoice:') . $order_invoice->getInvoiceNumberFormatted(Context::getContext()->language->id) . ')';
                                    } else {
                                        $cart_rules[$order_invoice->id]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
                                        $cart_rules[$order_invoice->id]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);

                                        // Update OrderInvoice
                                        $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                    }
                                }
                            } else {
                                if (Tools::getValue('discount_value') > $order->total_paid_tax_incl) {
                                    $this->errors[] = Tools::displayError('Discount value is greater than the order total');
                                } else {
                                    $cart_rules[0]['value_tax_incl'] = Tools::ps_round(Tools::getValue('discount_value'), 2);
                                    $cart_rules[0]['value_tax_excl'] = Tools::ps_round(Tools::getValue('discount_value') / (1 + ($order->getTaxesAverageUsed() / 100)), 2);
                                }
                            }
                            break;
                            
                        // Free shipping type
                        case 3:
                            if (isset($order_invoice)) {
                                if ($order_invoice->total_shipping_tax_incl > 0) {
                                    $cart_rules[$order_invoice->id]['value_tax_incl'] = $order_invoice->total_shipping_tax_incl;
                                    $cart_rules[$order_invoice->id]['value_tax_excl'] = $order_invoice->total_shipping_tax_excl;

                                    // Update OrderInvoice
                                    $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                }
                            } elseif ($order->hasInvoice()) {
                                $order_invoices_collection = $order->getInvoicesCollection();
                                foreach ($order_invoices_collection as $order_invoice) {
                                    if ($order_invoice->total_shipping_tax_incl <= 0) {
                                        continue;
                                    }
                                    
                                    $cart_rules[$order_invoice->id]['value_tax_incl'] = $order_invoice->total_shipping_tax_incl;
                                    $cart_rules[$order_invoice->id]['value_tax_excl'] = $order_invoice->total_shipping_tax_excl;

                                    // Update OrderInvoice
                                    $this->applyDiscountOnInvoice($order_invoice, $cart_rules[$order_invoice->id]['value_tax_incl'], $cart_rules[$order_invoice->id]['value_tax_excl']);
                                }
                            } else {
                                $cart_rules[0]['value_tax_incl'] = $order->total_shipping_tax_incl;
                                $cart_rules[0]['value_tax_excl'] = $order->total_shipping_tax_excl;
                            }
                            break;
                            
                        default:
                            $this->errors[] = Tools::displayError('Discount type is invalid');
                            break;
                    }

                    $res = TRUE;
                    foreach ($cart_rules as &$cart_rule) {
                        $cartRuleObj = new CartRule();
                        $cartRuleObj->date_from = date('Y-m-d H:i:s', strtotime('-1 hour', strtotime($order->date_add)));
                        $cartRuleObj->date_to = date('Y-m-d H:i:s', strtotime('+1 hour'));
                        $cartRuleObj->name[Configuration::get('PS_LANG_DEFAULT')] = Tools::getValue('discount_name');
                        $cartRuleObj->quantity = 0;
                        $cartRuleObj->quantity_per_user = 1;
                        if (Tools::getValue('discount_type') == 1) {
                            $cartRuleObj->reduction_percent = Tools::getValue('discount_value');
                        } elseif (Tools::getValue('discount_type') == 2) {
                            $cartRuleObj->reduction_amount = $cart_rule['value_tax_excl'];
                        } elseif (Tools::getValue('discount_type') == 3) {
                            $cartRuleObj->free_shipping = 1;
                        } 
                        
                        $cartRuleObj->active = 0;
                        if ($res = $cartRuleObj->add()) {
                            $cart_rule['id'] = $cartRuleObj->id;
                        } else {
                            break;
                        }
                    }

                    if ($res) {
                        foreach ($cart_rules as $id_order_invoice => $cart_rule) {
                            // Create OrderCartRule
                            $order_cart_rule = new OrderCartRule();
                            $order_cart_rule->id_order = $order->id;
                            $order_cart_rule->id_cart_rule = $cart_rule['id'];
                            $order_cart_rule->id_order_invoice = $id_order_invoice;
                            $order_cart_rule->name = Tools::getValue('discount_name');
                            $order_cart_rule->value = $cart_rule['value_tax_incl'];
                            $order_cart_rule->value_tax_excl = $cart_rule['value_tax_excl'];
                            $res &= $order_cart_rule->add();

                            $order->total_discounts += $order_cart_rule->value;
                            $order->total_discounts_tax_incl += $order_cart_rule->value;
                            $order->total_discounts_tax_excl += $order_cart_rule->value_tax_excl;
                            $order->total_paid -= $order_cart_rule->value;
                            $order->total_paid_tax_incl -= $order_cart_rule->value;
                            $order->total_paid_tax_excl -= $order_cart_rule->value_tax_excl;
                        }

                        // Update Order
                        $res &= $order->update();
                    }

                    if ($res) {
                        Tools::redirectAdmin(self::$currentIndex . '&id_order=' . $order->id . '&vieworder&conf=4&token=' . $this->token);
                    } else {
                        $this->errors[] = Tools::displayError('An error occurred on OrderCartRule creation');
                    }    
                }
            } else {
                $this->errors[] = Tools::displayError('You do not have permission to edit here.');
            }
        }

        parent::postProcess();
    }

}

?>
