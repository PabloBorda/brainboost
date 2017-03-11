<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:49:00
         compiled from "/home/brainboo/public_html/admin109i5hpoj/themes/default/template/helpers/list/list_action_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83359150158b5a9fcae0c23-11870749%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '294d009bccaa9905d518c5fb19c1eb8a733dc42d' => 
    array (
      0 => '/home/brainboo/public_html/admin109i5hpoj/themes/default/template/helpers/list/list_action_edit.tpl',
      1 => 1486138155,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83359150158b5a9fcae0c23-11870749',
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
  'unifunc' => 'content_58b5a9fcaf0da9_68233180',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5a9fcaf0da9_68233180')) {function content_58b5a9fcaf0da9_68233180($_smarty_tpl) {?>
<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['href']->value, ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>
" class="edit">
	<i class="icon-pencil"></i> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['action']->value, ENT_QUOTES, 'UTF-8', true);?>

</a><?php }} ?>
