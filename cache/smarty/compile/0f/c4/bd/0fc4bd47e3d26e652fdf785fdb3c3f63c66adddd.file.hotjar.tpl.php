<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:49:40
         compiled from "/home/brainboo/public_html/modules/hotjar/views/templates/hook/hotjar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53640581258b5aa248f6a77-12873318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '53640581258b5aa248f6a77-12873318',
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
  'unifunc' => 'content_58b5aa249022e6_37519590',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5aa249022e6_37519590')) {function content_58b5aa249022e6_37519590($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<?php if ($_smarty_tpl->tpl_vars['status']->value=='1') {?>
	<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['code']->value, '');?>

<?php }?><?php }} ?>
