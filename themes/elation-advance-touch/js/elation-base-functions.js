/* 
  ***************************************************************************************************
  * ELATION ADVANCE TOUCH THEME - CSS
  * (c) elation3ase, elationbase.com
  * (i) elationbase@gmail.com
  * See licence agreement in theme's root (licence.txt)
  ***************************************************************************************************
 */

// remap jQuery to $
(function($){
//global variables
var winWidth = $(window).width();
var winHeight = $(window).height();

// Sticky Header function 
function stickyTop(){
	
	if ( $("body").is("#index") ) {
		var navbar = $("#eb-top");
		navbar.addClass('upnav');
		
		if ( winWidth < winHeight ){
			navbar.css("bottom", winHeight /3);
		}
		
		var objDistance = navbar.offset().top -71;
		
		$(window).scroll(function() {
			var myDistance = $(window).scrollTop();
			if (myDistance -20 > objDistance){
				navbar.addClass('sticky animate-slow');
			}
			if (objDistance + 55 > myDistance){
				navbar.removeClass('sticky animate-slow');
				$("body").removeClass("open-nav");
			}
		});
		var objDistance2 = navbar.offset().top /2;
		$(window).scroll(function() {
			var myDistance = $(window).scrollTop();
			if (myDistance > objDistance2){
				navbar.addClass('downnav');
				navbar.removeClass('upnav');
			}
			if (objDistance2 > myDistance){
				navbar.removeClass('downnav');
				navbar.addClass('upnav');
			}
		});
		
	}
}
function showHideBreadcrumbs () {
	var $breadcrumbHeight = $(".breadcrumb").height();
	var $firstHeight = $(".breadcrumb a:first-child").height();
	var $body = $("body");
	if ( !$body.is("#my-account, #search, #supplier, #cms, #prices-drop, #new-products, #best-sales, #stores, #contact, #sitemap, #manufacturer, #authentication, #order") ) {
		if ( $breadcrumbHeight > $firstHeight) {
			$(".breadcrumb").hide();
		} else {
			$(".breadcrumb").show();
		}
	}
}

// Set the heigfht of the category image
function catImageHeight (){
	if ( $("body").is("#category") ) {
		var catHeight = winHeight / 2;
		var catDesHeight = $(".cat_desc").height();
		$(".content_scene_cat_bg").css("height", catHeight);
		
		if ( catHeight > catDesHeight ) {
			$(".cat_desc").css("margin-top", (catHeight - catDesHeight) /2);
		};
	};
}
// Parallax effect on homepage sections
function moveBackground () {
	$('.eb-home-block, .content_scene_cat_bg').each(function(){
		var $bgobj = $(this); 
		var $window = $(window);
		$(window).scroll(function() {
			var yPos = -( ($window.scrollTop() - $bgobj.offset().top) / 2);
			var coords = '50% '+ yPos + 'px';
			$bgobj.css({ backgroundPosition: coords });
		});
	});
}

// Check if is touch device
function is_touch_device() { 
	try {  
		document.createEvent("TouchEvent");  
		return true;  
	} catch (e) {  
		return false;  
	}  
}

//  Window Scroll to selectors
function scroller (ele,time){
	$('html, body').animate({
		scrollTop: $(ele).offset().top-50
	}, time);
}

// Scroll top
function scrollTop () {
	$(window).scroll(function(){
		var eleTop 		= $('.top');
		var y 			= $(window).scrollTop();
		if (y > 200)	{ eleTop.fadeIn(400); } 
		else 			{ eleTop.fadeOut(400); };
	});
	$(".top").click(function (event) {
		event.preventDefault();
		$('body,html').animate({ scrollTop: 0 }, 800);
	});
}

$(document).ready(function() {
	/* Call above functions */
	// Sticky Header call 
	stickyTop();
	// Hide Breadcrubms call 
	showHideBreadcrumbs ();
	// Call heigfht of the category image function
	catImageHeight ();
	// Scroll top call
	scrollTop ();
	// Parallax effect call for non-touch devices
	if (!is_touch_device()) {
		moveBackground ();
	}
	
	// Close Alert messages
	$(".alert").on('click', this, function(e){
		e.preventDefault();
		$(this).fadeOut();
	});

	// Expand / Colapse Navigation
	$("#eb-top").on("click", ".trigger-nav", function (event){
		event.preventDefault();
		if ( $("body").is("#index") && !$("#eb-top").hasClass("sticky") && !$("body").hasClass("open-nav") ) { 
			scroller ("#center_column",600);
			setTimeout(function() {
				$("body").addClass("open-nav");
			}, 700);
		} else {
			if ( $("body").hasClass("open-nav") ) {
				//$(".eb-top-nav-wrapper").stop(true).fadeOut();
				//$(".eb-nav").removeClass("nav-on");
				$("body").removeClass("open-nav");
				
			} else {
				//$(".eb-top-nav-wrapper").stop(true).fadeIn();
				//$(".eb-nav").addClass("nav-on");
				$("body").addClass("open-nav");
				//$("#cart_block").stop(true).fadeOut();
			}
		}
	});
	// Colapse Navigation on keypress escape
	$(document).keyup(function(event) {
		if ( $("body").hasClass("open-nav") ) {
			if (event.keyCode == 27) { 
				$("body").removeClass("open-nav");
				//$(".eb-nav").removeClass("nav-on ");
			} 
		}
	});
	
	// Expand Shopping Cart
	$("#shopping_cart > a:first-child").on("click", function (event){
		event.preventDefault();
		if ( !$("#cart_block").is(":visible") ) {
			$("#cart_block").stop(true).fadeIn();
			//$(".eb-top-nav-wrapper").stop(true).fadeOut();
			//$(".eb-nav").removeClass("nav-on");
			//$("body").removeClass("open-nav");
		} else {
			$("#cart_block").stop(true).fadeOut();
		}
	});
	
	
	// Call Subcategory carrusel
	$("#subcategories ul").bxSlider({
		minSlides: 2,
		maxSlides: 4,
		slideWidth: 375,
		slideMargin: 10,
		infiniteLoop: false,
		hideControlOnEnd: true,
		controls: false
	});


	// Call thumbnails carrusel
	$("#thumbs_list ul").bxSlider({
		minSlides: 2,
		maxSlides: 15,
		slideWidth: 150,
		slideMargin: 1,
		infiniteLoop: false,
		pager: false,
		hideControlOnEnd: true
	});
	
	// Call Producs Category carrusel
	$('#productscategory_list ul').bxSlider({
		minSlides: 2,
		maxSlides: 15,
		slideWidth: 150,
		slideMargin: 1,
		pager: false,
		nextText: '',
		prevText: '',
		infiniteLoop:false,
		hideControlOnEnd: true,
		pager: true,
		controls: false
	});
	
	// Call Easyzoom for product zoom
	if (typeof(jqZoomEnabled) != 'undefined' && jqZoomEnabled)
	{
		 //initiate the plugin and pass the id of the div containing gallery images
		 if (is_touch_device()) {
			 // call elevateZoom for touch devices
			$("#img_01").elevateZoom({
				gallery:'thumbs_list_frame', 
				galleryActiveClass: 'active', 
				imageCrossfade: true, 
				cursor: "crosshair",
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 0,
				zoomType: "inner"
			}); 
		} else {
			// call elevateZoom for the rest
			 $("#img_01").elevateZoom({
				gallery:'thumbs_list_frame', 
				galleryActiveClass: 'active', 
				imageCrossfade: true, 
				cursor: "crosshair",
				zoomWindowFadeIn: 500,
				zoomWindowFadeOut: 0,
				zoomType: "lens",
				lensShape : "round",
				lensSize: 240
			}); 
		}
		//pass the images to Fancybox
		$("#view_full_size img").bind("click", function(e) {
			var ez =   $('#view_full_size img').data('elevateZoom');	
			$.fancybox(ez.getGalleryList());
			return false;
		});
	}
	
	$(".comments_advices a.reviews").on("click", function(event){
		event.preventDefault();
		scroller ("#idTab5", 800);
	});
	$(".languages-block .current, #currencies-block-top .current").on("click", function(){
		if ( $("#cart_block").is(":visible") ) {
			$("#cart_block").fadeOut(400);
		}
	});
	

});  
	
$(window).load(function() {
	$(".bx-pager-link").addClass("animate-fast");
	if (!is_touch_device()) {
		$('.tooltip').tooltipster({animation: "grow"});
		$(".addthis_internal_container a").tooltipster({animation: "fall", position: "left"});
		$(".breadcrumb a.home").tooltipster({animation: "grow", position: "bottom-left", offsetY: -7, offsetX: 5});
		$('.product_list a.button').tooltipster({animation: "grow", offsetY: -5});
		
	}
	// Hide bxSlider pages if only one exist 
	if ($(".bx-pager .bx-pager-item").length == 1) { $(".bx-pager").hide(); }
});

$(window).resize(function() {
	var $breadcrumbHeight = $(".breadcrumb").height();
	var $firstHeight = $(".breadcrumb a:first-child").height();
	catImageHeight ();
	showHideBreadcrumbs ();
});
})(window.jQuery);




