<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:11:07
         compiled from "/home/brainboo/public_html/admin109i5hpoj/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:167413616558b5a11b874fe9-88294285%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b5b2611e99ddfa830f4adf4547ae1513a729c755' => 
    array (
      0 => '/home/brainboo/public_html/admin109i5hpoj/themes/default/template/content.tpl',
      1 => 1486138155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '167413616558b5a11b874fe9-88294285',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5a11b880b70_04172380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5a11b880b70_04172380')) {function content_58b5a11b880b70_04172380($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
