<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 18:04:43
         compiled from "/home/brainboo/public_html/modules/stripe_official/views/templates/front/order-confirmation.tpl" */ ?>
<?php /*%%SmartyHeaderCode:149037552158b5bbbb78b466-94394402%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1a741c7bcd4e850719c5ac2c98c809ab319cf0f8' => 
    array (
      0 => '/home/brainboo/public_html/modules/stripe_official/views/templates/front/order-confirmation.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '149037552158b5bbbb78b466-94394402',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'stripe_order_reference' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5bbbb7c86d6_19784975',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5bbbb7c86d6_19784975')) {function content_58b5bbbb7c86d6_19784975($_smarty_tpl) {?>

<p><b><?php echo smartyTranslate(array('s'=>'Congratulations, your order has been placed and will be processed soon.','mod'=>'stripe_official'),$_smarty_tpl);?>
</b><br /><br />
<?php echo smartyTranslate(array('s'=>'Your order reference is','mod'=>'stripe_official'),$_smarty_tpl);?>
 <b><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['stripe_order_reference']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</b><?php echo smartyTranslate(array('s'=>', you should receive a confirmation e-mail shortly.','mod'=>'stripe_official'),$_smarty_tpl);?>
<br /><br />
<?php echo smartyTranslate(array('s'=>'We appreciate your business.','mod'=>'stripe_official'),$_smarty_tpl);?>
<br /><br /></p><?php }} ?>
