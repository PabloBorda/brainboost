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
require_once(_PS_MODULE_DIR_ . 'blockblog/classes/BlockblogcommentsItems.php');

class AdminBlockblogcommentsController extends ModuleAdminController{

    private $_name_controller = 'AdminBlockblogcomments';
    private $_name_module = 'blockblog';
    private  $_id_lang;
    private  $_id_shop;
    private  $_iso_code;

    public function __construct()

	{

            $this->bootstrap = true;
            $this->context = Context::getContext();
            $this->table = 'blog_comments';


            $this->identifier = 'id';
            $this->className = 'BlockblogcommentsItems';


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

            $this->_select .= 'a.id, cd.title,
                               IF(LENGTH(a.comment)>50,CONCAT(SUBSTR(a.comment,1,50),"..."),a.comment) as comment,
                               c.img, a.time_add , a.id_lang, a.id_shop, a.status, cd.seo_url ';
            $this->_join .= '  JOIN `' . _DB_PREFIX_ .'blog_post` c  ON (c.id = a.id_post AND FIND_IN_SET(a.id_shop,c.ids_shops)) ';
            $this->_join .= '  JOIN `' . _DB_PREFIX_ .'blog_post_data` cd  ON (c.id = cd.id_item and a.id_lang = cd.id_lang) ';


            $this->_select .= ', (SELECT group_concat(sh.`name` SEPARATOR \', \')
                    FROM `'._DB_PREFIX_.'shop` sh
                    WHERE sh.`active` = 1 AND sh.deleted = 0 AND sh.`id_shop` = a.id_shop
                    ) as shop_name';

