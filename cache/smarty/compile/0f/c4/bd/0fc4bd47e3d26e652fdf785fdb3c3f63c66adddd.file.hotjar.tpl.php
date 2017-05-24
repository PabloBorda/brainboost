<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:57
         compiled from "/home/brainboo/public_html/modules/hotjar/views/templates/hook/hotjar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11210120775925602da8ee27-70475191%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0fc4bd47e3d26e652fdf785fdb3c3f63c66adddd' => 
    array (
      0 => '/home/brainboo/public_html/modules/hotjar/views/templates/hook/hotjar.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11210120775925602da8ee27-70475191',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'status' => 0,
    'code' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602daa0a26_28298880',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602daa0a26_28298880')) {function content_5925602daa0a26_28298880($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<?php if ($_smarty_tpl->tpl_vars['status']->value=='1') {?>
	<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['code']->value, '');?>

<?php }?><?php }} ?>
