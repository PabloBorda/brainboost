<?php
/**
 * StorePrestaModules SPM LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
/*
 *
 * @author    StorePrestaModules SPM
 * @category content_management
 * @package blockblog
 * @copyright Copyright StorePrestaModules SPM
 * @license   StorePrestaModules SPM
 */

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');


$name = "blockblog";
$token = Tools::getValue('token');

if(md5($name._PS_BASE_URL_) == $token){

    include_once(dirname(__FILE__).'/classes/blog.class.php');
    $obj_blog = new blog();

    $obj_blog->generateSitemap();


} else {
    echo 'Error: Access denien! Invalid token!';
}


