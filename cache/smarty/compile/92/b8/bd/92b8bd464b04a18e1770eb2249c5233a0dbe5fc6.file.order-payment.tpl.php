<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:52:25
         compiled from "/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-payment.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185485137458b5aac95cb939-49415783%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '92b8bd464b04a18e1770eb2249c5233a0dbe5fc6' => 
    array (
      0 => '/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-payment.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185485137458b5aac95cb939-49415783',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'opc' => 0,
    'currencySign' => 0,
    'currencyRate' => 0,
    'currencyFormat' => 0,
    'currencyBlank' => 0,
    'conditions' => 0,
    'cms_id' => 0,
    'checkedTOS' => 0,
    'link_conditions' => 0,
    'HOOK_TOP_PAYMENT' => 0,
    'HOOK_PAYMENT' => 0,
    'total_price' => 0,
    'taxes_enabled' => 0,
    'link' => 0,
    'opcModuleObj' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5aac96d7083_45651092',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5aac96d7083_45651092')) {function content_58b5aac96d7083_45651092($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<div id="opc_payments">
    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <script type="text/javascript">
            var currencySign = '<?php echo html_entity_decode($_smarty_tpl->tpl_vars['currencySign']->value,2,"UTF-8");?>
';
            var currencyRate = '<?php echo floatval($_smarty_tpl->tpl_vars['currencyRate']->value);?>
';
            var currencyFormat = '<?php echo intval($_smarty_tpl->tpl_vars['currencyFormat']->value);?>
';
            var currencyBlank = '<?php echo intval($_smarty_tpl->tpl_vars['currencyBlank']->value);?>
';
            var txtProduct = "<?php echo smartyTranslate(array('s'=>'product','mod'=>'bestkit_opc'),$_smarty_tpl);?>
";
            var txtProducts = "<?php echo smartyTranslate(array('s'=>'products','mod'=>'bestkit_opc'),$_smarty_tpl);?>
";
        </script>
        <?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Your payment method','mod'=>'bestkit_opc'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <h1 class="page-heading"><?php echo smartyTranslate(array('s'=>'Choose your payment method','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h1>
    <?php } else { ?>
        <h1 class="page-heading"><span class="heading-counter heading-counter-4">4</span><?php echo smartyTranslate(array('s'=>'Payment method','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h1>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['conditions']->value&&$_smarty_tpl->tpl_vars['cms_id']->value) {?>
        <p class="checkbox">
            <label for="cgv">
                <input type="checkbox" name="cgv" id="cgv" value="1" <?php if ($_smarty_tpl->tpl_vars['checkedTOS']->value) {?>checked="checked"<?php }?> />
                <?php echo smartyTranslate(array('s'=>'I agree to the Terms of Service and will adhere to them unconditionally.','mod'=>'bestkit_opc'),$_smarty_tpl);?>

            </label>
            <a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link_conditions']->value, false);?>
" class="iframe"><?php echo smartyTranslate(array('s'=>'(Read Terms of Service)','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
        </p>
        <script type="text/javascript">$('a.iframe').fancybox();</script>
    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('payment', null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php } else { ?>
        <div id="opc_payment_methods">
            <div id="opc_payment_methods-overlay" class="overlay-opc" style="display: none;"></div>
    <?php }?>

    <div id="HOOK_TOP_PAYMENT"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['HOOK_TOP_PAYMENT']->value, false);?>
</div>

    <?php if ($_smarty_tpl->tpl_vars['HOOK_PAYMENT']->value) {?>
        <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
            <h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Please select your preferred payment method to pay the amount of','mod'=>'bestkit_opc'),$_smarty_tpl);?>
&nbsp;<span class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['total_price']->value),$_smarty_tpl);?>
</span> <?php if ($_smarty_tpl->tpl_vars['taxes_enabled']->value) {?><?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'bestkit_opc'),$_smarty_tpl);?>
<?php }?></h3>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['opc']->value) {?>
            <div id="opc_payment_methods-content">
        <?php }?>
            <div id="HOOK_PAYMENT"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['HOOK_PAYMENT']->value, false);?>
</div>
        <?php if ($_smarty_tpl->tpl_vars['opc']->value) {?>
            </div>
        <?php }?>
    <?php } else { ?>
        <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'No payment modules have been installed.','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <button type="button" class="btn btn-default button button-small exclusive" onclick="window.location='<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getPageLink('order.php',true), false);?>
?step=2';" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
">
            <span>
                <i class="icon-chevron-sign-left left"></i>
                <?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>

            </span>
        </button>
    <?php } else { ?>
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('continue_shopping')) {?>
            <button type="button" class="btn btn-default button button-small exclusive" onclick="window.location='<?php if ((isset($_SERVER['HTTP_REFERER'])&&strstr($_SERVER['HTTP_REFERER'],$_smarty_tpl->tpl_vars['link']->value->getPageLink('order.php')))||!isset($_SERVER['HTTP_REFERER'])) {?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('index.php');?>
<?php } else { ?><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_MODIFIER]['secureReferrer'][0][0]->secureReferrer(mb_convert_encoding(htmlspecialchars($_SERVER['HTTP_REFERER'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'));?>
<?php }?>';" title="<?php echo smartyTranslate(array('s'=>'Continue shopping','mod'=>'bestkit_opc'),$_smarty_tpl);?>
">
                <span>
                    <i class="icon-chevron-sign-left left"></i>
                    <?php echo smartyTranslate(array('s'=>'Continue shopping','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                </span>
            </button>
			<?php }?>
        </div>
    <?php }?>
</div>
<?php }} ?>
