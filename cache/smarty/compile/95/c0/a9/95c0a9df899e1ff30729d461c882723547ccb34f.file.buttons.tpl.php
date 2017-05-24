<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:56
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/buttons.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5174917365925602ccec625-90637280%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '95c0a9df899e1ff30729d461c882723547ccb34f' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/buttons.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5174917365925602ccec625-90637280',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'social_networks' => 0,
    'item' => 0,
    'button' => 0,
    'sign_in' => 0,
    'button_class' => 0,
    'popup' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602cd972a4_88252183',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602cd972a4_88252183')) {function content_5925602cd972a4_88252183($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.capitalize.php';
?>

<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['social_networks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
	<?php if ($_smarty_tpl->tpl_vars['item']->value['complete_config']) {?>
	<!--<div class="text-center col-xs-<?php if (!$_smarty_tpl->tpl_vars['button']->value) {?>12<?php } elseif ($_smarty_tpl->tpl_vars['button']->value) {?>4<?php } else { ?>6<?php }?> col-sm-<?php if ($_smarty_tpl->tpl_vars['sign_in']->value&&!$_smarty_tpl->tpl_vars['button']->value) {?>6<?php } elseif ($_smarty_tpl->tpl_vars['button']->value) {?>3<?php } else { ?>4<?php }?> col-md-<?php if ($_smarty_tpl->tpl_vars['sign_in']->value&&!$_smarty_tpl->tpl_vars['button']->value) {?>6<?php } elseif ($_smarty_tpl->tpl_vars['button']->value) {?>2<?php } else { ?>4<?php }?>">-->
		<div class="text-center col-xs-3 col-sm-3 col-md-3" style="//padding-left:2px !important;">
			<button style="margin-left:0px !important;" class="btn_social azm-social <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['button_class']->value, ENT_QUOTES, 'UTF-8', true);?>
 azm-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['icon_class'], ENT_QUOTES, 'UTF-8', true);?>
" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['connect'], ENT_QUOTES, 'UTF-8', true);?>
', <?php if ($_smarty_tpl->tpl_vars['popup']->value) {?>'_blank'<?php } else { ?>'_self'<?php }?>, 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')" style="color=white!important;">
				<i class="fa fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['fa_icon'], ENT_QUOTES, 'UTF-8', true);?>
"></i>
				<?php if (!$_smarty_tpl->tpl_vars['button']->value) {?>
					<?php if ($_smarty_tpl->tpl_vars['sign_in']->value) {?><?php echo smartyTranslate(array('s'=>'Sign in with','mod'=>'sociallogin'),$_smarty_tpl);?>
<?php }?>
					<?php echo smarty_modifier_capitalize(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['name'], ENT_QUOTES, 'UTF-8', true));?>

				<?php }?>
			</button>
			<div class="clearfix">&nbsp;</div>
		</div>
	<?php }?>
<?php } ?><?php }} ?>
