<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:27
         compiled from "/var/www/html/modules/hotjar/views/templates/hook/hotjar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7835053115891c74b886687-90813710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '000c8e9c109fb584ec263fbf5df0b75bbbee5567' => 
    array (
      0 => '/var/www/html/modules/hotjar/views/templates/hook/hotjar.tpl',
      1 => 1477746864,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7835053115891c74b886687-90813710',
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
  'unifunc' => 'content_5891c74b8a0851_48951128',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74b8a0851_48951128')) {function content_5891c74b8a0851_48951128($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/var/www/html/tools/smarty/plugins/modifier.escape.php';
?>

<?php if ($_smarty_tpl->tpl_vars['status']->value=='1') {?>
	<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['code']->value, '');?>

<?php }?><?php }} ?>
