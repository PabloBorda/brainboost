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

$_GET['controller'] = 'all'; 
$_GET['fc'] = 'module';
$_GET['module'] = 'blockblog';
require_once(dirname(__FILE__).'/../../config/config.inc.php');
require_once(dirname(__FILE__).'/../../init.php');



include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();


$name_module = 'blockblog';

if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$name_module.'/backward_compatibility/backward.php');
} else{
	$smarty = Context::getContext()->smarty;
}

include_once(dirname(__FILE__).'/blockblog.php');
$obj_blockblog = new blockblog();
$_data_translate = $obj_blockblog->translateItems();

$obj_blockblog->setSEOUrls();


$smarty->assign('meta_title' , $_data_translate['meta_title_categories']);
$smarty->assign('meta_description' , $_data_translate['meta_description_categories']);
$smarty->assign('meta_keywords' , $_data_translate['meta_keywords_categories']);



if(version_compare(_PS_VERSION_, '1.6', '>')){
 	$smarty->assign($name_module.'is16' , 1);
} else {
 	$smarty->assign($name_module.'is16' , 0);
}



$smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
$smarty->assign($name_module.'cat_list_display_date', Configuration::get($name_module.'cat_list_display_date'));

if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
  				if (isset(Context::getContext()->controller)) {
					$oController = Context::getContext()->controller;
				}
				else {
					$oController = new FrontController();
					$oController->init();
				}
				if(Configuration::get($name_module.'urlrewrite_on') == 1){
					$smarty->assign('page_name' , "blockblog-categories");
				} else {
					$page_name = str_replace(array('.php', '/'), array('', '-'),$_SERVER['REQUEST_URI']);
					$page_name = 'module'.$page_name;
				}
				
				// header
				$oController->setMedia();
				@$oController->displayHeader();
			}
			else {
				if(version_compare(_PS_VERSION_, '1.5', '<'))
					include_once(dirname(__FILE__).'/../../header.php');
			}



$p = (int)Tools::getValue('p');
$step = (int) Configuration::get($name_module.'perpage_catblog');

$start = (int)(($p - 1)*$step);
if($start<0)
    $start = 0;

$_data = $obj_blog->getCategories(array('start'=>$p,'step'=>$step));




$page_translate = $_data_translate['page']; 

$paging = $obj_blog->PageNav($p,$_data['count_all'],$step,array('category'=>1,'page'=>$page_translate));



$smarty->assign(array('categories' => $_data['categories'], 
					  'count_all' => $_data['count_all'],
					  'paging' => $paging
					  )
				);


if(version_compare(_PS_VERSION_, '1.5', '>')){
	
	if(version_compare(_PS_VERSION_, '1.6', '>')){
					
		$obj_front_c = new ModuleFrontController();
		$obj_front_c->module->name = 'blockblog';
		$obj_front_c->setTemplate('categories.tpl');
		
		$obj_front_c->setMedia();
		
		$obj_front_c->initHeader();
		
		$obj_front_c->initContent();
		
		$obj_front_c->initFooter();
		
		
		$obj_front_c->display();
		
	} else {
		echo $obj_blockblog->renderTplCategories();
	}
	
} else {
	echo Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/categories.tpl');
}





	if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
			if (isset(Context::getContext()->controller)) {
				$oController = Context::getContext()->controller;
			} else {
				$oController = new FrontController();
				$oController->init();
			}
			// footer
			@$oController->displayFooter();
	} else {
		if(version_compare(_PS_VERSION_, '1.5', '<'))
			include_once(dirname(__FILE__).'/../../footer.php');
	}

?>