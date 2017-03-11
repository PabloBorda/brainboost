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

class BlockblogCategoriesModuleFrontController extends ModuleFrontController
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
        $_data_translate = $obj_blockblog->translateItems();

        $obj_blockblog->setSEOUrls();


        $this->context->smarty->assign('meta_title' , $_data_translate['meta_title_categories']);
        $this->context->smarty->assign('meta_description' , $_data_translate['meta_description_categories']);
        $this->context->smarty->assign('meta_keywords' , $_data_translate['meta_keywords_categories']);

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->context->smarty->assign($name_module.'is16' , 1);
        } else {
            $this->context->smarty->assign($name_module.'is16' , 0);
        }

        $this->context->smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
        $this->context->smarty->assign($name_module.'cat_list_display_date', Configuration::get($name_module.'cat_list_display_date'));



        $p = (int)Tools::getValue('p');
        $step = (int) Configuration::get($name_module.'perpage_catblog');

        $start = (int)(($p - 1)*$step);
        if($start<0)
            $start = 0;


        $_data = $obj_blog->getCategories(array('start'=>$start,'step'=>$step));


        $page_translate = $_data_translate['page'];

        $paging = $obj_blog->PageNav($start,$_data['count_all'],$step,array('category'=>1,'page'=>$page_translate));



        $this->context->smarty->assign(array('categories' => $_data['categories'],
                'count_all' => $_data['count_all'],
                'paging' => $paging
            )
        );

        $this->setTemplate('categories.tpl');



	}
}