            $this->_select .= ', (SELECT group_concat(l.`iso_code` SEPARATOR \', \')
	            FROM `'._DB_PREFIX_.'lang` l
	            JOIN
	            `'._DB_PREFIX_.'lang_shop` ls
	            ON(l.id_lang = ls.id_lang)
	            WHERE l.`active` = 1 AND ls.id_shop = '.$id_shop.' AND l.`id_lang` = a.id_lang) as language';




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

                'title' => array(
                    'title' => $this->l('Post'),
                    'width' => 'auto',
                    'orderby' => true,
                    'type_custom' => 'title_comment',
                    'is_rewrite' => $is_rewrite,
                    'iso_code' => count($all_laguages)>1?$this->_iso_code."/":"",
                    'base_dir_ssl' => _PS_BASE_URL_SSL_.__PS_BASE_URI__,
                    'logo_img_path' => $logo_img_path,
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

                'comment' => array(
                    'title' => $this->l('Comment'),
                    'width' => 'auto',
                    'search' => TRUE

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

        parent::initPageHeaderToolbar();
    }

    public function initToolbar() {

        parent::initToolbar();
        /*$this->toolbar_btn['add_item'] = array(
                                            'href' => self::$currentIndex.'&add'.$this->_name_module.'&token='.$this->token,
                                            'desc' => $this->l('Add new category', null, null, false),
                                        );
        */
        //unset($this->toolbar_btn['new']);

        //echo "<pre>"; var_dump($this->toolbar_btn['new']);exit;
        $this->toolbar_btn['new']= array(
            'href' => '#',
            'desc' => '',
        );



    }



    public function postProcess()
    {


        require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/classes/blog.class.php');
        $bloghelp_obj = new blog();


        if (Tools::isSubmit('update_item')) {
                $id = Tools::getValue('id');
                ## update item ##

                $comments_name = Tools::getValue("comments_name");
                $comments_email = Tools::getValue("comments_email");
                $comments_comment = Tools::getValue("comments_comment");
                $comments_status = Tools::getValue("comments_status");
                $time_add = Tools::getValue("time_add");

                $data = array('comments_name' => $comments_name,
                    'comments_email' => $comments_email,
                    'comments_comment' => $comments_comment,
                    'comments_status' => $comments_status,
                    'time_add'=>$time_add,
                    'id_editcomments' => $id
                );


                if(!$comments_name)
                    $this->errors[] = Tools::displayError('Please fill the Customer Name');

                if(!$comments_email)
                    $this->errors[] = Tools::displayError('Please fill the Customer Email');

                if(!$comments_comment)
                    $this->errors[] = Tools::displayError('Please fill the Comment');

                if(!$time_add)
                    $this->errors[] = Tools::displayError('Please select Date Add');



             if (empty($this->errors)) {

                 $bloghelp_obj->updateComment($data);

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

                $bloghelp_obj->deleteComment(array('id' => $id));

                Tools::redirectAdmin(self::$currentIndex . '&conf=1&token=' . Tools::getAdminTokenLite($this->_name_controller));
                ## delete item ##
            } else {
               return parent::postProcess(true);
            }




    }


    public function setMedia()
    {
        parent::setMedia();

        $this->context->controller->addJs(__PS_BASE_URI__.'modules/'.$this->_name_module.'/views/js/admin.js');
        $this->addJqueryUi(array('ui.core','ui.widget','ui.datepicker'));

        $this->context->controller->addCSS(__PS_BASE_URI__.'modules/'.$this->_name_module.'/views/css/custom_menu.css');

    }


    public function renderForm()
    {
        if (!($this->loadObject(true)))
            return;

        if (Validate::isLoadedObject($this->object)) {
            $this->display = 'update';
        }


        $id = (int)Tools::getValue('id');

        require_once(_PS_MODULE_DIR_ . ''.$this->_name_module.'/classes/blog.class.php');
        $obj_blog = new blog();

        if($id) {

            $_data = $obj_blog->getCommentItem(array('id'=>$id));
            $time_add = $_data['comments'][0]['time_add'];

            $id_lang = $_data['comments'][0]['id_lang'];
            $data_lng = Language::getLanguage($id_lang);
            $name_lang = $data_lng['name'];
            $iso_code = $data_lng['iso_code'];


            $id_shop = $_data['comments'][0]['id_shop'];

            $shops = Shop::getShops();
            $name_shop = '';
            foreach($shops as $_shop){
                 $id_shop_lists = $_shop['id_shop'];
                 if($id_shop == $id_shop_lists)
                    $name_shop = $_shop['name'];
            }

            $post_id = (int)$_data['comments'][0]['id_post'];
            $_info_cat = $obj_blog->getPostItem(array('id' => $post_id));
            $seo_url = isset($_info_cat['post']['data'][1]['seo_url'])?$_info_cat['post']['data'][1]['seo_url']:'';
            $img = isset($_info_cat['post']['data'][1]['img'])?$_info_cat['post']['data'][1]['img']:'';

            // is cloud ?? //
            if(defined('_PS_HOST_MODE_')){
                $logo_img_path = '../modules/'.$this->_name_module.'/upload/';
            } else {
                $logo_img_path = '../upload/'.$this->_name_module.'/';
            }
            // is cloud ?? //
            if(Configuration::get($this->_name_module.'urlrewrite_on')){
                $is_rewrite = 1;
            } else {
                $is_rewrite = 0;
            }

        }



        if($id){
            $title_item_form = $this->l('Edit comment:');
        }



        $all_laguages = Language::getLanguages(true);

        $this->fields_form = array(
            'tinymce' => TRUE,
            'legend' => array(
                'title' => $title_item_form,
                //'icon' => 'fa fa-list fa-lg'
            ),
            'input' => array(

                array(
                    'type' => 'language_item',
                    'label' => $this->l('ID'),
                    'name' => 'language_item',
                    'values'=> $id,

                ),

                array(
                    'type' => 'language_item',
                    'label' => $this->l('Language'),
                    'name' => 'language_item',
                    'values'=> $name_lang,

                ),

                array(
                    'type' => 'shop_item',
                    'label' => $this->l('Shop'),
                    'name' => 'shop_item',
                    'values'=> $name_shop,

                ),

                array(
                    'type' => 'item_url',
                    'label' => $this->l('Post URL'),

                    'name' => 'item_url',
                    'is_rewrite' => $is_rewrite,
                    'iso_code' => count($all_laguages)>1?$iso_code."/":"",
                    'base_dir_ssl' => _PS_BASE_URL_SSL_.__PS_BASE_URI__,
                    'logo_img_path' => $logo_img_path,
                    'seo_url' => $seo_url,
                    'img'=>$img,
                    'id_shop' => $id_shop,
                    'id_lang'=>$id_lang,
                    'post_id' =>$post_id,


                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Customer Name'),
                    'name' => 'comments_name',
                    'id' => 'comments_name',
                    'lang' => FALSE,
                    'required' => TRUE,
                    'size' => 5000,
                    'maxlength' => 5000,
                ),

                array(
                    'type' => 'text',
                    'label' => $this->l('Customer Email'),
                    'name' => 'comments_email',
                    'id' => 'comments_email',
                    'lang' => FALSE,
                    'required' => TRUE,
                    'size' => 5000,
                    'maxlength' => 5000,
                ),


                array(
                    'type' => 'textarea',
                    'label' => $this->l('Comment'),
                    'name' => 'comments_comment',
                    'id' => 'comments_comment',
                    'required' => true,
                    'autoload_rte' => FALSE,
                    'lang' => FALSE,
                    'rows' => 8,
                    'cols' => 40,

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
                    'name' => 'comments_status',
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




        $this->fields_form['submit'] = array(
            'title' => ($id)?$this->l('Update'):$this->l('Save'),
        );




        if($id) {

            $this->tpl_form_vars = array(
               'fields_value' => $this->getConfigFieldsValuesForm(array('id'=>$id)),
            );

            $this->submit_action = 'update_item';
        }



        return parent::renderForm();
    }



    public function getConfigFieldsValuesForm($data_in){



        $id = (int)Tools::getValue('id');
        if($id) {
            $id = $data_in['id'];
            require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/classes/blog.class.php');
            $obj_blog = new blog();
            $_data = $obj_blog->getCommentItem(array('id'=>$id));


            $name = $_data['comments'][0]['name'];
            $email = $_data['comments'][0]['email'];
            $comment = $_data['comments'][0]['comment'];
            $status = $_data['comments'][0]['status'];

           $config_array = array(
                'comments_name' => $name,
                'comments_email' => $email,
                'comments_comment' => $comment,
                'comments_status' => $status,
            );
        } else {
            $config_array = array();
        }
        return $config_array;
    }


	
}





?>

