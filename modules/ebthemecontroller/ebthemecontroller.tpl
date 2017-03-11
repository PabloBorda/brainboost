<!-- Theme Controller -->
{if isset($fontsbody)}
<link href="//fonts.googleapis.com/css?family={$fontsbody}:100,400" rel='stylesheet' type='text/css'>
{/if}
{if isset($fontshead)}
<link href="//fonts.googleapis.com/css?family={$fontshead}:100,400" rel='stylesheet' type='text/css'>
{/if}
{if $themeversion == 'dark' }
<link href="{$css_dir}dark-version.css" rel="stylesheet" type="text/css">
{/if}
{literal}
<style>
	body { background:{/literal}{$bgcolor}{literal}; font-family: '{/literal}{$fontsbody}{literal}', sans-serif; color:{/literal}{$txtcolor}{literal}; }
	a { color:{/literal}{$linkcolor}{literal}; }
	#header #shopping_cart > a:first-child, .header_user_info a { color:{/literal}{$linkcolor}{literal}; }
	h1, h2, h3, h4, h5, .idTabs li a, .title_block, .title_block a { font-family: '{/literal}{$fontshead}{literal}', sans-serif !important; color:{/literal}{$headcolor}{literal} !important; border-color:{/literal}{$headcolor}{literal} !important; }
	/* Button Color */
	.eb-button-color, .btn, input.button_mini, input.button_small, input.button, input.button_large, input.button_mini_disabled, input.button_small_disabled, input.button_disabled, input.button_large_disabled, input.exclusive_mini, input.exclusive_small, input.exclusive, input.exclusive_large, input.exclusive_mini_disabled, input.exclusive_small_disabled, input.exclusive_disabled, input.exclusive_large_disabled, a.button_mini, a.button_small, a.button, a.button_large, a.exclusive_mini, a.exclusive_small, a.exclusive, a.exclusive_large, span.button_mini, span.button_small, span.button, span.button_large, span.exclusive_mini, span.exclusive_small, span.exclusive, span.exclusive_large, span.exclusive_large_disabled, .eb-product .box-info-product .exclusive, .bx-pager a.active, .bx-pager a:hover, .eb-product #reduction_percent, .eb-product #reduction_amount, .tooltipster-default { background-color:{/literal}{$btncolor}{literal} !important; color:{/literal}{$btntxt}{literal} !important; }
	.eb-button-color:hover, .btn:hover, input.button_mini:hover, input.button_small:hover, input.button:hover, input.button_large:hover, input.button_mini_disabled:hover, input.button_small_disabled:hover, input.button_disabled:hover, input.button_large_disabled:hover, input.exclusive_mini:hover, input.exclusive_small:hover, input.exclusive:hover, input.exclusive_large:hover, input.exclusive_mini_disabled:hover, input.exclusive_small_disabled:hover, input.exclusive_disabled:hover, input.exclusive_large_disabled:hover, a.button_mini:hover, a.button_small:hover, a.button:hover, a.button_large:hover, a.exclusive_mini:hover, a.exclusive_small:hover, a.exclusive:hover, a.exclusive_large:hover, span.button_mini:hover, span.button_small:hover, span.button:hover, span.button_large:hover, span.exclusive_mini:hover, span.exclusive_small:hover, span.exclusive:hover, span.exclusive_large:hover, span.exclusive_large_disabled:hover, .eb-product .box-info-product .exclusive:hover { background-color:{/literal}{$btncolorover}{literal} !important; color:{/literal}{$btntxtover}{literal} !important; }
	/* HOVER */
	ul.product_list.grid .product-container .right-block { background:{/literal}{$hovercolor}{literal}; }
	/* HEADER */
	.topheader { background:{/literal}{$headbgcolor}{literal} !important; color:{/literal}{$topfootertxt}{literal} !important; }
	.topheader #shopping_cart > a:first-child, .header_user_info a, { color:{/literal}{$headtxtcolor}{literal} !important; }
	.topheader #shopping_cart > a:first-child:hover, .header_user_info a:hover { color:{/literal}{$headhicolor}{literal} !important; }
	/* Footer */
	.footer-container { background:{/literal}{$topfooterbg}{literal}; color:{/literal}{$topfootertxt}{literal} !important; }
	.footer-container div, .footer-container section { color:{/literal}{$topfootertxt}{literal} !important; }
	.footer-container a { color:{/literal}{$topfooterlink}{literal} !important; }
	/* EB NAV */
	#eb-top, .eb-top-nav-wrapper { background:{/literal}{$navbgcolor}{literal}; }
	.sf-menu > li.sfHover > a, .sf-menu ul { background-color:{/literal}{$navbghicolor}{literal}; }
	.sf-menu > li.sfHover { border-color:{/literal}{$navbghicolor}{literal}; }
	.trigger-nav:hover, .eb-top-nav-wrapper li a:hover, .eb-top-nav-wrapper li span:hover { color:{/literal}{$navhicolor}{literal}; }
	.trigger-nav, .eb-top-nav-wrapper li a, .eb-top-nav-wrapper li span { color:{/literal}{$navtxtcolor}{literal}; }
</style>
{/literal}
<script>
	$(document).ready(function(e) {
		{if $hover == 'bubblegrow' }$("ul.product_list").addClass("bubblegrow");{/if}
		{if $hover == 'bubbleout' }$("ul.product_list").addClass("bubbleout");{/if}
		{if $hover == 'slide' }$("ul.product_list").addClass("slide");{/if}
		{if $hover == 'reveal' }$("ul.product_list").addClass("reveal");{/if}
		{if $hover == 'flip' }$("ul.product_list").addClass("flip");{/if}
		{if $hover == 'grow' }$("ul.product_list").addClass("grow");{/if}
		{if $hover == 'fade' }$("ul.product_list").addClass("fadein");{/if}
		
		{if $navdisplay == 'drop' }$("body").addClass("nav-drop");{/if}
		{if $navdisplay == 'mega' }$("body").addClass("nav-mega");{/if}
		{if $navdisplay == 'none' }$("body").addClass("nav-none");{/if}
    });
</script>
<!-- / Theme Controller -->