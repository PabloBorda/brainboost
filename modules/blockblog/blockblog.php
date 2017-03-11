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

class blockblog extends Module
{
	private $_step = 20;
	private $_is15;
	private $_is_friendly_url;
	private $_iso_lng;
	private $_is16;
	private $_id_shop;
	private $_is_cloud;
	private $path_img_cloud;
    private $_token_cron;
    public $is_demo = 0;

	public function __construct()
	{
		$this->name = 'blockblog';
		$this->tab = 'content_management';
		$this->version = '2.0.1';
		$this->author = 'SPM';
		$this->module_key = '1bc36ed9759cb70344bcaaf7e0eef623';
        $this->confirmUninstall = $this->l('Are you sure you want to remove it ? Be careful, all your configuration and your data will be lost');


        $this->_token_cron = md5($this->name._PS_BASE_URL_);

        ///if (version_compare(_PS_VERSION_, '1.6', '<')){
        require_once(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
        ///}

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->bootstrap = true;
            $this->need_instance = 0;
        }


		if (defined('_PS_HOST_MODE_'))
			$this->_is_cloud = 1;
		else
			$this->_is_cloud = 0;
		
		
		// for test 
		//$this->_is_cloud = 1;
		// for test
		
		
		if($this->_is_cloud){
			$this->path_img_cloud = "modules/".$this->name."/upload/";
		} else {
			$this->path_img_cloud = "upload/".$this->name."/";
				
		}
		

		

		
		if(version_compare(_PS_VERSION_, '1.5', '>')){
			$this->_id_shop = Context::getContext()->shop->id;
			$this->_is15 = 1;
		
		} else {
			$this->_id_shop = 1;
			$this->_is15 = 0;
		}
		
		if(version_compare(_PS_VERSION_, '1.6', '>')){
 	 		$this->_is16 = 1;
 	 	} else {
 	 		$this->_is16 = 0;
 	 	}
 	 	

		
 	 	if(version_compare(_PS_VERSION_, '1.5', '>')){
 	 	    include_once(dirname(__FILE__).'/classes/blog.class.php');
 	 	}else{
 	 	    include_once(_PS_MODULE_DIR_.$this->name.'/classes/blog.class.php');
 	 	}
		$obj = new blog();
		$is_friendly_url = $obj->isURLRewriting();
		$this->_is_friendly_url = $is_friendly_url;
		$this->_iso_lng = $obj->getLangISO();

        parent::__construct(); // The parent construct is required for translations


        $this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Blog PRO');
        $this->description = $this->l('Add Blog PRO');
		
		$this->initContext();
	}


	private function initContext()
	{

	  $this->context = Context::getContext();
      if (version_compare(_PS_VERSION_, '1.5', '>')){
          $this->context->currentindex = isset(AdminController::$currentIndex)?AdminController::$currentIndex:'index.php?controller=AdminModules';
      } else {
          $variables14 = variables_blockblog14();
          $this->context->currentindex = $variables14['currentindex'];

	  }
	}
	
	public function getCloudImgPath(){
		return $this->path_img_cloud;
	}

	public function install()
	{
		
		if (!parent::install())
			return false;

        if(Configuration::get('PS_REWRITING_SETTINGS')){
            Configuration::updateValue($this->name.'urlrewrite_on', 1);
        }

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            Configuration::updateValue($this->name.'btabs_type', 1);
        } else {
            Configuration::updateValue($this->name.'btabs_type', 2);
        }

		// comments //	
		Configuration::updateValue($this->name.'blog_com', 5);
        Configuration::updateValue($this->name.'blog_com_tr', 75);
		Configuration::updateValue($this->name.'perpage_com', 10);
        Configuration::updateValue($this->name.'pperpage_com', 3);
		// comments //	
		
		// left 	
		Configuration::updateValue($this->name.'cat_left', 1);	
		Configuration::updateValue($this->name.'posts_left', 1);
		Configuration::updateValue($this->name.'com_left', 1);
		// left 
		
		Configuration::updateValue($this->name.'blog_h', 1);
		Configuration::updateValue($this->name.'blog_bp_h', 4);
		Configuration::updateValue($this->name.'posts_w_h', 150);
        Configuration::updateValue($this->name.'blog_p_tr', 250);

		
		if($this->_is16 == 1){
			Configuration::updateValue($this->name.'search_left', 1);	
			Configuration::updateValue($this->name.'arch_left', 1);
			
			Configuration::updateValue($this->name.'cat_footer', 1);	
			Configuration::updateValue($this->name.'posts_footer', 1);
			Configuration::updateValue($this->name.'search_footer', 1);	
			Configuration::updateValue($this->name.'arch_footer', 1);
			Configuration::updateValue($this->name.'com_footer', 1);
			
		}
		
		// right 	
		if($this->_is16 == 0){
		Configuration::updateValue($this->name.'search_right', 1);	
		Configuration::updateValue($this->name.'arch_right', 1);
		Configuration::updateValue($this->name.'com_right', 1);
		}
		// right 
		

		Configuration::updateValue($this->name.'cat_list_display_date', 1);	
		
		
		Configuration::updateValue($this->name.'perpage_catblog', 10);
		
		
		Configuration::updateValue($this->name.'perpage_posts', 10);
		Configuration::updateValue($this->name.'p_list_displ_date', 1);
		
		
		Configuration::updateValue($this->name.'block_display_date', 1);
		Configuration::updateValue($this->name.'block_display_img', 1);
		if($this->_is16==1){
		Configuration::updateValue($this->name.'posts_block_img_width', 70);
			
		} else {
		Configuration::updateValue($this->name.'posts_block_img_width', 50);
			
		}
		
		

		
		Configuration::updateValue($this->name.'tab_blog_pr', 1);
		Configuration::updateValue($this->name.'block_last_home', 1);
		Configuration::updateValue($this->name.'lists_img_width', 200);
        Configuration::updateValue($this->name.'blog_pl_tr', 140);
		
		Configuration::updateValue($this->name.'post_display_date', 1);	
		Configuration::updateValue($this->name.'post_img_width', 500);
		Configuration::updateValue($this->name.'is_soc_buttons', 1);

        if(version_compare(_PS_VERSION_, '1.5', '>')) {
            Configuration::updateValue($this->name . 'img_size_rp', 'medium_default');
        } else {
            Configuration::updateValue($this->name . 'img_size_rp', 'medium');
        }
        Configuration::updateValue($this->name.'blog_rp_tr', 75);

        Configuration::updateValue($this->name.'rp_img_width', 150);



		
		Configuration::updateValue($this->name.'noti', 1);	
		Configuration::updateValue($this->name.'mail', @Configuration::get('PS_SHOP_EMAIL'));
		Configuration::updateValue($this->name.'blog_bcat', 5);
		Configuration::updateValue($this->name.'blog_bposts', 5);
		
		
		Configuration::updateValue($this->name.'rsson', 1);
		Configuration::updateValue($this->name.'number_rssitems', 10);
		
		$languages = Language::getLanguages(false);
    	foreach ($languages as $language){
    		$i = $language['id_lang'];
    		
    		$rssname = Configuration::get('PS_SHOP_NAME');
    		Configuration::updateValue($this->name.'rssname_'.$i, $rssname);
			$rssdesc = Configuration::get('PS_SHOP_NAME');
			Configuration::updateValue($this->name.'rssdesc_'.$i, $rssdesc);
		}

        if(version_compare(_PS_VERSION_, '1.6', '<'))
		    $this->generateRewriteRules();
		
		if($this->_is15 == 1)
	 		$this->createAdminTabs15();
	 	/*else
	 		$this->createAdminTabs14();*/
		
