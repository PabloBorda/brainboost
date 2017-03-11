<?php
/**
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*/

$sql = array();

$sql[] = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'social_login_customer`(
`id_customer` int(10) unsigned NOT NULL,
`user_code` varchar(255) CHARACTER SET utf8 NOT NULL,
`name` varchar(255) CHARACTER SET utf8 NOT NULL,
`id_shop` int(10) unsigned NOT NULL)
ENGINE='._MYSQL_ENGINE_.' DEFAULT CHARSET=utf8;';

$sql[] = 'ALTER TABLE `'._DB_PREFIX_.'social_login_customer` ADD PRIMARY KEY (`id_customer`, `user_code`, `name`)';

$sql[] = 'ALTER TABLE `'._DB_PREFIX_.'social_login_customer` ADD INDEX (`id_shop`)';

$result = true;
foreach ($sql as $query) {
    $result = $result && Db::getInstance()->execute($query);
}

return $result;