/* QUICK BUY */
/*
* debouncedresize: special jQuery event that happens once after a window resize
*
* latest version and complete README available on Github:
* https://github.com/louisremi/jquery-smartresize/blob/master/jquery.debouncedresize.js
*
* Copyright 2011 @louis_remi
* Licensed under the MIT license.
*/
var $event = $.event,
$special,
resizeTimeout;

$special = $event.special.debouncedresize = {
	setup: function() {
		$( this ).on( "resize", $special.handler );
	},
	teardown: function() {
		$( this ).off( "resize", $special.handler );
	},
	handler: function( event, execAsap ) {
		// Save the context
		var context = this,
			args = arguments,
			dispatch = function() {
				// set correct event type
				event.type = "debouncedresize";
				$event.dispatch.apply( context, args );
			};

		if ( resizeTimeout ) {
			clearTimeout( resizeTimeout );
		}

		execAsap ?
			dispatch() :
			resizeTimeout = setTimeout( dispatch, $special.threshold );
	},
	threshold: 350
};

// ======================= imagesLoaded Plugin ===============================
// https://github.com/desandro/imagesloaded

// $('#my-container').imagesLoaded(myFunction)
// execute a callback when all images have loaded.
// needed because .load() doesn't work on cached images

// callback function gets image collection as argument
//  this is the container