		if (!$this->registerHook('leftColumn') 
			OR !$this->registerHook('rightColumn')
			OR !$this->registerHook('Header') 
			OR !$this->registerHook('Footer') 
			OR !$this->registerHook('productTabContent')
			OR !$this->registerHook('productTab') 
			OR !$this->_installDB()
            OR !$this->createLikePostTable()
			OR !$this->registerHook('home')

            OR !((version_compare(_PS_VERSION_, '1.6', '>'))? $this->registerHook('ModuleRoutes') : true)

			OR !($this->_is_cloud? true : $this->_createFolderAndSetPermissions())
			OR !((version_compare(_PS_VERSION_, '1.6', '>'))? $this->registerHook('DisplayBackOfficeHeader') : true)

            OR !((version_compare(_PS_VERSION_, '1.5', '>'))? $this->registerHook('blogCategoriesSPM') : true)
            OR !((version_compare(_PS_VERSION_, '1.5', '>'))? $this->registerHook('blogPostsSPM') : true)
            OR !((version_compare(_PS_VERSION_, '1.5', '>'))? $this->registerHook('blogCommentsSPM') : true)
			 )
			return false;
		
		
		return true;
	}


    public function hookModuleRoutes()
    {
        return array(

            ## category ##

            'blockblog-blog-category-p' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{category_id}/{p}',
                'keywords' => array(
                    'category_id'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'category_id'),
                    'p'				=>	array('regexp' => '[0-9]+', 'param' => 'p'),
                    'controller'	=>	array('regexp' => 'category', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),
            'blockblog-blog-category' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{category_id}',
                'keywords' => array(
                    'category_id'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'category_id'),
                    'controller'	=>	array('regexp' => 'category', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),

            ## category ##

            ## categories ##

            'blockblog-blog-categories' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}',
                'keywords' => array(
                    'controller'	=>	array('regexp' => 'categories', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),

            'blockblog-blog-categories-p' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{p}',
                'keywords' => array(
                    'p'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'p'),
                    'controller'	=>	array('regexp' => 'categories', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),
            ## categories ##



            ## post page ##
            'blockblog-blog-post-post_id-p' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{post_id}/{p}',
                'keywords' => array(
                    'post_id'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'post_id'),
                    'p'				=>	array('regexp' => '[0-9]+', 'param' => 'p'),
                    'controller'	=>	array('regexp' => 'post', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),
            'blockblog-blog-post-post_id' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{post_id}',
                'keywords' => array(
                    'post_id'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'post_id'),
                    'controller'	=>	array('regexp' => 'post', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),
            ## post page ##



            ## comments ##
            'blockblog-blog-comments' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}',
                'keywords' => array(
                    'controller'	=>	array('regexp' => 'comments', 'param' => 'controller')
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),

            'blockblog-blog-comments-p' => array(
                'controller' =>	null,
                'rule' =>		'blog/{controller}/{p}',
                'keywords' => array(
                    'p'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'p'),
                    'controller'	=>	array('regexp' => 'comments', 'param' => 'controller'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),
            ## comments ##


            ## all posts ##

            'blockblog-blog' => array(
                'controller' =>	null,
                'rule' =>		'{controller}',
                'keywords' => array(
                    'controller'	=>	array('regexp' => 'blog', 'param' => 'controller'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),

            'blockblog-blog-p' => array(
                'controller' =>	null,
                'rule' =>		'{controller}/{p}',
                'keywords' => array(
                    'p'		=>	array('regexp' => '[0-9a-zA-Z-_]+','param'=>'p'),
                    'controller'	=>	array('regexp' => 'blog', 'param' => 'controller'),
                ),
                'params' => array(
                    'fc' => 'module',
                    'module' => 'blockblog'
                )
            ),


            ## all posts ##









        );
    }




    public function hookDisplayBackOfficeHeader()
	{
	
		if(version_compare(_PS_VERSION_, '1.6', '>')){
			$base_dir = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__;
		} else {
			$base_dir = _PS_BASE_URL_.__PS_BASE_URI__;
		}
	
	
		$css = '';
		$css .= '<style type="text/css">
		.icon-AdminBlockblog:before {
			content: url("'.$base_dir.'modules/'.$this->name.'/AdminBlockblog.gif");
		}
		</style>
		';
		return $css;
	}
	
	public function uninstall()
	{

        Configuration::deleteByName($this->name.'urlrewrite_on');

        Configuration::deleteByName($this->name.'btabs_type');



        // comments //
        Configuration::deleteByName($this->name.'blog_com');
        Configuration::deleteByName($this->name.'blog_com_tr');
        Configuration::deleteByName($this->name.'perpage_com');
        Configuration::deleteByName($this->name.'pperpage_com');
        // comments //

        // left
        Configuration::deleteByName($this->name.'cat_left');
        Configuration::deleteByName($this->name.'posts_left');
        Configuration::deleteByName($this->name.'com_left');
        // left

        Configuration::deleteByName($this->name.'blog_h');
        Configuration::deleteByName($this->name.'blog_bp_h');
        Configuration::deleteByName($this->name.'posts_w_h');
        Configuration::deleteByName($this->name.'blog_p_tr');

        Configuration::deleteByName($this->name.'search_left');
        Configuration::deleteByName($this->name.'arch_left');

        Configuration::deleteByName($this->name.'cat_footer');
        Configuration::deleteByName($this->name.'posts_footer');
        Configuration::deleteByName($this->name.'search_footer');
        Configuration::deleteByName($this->name.'arch_footer');
        Configuration::deleteByName($this->name.'com_footer');

        Configuration::deleteByName($this->name.'search_right');
        Configuration::deleteByName($this->name.'arch_right');
        Configuration::deleteByName($this->name.'com_right');


        Configuration::deleteByName($this->name.'cat_list_display_date');
        Configuration::deleteByName($this->name.'perpage_catblog');

        Configuration::deleteByName($this->name.'perpage_posts');
        Configuration::deleteByName($this->name.'p_list_displ_date');

        Configuration::deleteByName($this->name.'block_display_date');
        Configuration::deleteByName($this->name.'block_display_img');
        Configuration::deleteByName($this->name.'posts_block_img_width');


        Configuration::deleteByName($this->name.'tab_blog_pr');
        Configuration::deleteByName($this->name.'block_last_home');
        Configuration::deleteByName($this->name.'lists_img_width');
        Configuration::deleteByName($this->name.'blog_pl_tr');

        Configuration::deleteByName($this->name.'post_display_date');
        Configuration::deleteByName($this->name.'post_img_width');
        Configuration::deleteByName($this->name.'is_soc_buttons');


        Configuration::deleteByName($this->name.'img_size_rp');
        Configuration::deleteByName($this->name.'blog_rp_tr');

        Configuration::deleteByName($this->name.'rp_img_width');


        Configuration::deleteByName($this->name.'noti');
        Configuration::deleteByName($this->name.'mail');
        Configuration::deleteByName($this->name.'blog_bcat');
        Configuration::deleteByName($this->name.'blog_bposts');



        Configuration::deleteByName($this->name.'rsson');
        Configuration::deleteByName($this->name.'number_rssitems');


        $languages = Language::getLanguages(false);
        foreach ($languages as $language){
            $i = $language['id_lang'];

            Configuration::deleteByName($this->name.'rssname_'.$i);
            Configuration::deleteByName($this->name.'rssdesc_'.$i);

        }


		if($this->_is15 == 1)
			$this->uninstallTab15();
		/*else
			$this->uninstallTab14();*/
			
		
			
		if (!parent::uninstall() || !$this->_uninstallDB())
			return false;
		return true;
	}
	
	private function uninstallTab15(){

        if(version_compare(_PS_VERSION_, '1.6', '>')) {
            $prefix = '';
        } else {
            $prefix = 'old';
        }

        $tab_id = Tab::getIdFromClassName("AdminBlockblog".$prefix);
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblog".($prefix == 'old'?'C':'c')."ategories".$prefix);
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblog".($prefix == 'old'?'P':'p')."osts".$prefix);
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblog".($prefix == 'old'?'C':'c')."omments".$prefix);
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		@unlink(_PS_ROOT_DIR_."/img/t/AdminBlockblog".$prefix.".gif");
	}
	
	private function uninstallTab14(){
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblogCategoriesold");
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblogPostsold");
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		$tab_id = Tab::getIdFromClassName("AdminBlockblogCommentsold");
		if($tab_id){
			$tab = new Tab($tab_id);
			$tab->delete();
		}
		
		@unlink(_PS_ROOT_DIR_."/img/t/AdminBlockblogold.gif");
	}
	
	
	
	public function createAdminTabs15(){

        if(version_compare(_PS_VERSION_, '1.6', '>')) {
            $prefix = '';
        } else {
            $prefix = 'old';
        }
		
			@copy_custom(dirname(__FILE__)."/img/AdminBlockblog".$prefix.".gif",_PS_ROOT_DIR_."/img/t/AdminBlockblog".$prefix.".gif");
		
		 	$langs = Language::getLanguages();
            
          
            $tab0 = new Tab();
            $tab0->class_name = "AdminBlockblog".$prefix;
            $tab0->module = $this->name;
            $tab0->id_parent = 0; 
            foreach($langs as $l){
                    $tab0->name[$l['id_lang']] = $this->l('Blog');
            }
            $tab0->save();
            $main_tab_id = $tab0->id;

            unset($tab0);
            
            $tab1 = new Tab();
            $tab1->class_name = "AdminBlockblogcategories".$prefix;
            $tab1->module = $this->name;
            $tab1->id_parent = $main_tab_id; 
            foreach($langs as $l){
                    $tab1->name[$l['id_lang']] = $this->l('Categories');
            }
            $tab1->save();

            unset($tab1);
            
            $tab2 = new Tab();
            $tab2->class_name = "AdminBlockblogposts".$prefix;
            $tab2->module = $this->name;
            $tab2->id_parent = $main_tab_id; 
            foreach($langs as $l){
                    $tab2->name[$l['id_lang']] = $this->l('Posts');
            }
            $tab2->save();

            unset($tab2);
            
            $tab3 = new Tab();
            $tab3->class_name = "AdminBlockblogcomments".$prefix;
            $tab3->module = $this->name;
            $tab3->id_parent = $main_tab_id; 
            foreach($langs as $l){
                    $tab3->name[$l['id_lang']] = $this->l('Comments');
            }
            $tab3->save();

            unset($tab3);
  
	}
	
	private function createAdminTabs14(){
			@copy_custom(dirname(__FILE__)."/img/AdminBlockblogold.gif",_PS_ROOT_DIR_."/img/t/AdminBlockblogold.gif");
		
		 	$langs = Language::getLanguages();
            
          
           
            $tab1 = new Tab();
            $tab1->class_name = "AdminBlockblogCategoriesold";
            $tab1->module = $this->name;
            foreach($langs as $l){
                    $tab1->name[$l['id_lang']] = $this->l('Categories');
            }
            $tab1->save();

            unset($tab1);
            
            $tab2 = new Tab();
            $tab2->class_name = "AdminBlockblogPostsold";
            $tab2->module = $this->name;
            foreach($langs as $l){
                    $tab2->name[$l['id_lang']] = $this->l('Posts');
            }
            $tab2->save();

            unset($tab2);
            
            $tab3 = new Tab();
            $tab3->class_name = "AdminBlockblogCommentsold";
            $tab3->module = $this->name;
            foreach($langs as $l){
                    $tab3->name[$l['id_lang']] = $this->l('Comments');
            }
            $tab3->save();

	}
	
 	private function generateRewriteRules(){
            
            if(Configuration::get('PS_REWRITING_SETTINGS')){

                $rules = "#blog_for_prestashop - not remove this comment \n";
                
                $physical_uri = array();
                 if($this->_is15){
                foreach (ShopUrl::getShopUrls() as $shop_url)
				{
                    if(in_array($shop_url->physical_uri,$physical_uri)) continue;
                    
                  $rules .= "RewriteRule ^(.*)blog/category/([0-9a-zA-Z-_]+)$ ".$shop_url->physical_uri."modules/blockblog/blockblog-category.php?category_id=$2 [QSA,L] \n";
				  $rules .= "RewriteRule ^(.*)blog/post/([0-9a-zA-Z-_]+)$ ".$shop_url->physical_uri."modules/blockblog/blockblog-post.php?post_id=$2 [QSA,L] \n";
				  $rules .= "RewriteRule ^(.*)blog/categories$ ".$shop_url->physical_uri."modules/blockblog/blockblog-categories.php [QSA,L] \n";
                  $rules .= "RewriteRule ^(.*)blog$ ".$shop_url->physical_uri."modules/blockblog/blockblog-all-posts.php [QSA,L] \n";
                  $rules .= "RewriteRule ^(.*)blog/comments$ ".$shop_url->physical_uri."modules/blockblog/blockblog-all-comments.php [QSA,L] \n";
                    
                    $physical_uri[] = $shop_url->physical_uri;
                } 
                
                 } else{
                	 $rules .= "RewriteRule ^(.*)blog/category/([0-9a-zA-Z-_]+)$ /modules/blockblog/blockblog-category.php?category_id=$2 [QSA,L] \n";
				  	$rules .= "RewriteRule ^(.*)blog/post/([0-9a-zA-Z-_]+)$ /modules/blockblog/blockblog-post.php?post_id=$2 [QSA,L] \n";
				  	$rules .= "RewriteRule ^(.*)blog/categories$ /modules/blockblog/blockblog-categories.php [QSA,L] \n";
                  	$rules .= "RewriteRule ^(.*)blog$ /modules/blockblog/blockblog-all-posts.php [QSA,L] \n";
                  	$rules .= "RewriteRule ^(.*)blog/comments$ /modules/blockblog/blockblog-all-comments.php [QSA,L] \n";
                    
                }
                $rules .= "#blog_for_prestashop \n\n";
                
                $path = _PS_ROOT_DIR_.'/.htaccess';

                  if(is_writable($path)){
                      
                      $existingRules = file_get_contents_custom($path);
                      
                      if(!strpos($existingRules, "blog_for_prestashop")){
                        $handle = fopen($path, 'w');
                        fwrite($handle, $rules.$existingRules);
                        fclose($handle);
                      }
                  }
              }
        }
	
	private function _createFolderAndSetPermissions(){
		
		$prev_cwd = getcwd();
		
		$module_dir = dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR;
		@chdir($module_dir);
		//folder avatars
		$module_dir_img = $module_dir."blockblog".DIRECTORY_SEPARATOR; 
		@mkdir($module_dir_img, 0777);

		@chdir($prev_cwd);
		
		return true;
	} 
	
	private function _installDB(){
		$sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_category` (
							  `id` int(11) NOT NULL auto_increment,
							  `ids_shops` varchar(1024) NOT NULL default \'0\',
							  `status` int(11) NOT NULL default \'1\',
							  `time_add` timestamp NOT NULL default CURRENT_TIMESTAMP,
							  PRIMARY KEY  (`id`)
							) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8;';
		if (!Db::getInstance()->Execute($sql))
			return false;
			
		$query = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_category_data` (
							  `id_item` int(11) NOT NULL,
							  `id_lang` int(11) NOT NULL,
							  `title` varchar(1024) default NULL,
							  `seo_description` text,
							  `seo_keywords` varchar(1024) default NULL,
							  `seo_url` varchar(1024) default NULL,
							  KEY `id_item` (`id_item`)
							) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8';
		if (!Db::getInstance()->Execute($query))
			return false;
			
		$sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_post` (
					  `id` int(11) NOT NULL auto_increment,
					  `img` text,
					  `ids_shops` varchar(1024) NOT NULL default \'0\',
					  `status` int(11) NOT NULL default \'1\',
					  `is_comments` int(11) NOT NULL default \'1\',
					  `related_products` varchar(1024) NOT NULL default \'0\',
					  `related_posts` varchar(1024) NOT NULL default \'0\',
					  `time_add` timestamp NOT NULL default CURRENT_TIMESTAMP,
					  PRIMARY KEY  (`id`)
					) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8;';
		if (!Db::getInstance()->Execute($sql))
			return false;
			
		$query = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_post_data` (
							  `id_item` int(11) NOT NULL,
							  `id_lang` int(11) NOT NULL,
							  `title` varchar(1024) default NULL,
							  `seo_keywords` varchar(1024) default NULL,
							  `seo_description` text,
							  `content` text,
							  `seo_url` varchar(1024) default NULL,
							  KEY `id_item` (`id_item`)
							) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8';
		if (!Db::getInstance()->Execute($query))
			return false;
		
			
		$sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_comments` (
							  `id` int(11) NOT NULL auto_increment,
							  `id_lang` int(11) NOT NULL,
							  `name` varchar(5000) default NULL,
							  `email` varchar(500) default NULL,
							  `comment` text,
							  `status` int(11) NOT NULL default \'0\',
							  `id_post` int(11) NOT NULL,
							  `id_shop` int(11) NOT NULL default \'0\',
							  `time_add` timestamp NOT NULL default CURRENT_TIMESTAMP,
							  PRIMARY KEY  (`id`)
							) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8;';
		if (!Db::getInstance()->Execute($sql))
			return false;

		$sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_category2post` (
							  `category_id` int(11) NOT NULL,
							  `post_id` int(11) NOT NULL,
							  KEY `category_id` (`category_id`),
							  KEY `post_id` (`post_id`),
							  KEY `category2post` (`category_id`,`post_id`)
							) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8;';
		if (!Db::getInstance()->Execute($sql))
			return false;
			
		return true;
	}

    public function createLikePostTable(){
        $sql = 'CREATE TABLE IF NOT EXISTS `'._DB_PREFIX_.'blog_post_like` (
					  `id` int(11) NOT NULL auto_increment,
					  `post_id` int(11) NOT NULL,
					  `like` int(11) NOT NULL,
					  `ip` varchar(255) default NULL,
					  `time_add` timestamp NOT NULL default CURRENT_TIMESTAMP,
					  PRIMARY KEY  (`id`)
					) ENGINE='.(defined('_MYSQL_ENGINE_')?_MYSQL_ENGINE_:"MyISAM").' DEFAULT CHARSET=utf8;';
        if (!Db::getInstance()->Execute($sql))
            return false;

        return true;
    }
	
	private function _uninstallDB() {
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_category');
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_category_data');
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_post');
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_post_data');
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_comments');
		Db::getInstance()->Execute('DROP TABLE IF EXISTS '._DB_PREFIX_.'blog_category2post');
		return true;
	}
	
	public function hookFooter($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		$_data_cat = $obj_blog->getCategoriesBlock();
		$_data_post = $obj_blog->getRecentsPosts();
		$_data_arch = $obj_blog->getArchives();
		$_data_com = $obj_blog->getLastComments();
    	
		
		$smarty->assign(array($this->name.'categories' => $_data_cat['categories'],
							  $this->name.'posts' => $_data_post['posts'],
							  $this->name.'arch' => $_data_arch['posts'],
							  $this->name.'comments' => $_data_com['comments']
							  )
						);
		
						
    	
		
						
		$smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));
		
		
		$smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
		$smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));
		
		$smarty->assign($this->name.'cat_footer', Configuration::get($this->name.'cat_footer'));
		$smarty->assign($this->name.'posts_footer', Configuration::get($this->name.'posts_footer'));
		$smarty->assign($this->name.'arch_footer', Configuration::get($this->name.'arch_footer'));
		$smarty->assign($this->name.'search_footer', Configuration::get($this->name.'search_footer'));
		$smarty->assign($this->name.'com_footer', Configuration::get($this->name.'com_footer'));
		
		$smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));
		
		$ps15 = 0;
		if($this->_is15){
			$ps15 = 1;
		} 
		$smarty->assign($this->name.'is_ps15', $ps15);
		
		if($this->_is_friendly_url){
			$smarty->assign($this->name.'iso_lng', $this->_iso_lng);
		} else {
			$smarty->assign($this->name.'iso_lng', '');
		}
		
		$smarty->assign($this->name.'pic', $this->path_img_cloud);


        $this->setSEOUrls();

        $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
        $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));
		
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/footer.tpl');
			
	}

    public function setSEOUrls(){
        $smarty = $this->context->smarty;
        include_once(dirname(__FILE__).'/classes/blog.class.php');
        $obj_blog = new blog();

        $data_url = $obj_blog->getSEOURLs();
        $category_url = $data_url['category_url'];
        $categories_url = $data_url['categories_url'];
        $posts_url = $data_url['posts_url'];
        $post_url = $data_url['post_url'];
        $comments_url = $data_url['comments_url'];

        $smarty->assign(
                        array($this->name.'category_url' => $category_url,
                              $this->name.'categories_url' => $categories_url,
                              $this->name.'posts_url' => $posts_url,
                              $this->name.'post_url' => $post_url,
                              $this->name.'comments_url' => $comments_url
                            )
        );




    }

    public function hookblogCommentsSPM($params)
    {
        $comm_custom_hook = Configuration::get($this->name.'comm_custom_hook');

        if($comm_custom_hook == 1){

            $smarty = $this->context->smarty;

            $smarty->assign($this->name.'is16', $this->_is16);

            include_once(dirname(__FILE__).'/classes/blog.class.php');
            $obj_blog = new blog();
            $_data_com = $obj_blog->getLastComments();

            $smarty->assign(array(
                    $this->name.'comments' => $_data_com['comments']
                )
            );

            $smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));


            $smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
            $smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));


            $ps15 = 0;
            if($this->_is15){
                $ps15 = 1;
            }
            $smarty->assign($this->name.'is_ps15', $ps15);

            $smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));

            if($this->_is_friendly_url){
                $smarty->assign($this->name.'iso_lng', $this->_iso_lng);
            } else {
                $smarty->assign($this->name.'iso_lng', '');
            }

            $smarty->assign($this->name.'pic', $this->path_img_cloud);

            $this->setSEOUrls();

            $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
            $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));

            return $this->display(__FILE__, 'views/templates/hooks/blogcommentsspm.tpl');
        }

    }

    public function hookblogPostsSPM($params)
    {
        $posts_custom_hook = Configuration::get($this->name.'posts_custom_hook');

        if($posts_custom_hook == 1){

            $smarty = $this->context->smarty;

            $smarty->assign($this->name.'is16', $this->_is16);

            include_once(dirname(__FILE__).'/classes/blog.class.php');
            $obj_blog = new blog();
            $_data_post = $obj_blog->getRecentsPosts();


            $smarty->assign(array(
                    $this->name.'posts' => $_data_post['posts'],
                    )
            );

            $smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));


            $smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
            $smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));


            $ps15 = 0;
            if($this->_is15){
                $ps15 = 1;
            }
            $smarty->assign($this->name.'is_ps15', $ps15);

            $smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));

            if($this->_is_friendly_url){
                $smarty->assign($this->name.'iso_lng', $this->_iso_lng);
            } else {
                $smarty->assign($this->name.'iso_lng', '');
            }

            $smarty->assign($this->name.'pic', $this->path_img_cloud);

            $this->setSEOUrls();

            $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
            $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));

            return $this->display(__FILE__, 'views/templates/hooks/blogpostsspm.tpl');
        }

    }

    public function hookblogCategoriesSPM($params)
    {
        $cat_custom_hook = Configuration::get($this->name.'cat_custom_hook');

        if($cat_custom_hook == 1){

            $smarty = $this->context->smarty;

            $smarty->assign($this->name.'is16', $this->_is16);

            include_once(dirname(__FILE__).'/classes/blog.class.php');
            $obj_blog = new blog();
            $_data_cat = $obj_blog->getCategoriesBlock();

            $smarty->assign(array($this->name.'categories' => $_data_cat['categories'],

                )
            );

            $smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));


            $smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
            $smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));


            $ps15 = 0;
            if($this->_is15){
                $ps15 = 1;
            }
            $smarty->assign($this->name.'is_ps15', $ps15);

            $smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));

            if($this->_is_friendly_url){
                $smarty->assign($this->name.'iso_lng', $this->_iso_lng);
            } else {
                $smarty->assign($this->name.'iso_lng', '');
            }

            $smarty->assign($this->name.'pic', $this->path_img_cloud);

            $this->setSEOUrls();

            $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
            $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));

            return $this->display(__FILE__, 'views/templates/hooks/blogcategoriesspm.tpl');
        }

    }

	public function hookLeftColumn($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
    	$_data_cat = $obj_blog->getCategoriesBlock();
		$_data_post = $obj_blog->getRecentsPosts();
		$_data_arch = $obj_blog->getArchives();
    	$_data_com = $obj_blog->getLastComments();






        $smarty->assign(array($this->name.'categories' => $_data_cat['categories'],
							  $this->name.'posts' => $_data_post['posts'],
							  $this->name.'arch' => $_data_arch['posts'],
							  $this->name.'comments' => $_data_com['comments']
							  )
						);
		
		$smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));
		
		
		$smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
		$smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));
		
		$smarty->assign($this->name.'cat_left', Configuration::get($this->name.'cat_left'));
		$smarty->assign($this->name.'posts_left', Configuration::get($this->name.'posts_left'));
		$smarty->assign($this->name.'arch_left', Configuration::get($this->name.'arch_left'));
		$smarty->assign($this->name.'search_left', Configuration::get($this->name.'search_left'));
		$smarty->assign($this->name.'com_left', Configuration::get($this->name.'com_left'));
		
		
		$ps15 = 0;
		if($this->_is15){
			$ps15 = 1;
		} 
		$smarty->assign($this->name.'is_ps15', $ps15);
		
		$smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));
		
		if($this->_is_friendly_url){
			$smarty->assign($this->name.'iso_lng', $this->_iso_lng);
		} else {
			$smarty->assign($this->name.'iso_lng', '');
		}
		
		$smarty->assign($this->name.'pic', $this->path_img_cloud);

        $this->setSEOUrls();

        $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
        $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));

		
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/left.tpl');
		
	}
	
	public function hookRightColumn($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		$_data_cat = $obj_blog->getCategoriesBlock();
		$_data_post = $obj_blog->getRecentsPosts();
		$_data_arch = $obj_blog->getArchives();
    	$_data_com = $obj_blog->getLastComments();
		
		$smarty->assign(array($this->name.'categories' => $_data_cat['categories'],
							  $this->name.'posts' => $_data_post['posts'],
							  $this->name.'arch' => $_data_arch['posts'],
							  $this->name.'comments' => $_data_com['comments']
							  )
						);
						
    	
		
		$smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));
		$smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
		$smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));
		
		$smarty->assign($this->name.'cat_right', Configuration::get($this->name.'cat_right'));
		$smarty->assign($this->name.'posts_right', Configuration::get($this->name.'posts_right'));
		$smarty->assign($this->name.'arch_right', Configuration::get($this->name.'arch_right'));
		$smarty->assign($this->name.'search_right', Configuration::get($this->name.'search_right'));
		$smarty->assign($this->name.'com_right', Configuration::get($this->name.'com_right'));
		
		$smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));
		
		$ps15 = 0;
		if($this->_is15){
			$ps15 = 1;
		} 
		$smarty->assign($this->name.'is_ps15', $ps15);
		
		if($this->_is_friendly_url){
			$smarty->assign($this->name.'iso_lng', $this->_iso_lng);
		} else {
			$smarty->assign($this->name.'iso_lng', '');
		}
		
		$smarty->assign($this->name.'pic', $this->path_img_cloud);


        $this->setSEOUrls();

        $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
        $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));
		
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/right.tpl');
		
	}
	
	
	public function hookhome($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
    	$_data_post = $obj_blog->getRecentsPosts(array('is_home'=>1));
    	
    	
    	foreach($_data_post['posts'] as $k=>$val){
    		foreach($val['data'] as $_k => $_item){
    			$_data_post['posts'][$k]['data'][$_k]['content'] = strip_tags(html_entity_decode($_item['content']));
    		}
    	}
		
    	
		$smarty->assign(array($this->name.'posts' => $_data_post['posts']
							  )
						);
		
		$smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));
		
		$smarty->assign($this->name.'block_last_home', Configuration::get($this->name.'block_last_home'));
		
		$smarty->assign($this->name.'block_display_img', Configuration::get($this->name.'block_display_img'));
		$smarty->assign($this->name.'block_display_date', Configuration::get($this->name.'block_display_date'));
		
		
		$ps15 = 0;
		if($this->_is15){
			$ps15 = 1;
		} 
		$smarty->assign($this->name.'is_ps15', $ps15);
		
		$smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));
		
		if($this->_is_friendly_url){
			$smarty->assign($this->name.'iso_lng', $this->_iso_lng);
		} else {
			$smarty->assign($this->name.'iso_lng', '');
		}
		
		$blog_h = (int)Configuration::get($this->name.'blog_h');
		if($blog_h == 0)
			$blog_h = 1;
		
		$smarty->assign($this->name.'blog_h', $blog_h);
		
		
		$smarty->assign($this->name.'pic', $this->path_img_cloud);

        $this->setSEOUrls();

        $smarty->assign($this->name.'blog_com_tr', Configuration::get($this->name.'blog_com_tr'));
        $smarty->assign($this->name.'blog_p_tr', Configuration::get($this->name.'blog_p_tr'));
		
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/home.tpl');
	
	}
	
	public function hookHeader($params){
    	$smarty = $this->context->smarty;
		
    	$smarty->assign($this->name.'rsson', Configuration::get($this->name.'rsson'));
    	$smarty->assign($this->name.'is15', $this->_is15);
    	if(version_compare(_PS_VERSION_, '1.5', '>')){
    		$this->context->controller->addCSS(($this->_path).'views/css/blog.css', 'all');
            $this->context->controller->addCSS(($this->_path).'views/css/font-custom.min.css', 'all');
            $this->context->controller->addJS($this->_path.'views/js/blog.js');
    	}
        if(version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<'))
            $this->context->controller->addCSS(($this->_path).'views/css/blog15.css', 'all');

        $is_ps14 = 0;
        if(version_compare(_PS_VERSION_, '1.5', '<'))
        {
            $is_ps14 = 1;

        }
        $smarty->assign($this->name.'is_ps14', $is_ps14);


        $smarty->assign($this->name.'is_cloud', $this->_is_cloud);


        $item_id = Tools::getValue('post_id');
        $is_blog_page = 0;
        if($item_id){
            $is_blog_page = 1;


            include_once(dirname(__FILE__).'/classes/blog.class.php');
            $obj = new blog();

            $item_id = $obj->getTransformSEOURLtoIDPost(array('id'=>$item_id));

            $_info_cat = $obj->getPostItem(array('id' => $item_id,'site'=>1));


            $name = isset($_info_cat['post'][0]['title'])?$_info_cat['post'][0]['title']:'';
            $img = isset($_info_cat['post'][0]['img_orig'])?$_info_cat['post'][0]['img_orig']:'';

            $smarty->assign($this->name.'name', $name);
            $smarty->assign($this->name.'img', $img);
        }

        $smarty->assign($this->name.'is_blog', $is_blog_page);
		
    	return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/head.tpl');
    
    }
    
     public function hookproductTabContent($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
    	$_data_cat = $obj_blog->getCategoriesBlock();
		
		$smarty->assign(array($this->name.'categories' => $_data_cat['categories']
							  )
						);	
		
		$smarty->assign($this->name.'urlrewrite_on', Configuration::get($this->name.'urlrewrite_on'));
		$smarty->assign($this->name.'tab_blog_pr', Configuration::get($this->name.'tab_blog_pr'));
		
		if($this->_is_friendly_url){
			$smarty->assign($this->name.'iso_lng', $this->_iso_lng);
		} else {
			$smarty->assign($this->name.'iso_lng', '');
		}

        $smarty->assign($this->name.'btabs_type',Configuration::get($this->name.'btabs_type'));
		
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/TabContent.tpl');
	
	}	
	
	public function hookproductTab($params)
	{
		$smarty = $this->context->smarty;
		
		$smarty->assign($this->name.'is16', $this->_is16);
		

		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
    	$_data_cat = $obj_blog->getCategoriesBlock();
		
		$smarty->assign(array($this->name.'categories' => $_data_cat['categories']
							  )
						);	
		$smarty->assign($this->name.'tab_blog_pr', Configuration::get($this->name.'tab_blog_pr'));
        $smarty->assign($this->name.'btabs_type',Configuration::get($this->name.'btabs_type'));
			
		return $this->display(dirname(__FILE__).'/blockblog.php', 'views/templates/hooks/tab.tpl');
		
	}

    protected function addBackOfficeMedia()
    {
        $this->context->controller->addCSS($this->_path.'views/css/font-custom.min.css');
        //CSS files
        $this->context->controller->addCSS($this->_path.'views/css/blog.css');

        // JS files
        $this->context->controller->addJs($this->_path.'views/js/menu16.js');




    }
	
    public function getContent()
    {

        $cookie = $this->context->cookie;

        $currentIndex = $this->context->currentindex;

    	include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
    	


        $errors = array();
		
    	$this->_html = '';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->addBackOfficeMedia();
        } else {
            $this->_html .= $this->_jsandcss();
        }

        ################# category ##########################
        // list category
       $page_cat = Tools::getValue("pagecategories");
       $list_categories = Tools::getValue("list_categories");
        if (Tools::strlen($page_cat)>0 || Tools::strlen($list_categories)>0) {
        	$this->_html .= '<script>init_tabs(2);</script>';
        }
        $edit_item_category = Tools::getValue("edit_item_category");
    	if (Tools::strlen($edit_item_category)>0) {
        	$this->_html .= '<script>init_tabs(3);</script>';
        }
        
        
        // add category
        if (Tools::isSubmit("submit_addcategory")) {
            $time_add = Tools::getValue("time_add_cat");
        	$seo_url = Tools::getValue("seo_url");
        	$languages = Language::getLanguages(false);
	    	$data_title_content_lang = array();
	    	
	    	if($this->_is15){
	    		$cat_shop_association = Tools::getValue("cat_shop_association");
	    	} else{
	    		$cat_shop_association = array(0=>1);
	    	}
	    	
	    	
	    	
	    	foreach ($languages as $language){
	    		$id_lang = $language['id_lang'];
	    		$category_title = Tools::getValue("category_title_".$id_lang);
	    		$category_seokeywords = Tools::getValue("category_seokeywords_".$id_lang);
	    		$category_seodescription = Tools::getValue("category_seodescription_".$id_lang);
	    		
	    		if(Tools::strlen($category_title)>0 && !empty($cat_shop_association))
	    		{
	    			$data_title_content_lang[$id_lang] = array('category_title' => $category_title,
	    									 				   'category_seokeywords' => $category_seokeywords,
	    			 										   'category_seodescription' => $category_seodescription,
	    													   'seo_url' =>$seo_url
	    														
	    													    );		
	    		}
	    	}
	    	
        	$data = array( 'data_title_content_lang'=>$data_title_content_lang,
        					'cat_shop_association' => $cat_shop_association, 'time_add' => $time_add
         				  );
         	
         		
        	
         	if(sizeof($data_title_content_lang)>0)
        		$obj_blog->saveCategory($data);
         	
         	Tools::redirectAdmin($currentIndex.'&list_categories=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			 
         }
        // delete category
        $delete_item_category = Tools::getValue("delete_item_category");
        if (Tools::strlen($delete_item_category)>0) {
			if (Validate::isInt(Tools::getValue("id_category"))) {
				$obj_blog->deleteCategory(array('id'=>Tools::getValue("id_category")));
				Tools::redirectAdmin($currentIndex.'&list_categories=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			}
		}
		// cancel edit category 
    	if (Tools::isSubmit('cancel_editcategory'))
        {
       	Tools::redirectAdmin($currentIndex.'&list_categories=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
		}
		//edit category
     	if (Tools::isSubmit("submit_editcategory")) {
            $status = Tools::getValue('cat_status');
            $time_add = Tools::getValue("time_add_cat");
     		$seo_url = Tools::getValue("seo_url");
     		$languages = Language::getLanguages(false);
	    	$data_title_content_lang = array();
	    	
     		if($this->_is15){
	    		$cat_shop_association = Tools::getValue("cat_shop_association");
	    	} else{
	    		$cat_shop_association = array(0=>1);
	    	}
	    	foreach ($languages as $language){
	    		$id_lang = $language['id_lang'];
	    		$category_title = Tools::getValue("category_title_".$id_lang);
	    		$category_seokeywords = Tools::getValue("category_seokeywords_".$id_lang);
	    		$category_seodescription = Tools::getValue("category_seodescription_".$id_lang);
	    		
	    		if(Tools::strlen($category_title)>0)
	    		{
	    			$data_title_content_lang[$id_lang] = array('category_title' => $category_title,
	    									 				   'category_seokeywords' => $category_seokeywords,
	    													   'category_seodescription' => $category_seodescription,
	    													   'seo_url' =>$seo_url
	    													    );		
	    		}
	    	}
        	
     		
         	$id_editcategory = Tools::getValue("id_editcategory");
         	$data = array('data_title_content_lang'=>$data_title_content_lang,
        				  'id_editcategory' => $id_editcategory,
         				  'cat_shop_association' => $cat_shop_association,
                            'status' => $status,
                            'time_add' => $time_add,
         				 );

         	if(sizeof($data_title_content_lang)>0)
         		$obj_blog->updateCategory($data);
         	$this->_html .= '<script>init_tabs(2);</script>'; 
         	Tools::redirectAdmin($currentIndex.'&list_categories=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			
         }
		 ################# category ##########################
		 
         
         ################# posts ##########################
        // add post
    	if (Tools::isSubmit("submit_addpost")) {
         	$seo_url = Tools::getValue("seo_url");
    		$languages = Language::getLanguages(false);
	    	$data_title_content_lang = array();
	    	
	    	
	    	$ids_related_products = Tools::getValue("inputAccessories");
	    	
	    	$ids_related_posts = Tools::getValue("ids_related_posts");
	    	
	    	$time_add = Tools::getValue("time_add_post");
	    	
    		if($this->_is15){
	    		$cat_shop_association = Tools::getValue("cat_shop_association");
	    	} else{
	    		$cat_shop_association = array(0=>1);
	    	}
	    	
	    	foreach ($languages as $language){
	    		$id_lang = $language['id_lang'];
	    		$post_title = Tools::getValue("post_title_".$id_lang);
	    		$post_seokeywords = Tools::getValue("post_seokeywords_".$id_lang);
	    		$post_seodescription = Tools::getValue("post_seodescription_".$id_lang);
	    		$post_content = Tools::getValue("content_".$id_lang);
	    		
	    		if(Tools::strlen($post_title)>0 && !empty($cat_shop_association))
	    		{
	    			$data_title_content_lang[$id_lang] = array('post_title' => $post_title,
	    									 				   'post_seokeywords' => $post_seokeywords,
	    			 										   'post_seodescription' => $post_seodescription,
	    													   'post_content' => $post_content,
	    														'seo_url' => $seo_url
	    													    );		
	    		}
	    	}
	    	
        	
         	$ids_categories = Tools::getValue("ids_categories");
        	$post_status = Tools::getValue("post_status");
        	$post_iscomments = Tools::getValue("post_iscomments");
        	
         	$data = array('data_title_content_lang'=>$data_title_content_lang,
         				  'ids_categories' => $ids_categories,
         				  'post_status' => $post_status,
         				  'post_iscomments' => $post_iscomments,
         				  'cat_shop_association' => $cat_shop_association,
         				  'related_products'=>$ids_related_products,
         				  'ids_related_posts'=>$ids_related_posts,
         				  'time_add' => $time_add
         				 );
         				 
			//echo "<pre>"; var_dump($data);exit;
         				 
         	if(sizeof($data_title_content_lang)>0 && sizeof($ids_categories)>0)
         		$obj_blog->savePost($data);
         	Tools::redirectAdmin($currentIndex.'&list_posts=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			
         }
        //list posts
        $page_cat = Tools::getValue("pageposts");
        $list_posts = Tools::getValue("list_posts");
        if (Tools::strlen($page_cat)>0 || Tools::strlen($list_posts)>0) {
        	$this->_html .= '<script>init_tabs(4);</script>';
        }
    	$edit_item_posts = Tools::getValue("edit_item_posts");
    	if (Tools::strlen($edit_item_posts)>0) {
        	$this->_html .= '<script>init_tabs(5);</script>';
        }
    	// delete posts
        $delete_item_posts = Tools::getValue("delete_item_posts");
        if (Tools::strlen($delete_item_posts)>0) {
			if (Validate::isInt(Tools::getValue("id_posts"))) {
				$obj_blog->deletePost(array('id'=>Tools::getValue("id_posts")));
				Tools::redirectAdmin($currentIndex.'&list_posts=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			}
		}
    	// cancel edit posts 
    	if (Tools::isSubmit('cancel_editposts'))
        {
       	Tools::redirectAdmin($currentIndex.'&list_posts=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
		}
   		 //edit posts
     	if (Tools::isSubmit("submit_editposts")) {
     		$seo_url = Tools::getValue("seo_url");
     		$languages = Language::getLanguages(false);
	    	$data_title_content_lang = array();
	    	
	    	$ids_related_products = Tools::getValue("inputAccessories");
	    	
	    	$ids_related_posts = Tools::getValue("ids_related_posts");
	    	
	    	
	    	$time_add = Tools::getValue("time_add_post");
	    	if($this->_is15){
	    		$cat_shop_association = Tools::getValue("cat_shop_association");
	    	} else{
	    		$cat_shop_association = array(0=>1);
	    	}
	    	
	    	
	    	foreach ($languages as $language){
	    		$id_lang = $language['id_lang'];
	    		$post_title = Tools::getValue("post_title_".$id_lang);
	    		$post_seokeywords = Tools::getValue("post_seokeywords_".$id_lang);
	    		$post_seodescription = Tools::getValue("post_seodescription_".$id_lang);
	    		$post_content = Tools::getValue("content_".$id_lang);
	    		
	    		if(Tools::strlen($post_title)>0)
	    		{
	    			$data_title_content_lang[$id_lang] = array('post_title' => $post_title,
	    									 				   'post_seokeywords' => $post_seokeywords,
	    			 										   'post_seodescription' => $post_seodescription,
	    													   'post_content' => $post_content,
	    														'seo_url'=>$seo_url
	    													    );		
	    		}
	    	}
     		
     		$id_editposts = Tools::getValue("id_editposts");
     		
         	$ids_categories = Tools::getValue("ids_categories");
        	$post_status = Tools::getValue("post_status");
        	$post_iscomments = Tools::getValue("post_iscomments");
        	$post_images = Tools::getValue("post_images");
        	
         	$data = array('data_title_content_lang'=>$data_title_content_lang,
         				  'ids_categories' => $ids_categories,
         				  'post_status' => $post_status,
         				  'post_iscomments' => $post_iscomments,
         				  'id_editposts' => $id_editposts,
         				  'post_images' => $post_images,
         				  'cat_shop_association' => $cat_shop_association,
         				  'related_products'=>$ids_related_products,
         				  'ids_related_posts'=>$ids_related_posts,
         				  'time_add' => $time_add
         				 );

         				 
         		 
         				 
         	if(sizeof($data_title_content_lang)>0 && sizeof($ids_categories)>0)
         		$obj_blog->updatePost($data);
         	$this->_html .= '<script>init_tabs(4);</script>';
         	Tools::redirectAdmin($currentIndex.'&list_posts=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
		 }
         ################# posts ##########################
         
		 
		 ################# comments ##########################
        // delete comments
        $delete_item_comments = Tools::getValue("delete_item_comments");
        
        if (Tools::strlen($delete_item_comments)>0) {
        	if (Validate::isInt(Tools::getValue("id_comments"))) {
				$obj_blog->deleteComment(array('id'=>Tools::getValue("id_comments")));
				Tools::redirectAdmin($currentIndex.'&list_comments=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
			}
		}
    	 //list comments
        $page_comments = Tools::getValue("pagecomments");
        $list_comments = Tools::getValue("list_comments");
        if (Tools::strlen($page_comments)>0 || Tools::strlen($list_comments)>0) {
        	$this->_html .= '<script>init_tabs(6);</script>';
        }
   	    $edit_item_comments = Tools::getValue("edit_item_comments");
    	if (Tools::strlen($edit_item_comments)>0) {
        	$this->_html .= '<script>init_tabs(7);</script>';
        }
    	// cancel edit comments 
    	if (Tools::isSubmit('cancel_editcomments'))
        {
       	Tools::redirectAdmin($currentIndex.'&list_comments=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
		}
     	//edit comments
     	if (Tools::isSubmit("submit_editcomments")) {
            $time_add = Tools::getValue("time_add_comm");
     		$id_editcomments = Tools::getValue("id_editcomments");
     		
         	$comments_name = Tools::getValue("comments_name");
        	$comments_email = Tools::getValue("comments_email");
        	$comments_comment = Tools::getValue("comments_comment");
        	$comments_status = Tools::getValue("comments_status");
        	
         	$data = array('comments_name' => $comments_name,
         				  'comments_email' => $comments_email,
         				  'comments_comment' => $comments_comment,
         				  'comments_status' => $comments_status,
         	 			  'id_editcomments' => $id_editcomments,
                            'time_add'=>$time_add,
         				 );
         	if(Tools::strlen($comments_name)>0 && Tools::strlen($comments_comment)>0)
         		$obj_blog->updateComment($data);
         	$this->_html .= '<script>init_tabs(6);</script>';
         	Tools::redirectAdmin($currentIndex.'&list_comments=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'');
		 }
        ################# comments ##########################


        ### url rewrite settings ###
        $blogurlrewritesettings = Tools::getValue("blogurlrewritesettings");
        if (Tools::strlen($blogurlrewritesettings)>0) {

                $this->_html .= '<script>init_tabs(1);</script>';

            if($this->_is16 == 0)
                $this->_html .= '<script>init_tabs_in(31);</script>';


        }


        if (Tools::isSubmit('urlrewritesettings'))
        {
            Configuration::updateValue($this->name.'urlrewrite_on', Tools::getValue('urlrewrite_on'));

            $url = $currentIndex.'&conf=6&tab=AdminModules&blogurlrewritesettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            //var_dump($url);exit;
            Tools::redirectAdmin($url);

        }
        ### url rewrite settings ###

        ### categoriessettings ###
        $blogcategoriessettings = Tools::getValue("blogcategoriessettings");
        if (Tools::strlen($blogcategoriessettings)>0) {



            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(32);</script>';
            } else {
                $this->_html .= '<script>init_tabs(2);</script>';
            }

        }


        if (Tools::isSubmit('categoriessettings'))
        {
            Configuration::updateValue($this->name.'cat_list_display_date', Tools::getValue('cat_list_display_date'));
            Configuration::updateValue($this->name.'perpage_catblog', Tools::getValue('perpage_catblog'));

            Configuration::updateValue($this->name.'tab_blog_pr', Tools::getValue('tab_blog_pr'));

            Configuration::updateValue($this->name.'btabs_type', Tools::getValue('btabs_type'));


            $url = $currentIndex.'&conf=6&tab=AdminModules&blogcategoriessettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### categoriessettings ###


        ### postssettings ###
        $blogpostssettings = Tools::getValue("blogpostssettings");
        if (Tools::strlen($blogpostssettings)>0) {


            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(33);</script>';
            } else {
                $this->_html .= '<script>init_tabs(3);</script>';
            }

        }


        if (Tools::isSubmit('postssettings'))
        {
            Configuration::updateValue($this->name.'perpage_posts', Tools::getValue('perpage_posts'));
            Configuration::updateValue($this->name.'p_list_displ_date', Tools::getValue('p_list_displ_date'));
            Configuration::updateValue($this->name.'lists_img_width', Tools::getValue('lists_img_width'));
            Configuration::updateValue($this->name.'blog_pl_tr', Tools::getValue('blog_pl_tr'));

            Configuration::updateValue($this->name.'img_size_rp', Tools::getValue('img_size_rp'));
            Configuration::updateValue($this->name.'blog_rp_tr', Tools::getValue('blog_rp_tr'));

            Configuration::updateValue($this->name.'post_display_date', Tools::getValue('post_display_date'));
            Configuration::updateValue($this->name.'post_img_width', Tools::getValue('post_img_width'));
            Configuration::updateValue($this->name.'is_soc_buttons', Tools::getValue('is_soc_buttons'));

            Configuration::updateValue($this->name.'rp_img_width', Tools::getValue('rp_img_width'));


            $url = $currentIndex.'&conf=6&tab=AdminModules&blogpostssettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### postssettings ###


        ### commentssettings ##
        $blogcommentssettings = Tools::getValue("blogcommentssettings");
        if (Tools::strlen($blogcommentssettings)>0) {



            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(34);</script>';
            } else {
                $this->_html .= '<script>init_tabs(4);</script>';
            }

        }


        if (Tools::isSubmit('commentssettings'))
        {
            Configuration::updateValue($this->name.'perpage_com', Tools::getValue('perpage_com'));
            Configuration::updateValue($this->name.'pperpage_com', Tools::getValue('pperpage_com'));

            $url = $currentIndex.'&conf=6&tab=AdminModules&blogcommentssettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### commentssettings ###


        ### blockssettings ###
        $blogblockssettings = Tools::getValue("blogblockssettings");
        if (Tools::strlen($blogblockssettings)>0) {


            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(35);</script>';
            } else {
                $this->_html .= '<script>init_tabs(5);</script>';
            }

        }


        if (Tools::isSubmit('blockssettings'))
        {
            Configuration::updateValue($this->name.'blog_bcat', Tools::getValue('blog_bcat'));

            Configuration::updateValue($this->name.'blog_bposts', Tools::getValue('blog_bposts'));
            Configuration::updateValue($this->name.'block_display_date', Tools::getValue('block_display_date'));
            Configuration::updateValue($this->name.'block_display_img', Tools::getValue('block_display_img'));
            Configuration::updateValue($this->name.'posts_block_img_width', Tools::getValue('posts_block_img_width'));

            Configuration::updateValue($this->name.'blog_h', Tools::getValue('blog_h'));
            Configuration::updateValue($this->name.'blog_bp_h', Tools::getValue('blog_bp_h'));
            Configuration::updateValue($this->name.'posts_w_h', Tools::getValue('posts_w_h'));
            Configuration::updateValue($this->name.'block_last_home', Tools::getValue('block_last_home'));
            Configuration::updateValue($this->name.'blog_p_tr', Tools::getValue('blog_p_tr'));

            Configuration::updateValue($this->name.'blog_com', Tools::getValue('blog_com'));

            Configuration::updateValue($this->name.'blog_com_tr', Tools::getValue('blog_com_tr'));



            $url = $currentIndex.'&conf=6&tab=AdminModules&blogblockssettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### blockssettings ###


        ### blockpositions ###
        $blogblockpositions = Tools::getValue("blogblockpositions");
        if (Tools::strlen($blogblockpositions)>0) {


            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(36);</script>';
            } else {
                $this->_html .= '<script>init_tabs(6);</script>';
            }

        }


        if (Tools::isSubmit('blockpositions'))
        {
            // footer
            Configuration::updateValue($this->name.'cat_footer', Tools::getValue('cat_footer'));
            Configuration::updateValue($this->name.'posts_footer', Tools::getValue('posts_footer'));
            Configuration::updateValue($this->name.'arch_footer', Tools::getValue('arch_footer'));
            Configuration::updateValue($this->name.'search_footer', Tools::getValue('search_footer'));
            Configuration::updateValue($this->name.'com_footer', Tools::getValue('com_footer'));
            // footer

            // right
            Configuration::updateValue($this->name.'cat_right', Tools::getValue('cat_right'));
            Configuration::updateValue($this->name.'posts_right', Tools::getValue('posts_right'));
            Configuration::updateValue($this->name.'arch_right', Tools::getValue('arch_right'));
            Configuration::updateValue($this->name.'search_right', Tools::getValue('search_right'));
            Configuration::updateValue($this->name.'com_right', Tools::getValue('com_right'));
            // right


            // left
            Configuration::updateValue($this->name.'cat_left', Tools::getValue('cat_left'));
            Configuration::updateValue($this->name.'posts_left', Tools::getValue('posts_left'));
            Configuration::updateValue($this->name.'arch_left', Tools::getValue('arch_left'));
            Configuration::updateValue($this->name.'search_left', Tools::getValue('search_left'));
            Configuration::updateValue($this->name.'com_left', Tools::getValue('com_left'));
            // left

            Configuration::updateValue($this->name.'cat_custom_hook', Tools::getValue('cat_custom_hook'));
            Configuration::updateValue($this->name.'posts_custom_hook', Tools::getValue('posts_custom_hook'));
            Configuration::updateValue($this->name.'comm_custom_hook', Tools::getValue('comm_custom_hook'));



            $url = $currentIndex.'&conf=6&tab=AdminModules&blogblockpositions=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### blockpositions ###


        ### rssfeedsettings ###

        $blogrssfeedsettings = Tools::getValue("blogrssfeedsettings");
        if (Tools::strlen($blogrssfeedsettings)>0) {


            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(38);</script>';
            } else {
                $this->_html .= '<script>init_tabs(7);</script>';
            }

        }


        if (Tools::isSubmit('rssfeedsettings'))
        {
            Configuration::updateValue($this->name.'rsson', Tools::getValue('rsson'));
            Configuration::updateValue($this->name.'number_rssitems', Tools::getValue('number_rssitems'));


            $languages = Language::getLanguages(false);
            foreach ($languages as $language){
                $i = $language['id_lang'];
                Configuration::updateValue($this->name.'rssname_'.$i, Tools::getValue('rssname_'.$i));
                Configuration::updateValue($this->name.'rssdesc_'.$i, Tools::getValue('rssdesc_'.$i));
            }

            $url = $currentIndex.'&conf=6&tab=AdminModules&blogrssfeedsettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### rssfeedsettings ###


        ### emailsettings ###
        $blogemailsettings = Tools::getValue("blogemailsettings");
        if (Tools::strlen($blogemailsettings)>0) {



            if($this->_is16 == 0){
                $this->_html .= '<script>init_tabs(1);</script>';
                $this->_html .= '<script>init_tabs_in(37);</script>';
            } else {
                $this->_html .= '<script>init_tabs(8);</script>';
            }

        }


        if (Tools::isSubmit('emailsettings'))
        {
            Configuration::updateValue($this->name.'noti', Tools::getValue('noti'));
            Configuration::updateValue($this->name.'mail', Tools::getValue('mail'));


            $url = $currentIndex.'&conf=6&tab=AdminModules&blogemailsettings=1&configure='.$this->name.'&token='.Tools::getAdminToken('AdminModules'.(int)(Tab::getIdFromClassName('AdminModules')).(int)($cookie->id_employee)).'';
            Tools::redirectAdmin($url);

        }
        ### emailsettings ###



        if (Tools::isSubmit('submit_blogsettings'))
        {
        	// footer 
        	Configuration::updateValue($this->name.'cat_footer', Tools::getValue('cat_footer'));
			Configuration::updateValue($this->name.'posts_footer', Tools::getValue('posts_footer'));
			Configuration::updateValue($this->name.'arch_footer', Tools::getValue('arch_footer'));
			Configuration::updateValue($this->name.'search_footer', Tools::getValue('search_footer'));
			Configuration::updateValue($this->name.'com_footer', Tools::getValue('com_footer'));
        	// footer 
        	
        	// right 
        	Configuration::updateValue($this->name.'cat_right', Tools::getValue('cat_right'));
			Configuration::updateValue($this->name.'posts_right', Tools::getValue('posts_right'));
			Configuration::updateValue($this->name.'arch_right', Tools::getValue('arch_right'));
			Configuration::updateValue($this->name.'search_right', Tools::getValue('search_right'));
			Configuration::updateValue($this->name.'com_right', Tools::getValue('com_right'));
        	// right 
        	
			
			// left 
        	Configuration::updateValue($this->name.'cat_left', Tools::getValue('cat_left'));
			Configuration::updateValue($this->name.'posts_left', Tools::getValue('posts_left'));
			Configuration::updateValue($this->name.'arch_left', Tools::getValue('arch_left'));
			Configuration::updateValue($this->name.'search_left', Tools::getValue('search_left'));
			Configuration::updateValue($this->name.'com_left', Tools::getValue('com_left'));
        	// left 
        	
			 // comments //
			 Configuration::updateValue($this->name.'blog_com', Tools::getValue('blog_com')); 
        	 Configuration::updateValue($this->name.'perpage_com', Tools::getValue('perpage_com')); 
        	 // comments //
        	
        	 Configuration::updateValue($this->name.'urlrewrite_on', Tools::getValue('urlrewrite_on'));
        	 
        	 Configuration::updateValue($this->name.'blog_h', Tools::getValue('blog_h'));
        	 Configuration::updateValue($this->name.'blog_bp_h', Tools::getValue('blog_bp_h'));
        	 Configuration::updateValue($this->name.'posts_w_h', Tools::getValue('posts_w_h'));
        	 
        	 Configuration::updateValue($this->name.'cat_list_display_date', Tools::getValue('cat_list_display_date'));
             Configuration::updateValue($this->name.'perpage_catblog', Tools::getValue('perpage_catblog'));

        	 Configuration::updateValue($this->name.'p_list_displ_date', Tools::getValue('p_list_displ_date'));
        	 Configuration::updateValue($this->name.'perpage_posts', Tools::getValue('perpage_posts'));
        	 Configuration::updateValue($this->name.'lists_img_width', Tools::getValue('lists_img_width'));
        	 Configuration::updateValue($this->name.'block_display_date', Tools::getValue('block_display_date')); 
        	 Configuration::updateValue($this->name.'block_display_img', Tools::getValue('block_display_img')); 
        	 
        	 Configuration::updateValue($this->name.'posts_block_img_width', Tools::getValue('posts_block_img_width')); 
        	 
        	 
        	 
        	 Configuration::updateValue($this->name.'noti', Tools::getValue('noti'));
        	 Configuration::updateValue($this->name.'mail', Tools::getValue('mail'));

        	 
        	 
        	 Configuration::updateValue($this->name.'block_last_home', Tools::getValue('block_last_home'));
        	 Configuration::updateValue($this->name.'tab_blog_pr', Tools::getValue('tab_blog_pr'));
        	 
        	 
        	 Configuration::updateValue($this->name.'post_display_date', Tools::getValue('post_display_date'));
        	 Configuration::updateValue($this->name.'post_img_width', Tools::getValue('post_img_width'));
        	 Configuration::updateValue($this->name.'is_soc_buttons', Tools::getValue('is_soc_buttons'));
        	 
        	 
        	 Configuration::updateValue($this->name.'blog_bcat', Tools::getValue('blog_bcat'));
        	 Configuration::updateValue($this->name.'blog_bposts', Tools::getValue('blog_bposts'));
        	 
        	Configuration::updateValue($this->name.'rsson', Tools::getValue('rsson'));
			Configuration::updateValue($this->name.'number_rssitems', Tools::getValue('number_rssitems'));
			
			
        	$languages = Language::getLanguages(false);
        	foreach ($languages as $language){
    			$i = $language['id_lang'];
        		Configuration::updateValue($this->name.'rssname_'.$i, Tools::getValue('rssname_'.$i));
        		Configuration::updateValue($this->name.'rssdesc_'.$i, Tools::getValue('rssdesc_'.$i));
        	}
        	 
        	 $this->_html .= '<script>init_tabs(1);</script>';
        }
        if(Tools::isSubmit('submitsitemap')){
        	$obj_blog->generateSitemap();

            if(version_compare(_PS_VERSION_, '1.6', '>')) {
                $this->_html .= '<script>init_tabs(9);</script>';
            } else {
                $this->_html .= '<script>init_tabs(1);</script>';

                if($this->_is16 == 0)
                    $this->_html .= '<script>init_tabs_in(39);</script>';
            }
        }



        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $this->_displayForm16();
        } else {
            $this->_displayForm13_14_15(array('errors'=>$errors));
        }

        return $this->_html;
    }
    
private function _welcome(){
	
		$_html  = '';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '<div class="panel">

                <div class="panel-heading"><i class="fa fa-home fa-lg"></i>&nbsp;'.$this->l('Welcome').'</div>';
        } else {
            $_html .= '<h3 class="title-block-content"><img src="../modules/'.$this->name.'/logo.gif" />'.$this->l('Welcome').'</h3>';
        }

    	
    	$_html .=  $this->l('Welcome and thank you for purchasing the module.');
    	

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '</div>';
        }

    	return $_html;



    }

    private function _help_documentation(){
        $_html = '';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '<div class="panel">

				<div class="panel-heading"><i class="fa fa-question-circle fa-lg"></i>&nbsp;'.$this->l('Help / Documentation').'</div>';
        } else {
            $_html .= '<h3 class="title-block-content">'.$this->l('Help / Documentation').'</h3>';
        }

        $_html .= '<b style="text-transform:uppercase">'.$this->l('MODULE DOCUMENTATION ').':</b>&nbsp;<a target="_blank" href="../modules/'.$this->name.'/Installation_Guid.pdf" style="text-decoration:underline;font-weight:bold">Installation_Guid.pdf</a>
    			<br/><br/>'.
            '<b style="text-transform:uppercase">'.$this->l('Hot to configure CRON ').':</b>&nbsp;<a href="javascript:void(0)" onclick="tabs_custom(101)" style="text-decoration:underline;font-weight:bold">'.$this->l('CRON HELP').'</a>
    			<br/>';
        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '</div>';
        }
        return $_html;
    }

    private function _displayForm16(){

        $this->_html .= '<div class="row">
    	<div class="col-lg-12">
    	<div class="row">';

        $this->_html .= '<div class="productTabs col-lg-12 col-md-3">

						<div class="list-group">';
        $this->_html .= '<ul class="nav nav-pills" id="navtabs16">

							    <li class="active"><a href="#welcome" data-toggle="tab" class="list-group-item"><i class="fa fa-home fa-lg"></i>&nbsp;'.$this->l('Welcome').'</a></li>
							    <li><a href="#blogsettings" data-toggle="tab" class="list-group-item"><i class="fa fa-cogs fa-lg"></i>&nbsp;'.$this->l('Blog Settings').'</a></li>
							    <li><a href="#info" data-toggle="tab" class="list-group-item"><i class="fa fa-question-circle fa-lg"></i>&nbsp;'.$this->l('Help / Documentation').'</a></li>
							    <li><a href="http://addons.prestashop.com/en/2_community-developer?contributor=61669" target="_blank"  class="list-group-item"><img src="../modules/'.$this->name.'/views/img/spm-logo.png"  />&nbsp;&nbsp;'.$this->l('Other SPM Modules').'</a></li>


							</ul>';
        $this->_html .= '</div>
    				</div>';


        $this->_html .= '<div class="tab-content col-lg-12 col-md-9">';
        $this->_html .= '<div class="tab-pane active" id="welcome">'.$this->_welcome().'</div>';
        $this->_html .= '<div class="tab-pane" id="blogsettings">'.$this->_blogsettings16().'</div>';
        $this->_html .= '<div class="tab-pane" id="info">'.$this->_help_documentation().'</div>';
        $this->_html .= '</div>';



        $this->_html .= '</div></div></div>';

    }

    private function _blogsettings16(){
        $_html = '';

        $_html .= '<div class="row">
    				<div class="col-lg-12">
    					<div class="row">';

        $_html .= '<div class="productTabs col-lg-2 col-md-3">

			<div class="list-group">
				<ul class="nav nav-pills nav-stacked" id="blognavtabs16">
				    <li class="active"><a href="#urlrewrite" data-toggle="tab" class="list-group-item"><i class="fa fa-link fa-lg"></i>&nbsp;'.$this->l('URL Rewriting').'</a></li>

                     <li><a href="#categoriessettings" data-toggle="tab" class="list-group-item"><i class="fa fa-list fa-lg"></i>&nbsp;'.$this->l('Categories settings').'</a></li>
                     <li><a href="#postssettings" data-toggle="tab" class="list-group-item"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;'.$this->l('Posts settings').'</a></li>
				    <li><a href="#commentssettings" data-toggle="tab" class="list-group-item"><i class="fa fa-comments-o fa-lg"></i>&nbsp;'.$this->l('Comments settings').'</a></li>
                    <li><a href="#blockssettings" data-toggle="tab" class="list-group-item"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Blocks settings').'</a></li>
                    <li><a href="#blockpositions" data-toggle="tab" class="list-group-item"><i class="fa fa-th fa-lg"></i>&nbsp;'.$this->l('Positions Blocks').'</a></li>
                    <li><a href="#emailsettings" data-toggle="tab" class="list-group-item"><i class="fa fa-envelope-o fa-lg"></i>&nbsp;'.$this->l('Email settings').'</a></li>
                    <li><a href="#rssfeed" data-toggle="tab" class="list-group-item"><i class="fa fa-rss fa-lg"></i>&nbsp;'.$this->l('RSS Feed').'</a></li>
                    <li><a href="#sitemap" data-toggle="tab" class="list-group-item"><i class="fa fa-sitemap fa-lg"></i>&nbsp;'.$this->l('Sitemap').'</a></li>

                    ';


				  $_html .= '</ul>
				  </div>
		</div>';

        $_html .= '<div class="tab-content col-lg-10 col-md-9">';
        $_html .= '<div class="tab-pane active" id="urlrewrite">'.$this->_urlrewrite().'</div>';
        $_html .= '<div class="tab-pane" id="categoriessettings">'.$this->_categoriessettings().'</div>';
        $_html .= '<div class="tab-pane" id="postssettings">'.$this->_postssettings().'</div>';
        $_html .= '<div class="tab-pane" id="commentssettings">'.$this->_commentssettings().'</div>';
        $_html .= '<div class="tab-pane" id="blockssettings">'.$this->_blockssettings().'</div>';
        $_html .= '<div class="tab-pane" id="blockpositions">'.$this->_blockpositions().'</div>';
        $_html .= '<div class="tab-pane" id="emailsettings">'.$this->_emailsettings().'</div>';
        $_html .= '<div class="tab-pane" id="rssfeed">'.$this->_rssfeed().'</div>';
        $_html .= '<div class="tab-pane" id="sitemap">'.$this->_sitemap().'</div>';



        $_html .= '</div>';



        $_html .= '</div></div></div>';

        return $_html;
    }

    private function _sitemap(){
        $_html = '';
        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';
        $_html .= '<input type="hidden" value="1" name="sitemapsettings"/>';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '<div class="panel">

                    <div class="panel-heading"><i class="fa fa-sitemap fa-lg"></i>&nbsp;'.$this->l('Sitemap').'</div>';
        } else {
            $_html .= '
                        <h3 class="title-block-content"><i class="fa fa-sitemap fa-lg"></i>&nbsp;'.$this->l('Sitemap').'</h3>';
        }







        $_html .= '

                    <b>'.$this->l('Your CRON URL to call').'</b>:&nbsp;
                    <a target="_blank" href="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/blogsitemap.php?token='.$this->_token_cron.'"
                        style="text-decoration:underline;font-weight:bold">
                        '._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/blogsitemap.php?token='.$this->_token_cron.'
                        </a>

                         <br/><br/><br/><br/>';

        $_html .= '<input type="submit" value="'.$this->l('Regenerate Google sitemap').'" name="submitsitemap"
                                class="'.(version_compare(_PS_VERSION_, '1.6', '>')?'btn btn-primary pull':'button').'"/>';


        $_html .= ' &nbsp; <a target="_blank" style="text-decoration:underline;font-weight:bold" ';
        if($this->_is_cloud){
            $_html .= 'href="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml"';
        } else {
            $_html .= 'href="'._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml"';
        }
        $_html .= '>';
        if($this->_is_cloud){
            $_html .=	''._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml';
        } else {
            $_html .=	''._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml';
        }
        $_html .=	'</a>';

        $_html .= '</p>';




        $_html .= '<br/><br/><p>
                            '.$this->l('To declare blog sitemap xml, add this line at the end of your robots.txt file').': <br><br>
							  <code>
								Sitemap ';
        if($this->_is_cloud){
            $_html .= ''._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml';
        } else {
            $_html .= ''._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml';
        }


        $_html .= '</code>
                            </p>
                ';




        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '</div>';
        }


        $_html .= '</form>';



        $_html .= $this->_cronhelp(array('url'=>'blogsitemap'));

        return $_html;
    }


    private function _cronhelp($data = null){
        $url_cron = isset($data['url'])?$data['url']:'';
        $_html = '';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '<div class="panel">

				<div class="panel-heading"><i class="fa fa-tasks fa-lg"></i>&nbsp;'.$this->l('CRON HELP').'</div>';
        } else {
            $_html .= '<h3 class="panel-heading"><i class="fa fa-tasks fa-lg"></i>&nbsp;'.$this->l('CRON HELP').'</h3>';

        }




        $_html .= '<p class="hint clear" style="display: block; font-size: 12px; width: 95%;position:relative">';

        $_html .= '<b>';
        $_html .= $this->l('You can configure sending email messages through cron. You have 2 possibilities:');
        $_html .= '</b>';
        $_html .= '<br/><br/><br/>';
        $_html .= '<b>1.</b> '.$this->l('You can enter the following url in your browser: ');
        $_html .= '<b>'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/'.$url_cron.'.php?token='.$this->_token_cron.'</b>';
        $_html .= '<br/><br/><br/>';
        $_html .= '<b>2.</b> '.$this->l('You can set a cron\'s task (a recursive task that fulfills the sending of reminders)');
        $_html .= '<br/><br/>';
        $_html .= $this->l('The task run every hour').':&nbsp;&nbsp;&nbsp; <b>* */1 * * * /usr/bin/wget -O - -q '._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/'.$url_cron.'.php?token='.$this->_token_cron.'</b>';
        $_html .= '<br/><br/>';
        $_html .= $this->l('or');
        $_html .= '<br/><br/>';
        $_html .= $this->l('The task run every hour').':&nbsp;&nbsp;&nbsp; <b>* */1 * * * php -f /var/www/vhosts/myhost/httpdocs/prestashop/modules/'.$this->name.'/'.$url_cron.'.php?token='.$this->_token_cron.'</b>';
        $_html .= '<br/><br/><br/>';
        $_html .= '<b>'.$this->l('How to configure a cron task ?').'</b>';
        $_html .= '<br/><br/>';
        $_html .= $this->l('On your server, the interface allows you to configure cron\'s tasks');
        $_html .= '<br/>';
        $_html .= $this->l('About CRON').'&nbsp;&nbsp;&nbsp;<a href=http://en.wikipedia.org/wikimg/Cron target=_blank>http://en.wikipedia.org/wikimg/Cron</a>';
        $_html .= '</p>';


        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '</div>';
        }

        return $_html;
    }

    private function _emailsettings(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Email settings'),
                    'icon' => 'fa fa-envelope-o fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('E-mail notification:'),
                        'name' => 'noti',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'noti')
                        ),
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Admin email:'),
                        'name' => 'mail',
                        'id' => 'mail',
                        'lang' => FALSE,

                    ),



                ),



            ),


        );

        $fields_form1 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'emailsettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesEmailsSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1));
    }

    public function getConfigFieldsValuesEmailsSettings(){

        $data_config = array(
            'mail' => Configuration::get($this->name.'mail'),


        );

        return $data_config;
    }

    private function _rssfeed(){
        $fields_form = array(
            'form'=> array(

                'legend' => array(
                    'title' => $this->l('RSS Feed'),
                    'icon' => 'fa fa-rss fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable or Disable RSS Feed'),
                        'name' => 'rsson',

                        'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Title of your RSS Feed'),
                        'name' => 'rssname',
                        'id' => 'rssname',
                        'lang' => TRUE,
                        //'required' => TRUE,
                        'size' => 50,
                        //'maxlength' => 50,
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Description of your RSS Feed'),
                        'name' => 'rssdesc',
                        'id' => 'rssdesc',
                        'lang' => TRUE,
                        //'required' => TRUE,
                        'size' => 50,
                        //'maxlength' => 50,
                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Number of items in RSS Feed'),
                        'name' => 'number_rssitems',
                        'class' => ' fixed-width-sm',

                    ),


                ),



            ),


        );

        $fields_form1 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'rssfeedsettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesRssfeedSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1));
    }

    public function getConfigFieldsValuesRssfeedSettings(){
        $languages = Language::getLanguages(false);
        $fields_rssname = array();
        $fields_rssdesc = array();

        foreach ($languages as $lang)
        {
            $fields_rssname[$lang['id_lang']] =  Configuration::get($this->name.'rssname_'.$lang['id_lang']);

            $fields_rssdesc[$lang['id_lang']] =  Configuration::get($this->name.'rssdesc_'.$lang['id_lang']);
        }


        $data_config = array(
            'rsson' => Configuration::get($this->name.'rsson'),
            'rssname' => $fields_rssname,
            'rssdesc' => $fields_rssdesc,
            'number_rssitems' => (int)Configuration::get($this->name.'number_rssitems'),

        );

        return $data_config;

    }


    private function _blockpositions(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Positions Blocks'),
                    'icon' => 'fa fa-th fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'checkbox_custom_blocks',
                        'label' => $this->l('Left column'),
                        'name' => 'pos_left_col',
                        'hint' => $this->l('Blocks in the Left column'),
                        'values' => array(
                            'query' => array(
                                array(
                                    'id' => 'cat_left',
                                    'name' => $this->l('Blog Categories'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'posts_left',
                                    'name' => $this->l('Blog Posts recents'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'arch_left',
                                    'name' => $this->l('Block Archives'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'search_left',
                                    'name' => $this->l('Block Search'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'com_left',
                                    'name' => $this->l('Blog Last Comments'),
                                    'val' => '1'
                                ),



                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),

                    ),



                    array(
                        'type' => 'checkbox_custom_blocks',
                        'label' => $this->l('Right column'),
                        'name' => 'pos_right_col',
                        'hint' => $this->l('Blocks in the Right column'),
                        'values' => array(
                            'query' => array(
                                array(
                                    'id' => 'cat_right',
                                    'name' => $this->l('Blog Categories'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'posts_right',
                                    'name' => $this->l('Blog Posts recents'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'arch_right',
                                    'name' => $this->l('Block Archives'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'search_right',
                                    'name' => $this->l('Block Search'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'com_right',
                                    'name' => $this->l('Blog Last Comments'),
                                    'val' => '1'
                                ),



                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),

                    ),


                    array(
                        'type' => 'checkbox_custom_blocks',
                        'label' => $this->l('Footer'),
                        'name' => 'pos_footer_col',
                        'hint' => $this->l('Blocks in the Footer'),
                        'values' => array(
                            'query' => array(
                                array(
                                    'id' => 'cat_footer',
                                    'name' => $this->l('Blog Categories'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'posts_footer',
                                    'name' => $this->l('Blog Posts recents'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'arch_footer',
                                    'name' => $this->l('Block Archives'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'search_footer',
                                    'name' => $this->l('Block Search'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'com_footer',
                                    'name' => $this->l('Blog Last Comments'),
                                    'val' => '1'
                                ),



                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),

                    ),

                    array(
                        'type' => 'checkbox_custom_blocks',
                        'label' => $this->l('Blocks in the CUSTOM HOOKS'),
                        'name' => 'pos_footer_col',
                        'hint' => $this->l('Blocks in the CUSTOM HOOKS'),
                        'values' => array(
                            'query' => array(
                                array(
                                    'id' => 'cat_custom_hook',
                                    'name' => $this->l('Blog Categories in CUSTOM HOOK (blogCategoriesSPM)'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'posts_custom_hook',
                                    'name' => $this->l('Blog Posts in CUSTOM HOOK (blogPostsSPM)'),
                                    'val' => '1'
                                ),
                                array(
                                    'id' => 'comm_custom_hook',
                                    'name' => $this->l('Block Comments in CUSTOM HOOK (blogCommentsSPM)'),
                                    'val' => '1'
                                ),

                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),

                    ),



                ),



            ),


        );

        $fields_form1 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'blockpositions';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesPositionsSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1)).$this->_customhookhelp();
    }

    public function getConfigFieldsValuesPositionsSettings(){

        $data_config = array(
            'cat_left' => Configuration::get($this->name.'cat_left'),
            'posts_left' => Configuration::get($this->name.'posts_left'),
            'arch_left' => Configuration::get($this->name.'arch_left'),
            'search_left' => Configuration::get($this->name.'search_left'),
            'com_left' => Configuration::get($this->name.'com_left'),

            'cat_right' => Configuration::get($this->name.'cat_right'),
            'posts_right' => Configuration::get($this->name.'posts_right'),
            'arch_right' => Configuration::get($this->name.'arch_right'),
            'search_right' => Configuration::get($this->name.'search_right'),
            'com_right' => Configuration::get($this->name.'com_right'),

            'cat_footer' => Configuration::get($this->name.'cat_footer'),
            'posts_footer' => Configuration::get($this->name.'posts_footer'),
            'arch_footer' => Configuration::get($this->name.'arch_footer'),
            'search_footer' => Configuration::get($this->name.'search_footer'),
            'com_footer' => Configuration::get($this->name.'com_footer'),

            'cat_custom_hook' => Configuration::get($this->name.'cat_custom_hook'),
            'posts_custom_hook' => Configuration::get($this->name.'posts_custom_hook'),
            'comm_custom_hook' => Configuration::get($this->name.'comm_custom_hook'),



        );

        return $data_config;
    }

    private function _customhookhelp(){
        $_html  = '';

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '<div class="panel">

		<div class="panel-heading"><i class="fa fa-question-circle fa-lg"></i>&nbsp;'.$this->l('Frequently Asked Questions').'</div>';
        } else {

            $_html .= '<fieldset>
		<legend><i class="fa fa-question-circle fa-lg"></i>&nbsp;'.$this->l('Frequently Asked Questions').'</legend>

		';
        }

        if(version_compare(_PS_VERSION_, '1.5', '>')){

            $_html .= '<div class="row ">

                       ';

            $_html .= '<div class="span">
                          <p>
                             <span style="font-weight: bold; font-size: 15px;" class="question">
                             	- <b style="color:red">'.$this->l('CUSTOM HOOK HELP:').'</b> '.$this->l('How I can show Blog Categories, Posts, Comments on a single page (CMS or other places for example) ?').'
                             </span>
                             <br/><br/>
                             <span style="color: black;" class="answer">
                             	   <b>1.</b>&nbsp;'.$this->l('You just need to add a line of code to the tpl file of the page where you want to add the Blog Categories').':
                                   <br/><br/>
                                   <pre>{hook h=\'blogCategoriesSPM\'}</pre>
                              </span>
                              <br/>
                             <span style="color: black;" class="answer">
                             	   <b>2.</b>&nbsp;'.$this->l('You just need to add a line of code to the tpl file of the page where you want to add the Blog Posts').':
                                   <br/><br/>
                                   <pre>{hook h=\'blogPostsSPM\'}</pre>
                              </span>
                              <br/>
                             <span style="color: black;" class="answer">
                             	   <b>3.</b>&nbsp;'.$this->l('You just need to add a line of code to the tpl file of the page where you want to add the Blog Comments').':
                                   <br/><br/>
                                   <pre>{hook h=\'blogCommentsSPM\'}</pre>
                              </span>
                         </p>
                       </div><br/><br/>';
        }




        if(version_compare(_PS_VERSION_, '1.5', '>')){
            $_html .= '</div>';
        }

        if(version_compare(_PS_VERSION_, '1.6', '>')){
            $_html .= '</div>';
        } else {
            $_html .= '</fieldset>';
        }

        return $_html;
    }

    private function _blockssettings(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Block "Blog categories" settings'),
                    'icon' => 'fa fa-list-alt fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('The number of items in the "Blog categories":'),
                        'name' => 'blog_bcat',
                        'id' => 'blog_bcat',
                        'lang' => FALSE,
                    ),






                ),



            ),


        );


        $fields_form1 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Block "Blog Posts recents" settings'),
                    'icon' => 'fa fa-list-alt fa-lg'
                ),
                'input' => array(


                    array(
                        'type' => 'text',
                        'label' => $this->l('The number of items in the block "Blog Posts recents"'),
                        'name' => 'blog_bposts',
                        'id' => 'blog_bposts',
                        'lang' => FALSE,
                    ),

                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display date in the block "Blog Posts recents"'),
                        'name' => 'block_display_date',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'block_display_date')
                        ),
                    ),
                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display images in the block "Blog Posts recents"'),
                        'name' => 'block_display_img',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'block_display_img')
                        ),
                    ),
                    array(
                        'type' => 'image_custom_px',
                        'label' => $this->l('Image width in the block "Blog Posts recents"'),
                        'name' => 'posts_block_img_width',
                        'value' => (int)Configuration::get($this->name.'posts_block_img_width')
                    ),




                ),



            ),


        );


        $fields_form2 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Block "Blog Posts recents" on Home Page settings'),
                    'icon' => 'fa fa-list-alt fa-lg'
                ),
                'input' => array(


                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display block "Blog Posts recents" on Home Page'),
                        'name' => 'block_last_home',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'block_last_home')
                        ),
                    ),

                    array(
                        'type' => 'select',
                        'label' => $this->l('"Blog Posts recents" on Home Page'),
                        'name' => 'blog_h',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id' => 1,
                                    'name' => $this->l('Horizontal view Posts on home page')),

                                array(
                                    'id' => 2,
                                    'name' => $this->l('Posts on home page in Blocks'),
                                ),
                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),

                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('The number of items in the block "Blog Posts recents" on home page'),
                        'name' => 'blog_bp_h',
                        'id' => 'blog_bp_h',
                        'lang' => FALSE,
                    ),

                    array(
                        'type' => 'image_custom_px',
                        'label' => $this->l('Image width in the block "Blog Posts recents" on home page'),
                        'name' => 'posts_w_h',
                        'value' => (int)Configuration::get($this->name.'posts_w_h')
                    ),

                    array(
                        'type' => 'text_truncate',
                        'label' => $this->l('Truncate posts in the block "Blog Posts recents" on home page'),
                        'name' => 'blog_p_tr',
                        'id' => 'blog_p_tr',
                        'lang' => FALSE,
                        'value' => (int)Configuration::get($this->name.'blog_p_tr'),
                    ),


                ),



            ),


        );


        $fields_form3 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Block "Blog Last Comments" settings'),
                    'icon' => 'fa fa-list-alt fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('The number of items in the block "Blog Last Comments"'),
                        'name' => 'blog_com',
                        'id' => 'blog_com',
                        'lang' => FALSE,
                    ),

                    array(
                        'type' => 'text_truncate',
                        'label' => $this->l('Truncate Comments in the block "Blog Last Comments"'),
                        'name' => 'blog_com_tr',
                        'id' => 'blog_com_tr',
                        'lang' => FALSE,
                        'value' => (int)Configuration::get($this->name.'blog_com_tr'),
                    ),






                ),



            ),


        );

        $fields_form5 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'blockssettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesBlockSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1, $fields_form2, $fields_form3, $fields_form5));
    }

    public function getConfigFieldsValuesBlockSettings(){

        $data_config = array(
            'blog_bcat' => (int)Configuration::get($this->name.'blog_bcat'),
            'blog_bposts' => (int)Configuration::get($this->name.'blog_bposts'),
            'blog_h' => (int)Configuration::get($this->name.'blog_h'),
            'blog_bp_h' => (int)Configuration::get($this->name.'blog_bp_h'),
            'blog_com'  => (int)Configuration::get($this->name.'blog_com'),


        );

        return $data_config;
    }

    private function _commentssettings(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Comments settings'),
                    'icon' => 'fa fa-comments-o fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('Comments per Page in the list view'),
                        'name' => 'perpage_com',
                        'id' => 'perpage_com',
                        'lang' => FALSE,

                    ),

                    array(
                        'type' => 'text',
                        'label' => $this->l('Comments per Page on the post page'),
                        'name' => 'pperpage_com',
                        'id' => 'pperpage_com',
                        'lang' => FALSE,

                    ),



                ),



            ),


        );

        $fields_form1 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'commentssettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesCommentsSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1));
    }

    public function getConfigFieldsValuesCommentsSettings(){

        $data_config = array(
            'perpage_com' => (int)Configuration::get($this->name.'perpage_com'),
            'pperpage_com' => (int)Configuration::get($this->name.'pperpage_com'),


        );

        return $data_config;
    }

    private function _postssettings(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Posts in the list view settings'),
                    'icon' => 'fa fa-newspaper-o fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('Posts per Page in the list view'),
                        'name' => 'perpage_posts',
                        'id' => 'perpage_posts',
                        'lang' => FALSE,

                    ),


                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display date on list posts view'),
                        'name' => 'p_list_displ_date',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'p_list_displ_date')
                        ),
                    ),

                    array(
                        'type' => 'image_custom_px',
                        'label' => $this->l('Image width in lists posts'),
                        'name' => 'lists_img_width',
                        'value' => (int)Configuration::get($this->name.'lists_img_width')


                    ),

                    array(
                        'type' => 'text_truncate',
                        'label' => $this->l('Truncate posts content in the list view'),
                        'name' => 'blog_pl_tr',
                        'id' => 'blog_pl_tr',
                        'lang' => FALSE,
                        'value' => (int)Configuration::get($this->name.'blog_pl_tr'),
                    ),



                ),



            ),


        );


        $fields_form1 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Posts on post page settings'),
                    'icon' => 'fa fa-newspaper-o fa-lg'
                ),
                'input' => array(





                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display date on post page'),
                        'name' => 'post_display_date',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'post_display_date')
                        ),
                    ),

                    array(
                        'type' => 'image_custom_px',
                        'label' => $this->l('Image width on post page'),
                        'name' => 'post_img_width',
                        'value' => (int)Configuration::get($this->name.'post_img_width')
                    ),

                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Active Social share buttons'),
                        'name' => 'is_soc_buttons',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'is_soc_buttons')
                        ),
                    ),



                ),



            ),


        );


        $data_img_sizes = array();

        $available_types = ImageType::getImagesTypes('products');

        foreach ($available_types as $type){

            $id = $type['name'];
            $name = $type['name'].' ('.$type['width'].' x '.$type['height'].')';

            $data_item_size = array(
                'id' => $id,
                'name' => $name,
            );

            array_push($data_img_sizes,$data_item_size);


        }



        $fields_form2 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Related products on post page settings'),
                    'icon' => 'fa fa-book fa-lg'
                ),
                'input' => array(



                    array(
                        'type' => 'select',
                        'label' => $this->l('Image size for related products'),
                        'name' => 'img_size_rp',
                        'options' => array(
                            'query' => $data_img_sizes,
                            'id' => 'id',
                            'name' => 'name'
                        )
                    ),

                    array(
                        'type' => 'text_truncate',
                        'label' => $this->l('Truncate product description'),
                        'name' => 'blog_rp_tr',
                        'id' => 'blog_rp_tr',
                        'lang' => FALSE,
                        'value' => (int)Configuration::get($this->name.'blog_rp_tr'),
                    ),



                ),



            ),


        );

        $fields_form3 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Related Posts on post page settings'),
                    'icon' => 'fa fa-list-alt fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'image_custom_px',
                        'label' => $this->l('Image width in the related posts block on post page'),
                        'name' => 'rp_img_width',
                        'value' => (int)Configuration::get($this->name.'rp_img_width')
                    ),
                ),

            ),


        );



        $fields_form4 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'postssettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesPostsSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1,$fields_form2,$fields_form3,$fields_form4));
    }

    public function getConfigFieldsValuesPostsSettings(){

        $data_config = array(
            'perpage_posts' => (int)Configuration::get($this->name.'perpage_posts'),
            'img_size_rp' => Configuration::get($this->name.'img_size_rp'),


        );

        return $data_config;
    }

    private function _categoriessettings(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Categories settings'),
                    'icon' => 'fa fa-list fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'text',
                        'label' => $this->l('Categories per Page:'),
                        'name' => 'perpage_catblog',
                        'id' => 'perpage_catblog',
                        'lang' => FALSE,

                    ),


                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display date on list Categories page:'),
                        'name' => 'cat_list_display_date',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'cat_list_display_date')
                        ),


                    ),


                ),



            ),


        );


        $fields_form1 = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('Categories on Product Page settings'),
                    'icon' => 'fa fa-newspaper-o fa-lg'
                ),
                'input' => array(



                    array(
                        'type' => 'checkbox_custom',
                        'label' => $this->l('Display tab "Blog" on Product Page:'),
                        'name' => 'tab_blog_pr',
                        'values' => array(
                            'value' => (int)Configuration::get($this->name.'tab_blog_pr')
                        ),
                    ),


                    array(
                        'type' => 'select',
                        'label' => $this->l('Product tabs'),
                        'name' => 'btabs_type',
                        'options' => array(
                            'query' => array(
                                array(
                                    'id' => 1,
                                    'name' => $this->l('Standard theme without Tabs')),

                                array(
                                    'id' => 2,
                                    'name' => $this->l('Custom theme with tabs on product page'),
                                ),
                            ),
                            'id' => 'id',
                            'name' => 'name'
                        ),
                        'desc' => $this->l('On a standard PrestaShop 1.6 theme, the product page no longer has tabs for the various sections.').
                            '&nbsp;'.$this->l('But some custom themes have added back tabs on the product page. ')
                    ),

                ),



            ),


        );

        $fields_form2 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'categoriessettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesCategoriesSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1, $fields_form2));
    }

    public function getConfigFieldsValuesCategoriesSettings(){

        $data_config = array(
            'perpage_catblog' => (int)Configuration::get($this->name.'perpage_catblog'),
            'btabs_type' => Configuration::get($this->name.'btabs_type'),


        );

        return $data_config;


    }

    private function _urlrewrite(){
        $fields_form = array(
            'form'=> array(
                'legend' => array(
                    'title' => $this->l('URL Rewriting'),
                    'icon' => 'fa fa-link fa-lg'
                ),
                'input' => array(

                    array(
                        'type' => 'switch',
                        'label' => $this->l('Enable or Disable URL rewriting:'),
                        'name' => 'urlrewrite_on',
                        'desc' => $this->l('Enable only if your server allows URL rewriting (recommended).'),

                         'values' => array(
                            array(
                                'id' => 'active_on',
                                'value' => 1,
                                'label' => $this->l('Yes')
                            ),
                            array(
                                'id' => 'active_off',
                                'value' => 0,
                                'label' => $this->l('No')
                            )
                        ),
                    ),

                ),



            ),


        );

        $fields_form1 = array(
            'form' => array(


                'submit' => array(
                    'title' => $this->l('Update Settings'),
                )
            ),
        );




        $helper = new HelperForm();



        $helper->table = $this->table;
        $lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
        $helper->default_form_language = $lang->id;
        $helper->module = $this;
        $helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
        $helper->identifier = $this->identifier;
        $helper->submit_action = 'urlrewritesettings';
        $helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->tpl_vars = array(
            'uri' => $this->getPathUri(),
            'fields_value' => $this->getConfigFieldsValuesUrlrewriteSettings(),
            'languages' => $this->context->controller->getLanguages(),
            'id_language' => $this->context->language->id
        );




        return  $helper->generateForm(array($fields_form,$fields_form1));
    }

    public function getConfigFieldsValuesUrlrewriteSettings(){

        $data_config = array(
            'urlrewrite_on' => (int)Configuration::get($this->name.'urlrewrite_on'),


        );

        return $data_config;

    }

	private function _displayForm13_14_15()
     {
     	
     	$this->_html .= '
		<fieldset class="display-form">
					<legend><img src="../modules/'.$this->name.'/logo.gif"  />
					'.$this->displayName.'</legend>
					
		<fieldset class="blockblog-menu">
			<legend>'.$this->l('Menu: ').'</legend>
		<ul class="leftMenu">
			<li><a href="javascript:void(0)" onclick="tabs_custom(77)" id="tab-menu-77" class="selected">'.$this->l('Welcome').'</a></li>
			
			<li><a href="javascript:void(0)" onclick="tabs_custom(1)" id="tab-menu-1" >'.$this->l('Blog Settings').'</a></li>
			<li><a href="javascript:void(0)" onclick="tabs_custom(2)" id="tab-menu-2">'.$this->l('Categories').'</a></li>';
		 $edit_item_category = Tools::getValue("edit_item_category");
		 if (Tools::strlen($edit_item_category)>0) {
			$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(3)" id="tab-menu-3" style="font-weight:100;font-size:12px">'.$this->l('Edit Category').'</a></li>';
		 } else {
		 	$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(3)" id="tab-menu-3" style="font-weight:100;font-size:12px">'.$this->l('Add Category').'</a></li>';
		 }
		 
		$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(4)" id="tab-menu-4">'.$this->l('Posts').'</a></li>';
		
		$edit_item_posts = Tools::getValue("edit_item_posts");
		if (Tools::strlen($edit_item_posts)>0) {
			$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(5)" id="tab-menu-5" style="font-weight:100;font-size:12px">'.$this->l('Edit Post').'</a></li>';
		} else {
			$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(5)" id="tab-menu-5" style="font-weight:100;font-size:12px">'.$this->l('Add Post').'</a></li>';
		}
		
		$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(6)" id="tab-menu-6">'.$this->l('Comments').'</a></li>';
			
		$edit_item_comments = Tools::getValue("edit_item_comments");
		if(Tools::strlen($edit_item_comments)>0){
			$this->_html .=	'<li><a href="javascript:void(0)" onclick="tabs_custom(7)" id="tab-menu-7" style="font-weight:100;font-size:12px">'.$this->l('Edit Comments').'</a></li>';
		}
		
		
		$this->_html .= '</ul>
		</fieldset>
			
			<div class="blockblog-content">
			<div id="tabs-77" class="menu-content">'.$this->_welcome().'</div>
				<div id="tabs-1" class="menu-content">'.$this->_drawSettingsForm().'</div>
				<div id="tabs-2">'.$this->_drawCategories().'</div>';
		      
		    	if (Tools::strlen($edit_item_category)>0) {
		        	$this->_html .= '<div id="tabs-3">'.$this->_drawAddCategoryForm(array('action'=>'edit',
		        																		  'id'=>Tools::getValue("id_category"))
		        																	).'</div>';
				} else {
		    		$this->_html .= '<div id="tabs-3">'.$this->_drawAddCategoryForm().'</div>';
				}
				
				$this->_html .=  '<div id="tabs-4">'.$this->_drawPosts(array('edit'=>2)).'</div>';
				
				if (Tools::strlen($edit_item_posts)>0) {
					$this->_html .=  '<div id="tabs-5">'.$this->_drawAddPostForm(array('action'=>'edit',
		        																		  'id'=>Tools::getValue("id_posts"))
																				).'</div>';
				} else {
					$this->_html .=  '<div id="tabs-5">'.$this->_drawAddPostForm().'</div>';
				}
				$this->_html .=  '<div id="tabs-6">'.$this->_drawComments(array('edit'=>2)).'</div>';
				
     			if(Tools::strlen($edit_item_comments)>0){
					$this->_html .=	'<div id="tabs-7">'.$this->_drawEditComments(array('action'=>'edit',
		        																	   'id'=>Tools::getValue("id_comments"))
		        																	).'</div>';
				}
				
				$this->_html .= '<div style="clear:both"></div>
				
			</div>
			
			
		</fieldset>	';
		
		
    }
    
	public function _drawAddCategoryForm($data = null){
		$cookie = $this->context->cookie;

        $currentIndex = $this->context->currentindex;
		
		//echo "<pre>"; var_Dump($this->context);
		//var_dump($currentIndex);exit;
		$currentIndex = isset($data['currentindex'])?$data['currentindex']:$currentIndex;
    	$controller = isset($data['controller'])?$data['controller']:'AdminModules';
    	
    	$token = isset($data['token'])?$data['token']:Tools::getAdminToken($controller.(int)(Tab::getIdFromClassName($controller)).(int)($cookie->id_employee));
    	
    	
		$action = isset($data['action'])?$data['action']:'';
		$id = isset($data['id'])?$data['id']:0;
		
		$title = '';
		$seo_description = '';
		$seo_keywords = '';
		$button = $this->l('Add Category');
		$title_block = $this->l('Add Category');

		if($action == 'edit'){
			include_once(dirname(__FILE__).'/classes/blog.class.php');
			$obj_blog = new blog();
			$_data = $obj_blog->getCategoryItem(array('id'=>$id,'admin'=>1));
			$button = $this->l('Update Category');
			$title_block = $this->l('Edit Category');
		}
		
		$divLangName = "category_title¤category_seokeywords¤category_seodescription";
		
		$_html = '';
    	$_html .= '<form method="post" 
    					action="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'" 
    					enctype="multipart/form-data">';
    	
    	
    	$_html .= '<fieldset class="prestashop16-add-category">
					<legend><img src="../modules/'.$this->name.'/logo.gif" />'.$title_block.'</legend>';
		
    	$_html .= '<label>'.$this->l('Title').'</label>';

    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$title = isset($_data['category']['data'][$id_lng]['title'])?$_data['category']['data'][$id_lng]['title']:"";
	    	
			$_html .= '	<div id="category_title_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >

						<input type="text" style="width:400px"   
								  id="category_title_'.$language['id_lang'].'" 
								  name="category_title_'.$language['id_lang'].'" 
								  value="'.htmlentities(Tools::stripslashes($title), ENT_COMPAT, 'UTF-8').'"/>
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'category_title');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
			        
		$_html .=  '</div>';

		// identifier
		$cookie = $this->context->cookie;
		
		$current_lng =  $cookie->id_lang;
		$seo_url = isset($_data['category']['data'][$current_lng]['seo_url'])?$_data['category']['data'][$current_lng]['seo_url']:"";
	   
		if(Configuration::get($this->name.'urlrewrite_on') == 1){
		 	
		$_html .= '<label>'.$this->l('Identifier (SEO URL)').'</label>';
    	
    	$_html .= '<div class="margin-form">';
    	
			
			$_html .= '
						<input type="text" style="width:400px"   
								  id="seo_url" 
								  name="seo_url" 
								  value="'.$seo_url.'"/>
						<p>'.$this->l('You can leave the field blank - then Identifier (SEO URL) is generated automatically!').' (eg: http://domain.com/blog/category/identifier)</p>
						';
	    $_html .=  '</div>';
		} else {
			$_html .= '<input type="hidden" name="seo_url" value="'.$seo_url.'" />';
		}
		 
    	$_html .= '<label>'.$this->l('SEO Keywords').'</label>';
    			
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$seo_keywords = isset($_data['category']['data'][$id_lng]['seo_keywords'])?$_data['category']['data'][$id_lng]['seo_keywords']:"";
	    	
			$_html .= '	<div id="category_seokeywords_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >
						<textarea cols="60" rows="10"  
			                	  id="category_seokeywords_'.$language['id_lang'].'" 
								  name="category_seokeywords_'.$language['id_lang'].'"
								  >'.htmlentities(Tools::stripslashes($seo_keywords), ENT_COMPAT, 'UTF-8').'</textarea>
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'category_seokeywords');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
		
    	$_html .=  '</div>';
    	
    	
    	$_html .= '<label>'.$this->l('SEO Description').'</label>';
    			
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$seo_description = isset($_data['category']['data'][$id_lng]['seo_description'])?$_data['category']['data'][$id_lng]['seo_description']:"";
	    	
			$_html .= '	<div id="category_seodescription_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >
						<textarea cols="60" rows="10"  
			                	  id="category_seodescription_'.$language['id_lang'].'" 
								  name="category_seodescription_'.$language['id_lang'].'"
								  >'.htmlentities(Tools::stripslashes($seo_description), ENT_COMPAT, 'UTF-8').'</textarea>
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'category_seodescription');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
		
    	$_html .=  '</div>';
    	
    	
    	
    	
    	if($this->_is15){
    	// shop association
    	$_html .= '<div class="clear"></div>';
    	$_html .= '<label>'.$this->l('Shop association').':</label>';
    	$_html .= '<div class="margin-form">';

		$_html .= '<table width="50%" cellspacing="0" cellpadding="0" class="table">
						<tr>
							<th>Shop</th>
						</tr>';
		$u = 0;
		
		$shops = Shop::getShops();
		$shops_tmp = explode(",",isset($_data['category'][0]['ids_shops'])?$_data['category'][0]['ids_shops']:"");
		
		$count_shops = sizeof($shops);
		foreach($shops as $_shop){
			$id_shop = $_shop['id_shop'];
			$name_shop = $_shop['name'];
			 $_html .= '<tr>
						<td>
							<img src="../img/admin/lv2_'.((($count_shops-1)==$u)?"f":"b").'.png" alt="" style="vertical-align:middle;">
							<label class="child">';
		 
			
				$_html .= '<input type="checkbox"  
								   name="cat_shop_association[]" 
								   value="'.$id_shop.'" '.((in_array($id_shop,$shops_tmp))?'checked="checked"':'').' 
								   class="input_shop" 
								   />
								'.$name_shop.'';
				
				$_html .= '</label>
						</td>
					</tr>';
		 $u++;
		}
	
		$_html .= '</table>';
			
		$_html .= '</div>';
																
    	}
    	// shop association

        $time_add = isset($_data['category']['data'][$current_lng]['time_add'])?$_data['category']['data'][$current_lng]['time_add']:date("Y-m-d H:i:s");

        $_html .= '<label>'.$this->l('Date Add').':</label>';
        $_html .= '<div style="padding:0 0 1em 210px;line-height:1.6em;">';
        //.$time_add.
        $_html .= '<input id="time_add_cat"
                       type="text"
                       class="item_datepicker_add_cat" name="time_add_cat" value="'.$time_add.'" />
                <span class="input-group-addon"><i class="icon-calendar-empty"></i></span>';

        $_html .= '<script type="text/javascript">
            $(\'document\').ready( function() {

                var dateObj = new Date();
                var hours = dateObj.getHours();
                var mins = dateObj.getMinutes();
                var secs = dateObj.getSeconds();
                if (hours < 10) { hours = "0" + hours; }
                if (mins < 10) { mins = "0" + mins; }
                if (secs < 10) { secs = "0" + secs; }
                var time = " "+hours+":"+mins+":"+secs;

                if ($(".item_datepicker_add_cat").length > 0)
                $(".item_datepicker_add_cat").datepicker({prevText: \'\',nextText: \'\',dateFormat: \'yy-mm-dd\'+time});

            });
        </script>';
        $_html .= '</div>';

        $status = isset($_data['category']['data'][$current_lng]['status'])?$_data['category']['data'][$current_lng]['status']:0;
        $_html .= '<label>'.$this->l('Status').'</label>
				<div class = "margin-form" style="padding: 0pt 0pt 10px 130px;">';

        $_html .= '<select name="cat_status" style="width:100px">
					<option value=1 '.(($status==1)?"selected=\"true\"":"").'>'.$this->l('Enabled').'</option>
					<option value=0 '.(($status==0)?"selected=\"true\"":"").'>'.$this->l('Disabled').'</option>
				   </select>';


        $_html .= '</div>';
    	
		$_html .= '</fieldset>';
    	
		if($action == 'edit'){
		$_html .= '<input type = "hidden" name = "id_editcategory" value = "'.$id.'"/>';
    	$_html .= '<p class="center" style="background: none; padding: 10px; margin-top: 10px;">
					<input type="submit" name="cancel_editcategory" value="'.$this->l('Cancel').'" 
                		   class="button"  />
    				<input type="submit" name="submit_editcategory" value="'.$button.'" 
                		   class="button"  />
                	
                	</p>';
		} else {
		$_html .= '<p class="center" style="background: none; padding: 10px; margin-top: 10px;">
					<input type="submit" name="cancel_editcategory" value="'.$this->l('Cancel').'" 
                		   class="button"  />
					<input type="submit" name="submit_addcategory" value="'.$button.'" 
                		   class="button"  />
                	</p>';
			
		}
    	$_html .= '</form>';
    	
    	if($action == 'edit'){
    		if($controller == 'AdminModules')
    		$_html .= $this->_drawPosts(array('edit'=>1,'id_category'=>$id,
    										 ));
    		else
    		$_html .= $this->_drawPosts(array('edit'=>1,'id_category'=>$id,
    										  'currentindex' => 'index.php?tab=AdminBlockblogPosts',
    										  'controller'=>'AdminBlockblogPosts')
    									);
    	}
    	
    	return $_html;
    }
    
    
	public function _drawAddPostForm($data = null){
		$cookie = $this->context->cookie;

        $currentIndex = $this->context->currentindex;
		$currentIndex = isset($data['currentindex'])?$data['currentindex']:$currentIndex;
    	$controller = isset($data['controller'])?$data['controller']:'AdminModules';
    	
    	
		
		include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		
		$action = isset($data['action'])?$data['action']:'';
		$id = isset($data['id'])?$data['id']:0;
		
		
		$id_category = array();
		$title = '';
		$seo_description = '';
		$seo_keywords = '';
		$content = '';
		$status = 1;
		$is_comments = 1;
		$button = $this->l('Add Post');
		$title_block = $this->l('Add Post');
		$img = '';
		$related_products = 0;
		$related_posts = 0;
		
		if($action == 'edit'){
			$_data = $obj_blog->getPostItem(array('id'=>$id));
			$id_category=$_data['post'][0]['category_ids'];

			$img = $_data['post'][0]['img'];
			$status = $_data['post'][0]['status'];
			$is_comments = $_data['post'][0]['is_comments'];
			$time_add = $_data['post'][0]['time_add'];
			$related_products = $_data['post'][0]['related_products'];
			$related_posts=$_data['post'][0]['related_posts'];
			
			$button = $this->l('Update Post');
			$title_block = $this->l('Edit Post');
		}
		
		$divLangName = "ccontent¤post_title¤post_seokeywords¤post_seodescription";
		
    	$_html = '';
    	$_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">';
    	
    	$_html .= '<fieldset >
					<legend><img src="../modules/'.$this->name.'/logo.gif" />'.$title_block.'</legend>';
		
    	$_html .= '<label style="width:120px">'.$this->l('Title').'</label>';
    			
    	
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$title = isset($_data['post']['data'][$id_lng]['title'])?$_data['post']['data'][$id_lng]['title']:"";
	    	
			$_html .= '	<div id="post_title_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >

						<input type="text" style="width:400px"   
								  id="post_title_'.$language['id_lang'].'" 
								  name="post_title_'.$language['id_lang'].'" 
								  value="'.htmlentities(Tools::stripslashes($title), ENT_COMPAT, 'UTF-8').'"/>
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'post_title');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
			        
		$_html .=  '</div>';
    	
    
	if(Configuration::get($this->name.'urlrewrite_on') == 1){
		// identifier
		$cookie = $this->context->cookie;
		
		$current_lng =  $cookie->id_lang;
		$seo_url = isset($_data['post']['data'][$current_lng]['seo_url'])?$_data['post']['data'][$current_lng]['seo_url']:"";
	    	
		$_html .= '<label style="width:120px">'.$this->l('Identifier (SEO URL)').'</label>';
    	
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
    	
			
			$_html .= '
						<input type="text" style="width:400px"   
								  id="seo_url" 
								  name="seo_url" 
								  value="'.$seo_url.'"/>
						<p>You can leave the field blank - then Identifier (SEO URL) is generated automatically! (eg: http://domain.com/blog/post/dentifier)</p>
						';
	    $_html .=  '</div>';
		}
		
    	$_html .= '<label style="width:120px">'.$this->l('SEO Keywords').'</label>';
    			
    	
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$seo_keywords = isset($_data['post']['data'][$id_lng]['seo_keywords'])?$_data['post']['data'][$id_lng]['seo_keywords']:"";
	    	
			$_html .= '	<div id="post_seokeywords_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >
						<textarea id="post_seokeywords_'.$language['id_lang'].'" 
								  name="post_seokeywords_'.$language['id_lang'].'" 
								  cols="80" rows="10"  
			                	   >'.htmlentities(Tools::stripslashes($seo_keywords), ENT_COMPAT, 'UTF-8').'</textarea>
						
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'post_seokeywords');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
			        
		$_html .=  '</div>';
			        
		
    	
    	$_html .= '<label style="width:120px">'.$this->l('SEO Description').'</label>';
    			
    	
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
	    	$seo_description = isset($_data['post']['data'][$id_lng]['seo_description'])?$_data['post']['data'][$id_lng]['seo_description']:"";
	    	
			$_html .= '	<div id="post_seodescription_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >
						<textarea id="post_seodescription_'.$language['id_lang'].'" 
								  name="post_seodescription_'.$language['id_lang'].'" 
								  cols="80" rows="10"  
			                	   >'.htmlentities(Tools::stripslashes($seo_description), ENT_COMPAT, 'UTF-8').'</textarea>
						
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'post_seodescription');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
			        
		$_html .=  '</div>';
			        
		
    	
    	
    	if(defined('_MYSQL_ENGINE_')){
    		if($this->_is16 == 1){
    			$_html .= '<label style="width:120px">';
    		} else {
    			$_html .= '<label style="width:50px">';
    		}
    	$_html .= $this->l('Content').'</label>';
    	
    	$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
	    $languages = Language::getLanguages(false);
    	
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 50px;">';
    	
		foreach ($languages as $language){
			$id_lng = (int)$language['id_lang'];
			$content = isset($_data['post']['data'][$id_lng]['content'])?$_data['post']['data'][$id_lng]['content']:"";
	    	
			$_html .= '	<div id="ccontent_'.$language['id_lang'].'" 
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;';
							 
			if($this->_is16 == 1){
				$_html .= 'width:80%;';
			}			 
			$_html .= '" >
						<textarea id="content_'.$language['id_lang'].'" 
								  name="content_'.$language['id_lang'].'" 
								  class="rte" cols="30" rows="30" ';

			if($this->_is16 == 0){
				$_html .= 'style="width:400px"';
			}
			
			$_html .= '          	   >'.htmlentities(Tools::stripslashes($content), ENT_COMPAT, 'UTF-8').'</textarea>
						
						</div>';
	    	}
		ob_start();
		$this->displayFlags($languages, $defaultLanguage, $divLangName, 'ccontent');
		$displayflags = ob_get_clean();
		$_html .= $displayflags;
		$_html .= '<div style="clear:both"></div>';
			        
		$_html .=  '</div>';
    	
    	}else{
    		$_html .= '<label style="width:120px">'.$this->l('Content').'</label>';
    		
    		
    		
    		$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		    $languages = Language::getLanguages(false);
	    	
	    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 50px;">';
	    	
			foreach ($languages as $language){
				$id_lng = (int)$language['id_lang'];
		    	$content = isset($_data['post']['data'][$id_lng]['content'])?$_data['post']['data'][$id_lng]['content']:"";
		    	
				$_html .= '	<div id="ccontent_'.$language['id_lang'].'" 
								 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
								 >
							<textarea id="content_'.$language['id_lang'].'" 
									  name="content_'.$language['id_lang'].'" 
									  class="rte" cols="30" rows="30"  
				                	   >'.htmlentities(Tools::stripslashes($content), ENT_COMPAT, 'UTF-8').'</textarea>
							
							</div>';
		    	}
			ob_start();
			$this->displayFlags($languages, $defaultLanguage, $divLangName, 'ccontent');
			$displayflags = ob_get_clean();
			$_html .= $displayflags;
			$_html .= '<div style="clear:both"></div>';
				        
			$_html .=  '</div>';
    	}
    	
    	$_html .= '<label style="width:120px">'.$this->l('Logo Image').'</label>
    			
    				<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">
					<input type="file" name="post_image" id="post_image" ';
    	if($this->_is16 == 0){
    	 $_html .= 'class="customFileInput"';
    	} 
    	 $_html .= '/>
					<p>'.$this->l('Allow formats').' *.jpg; *.jpeg; *.png; *.gif.<br/>'.$this->l('Max file size in php.ini').'&nbsp;<b style="color:green">'.ini_get('upload_max_filesize').'</b></p>';

    	
    	if(Tools::strlen($img)>0){
    	$_html .= '<div id="post_images_list">';
    		$_html .= '<div style="float:left;margin:10px" id="post_images_id">';
    		$_html .= '<table width=100%>';
    		
    		$_html .= '<tr><td align="left">';
    			$_html .= '<input type="radio" checked name="post_images"/>';
    		
    		$_html .= '</td>';
    		
    		$_html .= '<td align="right">';
    		
    			$_html .= '<a href="javascript:void(0)" title="'.$this->l('Delete').'"  
    						onclick = "delete_img('.$id.');"><img src="'._PS_ADMIN_IMG_.'delete.gif" alt="" /></a>
    					';
    		
    		$_html .= '</td>';
    		
    		$_html .= '<tr>';
    		$_html .= '<td colspan=2>';
    		if($this->_is_cloud){
    			$_html .= '<img src="../modules/'.$this->name.'/upload/'.$img.'" style="width:50px;height:50px"/>';
    		} else {
    			$_html .= '<img src="../upload/'.$this->name.'/'.$img.'" style="width:50px;height:50px"/>';
    		}
    		$_html .= '</td>';
    		$_html .= '</tr>';
    		
    		$_html .= '</table>';
    		
    		$_html .= '</div>';
    	
    	$_html .= '<div style="clear:both"></div>';
    	$_html .= '</div>';
    	}
    	
    	$_html .= '</div>';
    	
    	if($this->_is16 == 1){
    	$_html .= '<br/>';
    	}
    	
		$_data_cat  = $obj_blog->getCategories(array('admin'=>1)); 
		
    	$_html .= '<label style="width:120px">'.$this->l('Select categories').'</label>
    					<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
		
    	$_html .= '
		<div style="height:140px; overflow-x:hidden; overflow-y:scroll; padding:0;" class="margin-form">
		
		<table cellspacing="0" cellpadding="0" style="min-width:'.(($this->_is15 == 0)?'550px':'600px').'" class="table">
            <tr>
				<th style="width:40px;"></th>
				<th style="width:30px;">ID</th>
				<th>'.$this->l('Title').'</th>
				<th>'.$this->l('Lang').'</th>
            </tr>';
            
		$y=0;	
		foreach($_data_cat['categories'] as $_item){
			$name = isset($_item['title'])?$_item['title']:'';
			$id_pr = isset($_item['id'])?$_item['id']:'';
			
			$ids_lng = isset($_item['ids_lng'])?$_item['ids_lng']:array();
			$lang_for_category = array();
			foreach($ids_lng as $lng_id){
				$data_lng = Language::getLanguage($lng_id);
				$lang_for_category[] = $data_lng['iso_code']; 
			}
			$lang_for_category = implode(",",$lang_for_category);
			
			if(Tools::strlen($name)==0) continue;
			
	       $_html .= '
	       		<tr class="'.(($y%2==0)?'':'alt_row').'">
					<td>
						<input type="checkbox" value="'.$id_pr.'"  id="groupRelated_'.$id_pr.'"
							   class="groupBox" name="ids_categories[]"
							   '.(in_array($id_pr,$id_category)?'checked="checked"':'').' />
					</td>
					<td>'.$id_pr.'</td>
					<td><label class="t" for="groupRelated_'.$id_pr.'">'.$name.'</label></td>
					<td>'.$lang_for_category.'</td>
				</tr>';
	       $y++;
		}
	

       $_html .= '
       </table>
									
		</div>';
		
		
		$_html .=  '</div>';
		
		
		#### related products ###
		$_html .= '<label style="width:120px">'.$this->l('Related Products').'</label>';
    	
		$accessories = (($related_products!=0) ? $obj_blog->getProducts($related_products) : array());

            //var_dump($accessories);exit;

            $_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">'; 

            $_html .= '<div id="divAccessories">';
            foreach ($accessories as $accessory)
                $_html .= $accessory['name'] . (!empty($accessory['reference']) ? ' (' . $accessory['reference'] . ')' : '') 
                . ' <span class="delAccessory" name="' . $accessory['id_product'] .
                 '" style="cursor:pointer;"><img src="../img/admin/delete.gif" class="middle" alt="Delete" /></span><br />';
                
            $_html .= '</div>';
            
            $_html .= '<input type="hidden" name="inputAccessories" id="inputAccessories" value="';
            foreach ($accessories as $accessory) {
                $_html .= $accessory['id_product'] . '-';
            } $_html .= '" />	
                       <input type="hidden" name="nameAccessories" id="nameAccessories" value="';
            foreach ($accessories as $accessory) {
                 $_html .= $accessory['name'] . '¤';
            } $_html .= '" />';

            $_html .= '<div id="ajax_choose_product" style="padding:6px; padding-top:2px; width:'.(($this->_is15 == 0)?'550px':'600px').'">
                
                             <input type="text" value="" id="product_autocomplete_input" style="width:300px" />';
              //$_html .= '<img onclick="$(this).prev().search();" style="cursor: pointer;" src="../img/admin/add.gif" alt="' . $this->l('Add a product') . '" />';
              $_html .= '<p class="clear">' . $this->l('Begin typing the first letters of the product name, then select the product from the drop-down list') . '</p>
                        </div>';
		
		
		$_html .=  '</div>';
		
		$_html .= '<div style="clear:both"></div>';
		
		$_html .= '<script type="text/javascript">
		 $(\'document\').ready( function() {
			 if($(\'#divAccessories\').length){
	        	initAccessoriesAutocomplete();
	        	$(\'#divAccessories\').delegate(\'.delAccessory\', \'click\', function(){ delAccessory($(this).attr(\'name\')); });
	   		 }
   		 });
		</script>';
		
		### realted products ###
		
		
		
		### related posts ####
		
		$_data_cat  = $obj_blog->getRelatedPosts(array('admin'=>1,'id'=>$id)); 
		
    	$_html .= '<label style="width:120px">'.$this->l('Related posts').'</label>
    					<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';
		
    	$_html .= '
		<div style="height:140px; overflow-x:hidden; overflow-y:scroll; padding:0;" class="margin-form">
		
		<table cellspacing="0" cellpadding="0" style="min-width: '.(($this->_is15 == 0)?'550px':'600px').'" class="table">
            <tr>
				<th style="width:40px;"></th>
				<th style="width:30px;">ID</th>
				<th>'.$this->l('Title').'</th>
				<th>'.$this->l('Lang').'</th>
            </tr>';
            
			$y=0;	
			$related_posts = explode(",",$related_posts);
			foreach($_data_cat['related_posts'] as $_item){
				$name = isset($_item['title'])?$_item['title']:'';
				$id_pr = isset($_item['id'])?$_item['id']:'';
				
				$ids_lng = isset($_item['ids_lng'])?$_item['ids_lng']:array();
				$lang_for_related_posts = array();
				foreach($ids_lng as $lng_id){
					$data_lng = Language::getLanguage($lng_id);
					$lang_for_related_posts[] = $data_lng['iso_code']; 
				}
				$lang_for_related_posts = implode(",",$lang_for_related_posts);
				
				if(Tools::strlen($name)==0) continue;
				
		       $_html .= '
		       		<tr class="'.(($y%2==0)?'':'alt_row').'">
						<td>
							<input type="checkbox" value="'.$id_pr.'"  id="groupRelated_'.$id_pr.'"
								   class="groupBox" name="ids_related_posts[]"
								   '.(in_array($id_pr,$related_posts)?'checked="checked"':'').' />
						</td>
						<td>'.$id_pr.'</td>
						<td><label class="t" for="groupRelated_'.$id_pr.'">'.$name.'</label></td>
						<td>'.$lang_for_related_posts.'</td>
					</tr>';
		       $y++;
			}
	

      	 $_html .= '
       	</table>
									
		</div>';
		
		
		$_html .=  '</div>';
		
		### related posts ####
		
		
		
		$_html .= '<label style="width:120px">'.$this->l('Status').'</label>
				<div class = "margin-form" style="padding: 0pt 0pt 10px 130px;">';
				
		$_html .= '<select name="post_status" style="width:100px">
					<option value=1 '.(($status==1)?"selected=\"true\"":"").'>'.$this->l('Enabled').'</option>
					<option value=0 '.(($status==0)?"selected=\"true\"":"").'>'.$this->l('Disabled').'</option>
				   </select>';
			
				
			$_html .= '</div>';
			
		$_html .= '<label style="width:120px">'.$this->l('Enable Comments').'</label>
				<div class = "margin-form" style="padding: 0pt 0pt 10px 130px;">';
		
		$_html .= '<select name="post_iscomments" style="width:100px">
					<option value=1 '.(($is_comments==1)?"selected=\"true\"":"").'>'.$this->l('Enabled').'</option>
					<option value=0 '.(($is_comments==0)?"selected=\"true\"":"").'>'.$this->l('Disabled').'</option>
				   </select>';
				
			$_html .= '</div>';
			
		
		#### publication date ####
        if(empty($time_add)){
            $time_add = date('Y-m-d H:i:s');
        }

        $_html .= '<label style="width:120px">'.$this->l('Date Add').':</label>';
        $_html .= '<div>';
        //.$time_add.
        $_html .= '<input id="time_add_post"
                       type="text"
                       class="item_datepicker_add_post" name="time_add_post" value="'.$time_add.'" />
                <span class="input-group-addon"><i class="icon-calendar-empty"></i></span>';

        $_html .= '<script type="text/javascript">
            $(\'document\').ready( function() {

                var dateObj = new Date();
                var hours = dateObj.getHours();
                var mins = dateObj.getMinutes();
                var secs = dateObj.getSeconds();
                if (hours < 10) { hours = "0" + hours; }
                if (mins < 10) { mins = "0" + mins; }
                if (secs < 10) { secs = "0" + secs; }
                var time = " "+hours+":"+mins+":"+secs;

                if ($(".item_datepicker_add_post").length > 0)
                $(".item_datepicker_add_post").datepicker({prevText: \'\',nextText: \'\',dateFormat: \'yy-mm-dd\'+time});

            });
        </script>';
        $_html .= '</div>';
    	

    	
    	#### publication date ####
    	
			
		if($this->_is15){
    	// shop association
    	$_html .= '<div class="clear"></div>';
    	$_html .= '<label style="width:120px">'.$this->l('Shop association').':</label>';
    	$_html .= '<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">';

		$_html .= '<table width="50%" cellspacing="0" cellpadding="0" class="table">
						<tr>
							<th>Shop</th>
						</tr>';
		$u = 0;
		
		$shops = Shop::getShops();
		$shops_tmp = explode(",",isset($_data['post'][0]['ids_shops'])?$_data['post'][0]['ids_shops']:"");
		
		$count_shops = sizeof($shops);
		foreach($shops as $_shop){
			$id_shop = $_shop['id_shop'];
			$name_shop = $_shop['name'];
			 $_html .= '<tr>
						<td>
							<img src="../img/admin/lv2_'.((($count_shops-1)==$u)?"f":"b").'.png" alt="" style="vertical-align:middle;">
							<label class="child">';
		 
			
				$_html .= '<input type="checkbox"  
								   name="cat_shop_association[]" 
								   value="'.$id_shop.'" '.((in_array($id_shop,$shops_tmp))?'checked="checked"':'').' 
								   class="input_shop" 
								   />
								'.$name_shop.'';
				
				$_html .= '</label>
						</td>
					</tr>';
		 $u++;
		}
	
		$_html .= '</table>';
			
		$_html .= '</div>';
																
    	}
    	// shop association
    	
		$_html .= '</fieldset>';
    	
		
		if($action == 'edit'){
		$_html .= '<input type = "hidden" name = "id_editposts" value = "'.$id.'"/>';
    	$_html .= '<p class="center" style="background: none; padding: 10px; margin-top: 10px;">
					<input type="submit" name="cancel_editposts" value="'.$this->l('Cancel').'" 
                		   class="button"  />
    				<input type="submit" name="submit_editposts" value="'.$button.'" 
                		   class="button"  />
                	
                	</p>';
		} else {
		$_html .= '<p class="center" style="background: none; padding: 10px; margin-top: 10px;">
				<input type="submit" name="cancel_editposts" value="'.$this->l('Cancel').'" 
                		   class="button"  />
    				
					<input type="submit" name="submit_addpost" value="'.$button.'" 
                		   class="button"  />
                	</p>';
			
		}
		
    	
    	$_html .= '</form>';
    	
		/*if($action == 'edit'){
    		$_html .= $this->_drawComments(array('edit'=>1,'id_posts'=>$id));
    	}*/
    	
		if($action == 'edit'){
			if($controller == 'AdminModules'){
    		$_html .= $this->_drawComments(array('edit'=>1,'id_posts'=>$id));
    		} else {
    			$controller = 'AdminBlockblogComments';
    		$_html .= $this->_drawComments(array('edit'=>1,
    											 'id_posts'=>$id,
    										     'currentindex' => 'index.php?tab=AdminBlockblogComments',
    										  //'currentindex' => Tools::getAdminToken($controller.(int)(Tab::getIdFromClassName($controller)).(int)($cookie->id_employee)),
    										     'controller'=>$controller
    											)
    									);
    		}
    	}
    	
    	return $_html;
    }
    
    public function _drawCategories($data = null){
    	$cookie = $this->context->cookie;

        $currentIndex = $this->context->currentindex;
    	include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		$currentIndex = isset($data['currentindex'])?$data['currentindex']:$currentIndex;
    	$controller = isset($data['controller'])?$data['controller']:'AdminModules';
    	
    	$token = isset($data['token'])?$data['token']:Tools::getAdminToken($controller.(int)(Tab::getIdFromClassName($controller)).(int)($cookie->id_employee));
    	
		
    	$_html = '';
    	
    	$_html .= '<fieldset>
					<legend><img src="../modules/'.$this->name.'/logo.gif" />
						'.$this->l('Blog Categories').'</legend>';
    	
    	$_html .= '<table class = "table" width = 100%>
			<tr>
				<th width=20>'.$this->l('No.').'</th>
				<th width=325>'.$this->l('Title Category').'</th>
				<th width=75>'.$this->l('Count Posts').'</th>';
                if($this->_is15) {
                    $_html .= '<th width=75>' . $this->l('Shop') . '</th>';
                }

				$_html .= '<th width=75>'.$this->l('Language').'</th>

				<th width=75>'.$this->l('Date').'</th>
				<th width=50>'.$this->l('Status').'</th>
				<th width = "44">'.$this->l('Action').'</th>
			</tr>';
    	
    	$start = (int)Tools::getValue("pagecategories");
		
		$_data = $obj_blog->getCategories(array('start'=>$start,'step'=>$this->_step,'admin'=>1));
		
		//echo "<pre>"; var_dump($_data);
		
		$paging = $obj_blog->PageNav($start,$_data['count_all'],$this->_step, 
											array('admin' => 1,'currentIndex'=>$currentIndex,
												  'token' => '&configure='.$this->name.'&token='.$token,
												  'item' => 'categories'
											));
    	$i=0;
    	if(sizeof($_data['categories'])>0){
    	foreach($_data['categories'] as $_item){
			$i++;
			$id = $_item['id'];
			$date = $_item['time_add'];
            $status  = $_item['status'];

            $count_posts_for_category = $_item['count_posts'];
			
			$ids_lng = isset($_item['ids_lng'])?$_item['ids_lng']:array();
			$lang_for_category = array();
			foreach($ids_lng as $lng_id){
				$data_lng = Language::getLanguage($lng_id);
				$lang_for_category[] = $data_lng['iso_code']; 
			}
			$lang_for_category = implode(",",$lang_for_category);
			
			
			$_info_cat = $obj_blog->getCategoryItem(array('id' => $id, 'admin'=>1));
			//echo "<pre>"; var_dump($_info_cat);
            $defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
			$title_category = isset($_info_cat['category']['data'][$defaultLanguage]['title'])?$_info_cat['category']['data'][$defaultLanguage]['title']:'';
			$seo_url = isset($_info_cat['category']['data'][$defaultLanguage]['seo_url'])?$_info_cat['category']['data'][$defaultLanguage]['seo_url']:'';
			
			###  multisoter handler ###
			if($this->_is15){
			    $ids_shops = isset($_info_cat['category'][0]['ids_shops'])?$_info_cat['category'][0]['ids_shops']:'';

                $shops_names =     $ids_shops;
                $ids_shops_custom = explode(",",$shops_names);
                $shops = Shop::getShops();
                $name_shop = array();
                foreach($shops as $_shop){
                    $id_shop_lists = $_shop['id_shop'];
                    if(in_array($id_shop_lists,$ids_shops_custom))
                        $name_shop[] = $_shop['name'];
                }
                $shops_names = implode(",<br/>",$name_shop);

			}



			###  multisoter handler ###
			
			
			
			### category url ###
            $data_url = $obj_blog->getSEOURLs();
            $category_url = $data_url['category_url'];

            $category_url = '<a href="'.$category_url.((Configuration::get($this->name.'urlrewrite_on')==1)?$seo_url:'?category_id='.$id).'"
								target="_blank" style="text-decoration:underline" title="'.$title_category.'">'.$title_category.'</a>';

			### category url ###
			
			
			$_html .= 
			'<tr>
			<td style = "color:black;">'.$id.'</td>
			<td style = "color:black;">'.$category_url.'</td>';
            $_html .= '<td style = "color:black;">'.$count_posts_for_category.'</td>';
            if($this->_is15){
                $_html .= '<td style = "color:black;">'.$shops_names.'</td>';
            }
			$_html .= '<td style = "color:black;">'.$lang_for_category.'</td>';

			$_html .= '<td style = "color:black;">'.$date.'</td>';

			if($status)
				$_html .= '<td><img alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" src="../img/admin/enabled.gif"></td>';
			else
				$_html .= '<td><img alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" src="../img/admin/disabled.gif"></td>';
			
			$_html .= '
			<td>
			<form action = "'.$_SERVER['REQUEST_URI'].'" name="get_categories" method = "POST">
				 <input type = "hidden" name = "id_category" value = "'.$id.'"/>
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&edit_item_category=1&id_category='.(int)($id).'" title="'.$this->l('Edit').'"><img src="'._PS_ADMIN_IMG_.'edit.gif" alt="" /></a> 
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&delete_item_category=1&id_category='.(int)($id).'" title="'.$this->l('Delete').'"  onclick = "javascript:return confirm(\''.$this->l('Are you sure you want to remove this item?').'\');"><img src="'._PS_ADMIN_IMG_.'delete.gif" alt="" /></a>'; 
				 $_html .= '</form>
			 </td>
			 ';
			
			$_html .= '</tr>';
		}
    	} else {
    		$_html .= '<tr><td colspan=6 style="border-bottom:none;text-align:center;padding:10px"
    					>'.$this->l('There are not Categories yet').'</td><tr>';
    	}
    	
    	$_html .= '</table>';
    	if($i!=0){
    	$_html .= '<div style="margin:5px">';
    	$_html .= $paging;
    	$_html .= '</div>';
    	}
    	
    	$_html .= '</fieldset>';
    	
    	return $_html;
    }
    
    public function _drawPosts($data = null){
    	$cookie = $this->context->cookie;

        $currentIndex = $this->context->currentindex;
    	
    	$currentIndex = isset($data['currentindex'])?$data['currentindex']:$currentIndex;
    	$controller = isset($data['controller'])?$data['controller']:'AdminModules';
    	
    	$token = isset($data['token'])?$data['token']:Tools::getAdminToken($controller.(int)(Tab::getIdFromClassName($controller)).(int)($cookie->id_employee));
    	
    	
    	$edit = isset($data['edit'])?$data['edit']:0;
    	$id_category = isset($data['id_category'])?(int)$data['id_category']:0;
    	
    	
    	include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		$start = (int)Tools::getValue("pageposts");
		if($edit == 2){
			$_data = $obj_blog->getPosts(array('admin'=>2,'start'=>$start,'step'=>$this->_step));
		} else {
			$_data = $obj_blog->getPosts(array('admin'=>1,'id'=>$id_category));
		}
		
    	$_html = '';
    	
    	$_html .= '<fieldset>
					<legend><img src="../modules/'.$this->name.'/logo.gif" />
						'.$this->l('Blog Posts').'</legend>';
    	
    	if($edit ==1){
    		$count_all = $_data['count_all'];
    		$_html .= '<br/>';
    		$_html .= '<h2>Posts ('.$count_all.')</h2>';
    				
    	}
    	
    	
    	
    	
    	$_html .= '<table class = "table" width = 100%>
			<tr>
				<th width=20>'.$this->l('No.').'</th>
				<th width=50>'.$this->l('Image').'</th>
				<th width =350>'.$this->l('Title Post').'</th>
				<th width=50>'.$this->l('Count comments').'</th>
				<th width=50>'.$this->l('Count likes').'</th>';
                if($this->_is15) {
                    $_html .= '<th width=75>' . $this->l('Shop') . '</th>';
                }

                $_html .= '<th width=50>'.$this->l('Language').'</th>

				<th width=50>'.$this->l('Status').'</th>
				<th width=100>'.$this->l('Date').'</th>
				<th width = "44">'.$this->l('Action').'</th>
			</tr>';
    	
    	
		
		if($edit ==2){
		
		$paging = $obj_blog->PageNav($start,$_data['count_all'],$this->_step, 
											array('admin' => 1,'currentIndex'=>$currentIndex,
												  'token' => '&configure='.$this->name.'&token='.$token,
												  'item' => 'posts'
											));
		}
		
		$i=0;
		if(sizeof($_data['posts'])>0){
		//echo "<pre>"; var_dump($_data);
		foreach($_data['posts'] as $_item){
			$i++;
			$id = $_item['id'];
			$date = $_item['time_add'];
			$status  = $_item['status'];
			$count_comments= $_item['count_comments'];
			
			$ids_lng = isset($_item['ids_lng'])?$_item['ids_lng']:array();
			$lang_for_category = array();
			foreach($ids_lng as $lng_id){
				$data_lng = Language::getLanguage($lng_id);
				$lang_for_category[] = $data_lng['iso_code']; 
			}
			$lang_for_category = implode(",",$lang_for_category);
			
			
			$_info_cat = $obj_blog->getPostItem(array('id' => $id));
            $defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
			$title_post = isset($_info_cat['post']['data'][$defaultLanguage]['title'])?$_info_cat['post']['data'][$defaultLanguage]['title']:$_item['title'];
			$seo_url = isset($_info_cat['post']['data'][$defaultLanguage]['seo_url'])?$_info_cat['post']['data'][$defaultLanguage]['seo_url']:'';
			
			
			###  multisoter handler ###


            if($this->_is15){
                $ids_shops = isset($_info_cat['post'][0]['ids_shops'])?$_info_cat['post'][0]['ids_shops']:'';

                $shops_names =     $ids_shops;
                $ids_shops_custom = explode(",",$shops_names);
                $shops = Shop::getShops();
                $name_shop = array();
                foreach($shops as $_shop){
                    $id_shop_lists = $_shop['id_shop'];
                    if(in_array($id_shop_lists,$ids_shops_custom))
                        $name_shop[] = $_shop['name'];
                }
                $shops_names = implode(",<br/>",$name_shop);

            }
			###  multisoter handler ###

            $img = isset($_info_cat['post'][0]['img'])?$_info_cat['post'][0]['img']:'';
            $count_likes = isset($_item['count_likes'])?$_item['count_likes']:0;

			
			### post url ###
			$data_url = $obj_blog->getSEOURLs();
            $post_url = $data_url['post_url'];

            $post_url = '<a href="'.$post_url.((Configuration::get($this->name.'urlrewrite_on')==1)?$seo_url:'?post_id='.$id).'"
								target="_blank" style="text-decoration:underline" title="'.$title_post.'">'.$title_post.'</a>';


            ### post url ###
			
			
			
			$_html .= 
			'<tr>
			<td style = "color:black;">'.$id.'</td>';

            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->name.'/upload/';
            } else {
                $logo_img_path = '../upload/'.$this->name.'/';
            }
            if(Tools::strlen($img)>0){
                $img = '<img src="'.$logo_img_path.$img.'" style="width: 50px" class="img-thumbnail"/>';
            }
            $_html .= '<td style = "color:black;">'.$img.'</td>';

            $_html .= '<td style = "color:black;">'.$post_url.'</td>';
            $_html .= '<td style = "color:black;">'.$count_comments.'</td>';
            $_html .= '<td style = "color:black;">'.$count_likes.'</td>';
            if($this->_is15) {
                $_html .= '<td style = "color:black;">' . $shops_names . '</td>';
            }

			$_html .= '<td style = "color:black;">'.$lang_for_category.'</td>';

			if($status)
				$_html .= '<td><img alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" src="../img/admin/enabled.gif"></td>';
			else
				$_html .= '<td><img alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" src="../img/admin/disabled.gif"></td>';
				
			$_html .= '<td style = "color:black;">'.$date.'</td>
			
			';
			$_html .= '
			<td>
			<form action = "'.$_SERVER['REQUEST_URI'].'" name="get_posts" method = "POST">
				 <input type = "hidden" name = "id" value = "'.$id.'"/>
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&edit_item_posts=1&id_posts='.(int)($id).'" title="'.$this->l('Edit').'"><img src="'._PS_ADMIN_IMG_.'edit.gif" alt="" /></a> 
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&delete_item_posts=1&id_posts='.(int)($id).'" title="'.$this->l('Delete').'"  onclick = "javascript:return confirm(\''.$this->l('Are you sure you want to remove this item?').'\');"><img src="'._PS_ADMIN_IMG_.'delete.gif" alt="" /></a>'; 
				 $_html .= '</form>
			 </td>
			';
			
			$_html .= '</tr>';
		}
    	
    	} else {
    		$_html .= '<tr><td colspan=7 style="border-bottom:none;text-align:center;padding:10px">'.$this->l('No Posts.').'</td></tr>';
    	}
		
    	$_html .= '</table>';
    	if($i!=0 && $edit == 2){
    	$_html .= '<div style="margin:5px">';
    	$_html .= $paging;
    	$_html .= '</div>';
    	}
    	
    	$_html .= '</fieldset>';
    	
    	return $_html;
    }
    
     public function _drawComments($data = null){
     	$cookie = $this->context->cookie;

         $currentIndex = $this->context->currentindex;
     	
     	$currentIndex = isset($data['currentindex'])?$data['currentindex']:$currentIndex;
    	$controller = isset($data['controller'])?$data['controller']:'AdminModules';
    	
    	$token = isset($data['token'])?$data['token']:Tools::getAdminToken($controller.(int)(Tab::getIdFromClassName($controller)).(int)($cookie->id_employee));
    	
    	
    	$edit = isset($data['edit'])?$data['edit']:0;
    	$id_posts = isset($data['id_posts'])?(int)$data['id_posts']:0;
    	
    	
    	include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		$start = (int)Tools::getValue("pagecomments");
		if($edit == 2){
			$_data = $obj_blog->getComments(array('admin'=>2,'start'=>$start,'step'=>$this->_step));
		} else {
			$_data = $obj_blog->getComments(array('admin'=>1,'id'=>$id_posts));
		}
		
    	$_html = '';
    	
    	$_html .= '<fieldset>
					<legend><img src="../modules/'.$this->name.'/logo.gif" />
						'.$this->l('Blog Comments').'</legend>';
    	
    	if($edit ==1){
    		$count_all = $_data['count_all'];
    		$_html .= '<br/>';
    		$_html .= '<h2>'.$this->l('Comments').' ('.$count_all.')</h2>';
    				
    	}
    	
    	$_html .= '<table class = "table" width = 100%>
			<tr>
				<th width=20>'.$this->l('No.').'</th>
				<th width=250>'.$this->l('Post').'</th>';
    			if($this->_is15){
					$_html .= '<th width=100>'.$this->l('Shop').'</th>';
    			}
				$_html .= '<th width=50>'.$this->l('Language').'</th>
				<th width =250>'.$this->l('Comment').'</th>
				<th width=50>'.$this->l('Date').'</th>
				<th width=50>'.$this->l('Status').'</th>

				<th width = "44">'.$this->l('Action').'</th>
			</tr>';
    	
    	
		
		if($edit ==2){
		
		$paging = $obj_blog->PageNav($start,$_data['count_all'],$this->_step, 
											array('admin' => 1,'currentIndex'=>$currentIndex,
												  'token' => '&configure='.$this->name.'&token='.$token,
												  'item' => 'comments'
											));
		}
    	
		$i=0;
		
		if(sizeof($_data['comments'])>0){
		
		foreach($_data['comments'] as $_item){
			$i++;
			$id = $_item['id'];
			$name = Tools::substr($_item['comment'],0,100);
			$date = $_item['time_add'];
			$status  = $_item['status'];
			
			$data_lng = Language::getLanguage($_item['id_lang']);
			$lang_for_comment = $data_lng['iso_code'];

			if($this->_is15){
				$id_shop = $_item['id_shop'];
				
				$shops = Shop::getShops();
				$name_shop = '';
				foreach($shops as $_shop){
					$id_shop_lists = $_shop['id_shop'];
					if($id_shop == $id_shop_lists)
						$name_shop = $_shop['name'];
				}
			}
			
			$post_id = (int)$_item['id_post'];
			$_info_cat = $obj_blog->getPostItem(array('id' => $post_id));
			$title_post = isset($_info_cat['post']['data'][1]['title'])?$_info_cat['post']['data'][1]['title']:'';
			$seo_url = isset($_info_cat['post']['data'][1]['seo_url'])?$_info_cat['post']['data'][1]['seo_url']:'';

            $img = isset($_info_cat['post'][0]['img'])?$_info_cat['post'][0]['img']:'';


            ### post url ###
			$data_url = $obj_blog->getSEOURLs();
            $post_url = $data_url['post_url'];

            $post_url = '<a href="'.$post_url.((Configuration::get($this->name.'urlrewrite_on')==1)?$seo_url:'?post_id='.$id).'"
								target="_blank" style="text-decoration:underline" title="'.$title_post.'">'.$title_post.'</a>';

            ### post url ###
			
			
			
			
			$_html .= 
			'<tr>
			<td style = "color:black;">'.$id.'</td>';
            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->name.'/upload/';
            } else {
                $logo_img_path = '../upload/'.$this->name.'/';
            }
            if(Tools::strlen($img)>0){
                $img = '<img src="'.$logo_img_path.$img.'" style="width: 50px;margin-right:10px" class="img-thumbnail"/>';
            }
			$_html .= '<td style = "color:black;">'.$img.$post_url.'</td>';
			
			if($this->_is15){
				$_html .= '<td style = "color:black;">'.$name_shop.'</td>';
			}
			$_html .= '<td style = "color:black;">'.$lang_for_comment.'</td>';
			 
			$_html .= '<td style = "color:black;">'.$name.'</td>';

				
			$_html .= '<td style = "color:black;">'.$date.'</td>';

            if($status)
                $_html .= '<td><img alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" src="../img/admin/enabled.gif"></td>';
            else
                $_html .= '<td><img alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" src="../img/admin/disabled.gif"></td>';
			
			$_html .= '
			<td>';
			$_html .= '<form action = "'.$_SERVER['REQUEST_URI'].'" name="get_posts" method = "POST">
				 <input type = "hidden" name = "id" value = "'.$id.'"/>
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&edit_item_comments=1&id_comments='.(int)($id).'" title="'.$this->l('Edit').'"><img src="'._PS_ADMIN_IMG_.'edit.gif" alt="" /></a> 
				 <a href="'.$currentIndex.'&configure='.$this->name.'&token='.$token.'&delete_item_comments=1&id_comments='.(int)($id).'" title="'.$this->l('Delete').'"  onclick = "javascript:return confirm(\''.$this->l('Are you sure you want to remove this item?').'\');"><img src="'._PS_ADMIN_IMG_.'delete.gif" alt="" /></a>'; 
				 $_html .= '</form>
			 </td>
			';
			
			$_html .= '</tr>';
		}
		
    	 } else {
    		$_html .= '<tr><td colspan=8 style="border-bottom:none;text-align:center;padding:10px"
    					>'.$this->l('There are not Comments yet').'</td><tr>';
    	}
    	
    	$_html .= '</table>';
    	if($i!=0 && $edit == 2){
    	$_html .= '<div style="margin:5px">';
    	$_html .= $paging;
    	$_html .= '</div>';
    	}
    	
    	$_html .= '</fieldset>';
    	
    	return $_html;
    }
    
    public function _drawEditComments($data = null){
    	
    	
	
    	
    	include_once(dirname(__FILE__).'/classes/blog.class.php');
		$obj_blog = new blog();
		
		$action = isset($data['action'])?$data['action']:'';
		$id = isset($data['id'])?$data['id']:0;
		
    	if($action == 'edit'){
			$_data = $obj_blog->getCommentItem(array('id'=>$id));
			$name = $_data['comments'][0]['name'];
			$email = $_data['comments'][0]['email'];
			$comment = $_data['comments'][0]['comment'];
			$status = $_data['comments'][0]['status'];
			
			$time_add = $_data['comments'][0]['time_add'];
			
			$data_lng = Language::getLanguage($_data['comments'][0]['id_lang']);
			$lang_for_comment = $data_lng['iso_code'];

			if($this->_is15){
				$id_shop = $_data['comments'][0]['id_shop'];
				
				$shops = Shop::getShops();
				$name_shop = '';
				foreach($shops as $_shop){
					$id_shop_lists = $_shop['id_shop'];
					if($id_shop == $id_shop_lists)
						$name_shop = $_shop['name'];
				}
			}
			
			$post_id = (int)$_data['comments'][0]['id_post'];
			$_info_cat = $obj_blog->getPostItem(array('id' => $post_id));
			$title_post = isset($_info_cat['post']['data'][1]['title'])?$_info_cat['post']['data'][1]['title']:'';
			$seo_url = isset($_info_cat['post']['data'][1]['seo_url'])?$_info_cat['post']['data'][1]['seo_url']:'';
            $img = isset($_info_cat['post']['data'][1]['img'])?$_info_cat['post']['data'][1]['img']:'';

            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->name.'/upload/';
            } else {
                $logo_img_path = '../upload/'.$this->name.'/';
            }
            if(Tools::strlen($img)>0){
                $img = '<img src="'.$logo_img_path.$img.'" style="width: 50px;margin-right:10px" class="img-thumbnail"/>';
            }

           ### post url ###
			$data_url = $obj_blog->getSEOURLs();
            $post_url = $data_url['post_url'];

            $post_url = '<a href="'.$post_url.((Configuration::get($this->name.'urlrewrite_on')==1)?$seo_url:'?post_id='.$id).'"
								target="_blank" style="text-decoration:underline" title="'.$title_post.'">'.$title_post.'</a>';

            ### post url ###
			
			
			$button = $this->l('Update Comment');
			$title_block = $this->l('Edit Comment');
		}
		
    	$_html = '';
    	
    	
    	$_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" enctype="multipart/form-data">';
    	
    	$_html .= '<fieldset >
					<legend><img src="../modules/'.$this->name.'/logo.gif" />'.$title_block.'</legend>';

        $_html .= '<label style="width:120px">'.$this->l('ID').'</label>
    				<div class="margin-form" style="padding: 5px 0pt 10px 130px;">
					'.$id.'
			       </div>';


    	
    	$_html .= '<label style="width:120px">'.$this->l('Post title').'</label>
    			    <div class="margin-form" style="padding: 5px 0pt 10px 130px;">
					'.$img.$post_url.'
			       </div>';
    	if($this->_is15){
    	$_html .= '<label style="width:120px">'.$this->l('Shop').'</label>
    			    <div class="margin-form" style="padding: 5px 0pt 10px 130px;">
					'.$name_shop.'
			       </div>';
    	}
    	
    	$_html .= '<label style="width:120px">'.$this->l('Lang').'</label>
    			    <div class="margin-form" style="padding: 5px 0pt 10px 130px;">
					'.$lang_for_comment.'
			       </div>';
    	 
    	
    	$_html .= '<label style="width:120px">'.$this->l('Customer Name').'</label>
    			
    				<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">
					<input type="text" name="comments_name" value="'.$name.'"  style="width:274px">
			        
			       </div>';
    	
    	$_html .= '<label style="width:120px">'.$this->l('Customer Email').'</label>
    			
    				<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">
					<input type="text" name="comments_email" value="'.$email.'"  style="width:274px">
			        
			       </div>';
    
    	$_html .= '<label style="width:120px">'.$this->l('Comment').'</label>
    			
    				<div class="margin-form" style="padding: 0pt 0pt 10px 130px;">
					<textarea name="comments_comment" cols="80" rows="10"  
			                	   >'.$comment.'</textarea>
			        
			       </div>';
    	
    	$_html .= '<label style="width:120px">'.$this->l('Status').'</label>
				<div class = "margin-form" style="padding: 0pt 0pt 10px 130px;">';
				
		$_html .= '<select name="comments_status" style="width:100px">
					<option value=1 '.(($status==1)?"selected=\"true\"":"").'>'.$this->l('Enabled').'</option>
					<option value=0 '.(($status==0)?"selected=\"true\"":"").'>'.$this->l('Disabled').'</option>
				   </select>';
			
		$_html .= '</div>';




        #### publication date ####
        if(empty($time_add)){
            $time_add = date('Y-m-d H:i:s');
        }

        $_html .= '<label style="width:120px">'.$this->l('Publication date').':</label>';
        $_html .= '<div>';
        //.$time_add.
        $_html .= '<input id="time_add_comm"
                       type="text"
                       class="item_datepicker_add_comm" name="time_add_comm" value="'.$time_add.'" />
                <span class="input-group-addon"><i class="icon-calendar-empty"></i></span>';

        $_html .= '<script type="text/javascript">
            $(\'document\').ready( function() {

                var dateObj = new Date();
                var hours = dateObj.getHours();
                var mins = dateObj.getMinutes();
                var secs = dateObj.getSeconds();
                if (hours < 10) { hours = "0" + hours; }
                if (mins < 10) { mins = "0" + mins; }
                if (secs < 10) { secs = "0" + secs; }
                var time = " "+hours+":"+mins+":"+secs;

                if ($(".item_datepicker_add_comm").length > 0)
                $(".item_datepicker_add_comm").datepicker({prevText: \'\',nextText: \'\',dateFormat: \'yy-mm-dd\'+time});

            });
        </script>';
        $_html .= '</div>';



        #### publication date ####





    
		$_html .= '</fieldset>';
		
		if($action == 'edit'){
		$_html .= '<input type = "hidden" name = "id_editcomments" value = "'.$id.'"/>';
    	$_html .= '<p class="center" style="background: none; padding: 10px; margin-top: 10px;">
					<input type="submit" name="cancel_editcomments" value="'.$this->l('Cancel').'" 
                		   class="button"  />
    				<input type="submit" name="submit_editcomments" value="'.$button.'" 
                		   class="button"  />
                	
                	</p>';
		} 
		
    	
    	$_html .= '</form>';
    	
    	return $_html;
    }
    
    
private function _hint(){
    	$_html = '';
    	
    	$_html .= '<p style="display: block; font-size: 11px; width: 95%; margin-bottom:20px;position:relative" class="hint clear">
    	<b style="color:#585A69">'.$this->l('If url rewriting doesn\'t works, check that this above lines exist in your current .htaccess file, if no, add it manually on top of your .htaccess file').':</b>
    	<br/><br/>
    	<code>
		RewriteRule ^(.*)blog/category/([0-9a-zA-Z-_]+)/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-category.php?category_id=$2 [QSA,L]
		</code>
		<br/>
		<code>
		RewriteRule ^(.*)blog/post/([0-9a-zA-Z-_]+)/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-post.php?post_id=$2 [QSA,L]
		</code>
		<br/>
		<code>
		RewriteRule ^(.*)blog/categories/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-categories.php [QSA,L]
		</code>
		<br/>
		<code>
		RewriteRule ^(.*)blog/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-all-posts.php [QSA,L]
		</code>
		<br/>
		<code>
		RewriteRule ^(.*)blog/comments/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-all-comments.php [QSA,L]
		</code>
			<br/><br/>
		</p>';
    	
    	return $_html;
    }
    
    private function _hint15(){
    	$_html = '';
    	
    	$_html .= '<p style="display: block; width: 95%; margin-bottom: 20px; position: relative; font-size: 12px; line-height: 1.5em;" class="hint clear">
    	<b style="color:#585A69">'.$this->l('If url rewriting doesn\'t works, check that this above lines exist in your current .htaccess file, if no, add it manually on top of your .htaccess file').':</b>
    	<br/><br/>
    	
    	<b><code>
		RewriteRule ^(.*)blog/category/([0-9a-zA-Z-_]+)/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-category.php?category_id=$2 [QSA,L]
		</code>
		</b>
		<br/>
		<b>
		<code>
		RewriteRule ^(.*)blog/post/([0-9a-zA-Z-_]+)/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-post.php?post_id=$2 [QSA,L]
		</code>
		</b>
		<br/>
		<b>
		<code>
		RewriteRule ^(.*)blog/categories/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-categories.php [QSA,L]
		</code>
		</b>
		<br/>
		<b>
		<code>
		RewriteRule ^(.*)blog/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-all-posts.php [QSA,L]
		</code>
		</b>
		<br/>
		<b>
		<code>
		RewriteRule ^(.*)blog/comments/?$ '.__PS_BASE_URI__.'modules/blockblog/blockblog-all-comments.php [QSA,L]
		</code>
		</b>
		
		</p>';
    	
    	return $_html;
    }

    private function _UrlRewriteOLD(){
        $_html = '';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-link fa-lg"></i>&nbsp;'.$this->l('URL Rewriting').'</h3><br/>';


        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';


        $_html .= '<label>'.$this->l('Enable or Disable URL rewriting').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="radio" value="1" id="text_list_on" name="urlrewrite_on"
							'.(Tools::getValue('urlrewrite_on', Configuration::get($this->name.'urlrewrite_on')) ? 'checked="checked" ' : '').'>
					<label for="dhtml_on" class="t">
						<img alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" src="../img/admin/enabled.gif">
					</label>

					<input type="radio" value="0" id="text_list_off" name="urlrewrite_on"
						   '.(!Tools::getValue('urlrewrite_on', Configuration::get($this->name.'urlrewrite_on')) ? 'checked="checked" ' : '').'>
					<label for="dhtml_off" class="t">
						<img alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" src="../img/admin/disabled.gif">
					</label>

					<p class="clear">'.$this->l('Enable only if your server allows URL rewriting (recommended)').'.</p>
				';

        $_html .= '</div>';


        $_html .= '<p class="center" >
					<input type="submit" name="urlrewritesettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        $_html .= '<br/><br/>';


        if($this->_is15){
            $_html .= $this->_hint15();

        } else{
            $_html .= $this->_hint();
        }


        return $_html;
    }

    private function _categoriesOLD(){
        $_html = '';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-list fa-lg"></i>&nbsp;'.$this->l('Categories settings').'</h3><br/>';


        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<label>'.$this->l('Categories per Page:').'</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="perpage_catblog"
			               value="'.Tools::getValue('perpage_catblog', Configuration::get($this->name.'perpage_catblog')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Display date on list Categories page:').'</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="cat_list_display_date" '.((Tools::getValue($this->name.'cat_list_display_date', Configuration::get($this->name.'cat_list_display_date')) ==1)?'checked':'').'>';
        $_html .= '</div>';


        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;'.$this->l('Categories on Product Page settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('Display tab "Blog" on Product Page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="tab_blog_pr" '.((Tools::getValue($this->name.'tab_blog_pr', Configuration::get($this->name.'tab_blog_pr')) ==1)?'checked':'').'>';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Product tabs').':</label>
				<div class="margin-form">
					<select class="select" name="btabs_type"
							id="btabs_type">
						<option '.(Configuration::get($this->name.'btabs_type')  == "1" ? 'selected="selected" ' : '').' value="1">'.$this->l('Standard theme without Tabs').'</option>
						<option '.(Configuration::get($this->name.'btabs_type') == "2" ? 'selected="selected" ' : '').' value="2">'.$this->l('Custom theme with tabs on product page').'</option>
					</select>
					<p class="clear">'.$this->l('On a standard PrestaShop 1.6 theme, the product page no longer has tabs for the various sections. But some custom themes have added back tabs on the product page.').'</p>
				</div>';


        $_html .= '<p class="center" >
					<input type="submit" name="categoriessettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;

    }

    private function _postsOLD(){
        $_html = '';




        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;'.$this->l('Posts settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('Posts in the list view settings').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="perpage_posts"
			               value="'.Tools::getValue('perpage_posts', Configuration::get($this->name.'perpage_posts')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Display date on list posts view').':</label>';

        $_html .= '<div class="margin-form">';

        $_html .= '<input type="checkbox" value="1" name="p_list_displ_date" '.((Tools::getValue($this->name.'p_list_displ_date', Configuration::get($this->name.'p_list_displ_date')) ==1)?'checked':'').'>';

        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Image width in lists posts').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="lists_img_width"
			               value="'.Tools::getValue('lists_img_width', Configuration::get($this->name.'lists_img_width')).'"
			               >&nbsp;px
				';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Truncate posts content in the list view').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_pl_tr"
			               value="'.Tools::getValue('blog_pl_tr', Configuration::get($this->name.'blog_pl_tr')).'"
			               >&nbsp;'.$this->l('chars').'
				';
        $_html .= '</div>';


        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;'.$this->l('Posts on post page settings').'</h3><br/>';


        $_html .= '<label>'.$this->l('Display date on post page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="post_display_date" '.((Tools::getValue($this->name.'post_display_date', Configuration::get($this->name.'post_display_date')) ==1)?'checked':'').'>';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Image width on post page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="post_img_width"
			               value="'.Tools::getValue('post_img_width', Configuration::get($this->name.'post_img_width')).'"
			               >&nbsp;px
				';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Active Social share buttons').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="is_soc_buttons" '.((Tools::getValue($this->name.'is_soc_buttons', Configuration::get($this->name.'is_soc_buttons')) ==1)?'checked':'').'>';
        $_html .= '</div>';


        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-book fa-lg"></i>&nbsp;'.$this->l('Related products on post page settings').'</h3><br/>';



        $data_img_sizes = array();

        $available_types = ImageType::getImagesTypes('products');

        foreach ($available_types as $type){

            $id = $type['name'];
            $name = $type['name'].' ('.$type['width'].' x '.$type['height'].')';

            $data_item_size = array(
                'id' => $id,
                'name' => $name,
            );

            array_push($data_img_sizes,$data_item_size);


        }


        $_html .= '<label>'.$this->l('Image size for related products').':</label>
				<div class="margin-form">
					<select class="select" name="img_size_rp"
							id="img_size_rp">';
        foreach($data_img_sizes as $image) {
            $_html .= '<option ' . (Tools::getValue('img_size_rp', Configuration::get($this->name . 'img_size_rp')) == $image['id'] ? 'selected="selected" ' : '') . ' value="'.$image['id'].'">' . $image['name'] . '</option>
						';
        }
        $_html .= '</select>

				</div>';



        $_html .= '<label>'.$this->l('Truncate product description').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_rp_tr"
			               value="'.Tools::getValue('blog_rp_tr', Configuration::get($this->name.'blog_rp_tr')).'"
			               >&nbsp;'.$this->l('chars').'
				';
        $_html .= '</div>';



        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Related Posts on post page settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('Image width in the related posts block on post page').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="rp_img_width"
			               value="'.Tools::getValue('rp_img_width', Configuration::get($this->name.'rp_img_width')).'"
			               >&nbsp;px
				';
        $_html .= '</div>';


        $_html .= '<p class="center" >
					<input type="submit" name="postssettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;

    }

    private function _commentsOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-comments-o fa-lg"></i>&nbsp;'.$this->l('Comments settings').'</h3><br/>';


        $_html .= '<label>'.$this->l('Comments per Page in list view').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="perpage_com"
			               value="'.Tools::getValue('perpage_com', Configuration::get($this->name.'perpage_com')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Comments per Page on the post page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="pperpage_com"
			               value="'.Tools::getValue('pperpage_com', Configuration::get($this->name.'pperpage_com')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<p class="center" >
					<input type="submit" name="commentssettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;
    }
    private function _blocksOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Block "Blog categories" settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('The number of items in the "Blog categories":').'</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_bcat"
			               value="'.Tools::getValue('blog_bcat', Configuration::get($this->name.'blog_bcat')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Block "Blog Posts recents" settings').'</h3><br/>';


        $_html .= '<label>'.$this->l('The number of items in the block "Blog Posts recents"').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_bposts"
			               value="'.Tools::getValue('blog_bposts', Configuration::get($this->name.'blog_bposts')).'"
			               >
				';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Display date in the block "Blog Posts recents"').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="block_display_date" '.((Tools::getValue($this->name.'block_display_date', Configuration::get($this->name.'block_display_date')) ==1)?'checked':'').'>';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Display images in the block "Blog Posts recents"').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="block_display_img" '.((Tools::getValue($this->name.'block_display_img', Configuration::get($this->name.'block_display_img')) ==1)?'checked':'').'>';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Image width in the block "Blog Posts recents"').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="posts_block_img_width"
			               value="'.Tools::getValue('posts_block_img_width', Configuration::get($this->name.'posts_block_img_width')).'"
			               >&nbsp;px
				';
        $_html .= '</div>';


        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Block "Blog Posts recents" on Home Page settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('Display block "Blog Posts recents" on Home Page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type="checkbox" value="1" name="block_last_home" '.((Tools::getValue($this->name.'block_last_home', Configuration::get($this->name.'block_last_home')) ==1)?'checked':'').'>';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('"Blog Posts recents" on Home Page').':</label>';

        $_html .= '<div class="margin-form">';

        $_html .=  '
					<select class=" select" name="blog_h" id="defaultgroup">
					<option '.((Tools::getValue('blog_h', Configuration::get($this->name.'blog_h')) == '1') ? 'selected="selected" ' : '').' value="1">'.$this->l('Horizontal view Posts on home page').'</option>
					<option '.((Tools::getValue('blog_h', Configuration::get($this->name.'blog_h')) == '2') ? 'selected="selected" ' : '').' value="2">'.$this->l('Posts on home page in Blocks').'</option>
					</select>
		';

        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';


        $_html .= '<label>'.$this->l('The number of items in the block "Blog Posts recents" on home page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_bp_h"
							value="'.Tools::getValue('blog_bp_h', Configuration::get($this->name.'blog_bp_h')).'"
					>
		';
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Image width in the block "Blog Posts recents" on home page').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
        <input type="text" name="posts_w_h"
				        value="'.Tools::getValue('posts_w_h', Configuration::get($this->name.'posts_w_h')).'"
				        >&nbsp;px
        ';
        $_html .= '</div>';
        $_html .= '<div class="clear"></div>';


        $_html .= '<label>'.$this->l('Truncate posts in the block "Blog Posts recents" on home page').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_p_tr"
			               value="'.Tools::getValue('blog_p_tr', Configuration::get($this->name.'blog_p_tr')).'"
			               >&nbsp;'.$this->l('chars').'
				';
        $_html .= '</div>';


        $_html .= '<br/><h3 class="title-block-content"><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Block "Blog Last Comments" settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('The number of items in the block "Blog Last Comments"').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_com"
			               value="'.Tools::getValue('blog_com', Configuration::get($this->name.'blog_com')).'"
			               >
				';
        $_html .= '</div>';
        $_html .= '<div class="clear"></div>';

        $_html .= '<label>'.$this->l('Truncate Comments in the block "Blog Last Comments"').':</label>';


        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="blog_com_tr"
			               value="'.Tools::getValue('blog_com_tr', Configuration::get($this->name.'blog_com_tr')).'"
			               >&nbsp;'.$this->l('chars').'
				';
        $_html .= '</div>';


        $_html .= '<p class="center" >
					<input type="submit" name="blockssettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;
    }

    private function _positionsblocksOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-th fa-lg"></i>&nbsp;'.$this->l('Positions Blocks').'</h3><br/>';

        $_html .= '<label>'.$this->l('Left column').':</label>
				<div class="margin-form choose_hooks">
	    			<table style="width:66%;">
	    				<tr>
	    					<td style="width: 33%">'.$this->l('Blog Categories').'</td>
	    					<td style="width: 33%">'.$this->l('Blog Posts recents').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="cat_left" '.((Tools::getValue($this->name.'cat_left', Configuration::get($this->name.'cat_left')) ==1)?'checked':'').'  value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="posts_left" '.((Tools::getValue($this->name.'posts_left', Configuration::get($this->name.'posts_left')) ==1)?'checked':'') .' value="1"/>
	    					</td>

	    				</tr>
	    				<tr>
	    					<td>'.$this->l('Block Archives').'</td>
	    					<td>'.$this->l('Block Search').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="arch_left" '.((Tools::getValue($this->name.'arch_left', Configuration::get($this->name.'arch_left')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="search_left" '.((Tools::getValue($this->name.'search_left', Configuration::get($this->name.'search_left')) ==1)?'checked':'').' value="1"/>
	    					</td>

	    				</tr>

	    				<tr>
	    					<td>'.$this->l('Blog Last Comments').'</td>
	    					<td>&nbsp;</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="com_left" '.((Tools::getValue($this->name.'com_left', Configuration::get($this->name.'com_left')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
	    						&nbsp;
	    					</td>

	    				</tr>

	    			</table>
	    		</div>';




        $_html .= '<div class="clear"></div>';


        $_html .= '<br/><br/>';

        $_html .= '<label>'.$this->l('Right column').':</label>
				<div class="margin-form choose_hooks">
	    			<table style="width:66%;">
	    				<tr>
	    					<td style="width: 33%">'.$this->l('Blog Categories').'</td>
	    					<td style="width: 33%">'.$this->l('Blog Posts recents').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="cat_right" '.((Tools::getValue($this->name.'cat_right', Configuration::get($this->name.'cat_right')) ==1)?'checked':'').'  value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="posts_right" '.((Tools::getValue($this->name.'posts_right', Configuration::get($this->name.'posts_right')) ==1)?'checked':'').' value="1"/>
	    					</td>

	    				</tr>
	    				<tr>
	    					<td>'. $this->l('Block Archives').'</td>
	    					<td>'. $this->l('Block Search').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="arch_right" '.((Tools::getValue($this->name.'arch_right', Configuration::get($this->name.'arch_right')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="search_right" '.((Tools::getValue($this->name.'search_right', Configuration::get($this->name.'search_right')) ==1)?'checked':'').' value="1"/>
	    					</td>

	    				</tr>
	    				<tr>
	    					<td>'. $this->l('Blog Last Comments').'</td>
	    					<td>&nbsp;</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="com_right" '.((Tools::getValue($this->name.'com_right', Configuration::get($this->name.'com_right')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
	    						&nbsp;
	    					</td>

	    				</tr>

	    			</table>
	    		</div>';






        $_html .= '<div class="clear"></div>';

        $_html .= '<br/><br/>';


        $_html .= '<label>'.$this->l('Footer').':</label>
				<div class="margin-form choose_hooks">
	    			<table style="width:66%;">
	    				<tr>
	    					<td style="width: 33%">'.$this->l('Blog Categories').'</td>
	    					<td style="width: 33%">'.$this->l('Blog Posts recents').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="cat_footer" '.((Tools::getValue($this->name.'cat_footer', Configuration::get($this->name.'cat_footer')) ==1)?'checked':'').'  value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="posts_footer" '.((Tools::getValue($this->name.'posts_footer', Configuration::get($this->name.'posts_footer')) ==1)?'checked':'').' value="1"/>
	    					</td>

	    				</tr>
	    				<tr>
	    					<td>'. $this->l('Block Archives').'</td>
	    					<td>'. $this->l('Block Search').'</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="arch_footer" '.((Tools::getValue($this->name.'arch_footer', Configuration::get($this->name.'arch_footer')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="search_footer" '.((Tools::getValue($this->name.'search_footer', Configuration::get($this->name.'search_footer')) ==1)?'checked':'').' value="1"/>
	    					</td>

	    				</tr>

	    				<tr>
	    					<td>'. $this->l('Blog Last Comments').'</td>
	    					<td>&nbsp;</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="com_footer" '.((Tools::getValue($this->name.'com_footer', Configuration::get($this->name.'com_footer')) ==1)?'checked':'').' value="1"/>
	    					</td>
	    					<td>
								&nbsp;
	    					</td>

	    				</tr>

	    			</table>
	    		</div>';

        if($this->_is15) {
            $_html .= '<label>' . $this->l('Blocks in the CUSTOM HOOKS') . ':</label>
				<div class="margin-form choose_hooks">
	    			<table style="width:66%;">
	    				<tr>
	    					<td style="width: 33%">' . $this->l('Blog Categories in CUSTOM HOOK (blogCategoriesSPM)') . '</td>
	    					<td style="width: 33%">' . $this->l('Blog Posts in CUSTOM HOOK (blogPostsSPM)') . '</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="cat_custom_hook" ' . ((Configuration::get($this->name . 'cat_custom_hook') == 1) ? 'checked' : '') . '  value="1"/>
	    					</td>
	    					<td>
	    						<input type="checkbox" name="posts_custom_hook" ' . ((Configuration::get($this->name . 'posts_custom_hook') == 1) ? 'checked' : '') . ' value="1"/>
	    					</td>

	    				</tr>
	    				<tr>
	    					<td>' . $this->l('Block Comments in CUSTOM HOOK (blogCommentsSPM)') . '</td>
	    					<td>&nbsp;</td>

	    				</tr>
	    				<tr>
	    					<td>
	    						<input type="checkbox" name="comm_custom_hook" ' . ((Configuration::get($this->name . 'comm_custom_hook') == 1) ? 'checked' : '') . ' value="1"/>
	    					</td>
	    					<td>
	    						&nbsp;
	    					</td>

	    				</tr>



	    			</table>
	    		</div>';
        }


        $_html .= '<div class="clear"></div>';

        $_html .= '<p class="center" >
					<input type="submit" name="blockpositions" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        if($this->_is15) {
            $_html .= '<br/><br/>' . $this->_customhookhelp();
        }

        return $_html;

    }

    private function _emailOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-envelope-o fa-lg"></i>&nbsp;'.$this->l('Email settings').'</h3><br/>';

        $_html .= '<label>'.$this->l('E-mail notification:').'</label>';

        $_html .= '<div class="margin-form">';
        $_html .= '<input type = "checkbox" name = "noti" id = "noti" value ="1" '.((Tools::getValue($this->name.'noti', Configuration::get($this->name.'noti')) ==1)?'checked':'').'/>';
        $_html .= '</div>';

        $_html .= '<label>'.$this->l('Admin email:').'</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="mail"
			               value="'.Tools::getValue('mail', Configuration::get($this->name.'mail')).'"
			               >
				';
        $_html .= '</div>';


        $_html .= '<p class="center" >
					<input type="submit" name="emailsettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;
    }

    private function _rssfeedOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-rss fa-lg"></i>&nbsp;'.$this->l('RSS Feed').'</h3><br/>';

        $_html .= '<label>'.$this->l('Enable or Disable RSS Feed').':</label>';

        $_html .= '<script type="text/javascript">
			    	function enableOrDisableRSS(id)
						{
						if(id==0){
							$("#block-rss-settings").hide(200);
						} else {
							$("#block-rss-settings").show(200);
						}

						}
					</script>';

        $_html .= '<div class="margin-form">';

        $_html .=  '
					<input type="radio" value="1" id="text_list_on" name="rsson" onclick="enableOrDisableRSS(1)"
							'.(Tools::getValue('rsson', Configuration::get($this->name.'rsson')) ? 'checked="checked" ' : '').'>
					<label for="dhtml_on" class="t">
						<img alt="'.$this->l('Enabled').'" title="'.$this->l('Enabled').'" src="../img/admin/enabled.gif">
					</label>

					<input type="radio" value="0" id="text_list_off" name="rsson" onclick="enableOrDisableRSS(0)"
						   '.(!Tools::getValue('rsson', Configuration::get($this->name.'rsson')) ? 'checked="checked" ' : '').'>
					<label for="dhtml_off" class="t">
						<img alt="'.$this->l('Disabled').'" title="'.$this->l('Disabled').'" src="../img/admin/disabled.gif">
					</label>
				';

        $_html .= '</div>';
        $_html .= '<div class="clear"></div>';
        $_html .= '<div id="block-rss-settings" '.(Configuration::get($this->name.'rsson')==1?'style="display:block"':'style="display:none"').'>';




        $divLangName = "rssname¤srssdesc";

        // Title of your RSS Feed

        $_html .= '<label>'.$this->l('Title of your RSS Feed').':</label>';
        $_html .= '<div class="margin-form">';

        $defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
        $languages = Language::getLanguages(false);

        foreach ($languages as $language){
            $id_lng = (int)$language['id_lang'];
            $rssname = Configuration::get($this->name.'rssname'.'_'.$id_lng);


            $_html .= '	<div id="rssname_'.$language['id_lang'].'"
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >

						<input type="text" style="width:300px"
								  id="rssname_'.$language['id_lang'].'"
								  name="rssname_'.$language['id_lang'].'"
								  value="'.htmlentities(Tools::stripslashes($rssname), ENT_COMPAT, 'UTF-8').'"/>
						</div>';
        }
        $_html .= '';
        ob_start();
        $this->displayFlags($languages, $defaultLanguage, $divLangName, 'rssname');
        $displayflags = ob_get_clean();
        $_html .= $displayflags;



        // Description of your RSS Feed
        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';
        $_html .= '<label>'.$this->l('Description of your RSS Feed').':</label>';

        $_html .= '<div class="margin-form">';

        $defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
        $languages = Language::getLanguages(false);

        foreach ($languages as $language){
            $id_lng = (int)$language['id_lang'];
            $rssdesc = Configuration::get($this->name.'rssdesc_'.$id_lng);


            $_html .= '	<div id="srssdesc_'.$language['id_lang'].'"
							 style="display: '.($language['id_lang'] == $defaultLanguage ? 'block' : 'none').';float: left;"
							 >

							 <input type="text" style="width:300px"
								  id="rssdesc_'.$language['id_lang'].'"
								  name="rssdesc_'.$language['id_lang'].'"
								  value="'.htmlentities(Tools::stripslashes($rssdesc), ENT_COMPAT, 'UTF-8').'"/>

					</div>';
        }
        $_html .= '';
        ob_start();
        $this->displayFlags($languages, $defaultLanguage, $divLangName, 'srssdesc');
        $displayflags = ob_get_clean();
        $_html .= $displayflags;

        // Description of your RSS Feed

        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';
        $_html .= '<label>'.$this->l('Number of items in RSS Feed').':</label>';

        $_html .= '<div class="margin-form">';
        $_html .=  '
					<input type="text" name="number_rssitems"
			               value="'.Tools::getValue('number_rssitems', Configuration::get($this->name.'number_rssitems')).'"
			               >
				';


        $_html .= '</div>';

        $_html .= '</div>';

        $_html .= '<div class="clear"></div>';

        $_html .= '<p class="center" >
					<input type="submit" name="rssfeedsettings" value="'.$this->l('Update settings').'"
                		   class="button"  />
                	</p>';

        $_html .= '</form>';

        return $_html;

    }

    private function _sitemapOLD(){
        $_html = '';

        $_html .= '<form method="post" action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'">';

        $_html .= '<h3 class="title-block-content"><i class="fa fa-sitemap fa-lg"></i>&nbsp;'.$this->l('Sitemap').'</h3><br/>';

        $_html .= '<p>
                     <input type="submit" value="'.$this->l('Regenerate Google sitemap').'" name="submitsitemap" class="button">
                     &nbsp; <a target="_blank" style="text-decoration:underline" ';

        if($this->_is_cloud){
            $_html .= 'href="'._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml"';
        } else {
            $_html .= 'href="'._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml"';
        }
        $_html .= '>';
        if($this->_is_cloud){
            $_html .=	''._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml';
        } else {
            $_html .=	''._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml';
        }
        $_html .=	'</a>
                    </p>';

        $_html .= '<p class="hint clear" style="display: block; font-size: 11px; width: 95%; margin-top:20px;position:relative">
                            '.$this->l('To declare blog sitemap xml, add this line at the end of your robots.txt file').': <br><br>
							  <strong>
								Sitemap ';
        if($this->_is_cloud){
            $_html .= ''._PS_BASE_URL_.__PS_BASE_URI__.'modules/'.$this->name.'/upload/blog.xml';
        } else {
            $_html .= ''._PS_BASE_URL_.__PS_BASE_URI__.'upload/'.$this->name.'/blog.xml';
        }


        $_html .= '</strong>
                            </p>
                ';


        $_html .= '</form>';

        $_html .= $this->_cronhelp(array('url'=>'blogsitemap'));

        return $_html;
    }

    private function _drawSettingsForm(){
        $_html = '';
        $_html .= '<ul class="leftMenuIN">
			<li><a href="javascript:void(0)" onclick="tabs_custom_in(31)" id="tab-menuin-31" ><i class="fa fa-link fa-lg"></i>&nbsp;'.$this->l('URL Rewriting').'</a></li>
			<li><a href="javascript:void(0)" onclick="tabs_custom_in(32)" id="tab-menuin-32" ><i class="fa fa-list fa-lg"></i>&nbsp;'.$this->l('Categories settings').'</a></li>
			<li><a href="javascript:void(0)" onclick="tabs_custom_in(33)" id="tab-menuin-33" ><i class="fa fa-newspaper-o fa-lg"></i>&nbsp;'.$this->l('Posts settings').'</a></li>

			<li><a href="javascript:void(0)" onclick="tabs_custom_in(34)" id="tab-menuin-34" ><i class="fa fa-comments-o fa-lg"></i>&nbsp;'.$this->l('Comments settings').'</a></li>

			<li><a href="javascript:void(0)" onclick="tabs_custom_in(35)" id="tab-menuin-35" ><i class="fa fa-list-alt fa-lg"></i>&nbsp;'.$this->l('Blocks settings').'</a></li>
			<li><a href="javascript:void(0)" onclick="tabs_custom_in(36)" id="tab-menuin-36" ><i class="fa fa-th fa-lg"></i>&nbsp;'.$this->l('Positions Blocks').'</a></li>
            <li><a href="javascript:void(0)" onclick="tabs_custom_in(37)" id="tab-menuin-37" ><i class="fa fa-envelope-o fa-lg"></i>&nbsp;'.$this->l('Email settings').'</a></li>

            <li><a href="javascript:void(0)" onclick="tabs_custom_in(38)" id="tab-menuin-38" ><i class="fa fa-rss fa-lg"></i>&nbsp;'.$this->l('RSS Feed').'</a></li>
            <li><a href="javascript:void(0)" onclick="tabs_custom_in(39)" id="tab-menuin-39" ><i class="fa fa-sitemap fa-lg"></i>&nbsp;'.$this->l('Sitemap').'</a></li>


			</ul>
		';

        $_html .= '<div class="items-content">';
        $_html .= '<div class="menu-content" id="tabsin-31" style="display:block">'.$this->_UrlRewriteOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-32">'.$this->_categoriesOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-33">'.$this->_postsOLD().'</div>';

        $_html .= '<div class="menu-content" id="tabsin-34">'.$this->_commentsOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-35">'.$this->_blocksOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-36">'.$this->_positionsblocksOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-37">'.$this->_emailOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-38">'.$this->_rssfeedOLD().'</div>';
        $_html .= '<div class="menu-content" id="tabsin-39">'.$this->_sitemapOLD().'</div>';



        $_html .= '<div style="clear:both"></div>';
        $_html .= '</div>';

        $_html .= '<div style="clear:both"></div>';

        return $_html;
    }
    

    
    public function _jsandcss(){
    	$_html = '';

        $_html .= '<link rel="stylesheet" href="../modules/'.$this->name.'/views/css/font-custom.min.css" type="text/css" />';

        $_html .= '<link rel="stylesheet" href="../modules/'.$this->name.'/views/css/blog.css" type="text/css" />';
      
    	// custom menu
    	$_html .= '<link rel="stylesheet" href="../modules/'.$this->name.'/views/css/custom_menu.css" type="text/css" />';
    	$_html .= '<script type="text/javascript" src="../modules/'.$this->name.'/views/js/custom_menu.js"></script>';
    	
    	if(version_compare(_PS_VERSION_, '1.6', '>')){
    	$_html .=  '<link rel="stylesheet" media="screen" type="text/css" href="../modules/'.$this->name.'/views/css/prestashop16.css" />';
    		
    	}
    	// custom-input-file
    	
    	$_html .= '<link rel="stylesheet" href="../modules/'.$this->name.'/views/css/custom-input-file.css" type="text/css" />';
    	$_html .= '<script type="text/javascript" src="../modules/'.$this->name.'/views/js/custom-input-file.js"></script>';
    	
    	
    	
    	$cookie = $this->context->cookie;
    
		$defaultLanguage = (int)(Configuration::get('PS_LANG_DEFAULT'));
		$iso = Language::getIsoById((int)($cookie->id_lang));
		$isoTinyMCE = (file_exists(_PS_ROOT_DIR_.'/js/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en');
		$ad = dirname($_SERVER["PHP_SELF"]);
		
		if(defined('_MYSQL_ENGINE_') && Tools::substr(_PS_VERSION_,0,3) != '1.5'){
		$_html .=  '
			<script type="text/javascript">	
			var iso = \''.$isoTinyMCE.'\' ;
			var pathCSS = \''._THEME_CSS_DIR_.'\' ;
			var ad = \''.$ad.'\' ;
			</script>';
			$_html .= '<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js"></script>
			<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tinymce.inc.js"></script>';
		$_html .= '
		<script type="text/javascript">id_language = Number('.$defaultLanguage.');</script>';
		} 
		
		if(version_compare(_PS_VERSION_, '1.5', '>')  || 
			!defined('_MYSQL_ENGINE_')){
			
			if(version_compare(_PS_VERSION_, '1.5', '>')){
				$_html .=  '
			<script type="text/javascript">	
			var iso = \''.$isoTinyMCE.'\' ;
			var pathCSS = \''._THEME_CSS_DIR_.'\' ;
			var ad = \''.$ad.'\' ;
			</script>';
				$_html .= '<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tiny_mce/tiny_mce.js"></script>
				<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tinymce.inc.js"></script>';
			} else {
				$_html .=  '
			<script type="text/javascript">	
			var iso = \''.$isoTinyMCE.'\' ;
			var pathCSS = \''._THEME_CSS_DIR_.'\' ;
			var ad = \''.$ad.'\' ;
			</script>';
				$_html .= '<script type="text/javascript" src="'.__PS_BASE_URI__.'js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
				';
			}
			
			
			
		$_html .= '<script type="text/javascript">
					tinyMCE.init({
						mode : "specific_textareas",
						theme : "advanced",
						editor_selector : "rte",';
		if(version_compare(_PS_VERSION_, '1.5', '>')){
			 $_html .= 'skin:"cirkuit",';
		}
			$_html  .=  'editor_deselector : "noEditor",';
			
			if(version_compare(_PS_VERSION_, '1.6', '<')){
			$_html .=  'plugins : "safari,pagebreak,style,layer,table,advimage,advlink,inlinepopups,media,searchreplace,contextmenu,paste,directionality,fullscreen",
						//Theme options
						theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
						theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,forecolor,backcolor",
						theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,media,|,ltr,rtl,|,fullscreen",
						theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,pagebreak",
						theme_advanced_toolbar_location : "top",
						theme_advanced_toolbar_align : "left",
						theme_advanced_statusbar_location : "bottom",
						theme_advanced_resizing : false,
					';
			}else{
			$_html .= 'toolbar1 : "code,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,|,blockquote,colorpicker,pasteword,|,bullist,numlist,|,outdent,indent,|,link,unlink,|,cleanup,|,media,image",
		   			   plugins : "colorpicker link image paste pagebreak table contextmenu filemanager table code media autoresize textcolor",
		   			   ';
			}
		
						
						
		  $_html .=	   'content_css : "'.__PS_BASE_URI__.'themes/'._THEME_NAME_.'/css/global.css",
						document_base_url : "'.__PS_BASE_URI__.'",';
		  if(!defined('_MYSQL_ENGINE_')){
		  $_html .=		'width: "550",';
		  } else {
		  	if(version_compare(_PS_VERSION_, '1.5', '>'))
		  		$_html .=		'width: "650",';
		  	else
		  		$_html .= 'width: "400",';
		  }
		  
		  $_html .=	    'height: "auto",
						font_size_style_values : "8pt, 10pt, 12pt, 14pt, 18pt, 24pt, 36pt",
						// Drop lists for link/image/media/template dialogs
						template_external_list_url : "lists/template_list.js",
						external_link_list_url : "lists/link_list.js",
						external_image_list_url : "lists/image_list.js",
						media_external_list_url : "lists/media_list.js",';
			
			if(version_compare(_PS_VERSION_, '1.5', '>')){
			$_html .= 	'elements : "nourlconvert,ajaxfilemanager",
						 file_browser_callback : "ajaxfilemanager",';
			} else {
			$_html .= 	'elements : "nourlconvert",';
			}
			
			$_html .=	'entity_encoding: "raw",
						convert_urls : false,
						language : "'.(file_exists(_PS_ROOT_DIR_.'/js/tinymce/jscripts/tiny_mce/langs/'.$iso.'.js') ? $iso : 'en').'"
						
					});
		</script>';
		
		}
		
		if(version_compare(_PS_VERSION_, '1.6', '>')){
			$_html .= $this->context->controller->addJqueryUI(array('ui.core', 'ui.datepicker'));
		} elseif(version_compare(_PS_VERSION_, '1.5', '>') && version_compare(_PS_VERSION_, '1.6', '<')){
			$_html .= '<link href="'.__PS_BASE_URI__.'js/jquery/ui/themes/base/jquery.ui.theme.css" rel="stylesheet" type="text/css" media="all" />
						<link href="'.__PS_BASE_URI__.'js/jquery/ui/themes/base/jquery.ui.core.css" rel="stylesheet" type="text/css" media="all" />
						<link href="'.__PS_BASE_URI__.'js/jquery/ui/themes/base/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" media="all" />';
			
			$_html .= '<script type="text/javascript" src="'.__PS_BASE_URI__.'js/jquery/ui/jquery.ui.core.min.js"></script>
						<script type="text/javascript" src="'.__PS_BASE_URI__.'js/jquery/ui/jquery.ui.datepicker.min.js"></script>
						<script type="text/javascript" src="'.__PS_BASE_URI__.'js/jquery/ui/i18n/jquery.ui.datepicker-en.js"></script>';
		}else {
			$_html .= '<script type="text/javascript">

					var formProduct;

					var accessories = new Array();

					</script>';

			$_html .= '<link rel="stylesheet" type="text/css" href="'.__PS_BASE_URI__.'css/jquery.autocomplete.css" />

			<script type="text/javascript" src="'.__PS_BASE_URI__.'js/jquery/jquery.autocomplete.js"></script>';


                $_html .= '<link href="../modules/'.$this->name.'/backward_compatibility/datepicker14/css/jquery.ui.theme.css" rel="stylesheet" type="text/css" media="all" />
						<link href="../modules/'.$this->name.'/backward_compatibility/datepicker14/css/jquery.ui.core.css" rel="stylesheet" type="text/css" media="all" />
						<link href="../modules/'.$this->name.'/backward_compatibility/datepicker14/css/jquery.ui.datepicker.css" rel="stylesheet" type="text/css" media="all" />';

                $_html .= '<script type="text/javascript" src="../modules/'.$this->name.'/backward_compatibility/datepicker14/js/jquery.ui.core.min.js"></script>
						<script type="text/javascript" src="../modules/'.$this->name.'/backward_compatibility/datepicker14/js/jquery.ui.datepicker.min.js"></script>
						<script type="text/javascript" src="../modules/'.$this->name.'/backward_compatibility/datepicker14/js/jquery.ui.datepicker-en.js"></script>';
            //$_html .= '<link rel="stylesheet" type="text/css" href="'._PS_BASE_URL_.__PS_BASE_URI__.'css/jquery.datepicker14.css" />


       }
		
		
		$_html .= '<style type="text/css">';
		if(version_compare(_PS_VERSION_, '1.6', '<')){

            $_html .= '.update-button{border: 1px solid #EBEDF4;}';
		
		}
		$_html .= '</style>';
		 
    	return $_html;
    }
    
   public function renderTplCategories(){
   		
    	return Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/categories.tpl');
    } 
    
    public function renderTplCategory(){
    	return Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/category.tpl');
    }
    
    public function renderTplAllPosts(){
    return Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/all-posts.tpl');
    }	
    
    public function renderTplAllComments(){
    	return Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/all-comments.tpl');
    }	
    
    
    public function translateItems(){
    	return array('page'=>$this->l('Page'),
    				 'email_subject' =>  $this->l('New Comment from Your Blog'),
    				 'meta_title_categories' => $this->l('Blog categories'),
    			     'meta_description_categories' => $this->l('Blog categories'),
    				 'meta_keywords_categories' => $this->l('Blog categories'),
    				 'meta_title_all_posts' => $this->l('All Posts'),
    				 'meta_description_all_posts' => $this->l('All Posts'),
    				 'meta_keywords_all_posts' => $this->l('All Posts'),
    				 'add_new' => $this->l('Add New'),
    				 'title_home' => $this->l('Blog'),
    				 'title_categories' => $this->l('Categories'),
    				 'title_posts' => $this->l('Posts'),
    				 'title_comments' => $this->l('Comments'),
    				 'meta_title_all_comments' => $this->l('All Comments'),
    				 'meta_description_all_comments' => $this->l('All Comments'),
    				 'meta_keywords_all_comments' => $this->l('All Comments'),
                     'message_like' => $this->l('You have already voted for this post!'),


                    'msg_cap'=>$this->l('Please, enter the security code'),
                    'msg_comm'=>$this->l('Please, enter the comment'),
                    'msg_name'=>$this->l('Please, enter the name'),
                    'msg_em'=>$this->l('Please, enter the email. For example johndoe@domain.com'),

    				);
    }
    
    public function renderTplPost(){
    	return Module::display(dirname(__FILE__).'/blockblog.php', 'views/templates/front/post.tpl');
    }
    

	
    
    
    
    
}