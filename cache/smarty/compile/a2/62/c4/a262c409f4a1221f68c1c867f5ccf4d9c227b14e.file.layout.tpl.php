<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 22:09:44
         compiled from "/var/www/html/modules/bestkit_opc/views/templates/front/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11895978458925ca85933c2-48022669%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a262c409f4a1221f68c1c867f5ccf4d9c227b14e' => 
    array (
      0 => '/var/www/html/modules/bestkit_opc/views/templates/front/layout.tpl',
      1 => 1478865582,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11895978458925ca85933c2-48022669',
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
  'unifunc' => 'content_58925ca85c26b2_38484933',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58925ca85c26b2_38484933')) {function content_58925ca85c26b2_38484933($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tools/smarty/plugins/modifier.escape.php';
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
