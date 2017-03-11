<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 14:00:22
         compiled from "/var/www/html/themes/elation-advance-touch/category-count.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11422176315891e9f6b9bee9-15249421%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1742b874383dcc2cd4c562bbd8c634ac6793b97b' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/category-count.tpl',
      1 => 1476201859,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11422176315891e9f6b9bee9-15249421',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'category' => 0,
    'nb_products' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891e9f6bb2176_31804392',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891e9f6bb2176_31804392')) {function content_5891e9f6bb2176_31804392($_smarty_tpl) {?>

<span class="heading-counter"><?php if ($_smarty_tpl->tpl_vars['category']->value->id==1||$_smarty_tpl->tpl_vars['nb_products']->value==0) {?><?php echo smartyTranslate(array('s'=>'There are no products in  this category'),$_smarty_tpl);?>
<?php } else { ?><?php if ($_smarty_tpl->tpl_vars['nb_products']->value==1) {?><?php echo smartyTranslate(array('s'=>'There is %d product.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'There are %d products.','sprintf'=>$_smarty_tpl->tpl_vars['nb_products']->value),$_smarty_tpl);?>
<?php }?><?php }?></span><?php }} ?>
