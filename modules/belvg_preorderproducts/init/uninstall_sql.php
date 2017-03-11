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
// Init
$sql = array();


$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_wait`';

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_wait_mail`';

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_product`';

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_order`';

$sql[] = 'DROP TABLE IF EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_order_product`';