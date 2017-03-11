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
require_once(_PS_MODULE_DIR_ . 'blockblog/classes/BlockblogcategoriesItems.php');

class AdminBlockblogcategoriesController extends ModuleAdminController{

    private $_name_controller = 'AdminBlockblogcategories';
    private $_name_module = 'blockblog';
    private $_data_table = 'blog_category_data';
    private  $_id_lang;
    private  $_id_shop;
    private  $_iso_code;

    public function __construct()

	{

            $this->bootstrap = true;
            $this->context = Context::getContext();
            $this->table = 'blog_category';


            $this->identifier = 'id';
            $this->className = 'BlockblogcategoriesItems';


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

            $this->_select .= 'a.id, c.title, a.time_add , c.seo_url, c.id_lang, '.$id_shop.' as id_shop, a.status ';
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

            $this->_select .= ', (select count(*) as count from `'._DB_PREFIX_.'blog_post` pc1
				    LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
				    ON(pc1.id = c2p.post_id)
				    LEFT JOIN `'._DB_PREFIX_.'blog_post_data` bpd
				    ON(bpd.id_item = pc1.id)
					WHERE c2p.category_id = a.id AND bpd.id_lang = '.(int)$id_lang.'
					AND pc1.status = 1 AND FIND_IN_SET('.$id_shop.',pc1.ids_shops)) as count_posts ';



            $this->addRowAction('edit');
            $this->addRowAction('delete');
            //$this->addRowAction('view');
            //$this->addRowAction('&nbsp;');


            if(Configuration::get($this->_name_module.'urlrewrite_on')){
              $is_rewrite = 1;
            } else {
               $is_rewrite = 0;
            }

            $all_laguages = Language::getLanguages(true);

            $this->fields_list = array(
                'id' => array(
                    'title' => $this->l('ID'),
                    'align' => 'center',
                    'search' => true,
                    'orderby' => true,

                ),

                'title' => array(
                    'title' => $this->l('Title'),
                    'width' => 'auto',
                    'orderby' => true,
                    'type_custom' => 'title_category',
                    'is_rewrite' => $is_rewrite,
                    'iso_code' => count($all_laguages)>1?$this->_iso_code."/":"",
                    'base_dir_ssl' => _PS_BASE_URL_SSL_.__PS_BASE_URI__,

                ),

                'count_posts' => array(
                    'title' => $this->l('Count posts'),
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
                'href' => self::$currentIndex.'&addblog_category&token='.$this->token,
                'desc' => $this->l('Add new category', null, null, false),
                'icon' => 'process-icon-new'
            );
        }

