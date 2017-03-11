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
$category_id = isset($_REQUEST['category_id'])?$_REQUEST['category_id']:0;
$category_id_page = Tools::getValue('category_id');

if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$name_module.'/backward_compatibility/backward.php');
} else{
	$smarty = Context::getContext()->smarty;
}

include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();



$_is_friendly_url = $obj_blog->isURLRewriting();

if(Configuration::get($name_module.'urlrewrite_on') == 1 && is_numeric($category_id)){
	// redirect to seo url
	$seo_url_cat = $obj_blog->getSEOURLForCategory(array('id'=>$category_id));

    $data_url = $obj_blog->getSEOURLs();
    $category_url = $data_url['category_url'];

    Tools::redirect($category_url.$seo_url_cat);
}

$category_id = $obj_blog->getTransformSEOURLtoID(array('id'=>$category_id));

$_info_cat = $obj_blog->getCategoryItem(array('id' => $category_id));

if(empty($_info_cat['category'][0]['id'])){
    $data_url = $obj_blog->getSEOURLs();
    $blog_url = $data_url['posts_url'];

    Tools::redirect($blog_url);
}

$title = isset($_info_cat['category'][0]['title'])?$_info_cat['category'][0]['title']:'';
$seo_description = isset($_info_cat['category'][0]['seo_description'])?$_info_cat['category'][0]['seo_description']:'';
$seo_keywords = isset($_info_cat['category'][0]['seo_keywords'])?$_info_cat['category'][0]['seo_keywords']:''; 

$smarty->assign('meta_title' , $title);
$smarty->assign('meta_description' , $seo_description);
$smarty->assign('meta_keywords' , $seo_keywords);

if(version_compare(_PS_VERSION_, '1.6', '>')){
 	$smarty->assign($name_module.'is16' , 1);
} else {
 	$smarty->assign($name_module.'is16' , 0);
}

$smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
$smarty->assign($name_module.'p_list_displ_date', Configuration::get($name_module.'p_list_displ_date'));
$smarty->assign($name_module.'rsson', Configuration::get($name_module.'rsson'));
$smarty->assign($name_module.'blog_pl_tr', Configuration::get($name_module.'blog_pl_tr'));
		

if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
				if (isset(Context::getContext()->controller)) {
					$oController = Context::getContext()->controller;
				}
				else {
					$oController = new FrontController();
					$oController->init();
				}
				if(Configuration::get($name_module.'urlrewrite_on') == 1){
					$smarty->assign('page_name' , "blockblog-posts");
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
$step = (int) Configuration::get($name_module.'perpage_posts');

$start = (int)(($p - 1)*$step);
if($start<0)
    $start = 0;


$_data = $obj_blog->getPosts(array('start'=>$start,'step'=>$step,'id'=>$category_id));


include_once(dirname(__FILE__).'/blockblog.php');
$obj_blockblog = new blockblog();

$obj_blockblog->setSEOUrls();

$_data_translate = $obj_blockblog->translateItems();
$page_translate = $_data_translate['page']; 
$paging = $obj_blog->PageNav($start,$_data['count_all'],$step,array('category_id'=>$category_id,'page'=>$page_translate,'category_id_page'=>$category_id_page));

// strip tags for content
foreach($_data['posts'] as $_k => $_item){
	$_data['posts'][$_k]['content'] = strip_tags($_item['content']);
	
}


$smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());


$smarty->assign(array('posts' => $_data['posts'], 
					  'count_all' => $_data['count_all'],
					  'paging' => $paging
					  )
				);


if(version_compare(_PS_VERSION_, '1.5', '>')){
	
	if(version_compare(_PS_VERSION_, '1.6', '>')){
					
		$obj_front_c = new ModuleFrontController();
		$obj_front_c->module->name = 'blockblog';
		$obj_front_c->setTemplate('category.tpl');
		
		$obj_front_c->setMedia();
		
		
		$obj_front_c->initHeader();
		$obj_front_c->initFooter();
		
		$obj_front_c->initContent();
		
		
		$obj_front_c->display();
		
	} else {
		echo $obj_blockblog->renderTplCategory();
	}
} else {
	echo Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/category.tpl');
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