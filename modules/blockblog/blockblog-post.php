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
$post_id = isset($_REQUEST['post_id'])?$_REQUEST['post_id']:0;
$post_id_page = $post_id;

if (version_compare(_PS_VERSION_, '1.5', '<')){
	require_once(_PS_MODULE_DIR_.$name_module.'/backward_compatibility/backward.php');
} else{
	$smarty = Context::getContext()->smarty;
}

include_once(dirname(__FILE__).'/classes/blog.class.php');
$obj_blog = new blog();


$_is_friendly_url = $obj_blog->isURLRewriting();
$_iso_lng = $obj_blog->getLangISO();

if(Configuration::get($name_module.'urlrewrite_on') == 1 && is_numeric($post_id)){
	// redirect to seo url
	$seo_url_post = $obj_blog->getSEOURLForPost(array('id'=>$post_id));
    $data_url = $obj_blog->getSEOURLs();
    $post_url = $data_url['post_url'];

    Tools::redirect($post_url.$seo_url_post);
}

$post_id = $obj_blog->getTransformSEOURLtoIDPost(array('id'=>$post_id));

$_info_cat = $obj_blog->getPostItem(array('id' => $post_id,'site'=>1));


if(empty($_info_cat['post'][0]['id'])){
    $data_url = $obj_blog->getSEOURLs();
    $posts_url = $data_url['posts_url'];

    Tools::redirect($posts_url);
}

$title = isset($_info_cat['post'][0]['title'])?$_info_cat['post'][0]['title']:'';
$seo_description = isset($_info_cat['post'][0]['seo_description'])?$_info_cat['post'][0]['seo_description']:'';
$seo_keywords = isset($_info_cat['post'][0]['seo_keywords'])?$_info_cat['post'][0]['seo_keywords']:''; 

$smarty->assign('meta_title' , $title);
$smarty->assign('meta_description' , $seo_description);
$smarty->assign('meta_keywords' , $seo_keywords);

if(version_compare(_PS_VERSION_, '1.6', '>')){
 	$smarty->assign($name_module.'is16' , 1);
} else {
 	$smarty->assign($name_module.'is16' , 0);
}

if(version_compare(_PS_VERSION_, '1.5', '<')){
 	$smarty->assign($name_module.'is14' , 1);
} else {
 	$smarty->assign($name_module.'is14' , 0);
}

$smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
$smarty->assign($name_module.'post_display_date', Configuration::get($name_module.'post_display_date'));
$smarty->assign($name_module.'is_soc_buttons', Configuration::get($name_module.'is_soc_buttons'));



if (version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')) {
				if (isset(Context::getContext()->controller)) {
					$oController = Context::getContext()->controller;
				}
				else {
					$oController = new FrontController();
					$oController->init();
				}
				if(Configuration::get($name_module.'urlrewrite_on') == 1){
					$smarty->assign('page_name' , "blockblog-post");
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

########### category info ##################
$is_active = 0;	
$ids_cat = $_info_cat['post'][0]['category_ids'];
$category_data = array();
foreach($ids_cat as $k => $cat_id){
	$_info_ids = $obj_blog->getCategoryItem(array('id' => $cat_id));
	
	$is_active = 1;
	if(empty($_info_ids['category'][0]['title']))
		$is_active = 0;	
	$category_data[] = @$_info_ids['category'][0];
}
########## end category info ###############


### related products ####
$related_products = $_info_cat['post'][0]['related_products']; 
$data_related_products = $obj_blog->getRelatedProducts(array('related_data'=>$related_products));
$smarty->assign($name_module.'blog_rp_tr', Configuration::get($name_module.'blog_rp_tr'));
### related products ####


### related posts ###
$related_posts = $_info_cat['post'][0]['related_posts']; 
$data_related_posts = $obj_blog->getRelatedPostsForPost(array('related_data'=>$related_posts,'post_id'=>$post_id));
### related posts ###


$p = (int)Tools::getValue('p');
$step = (int) Configuration::get($name_module.'pperpage_com');

$start = (int)(($p - 1)*$step);
if($start<0)
    $start = 0;

$_data = $obj_blog->getComments(array('start'=>$start,'step'=>$step,'id'=>$post_id));

include_once(dirname(__FILE__).'/blockblog.php');
$obj_blockblog = new blockblog();

$_data_translate = $obj_blockblog->translateItems();
$page_translate = $_data_translate['page']; 

$paging = $obj_blog->PageNav($start,$_data['count_all'],$step,array('post_id'=>$post_id_page,'page'=>$page_translate));

$smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());


$smarty->assign(array('comments' => $_data['comments'], 
					  'count_all' => $_data['count_all'],
					  'paging' => $paging,
                        $name_module.'_msg_name'=>$_data_translate['msg_name'],
                        $name_module.'_msg_em'=>$_data_translate['msg_em'],
                        $name_module.'_msg_comm'=>$_data_translate['msg_comm'],
                        $name_module.'_msg_cap'=>$_data_translate['msg_cap'],

                        $name_module.'snip_publisher' => Configuration::get('PS_SHOP_NAME'),
                        $name_module.'snip_width'=>Configuration::get($name_module.'post_img_width'),
                        $name_module.'snip_height'=>Configuration::get($name_module.'post_img_width')
					  )
				);

				
$smarty->assign(array('posts' => $_info_cat['post'],
					  'category_data' => $category_data,
					  'is_active' => $is_active,
					  'related_products'=>$data_related_products,
					  'related_posts'=>$data_related_posts,
					  )
				);


if(version_compare(_PS_VERSION_, '1.5', '>')){
	
	if(version_compare(_PS_VERSION_, '1.6', '>')){
					
		$obj_front_c = new ModuleFrontController();
		$obj_front_c->module->name = 'blockblog';
		$obj_front_c->setTemplate('post.tpl');
		
		$obj_front_c->setMedia();
		
		
		$obj_front_c->initHeader();
		$obj_front_c->initFooter();
		
		$obj_front_c->initContent();
		
		$obj_front_c->display();
		
	} else {
		echo $obj_blockblog->renderTplPost();
	}
} else {
    echo Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/post.tpl');
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