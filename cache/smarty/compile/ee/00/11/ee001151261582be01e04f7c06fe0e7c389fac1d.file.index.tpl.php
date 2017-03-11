<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:28
         compiled from "/var/www/html/themes/elation-advance-touch/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4590726375891c74ca58c76-17036421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee001151261582be01e04f7c06fe0e7c389fac1d' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/index.tpl',
      1 => 1480413834,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4590726375891c74ca58c76-17036421',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'HOOK_HOME_TAB_CONTENT' => 0,
    'HOOK_HOME_TAB' => 0,
    'HOOK_HOME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74ca922c9_94643509',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74ca922c9_94643509')) {function content_5891c74ca922c9_94643509($_smarty_tpl) {?>

<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value)) {?>
    <?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value)) {?>
        <ul id="home-page-tabs" class="nav nav-tabs clearfix">
			<?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB']->value;?>

		</ul>
	<?php }?>
	<div class="tab-content"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME_TAB_CONTENT']->value;?>
</div>
<?php }?>
<?php if (isset($_smarty_tpl->tpl_vars['HOOK_HOME']->value)&&trim($_smarty_tpl->tpl_vars['HOOK_HOME']->value)) {?>
	<div class="clearfix"><?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>
</div>
<?php }?>
  <div class="navigation">
	<!--  <video width="400" height="300" controls="controls" autoplay muted controls loop>
	  <source  src="//brainboost.ie/themes/elation-advance-touch/brain_eye_video.mp4" type="video/mp4">
	  </video>-->
  </div>
<?php }} ?>
