<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:49:53
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:54589471458b5aa314423c2-01818946%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10bd44217bf63eee8133bd25d88f7ed96b0c99c4' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/index.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '54589471458b5aa314423c2-01818946',
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
  'unifunc' => 'content_58b5aa314651b8_87175740',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5aa314651b8_87175740')) {function content_58b5aa314651b8_87175740($_smarty_tpl) {?>

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