// original: MIT license. Paul Irish. 2010.
// contributors: Oren Solomianik, David DeSandro, Yiannis Chatzikonstantinou

// blank image data-uri bypasses webkit log warning (thx doug jones)
var BLANK = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==';

$.fn.imagesLoaded = function( callback ) {
	var $this = this,
		deferred = $.isFunction($.Deferred) ? $.Deferred() : 0,
		hasNotify = $.isFunction(deferred.notify),
		$images = $this.find('img').add( $this.filter('img') ),
		loaded = [],
		proper = [],
		broken = [];

	// Register deferred callbacks
	if ($.isPlainObject(callback)) {
		$.each(callback, function (key, value) {
			if (key === 'callback') {
				callback = value;
			} else if (deferred) {
				deferred[key](value);
			}
		});
	}

	function doneLoading() {
		var $proper = $(proper),
			$broken = $(broken);

		if ( deferred ) {
			if ( broken.length ) {
				deferred.reject( $images, $proper, $broken );
			} else {
				deferred.resolve( $images );
			}
		}

		if ( $.isFunction( callback ) ) {
			callback.call( $this, $images, $proper, $broken );
		}
	}

	function imgLoaded( img, isBroken ) {
		// don't proceed if BLANK image, or image is already loaded
		if ( img.src === BLANK || $.inArray( img, loaded ) !== -1 ) {
			return;
		}

		// store element in loaded images array
		loaded.push( img );

		// keep track of broken and properly loaded images
		if ( isBroken ) {
			broken.push( img );
		} else {
			proper.push( img );
		}

		// cache image and its state for future calls
		$.data( img, 'imagesLoaded', { isBroken: isBroken, src: img.src } );

		// trigger deferred progress method if present
		if ( hasNotify ) {
			deferred.notifyWith( $(img), [ isBroken, $images, $(proper), $(broken) ] );
		}

		// call doneLoading and clean listeners if all images are loaded
		if ( $images.length === loaded.length ){
			setTimeout( doneLoading );
			$images.unbind( '.imagesLoaded' );
		}
	}

	// if no images, trigger immediately
	if ( !$images.length ) {
		doneLoading();
	} else {
		$images.bind( 'load.imagesLoaded error.imagesLoaded', function( event ){
			// trigger imgLoaded
			imgLoaded( event.target, event.type === 'error' );
		}).each( function( i, el ) {
			var src = el.src;

			// find out if this image has been already checked for status
			// if it was, and src has not changed, call imgLoaded on it
			var cached = $.data( el, 'imagesLoaded' );
			if ( cached && cached.src === src ) {
				imgLoaded( el, cached.isBroken );
				return;
			}

			// if complete is true and browser supports natural sizes, try
			// to check for image status manually
			if ( el.complete && el.naturalWidth !== undefined ) {
				imgLoaded( el, el.naturalWidth === 0 || el.naturalHeight === 0 );
				return;
			}

			// cached images don't fire load sometimes, so we reset src, but only when
			// dealing with IE, or image is complete (loaded) and failed manual check
			// webkit hack from http://groups.google.com/group/jquery-dev/browse_thread/thread/eee6ab7b2da50e1f
			if ( el.readyState || el.complete ) {
				el.src = BLANK;
				el.src = src;
			}
		});
	}

	return deferred ? deferred.promise( $this ) : $this;
};

