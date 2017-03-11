/**
* 2007-2015 PrestaShop
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
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/
$(document).ready(function() {

	// if welcome screen mobule
	if ($('#wsc_video_container').length) {
		$('div #wsc_video_container').prependTo('body');

		// if there is a video background
		if ($('#wsc_video_container video').length) {
			$('#wsc_video_container video').get(0).play();

			$("#wsc_video_container video").bind("loadedmetadata", function () {
				$(this).data('height', $(this).height());
				$(this).data('width', $(this).width());
				//console.log("videoWidth: "+$(this).data('width'));
				//console.log("videoHeight: "+$(this).data('height'));

				scaleBannerVideoSize('#wsc_video_container video');
			});

			$(window).on('resize', function() {
				scaleBannerVideoSize('#wsc_video_container video');
			});
			console.log('video');
		};

		// goes to content on click
		$('.wsc_scroll_button').click(function() {
			$("html, body").stop().animate({scrollTop:$(window).height()}, '750', 'linear');
		});
		// goes to content on scroll
		var lastScrollTop = 0, delta = 5;
		$(window).scroll(function() {
			var nowScrollTop = $(this).scrollTop();
			if(lastScrollTop == 0) {
				$("html, body").stop().animate({scrollTop:$(window).height()}, '1000', 'linear');
			}
			/*else if(lastScrollTop == $(window).height() && nowScrollTop < lastScrollTop) {
				$("html, body").stop().animate({scrollTop:0}, '1000', 'linear');
			}*/;
			lastScrollTop = nowScrollTop;
		});
	};

});

function scaleBannerVideoSize(element){

	var windowWidth = $(window).width(),
	windowHeight = $(window).height() + 5,
	videoWidth,
	videoHeight;

	$(element).each(function(){
		var videoAspectRatio = $(this).data('height')/$(this).data('width');
		console.log("videoAspectRatio: "+videoAspectRatio);

		videoHeight = windowHeight;
		videoWidth = videoHeight / videoAspectRatio;
		if (videoWidth < windowWidth) {
			videoWidth = windowWidth;
			videoHeight = videoWidth * videoAspectRatio;
		}
		$(this).css({'margin-top' : -(videoHeight - windowHeight) / 2 + 'px', 'margin-left' : -(videoWidth - windowWidth) / 2 + 'px'});

		$(this).width(videoWidth).height(videoHeight);

	});
}