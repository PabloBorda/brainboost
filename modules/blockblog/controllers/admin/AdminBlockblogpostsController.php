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
require_once(_PS_MODULE_DIR_ . 'blockblog/classes/BlockblogpostsItems.php');

class AdminBlockblogpostsController extends ModuleAdminController{

    private $_name_controller = 'AdminBlockblogposts';
    private $_name_module = 'blockblog';
    private $_data_table = 'blog_post_data';
    private  $_id_lang;
    private  $_id_shop;
    private  $_iso_code;

    public function __construct()

	{

            $this->bootstrap = true;
            $this->context = Context::getContext();
            $this->table = 'blog_post';


            $this->identifier = 'id';
            $this->className = 'BlockblogpostsItems';


            $this->lang = false;

            $this->_orderBy = 'id';
            $this->_orderWay = 'DESC';


            $this->allow_export = false;

            $this->list_no_link = true;

            $id_lang =  $this->context->cookie->id_lang;
            $this->_id_lang = $id_lang;
            $id_shop =  $this->context->shop->id;
            $this->_id_shop = $id_shop;

            $iso_code = Language::getIsoById($id_lang);
            $this->_iso_code = $iso_code;

            $this->_select .= 'a.id, a.img, c.title, a.time_add , c.seo_url, c.id_lang, '.$id_shop.' as id_shop, a.status ';
            $this->_join .= '  JOIN `' . _DB_PREFIX_ . $this->_data_table.'` c ON (c.id_item = a.id and c.id_lang = '.$id_lang.')';


            $this->_select .= ', (SELECT group_concat(sh.`name` SEPARATOR \', \')
                    FROM `'._DB_PREFIX_.'shop` sh
                    WHERE sh.`active` = 1 AND sh.deleted = 0 AND sh.`id_shop`
                    IN(SELECT
                          SUBSTRING_INDEX(SUBSTRING_INDEX(pt_in.ids_shops, \',\', sh_in.id_shop), \',\', -1) name
                        FROM
                          '._DB_PREFIX_.'shop as sh_in INNER JOIN '._DB_PREFIX_.$this->table.' pt_in
                          ON CHAR_LENGTH(pt_in.ids_shops)
                             -CHAR_LENGTH(REPLACE(pt_in.ids_shops, \',\', \'\'))>=sh_in.id_shop-1
                        WHERE pt_in.id =  a.id
                        ORDER BY
                          id, sh_in.id_shop)
                    ) as shop_name';

            $this->_select .= ', (SELECT group_concat(l.`iso_code` SEPARATOR \', \')
	            FROM `'._DB_PREFIX_.'lang` l
	            JOIN
	            `'._DB_PREFIX_.'lang_shop` ls
	            ON(l.id_lang = ls.id_lang)
	            WHERE l.`active` = 1 AND ls.id_shop = '.$id_shop.' AND l.`id_lang`
	            IN( select pt_d.id_lang FROM `'._DB_PREFIX_.$this->_data_table.'` pt_d WHERE pt_d.id_item = a.id)) as language';

            $this->_select .= ', (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pc1
				    WHERE pc1.id_post = a.id) as count_comments ';

            $this->_select .= ', (select count(*) as count from `'._DB_PREFIX_.'blog_post_like` pclike
				    WHERE pclike.post_id = a.id) as count_likes ';



            $this->addRowAction('edit');
            $this->addRowAction('delete');
            //$this->addRowAction('view');
            //$this->addRowAction('&nbsp;');


            if(Configuration::get($this->_name_module.'urlrewrite_on')){
              $is_rewrite = 1;
            } else {
               $is_rewrite = 0;
            }

            // is cloud ?? //
            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->_name_module.'/upload/';
            } else {
                $logo_img_path = '../upload/'.$this->_name_module.'/';
            }
            // is cloud ?? //

            $all_laguages = Language::getLanguages(true);