var Grid = (function() {

		// list of items
	var $grid = $( '#eb-grid' ),
		// the items
		$items = $grid.children( 'li' ),
		// current expanded item's index
		current = -1,
		// position (top) of the expanded item
		// used to know if the preview will expand in a different row
		previewPos = -1,
		// extra amount of pixels to scroll the window
		scrollExtra = 0,
		// extra margin when expanded (between preview overlay and the next items)
		marginExpanded = 10,
		$window = $( window ), winsize,
		$body = $( 'html, body' ),
		// transitionend events
		transEndEventNames = {
			'WebkitTransition' : 'webkitTransitionEnd',
			'MozTransition' : 'transitionend',
			'OTransition' : 'oTransitionEnd',
			'msTransition' : 'MSTransitionEnd',
			'transition' : 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		// support for csstransitions
		support = Modernizr.csstransitions,
		// default settings
		settings = {
			minHeight : 500,
			speed : 350,
			easing : 'ease'
		};

	function init( config ) {
		
		// the settings..
		settings = $.extend( true, {}, settings, config );

		// preload all images
		$grid.imagesLoaded( function() {

			// save item´s size and offset
			saveItemInfo( true );
			// get window´s size
			getWinSize();
			// initialize some events
			initEvents();

		} );

	}

	// add more items to the grid.
	// the new items need to appended to the grid.
	// after that call Grid.addItems(theItems);
	function addItems( $newitems ) {

		$items = $items.add( $newitems );

		$newitems.each( function() {
			var $item = $( this );
			$item.data( {
				offsetTop : $item.offset().top,
				height : $item.height()
			} );
		} );

		initItemsEvents( $newitems );

	}

	// saves the item´s offset top and height (if saveheight is true)
	function saveItemInfo( saveheight ) {
		$items.each( function() {
			var $item = $( this );
			$item.data( 'offsetTop', $item.offset().top );
			if( saveheight ) {
				$item.data( 'height', $item.height() );
			}
		} );
	}

	function initEvents() {
		
		// when clicking an item, show the preview with the item´s info and large image.
		// close the item if already expanded.
		// also close if clicking on the item´s cross
		initItemsEvents( $items );
		
		// on window resize get the window´s size again
		// reset some values..
		$window.on( 'debouncedresize', function() {
			
			scrollExtra = 0;
			previewPos = -1;
			// save item´s offset
			saveItemInfo();
			getWinSize();
			var preview = $.data( this, 'preview' );
			if( typeof preview != 'undefined' ) {
				hidePreview();
			}

		} );

	}

	function initItemsEvents( $items ) {
		$items.on( 'click', 'span.eb-close', function() {
			hidePreview();
			return false;
		} ).children( 'a.quick-buy' ).on( 'click', function(e) {

			var $item = $( this ).parent();
			// check if item already opened
			current === $item.index() ? hidePreview() : showPreview( $item );
			return false;

		} );
	}

	function getWinSize() {
		winsize = { width : $window.width(), height : $window.height() };
	}

	function showPreview( $item ) {

		var preview = $.data( this, 'preview' ),
			// item´s offset top
			position = $item.data( 'offsetTop' );

		scrollExtra = 0;

		// if a preview exists and previewPos is different (different row) from item´s top then close it
		if( typeof preview != 'undefined' ) {

			// not in the same row
			if( previewPos !== position ) {
				// if position > previewPos then we need to take te current preview´s height in consideration when scrolling the window
				if( position > previewPos ) {
					scrollExtra = preview.height;
				}
				hidePreview();
			}
			// same row
			else {
				preview.update( $item );
				return false;
			}
			
		}

		// update previewPos
		previewPos = position;
		// initialize new preview for the clicked item
		preview = $.data( this, 'preview', new Preview( $item ) );
		// expand preview overlay
		preview.open();

	}

	function hidePreview() {
		current = -1;
		var preview = $.data( this, 'preview' );
		preview.close();
		$.removeData( this, 'preview' );
	}

	// the preview obj / overlay
	function Preview( $item ) {
		this.$item = $item;
		this.expandedIdx = this.$item.index();
		this.create();
		this.update();
	}

	Preview.prototype = {
		create : function() {
			// create Preview structure:
			//this.$title = $( '<h3></h3>' );
			this.$description = $( '<p></p>' );
			//this.$href = $( '<a href="#">Visit website</a>' );
			this.$details = $( '<div class="eb-details"></div>' ).append( this.$description );
			this.$loading = $( '<div class="eb-loading"></div>' );
			this.$fullimage = $( '<div class="eb-fullimg"></div>' ).append( this.$loading );
			this.$closePreview = $( '<span class="eb-close animate-fast"></span>' );
			this.$previewInner = $( '<div class="eb-expander-inner"></div>' ).append( this.$closePreview, this.$details );
			this.$previewEl = $( '<div class="eb-expander"></div>' ).append( this.$previewInner );
			// append preview element to the item
			this.$item.append( this.getEl() );
			// set the transitions for the preview and the item
			if( support ) {
				this.setTransition();
			}
		},
		update : function( $item ) {
		if( $item ) {
				this.$item = $item;
			}
			
			// if already expanded remove class "eb-expanded" from current item and add it to new item
			if( current !== -1 ) {
				var $currentItem = $items.eq( current );
				$currentItem.removeClass( 'eb-expanded' );
				this.$item.addClass( 'eb-expanded' );
				// position the preview correctly
				this.positionPreview();
			}

			// update current value
			current = this.$item.index();

			// update preview´s content
			var $itemEl = this.$item.children( 'a.quick-buy' );
				
			$.ajax({
				type: 'POST',
				url: $itemEl.data('description'),
				data: "id_product=113&controller=product",
				success: function(result){
					//split_array = Array();
					var split_array = result.split("<div class='split_here'></div>");
				
			
					$(".eb-details").html(split_array[1]);
				} 
				
				
			})
			
			//this.$href.attr( 'href', eldata.href );

		},
		open : function() {

			setTimeout( $.proxy( function() {	
				// set the height for the preview and the item
				this.setHeights();
				// scroll to position the preview in the right place
				this.positionPreview();
			}, this ), 25 );

		},
		close : function() {

			var self = this,
				onEndFn = function() {
					if( support ) {
						$( this ).off( transEndEventName );
					}
					self.$item.removeClass( 'eb-expanded' );
					self.$previewEl.remove();
				};

			setTimeout( $.proxy( function() {

				if( typeof this.$largeImg !== 'undefined' ) {
					this.$largeImg.fadeOut( 'fast' );
				}
				this.$previewEl.css( 'height', 0 );
				// the current expanded item (might be different from this.$item)
				var $expandedItem = $items.eq( this.expandedIdx );
				$expandedItem.css( 'height', $expandedItem.data( 'height' ) ).on( transEndEventName, onEndFn );

				if( !support ) {
					onEndFn.call();
				}

			}, this ), 25 );
			
			return false;

		},
		calcHeight : function() {

			var heightPreview = winsize.height - this.$item.data( 'height' ) - marginExpanded,
				itemHeight = winsize.height;

			if( heightPreview < settings.minHeight ) {
				heightPreview = settings.minHeight;
				itemHeight = settings.minHeight + this.$item.data( 'height' ) + marginExpanded;
			}

			this.height = heightPreview;
			this.itemHeight = itemHeight;

		},
		setHeights : function() {

			var self = this,
				onEndFn = function() {
					if( support ) {
						self.$item.off( transEndEventName );
					}
					self.$item.addClass( 'eb-expanded' );
				};

			this.calcHeight();
			this.$previewEl.css( 'height', this.height );
			this.$item.css( 'height', this.itemHeight ).on( transEndEventName, onEndFn );

			if( !support ) {
				onEndFn.call();
			}

		},
		positionPreview : function() {

			// scroll page
			// case 1 : preview height + item height fits in window´s height
			// case 2 : preview height + item height does not fit in window´s height and preview height is smaller than window´s height
			// case 3 : preview height + item height does not fit in window´s height and preview height is bigger than window´s height
			var position = this.$item.data( 'offsetTop' )+40,
				previewOffsetT = this.$previewEl.offset().top - scrollExtra,
				scrollVal = this.height + this.$item.data( 'height' ) + marginExpanded <= winsize.height ? position : this.height < winsize.height ? previewOffsetT - ( winsize.height - this.height ) : previewOffsetT;
			
			$body.animate( { scrollTop : scrollVal }, settings.speed );

		},
		setTransition  : function() {
			this.$previewEl.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
			this.$item.css( 'transition', 'height ' + settings.speed + 'ms ' + settings.easing );
		},
		getEl : function() {
			return this.$previewEl;
		}
	}

	return { 
		init : init,
		addItems : addItems
	};

})();

$(function() {
	if ($("body").is("#category")||$("body").is("#index")) {
		Grid.init();
	}
});