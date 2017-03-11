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

class blog extends Module{
	
	private $_width = 1000;
	private $_height = 1000;
	private $_name = 'blockblog';
	private $_id_shop;
	private $_is15;
	private $_is_rewriting_settings;
	private $_lang_iso;
	private $_http_host;
	
	private $_is_cloud;
	private $path_img_cloud;
	
	public function __construct(){
		if(version_compare(_PS_VERSION_, '1.5', '>')){
			$this->_id_shop = Context::getContext()->shop->id;
			$this->_is15 = 1;
		
		} else {
			$this->_id_shop = 1;
			$this->_is15 = 0;
		}
		
		if (defined('_PS_HOST_MODE_'))
			$this->_is_cloud = 1;
		else
			$this->_is_cloud = 0;
		
		
		
		
		// for test
		//$this->_is_cloud = 1;
		// for test
		
		
		if($this->_is_cloud){
			$this->path_img_cloud = DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR;
		} else {
			$this->path_img_cloud = DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR.$this->_name.DIRECTORY_SEPARATOR;
			
		}
		
		if(version_compare(_PS_VERSION_, '1.6', '>')){
			$this->_http_host = Tools::getShopDomainSsl(true, true).__PS_BASE_URI__; 
		} else {
			$this->_http_host = _PS_BASE_URL_.__PS_BASE_URI__;
		}
		
		if (version_compare(_PS_VERSION_, '1.5', '<')){
			require_once(_PS_MODULE_DIR_.$this->_name.'/backward_compatibility/backward.php');
		}
		
		$this->initContext();
	}
	
	private function initContext()
	{
		$this->context = Context::getContext();
	}
	
	public function saveCategory($data){
		
		
		$ids_shops = implode(",",$data['cat_shop_association']);
        $time_add = $data['time_add'];
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_category` SET
							   `ids_shops` = "'.pSQL($ids_shops).'",
							    time_add = "'.pSQL($time_add).'"
							   ';
		
		Db::getInstance()->Execute($sql);
		
		$post_id = Db::getInstance()->Insert_ID();
		
		foreach($data['data_title_content_lang'] as $language => $item){
		
		$category_title = $item['category_title'];
		$category_seokeywords = $item['category_seokeywords'];
		$category_seodescription = $item['category_seodescription'];
		
		$seo_url_pre = Tools::strlen($item['seo_url'])>0?$item['seo_url']:$category_title;
	    $seo_url = $this->_translit($seo_url_pre);
		
	   
	    $sql = 'SELECT count(*) as count
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE seo_url = "'.pSQL($seo_url,true).'" AND id_lang = '.(int)$language;
		$data_seo_url = Db::getInstance()->GetRow($sql);
		
		if($data_seo_url['count'] != 0)
			$seo_url = $seo_url."-".Tools::strtolower(Tools::passwdGen(6));
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_category_data` SET
							   `id_item` = \''.(int)($post_id).'\',
							   `id_lang` = \''.(int)($language).'\',
							   `title` = \''.pSQL($category_title).'\',
							   `seo_keywords` = \''.pSQL($category_seokeywords).'\',
							   `seo_description` = \''.pSQL($category_seodescription).'\',
							   `seo_url` = \''.pSQL($seo_url).'\'
							   ';
		
		Db::getInstance()->Execute($sql);
		
		}
		
		
	}
	
	public function updateCategory($data){
		
		$id = (int)$data['id_editcategory'];
        $status = (int)$data['status'];
		
		$ids_shops = implode(",",$data['cat_shop_association']);
        $time_add = $data['time_add'];
		
		$sql_update = 'UPDATE `'._DB_PREFIX_.'blog_category` SET 
						`ids_shops` = "'.pSQL($ids_shops).'", `time_add` = "'.pSQL($time_add).'", status = '.$status.'
						WHERE id ='.(int)$id;
		Db::getInstance()->Execute($sql_update);
		
		/// delete tabs data
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category_data` WHERE id_item = '.(int)$id.'';
		Db::getInstance()->Execute($sql);
		
		foreach($data['data_title_content_lang'] as $language => $item){
		
		$category_title = $item['category_title'];
		$category_seokeywords = $item['category_seokeywords'];
		$category_seodescription = $item['category_seodescription'];
		
		$seo_url_pre = Tools::strlen($item['seo_url'])>0?$item['seo_url']:$category_title;
	    $seo_url = $this->_translit($seo_url_pre);
		
		$sql = 'SELECT count(*) as count
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE seo_url = "'.pSQL($seo_url,true).'" AND id_lang = '.(int)$language;
		$data_seo_url = Db::getInstance()->GetRow($sql);
		
		if($data_seo_url['count'] != 0)
			$seo_url = $seo_url."-".Tools::strtolower(Tools::passwdGen(6));
			
			
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_category_data` SET
							   `id_item` = \''.(int)($id).'\',
							   `id_lang` = \''.(int)($language).'\',
							   `title` = \''.pSQL($category_title).'\',
							   `seo_keywords` = \''.pSQL($category_seokeywords).'\',
							   `seo_description` = \''.pSQL($category_seodescription).'\',
							   `seo_url` = \''.pSQL($seo_url).'\'
							   
							   ';
		Db::getInstance()->Execute($sql);
		
		}
		
	}



    public function updateCategoryStatus($data){

        $id = (int)$data['id'];
        $status = (int)$data['status'];

        $sql_update = 'UPDATE `'._DB_PREFIX_.'blog_category` SET
						`status` = '.$status.'
						WHERE id ='.(int)$id;
        Db::getInstance()->Execute($sql_update);



    }


    public function updatePostStatus($data){

        $id = (int)$data['id'];
        $status = (int)$data['status'];

        $sql_update = 'UPDATE `'._DB_PREFIX_.'blog_post` SET
						`status` = '.$status.'
						WHERE id ='.(int)$id;
        Db::getInstance()->Execute($sql_update);



    }

    public function updateCommentStatus($data){

        $id = (int)$data['id'];
        $status = (int)$data['status'];

        $sql_update = 'UPDATE `'._DB_PREFIX_.'blog_comments` SET
						`status` = '.$status.'
						WHERE id ='.(int)$id;
        Db::getInstance()->Execute($sql_update);



    }
	
	
