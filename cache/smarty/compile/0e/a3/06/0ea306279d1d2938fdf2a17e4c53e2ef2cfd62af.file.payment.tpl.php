<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:52:36
         compiled from "/home/brainboo/public_html/modules/bitpay/views/templates/hook/payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:112878840158b5aad43916f9-06408502%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0ea306279d1d2938fdf2a17e4c53e2ef2cfd62af' => 
    array (
      0 => '/home/brainboo/public_html/modules/bitpay/views/templates/hook/payment.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '112878840158b5aad43916f9-06408502',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'this_path' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5aad439e928_41868858',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5aad439e928_41868858')) {function content_58b5aad439e928_41868858($_smarty_tpl) {?><div class="row">
  <div class="col-xs-12 col-md-6">
    <p class="payment_module">
            <a href="<?php echo $_smarty_tpl->tpl_vars['this_path']->value;?>
payment.php" title="<?php echo smartyTranslate(array('s'=>'Pay with BitPay','mod'=>'bitpay'),$_smarty_tpl);?>
">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['this_path']->value;?>
bitcoin.png" width="100%" height="100%" alt="<?php echo smartyTranslate(array('s'=>'Pay with BitPay','mod'=>'bitpay'),$_smarty_tpl);?>
" />
                    <?php echo smartyTranslate(array('s'=>'Pay with Bitcoin','mod'=>'bitpay'),$_smarty_tpl);?>

            </a>

    </p>
  </div>
</div>
<?php }} ?>