            $this->fields_list = array(
                'id' => array(
                    'title' => $this->l('ID'),
                    'align' => 'center',
                    'search' => true,
                    'orderby' => true,

                ),

                'img' => array(
                    'title' => $this->l('Image'),
                    'width' => 'auto',
                    'search' => false,
                    'align' => 'center',
                    'logo_img_path' => $logo_img_path,
                    'type_custom' => 'img',
                    'orderby' => true,

                ),

                'title' => array(
                    'title' => $this->l('Title'),
                    'width' => 'auto',
                    'orderby' => true,
                    'type_custom' => 'title_post',
                    'is_rewrite' => $is_rewrite,
                    'iso_code' => count($all_laguages)>1?$this->_iso_code."/":"",
                    'base_dir_ssl' => _PS_BASE_URL_SSL_.__PS_BASE_URI__,

                ),

                'count_comments' => array(
                    'title' => $this->l('Count comments'),
                    'width' => 'auto',
                    'search' => false,
                    'align' => 'center',

                ),

                'count_likes' => array(
                    'title' => $this->l('Count likes'),
                    'width' => 'auto',
                    'search' => false,
                    'align' => 'center',

                ),


                'shop_name' => array(
                    'title' => $this->l('Shop'),
                    'width' => 'auto',
                    'search' => false

                ),

                'language' => array(
                    'title' => $this->l('Language'),
                    'width' => 'auto',
                    'search' => false

                ),

                'time_add' => array(
                    'title' => $this->l('Date add'),
                    'width' => 'auto',
                    'search' => false,

                ),


                'status' => array(
                    'title' => $this->l('Status'),
                    'width' => 40,
                    'align' => 'center',
                    'type' => 'bool',
                    'orderby' => FALSE,
                    'type_custom' => 'is_active',
                ),

            );

            $this->bulk_actions = array(
                'delete' => array(
                    'text' => $this->l('Delete selected'),
                    'icon' => 'icon-trash',
                    'confirm' => $this->l('Delete selected items?')
                )
            );