private function  _translit( $str )
	{
    $str  = str_replace(array("®","'",'"','`','?','!','.','=',':','&','+',',','’', ')', '(', '$', '{', '}'), array(''), $str );
		
	$arrru = array ("А","а","Б","б","В","в","Г","г","Д","д","Е","е","Ё","ё","Ж","ж","З","з","И","и","Й","й","К","к","Л","л","М","м","Н","н", "О","о","П","п","Р","р","С","с","Т","т","У","у","Ф","ф","Х","х","Ц","ц","Ч","ч","Ш","ш","Щ","щ","Ъ","ъ","Ы","ы","Ь", "ь","Э","э","Ю","ю","Я","я",
    " ","-",",","«","»","+","/","(",")",".");

    $arren = array ("a","a","b","b","v","v","g","g","d","d","e","e","e","e","zh","zh","z","z","i","i","y","y","k","k","l","l","m","m","n","n", "o","o","p","p","r","r","s","s","t","t","u","u","ph","f","h","h","c","c","ch","ch","sh","sh","sh","sh","","","i","i","","","e", "e","yu","yu","ya","ya",
    "-","-","","","","","","","","");

	$textout = '';
    $textout = str_replace($arrru,$arren,$str);
    
    $textout = str_replace("--","-",$textout);
    
    $separator = "-";
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array( '&' => 'and');
    $textout = mb_strtolower( trim( $textout ), 'UTF-8' );
    $textout = str_replace( array_keys($special_cases), array_values( $special_cases), $textout );
    $textout = preg_replace( $accents_regex, '$1', htmlentities( $textout, ENT_QUOTES, 'UTF-8' ) );
    $textout = preg_replace("/[^a-z0-9]/u", "$separator", $textout);
    $textout = preg_replace("/[$separator]+/u", "$separator", $textout);
    
    if(Tools::strlen($textout)==0)
    	$textout = Tools::strtolower(Tools::passwdGen(6));
    	
     return Tools::strtolower($textout);
	}
	
	public function deleteCategory($data){
		
		$id = $data['id'];
		
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category`
							   WHERE id ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
		
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category_data`
							   WHERE id_item ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
		
		// get all posts_id for category //
		$sql = '
			SELECT post_id 
			FROM  `'._DB_PREFIX_.'blog_category2post` c2p
			WHERE c2p.category_id = '.$id.'';
		$posts_ids = Db::getInstance()->ExecuteS($sql);
		
		// delete post_id x category_id
		$tmp_array_posts_ids = array();
		foreach($posts_ids as $_item){
				$id_post = $_item['post_id'];
				$tmp_array_posts_ids[] = $id_post;
				
					$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category2post`
								   WHERE post_id = '.(int)$id_post.' AND 
								   category_id = '.(int)$id.'';
					
				    Db::getInstance()->Execute($sql);
		}

		// delete empty posts
		foreach($tmp_array_posts_ids as $item){
			$data_count = Db::getInstance()->getRow('
			SELECT COUNT(*) AS "count"
			FROM `'._DB_PREFIX_.'blog_category2post` c2p
			WHERE c2p.post_id = '.(int)$item.' 
			');
			
			if($data_count['count'] == 0){
				$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_post`
							   WHERE id ='.(int)$item.'';
				Db::getInstance()->Execute($sql);
					
				$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_post_data`
							   WHERE id_item ='.(int)$item.'';
				Db::getInstance()->Execute($sql);
				
			}
		}
		
	}
	
	public function getTransformSEOURLtoID($_data){
		
	if(Configuration::get($this->_name.'urlrewrite_on') == 1 && !is_numeric($_data['id'])){
			$id = $_data['id'];
			$sql = '
					SELECT pc.id_item as id
					FROM `'._DB_PREFIX_.'blog_category_data` pc
					WHERE seo_url = "'.pSQL($id).'"';
			$data_id = Db::getInstance()->GetRow($sql);
			$id = $data_id['id'];
		} else {
			$id = (int)$_data['id'];
		}
		
		return $id;
	}
	
	public function getSEOURLForCategory($_data){
		
			$id = $_data['id'];
			$sql = '
					SELECT pc.seo_url
					FROM `'._DB_PREFIX_.'blog_category_data` pc
					WHERE id_item = "'.pSQL($id).'"';
			$data_id = Db::getInstance()->GetRow($sql);
			$id = $data_id['seo_url'];
		return $id;
	}
	
	public function getTransformSEOURLtoIDPost($_data){
		//var_dump(is_numeric($_data['id']));
	if(Configuration::get($this->_name.'urlrewrite_on') == 1 && !is_numeric($_data['id'])){
			$id = $_data['id'];
			$sql = '
					SELECT pc.id_item as id
					FROM `'._DB_PREFIX_.'blog_post_data` pc
					WHERE seo_url = "'.pSQL($id).'"';
			$data_id = Db::getInstance()->GetRow($sql);
			$id = $data_id['id'];
		} else {
			$id = (int)$_data['id'];
		}
		
		return $id;
	}
	
	public function getSEOURLForPost($_data){
			$id = $_data['id'];
			$sql = '
					SELECT pc.seo_url
					FROM `'._DB_PREFIX_.'blog_post_data` pc
					WHERE id_item = "'.pSQL($id).'"';
			$data_id = Db::getInstance()->GetRow($sql);
			$id = $data_id['seo_url'];
		
		return $id;
	}
	
	public function getIdPostifFriendlyURLEnable($data){
			$seo_url = $data['seo_url'];
		    $id_lang = $data['id_lang'];
			$sql = '
					SELECT pc.id_item as id_post
					FROM `'._DB_PREFIX_.'blog_post_data` pc
					WHERE pc.seo_url = "'.pSQL($seo_url).'" and pc.id_lang = '.(int)$id_lang;
			//echo $sql;
			$data_id = Db::getInstance()->GetRow($sql);
			$id_post = $data_id['id_post'];
			
			return $id_post;
	}
	
	public function getSEOFriendlyURLifFriendlyURLEnable($data){
			$id_post = $data['id_post'];
		    $id_lang = $data['id_lang'];
			$sql = '
					SELECT pc.seo_url
					FROM `'._DB_PREFIX_.'blog_post_data` pc
					WHERE pc.id_item = "'.(int)$id_post.'" and pc.id_lang = '.(int)$id_lang;
			//echo $sql;exit;
			$data_id = Db::getInstance()->GetRow($sql);
			$seo_url = $data_id['seo_url'];
			
			return $seo_url;
	}
	
public function getIdCatifFriendlyURLEnable($data){
			$seo_url = $data['seo_url'];
		    $id_lang = $data['id_lang'];
			$sql = '
					SELECT pc.id_item as id_cat
					FROM `'._DB_PREFIX_.'blog_category_data` pc
					WHERE pc.seo_url = "'.pSQL($seo_url).'" and pc.id_lang = '.(int)$id_lang;
			//echo $sql;
			$data_id = Db::getInstance()->GetRow($sql);
			$id_post = $data_id['id_cat'];
			
			return $id_post;
	}
	
	public function getSEOFriendlyURLifFriendlyURLEnableCat($data){
			$id_post = $data['id_cat'];
		    $id_lang = $data['id_lang'];
			$sql = '
					SELECT pc.seo_url
					FROM `'._DB_PREFIX_.'blog_category_data` pc
					WHERE pc.id_item = "'.(int)$id_post.'" and pc.id_lang = '.(int)$id_lang;
			//echo $sql;exit;
			$data_id = Db::getInstance()->GetRow($sql);
			$seo_url = $data_id['seo_url'];
			
			return $seo_url;
	}
	
	public function getCategoryItem($_data){
		$id = $_data['id'];
		$admin = isset($_data['admin'])?$_data['admin']:0;
		
		if($admin == 1){
				$sql = '
					SELECT pc.*
					FROM `'._DB_PREFIX_.'blog_category` pc
					WHERE id = '.(int)$id;
			$item = Db::getInstance()->ExecuteS($sql);
			
			foreach($item as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    			$item['data'][$item_data['id_lang']]['title'] = $item_data['title'];
		    			$item['data'][$item_data['id_lang']]['seo_description'] = $item_data['seo_description'];
		    			$item['data'][$item_data['id_lang']]['seo_keywords'] = $item_data['seo_keywords'];
		    			$item['data'][$item_data['id_lang']]['seo_url'] = $item_data['seo_url'];
                        $item['data'][$item_data['id_lang']]['time_add'] = $_item['time_add'];
                         $item['data'][$item_data['id_lang']]['status'] = $_item['status'];
		    	}
		    	
			}
		} else {
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
				$sql = '
					SELECT pc.*
					FROM `'._DB_PREFIX_.'blog_category` pc
					LEFT JOIN `'._DB_PREFIX_.'blog_category_data` pc1
					ON(pc1.id_item = pc.id)
					WHERE pc.`id` = '.(int)$id.' AND pc1.id_lang = '.(int)$current_language;
			
			$item = Db::getInstance()->ExecuteS($sql);
			
			foreach($item as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$item[$k]['title'] = $item_data['title'];
		    			$item[$k]['seo_description'] = $item_data['seo_description'];
		    			$item[$k]['seo_keywords'] = $item_data['seo_keywords'];
		    			$item[$k]['seo_url'] = $item_data['seo_url'];
		    			
		    		}
		    	}
		    }
			
		}
		//var_dump($item);
	   return array('category' => $item);
	}
	
public function getCategories($_data){
		$admin = isset($_data['admin'])?$_data['admin']:null;
		$items = array();
		if($admin){
			$start = isset($_data['start'])?$_data['start']:'';
			$step = isset($_data['step'])?$_data['step']:'';
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
			if(Tools::strlen($start)>0 && Tools::strlen($step)>0){
				$sql = '
				SELECT pc.*,
				(select count(*) as count from `'._DB_PREFIX_.'blog_post` pc1 
				    LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
				    ON(pc1.id = c2p.post_id)
				    WHERE c2p.category_id = pc.id ) as count_posts
				FROM `'._DB_PREFIX_.'blog_category` pc
				ORDER BY pc.`time_add` DESC LIMIT '.$start.' ,'.$step.'';
			//	echo $sql;
			} else {
				$sql = '
				SELECT pc.*,
				(select count(*) as count from `'._DB_PREFIX_.'blog_post` pc1 
				    LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
				    ON(pc1.id = c2p.post_id)
				    WHERE c2p.category_id = pc.id ) as count_posts
				FROM `'._DB_PREFIX_.'blog_category` pc
				ORDER BY pc.`time_add` DESC';
			}
			$categories = Db::getInstance()->ExecuteS($sql);
			
			
			foreach($categories as $k => $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				
				$cookie = $this->context->cookie;
				$defaultLanguage =  $cookie->id_lang;
				
				$tmp_title = '';
				$tmp_id = '';
				$tmp_time_add = '';

				// languages
				$languages_tmp_array = array();
				
				foreach ($items_data as $item_data){
					$languages_tmp_array[] = $item_data['id_lang'];
		    		
		    		$title = isset($item_data['title'])?$item_data['title']:'';
		    		$id = isset($item_data['id_item'])?$item_data['id_item']:'';
		    		$time_add = isset($categories[$k]['time_add'])?$categories[$k]['time_add']:'';
		    		
		    		if(Tools::strlen($tmp_title)==0){
		    			if(Tools::strlen($title)>0)
		    					$tmp_title = $title; 
		    		}
		    		
					if(Tools::strlen($tmp_id)==0){
		    			if(Tools::strlen($id)>0)
		    					$tmp_id = $id; 
		    		}
		    		
					if(Tools::strlen($tmp_time_add)==0){
		    			if(Tools::strlen($time_add)>0)
		    					$tmp_time_add = $time_add; 
		    		}
		    		
		    		if($defaultLanguage == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    			$items[$k]['id'] = $id;
		    			$items[$k]['time_add'] = $time_add;
		    		}
		    		
		    	}
		    	
		    	if(@Tools::strlen($items[$k]['title'])==0)
		    		$items[$k]['title'] = $tmp_title;
		    		
		    	if(@Tools::strlen($items[$k]['id'])==0)
		    		$items[$k]['id'] = $tmp_id;
		    		
		    	if(@Tools::strlen($items[$k]['time_add'])==0)
		    		$items[$k]['time_add'] = $tmp_time_add;
		    	
		    	$items[$k]['count_posts'] = $categories[$k]['count_posts'];
		    	
		    	// languages
		    	$items[$k]['ids_lng'] = $languages_tmp_array;

                $lang_for_category = array();
                foreach($languages_tmp_array as $lng_id){
                    $data_lng = Language::getLanguage($lng_id);
                    $lang_for_category[] = $data_lng['iso_code'];
                }
                $lang_for_category = implode(",",$lang_for_category);

                $items[$k]['iso_lang'] = $lang_for_category;

                $items[$k]['status'] = $_item['status'];
			}
			
			$data_count_categories = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_category` 
			');
			
		} else{
			
			$start = $_data['start'];
			$step = (int)$_data['step'];
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$items_tmp = Db::getInstance()->ExecuteS('
			SELECT pc.*,
				   (select count(*) as count from `'._DB_PREFIX_.'blog_post` pc1 
				    LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
				    ON(pc1.id = c2p.post_id)
				    LEFT JOIN `'._DB_PREFIX_.'blog_post_data` bpd
				    ON(bpd.id_item = pc1.id)
					WHERE c2p.category_id = pc.id AND bpd.id_lang = '.(int)$current_language.'
					AND pc1.status = 1 AND FIND_IN_SET('.$this->_id_shop.',pc1.ids_shops)) as count_posts
			FROM `'._DB_PREFIX_.'blog_category` pc
			LEFT JOIN `'._DB_PREFIX_.'blog_category_data` pc_d
			on(pc.id = pc_d.id_item)
			WHERE pc_d.id_lang = '.(int)$current_language.'  AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			ORDER BY pc.`time_add` DESC LIMIT '.(int)$start.' ,'.(int)$step.'');	
			
			$items = array();
			
			foreach($items_tmp as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				
				
				foreach ($items_data as $item_data){
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    			$items[$k]['seo_description'] = $item_data['seo_description'];
		    			$items[$k]['seo_keywords'] = $item_data['seo_keywords'];
		    			$items[$k]['count_posts'] = $_item['count_posts'];
		    			$items[$k]['id'] = $_item['id'];
		    			$items[$k]['time_add'] = $_item['time_add'];
		    			$items[$k]['seo_url'] = $item_data['seo_url'];
		    		} 
		    	}
		    }
			
			$data_count_categories = Db::getInstance()->getRow('
			SELECT COUNT(pc.`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_category` pc LEFT JOIN `'._DB_PREFIX_.'blog_category_data` pc_d
			on(pc.id = pc_d.id_item)
			WHERE pc_d.id_lang = '.(int)$current_language.'  AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			');
		}	
		return array('categories' => $items, 'count_all' => $data_count_categories['count'] );
	}
	
	public function  getPosts($_data){
		$admin = isset($_data['admin'])?$_data['admin']:null;
		
		$id = isset($_data['id'])?$_data['id']:0;
		
		if($admin == 1){
			$sql = '
			SELECT pc.*,
			(select count(*) as count from `'._DB_PREFIX_.'blog_comments` pc1 
				    WHERE pc1.id_post = pc.id and pc1.status=1) as count_comments,
			(select count(*) as count from `'._DB_PREFIX_.'blog_post_like` pclike
				    WHERE pclike.post_id = pc.id) as count_likes
			FROM `'._DB_PREFIX_.'blog_post` pc LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
			ON(pc.id = c2p.post_id)
			WHERE c2p.category_id = '.(int)$id.' 
			ORDER BY pc.`time_add` DESC';
            $items = Db::getInstance()->ExecuteS($sql);
			
			foreach($items as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				$cookie = $this->context->cookie;
				$defaultLanguage =  $cookie->id_lang;
				
				$tmp_title = '';
				
				// languages
				$languages_tmp_array = array();
				
				foreach ($items_data as $item_data){
					$languages_tmp_array[] = $item_data['id_lang'];
					
		    		$title = isset($item_data['title'])?$item_data['title']:'';
		    		if(Tools::strlen($tmp_title)==0){
		    			if(Tools::strlen($title)>0)
		    					$tmp_title = $title; 
		    		}
		    		
		    		if($defaultLanguage == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    		} 
		    		
		    	}
		    	
		    	// languages
		    	$items[$k]['ids_lng'] = $languages_tmp_array;
		    	
		    	if(@Tools::strlen($items[$k]['title'])==0)
		    		$items[$k]['title'] = $tmp_title;
		    	
				}
			
			
			$data_count_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post`  as pc LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
			ON(pc.id = c2p.post_id)
			WHERE c2p.category_id = '.(int)$id.'
			');
			
		} elseif($admin == 2){
			$start = $_data['start'];
			$step = $_data['step'];
			$sql = '
			SELECT pc.*,
			(select count(*) as count from `'._DB_PREFIX_.'blog_comments` pc1
				    WHERE pc1.id_post = pc.id and pc1.status=1) as count_comments,
			(select count(*) as count from `'._DB_PREFIX_.'blog_post_like` pclike
				    WHERE pclike.post_id = pc.id) as count_likes
			FROM `'._DB_PREFIX_.'blog_post` pc
			ORDER BY pc.`time_add` DESC  LIMIT '.(int)$start.' ,'.(int)$step.'';
            $items = Db::getInstance()->ExecuteS($sql);
			
			
			foreach($items as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				$cookie = $this->context->cookie;
				$defaultLanguage =  $cookie->id_lang;
				
				$tmp_title = '';
				// languages
				$languages_tmp_array = array();
				
				
				foreach ($items_data as $item_data){
		    		$languages_tmp_array[] = $item_data['id_lang'];
					
		    		$title = isset($item_data['title'])?$item_data['title']:'';
		    		if(Tools::strlen($tmp_title)==0){
		    			if(Tools::strlen($title)>0)
		    					$tmp_title = $title; 
		    		}
		    		
		    		
		    		if($defaultLanguage == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    		} 
		    	}
		    	
		    	if(@Tools::strlen($items[$k]['title'])==0)
		    		$items[$k]['title'] = $tmp_title;
		    		
		    	// languages
		    	$items[$k]['ids_lng'] = $languages_tmp_array;
		    	
		    	
				}
			
			$data_count_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post`  as pc
			');
		} else{
			$start = $_data['start'];
			$step = $_data['step'];
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
			$sql = '
			SELECT pc.* ,
				(select count(*) as count from `'._DB_PREFIX_.'blog_comments` c2pc 
				 where c2pc.id_post = pc.id and c2pc.status = 1 and c2pc.id_shop = '.(int)$this->_id_shop.' 
				 and c2pc.id_lang = '.(int)$current_language.' ) 
				 as count_comments,
				 (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1) as count_like,
                (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1 and ip = \''.pSQL($_SERVER['REMOTE_ADDR']).'\') as is_liked_post,
                (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pcc WHERE pcc.id_post = pc.id and pcc.status = 1 and pcc.id_lang = '.$current_language.') as count_comments

			FROM `'._DB_PREFIX_.'blog_post` pc LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
			ON(pc.id = c2p.post_id)
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			on(pc.id = pc_d.id_item)
			WHERE pc.status = 1 and pc_d.id_lang = '.(int)$current_language.' AND c2p.category_id = '.(int)$id.' 
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			ORDER BY pc.`time_add` DESC LIMIT '.(int)$start.' ,'.(int)$step.'';


			
			$items = Db::getInstance()->ExecuteS($sql);	
			
			foreach($items as $k1=>$_item){
				$id_post = $_item['id'];
				
				if(Tools::strlen($_item['img'])>0){
					$this->generateThumbImages(array('img'=>$_item['img'], 
		    												 'width'=>Configuration::get($this->_name.'lists_img_width'),
		    												 'height'=>Configuration::get($this->_name.'lists_img_width') 
		    												)
		    											);
		    		$img = Tools::substr($_item['img'],0,-4)."-".Configuration::get($this->_name.'lists_img_width')."x".Configuration::get($this->_name.'lists_img_width').".jpg";
		    	} else {
		    		$img = $_item['img'];
				}
		    		
		    	$items[$k1]['img'] = $img;
				
				$category_ids = Db::getInstance()->ExecuteS('
				SELECT pc.category_id
				FROM `'._DB_PREFIX_.'blog_category2post` pc
				WHERE pc.`post_id` = '.(int)$id_post.'');
				$data_category_ids = array();
				foreach($category_ids as $k => $v){
					$_info_ids = $this->getCategoryItem(array('id' => $v['category_id']));
					$ids_item = sizeof(@$_info_ids['category'][0])>0?$_info_ids['category'][0]:array();
					//var_dump($ids_item); echo "<br><hr><br>";
					if(sizeof($ids_item)>0){
					$data_category_ids[] = $ids_item;
					}
				}
				
				$items[$k1]['category_ids'] = $data_category_ids;
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k1]['title'] = $item_data['title'];
		    			$items[$k1]['seo_description'] = $item_data['seo_description'];
		    			$items[$k1]['seo_keywords'] = $item_data['seo_keywords'];
		    			$items[$k1]['content'] = $item_data['content'];
		    			$items[$k1]['id'] = $_item['id'];
		    			$items[$k1]['time_add'] = $_item['time_add'];
		    			$items[$k1]['seo_url'] = $item_data['seo_url'];
		    		} 
		    	}
				
			}
			
			$sql = '
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post` pc LEFT JOIN `'._DB_PREFIX_.'blog_category2post` c2p
			ON(pc.id = c2p.post_id)
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			on(pc.id = pc_d.id_item )
			WHERE c2p.category_id = '.(int)$id.' and pc_d.id_lang = '.(int)$current_language.' 
			AND pc.status = 1 AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			';
			
			$data_count_posts = Db::getInstance()->getRow($sql);
		}	
		return array('posts' => $items, 'count_all' => $data_count_posts['count'] );
	}
	
	
	public function  getAllPosts($_data){
		
			$start = $_data['start'];
			$step = $_data['step'];
			$is_search = isset($_data['is_search'])?$_data['is_search']:0;
			$search = isset($_data['search'])?$_data['search']:'';
			$is_arch = isset($_data['is_arch'])?$_data['is_arch']:0;
			$month = isset($_data['month'])?$_data['month']:0;
			$year = isset($_data['year'])?$_data['year']:0;

			$sql_condition = '';
			if($is_search == 1){
				$sql_condition = "AND (
	    		   LOWER(pc_d.title) LIKE BINARY LOWER('%".pSQL(trim($search))."%')
	    		   OR
	    		   LOWER(pc_d.content) LIKE BINARY LOWER('%".pSQL(trim($search))."%')
	    		   ) ";
			}
			
			if($is_arch == 1){
				$sql_condition = 'AND YEAR(pc.time_add) = "'.$year.'" AND
    							  MONTH(pc.time_add) = "'.$month.'"';
			}
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
			$sql = '
			SELECT pc.* ,
				(select count(*) as count from `'._DB_PREFIX_.'blog_comments` c2pc 
				 where c2pc.id_post = pc.id and c2pc.status = 1 and c2pc.id_shop = '.(int)$this->_id_shop.' 
				 and c2pc.id_lang = '.(int)$current_language.' ) 
				 as count_comments,
				 (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1) as count_like,
                (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1 and ip = \''.pSQL($_SERVER['REMOTE_ADDR']).'\') as is_liked_post,
                (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pcc WHERE pcc.id_post = pc.id and pcc.status = 1 and pcc.id_lang = '.$current_language.') as count_comments
			FROM `'._DB_PREFIX_.'blog_post` pc 
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			on(pc.id = pc_d.id_item)
			WHERE pc.status = 1 and pc_d.id_lang = '.(int)$current_language.'
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops) '.$sql_condition.'
			ORDER BY pc.`time_add` DESC LIMIT '.(int)$start.' ,'.(int)$step.'';
			
			$items = Db::getInstance()->ExecuteS($sql);	
			
			foreach($items as $k1=>$_item){
				$id_post = $_item['id'];
				
				if(Tools::strlen($_item['img'])>0){
					$this->generateThumbImages(array('img'=>$_item['img'], 
		    												 'width'=>Configuration::get($this->_name.'lists_img_width'),
		    												 'height'=>Configuration::get($this->_name.'lists_img_width') 
		    												)
		    											);
		    		$img = Tools::substr($_item['img'],0,-4)."-".Configuration::get($this->_name.'lists_img_width')."x".Configuration::get($this->_name.'lists_img_width').".jpg";
		    	} else {
		    		$img = $_item['img'];
				}
		    		
		    	$items[$k1]['img'] = $img;
				
				$category_ids = Db::getInstance()->ExecuteS('
				SELECT pc.category_id
				FROM `'._DB_PREFIX_.'blog_category2post` pc
				WHERE pc.`post_id` = '.(int)$id_post.'');
				$data_category_ids = array();
				foreach($category_ids as $v){
					$_info_ids = $this->getCategoryItem(array('id' => $v['category_id']));
					$ids_item = sizeof(@$_info_ids['category'][0])>0?$_info_ids['category'][0]:array();
					
					if(sizeof($ids_item)>0){
					$data_category_ids[] = $ids_item;
					}
				}
				
				$items[$k1]['category_ids'] = $data_category_ids;
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k1]['title'] = $item_data['title'];
		    			$items[$k1]['seo_description'] = $item_data['seo_description'];
		    			$items[$k1]['seo_keywords'] = $item_data['seo_keywords'];
		    			$items[$k1]['content'] = $item_data['content'];
		    			$items[$k1]['id'] = $_item['id'];
		    			$items[$k1]['time_add'] = $_item['time_add'];
		    			$items[$k1]['seo_url'] = $item_data['seo_url'];
		    		} 
		    	}
				
			}
			
			$sql = '
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post` pc 
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			on(pc.id = pc_d.id_item )
			WHERE  pc_d.id_lang = '.(int)$current_language.' 
			AND pc.status = 1 AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops) '.$sql_condition.'
			';
			
			$data_count_posts = Db::getInstance()->getRow($sql);
		
		return array('posts' => $items, 'count_all' => $data_count_posts['count'] );
	}
	
	
	public function savePost($data){

		$ids_shops = implode(",",$data['cat_shop_association']);
		
		$related_posts = implode(",",$data['ids_related_posts']);
		if(Tools::strlen($related_posts)==0) $related_posts = 0;
		
		$related_products = $data['related_products'];
		$related_products = explode("-",$related_products,-1);
	    $related_products = implode(",",$related_products);
		if(Tools::strlen($related_products)==0) $related_products = 0;
		
		
		$time_add = date('Y-m-d H:i:s',strtotime($data['time_add']));
		
		$ids_categories = sizeof($data['ids_categories'])>0?$data['ids_categories']:array();
		$post_status = $data['post_status'];
		$post_iscomments = $data['post_iscomments'];
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_post` SET
							   `status` = \''.(int)($post_status).'\',
							   `is_comments` = \''.(int)($post_iscomments).'\',
							   `ids_shops` = "'.pSQL($ids_shops).'",
							   `related_products` = "'.pSQL($related_products).'",
							   `related_posts` = "'.pSQL($related_posts).'",
							   `time_add` = "'.pSQL($time_add).'"
							   ';
		Db::getInstance()->Execute($sql);
		
		$post_id = Db::getInstance()->Insert_ID();
		
		foreach($data['data_title_content_lang'] as $language => $item){
		
		$post_title = $item['post_title'];
		$post_seokeywords = $item['post_seokeywords'];
		$post_seodescription = $item['post_seodescription'];
		$post_content = $item['post_content'];
		
		$seo_url_pre = Tools::strlen($item['seo_url'])>0?$item['seo_url']:$post_title;
	    $seo_url = $this->_translit($seo_url_pre);
	    
	    
	    $sql = 'SELECT count(*) as count
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE seo_url = "'.pSQL($seo_url,true).'" AND id_lang = '.(int)$language;
		$data_seo_url = Db::getInstance()->GetRow($sql);
		
		if($data_seo_url['count'] != 0)
			$seo_url = $seo_url."-".Tools::strtolower(Tools::passwdGen(6));
		
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_post_data` SET
							   `id_item` = \''.(int)($post_id).'\',
							   `id_lang` = \''.(int)($language).'\',
							   `title` = \''.pSQL($post_title).'\',
							   `seo_keywords` = \''.pSQL($post_seokeywords).'\',
							   `seo_description` = \''.pSQL($post_seodescription).'\',
							   `content` = "'.pSQL($post_content,true).'",
							   `seo_url` = "'.pSQL($seo_url).'"
							   ';
		
		
		Db::getInstance()->Execute($sql);
		
		}

        include_once(dirname(__FILE__).'/../blockblog.php');
        $obj = new blockblog();

        if($obj->is_demo == 0) {
            $this->saveImage(array('post_id' => $post_id));
        }
		
		foreach($ids_categories as $id_cat){
			$sql = 'INSERT into `'._DB_PREFIX_.'blog_category2post` SET
							   `category_id` = \''.pSQL($id_cat).'\',
							   `post_id` = \''.pSQL($post_id).'\'
							   ';
			Db::getInstance()->Execute($sql);
			
		}
		
	}
	
	public function updatePost($data){
		$ids_shops = implode(",",$data['cat_shop_association']);
		
		$related_posts = implode(",",$data['ids_related_posts']);
		if(Tools::strlen($related_posts)==0) $related_posts = 0;
		
		$related_products = $data['related_products'];
		$related_products = explode("-",$related_products,-1);
	    $related_products = implode(",",$related_products);
		if(Tools::strlen($related_products)==0) $related_products = 0;
	    
		$time_add = date('Y-m-d H:i:s',strtotime($data['time_add']));
		
		$id_editposts = $data['id_editposts'];
		
		$ids_categories = $data['ids_categories'];
		$post_status = $data['post_status'];
		$post_iscomments = $data['post_iscomments'];
		$post_images = $data['post_images'];
		
		// update
		$sql = 'UPDATE `'._DB_PREFIX_.'blog_post` SET
							  `status` = \''.(int)($post_status).'\',
							   `is_comments` = \''.(int)($post_iscomments).'\',
							   `ids_shops` = "'.pSQL($ids_shops).'",
							   `related_products` = "'.pSQL($related_products).'",
							   `related_posts` = "'.pSQL($related_posts).'",
							   `time_add` = "'.pSQL($time_add).'"
							    WHERE id = '.(int)$id_editposts.'
							   ';
	
	 	Db::getInstance()->Execute($sql);
		
		/// delete tabs data
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_post_data` WHERE id_item = '.(int)$id_editposts.'';
		Db::getInstance()->Execute($sql);
		
		foreach($data['data_title_content_lang'] as $language => $item){
		
		$post_title = $item['post_title'];
		$post_seokeywords = $item['post_seokeywords'];
		$post_seodescription = $item['post_seodescription'];
		$post_content = $item['post_content'];
		
		$seo_url_pre = Tools::strlen($item['seo_url'])>0?$item['seo_url']:$post_title;
	    $seo_url = $this->_translit($seo_url_pre);
	    
	    $sql = 'SELECT count(*) as count
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE seo_url = "'.pSQL($seo_url,true).'" AND id_lang = '.(int)$language;
		$data_seo_url = Db::getInstance()->GetRow($sql);
		
		if($data_seo_url['count'] != 0)
			$seo_url = $seo_url."-".Tools::strtolower(Tools::passwdGen(6));
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_post_data` SET
							   `id_item` = \''.(int)($id_editposts).'\',
							   `id_lang` = \''.(int)($language).'\',
							   `title` = \''.pSQL($post_title).'\',
							   `seo_keywords` = \''.pSQL($post_seokeywords).'\',
							   `seo_description` = \''.pSQL($post_seodescription).'\',
							   `content` = "'.pSQL($post_content,true).'",
							   `seo_url` = \''.pSQL($seo_url).'\'
							   ';
			Db::getInstance()->Execute($sql);
		
		}

        include_once(dirname(__FILE__).'/../blockblog.php');
        $obj = new blockblog();
        if($obj->is_demo == 0) {
            $this->saveImage(array('post_id' => $id_editposts, 'post_images' => $post_images));
        }
		
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category2post`
					   WHERE `post_id` = \''.(int)($id_editposts).'\'';
		Db::getInstance()->Execute($sql);
		
		foreach($ids_categories as $id_cat){
			$sql = 'INSERT into `'._DB_PREFIX_.'blog_category2post` SET
							   `category_id` = \''.(int)($id_cat).'\',
							   `post_id` = \''.(int)($id_editposts).'\'
							   ';
			Db::getInstance()->Execute($sql);
		
		}
		
	}
	
	
	public function saveImage($data = null){
		
		$error = 0;
		$error_text = '';
		
		$post_id = $data['post_id'];
		$post_images = isset($data['post_images'])?$data['post_images']:'';
		
		$files = $_FILES['post_image'];
		############### files ###############################
		if(!empty($files['name']))
			{
		      if(!$files['error'])
		      {
				  $type_one = $files['type'];
				  $ext = explode("/",$type_one);
				  
				  if(strpos('_'.$type_one,'image')<1)
				  {
				  	$error_text = $this->l('Invalid file type, please try again!');
				  	$error = 1;

				  }elseif(!in_array($ext[1],array('png','x-png','gif','jpg','jpeg','pjpeg'))){
				  	$error_text = $this->l('Wrong file format, please try again!');
				  	$error = 1;
				  	
				  } else {
				  	
				  	
				  		$info_post = $this->getPostItem(array('id'=>$post_id));
				  		$post_item = $info_post['post'][0];
				  		$img_post = $post_item['img'];
				  		
				  		
				  		
				  		
				  		
				  		if(Tools::strlen($img_post)>0){
				  			
				  			// delete old avatars
				  			$name_thumb = current(explode(".",$img_post));
				  			unlink(dirname(__FILE__).$this->path_img_cloud.$name_thumb.".jpg");
				  			
				  			$posts_block_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'posts_block_img_width').'x'.Configuration::get($this->_name.'posts_block_img_width').'.jpg';
							@unlink($posts_block_img);
						
							$lists_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'lists_img_width').'x'.Configuration::get($this->_name.'lists_img_width').'.jpg';
							@unlink($lists_img);
						
							$post_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'post_img_width').'x'.Configuration::get($this->_name.'post_img_width').'.jpg';
							@unlink($post_img);
						
				  			
				  		} 
							
					  	srand((double)microtime()*1000000);
					 	$uniq_name_image = uniqid(rand());
					 	$type_one = Tools::substr($type_one,6,Tools::strlen($type_one)-6);
					 	$filename = $uniq_name_image.'.'.$type_one;
					 	 
					 	//var_dump(dirname(__FILE__).$this->path_img_cloud.$filename);exit;
					 	
						move_uploaded_file($files['tmp_name'], dirname(__FILE__).$this->path_img_cloud.$filename);
						
						
						$name_img = dirname(__FILE__).$this->path_img_cloud.$filename;
						$dir_without_ext = dirname(__FILE__).$this->path_img_cloud.$uniq_name_image;
						
						$this->copyImage(array('dir_without_ext'=>$dir_without_ext,
												'name'=>$name_img)
										);

										
						//Image in the block "Blog Posts recents"				
						$this->copyImage(array('dir_without_ext'=>$dir_without_ext,
											   'name'=>$name_img,
											   'width'=>Configuration::get($this->_name.'posts_block_img_width'),
											   'height'=>Configuration::get($this->_name.'posts_block_img_width')
											   )
										);
						// Image in the block "Blog Posts recents"
						
						// Image in lists posts				
						$this->copyImage(array('dir_without_ext'=>$dir_without_ext,
											   'name'=>$name_img,
											   'width'=>Configuration::get($this->_name.'lists_img_width'),
											   'height'=>Configuration::get($this->_name.'lists_img_width')
											   )
										);
						// Image in lists posts					
										
						// Image on post page			
						$this->copyImage(array('dir_without_ext'=>$dir_without_ext,
											   'name'=>$name_img,
											   'width'=>Configuration::get($this->_name.'post_img_width'),
											   'height'=>Configuration::get($this->_name.'post_img_width')
											   )
										);
						// Image on post page					
						
						// delete original image				
						@unlink(dirname(__FILE__).$this->path_img_cloud.$uniq_name_image.".".$ext[1]);
						
						
						
						$img_return = $uniq_name_image.'.jpg';
			  		
				  		$this->_updateImgToPost(array('post_id' => $post_id,
				  									  'img' =>  $img_return
				  									  )
				  								);

				  }
				}
				else
					{
					### check  for errors ####
			      	switch($files['error'])
						{
							case '1':
								$error_text = $this->l('The size of the uploaded file exceeds the').ini_get('upload_max_filesize').'b';
								break;
							case '2':
								$error_text = $this->l('The size of  the uploaded file exceeds the specified parameter  MAX_FILE_SIZE in HTML form.');
								break;
							case '3':
								$error_text = $this->l('Loaded only a portion of the file');
								break;
							case '4':
								$error_text = $this->l('The file was not loaded (in the form user pointed the wrong path  to the file). ');
								break;
							case '6':
								$error_text = $this->l('Invalid  temporary directory.');
								break;
							case '7':
								$error_text = $this->l('Error writing file to disk');
								break;
							case '8':
								$error_text = $this->l('File download aborted');
								break;
							case '999':
							default:
								$error_text = $this->l('Unknown error code!');
							break;
						}
						$error = 1;
			      	########
					   
					}
			}  else {
				if($post_images != "on"){
				$this->_updateImgToPost(array('post_id' => $post_id,
				  							  'img' =>  ""
				  							  )
				  						);
				}
			}
			
		return array('error' => $error,
					 'error_text' => $error_text);
	
	
	}



	public function deleteImg($data = null){
		$id = $data['id'];
		$_data = $this->getPostItem(array('id'=>$id));
		$img = $_data['post'][0]['img'];
		
		$this->_updateImgToPost(array('post_id' => $id,
				  					  'img' =>  ""
				  					 )
				  				);
				  				
		@unlink(dirname(__FILE__).$this->path_img_cloud.$img);
		
		$name_thumb = current(explode(".",$img));
		
		$posts_block_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'posts_block_img_width').'x'.Configuration::get($this->_name.'posts_block_img_width').'.jpg';
		@unlink($posts_block_img);
						
		$lists_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'lists_img_width').'x'.Configuration::get($this->_name.'lists_img_width').'.jpg';
		@unlink($lists_img);
						
		$post_img = dirname(__FILE__).$this->path_img_cloud.$name_thumb.'-'.Configuration::get($this->_name.'post_img_width').'x'.Configuration::get($this->_name.'post_img_width').'.jpg';
		@unlink($post_img);
	}
	
	private function _updateImgToPost($data = null){
		
		$post_id = $data['post_id'];
		$img = $data['img'];
			
		// update
		$sql = 'UPDATE `'._DB_PREFIX_.'blog_post` SET
							   `img` = \''.pSQL($img).'\'
							   WHERE id = '.(int)$post_id.'
							   ';
		Db::getInstance()->Execute($sql);
		
	}
	
	public function getHttp(){
		$smarty = $this->context->smarty;
		$http = null;
		if(defined('_MYSQL_ENGINE_')){
				$http = @$smarty->tpl_vars['base_dir']->value;
		} else {
				$http = @$smarty->_tpl_vars['base_dir'];
		}
		if(empty($http)) $http = $_SERVER['HTTP_HOST'];
		return $http;
	}
	
	public function getAllImg(){
			
			$path = $_SERVER['DOCUMENT_ROOT']."/upload/".$this->_name."/";
			
			$d = @opendir($path);
         	
         	$data = array();
         	
			if(!$d) return;
			
			while(($e=readdir($d)) !== false)
			{
				if($e =='.' || $e=='..') continue;
				$data[] = $e;	
			}
			return array('data'=>$data);
	}
	
	public function copyImage($data){
	
		$filename = $data['name'];
		$dir_without_ext = $data['dir_without_ext'];
		
		$is_height_width = 0;
		if(isset($data['width']) && isset($data['height'])){
			$is_height_width = 1;
		}
			
		
		$width = isset($data['width'])?$data['width']:$this->_width;
		$height = isset($data['height'])?$data['height']:$this->_height;
		
		$width_orig_custom = $width;
		$height_orig_custom = $height;
		
		if (!$width){ $width = 85;}
		if (!$height){ $height = 85;}
		// Content type
		$size_img = getimagesize($filename);
		// Get new dimensions
		list($width_orig, $height_orig) = getimagesize($filename);
		$ratio_orig = $width_orig/$height_orig;
		
		if($width_orig>$height_orig){
		$height =  $width/$ratio_orig;
		}else{ 
		$width = $height*$ratio_orig;
		}
		if($width_orig<$width){
			$width = $width_orig;
			$height = $height_orig;
		}
	
		$image_p = imagecreatetruecolor($width, $height);
		$bgcolor=ImageColorAllocate($image_p, 255, 255, 255);
		//   
		imageFill($image_p, 5, 5, $bgcolor);
	
		if ($size_img[2]==2){ $image = imagecreatefromjpeg($filename);}                         
		else if ($size_img[2]==1){  $image = imagecreatefromgif($filename);}                         
		else if ($size_img[2]==3) { $image = imagecreatefrompng($filename); }
	
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
		// Output
		
		if ($is_height_width)
			$users_img = $dir_without_ext.'-'.$width_orig_custom.'x'.$height_orig_custom.'.jpg';
		else
		 	$users_img = $dir_without_ext.'.jpg';
		
		if ($size_img[2]==2)  imagejpeg($image_p, $users_img, 100);                         
		else if ($size_img[2]==1)  imagejpeg($image_p, $users_img, 100);                        
		else if ($size_img[2]==3)  imagejpeg($image_p, $users_img, 100);
		imageDestroy($image_p);
		imageDestroy($image);
		//unlink($filename);

	}
	
	
	public function deletePost($data){
		
		$id = $data['id'];
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_post`
							   WHERE id ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
		
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_post_data`
							   WHERE id_item ='.(int)$id.'';

		Db::getInstance()->Execute($sql);
		
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_category2post`
							   WHERE post_id ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
		
		// delete comments
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_comments`
							   WHERE id_post ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
				
	}
	
	public function getPostItem($_data){
			$id = $_data['id'];
			$site = isset($_data['site'])?$_data['site']:'';
		
			if($site==1){
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
				$sql = '
			SELECT pc.*,
			(select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1) as count_like,
                (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1 and ip = \''.pSQL($_SERVER['REMOTE_ADDR']).'\') as is_liked_post,
                (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pcc WHERE pcc.id_post = pc.id and pcc.status = 1 and pcc.id_lang = '.$current_language.') as count_comments
			FROM `'._DB_PREFIX_.'blog_post` pc LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc1
			ON(pc1.id_item = pc.id)
			WHERE pc.`id` = '.(int)$id.' AND pc1.id_lang = '.(int)$current_language.' 
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)';
				
			$item = Db::getInstance()->ExecuteS($sql);
			
			foreach($item as $k => $_item){
				
				if(Tools::strlen($_item['img'])>0){
                    $item[$k]['img_orig'] = $_item['img'];
                    $this->generateThumbImages(array('img'=>$_item['img'],
		    												 'width'=>Configuration::get($this->_name.'post_img_width'),
		    												 'height'=>Configuration::get($this->_name.'post_img_width') 
		    												)
		    											);
		    		$img = Tools::substr($_item['img'],0,-4)."-".Configuration::get($this->_name.'post_img_width')."x".Configuration::get($this->_name.'post_img_width').".jpg";
				} else {
		    		$img = $_item['img'];
				}
		    	
		    	$item[$k]['img'] = $img;
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
					if($current_language == $item_data['id_lang']){
		    			$item[$k]['title'] = $item_data['title'];
		    			$item[$k]['content'] = $item_data['content'];
		    			$item[$k]['seo_keywords'] = $item_data['seo_keywords'];
		    			$item[$k]['seo_description'] = $item_data['seo_description'];
		    			$item[$k]['seo_url'] = $item_data['seo_url'];
                        $item[$k]['time_add'] = $_item['time_add'];
					}
		    		
		    	}

                $item[$k]['time_add_rss'] = date(DATE_ATOM,strtotime($_item['time_add']));
		    	
			}
			
			
			$sql = '
			SELECT pc.category_id, pc.post_id
			FROM `'._DB_PREFIX_.'blog_category2post` pc
			WHERE pc.`post_id` = '.(int)$id.'';
			
			$category_ids = Db::getInstance()->ExecuteS($sql);
			$data_category_ids = array();
			foreach($category_ids as $k => $v){
				$data_category_ids[] = $v['category_id'];
			}
			
			$item[0]['category_ids'] = $data_category_ids;
			
			
			} else {
			
			$item = Db::getInstance()->ExecuteS('
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_post` pc
			WHERE pc.`id` = '.(int)$id.'');
			
			foreach($item as $k => $_item){
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    			$item['data'][$item_data['id_lang']]['title'] = $item_data['title'];
		    			$item['data'][$item_data['id_lang']]['content'] = $item_data['content'];
		    			$item['data'][$item_data['id_lang']]['seo_keywords'] = $item_data['seo_keywords'];
		    			$item['data'][$item_data['id_lang']]['seo_description'] = $item_data['seo_description'];
		    			$item['data'][$item_data['id_lang']]['seo_url'] = $item_data['seo_url'];
                        $item['data'][$item_data['id_lang']]['img'] = $_item['img'];
		    	}
		    	
			}

            //$item['data'][$item_data['id_lang']] =
			
			$category_ids = Db::getInstance()->ExecuteS('
			SELECT pc.category_id, pc.post_id
			FROM `'._DB_PREFIX_.'blog_category2post` pc
			WHERE pc.`post_id` = '.(int)$id.'');
			
			$data_category_ids = array();
			foreach($category_ids as $k => $v){
				$data_category_ids[] = $v['category_id'];
			}
			
			$item[0]['category_ids'] = $data_category_ids;
			}
			
	   return array('post' => $item);
	}
	
	public function  getComments($_data){
		$admin = isset($_data['admin'])?$_data['admin']:null;
		$id = isset($_data['id'])?$_data['id']:0;
		
		if($admin == 1){
			
			$posts = Db::getInstance()->ExecuteS('
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_comments` pc
			WHERE pc.id_post = '.(int)$id.'
			ORDER BY pc.`time_add` DESC');
			
			$data_count_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_comments`  as pc
			WHERE pc.id_post = '.(int)$id.'
			');
			
		} elseif($admin == 2){
			$start = $_data['start'];
			$step = $_data['step'];
			
			$posts = Db::getInstance()->ExecuteS('
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_comments` pc
			ORDER BY pc.`time_add` DESC  LIMIT '.(int)$start.' ,'.(int)$step.'');
			
			$data_count_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_comments`  as pc
			');
		} else{
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$start = $_data['start'];
			$step = $_data['step'];
			
			$posts = Db::getInstance()->ExecuteS('
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_comments` pc
			WHERE pc.`id_post` = '.(int)$id.' and status = 1 and id_lang = '.(int)$current_language.' 
			and pc.id_shop = '.(int)$this->_id_shop.'
			ORDER BY pc.`time_add` DESC LIMIT '.(int)$start.' ,'.(int)$step.'');	
			
			$data_count_posts = Db::getInstance()->getRow('
			SELECT COUNT(*) AS "count"
			FROM `'._DB_PREFIX_.'blog_comments` pc
			WHERE pc.id_post = '.(int)$id.' and status = 1 and id_lang = '.(int)$current_language.'
			and pc.id_shop = '.(int)$this->_id_shop.'
			');
		}	
		return array('comments' => $posts, 'count_all' => $data_count_posts['count'] );
	}
	
	public function deleteComment($data){
		
		$id = $data['id'];
		// delete comments
		$sql = 'DELETE FROM `'._DB_PREFIX_.'blog_comments`
							   WHERE id ='.(int)$id.'';
		Db::getInstance()->Execute($sql);
				
	}
	
	public function getCommentItem($_data){
			$id = $_data['id'];
		
			$category = Db::getInstance()->ExecuteS('
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_comments` pc
			WHERE pc.`id` = '.(int)$id.'');
	   return array('comments' => $category);
	}
	
	public function updateComment($data){
	
		$id_editcomments = $data['id_editcomments'];
		
		$comments_name = $data['comments_name'];
		$comments_email = $data['comments_email'];
		$comments_comment = $data['comments_comment'];
		$comments_status = $data['comments_status'];
        $time_add = $data['time_add'];
			
		// update
		$sql = 'UPDATE `'._DB_PREFIX_.'blog_comments` SET
							   `name` = \''.pSQL($comments_name).'\',
							   `email` = \''.pSQL($comments_email).'\',
							   `comment` = \''.pSQL($comments_comment).'\',
							   `time_add` = \''.pSQL($time_add).'\',
							   `status` = \''.(int)($comments_status).'\'
							   WHERE id = '.(int)$id_editcomments.'
							   ';
		Db::getInstance()->Execute($sql);
		
	}
	
	public function saveComment($_data){
		$name = $_data['name'];
		$email = $_data['email'];
		$text_review =  $_data['text_review'];
		$id_post = $_data['id_post'];
		
		$cookie = $this->context->cookie;
		$current_language = (int)$cookie->id_lang;
		
		$sql = 'INSERT into `'._DB_PREFIX_.'blog_comments` SET
							   `id_lang` = \''.(int)($current_language).'\',
							   `name` = \''.pSQL($name).'\',
							   `email` = \''.pSQL($email).'\',
							   `comment` = \''.pSQL($text_review).'\',
							   `id_post` = \''.(int)($id_post).'\',
							   `id_shop` = \''.(int)($this->_id_shop).'\',
							   `time_add` = NULL
							   ';
		Db::getInstance()->Execute($sql);
		
		if(Configuration::get($this->_name.'noti') == 1){

			include_once(dirname(__FILE__).'/../blockblog.php');
			$obj = new blockblog();
			$_data_translate = $obj->translateItems();
			$subject = $_data_translate['email_subject'];

            ### get post info ###

            $_info_post = $this->getPostItem(array('id' => $id_post,'site'=>1));

            $title_post = isset($_info_post['post'][0]['title'])?$_info_post['post'][0]['title']:'';
            $img = isset($_info_post['post'][0]['img'])?$_info_post['post'][0]['img']:'';
            if(Tools::strlen($img)>0) {
                $img = $this->getHttpost().$obj->getCloudImgPath().$img;
            }

            $seo_url =  isset($_info_post['post'][0]['seo_url'])?$_info_post['post'][0]['seo_url']:'';
            $data_url = $this->getSEOURLs();
            $post_url = $data_url['post_url'];

            if(Configuration::get($this->_name.'urlrewrite_on')) {
                $com_url = $post_url . $seo_url.'#leaveComment';
            } else {
                $com_url = $post_url.'?post_id='.$id_post.'#leaveComment';
            }
            ### get post info ###


            /* Email generation */
		$templateVars = array(
			'{email}' => $email,
			'{name}' => $name,
			'{message}' => Tools::stripslashes($text_review),
            '{img}' => $img,
            '{title_post}' => $title_post,
            '{com_url}' => $com_url,
		);
		
		
		$id_lang = (int)($cookie->id_lang);
		
		$iso_code = Language::getIsoById($id_lang);
		
		if (is_dir(_PS_MODULE_DIR_ . $this->_name_module.'/mails/' . $iso_code . '/') && !empty($iso_code)) {
			$id_lang_mail = $id_lang;
		} else {
			$id_lang_mail = Configuration::get('PS_LANG_DEFAULT');
		}
				
		/* Email sending */
		Mail::Send($id_lang_mail, 'comment', $subject, $templateVars, 
			Configuration::get($this->_name.'mail'), 'Blog Comment Form', $email, $name,
			NULL, NULL, dirname(__FILE__).'/../mails/');
		}
	}
	
	public function PageNav($start,$count,$step, $_data =null )
	{
		$_admin = isset($_data['admin'])?$_data['admin']:null;
		$category_id = isset($_data['category_id'])?$_data['category_id']:0;
		
		
		$post_id = isset($_data['post_id'])?$_data['post_id']:0;
		$is_category = isset($_data['category'])?$_data['category']:0;
		
		$all_posts = isset($_data['all_posts'])?$_data['all_posts']:'';
		$is_search = isset($_data['is_search'])?$_data['is_search']:0;
		
		$is_arch = isset($_data['is_arch'])?$_data['is_arch']:0;
		$month = isset($_data['month'])?$_data['month']:0;
		$year = isset($_data['year'])?$_data['year']:0;
		
		$all_comments = isset($_data['all_comments'])?$_data['all_comments']:'';
		
		include_once(dirname(__FILE__).'/../blockblog.php');
		$obj = new blockblog();
		$_data_translate = $obj->translateItems();
		$page_translate = $_data_translate['page'];
			
		$res = '';
		$product_count = $count;
		$res .= '<div class="pages">';
		$res .= '<span class="text-page">'.$page_translate.':</span>';
		$res .= '<span class="nums">';

        $data_url = $this->getSEOURLs();

		
		$start1 = $start;
			for ($start1 = ($start - $step*4 >= 0 ? $start - $step*4 : 0); $start1 < ($start + $step*5 < $product_count ? $start + $step*5 : $product_count); $start1 += $step)
				{
					$par = (int)($start1 / $step) + 1;
					if ($start1 == $start)
						{
						
						$res .= '<b>'. $par .'</b>';
						}
					else
						{
							if($_admin){
								$currentIndex = $_data['currentIndex'];
								$token = $_data['token'];
								$item = $_data['item'];
								$res .= '<a href="'.$currentIndex.'&page'.$item.'='.($start1 ? $start1 : 0).$token.'" >'.$par.'</a>';
							} else {
								if($is_category == 1){

                                    // categories page //
                                    $items_url = $data_url['categories_url'];
                                    if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                        if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                            $p = ($start1 ? '?p=' . $par : '');
                                        }else{
                                            $p = ($start1 ? '/' . $par : '');
                                        }

                                    }else{
                                        $p = ($start1 ? '?p=' . $par : '');
                                    }
                                    $res .= '<a href="'.$items_url.$p.'" title="'.$par.'">'.$par.'</a>';
                                    // categories page //

                                } else {
									
									if($category_id != 0){
                                        // category page //
                                        $category_id_page = isset($_data['category_id_page'])?$_data['category_id_page']:'';
                                        if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                            $items_url = $data_url['category_url'].$category_id_page;
                                            if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                $p = ($start1 ? '?p='.$par : '');
                                            } else {
                                                $p = ($start1 ? '/' . $par : '');
                                            }

                                        } else {

                                            $items_url = $data_url['category_url'].'?category_id='.$category_id_page;
                                            $p = ($start1 ? '&p='.$par : '');

                                        }

                                        $res .= '<a href="'.$items_url.$p.'" title="'.$par.'">'.$par.'</a>';
									    // category page //

                                    }else{
										if(Tools::strlen($all_posts)>0){
											
											if($is_search == 1){
                                                // search //
                                                $search = isset($_data['search'])?$_data['search']:'';

                                                if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                                    $items_url = $data_url['posts_url'];
                                                    if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                        $p = ($start1 ? '?p='.$par.'&' : '?').'search='.$search;
                                                    } else {
                                                        $p = ($start1 ? '/' . $par : '') . '?search=' . $search;
                                                    }

                                                } else {

                                                    $items_url = $data_url['posts_url'];
                                                    $p = ($start1 ? '?p='.$par.'&' : '?').'search='.$search;

                                                }

												$res .= '<a href="'.$items_url.$p.'" >'.$par.'</a>';
                                                // search //


											} elseif($is_arch == 1){

                                                // posts archive ///
                                                if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                                    $items_url = $data_url['posts_url'];
                                                    if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                        $p = ($start1 ? '?p='.$par.'&' : '?').'y='.$year.'&m='.$month;
                                                    } else {
                                                        $p = ($start1 ? '/' . $par : '') . '?y=' . $year . '&m=' . $month;
                                                    }

                                                } else {

                                                    $items_url = $data_url['posts_url'];
                                                    $p = ($start1 ? '?p='.$par.'&' : '?').'y='.$year.'&m='.$month;

                                                }

                                                $res .= '<a href="'.$items_url.$p.'" >'.$par.'</a>';
                                                // posts archive ///


                                            }else {
                                                // all posts page
                                                if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                                    $items_url = $data_url['posts_url'];
                                                    if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                        $p = ($start1 ? '?p='.$par : '');
                                                    } else {
                                                        $p = ($start1 ? '/'.$par : '');
                                                    }


                                                } else {

                                                    $items_url = $data_url['posts_url'];
                                                    $p = ($start1 ? '?p='.$par : '');

                                                }

                                                $res .= '<a href="'.$items_url.$p.'" title="'.$par.'">'.$par.'</a>';
                                                // all posts page
										    }
									
										}elseif(Tools::strlen($all_comments)>0){
											
											if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                                $items_url = $data_url['comments_url'];
                                                if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                    $p = ($start1 ? '?p='.$par : '');
                                                } else {
                                                    $p = ($start1 ? '/' . $par : '');
                                                }

                                            } else {

                                                $items_url = $data_url['comments_url'];
                                                $p = ($start1 ? '?p='.$par : '');

                                            }

                                            $res .= '<a href="'.$items_url.$p.'" title="'.$par.'">'.$par.'</a>';
											
										} else{
                                            // post page //
                                            if(Configuration::get($this->_name.'urlrewrite_on')==1) {

                                                $items_url = $data_url['post_url'].$post_id;
                                                if(version_compare(_PS_VERSION_, '1.6', '<')) {
                                                    $p = ($start1 ? '?p='.$par : '');
                                                } else {
                                                    $p = ($start1 ? '/' . $par : '');
                                                }

                                            } else {

                                                $items_url = $data_url['post_url'].'?post_id='.$post_id;
                                                $p = ($start1 ? '&p='.$par : '');

                                            }

                                            $res .= '<a href="'.$items_url.$p.'" title="'.$par.'">'.$par.'</a>';
                                            // post page //
										}
									}
								}		
							}
						}
				}
		
		$res .= '</span>';
		$res .= '</div>';
		
		
		return $res;
	}
	
	public function getCategoriesBlock(){
		$limit  = (int)Configuration::get($this->_name.'blog_bcat');
		
		
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$sql = '
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_category` pc 
			LEFT JOIN `'._DB_PREFIX_.'blog_category_data` pc_d
			ON(pc.id = pc_d.id_item) 
			WHERE pc_d.id_lang = '.(int)$current_language.' AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			 ORDER BY pc.`time_add` DESC LIMIT '.(int)$limit;
			
			$items = Db::getInstance()->ExecuteS($sql);
			$items_tmp = array();
			foreach($items as $k => $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		if($current_language == $item_data['id_lang']){
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['title'] = $item_data['title'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_description'] = $item_data['seo_description'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_keywords'] = $item_data['seo_keywords'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['time_add'] = $_item['time_add'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['id'] = $_item['id'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_url'] = $item_data['seo_url'];
		    		}
		    	}
		    	
			}
			
			
		return array('categories' => $items_tmp );
	}
	
	public function getRecentsPosts($data=null){
		$is_home = isset($data['is_home'])?$data['is_home']:0;
		if($is_home == 1){
			$limit  =(int) Configuration::get($this->_name.'blog_bp_h');
			$posts_block_img_width = Configuration::get($this->_name.'posts_w_h');
		} else {
			$limit  =(int) Configuration::get($this->_name.'blog_bposts');
			$posts_block_img_width = Configuration::get($this->_name.'posts_block_img_width');
		}
		
		
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$sql = '
			SELECT pc.*,
			(select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1) as count_like,
		    (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1 and ip = \''.pSQL($_SERVER['REMOTE_ADDR']).'\') as is_liked_post,
		    (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pcc WHERE pcc.id_post = pc.id and pcc.status = 1 and pcc.id_lang = '.$current_language.') as count_comments
			FROM `'._DB_PREFIX_.'blog_post` pc 
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			ON(pc.id = pc_d.id_item) 
			WHERE pc.status = 1 AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			AND pc_d.id_lang = '.(int)$current_language.' ORDER BY pc.`time_add` DESC LIMIT '.(int)$limit;
			
			$items = Db::getInstance()->ExecuteS($sql);
			$items_tmp = array();
			foreach($items as $k => $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		if($current_language == $item_data['id_lang']){
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['title'] = $item_data['title'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_description'] = $item_data['seo_description'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_keywords'] = $item_data['seo_keywords'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['content'] = $item_data['content'];
		    			
		    			
		    			
		    			
		    			if(Tools::strlen($_item['img'])>0){
		    				$this->generateThumbImages(array('img'=>$_item['img'], 
		    												 'width'=>$posts_block_img_width,
		    												 'height'=>$posts_block_img_width 
		    												)
		    											);
		    				$img = Tools::substr($_item['img'],0,-4)."-".$posts_block_img_width."x".$posts_block_img_width.".jpg";
		    			} else {
		    				$img = $_item['img'];
		    			}
		    			
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['img'] = $img;
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['status'] = $_item['status'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['is_comments'] = $_item['is_comments'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['time_add'] = $_item['time_add'];	
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['id'] = $_item['id'];
		    			$items_tmp[$k]['data'][$item_data['id_lang']]['seo_url'] = $item_data['seo_url'];

                        $items_tmp[$k]['data'][$item_data['id_lang']]['count_like'] = $_item['count_like'];
                        $items_tmp[$k]['data'][$item_data['id_lang']]['is_liked_post'] = $_item['is_liked_post'];
                        $items_tmp[$k]['data'][$item_data['id_lang']]['count_comments'] = $_item['count_comments'];
		    		}
		    	}
		    	
			}
			//exit;
			
			
		return array('posts' => $items_tmp );
	} 
	
	
	public function getArchives(){

			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$sql = 'SELECT 
						    YEAR(`time_add`) AS YEAR, 
						    MONTH(`time_add`) AS MONTH,
						    COUNT(*) AS TOTAL ,
						    time_add
						FROM  `'._DB_PREFIX_.'blog_post` pc
						LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
						ON(pc.id = pc_d.id_item)
						WHERE pc.status = 1 AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
						AND pc_d.id_lang = '.(int)$current_language.'
						GROUP BY YEAR desc, MONTH';
			
			$items = Db::getInstance()->ExecuteS($sql);
			$items_tmp = array();
			
			
			foreach($items as $_item){
				$year = $_item['YEAR'];
				$month = $_item['MONTH'];
				$total = $_item['TOTAL'];
				$time_add = $_item['time_add'];
			
					
				$items_tmp[$year][] = array('year'=>$year,
									 'month'=>$month,
									 'total' =>$total,
									 'time_add' => $time_add
									);
				
			}
			
		return array('posts' => $items_tmp );
	} 
	
	public function generateThumbImages($data){
		
		$filename = $data['img'];
		$orig_name_img= $data['img'];
		$width = $data['width'];
		$height = $data['height'];
		
		$filename = Tools::substr($filename,0,-4)."-".$width."x".$height.".jpg";
		
		$name_img = dirname(__FILE__).$this->path_img_cloud.$filename;
		
		
		if(@filesize($name_img)==0){
		
		$uniq_name_image_without_ext = current(explode(".",$orig_name_img));
		
		$dir_without_ext = dirname(__FILE__).$this->path_img_cloud.$uniq_name_image_without_ext;
						
		$this->copyImage(
			array('dir_without_ext'=>$dir_without_ext,
			      'name'=>dirname(__FILE__).$this->path_img_cloud.$orig_name_img,
				  'width'=>$width,
				  'height'=>$height
				  )
				    );	
		}
		
		
						
	}
	
	public function createRSSFile($post_title,$post_description,$post_link,$post_pubdate,$img)
	{
		
		
		if(Configuration::get($this->_name.'urlrewrite_on') == 1){
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
		    $_is_friendly_url = $this->isURLRewriting();
			if($_is_friendly_url)
				$_iso_lng = Language::getIsoById((int)($current_language))."/";
			else
				$_iso_lng = '';
			
			$post_link = $this->_http_host.$_iso_lng."blog/post/".$post_link;
		} else {
			$post_link = $this->_http_host
								."modules/blockblog/blockblog-post.php?post_id=".$post_link;
		}
		
		$returnITEM = "<item>\n";
		# this will return the Title of the Article.
		$returnITEM .= "<title><![CDATA[".$post_title."]]></title>\n";
		# this will return the Description of the Article.
		$returnITEM .= "<description><![CDATA[".((Tools::strlen($img)>0)?"<img src=\"".$img."\" title=\"".$post_title."\" alt=\"thumb\" />":"").$post_description."]]></description>\n";
		# this will return the URL to the post.
		$returnITEM .= "<link>".str_replace('&','&amp;', $post_link)."</link>\n";
		
		$returnITEM .= "<pubDate>".$post_pubdate."</pubDate>\n";
		$returnITEM .= "</item>\n";
		return $returnITEM;
	}
	
	public function getItemsForRSS(){
			
			$step = Configuration::get($this->_name.'number_rssitems');
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
			$sql = '
			SELECT pc.* 
			FROM `'._DB_PREFIX_.'blog_post` pc 
			LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
			on(pc.id = pc_d.id_item)
			WHERE pc.status = 1 and pc_d.id_lang = '.(int)$current_language.'  
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			ORDER BY pc.`time_add` DESC LIMIT '.(int)$step.'';
			
			$items = Db::getInstance()->ExecuteS($sql);	
			
			foreach($items as $k1=>$_item){
				
				if(Tools::strlen($_item['img'])>0){
					$this->generateThumbImages(array('img'=>$_item['img'], 
		    												 'width'=>Configuration::get($this->_name.'lists_img_width'),
		    												 'height'=>Configuration::get($this->_name.'lists_img_width') 
		    												)
		    											);
		    		$img = Tools::substr($_item['img'],0,-4)."-".Configuration::get($this->_name.'lists_img_width')."x".Configuration::get($this->_name.'lists_img_width').".jpg";
		    	} else {
		    		$img = $_item['img'];
				}
		    		
		    	$items[$k1]['img'] = $img;
				
				
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k1]['title'] = $item_data['title'];
		    			$items[$k1]['seo_description'] = htmlspecialchars(strip_tags($item_data['content']));
		    			$items[$k1]['pubdate'] = date('D, d M Y H:i:s +0000',strtotime($_item['time_add']));
		    			if(Configuration::get($this->_name.'urlrewrite_on') == 1){
		    			$items[$k1]['page'] = $item_data['seo_url'];
		    			} else {
		    			$items[$k1]['page'] = $item_data['id_item'];
		    				
		    			}
		    			
		    		} 
		    	}
				
			}
			
			
			
		
			return array('items' => $items);
	}
	
	public function getfacebooklocale()
	{
        $locales = array();

        if (($xml=simplexml_load_file(_PS_MODULE_DIR_ . $this->_name."/lib/facebook_locales.xml")) === false)
            return $locales;

        for ($i=0;$i<sizeof($xml);$i++)
        {
            $locale = $xml->locale[$i]->codes->code->standard->representation;
            $locales[]= $locale;
        }

        return $locales;
	}
	
 	public function getfacebooklib($id_lang){
    	
    	$lang = new Language((int)$id_lang);
		
    	$lng_code = isset($lang->language_code)?$lang->language_code:$lang->iso_code;
    	if(strstr($lng_code, '-')){
			$res = explode('-', $lng_code);
			$language_iso = Tools::strtolower($res[0]).'_'.Tools::strtoupper($res[1]);
			$rss_language_iso = Tools::strtolower($res[0]);
		} else {
			$language_iso = Tools::strtolower($lng_code).'_'.Tools::strtoupper($lng_code);
			$rss_language_iso = $lng_code;
		}
			
			
		if (!in_array($language_iso, $this->getfacebooklocale()))
			$language_iso = "en_US";
		
		if (Configuration::get('PS_SSL_ENABLED') == 1)
			$url = "https://";
		else
			$url = "http://";
		
		
		
		return array('url'=>$url . 'connect.facebook.net/'.$language_iso.'/all.js#xfbml=1',
					  'lng_iso' => $language_iso, 'rss_language_iso' => $rss_language_iso);
    }
    
    private function _getCategoriesForSitemap(){
    		
			$sql = '
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_category` pc 
			WHERE  FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			 ORDER BY pc.`time_add` DESC ';

            $all_laguages = Language::getLanguages(true);
			
			$items = Db::getInstance()->ExecuteS($sql);
			$items_tmp = array();
			foreach($items as $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_category_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				foreach ($items_data as $item_data){
		    		//if($current_language == $item_data['id_lang']){
		    			if (Configuration::get('PS_REWRITING_SETTINGS')) {
		    				
						$_is_friendly_url = $this->isURLRewriting();
						if($_is_friendly_url) {
                            if(sizeof($all_laguages)>1)
                                $_iso_lng = Language::getIsoById((int)($item_data['id_lang']))."/";
                            else
                                $_iso_lng = '';

                            //$_iso_lng = Language::getIsoById((int)($item_data['id_lang'])) . "/";
                        }else
							$_iso_lng = '';
		    				
		    				$url = $this->_http_host.$_iso_lng.'blog/category/'.$item_data['seo_url'];
		    				$items_tmp[]['data'][$item_data['id_lang']]['url'] = $url;
		    			} else {
		    				$url = $this->_http_host.'modules/'.$this->_name.'/blockblog-category.php?category_id='.$_item['id'];
		    				$items_tmp[]['data'][$item_data['id_lang']]['url'] = $url;
		    			}
		    		//}
		    	}
		    	
			}
			
			return array('all_categories'=>$items_tmp);
    }
    
    private function _getPostsForSitemap(){
		
		
			
			$sql = '
			SELECT pc.*
			FROM `'._DB_PREFIX_.'blog_post` pc 
			WHERE pc.status = 1 AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops)
			 ORDER BY pc.`time_add` DESC';

            $all_laguages = Language::getLanguages(true);
			
			$items = Db::getInstance()->ExecuteS($sql);
			$items_tmp = array();
			foreach($items as $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				//echo "<pre>"; var_dump($items_data); exit;
				foreach ($items_data as $item_data){
		    		//if($current_language == $item_data['id_lang']){
		    			
		    			if (Configuration::get('PS_REWRITING_SETTINGS')) {
		    				$_is_friendly_url = $this->isURLRewriting();
							if($_is_friendly_url) {



                                if(sizeof($all_laguages)>1)
                                    $_iso_lng = Language::getIsoById((int)($item_data['id_lang']))."/";
                                else
                                    $_iso_lng = '';

                                //$_iso_lng = Language::getIsoById((int)($item_data['id_lang'])) . "/";
                            }else
								$_iso_lng = '';
								
		    				$url = $this->_http_host.$_iso_lng.'blog/post/'.$item_data['seo_url'];
		    				$items_tmp[]['data'][$item_data['id_lang']]['url'] = $url;
		    			} else {
		    				$url = $this->_http_host.'modules/'.$this->_name.'/blockblog-post.php?post_id='.$_item['id'];
		    				$items_tmp[]['data'][$item_data['id_lang']]['url'] = $url;
		    			}
		    			
		    		//}
		    	}
		    	
			}
			
		return array('all_posts' => $items_tmp );
	} 
	
    
    public function generateSitemap(){
               
        $filename = dirname(__FILE__).$this->path_img_cloud."blog.xml";
                
                //if(@filesize($filename)==0){
                	$new_sitemap = '<?xml version="1.0" encoding="UTF-8"?>
									<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

									</urlset>';
                	file_put_contents($filename,$new_sitemap);
                //}
                $xml = simplexml_load_file($filename);
                unset($xml->url);
                $sxe = new SimpleXMLElement($xml->asXML());
                
                    $all_posts_data = $this->_getPostsForSitemap();
                    $all_posts = $all_posts_data['all_posts'];
                    //echo "<pre>"; var_dump($all_posts); exit;
                    foreach($all_posts as $post){
                    	
                    	foreach($post['data'] as $item_post){
                    	$postlink = $item_post['url'];
                        $postlink = str_replace('&','&amp;', $postlink);
                        
                        $url = $sxe->addChild('url');
                        $url->addChild('loc', $postlink);
                        $url->addChild('priority','0.6');
                        $url->addChild('changefreq','monthly');
                    	}
                    }
                    
                    $all_categories_data = $this->_getCategoriesForSitemap();
                    $all_categories = $all_categories_data['all_categories'];
                    //echo "<pre>"; var_dump($all_categories); exit;
                    foreach($all_categories as $cat){
                    	
                    	foreach($cat['data'] as $item_cat){
                        $catlink = $item_cat['url'];
                        $catlink = str_replace('&','&amp;', $catlink);
                        $url = $sxe->addChild('url');
                        $url->addChild('loc', $catlink);
                        $url->addChild('priority','0.6');
                        $url->addChild('changefreq','monthly');
                    	}
                    }
                    
                    $sxe->asXML($filename); 
             
    }
    
	public function getLangISO(){
    	/*$cookie = $this->context->cookie;
		$id_lang = (int)$cookie->id_lang;

        $all_laguages = Language::getLanguages(true);


        if(sizeof($all_laguages)>1)
			$iso_lang = Language::getIsoById((int)($id_lang))."/";
		else
			$iso_lang = '';
			
    	return $iso_lang;*/

        $cookie = $this->context->cookie;
        $id_lang = (int)$cookie->id_lang;

        if($this->_id_shop) {
            $all_laguages = Language::getLanguages(true,$this->_id_shop);
        } else {
            $all_laguages = Language::getLanguages(true);
        }


        if($this->isURLRewriting() && sizeof($all_laguages)>1)
            $iso_lang = Language::getIsoById((int)($id_lang))."/";
        else
            $iso_lang = '';

        return $iso_lang;


    }
    
    public function isURLRewriting(){
    	$_is_rewriting_settings = 0;
    	if(Configuration::get('PS_REWRITING_SETTINGS') && Configuration::get($this->_name.'urlrewrite_on') == 1){
			$_is_rewriting_settings = 1;
		} 
		return $_is_rewriting_settings;
    }
	
    
	public function getProducts($related_products) {

		
		
        
		if($this->_is15){
        $context = Context::getContext();
        $id_lang = $context->language->id;
		} else {
		$cookie = $this->context->cookie;	
		$id_lang = (int)$cookie->id_lang;
		}

        $query = 'SELECT distinct p.`id_product`, p.`reference`, pl.`name`, 
                    pl.`description_short`, pl.`link_rewrite`
                    FROM  `' . _DB_PREFIX_ . 'product` p 
                    LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl ON (
                            p.`id_product` = pl.`id_product`
                            AND pl.`id_lang` = ' . (int) $id_lang . '
                    )
                    
                    WHERE p.`id_product` IN('.pSQL($related_products).')';

            $query .= ' AND p.`active` = 1 ';

        $query .= ' ORDER BY pl.`name` DESC';
        return Db::getInstance()->executeS($query);
    }
    
    
