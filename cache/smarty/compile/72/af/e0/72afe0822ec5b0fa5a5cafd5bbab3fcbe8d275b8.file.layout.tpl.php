<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:34:25
         compiled from "/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:93774883159238391c6d1e9-42498917%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72afe0822ec5b0fa5a5cafd5bbab3fcbe8d275b8' => 
    array (
      0 => '/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/layout.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '93774883159238391c6d1e9-42498917',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'display_header' => 0,
    'HOOK_HEADER' => 0,
    'template' => 0,
    'display_footer' => 0,
    'live_edit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59238391c9b9b5_34116893',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59238391c9b9b5_34116893')) {function content_59238391c9b9b5_34116893($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<?php if (!empty($_smarty_tpl->tpl_vars['display_header']->value)) {?>
	<?php echo $_smarty_tpl->getSubTemplate (Module::getInstanceByName('bestkit_opc')->getTemplatePathTheme('header.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('HOOK_HEADER'=>$_smarty_tpl->tpl_vars['HOOK_HEADER']->value), 0);?>
 
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['template']->value)) {?>
	<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['template']->value, false);?>

<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['display_footer']->value)) {?>
	<?php echo $_smarty_tpl->getSubTemplate (Module::getInstanceByName('bestkit_opc')->getTemplatePathTheme('footer.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 
<?php }?>
<?php if (!empty($_smarty_tpl->tpl_vars['live_edit']->value)) {?>
	<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['live_edit']->value, false);?>

<?php }?><?php }} ?>
