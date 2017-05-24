<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:56
         compiled from "/home/brainboo/public_html/modules/ebthemecontroller/ebthemecontroller.tpl" */ ?>
<?php /*%%SmartyHeaderCode:9058056935925602c732559-57769252%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '32bf371281778f446fb4b00c922fcc1a90542b2f' => 
    array (
      0 => '/home/brainboo/public_html/modules/ebthemecontroller/ebthemecontroller.tpl',
      1 => 1486138160,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '9058056935925602c732559-57769252',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'fontsbody' => 0,
    'fontshead' => 0,
    'themeversion' => 0,
    'css_dir' => 0,
    'bgcolor' => 0,
    'txtcolor' => 0,
    'linkcolor' => 0,
    'headcolor' => 0,
    'btncolor' => 0,
    'btntxt' => 0,
    'btncolorover' => 0,
    'btntxtover' => 0,
    'hovercolor' => 0,
    'headbgcolor' => 0,
    'topfootertxt' => 0,
    'headtxtcolor' => 0,
    'headhicolor' => 0,
    'topfooterbg' => 0,
    'topfooterlink' => 0,
    'navbgcolor' => 0,
    'navbghicolor' => 0,
    'navhicolor' => 0,
    'navtxtcolor' => 0,
    'hover' => 0,
    'navdisplay' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602c8e6465_39240134',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602c8e6465_39240134')) {function content_5925602c8e6465_39240134($_smarty_tpl) {?><!-- Theme Controller -->
<?php if (isset($_smarty_tpl->tpl_vars['fontsbody']->value)) {?>
<link href="//fonts.googleapis.com/css?family=<?php echo $_smarty_tpl->tpl_vars['fontsbody']->value;?>
:100,400" rel='stylesheet' type='text/css'>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['fontshead']->value)) {?>
<link href="//fonts.googleapis.com/css?family=<?php echo $_smarty_tpl->tpl_vars['fontshead']->value;?>
:100,400" rel='stylesheet' type='text/css'>
<?php }?>
<?php if ($_smarty_tpl->tpl_vars['themeversion']->value=='dark') {?>
<link href="<?php echo $_smarty_tpl->tpl_vars['css_dir']->value;?>
dark-version.css" rel="stylesheet" type="text/css">
<?php }?>

<style>
	body { background:<?php echo $_smarty_tpl->tpl_vars['bgcolor']->value;?>
; font-family: '<?php echo $_smarty_tpl->tpl_vars['fontsbody']->value;?>
', sans-serif; color:<?php echo $_smarty_tpl->tpl_vars['txtcolor']->value;?>
; }
	a { color:<?php echo $_smarty_tpl->tpl_vars['linkcolor']->value;?>
; }
	#header #shopping_cart > a:first-child, .header_user_info a { color:<?php echo $_smarty_tpl->tpl_vars['linkcolor']->value;?>
; }
	h1, h2, h3, h4, h5, .idTabs li a, .title_block, .title_block a { font-family: '<?php echo $_smarty_tpl->tpl_vars['fontshead']->value;?>
', sans-serif !important; color:<?php echo $_smarty_tpl->tpl_vars['headcolor']->value;?>
 !important; border-color:<?php echo $_smarty_tpl->tpl_vars['headcolor']->value;?>
 !important; }
	/* Button Color */
	.eb-button-color, .btn, input.button_mini, input.button_small, input.button, input.button_large, input.button_mini_disabled, input.button_small_disabled, input.button_disabled, input.button_large_disabled, input.exclusive_mini, input.exclusive_small, input.exclusive, input.exclusive_large, input.exclusive_mini_disabled, input.exclusive_small_disabled, input.exclusive_disabled, input.exclusive_large_disabled, a.button_mini, a.button_small, a.button, a.button_large, a.exclusive_mini, a.exclusive_small, a.exclusive, a.exclusive_large, span.button_mini, span.button_small, span.button, span.button_large, span.exclusive_mini, span.exclusive_small, span.exclusive, span.exclusive_large, span.exclusive_large_disabled, .eb-product .box-info-product .exclusive, .bx-pager a.active, .bx-pager a:hover, .eb-product #reduction_percent, .eb-product #reduction_amount, .tooltipster-default { background-color:<?php echo $_smarty_tpl->tpl_vars['btncolor']->value;?>
 !important; color:<?php echo $_smarty_tpl->tpl_vars['btntxt']->value;?>
 !important; }
	.eb-button-color:hover, .btn:hover, input.button_mini:hover, input.button_small:hover, input.button:hover, input.button_large:hover, input.button_mini_disabled:hover, input.button_small_disabled:hover, input.button_disabled:hover, input.button_large_disabled:hover, input.exclusive_mini:hover, input.exclusive_small:hover, input.exclusive:hover, input.exclusive_large:hover, input.exclusive_mini_disabled:hover, input.exclusive_small_disabled:hover, input.exclusive_disabled:hover, input.exclusive_large_disabled:hover, a.button_mini:hover, a.button_small:hover, a.button:hover, a.button_large:hover, a.exclusive_mini:hover, a.exclusive_small:hover, a.exclusive:hover, a.exclusive_large:hover, span.button_mini:hover, span.button_small:hover, span.button:hover, span.button_large:hover, span.exclusive_mini:hover, span.exclusive_small:hover, span.exclusive:hover, span.exclusive_large:hover, span.exclusive_large_disabled:hover, .eb-product .box-info-product .exclusive:hover { background-color:<?php echo $_smarty_tpl->tpl_vars['btncolorover']->value;?>
 !important; color:<?php echo $_smarty_tpl->tpl_vars['btntxtover']->value;?>
 !important; }
	/* HOVER */
	ul.product_list.grid .product-container .right-block { background:<?php echo $_smarty_tpl->tpl_vars['hovercolor']->value;?>
; }
	/* HEADER */
	.topheader { background:<?php echo $_smarty_tpl->tpl_vars['headbgcolor']->value;?>
 !important; color:<?php echo $_smarty_tpl->tpl_vars['topfootertxt']->value;?>
 !important; }
	.topheader #shopping_cart > a:first-child, .header_user_info a, { color:<?php echo $_smarty_tpl->tpl_vars['headtxtcolor']->value;?>
 !important; }
	.topheader #shopping_cart > a:first-child:hover, .header_user_info a:hover { color:<?php echo $_smarty_tpl->tpl_vars['headhicolor']->value;?>
 !important; }
	/* Footer */
	.footer-container { background:<?php echo $_smarty_tpl->tpl_vars['topfooterbg']->value;?>
; color:<?php echo $_smarty_tpl->tpl_vars['topfootertxt']->value;?>
 !important; }
	.footer-container div, .footer-container section { color:<?php echo $_smarty_tpl->tpl_vars['topfootertxt']->value;?>
 !important; }
	.footer-container a { color:<?php echo $_smarty_tpl->tpl_vars['topfooterlink']->value;?>
 !important; }
	/* EB NAV */
	#eb-top, .eb-top-nav-wrapper { background:<?php echo $_smarty_tpl->tpl_vars['navbgcolor']->value;?>
