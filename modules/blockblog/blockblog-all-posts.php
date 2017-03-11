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
$name_module = 'blockblog';


include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();

include_once(dirname(__FILE__).'/blockblog.php');
$obj_blockblog = new blockblog();
$_data_translate = $obj_blockblog->translateItems();

$obj_blockblog->setSEOUrls();


if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$name_module.'/backward_compatibility/backward.php');
} else{
	$smarty = Context::getContext()->smarty;
}


$smarty->assign('meta_title' , $_data_translate['meta_title_all_posts']);
$smarty->assign('meta_description' , $_data_translate['meta_description_all_posts']);
$smarty->assign('meta_keywords' , $_data_translate['meta_keywords_all_posts']);

$_iso_lng = $obj_blog->getLangISO();
$smarty->assign($name_module.'iso_lng', $_iso_lng);


$smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
$smarty->assign($name_module.'p_list_displ_date', Configuration::get($name_module.'p_list_displ_date'));
$smarty->assign($name_module.'rsson', Configuration::get($name_module.'rsson'));
$smarty->assign($name_module.'blog_pl_tr', Configuration::get($name_module.'blog_pl_tr'));
		
if(version_compare(_PS_VERSION_, '1.6', '>')){
 	$smarty->assign($name_module.'is16' , 1);
} else {
 	$smarty->assign($name_module.'is16' , 0);
}

if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
				if (isset(Context::getContext()->controller)) {
					$oController = Context::getContext()->controller;
				}
				else {
					$oController = new FrontController();
					$oController->init();
				}
				if(Configuration::get($name_module.'urlrewrite_on') == 1){
					$smarty->assign('page_name' , "blockblog-all-posts");
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
$step =(int) Configuration::get($name_module.'perpage_posts');




$search = Tools::getValue("search");
$is_search = 0;

### search ###
if(Tools::strlen($search)>0){
$is_search = 1;
}

### archives ####
$year = (int)Tools::getValue("y");
$month = (int)Tools::getValue("m");
$is_arch = 0;
if($year!=0 && $month!=0){
	$is_arch = 1;
}

$start = (int)(($p - 1)*$step);
if($start<0)
    $start = 0;


$_data = $obj_blog->getAllPosts(array('start'=>$start,'step'=>$step,
									  'is_search'=>$is_search,'search'=>$search,
									  'is_arch'=>$is_arch,'month'=>$month,'year'=>$year
									  )
								);


$page_translate = $_data_translate['page']; 
$paging = $obj_blog->PageNav($start,$_data['count_all'],$step,
						     array('all_posts'=>1,'page'=>$page_translate,
						     	   'is_search'=>$is_search,'search'=>$search,
						     	   'is_arch'=>$is_arch,'month'=>$month,'year'=>$year
						     	   )
						     );

// strip tags for content
foreach($_data['posts'] as $_k => $_item){
	$_data['posts'][$_k]['content'] = strip_tags($_item['content']);
	
}

$smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());

$smarty->assign(array('posts' => $_data['posts'], 
					  'count_all' => $_data['count_all'],
					  'paging' => $paging,
					  $name_module.'is_search' => $is_search,
					  $name_module.'search' => $search
					  )
				);


if(version_compare(_PS_VERSION_, '1.5', '>')){
	
	if(version_compare(_PS_VERSION_, '1.6', '>')){
					
		$obj_front_c = new ModuleFrontController();
		$obj_front_c->module->name = 'blockblog';
		$obj_front_c->setTemplate('all-posts.tpl');
		
		$obj_front_c->setMedia();
		
		$obj_front_c->initHeader();
		$obj_front_c->initFooter();
		
		$obj_front_c->initContent();
		
		
		
		$obj_front_c->display();
		
	} else {
		echo $obj_blockblog->renderTplAllPosts();
	}
	
} else {
	echo Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/all-posts.tpl');
}

if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
				if (isset(Context::getContext()->controller)) {
					$oController = Context::getContext()->controller;
				}
				else {
					$oController = new FrontController();
					$oController->init();
				}
				// footer
				@$oController->displayFooter();
			}
			else {
				if(version_compare(_PS_VERSION_, '1.5', '<'))
					include_once(dirname(__FILE__).'/../../footer.php');
			}

?>