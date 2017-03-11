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

/* Wait: block */
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_wait` (
              `id_belvg_preorder_wait` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_product` int(11) unsigned NOT NULL,
              `id_product_attribute` int(11) unsigned NOT NULL DEFAULT \'0\',
              `id_shop` int(11) unsigned NOT NULL,
              `email` varchar(128) NOT NULL,
              `id_customer` int(10) unsigned NOT NULL,
              `id_lang` int(10) unsigned NOT NULL,
              `fl_mail` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
              `date_add` datetime NOT NULL,
              `date_upd` datetime NOT NULL,
              PRIMARY KEY (`id_belvg_preorder_wait`)
            ) ENGINE=' . _MYSQL_ENGINE_ . '  DEFAULT CHARSET=utf8';

/* Wait: mail */
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_wait_mail` (
              `id_belvg_preorder_wait_mail` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_belvg_preorder_wait` int(10) unsigned NOT NULL,
              `date_add` datetime NOT NULL,
              `date_upd` datetime NOT NULL,
              PRIMARY KEY (`id_belvg_preorder_wait_mail`),
              KEY `id_belvg_preorder_wait` (`id_belvg_preorder_wait`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

/* Preorder: products */
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_product` (
              `id_belvg_preorder_product` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_product` int(10) unsigned NOT NULL,
              `id_product_attribute` int(10) unsigned NOT NULL DEFAULT \'0\',
              `id_shop` int(11) unsigned NOT NULL,
              `quantity` int(10) NOT NULL DEFAULT \'1000\',
              `expire_datetime` datetime NOT NULL,
              `date_avaliable` varchar(10) NOT NULL,
              `hourcombo` int(2) NOT NULL,
              `mincombo` int(2) NOT NULL,
              `seccombo` int(2) NOT NULL,
              `countdown_active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
              `active` tinyint(1) unsigned NOT NULL DEFAULT \'0\',
              `date_add` datetime NOT NULL,
              `date_upd` datetime NOT NULL,
              PRIMARY KEY (`id_belvg_preorder_product`,`id_product`,`id_product_attribute`,`id_shop`),
              UNIQUE KEY `BELVG_UNIQ_PP_INDEX` (`id_product`,`id_product_attribute`,`id_shop`)
            ) ENGINE=' . _MYSQL_ENGINE_ . '  DEFAULT CHARSET=utf8';

/* Preorder: orders */
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_order` (
              `id_preorder_order` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_order` int(10) unsigned NOT NULL,
              `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
              `date_add` datetime NOT NULL,
              `date_upd` datetime NOT NULL,
              PRIMARY KEY (`id_preorder_order`)
            ) ENGINE=' . _MYSQL_ENGINE_ . ' DEFAULT CHARSET=utf8';

/* Preorder: order_products */
$sql[] = 'CREATE TABLE IF NOT EXISTS `' . _DB_PREFIX_ . 'belvg_preorder_order_product` (
              `id_preorder_order_product` int(10) unsigned NOT NULL AUTO_INCREMENT,
              `id_preorder_order` int(10) unsigned NOT NULL,
              `id_belvg_preorder_product` int(10) unsigned NOT NULL,
              `product_id` int(10) unsigned NOT NULL,
              `product_attribute_id` int(10) unsigned NOT NULL,
              `active` tinyint(1) unsigned NOT NULL DEFAULT \'1\',
              `date_add` datetime NOT NULL,
              `date_upd` datetime NOT NULL,
              PRIMARY KEY (`id_preorder_order_product`)
            ) ENGINE=' . _MYSQL_ENGINE_ . '  DEFAULT CHARSET=utf8';

