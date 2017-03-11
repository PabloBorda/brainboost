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

class BlockblogBlogModuleFrontController extends ModuleFrontController
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

        $name_module = "blockblog";

        include_once(dirname(__FILE__).'../../../classes/blog.class.php');
        $obj_blog = new blog();


        include_once(dirname(__FILE__).'../../../blockblog.php');
        $obj_blockblog = new blockblog();

        $obj_blockblog->setSEOUrls();

        $_data_translate = $obj_blockblog->translateItems();


        $this->context->smarty->assign('meta_title' , $_data_translate['meta_title_all_posts']);
        $this->context->smarty->assign('meta_description' , $_data_translate['meta_description_all_posts']);
        $this->context->smarty->assign('meta_keywords' , $_data_translate['meta_keywords_all_posts']);

        $_iso_lng = $obj_blog->getLangISO();
        $this->context->smarty->assign($name_module.'iso_lng', $_iso_lng);


        $this->context->smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
        $this->context->smarty->assign($name_module.'p_list_displ_date', Configuration::get($name_module.'p_list_displ_date'));
        $this->context->smarty->assign($name_module.'rsson', Configuration::get($name_module.'rsson'));
        $this->context->smarty->assign($name_module.'blog_pl_tr', Configuration::get($name_module.'blog_pl_tr'));

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->context->smarty->assign($name_module.'is16' , 1);
        } else {
            $this->context->smarty->assign($name_module.'is16' , 0);
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

        $this->context->smarty->assign($name_module.'pic', $obj_blockblog->getCloudImgPath());

        $this->context->smarty->assign(array('posts' => $_data['posts'],
                                            'count_all' => $_data['count_all'],
                                            'paging' => $paging,
                                            $name_module.'is_search' => $is_search,
                                            $name_module.'search' => $search
                                        )
        );

        $this->setTemplate('all-posts.tpl');
	}
}