<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:38:06
         compiled from "/home/brainboo/public_html/admin109i5hpoj/themes/default/template/content.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6518405615923846e958fc0-50040025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '6518405615923846e958fc0-50040025',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5923846e961f15_11290585',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5923846e961f15_11290585')) {function content_5923846e961f15_11290585($_smarty_tpl) {?>
<div id="ajax_confirmation" class="alert alert-success hide"></div>

<div id="ajaxBox" style="display:none"></div>


<div class="row">
	<div class="col-lg-12">
		<?php if (isset($_smarty_tpl->tpl_vars['content']->value)) {?>
			<?php echo $_smarty_tpl->tpl_vars['content']->value;?>

		<?php }?>
	</div>
</div><?php }} ?>
