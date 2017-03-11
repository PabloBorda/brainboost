<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:49:00
         compiled from "/home/brainboo/public_html/admin109i5hpoj/themes/default/template/helpers/list/list_action_preview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27342770058b5a9fcaff0e6-21379918%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5ea0a2ea28e6bb52056d2c4f742df2122567d17c' => 
    array (
      0 => '/home/brainboo/public_html/admin109i5hpoj/themes/default/template/helpers/list/list_action_preview.tpl',
      1 => 1486138155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27342770058b5a9fcaff0e6-21379918',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'href' => 0,
    'action' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5a9fcb0a966_79741960',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5a9fcb0a966_79741960')) {function content_58b5a9fcb0a966_79741960($_smarty_tpl) {?>
<a href="<?php echo $_smarty_tpl->tpl_vars['href']->value;?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" target="_blank">
	<i class="icon-eye"></i> <?php echo $_smarty_tpl->tpl_vars['action']->value;?>

</a>
<?php }} ?>
