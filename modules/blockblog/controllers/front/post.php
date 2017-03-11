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

class BlockblogPostModuleFrontController extends ModuleFrontController
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

        $post_id = Tools::getValue('post_id');
        $post_id_page = $post_id;

        $name_module = "blockblog";


        include_once(dirname(__FILE__).'../../../classes/blog.class.php');
        $obj_blog = new blog();


        include_once(dirname(__FILE__).'../../../blockblog.php');
        $obj_blockblog = new blockblog();

        $obj_blockblog->setSEOUrls();




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

        $this->context->smarty->assign('meta_title' , $title);
        $this->context->smarty->assign('meta_description' , $seo_description);
        $this->context->smarty->assign('meta_keywords' , $seo_keywords);



        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->context->smarty->assign($name_module.'is16' , 1);
        } else {
            $this->context->smarty->assign($name_module.'is16' , 0);
        }

        if(version_compare(_PS_VERSION_, '1.5', '<')){
            $this->context->smarty->assign($name_module.'is14' , 1);
        } else {
            $this->context->smarty->assign($name_module.'is14' , 0);
        }

        $this->context->smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
        $this->context->smarty->assign($name_module.'post_display_date', Configuration::get($name_module.'post_display_date'));
        $this->context->smarty->assign($name_module.'is_soc_buttons', Configuration::get($name_module.'is_soc_buttons'));


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
        $this->context->smarty->assign($name_module.'blog_rp_tr', Configuration::get($name_module.'blog_rp_tr'));
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


        $_data_translate = $obj_blockblog->translateItems();
        $page_translate = $_data_translate['page'];

        $paging = $obj_blog->PageNav($start,$_data['count_all'],$step,array('post_id'=>$post_id_page,'page'=>$page_translate));

        $this->context->smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());


        $this->context->smarty->assign(array('comments' => $_data['comments'],
                'count_all' => $_data['count_all'],
                'paging' => $paging
            )
        );


        $this->context->smarty->assign(array('posts' => $_info_cat['post'],
                'category_data' => $category_data,
                'is_active' => $is_active,
                'related_products'=>$data_related_products,
                'related_posts'=>$data_related_posts,

                $name_module.'_msg_name'=>$_data_translate['msg_name'],
                $name_module.'_msg_em'=>$_data_translate['msg_em'],
                $name_module.'_msg_comm'=>$_data_translate['msg_comm'],
                $name_module.'_msg_cap'=>$_data_translate['msg_cap'],

                $name_module.'snip_publisher' => Configuration::get('PS_SHOP_NAME'),
                $name_module.'snip_width'=>Configuration::get($name_module.'post_img_width'),
                $name_module.'snip_height'=>Configuration::get($name_module.'post_img_width')
            )
        );

        $this->setTemplate('post.tpl');


    }
}