; }
	.sf-menu > li.sfHover > a, .sf-menu ul { background-color:<?php echo $_smarty_tpl->tpl_vars['navbghicolor']->value;?>
; }
	.sf-menu > li.sfHover { border-color:<?php echo $_smarty_tpl->tpl_vars['navbghicolor']->value;?>
; }
	.trigger-nav:hover, .eb-top-nav-wrapper li a:hover, .eb-top-nav-wrapper li span:hover { color:<?php echo $_smarty_tpl->tpl_vars['navhicolor']->value;?>
; }
	.trigger-nav, .eb-top-nav-wrapper li a, .eb-top-nav-wrapper li span { color:<?php echo $_smarty_tpl->tpl_vars['navtxtcolor']->value;?>
; }
</style>

<script>
	$(document).ready(function(e) {
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='bubblegrow') {?>$("ul.product_list").addClass("bubblegrow");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='bubbleout') {?>$("ul.product_list").addClass("bubbleout");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='slide') {?>$("ul.product_list").addClass("slide");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='reveal') {?>$("ul.product_list").addClass("reveal");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='flip') {?>$("ul.product_list").addClass("flip");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='grow') {?>$("ul.product_list").addClass("grow");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['hover']->value=='fade') {?>$("ul.product_list").addClass("fadein");<?php }?>
		
		<?php if ($_smarty_tpl->tpl_vars['navdisplay']->value=='drop') {?>$("body").addClass("nav-drop");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['navdisplay']->value=='mega') {?>$("body").addClass("nav-mega");<?php }?>
		<?php if ($_smarty_tpl->tpl_vars['navdisplay']->value=='none') {?>$("body").addClass("nav-none");<?php }?>
    });
</script>
<!-- / Theme Controller --><?php }} ?>
