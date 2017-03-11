<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:22
         compiled from "/var/www/html/admin109i5hpoj/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:986746755891c74618fc58-53775691%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd2c9f408bf6b71c572c283d1a02a733436f9e812' => 
    array (
      0 => '/var/www/html/admin109i5hpoj/themes/default/template/content.tpl',
      1 => 1452117028,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '986746755891c74618fc58-53775691',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c746198117_21999486',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c746198117_21999486')) {function content_5891c746198117_21999486($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
