<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:26
         compiled from "/var/www/html/modules/ebaddthis/ebaddthis.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3607091905891c74a499db4-82930292%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '30c891eeeafea3f706805b0b2abd45aea814998c' => 
    array (
      0 => '/var/www/html/modules/ebaddthis/ebaddthis.tpl',
      1 => 1476201873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3607091905891c74a499db4-82930292',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'pubid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74a49f6d3_21784983',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74a49f6d3_21784983')) {function content_5891c74a49f6d3_21784983($_smarty_tpl) {?><!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_floating_style  addthis_32x32_style clearfix">
<a class="addthis_button_facebook at300b"></a>
<a class="addthis_button_twitter at300b"></a>
<a class="addthis_button_google_plusone_share at300b"></a>
<a class="addthis_button_pinterest_share at300b"></a>
<a class="addthis_button_email at300b"></a>
<a class="addthis_button_compact"></a>
</div>
<script type="text/javascript">var addthis_config = { "data_track_addressbar":true };</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=<?php echo $_smarty_tpl->tpl_vars['pubid']->value;?>
"></script>
<!-- AddThis Button END -->
<script>
$(document).ready(function() {
	$(window).scroll(function() {  
		var y 			= $(window).scrollTop();
		var eleTop 	= $('#usefull_link_block').offset().top-120;
		var eleOff 	= $(".addthis_toolbox");
		if (y < (eleTop-100))	eleOff.fadeIn(500); 
		else 					eleOff.fadeOut(500);
	});
});
</script><?php }} ?>
