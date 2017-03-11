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

class Belvg_PreOrderProductsMywaitlistModuleFrontController extends ModuleFrontController {

    public $auth = TRUE;
    public $authRedirection = 'mywaitlist';
    public $ssl = TRUE;
	public $display_column_left = FALSE;

    public function __construct() {
        parent::__construct();

        $this->context = Context::getContext();

        require_once(dirname(__FILE__) . '/../../classes/ProductPreorder.php');
        require_once(dirname(__FILE__) . '/../../classes/ProductWait.php');
    }

    /**
     * @see FrontController::initContent()
     */
    public function initContent() {
        parent::initContent();

        $errors = '';
        $delete = Tools::getValue('deleted');
        $id_customer = $this->context->cookie->id_customer;
        $id_belvg_preorder_wait = Tools::getValue('id_wait', NULL);
        if ($delete && !empty($id_customer) && !empty($id_belvg_preorder_wait)) {
            $waitObj = new ProductWait($id_belvg_preorder_wait);
            if (empty($waitObj->id) || !$waitObj->delProductById($id_belvg_preorder_wait)) {
                //DELETE FROM `belvg_preorder_wait_product`
                $errors = Tools::displayError('Cannot delete this product');
            }
        }

        $waitlist = ProductWait::getProductByIdCustomer($this->context->cookie->id_customer, $this->context->cookie->id_lang);

        $this->context->smarty->assign(array(
            'waitlist_errors' => $errors,
            'waitlist' => $waitlist,
            'nbProducts' => count($waitlist),
            'id_customer' => $id_customer,
        ));

        $this->setTemplate('mywaitlist.tpl');
    }

}
