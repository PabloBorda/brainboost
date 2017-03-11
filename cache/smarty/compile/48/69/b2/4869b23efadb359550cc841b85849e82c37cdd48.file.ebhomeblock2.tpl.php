<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:26
         compiled from "/var/www/html/modules/ebhomeblock2/views/templates/hook/ebhomeblock2.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7697926335891c74ae03aa4-91926766%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4869b23efadb359550cc841b85849e82c37cdd48' => 
    array (
      0 => '/var/www/html/modules/ebhomeblock2/views/templates/hook/ebhomeblock2.tpl',
      1 => 1476201873,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7697926335891c74ae03aa4-91926766',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'background_option' => 0,
    'banner_img' => 0,
    'background_color' => 0,
    'banner_desc' => 0,
    'background_link' => 0,
    'banner_url' => 0,
    'banner_txt' => 0,
    'background_height' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74ae5d6e7_79195804',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74ae5d6e7_79195804')) {function content_5891c74ae5d6e7_79195804($_smarty_tpl) {?>




<section data-type="background" data-speed="2" class="pages eb-home-block" id="eb-home-block-2" style="
	<?php if (isset($_smarty_tpl->tpl_vars['background_option']->value)&&$_smarty_tpl->tpl_vars['background_option']->value==0) {?>
		<?php if (isset($_smarty_tpl->tpl_vars['banner_img']->value)) {?>
			background: url(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['banner_img']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
) 50% 0 repeat fixed; min-height: 1000px;
		<?php }?>
	<?php } else { ?>
		<?php if (isset($_smarty_tpl->tpl_vars['background_color']->value)) {?>
			background:<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['background_color']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

		<?php }?>;
	<?php }?>
"> 
	<div class="eb-home-block-content">
		<p><?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['banner_desc']->value);?>
</p>
		<?php if (isset($_smarty_tpl->tpl_vars['background_link']->value)&&$_smarty_tpl->tpl_vars['background_link']->value==1) {?>
			<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['banner_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="btn"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['banner_txt']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>
		<?php }?>
	</div>
</section>
<?php if (isset($_smarty_tpl->tpl_vars['background_height']->value)&&$_smarty_tpl->tpl_vars['background_height']->value==1) {?>
<script>
	$(function() {
		var winWidth = $(window).width(),
			winHight = $(window).height(),
			blockHeight = winHight,
			pHeight = $("#eb-home-block-2 .eb-home-block-content").height();
		$("#eb-home-block-2").css("min-height", blockHeight);
		if ( blockHeight > pHeight ) {
			$("#eb-home-block-2 .eb-home-block-content").css("padding-top", ( (blockHeight /2) - (pHeight /2) ));
		};
	});
</script>
<?php } else { ?>
<script>
	$(function() {
		var winWidth = $(window).width(),
			winHight = $(window).height(),
			blockHeight = winHight / 2,
			pHeight = $("#eb-home-block-2 .eb-home-block-content").height();
		$("#eb-home-block-2").css("min-height", blockHeight);
		if ( blockHeight > pHeight ) {
			$("#eb-home-block-2 .eb-home-block-content").css("padding-top", (blockHeight - pHeight) /2);
		};
	});
</script>
<?php }?><?php }} ?>