		parent::__construct();
		
	}




    public function getList($id_lang, $order_by = null, $order_way = null, $start = 0, $limit = null, $id_lang_shop = false)
    {
        $list = parent::getList($id_lang, $order_by, $order_way, $start, $limit, $id_lang_shop);
        $this->_listsql = false;
        return $list;
    }

    public function initPageHeaderToolbar()
    {
        if (empty($this->display)) {
            $this->page_header_toolbar_btn['add_item'] = array(
                'href' => self::$currentIndex.'&addblog_post&token='.$this->token,
                'desc' => $this->l('Add new post', null, null, false),
                'icon' => 'process-icon-new'
            );
        }

        parent::initPageHeaderToolbar();
    }

    public function initToolbar() {

        parent::initToolbar();
        /*$this->toolbar_btn['add_item'] = array(
                                            'href' => self::$currentIndex.'&add'.$this->_name_module.'&token='.$this->token,
                                            'desc' => $this->l('Add new post', null, null, false),
                                        );
        *///unset($this->toolbar_btn['new']);

    }



    public function postProcess()
    {


        require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/classes/blog.class.php');
        $bloghelp_obj = new blog();


        if (Tools::isSubmit('add_item')) {
            ## add item ##
            $seo_url = Tools::getValue("seo_url");
            $languages = Language::getLanguages(false);
            $data_title_content_lang = array();
            $data_validation = array();


            $ids_related_products = Tools::getValue("inputAccessories");

            $ids_related_posts = Tools::getValue("ids_related_posts");

            $time_add = Tools::getValue("time_add");

            $cat_shop_association = Tools::getValue("cat_shop_association");

            foreach ($languages as $language){
                $id_lang = $language['id_lang'];
                $post_title = Tools::getValue("post_title_".$id_lang);
                $post_seokeywords = Tools::getValue("post_seokeywords_".$id_lang);
                $post_seodescription = Tools::getValue("post_seodescription_".$id_lang);
                $post_content = Tools::getValue("content_".$id_lang);

                if(Tools::strlen($post_title)>0 || Tools::strlen($post_content)>0)
                {
                    $data_title_content_lang[$id_lang] = array('post_title' => $post_title,
                                                                'post_seokeywords' => $post_seokeywords,
                                                                'post_seodescription' => $post_seodescription,
                                                                'post_content' => $post_content,
                                                                'seo_url' => $seo_url
                    );
                    $data_validation[$id_lang] = array('post_content' => $post_content);
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







            if(sizeof($data_title_content_lang)==0)
                $this->errors[] = Tools::displayError('Please fill the Title');
            if(sizeof($data_validation)==0)
                $this->errors[] = Tools::displayError('Please fill the Content');
            if(!($cat_shop_association))
                $this->errors[] = Tools::displayError('Please select the Shop');
            if(!$time_add)
                $this->errors[] = Tools::displayError('Please select Date Add');


            if (empty($this->errors)) {



                $bloghelp_obj->savePost($data);

                Tools::redirectAdmin(self::$currentIndex . '&conf=3&token=' . Tools::getAdminTokenLite($this->_name_controller));
            } else {
                $this->display = 'add';
                return FALSE;
             }
            ## add item ##

        } elseif(Tools::isSubmit('update_item')) {
                $id = Tools::getValue('id');


            //echo "<pre>"; var_dump($_FILES);exit;


                $seo_url = Tools::getValue("seo_url");
                $languages = Language::getLanguages(false);
                $data_title_content_lang = array();
                $data_validation = array();

                $ids_related_products = Tools::getValue("inputAccessories");

                $ids_related_posts = Tools::getValue("ids_related_posts");


                $time_add = Tools::getValue("time_add");
                $cat_shop_association = Tools::getValue("cat_shop_association");


                foreach ($languages as $language){
                    $id_lang = $language['id_lang'];
                    $post_title = Tools::getValue("post_title_".$id_lang);
                    $post_seokeywords = Tools::getValue("post_seokeywords_".$id_lang);
                    $post_seodescription = Tools::getValue("post_seodescription_".$id_lang);
                    $post_content = Tools::getValue("content_".$id_lang);

                    if(Tools::strlen($post_title)>0 || Tools::strlen($post_content)>0)
                    {
                        $data_title_content_lang[$id_lang] = array('post_title' => $post_title,
                                                                    'post_seokeywords' => $post_seokeywords,
                                                                    'post_seodescription' => $post_seodescription,
                                                                    'post_content' => $post_content,
                                                                    'seo_url'=>$seo_url
                        );
                        $data_validation[$id_lang] = array('post_content' => $post_content);
                    }
                }


                $ids_categories = Tools::getValue("ids_categories");
                $post_status = Tools::getValue("post_status");
                $post_iscomments = Tools::getValue("post_iscomments");
                $post_images = Tools::getValue("post_images");

                $data = array('data_title_content_lang'=>$data_title_content_lang,
                            'ids_categories' => $ids_categories,
                            'post_status' => $post_status,
                            'post_iscomments' => $post_iscomments,
                            'id_editposts' => $id,
                            'post_images' => $post_images,
                            'cat_shop_association' => $cat_shop_association,
                            'related_products'=>$ids_related_products,
                            'ids_related_posts'=>$ids_related_posts,
                            'time_add' => $time_add
                );



                if(sizeof($data_title_content_lang)==0)
                    $this->errors[] = Tools::displayError('Please fill the Title');
                if(sizeof($data_validation)==0)
                    $this->errors[] = Tools::displayError('Please fill the Content');
                if(!($cat_shop_association))
                    $this->errors[] = Tools::displayError('Please select the Shop');
                if(!$time_add)
                    $this->errors[] = Tools::displayError('Please select Date Add');



             if (empty($this->errors)) {

                 $bloghelp_obj->updatePost($data);

                Tools::redirectAdmin(self::$currentIndex . '&conf=4&token=' . Tools::getAdminTokenLite($this->_name_controller));
            }else{

                $this->display = 'add';
                return FALSE;
            }

            ## update item ##
            } elseif (Tools::isSubmit('submitBulkdelete' . $this->_name_module)) {
                ### delete more than one  items ###
                if ($this->tabAccess['delete'] === '1') {
                    if (Tools::getValue($this->list_id . 'Box')) {


                        $object = new $this->className();

                        if ($object->deleteSelection(Tools::getValue($this->list_id . 'Box'))) {
                            Tools::redirectAdmin(self::$currentIndex . '&conf=2' . '&token=' . $this->token);
                        }
                        $this->errors[] = Tools::displayError('An error occurred while deleting this selection.');
                    } else {
                        $this->errors[] = Tools::displayError('You must select at least one element to delete.');
                    }
                } else {
                    $this->errors[] = Tools::displayError('You do not have permission to delete this.');
                }
                ### delete more than one  items ###
            } elseif (Tools::isSubmit('delete' . $this->_name_module)) {
                ## delete item ##

                $id = Tools::getValue('id');

                $bloghelp_obj->deleteCategory(array('id' => $id));

                Tools::redirectAdmin(self::$currentIndex . '&conf=1&token=' . Tools::getAdminTokenLite($this->_name_controller));
                ## delete item ##
            } else {
               return parent::postProcess(true);
            }




    }


    public function setMedia()
    {
        parent::setMedia();

        $this->context->controller->addCSS(__PS_BASE_URI__.'js/jquery/plugins/autocomplete/jquery.autocomplete.css');
        $this->context->controller->addJs(__PS_BASE_URI__.'js/jquery/plugins/autocomplete/jquery.autocomplete.js');

        $this->context->controller->addJs(__PS_BASE_URI__.'modules/'.$this->_name_module.'/views/js/admin.js');

        $this->context->controller->addJs(__PS_BASE_URI__.'modules/'.$this->_name_module.'/views/js/custom_menu.js');


        $this->addJqueryUi(array('ui.core','ui.widget','ui.datepicker'));

    }


    public function renderForm()
    {
        if (!($this->loadObject(true)))
            return;

        if (Validate::isLoadedObject($this->object)) {
            $this->display = 'update';
        } else {
            $this->display = 'add';
        }


        $id = (int)Tools::getValue('id');

        require_once(_PS_MODULE_DIR_ . ''.$this->_name_module.'/classes/blog.class.php');
        $obj_blog = new blog();

        $related_categories  = $obj_blog->getCategories(array('admin'=>1));
        $related_posts  = $obj_blog->getRelatedPosts(array('admin'=>1,'id'=>$id));

        require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/blockblog.php');
        $blockblog = new blockblog();
        $is_demo = $blockblog->is_demo;
        if($is_demo){
            $is_demo = '<div class="bootstrap">
								<div class="alert alert-warning">
									<button type="button" data-dismiss="alert" class="close">×</button>
									<strong>Warning</strong><br>
                                    Feature disabled on the demo mode
                                    &zwnj;</div>
							</div>';
        } else {
            $is_demo = '';
        }



        if($id) {

            $_data = $obj_blog->getPostItem(array('id'=>$id));

            $id_shop = isset($_data['post'][0]['ids_shops']) ? explode(",",$_data['post'][0]['ids_shops']) : array();
            $time_add = isset($_data['post'][0]['time_add']) ? $_data['post'][0]['time_add'] :date("Y-m-d H:i:s") ;
            $logo_img = isset($_data['post'][0]['img']) ? $_data['post'][0]['img'] :'' ;

            // is cloud ?? //
            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->_name_module.'/upload/'.$logo_img;
            } else {
                $logo_img_path = '../upload/'.$this->_name_module.'/'.$logo_img;
            }
            // is cloud ?? //

            $category_ids = isset($_data['post'][0]['category_ids']) ?$_data['post'][0]['category_ids']: array();
            $related_posts_selected = isset($_data['post'][0]['related_posts']) ?explode(",",$_data['post'][0]['related_posts']): array();
            $related_products_selected = isset($_data['post'][0]['related_products']) ?$_data['post'][0]['related_products']: 0;


        } else {

            $id_shop = array();
            $time_add = date("Y-m-d H:i:s");
            $logo_img = '';
            $logo_img_path = '';
            $category_ids = array();
            $related_posts_selected = array();
            $related_products_selected = 0;

        }

        $related_products = (($related_products_selected!=0) ? $obj_blog->getProducts($related_products_selected) : array());


        if($id){
            $title_item_form = $this->l('Edit post:');
        } else{
            $title_item_form = $this->l('Add new post:');
        }



        $this->fields_form = array(
            'tinymce' => TRUE,
            'legend' => array(
                'title' => $title_item_form,
                //'icon' => 'fa fa-list fa-lg'
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Title'),
                    'name' => 'post_title',
                    'id' => 'post_title',
                    'lang' => true,
                    'required' => TRUE,
                    'size' => 5000,
                    'maxlength' => 5000,
                ),



                array(
                    'type' => 'textarea',
                    'label' => $this->l('SEO Keywords'),
                    'name' => 'post_seokeywords',
                    'id' => 'post_seokeywords',
                    'required' => FALSE,
                    'autoload_rte' => FALSE,
                    'lang' => TRUE,
                    'rows' => 8,
                    'cols' => 40,

                ),

                array(
                    'type' => 'textarea',
                    'label' => $this->l('SEO Description'),
                    'name' => 'post_seodescription',
                    'id' => 'post_seodescription',
                    'required' => FALSE,
                    'autoload_rte' => FALSE,
                    'lang' => TRUE,
                    'rows' => 8,
                    'cols' => 40,

                ),

                array(
                    'type' => 'textarea',
                    'label' => $this->l('Content'),
                    'name' => 'content',
                    'id' => 'content',
                    'required' => TRUE,
                    'autoload_rte' => TRUE,
                    'lang' => TRUE,
                    'rows' => 8,
                    'cols' => 40,

                ),

                array(
                    'type' => 'post_image_custom',
                    'label' => $this->l('Logo Image'),
                    'name' => 'post_image',
                    'logo_img'=>$logo_img,
                    'logo_img_path' => $logo_img_path,
                    'id_post' => $id,
                    'required' => FALSE,
                    'desc' => $this->l('Allow formats *.jpg; *.jpeg; *.png; *.gif.'),
                    'is_demo' => $is_demo,
                    'max_upload_info' => ini_get('upload_max_filesize'),
                ),

                array(
                    'type' => 'related_categories',
                    'label' => $this->l('Select categories'),
                    'name' => 'ids_categories',
                    'values'=>$related_categories['categories'],
                    'selected_data'=>$category_ids,
                    'required' => false,
                    'name_field_custom'=>'ids_categories',
                ),

                array(
                    'type' => 'related_products',
                    'label' => $this->l('Related Products'),
                    'name' => 'related_products',
                    'values'=>$related_products,
                    'selected_data'=>$related_products_selected,
                    'required' => false,
                    'desc' => $this->l('Begin typing the first letters of the product name, then select the product from the drop-down list'),
                ),

                array(
                    'type' => 'related_categories',
                    'label' => $this->l('Related posts'),
                    'name' => 'ids_categories',
                    'values'=>$related_posts['related_posts'],
                    'selected_data'=>$related_posts_selected,
                    'required' => false,
                    'name_field_custom'=>'ids_related_posts',
                ),

                array(
                    'type' => 'cms_pages',
                    'label' => $this->l('Shop association'),
                    'name' => 'cat_shop_association',
                    'values'=>Shop::getShops(),
                    'selected_data'=>$id_shop,
                    'required' => TRUE,
                ),

                array(
                    'type' => 'switch',
                    'label' => $this->l('Enable Comments'),
                    'name' => 'post_iscomments',
                    'required' => FALSE,
                    'class' => 't',
                    'is_bool' => TRUE,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                ),

                array(
                    'type' => 'item_date',
                    'label' => $this->l('Date Add'),
                    'name' => 'date_on',
                    'time_add' => $time_add,
                    'required' => TRUE,
                ),

                array(
                    'type' => 'switch',
                    'label' => $this->l('Status'),
                    'name' => 'post_status',
                    'required' => FALSE,
                    'class' => 't',
                    'is_bool' => TRUE,
                    'values' => array(
                        array(
                            'id' => 'active_on',
                            'value' => 1,
                            'label' => $this->l('Enabled')
                        ),
                        array(
                            'id' => 'active_off',
                            'value' => 0,
                            'label' => $this->l('Disabled')
                        )
                    ),
                ),


            ),


        );


        if(Configuration::get($this->_name_module.'urlrewrite_on') == 1){
            $this->array_push_pos($this->fields_form['input'],1,
                array(
                    'type' => 'text',
                    'label' => $this->l('Identifier (SEO URL)'),
                    'name' => 'seo_url',
                    'id' => 'seo_url',
                    'lang' => false,
                    'required' => FALSE,
                    'size' => 5000,
                    'maxlength' => 5000,
                    'desc' => $this->l('You can leave the field blank - then Identifier (SEO URL) is generated automatically!').' (eg: http://domain.com/blog/post/identifier)',



                )
            );
        }





        $this->fields_form['submit'] = array(
            'title' => ($id)?$this->l('Update'):$this->l('Save'),
        );




        if($id) {

            $this->tpl_form_vars = array(
               'fields_value' => $this->getConfigFieldsValuesForm(array('id'=>$id)),
            );

            $this->submit_action = 'update_item';
        } else {
            $this->submit_action = 'add_item';

        }



        return parent::renderForm();
    }


    

    public function getConfigFieldsValuesForm($data_in){



        $id = (int)Tools::getValue('id');
        if($id) {
            $id = $data_in['id'];
            require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/classes/blog.class.php');
            $obj_blog = new blog();
            $_data = $obj_blog->getPostItem(array('id'=>$id));


            $languages = Language::getLanguages(false);
            $fields_title = array();
            $fields_seo_keywords = array();
            $fields_seo_description = array();
            $fields_content = array();

            foreach ($languages as $lang)
            {
                $fields_title[$lang['id_lang']] = isset($_data['post']['data'][$lang['id_lang']]['title'])?$_data['post']['data'][$lang['id_lang']]['title']:'';

                $fields_seo_keywords[$lang['id_lang']] = isset($_data['post']['data'][$lang['id_lang']]['seo_keywords'])?$_data['post']['data'][$lang['id_lang']]['seo_keywords']:'';

                $fields_seo_description[$lang['id_lang']] = isset($_data['post']['data'][$lang['id_lang']]['seo_description'])?$_data['post']['data'][$lang['id_lang']]['seo_description']:'';

                $fields_content[$lang['id_lang']] = isset($_data['post']['data'][$lang['id_lang']]['content'])?$_data['post']['data'][$lang['id_lang']]['content']:'';
            }

            $seo_url = isset($_data['post']['data'][$this->_id_lang]['seo_url'])?$_data['post']['data'][$this->_id_lang]['seo_url']:"";
            $status = isset($_data['post'][0]['status'])?$_data['post'][0]['status']:0;
            $is_comments = isset($_data['post'][0]['is_comments'])?$_data['post'][0]['is_comments']:0;


            $config_array = array(
                'post_title' => $fields_title,
                'content'=>$fields_content,
                'seo_url' => $seo_url,
                'post_seokeywords' => $fields_seo_keywords,
                'post_seodescription' => $fields_seo_description,
                'post_iscomments' => $is_comments,
                'post_status' => $status,
            );
        } else {
            $config_array = array();
        }
        return $config_array;
    }

    private function array_push_pos(&$array,$pos=0,$value,$key='')
    {
        if (!is_array($array)) {return false;}
        else
        {
            if (Tools::strlen($key) == 0) {$key = $pos;}
            $c = count($array);
            $one = array_slice($array,0,$pos);
            $two = array_slice($array,$pos,$c);
            $one[$key] = $value;
            $array = array_merge($one,$two);
            return;
        }
    }
	
}





?>

