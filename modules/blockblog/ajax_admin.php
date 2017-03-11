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

$HTTP_X_REQUESTED_WITH = isset($_SERVER['HTTP_X_REQUESTED_WITH'])?$_SERVER['HTTP_X_REQUESTED_WITH']:'';
if($HTTP_X_REQUESTED_WITH != 'XMLHttpRequest') {
    exit;
}
include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

ob_start(); 
$status = 'success';
$message = '';

$action = Tools::getValue('action');
$module_name = 'blockblog';


if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$module_name.'/backward_compatibility/backward.php');
} else{
	$cookie = Context::getContext()->cookie;
	$smarty = Context::getContext()->smarty;

}



include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();

switch ($action){


    case 'active':
        $id = (int)Tools::getValue('id');
        $value = (int)Tools::getValue('value');
        if($value == 0){
            $value = 1;
        } else {
            $value = 0;
        }
        $type_action = Tools::getValue('type_action');

        switch($type_action){
            case 'category':
                $obj_blog->updateCategoryStatus(array('id'=>$id,'status'=>$value));
            break;
            case 'post':
                $obj_blog->updatePostStatus(array('id'=>$id,'status'=>$value));
            break;
            case 'comment':
                $obj_blog->updateCommentStatus(array('id'=>$id,'status'=>$value));
            break;
        }



    break;


	default:
		$status = 'error';
		$message = 'Unknown parameters!';
	break;
}

$response = new stdClass();
$content = ob_get_clean();
$response->status = $status;
$response->message = $message;	
$response->params = array('content' => $content);


echo Tools::jsonEncode($response);


