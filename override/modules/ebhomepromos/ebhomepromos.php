<?php
/*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

/**
 * @since   1.5.0
 * @version 1.3 (2012-03-14)
 */

if (!defined('_PS_VERSION_'))
	exit;

class EbHomePromosOverride extends EbHomePromos
{

	public function getSlides($active = null)
	{
		$this->context = Context::getContext();
		$id_shop = $this->context->shop->id;
		$id_lang = $this->context->language->id;

		$arr = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS(
					'SELECT pc.`id` as id_slide,
										   pc.`img`,
										   pc.`status`,
										   pc_d.`title`,
										   pc_d.`seo_url`,
										   pc_d.`content`
								FROM '._DB_PREFIX_.'blog_post pc
					LEFT JOIN `'._DB_PREFIX_.'blog_post_data` pc_d
					on(pc.id = pc_d.id_item)
					WHERE pc.ids_shops = '.(int)$id_shop.'
					AND pc_d.id_lang = '.(int)$id_lang.
					' ORDER BY pc.time_add DESC'
		);

         $news = array();
         if(count($arr) > 0) {
         	foreach($arr as $r) {

               $img_name = substr($r['img'],0,strrpos($r['img'], "."));
               $ext = substr(strrchr($r['img'], "."), 1);

               $maxwords = 40;
               $maxchar=280;
               $content = $this->getPrewText($r['content'],$maxwords,$maxchar) ;

               $news[] = array(
               'id_slide' => $r['id_slide'],
               'image' => $img_name . '-500x500.'.$ext,
               'position' => 0,
               'active' => 1,
               'title' => $r['title'],
               'url' => 'http://'.$_SERVER['SERVER_NAME'].'/modules/blockblog/blockblog-post.php?post_id='.$r['id_slide'],
               'legend' => $r['seo_url'],
               'description' =>$content
               );
         	}
         }

		return $news;

	}

	public function _prepareHookHome()
	{
		//if (!$this->isCached('ebhomepromos.tpl', $this->getCacheId()))
		//{
			$slider = array(
				'width' => Configuration::get('EBHOMEPROMOS_WIDTH'),
				'speed' => Configuration::get('EBHOMEPROMOS_SPEED'),
				'pause' => Configuration::get('EBHOMEPROMOS_PAUSE'),
				'loop' => Configuration::get('EBHOMEPROMOS_LOOP'),
			);

			$slides = $this->getSlides(true);

			if (is_array($slides))
				foreach ($slides as &$slide)
				{
					$slide['sizes'] = @getimagesize($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'upload' . DIRECTORY_SEPARATOR. 'blockblog'.DIRECTORY_SEPARATOR.$slide['image']);
					if (isset($slide['sizes'][3]) && $slide['sizes'][3])
						$slide['size'] = $slide['sizes'][3];
						//$slide['size'] = 'height="500px" width="500px"';
				}

			if (!$slides)
				return false;

			$this->smarty->assign('ebhomepromos_slides', $slides);
			$this->smarty->assign('ebhomepromos', $slider);
		//}

		return true;
	}


	public function hookDisplayHome()
	{
		if (!$this->_prepareHookHome())
			return false;

		return $this->display(__FILE__, 'ebhomepromos.tpl', $this->getCacheId());
	}


	public function getPrewText($text,$maxwords=60,$maxchar=50) {

		$text=strip_tags($text);
		$words=split(' ',$text);
		$text='';
		foreach ($words as $word) {
			if (mb_strlen($text.' '.$word)<$maxchar) {
				$text.=' '.$word;
			}
			else {
				$text.='...';
				break;
			}
		}
		return $text;
	}
}
