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
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

$(document).ready(function(){

	if (typeof(ebhomepromos_speed) == 'undefined')
		ebhomepromos_speed = 500;
	if (typeof(ebhomepromos_pause) == 'undefined')
		ebhomepromos_pause = 3000;
	if (typeof(ebhomepromos_loop) == 'undefined')
		ebhomepromos_loop = true;
    if (typeof(ebhomepromos_width) == 'undefined')
        ebhomepromos_width = 400;


	if (!!$.prototype.bxSlider)
		$('#ebhomepromos').bxSlider({
			minSlides: 2,
			maxSlides: 10,
			slideMargin: 10,
			useCSS: false,
			slideWidth: ebhomepromos_width,
			infiniteLoop: ebhomepromos_loop,
			hideControlOnEnd: true,
			pager: true, 
			autoHover: true,
			auto: ebhomepromos_loop,
			speed: ebhomepromos_speed,
			pause: ebhomepromos_pause,
			controls: false
		});

    $('.ebhomepromos-description').click(function () {
        window.location.href = $(this).prev('a').prop('href');
    });
});