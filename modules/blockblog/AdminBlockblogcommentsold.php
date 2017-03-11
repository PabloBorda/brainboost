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

ob_start();
	/*@ini_set('display_errors', 'on');	
	define('_PS_DEBUG_SQL_', true);
	define('_PS_DISPLAY_COMPATIBILITY_WARNING_', true);
	error_reporting(E_ALL|E_STRICT);
	*/
class AdminBlockblogcommentsold extends AdminTab{

	private $_is15;
	public function __construct()

	{
		$this->module = 'blockblog';
		
		if(version_compare(_PS_VERSION_, '1.5', '>')){
			$this->multishop_context = Shop::CONTEXT_ALL;
			$this->_is15 = 1;
		} else {
			$this->_is15 = 0;
		}
		
		
		parent::__construct();
		
	}
	
	public function addJS(){
		
	}

    public function addCSS(){

    }
	
	public function display()
	{
		echo '<style type="text/css">.warn{display:none!important}
									 #maintab20{display:none!important}
									 .add_new_button{border: 1px solid #DEDEDE; padding: 10px; margin-bottom: 10px; width:10%; display: block; font-size: 16px; color: maroon; text-align: center; font-weight: bold; text-decoration: underline;float:right}
  .title_breadcrumbs{border: 1px solid #DEDEDE;
    				color: #000000;
				    display: block;
				    font-size: 16px;
				    font-weight: bold;
				    margin: 0 0 10px 0;
				    padding: 10px;
				    text-align: left;
				    text-decoration: none;
				    width: auto;float:left}
	.clear_both{clear:both}
		</style>';
		
		if (version_compare(_PS_VERSION_, '1.6', '<')){
			require_once(_PS_MODULE_DIR_.$this->module.'/backward_compatibility/backward.php');
            $variables14 = variables_blockblog14();
            $currentIndex = $variables14['currentindex'];
		} else {
			$currentIndex = AdminController::$currentIndex;
		}
		
		// include main class
		require_once(dirname(__FILE__) .  '/blockblog.php');
		// instantiate
		$obj_main = new blockblog();
		
		$tab = 'AdminBlockblogcommentsold';
		
		$token = $this->token;
		
		
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		echo $obj_main->_jsandcss();
		
		$data_translate = $obj_main->translateItems();
		
		$top_menu_buttons = 
			'
			<h3 class="title_breadcrumbs">
			<span>'.$data_translate['title_home'].'</span>
			>
			<span>'.$data_translate['title_comments'].'</span>
			
			</h3>
			
			<div class="clear_both"></div>';
		
		 ################# comments ##########################
		
		
        // delete comments
        $delete_item_comments = Tools::getValue("delete_item_comments");
        
        if (Tools::strlen($delete_item_comments)>0) {
        	if (Validate::isInt(Tools::getValue("id_comments"))) {
				$obj_blog->deleteComment(array('id'=>Tools::getValue("id_comments")));
				Tools::redirectAdmin($currentIndex.'&tab='.$tab.'&list_comments=1&configure='.$this->module.'&token='.$token.'');
			}
		}
    	 //list comments
        $page_comments = Tools::getValue("pagecomments");
        $list_comments = Tools::getValue("list_comments");
        if (Tools::strlen($page_comments)>0 || Tools::strlen($list_comments)>0) {
        	echo $top_menu_buttons;
        	echo $obj_main->_drawComments(array('edit'=>2,'currentindex'=>$currentIndex,'controller'=>$tab));
        }
   	    $edit_item_comments = Tools::getValue("edit_item_comments");
    	if (Tools::strlen($edit_item_comments)>0) {
        	echo $obj_main->_drawEditComments(array('action'=>'edit',
		        						   			'id'=>Tools::getValue("id_comments"),
        											'currentindex'=>$currentIndex,'controller'=>$tab
        											)
		        						);
        }
    	// cancel edit comments 
    	if (Tools::isSubmit('cancel_editcomments'))
        {
       	Tools::redirectAdmin($currentIndex.'&tab='.$tab.'&list_comments=1&configure='.$this->module.'&token='.$token.'');
		}
     	//edit comments
     	if (Tools::isSubmit("submit_editcomments")) {
     		
     		$id_editcomments = Tools::getValue("id_editcomments");
     		
         	$comments_name = Tools::getValue("comments_name");
        	$comments_email = Tools::getValue("comments_email");
        	$comments_comment = Tools::getValue("comments_comment");
        	$comments_status = Tools::getValue("comments_status");
            $time_add = Tools::getValue("time_add_comm");
        	
         	$data = array('comments_name' => $comments_name,
         				  'comments_email' => $comments_email,
         				  'comments_comment' => $comments_comment,
         				  'comments_status' => $comments_status,
         	 			  'id_editcomments' => $id_editcomments,
                            'time_add'=>$time_add,
         				 );
         	if(Tools::strlen($comments_name)>0 && Tools::strlen($comments_comment)>0)
         		$obj_blog->updateComment($data);
         	Tools::redirectAdmin($currentIndex.'&tab='.$tab.'&list_comments=1&configure='.$this->module.'&token='.$token.'');
		 }
        ################# comments ##########################
		
		if (Tools::strlen($delete_item_comments)==0 && Tools::strlen($page_comments)==0 
			&& Tools::strlen($list_comments)==0 && Tools::strlen($edit_item_comments)==0
			&& !Tools::isSubmit('cancel_editcomments') && !Tools::isSubmit("submit_editcomments")
			){
			
			echo $top_menu_buttons;
				
			echo $obj_main->_drawComments(array('edit'=>2,'currentindex'=>$currentIndex,'controller'=>$tab));
		}
		
		 
		
	}
		

}

?>

