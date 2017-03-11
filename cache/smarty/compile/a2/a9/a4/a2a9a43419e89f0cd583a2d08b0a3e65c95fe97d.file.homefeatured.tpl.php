<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:26
         compiled from "/var/www/html/themes/elation-advance-touch/modules/homefeatured/homefeatured.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20645198865891c74af27163-16188287%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2a9a43419e89f0cd583a2d08b0a3e65c95fe97d' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/homefeatured/homefeatured.tpl',
      1 => 1476201859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20645198865891c74af27163-16188287',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'products' => 0,
    'active_ul' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74b018104_32706655',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74b018104_32706655')) {function content_5891c74b018104_32706655($_smarty_tpl) {?><?php if (!is_callable('smarty_function_counter')) include '/var/www/html/tools/smarty/plugins/function.counter.php';
?>
<?php echo smarty_function_counter(array('name'=>'active_ul','assign'=>'active_ul'),$_smarty_tpl);?>

<?php if (isset($_smarty_tpl->tpl_vars['products']->value)&&$_smarty_tpl->tpl_vars['products']->value) {?>
	<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./product-list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('class'=>'homefeatured tab-pane','id'=>'homefeatured','active'=>$_smarty_tpl->tpl_vars['active_ul']->value), 0);?>

<?php } else { ?>
<ul id="homefeatured" class="homefeatured tab-pane<?php if (isset($_smarty_tpl->tpl_vars['active_ul']->value)&&$_smarty_tpl->tpl_vars['active_ul']->value==1) {?> active<?php }?>">
	<li class="alert alert-info"><?php echo smartyTranslate(array('s'=>'No featured products at this time.','mod'=>'homefeatured'),$_smarty_tpl);?>
</li>
</ul>
<?php }?><?php }} ?>
