<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 22:09:43
         compiled from "/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/register.tpl" */ ?>
<?php /*%%SmartyHeaderCode:107622752858925ca769a052-80644755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a098ecf8d86109f92788906dec1d6d1b12733045' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/register.tpl',
      1 => 1477483392,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '107622752858925ca769a052-80644755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'user_code' => 0,
    'network' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58925ca76cd794_97686910',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58925ca76cd794_97686910')) {function content_58925ca76cd794_97686910($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/var/www/html/tools/smarty/plugins/modifier.capitalize.php';
?>

<?php if (isset($_smarty_tpl->tpl_vars['user_code']->value)&&isset($_smarty_tpl->tpl_vars['network']->value)) {?>
<div class="alert alert-info">
	<h2><?php echo smartyTranslate(array('s'=>'Complete your register','mod'=>'sociallogin'),$_smarty_tpl);?>
</h2>
	<ul>
		<li><?php echo smartyTranslate(array('s'=>'Please, fill in some missing fields in the form to complete your registration with','mod'=>'sociallogin'),$_smarty_tpl);?>
 <?php echo smarty_modifier_capitalize(htmlspecialchars($_smarty_tpl->tpl_vars['network']->value, ENT_QUOTES, 'UTF-8', true));?>
.</li>
		<li><?php echo smartyTranslate(array('s'=>'After registering, you will be able to login with your social account when you return.','mod'=>'sociallogin'),$_smarty_tpl);?>
.</li>
	</ul>
	<p><a class="alert-link" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Back','mod'=>'sociallogin'),$_smarty_tpl);?>
">&laquo; <?php echo smartyTranslate(array('s'=>'Back','mod'=>'sociallogin'),$_smarty_tpl);?>
</a></p>
</div>

<div class="social_login">
    <input type="hidden" name="user_code" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_code']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
    <input type="hidden" name="network" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['network']->value, ENT_QUOTES, 'UTF-8', true);?>
" />
</div>
<?php }?><?php }} ?>
