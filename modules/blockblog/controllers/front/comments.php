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

class BlockblogCommentsModuleFrontController extends ModuleFrontController
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



        $this->context->smarty->assign('meta_title' , $_data_translate['meta_title_all_comments']);
        $this->context->smarty->assign('meta_description' , $_data_translate['meta_description_all_comments']);
        $this->context->smarty->assign('meta_keywords' , $_data_translate['meta_keywords_all_comments']);



        $this->context->smarty->assign($name_module.'urlrewrite_on', Configuration::get($name_module.'urlrewrite_on'));
        $this->context->smarty->assign($name_module.'rsson', Configuration::get($name_module.'rsson'));


        $p = (int)Tools::getValue('p');
        $step = (int) Configuration::get($name_module.'perpage_com');

        $start = (int)(($p - 1)*$step);
        if($start<0)
            $start = 0;

        $_data_com = $obj_blog->getLastComments(array('is_page'=>1,'step'=>$step,'start'=>$start));



        $page_translate = $_data_translate['page'];
        $paging = $obj_blog->PageNav($start,$_data_com['count_all'],$step,
                                    array('all_comments'=>1,'page'=>$page_translate,
            )
        );

        
        $this->context->smarty->assign(array('comments' => $_data_com['comments'],
                                            'count_all' => $_data_com['count_all'],
                                            'paging' => $paging,
            )
        );

        $this->setTemplate('all-comments.tpl');

    }
}