        parent::initPageHeaderToolbar();
    }

    public function initToolbar() {

        parent::initToolbar();
        /*$this->toolbar_btn['add_item'] = array(
                                            'href' => self::$currentIndex.'&add'.$this->_name_module.'&token='.$this->token,
                                            'desc' => $this->l('Add new category', null, null, false),
                                        );
        *///unset($this->toolbar_btn['new']);

    }



    public function postProcess()
    {


        require_once(_PS_MODULE_DIR_ . '' . $this->_name_module . '/classes/blog.class.php');
        $bloghelp_obj = new blog();


        if (Tools::isSubmit('add_item')) {
            ## add item ##
            $time_add = Tools::getValue("time_add");
            $seo_url = Tools::getValue("seo_url");
            $languages = Language::getLanguages(false);
            $data_title_content_lang = array();
            $data_validation = array();

            $cat_shop_association = Tools::getValue("cat_shop_association");



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
                    $data_validation[$id_lang] = array('category_title' => $category_title,);
                }
            }

            $data = array( 'data_title_content_lang'=>$data_title_content_lang,
                           'cat_shop_association' => $cat_shop_association,
                            'time_add' => $time_add,
            );






            if(sizeof($data_validation)==0)
                $this->errors[] = Tools::displayError('Please fill the Title');

            if(!($cat_shop_association))
                $this->errors[] = Tools::displayError('Please select the Shop');
            if(!$time_add)
                $this->errors[] = Tools::displayError('Please select Date Add');


            if (empty($this->errors)) {



                $bloghelp_obj->saveCategory($data);

                Tools::redirectAdmin(self::$currentIndex . '&conf=3&token=' . Tools::getAdminTokenLite($this->_name_controller));
            } else {
                $this->display = 'add';
                return FALSE;
             }
            ## add item ##

        } elseif(Tools::isSubmit('update_item')) {
                $id = Tools::getValue('id');
                ## update item ##
                $time_add = Tools::getValue("time_add");
                $seo_url = Tools::getValue("seo_url");
                $cat_shop_association = Tools::getValue("cat_shop_association");

                $languages = Language::getLanguages(false);
                $data_title_content_lang = array();
                $data_validation = array();

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
                        $data_validation[$id_lang] = array('category_title' => $category_title,);
                    }
                }

                $status = Tools::getValue('status');

                $data = array('data_title_content_lang'=>$data_title_content_lang,
                              'id_editcategory' => $id,
                              'cat_shop_association' => $cat_shop_association,
                              'status' => $status,
                              'time_add' => $time_add,
                );





                if(sizeof($data_validation)==0)
                    $this->errors[] = Tools::displayError('Please fill the Title');

                if(!($cat_shop_association))
                    $this->errors[] = Tools::displayError('Please select the Shop');
                if(!$time_add)
                    $this->errors[] = Tools::displayError('Please select Date Add');



             if (empty($this->errors)) {

                 $bloghelp_obj->updateCategory($data);

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

        if($id) {

            $_data = $obj_blog->getCategoryItem(array('id'=>$id,'admin'=>1));

            $id_shop = isset($_data['category'][0]['ids_shops']) ? explode(",",$_data['category'][0]['ids_shops']) : array();
            $time_add = isset($_data['category'][0]['time_add']) ? $_data['category'][0]['time_add'] :'' ;



        } else {

            $id_shop = array();
            $time_add = date("Y-m-d H:i:s");

        }



        if($id){
            $title_item_form = $this->l('Edit category:');
        } else{
            $title_item_form = $this->l('Add new category:');
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
                    'name' => 'category_title',
                    'id' => 'category_title',
                    'lang' => true,
                    'required' => TRUE,
                    'size' => 5000,
                    'maxlength' => 5000,
                ),



                array(
                    'type' => 'textarea',
                    'label' => $this->l('SEO Keywords'),
                    'name' => 'category_seokeywords',
                    'id' => 'category_seokeywords',
                    'required' => FALSE,
                    'autoload_rte' => FALSE,
                    'lang' => TRUE,
                    'rows' => 8,
                    'cols' => 40,

                ),

                array(
                    'type' => 'textarea',
                    'label' => $this->l('SEO Description'),
                    'name' => 'category_seodescription',
                    'id' => 'category_seodescription',
                    'required' => FALSE,
                    'autoload_rte' => FALSE,
                    'lang' => TRUE,
                    'rows' => 8,
                    'cols' => 40,

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
                    'type' => 'item_date',
                    'label' => $this->l('Date Add'),
                    'name' => 'date_on',
                    'time_add' => $time_add,
                    'required' => TRUE,
                ),

                array(
                    'type' => 'switch',
                    'label' => $this->l('Status'),
                    'name' => 'status',
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
                    'desc' => $this->l('You can leave the field blank - then Identifier (SEO URL) is generated automatically!').' (eg: http://domain.com/blog/category/identifier)',



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
            $_data = $obj_blog->getCategoryItem(array('id'=>$id,'admin'=>1));


            $languages = Language::getLanguages(false);
            $fields_title = array();
            $fields_seo_keywords = array();
            $fields_seo_description = array();

            foreach ($languages as $lang)
            {
                $fields_title[$lang['id_lang']] = isset($_data['category']['data'][$lang['id_lang']]['title'])?$_data['category']['data'][$lang['id_lang']]['title']:'';

                $fields_seo_keywords[$lang['id_lang']] = isset($_data['category']['data'][$lang['id_lang']]['seo_keywords'])?$_data['category']['data'][$lang['id_lang']]['seo_keywords']:'';

                $fields_seo_description[$lang['id_lang']] = isset($_data['category']['data'][$lang['id_lang']]['seo_description'])?$_data['category']['data'][$lang['id_lang']]['seo_description']:'';
            }

            $seo_url = isset($_data['category']['data'][$this->_id_lang]['seo_url'])?$_data['category']['data'][$this->_id_lang]['seo_url']:"";
            $status = isset($_data['category'][0]['status'])?$_data['category'][0]['status']:"";


            $config_array = array(
                'category_title' => $fields_title,
                'seo_url' => $seo_url,
                'category_seokeywords' => $fields_seo_keywords,
                'category_seodescription' => $fields_seo_description,
                'status' => $status,
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

