<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:34:33
         compiled from "/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-message.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1543177102592383996bb807-86536369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2d534506ac475ae434976455459490837ed879aa' => 
    array (
      0 => '/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-message.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1543177102592383996bb807-86536369',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'oldMessage' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_592383996c5037_98719688',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592383996c5037_98719688')) {function content_592383996c5037_98719688($_smarty_tpl) {?>

<div class="message-boxbox box-opc">
    
    <p><?php echo smartyTranslate(array('s'=>'If you would like to add a comment about your order, please write it below.','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
    <div class="textarea">
        <textarea cols="120" rows="3" name="old_message" id="old_message" class="form-control"><?php if (isset($_smarty_tpl->tpl_vars['oldMessage']->value)) {?><?php echo $_smarty_tpl->tpl_vars['oldMessage']->value;?>
<?php }?></textarea>
    </div>
</div>
<?php }} ?>