public function getRelatedPosts($_data){
		$admin = isset($_data['admin'])?$_data['admin']:null;
		$items = array();
		if($admin){
			$id = isset($_data['id'])?$_data['id']:0;
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			
			$sql = '
			SELECT pc.* 
			FROM `'._DB_PREFIX_.'blog_post` pc 
			WHERE pc.status = 1 AND id != '.(int)$id.'
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops) 
			ORDER BY pc.`time_add` DESC';
			
			
			$posts = Db::getInstance()->ExecuteS($sql);
			
			
			foreach($posts as $k => $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].'
				');
				
				
				$tmp_title = '';
				$tmp_id = '';
				$tmp_time_add = '';

				// languages
				$languages_tmp_array = array();
				
				foreach ($items_data as $item_data){
					$languages_tmp_array[] = $item_data['id_lang'];
		    		
		    		$title = isset($item_data['title'])?$item_data['title']:'';
		    		$id = isset($item_data['id_item'])?$item_data['id_item']:'';
		    		$time_add = isset($posts[$k]['time_add'])?$posts[$k]['time_add']:'';
		    		
		    		if(Tools::strlen($tmp_title)==0){
		    			if(Tools::strlen($title)>0)
		    					$tmp_title = $title; 
		    		}
		    		
					if(Tools::strlen($tmp_id)==0){
		    			if(Tools::strlen($id)>0)
		    					$tmp_id = $id; 
		    		}
		    		
					if(Tools::strlen($tmp_time_add)==0){
		    			if(Tools::strlen($time_add)>0)
		    					$tmp_time_add = $time_add; 
		    		}
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    			$items[$k]['seo_url'] = $item_data['seo_url'];
		    			$items[$k]['id'] = $id;
		    			$items[$k]['time_add'] = $time_add;
		    		}
		    		
		    	}
		    	
		    	if(@Tools::strlen($items[$k]['title'])==0)
		    		$items[$k]['title'] = $tmp_title;
		    		
		    	if(@Tools::strlen($items[$k]['id'])==0)
		    		$items[$k]['id'] = $tmp_id;
		    		
		    	if(@Tools::strlen($items[$k]['time_add'])==0)
		    		$items[$k]['time_add'] = $tmp_time_add;
		    	
		    	
		    	// languages
		    	$items[$k]['ids_lng'] = $languages_tmp_array;


                $lang_for_category = array();
                foreach($languages_tmp_array as $lng_id){
                    $data_lng = Language::getLanguage($lng_id);
                    $lang_for_category[] = $data_lng['iso_code'];
                }
                $lang_for_category = implode(",",$lang_for_category);

                $items[$k]['iso_lang'] = $lang_for_category;
			}
			
			$data_count_related_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post` WHERE status = 1 
			');
			
		} else {
			
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			$related_data = $_data['related_data'];
			
			$sql = '
			SELECT pc.*,
			 (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1) as count_like,
                (select count(*) from `'._DB_PREFIX_.'blog_post_like` al where al.post_id = pc.id and al.like = 1 and ip = \''.pSQL($_SERVER['REMOTE_ADDR']).'\') as is_liked_post,
                (select count(*) as count from `'._DB_PREFIX_.'blog_comments` pcc WHERE pcc.id_post = pc.id and pcc.status = 1 and pcc.id_lang = '.$current_language.') as count_comments
			FROM `'._DB_PREFIX_.'blog_post` pc 
			WHERE pc.status = 1 AND pc.id IN('.pSQL($related_data).')
			AND FIND_IN_SET('.(int)$this->_id_shop.',pc.ids_shops) 
			ORDER BY pc.`time_add` DESC';
			
			$posts = Db::getInstance()->ExecuteS($sql);
			
			
			foreach($posts as $k => $_item){
				$items_data = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_post_data` pc
				WHERE pc.id_item = '.(int)$_item['id'].' AND id_lang='.(int)$current_language.'
				');


                if(Tools::strlen($posts[$k]['img'])>0){
                    $items[$k]['img_orig'] = $posts[$k]['img'];
                    $this->generateThumbImages(array('img'=>$posts[$k]['img'],
                            'width'=>Configuration::get($this->_name.'rp_img_width'),
                            'height'=>Configuration::get($this->_name.'rp_img_width')
                        )
                    );
                    $img = Tools::substr($posts[$k]['img'],0,-4)."-".Configuration::get($this->_name.'rp_img_width')."x".Configuration::get($this->_name.'rp_img_width').".jpg";
                } else {
                    $img = $posts[$k]['img'];
                }

                $items[$k]['img'] = $img;
				
				$tmp_title = '';
				$tmp_id = '';
				$tmp_time_add = '';

				
				foreach ($items_data as $item_data){
					
		    		$title = isset($item_data['title'])?$item_data['title']:'';
		    		$id = isset($item_data['id_item'])?$item_data['id_item']:'';
		    		$time_add = isset($posts[$k]['time_add'])?$posts[$k]['time_add']:'';
		    		
		    		if(Tools::strlen($tmp_title)==0){
		    			if(Tools::strlen($title)>0)
		    					$tmp_title = $title; 
		    		}
		    		
					if(Tools::strlen($tmp_id)==0){
		    			if(Tools::strlen($id)>0)
		    					$tmp_id = $id; 
		    		}
		    		
					if(Tools::strlen($tmp_time_add)==0){
		    			if(Tools::strlen($time_add)>0)
		    					$tmp_time_add = $time_add; 
		    		}
		    		
		    		if($current_language == $item_data['id_lang']){
		    			$items[$k]['title'] = $item_data['title'];
		    			$items[$k]['seo_url'] = $item_data['seo_url'];
		    			$items[$k]['id'] = $id;
		    			$items[$k]['time_add'] = $time_add;
		    		}
		    		
		    	}
		    	
		    	if(@Tools::strlen($items[$k]['title'])==0)
		    		$items[$k]['title'] = $tmp_title;
		    		
		    	if(@Tools::strlen($items[$k]['id'])==0)
		    		$items[$k]['id'] = $tmp_id;
		    		
		    	if(@Tools::strlen($items[$k]['time_add'])==0)
		    		$items[$k]['time_add'] = $tmp_time_add;

                $items[$k]['count_like'] = $posts[$k]['count_like'];
                $items[$k]['is_liked_post'] = $posts[$k]['is_liked_post'];
                $items[$k]['count_comments'] = $posts[$k]['count_comments'];


		    	
		    	
		  	}
			
			$data_count_related_posts = Db::getInstance()->getRow('
			SELECT COUNT(`id`) AS "count"
			FROM `'._DB_PREFIX_.'blog_post` WHERE status = 1  AND FIND_IN_SET('.(int)$this->_id_shop.',ids_shops) 
			');	
		} 
		
		
		return array('related_posts' => $items, 'count_all' => $data_count_related_posts['count'] );
	}
	
	
	public function displayDateField($name, $value, $title, $description ) {
        $opt_defaults = array('class' => '', 'required' => false);
        $opt = $opt_defaults;

        $content = '<label style="width:120px"> ' . $title . ' </label>
                                    <div class="margin-form" style="padding: 0pt 0pt 10px 130px;">
                                       <input type="text" name="' . $name . '" value="' . $value . '" class="datepicker ' . $opt['class'] . '" />';

        
        if (!is_null($description) && !empty($description)) {
            $content .= '<p class="preference_description">' . $description . '</p>';
        }

        $content .= '</div>';

        return $content;
    }
    
    public function getSiteURL($id_shop = null){
    	$http_host = $this->_http_host;
    	$uri = '';
    	if(Tools::strlen($id_shop)!=0){
    		$shops = Shop::getShops(false);
			foreach($shops as $shop){
				if($id_shop == $shop['id_shop']){
					$uri = $shop['uri'];
					$uri = Tools::substr($uri, 1);
					break;
				}
			}
    	}
				
    	return $http_host.$uri;
    }
    
    
	public function productData($data){
		$product = $data['product'];
        $is_related_products = isset($data['is_related_products'])?$data['is_related_products']:0;
		
		
		if(is_object($product) && !empty($product->id)){
			
		$cookie = $this->context->cookie;
		$id_lang = (int)($cookie->id_lang);	
		
			/* Product URL */
			if (version_compare(_PS_VERSION_, '1.5', '>'))
				$link = Context::getContext()->link;
			else
				$link = new Link();
				
			$category = new Category((int)($product->id_category_default), $id_lang);

            if (version_compare(_PS_VERSION_, '1.5.5', '>=')) {
                   $product_url = $link->getProductLink((int)$product->id, null, null, null, 
                    									 $id_lang, null, 0, false);
             }
             elseif (version_compare(_PS_VERSION_, '1.5', '>')) {
               if (Configuration::get('PS_REWRITING_SETTINGS')) {
                     $product_url = $link->getProductLink((int)$product->id, null, null, null, 
                     									 $id_lang, null, 0, true);
               }
                else {
                    $product_url = $link->getProductLink((int)$product->id, null, null, null, 
                     									 $id_lang, null, 0, false);
                 }
            }
            else {
                  $product_url = $link->getProductLink((int)$product->id, @$product->link_rewrite[$id_lang], 
                 									 $category->link_rewrite, $product->ean13, $id_lang);
            }
            
            
			if (version_compare(_PS_VERSION_, '1.5', '>'))
				$link = Context::getContext()->link;
			else
				$link = new Link();

			/* Image */
			$image = Image::getCover((int)($product->id));

			if ($image)
			{

                if($is_related_products){
                    $type_img = Configuration::get($this->_name.'img_size_rp');
                } else {
                    $available_types = ImageType::getImagesTypes('products');

                    foreach ($available_types as $type) {
                        $width = $type['width'];

                        if (version_compare(_PS_VERSION_, '1.5', '>')) {
                            if ($width < 400) {
                                $type_img = $type['name'];
                                break;
                            }
                        } else {
                            if ($width < 100) {
                                $type_img = $type['name'];
                                break;
                            }
                        }
                    }
                }
					$image_link = $link->getImageLink(@$product->link_rewrite[$id_lang], (int)($product->id).'-'.(int)($image['id_image']),$type_img);
			
				/* version 1.4 */
				if (strpos($image_link, 'http://') === FALSE && strpos($image_link, 'https://') === FALSE && version_compare(_PS_VERSION_, '1.4', '<'))
				{
					$image_link = 'http://'.$_SERVER['HTTP_HOST'].$image_link;
				}
			}
			else
			{
				$image_link = false;
				
			}
			
			}else {
				$image_link= false;
				$product_url = false;
			}
            
            return array('product_url'=>$product_url,'image_link'=>$image_link);
	}
	
	public function getRelatedProducts($data){
		$cookie = $this->context->cookie;
		$id_lang = (int)($cookie->id_lang);
		
		$related_data = explode(",",$data['related_data']);
		
		$data_products = array();
		
		foreach($related_data as $_product_id){
			
		if($_product_id != 0){	
			$_obj_product = new Product($_product_id,false,$id_lang);
	    	
	    	$data_product = $this->productData(array('product'=>$_obj_product,'is_related_products'=>1));
			
	    	$picture = $data_product['image_link'];
			$product_url = $data_product['product_url'];
	    		
	    	$productname = ($_obj_product->name);
	    	
	    	$desc = ($_obj_product->description_short != "") ? $_obj_product->description_short : $_obj_product->description;
	    	$desc = (strip_tags($desc));
			
	    	$data_products[] = array('title'=>$productname,'description'=>$desc,'picture'=>$picture,'product_url'=>$product_url);
		}
		
		}
		return $data_products;
	}
	
	public function getRelatedPostsForPost($data){
		
			$related_data = $data['related_data'];
			$post_id = $data['post_id'];
		
			$data_rel_posts  = $this->getRelatedPosts(array('id'=>$post_id,'related_data'=>$related_data)); 
				
			$data_posts = array();
			
			foreach($data_rel_posts['related_posts'] as $_item){
				$name = isset($_item['title'])?$_item['title']:'';
				$id_post = isset($_item['id'])?$_item['id']:'';
				$seo_url = $_item['seo_url'];
                $count_like = $_item['count_like'];
                $is_liked_post = $_item['is_liked_post'];
                $count_comments = $_item['count_comments'];
                $time_add = $_item['time_add'];
                $img = $_item['img'];


				$data_posts[] = array('title'=>$name,'seo_url'=>$seo_url,'id'=>$id_post,
                                      'count_like'=>$count_like,
                                      'is_liked_post'=>$is_liked_post,
                                      'count_comments'=>$count_comments,
                                        'time_add'=>$time_add, 'img'=>$img,
                                    );
		       
			}
		
		return $data_posts;
	}
	
	public function getLastComments($data = null){
			$cookie = $this->context->cookie;
			$current_language = (int)$cookie->id_lang;
			
			$is_page = isset($data['is_page'])?$data['is_page']:0;
			$count_all = 0;
			
			if($is_page ==1){
				$start = $data['start'];
				$step = $data['step'];			
					
				$comments = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_comments` pc
				WHERE status = 1 and id_lang = '.(int)$current_language.' 
				and pc.id_shop = '.(int)$this->_id_shop.'
				ORDER BY pc.`time_add` DESC LIMIT '.(int)$start.' ,'.(int)$step.'');
	
				foreach($comments as $k=>$comment){
					$id_post = $comment['id_post'];
					$_info_post = $this->getPostItem(array('id' => $id_post,'site'=>1));
					
					$seo_url = isset($_info_post['post'][0]['seo_url'])?$_info_post['post'][0]['seo_url']:'';
					$title = isset($_info_post['post'][0]['title'])?$_info_post['post'][0]['title']:'';
					$comments[$k]['post_seo_url'] = $seo_url;
					$comments[$k]['post_title'] = $title;
					$comments[$k]['post_id'] = $id_post;
					
				}
				
				
				$data_count_com = Db::getInstance()->getRow('
				SELECT COUNT(*) AS "count"
				FROM `'._DB_PREFIX_.'blog_comments` pc
				WHERE status = 1 and id_lang = '.(int)$current_language.' 
				and pc.id_shop = '.(int)$this->_id_shop.'
				');
				
				$count_all = $data_count_com['count'];
			
			} else {
				
				$limit = (int)Configuration::get($this->_name.'blog_com');
				
				$comments = Db::getInstance()->ExecuteS('
				SELECT pc.*
				FROM `'._DB_PREFIX_.'blog_comments` pc
				WHERE status = 1 and id_lang = '.(int)$current_language.' 
				and pc.id_shop = '.(int)$this->_id_shop.'
				ORDER BY pc.`time_add` DESC LIMIT '.(int)$limit);
	
				foreach($comments as $k=>$comment){
					$id_post = $comment['id_post'];
					$_info_post = $this->getPostItem(array('id' => $id_post,'site'=>1));
					
					$seo_url = isset($_info_post['post'][0]['seo_url'])?$_info_post['post'][0]['seo_url']:'';
					$comments[$k]['post_seo_url'] = $seo_url;
					$comments[$k]['post_id'] = $id_post;
					
				}
			}
		return array('comments' => $comments,'count_all'=>$count_all);
	}

    public function getSEOURLs(){
        $iso_code = $this->getLangISO();

        if(Configuration::get($this->_name.'urlrewrite_on')==1){


            $categories_url = $this->getHttpost() . $iso_code. 'blog/categories';
            $category_url = $this->getHttpost() . $iso_code. 'blog/category/';

            $posts_url = $this->getHttpost() . $iso_code. 'blog';
            $post_url = $this->getHttpost() .  $iso_code.'blog/post/';

            $comments_url = $this->getHttpost() . $iso_code. 'blog/comments';

        } else {

                $categories_url = $this->getHttpost() . 'modules/' . $this->_name . '/blockblog-categories.php';
                $category_url = $this->getHttpost() . 'modules/' . $this->_name . '/blockblog-category.php';

                $posts_url = $this->getHttpost() . 'modules/' . $this->_name . '/blockblog-all-posts.php';
                $post_url = $this->getHttpost() . 'modules/' . $this->_name . '/blockblog-post.php';

                $comments_url = $this->getHttpost() . 'modules/' . $this->_name . '/blockblog-all-comments.php';

        }



        return array(
                     'categories_url' => $categories_url, 'category_url'=>$category_url,
                     'posts_url'=>$posts_url, 'post_url'=>$post_url,
                     'comments_url'=>$comments_url
                    );
    }

    public function getHttpost(){
        if(version_compare(_PS_VERSION_, '1.5', '>')){
            $custom_ssl_var = 0;
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
                $custom_ssl_var = 1;


            if ((bool)Configuration::get('PS_SSL_ENABLED') || $custom_ssl_var == 1 || (bool)Configuration::get('PS_SSL_ENABLED_EVERYWHERE'))
                $_http_host = _PS_BASE_URL_SSL_.__PS_BASE_URI__;
            else
                $_http_host = _PS_BASE_URL_.__PS_BASE_URI__;

        } else {
            $_http_host = _PS_BASE_URL_.__PS_BASE_URI__;
        }
        return $_http_host;
    }

    public function like($data){
        $like = $data['like'];
        $id = $data['id'];
        $ip = $data['ip'];
        $sql_exists = "select count(*) as count from `"._DB_PREFIX_."blog_post_like` where ip = '{$ip}' and post_id = ".$id." and `like` = ".$like;
        $is_exists = Db::getInstance()->getRow($sql_exists);


        $error = 'error';

        include_once(dirname(__FILE__).'/../blockblog.php');
        $obj = new blockblog();
        $_data_translate = $obj->translateItems();
        $message = htmlspecialchars($_data_translate['message_like']);

        $count = 0;

        if($is_exists['count'] == 0){
            $error = 'success';
            $message = "";
            $sql = "insert into `"._DB_PREFIX_."blog_post_like` set post_id = ".$id.", `like` = ".$like.", ip = '{$ip}'";
            Db::getInstance()->Execute($sql);

            $sql_count_likes = "select count(*) as count from `"._DB_PREFIX_."blog_post_like` where post_id = ".$id." and `like` = ".$like;
            $count_likes = Db::getInstance()->getRow($sql_count_likes);
            $count = $count_likes['count'];
        }

        return array('error'=>$error, 'message'=>$message, 'count'=>$count);
    }


}