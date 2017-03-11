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

class BlockblogCategoryModuleFrontController extends ModuleFrontController
{
	
	public function init()
	{

		parent::init();
	}
	
	public function setMedia()
	{
		parent::setMedia();
    }

	
	/**
	 * @see FrontController::initContent()
	 */
	public function initContent()
	{
		parent::initContent();

        $category_id = Tools::getValue('category_id');

        $category_id_page = $category_id;

        $name_module = "blockblog";


        include_once(dirname(__FILE__).'../../../classes/blog.class.php');
        $obj_blog = new blog();


        include_once(dirname(__FILE__).'../../../blockblog.php');
        $obj_blockblog = new blockblog();

        $obj_blockblog->setSEOUrls();


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

        $this->context->smarty->assign('meta_title' , $title);
        $this->context->smarty->assign('meta_description' , $seo_description);
        $this->context->smarty->assign('meta_keywords' , $seo_keywords);

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->context->smarty->assign($name_module.'is16' , 1);
        } else {
            $this->context->smarty->assign($name_module.'is16' , 0);
        }

        $this->context->smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
        $this->context->smarty->assign($name_module.'p_list_displ_date', Configuration::get($name_module.'p_list_displ_date'));
        $this->context->smarty->assign($name_module.'rsson', Configuration::get($name_module.'rsson'));
        $this->context->smarty->assign($name_module.'blog_pl_tr', Configuration::get($name_module.'blog_pl_tr'));




        $p = (int)Tools::getValue('p');
        $step = (int) Configuration::get($name_module.'perpage_posts');

        $start = (int)(($p - 1)*$step);
        if($start<0)
            $start = 0;

        $_data = $obj_blog->getPosts(array('start'=>$start,'step'=>$step,'id'=>$category_id));




        $_data_translate = $obj_blockblog->translateItems();
        $page_translate = $_data_translate['page'];
        $paging = $obj_blog->PageNav($start,$_data['count_all'],$step,array('category_id'=>$category_id,'page'=>$page_translate,'category_id_page'=>$category_id_page));

        // strip tags for content
        foreach($_data['posts'] as $_k => $_item){
            $_data['posts'][$_k]['content'] = strip_tags($_item['content']);

        }


        $this->context->smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());


        $this->context->smarty->assign(array('posts' => $_data['posts'],
                'count_all' => $_data['count_all'],
                'paging' => $paging
            )
        );

        $this->setTemplate('category.tpl');
	}
}