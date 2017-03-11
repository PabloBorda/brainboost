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
include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();


include_once(dirname(__FILE__).'/blockblog.php');
$obj_blockblog = new blockblog();

$name_module = 'blockblog';
		

if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$name_module.'/backward_compatibility/backward.php');
} else{
	$smarty = Context::getContext()->smarty;

}

$action = Tools::getValue('action');

$_is_friendly_url = $obj_blog->isURLRewriting();
$_iso_lng = $obj_blog->getLangISO();

if(version_compare(_PS_VERSION_, '1.6', '>')){
 	 $_is16 = 1;
} else {
	$_is16 = 0;
}
$smarty->assign($name_module.'is16', $_is16);
		
switch ($action){

	case 'addcomment':
		$_html = '';
		$error_type = 0;
		
		$codeCaptcha = Tools::strlen(Tools::getValue('captcha'))>0?Tools::getValue('captcha'):'';
		//$cookie = new Cookie('captcha');
		//$code = $cookie->secure_code;

        if (version_compare(_PS_VERSION_, '1.5', '<')) {
            $data_code = getcookie_blockblog();
            $code = $data_code['code'];
        } else {
            $cookie = new Cookie($name_module);
            $code = $cookie->secure_code_blockblog;
        }
		
		
		
		$id_post = (int) Tools::getValue('id_post');
		$name = strip_tags(trim(htmlspecialchars(Tools::getValue('name'))));
		$email = trim(Tools::getValue('email'));
		$text_review = strip_tags(trim(htmlspecialchars(Tools::getValue('text_review'))));
		
		if(!preg_match("/[0-9a-z-_]+@[0-9a-z-_^\.]+\.[a-z]{2,4}/i", $email)) {
		    $error_type = 2;
			$status = 'error';
		 }
		 
		 if($error_type == 0 && Tools::strlen($name)==0){
			$error_type = 1;
			$status = 'error';
		 }
		 		 
		 if($error_type == 0 && Tools::strlen($text_review)==0){
			$error_type = 3;
			$status = 'error';
		 }
		 
		 if($code != $codeCaptcha){
			$error_type = 4;
			$status = 'error';
		}
		
		
		 if($error_type == 0){
			//insert review
			$_data = array('name' => $name,
						   'email' => $email,
						   'text_review' => $text_review,
						   'id_post' => $id_post
						   );
			$obj_blog->saveComment($_data);
			
		 }
		
		
	break;
    case 'deleteimg':
        if($obj_blockblog->is_demo){
            $status = 'error';
            $message = 'Feature disabled on the demo mode!';
        } else {
            $item_id = Tools::getValue('item_id');
            $obj_blog->deleteImg(array('id' => $item_id));
        }
	break;
    case 'like':
        $ip = $_SERVER['REMOTE_ADDR'];
        $like = (int)Tools::getValue('like');
        $id = (int)Tools::getValue('id');

        $data = $obj_blog->like(array('id'=>$id,'like'=>$like,'ip'=>$ip));
        $status = $data['error'];
        $message = $data['message'];
        $count = $data['count'];

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
if($action == "addcomment"){
	$response->params = array('content' => $_html,
							  'error_type' => $error_type
							  );
} elseif($action == 'like')
    $response->params = array('content' => $content, 'count'=>$count);
else
	$response->params = array('content' => $content);
echo Tools::jsonEncode($response);

?>