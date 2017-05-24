<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:34:25
         compiled from "/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/shopping-cart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1524836594592383913403d0-90805755%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ae834e53a161dfe3d1a01ee193d10567609b0aa' => 
    array (
      0 => '/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/shopping-cart.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1524836594592383913403d0-90805755',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'empty' => 0,
    'PS_CATALOG_MODE' => 0,
    'currencySign' => 0,
    'currencyRate' => 0,
    'currencyFormat' => 0,
    'currencyBlank' => 0,
    'lastProductAdded' => 0,
    'products' => 0,
    'product' => 0,
    'link' => 0,
    'opcModuleObj' => 0,
    'use_taxes' => 0,
    'priceDisplay' => 0,
    'display_tax_label' => 0,
    'total_products' => 0,
    'total_products_wt' => 0,
    'total_discounts' => 0,
    'total_discounts_tax_exc' => 0,
    'total_discounts_negative' => 0,
    'total_wrapping' => 0,
    'total_wrapping_tax_exc' => 0,
    'total_shipping_tax_exc' => 0,
    'virtualCart' => 0,
    'total_shipping' => 0,
    'total_price_without_tax' => 0,
    'total_tax' => 0,
    'total_price' => 0,
    'voucherAllowed' => 0,
    'errors_discount' => 0,
    'error' => 0,
    'opc' => 0,
    'discount_name' => 0,
    'displayVouchers' => 0,
    'voucher' => 0,
    'productId' => 0,
    'productAttributeId' => 0,
    'customizedDatas' => 0,
    'gift_products' => 0,
    'id_customization' => 0,
    'customization' => 0,
    'type' => 0,
    'CUSTOMIZE_FILE' => 0,
    'custom_data' => 0,
    'pic_dir' => 0,
    'picture' => 0,
    'CUSTOMIZE_TEXTFIELD' => 0,
    'textField' => 0,
    'cannotModify' => 0,
    'quantityDisplayed' => 0,
    'token_cart' => 0,
    'img_dir' => 0,
    'last_was_odd' => 0,
    'discounts' => 0,
    'discount' => 0,
    'show_option_allow_separate_package' => 0,
    'cart' => 0,
    'multi_shipping' => 0,
    'HOOK_SHOPPING_CART' => 0,
    'addresses_style' => 0,
    'delivery_option' => 0,
    'delivery' => 0,
    'invoice' => 0,
    'formattedAddresses' => 0,
    'delivery_state' => 0,
    'invoice_state' => 0,
    'address' => 0,
    'pattern' => 0,
    'addressKey' => 0,
    'key' => 0,
    'HOOK_SHOPPING_CART_EXTRA' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_59238391899e56_37027375',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_59238391899e56_37027375')) {function content_59238391899e56_37027375($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>
<div id="shopping_cart_ajax">
<script type="text/javascript">
    var freeShippingTranslationOPC = '<?php echo smartyTranslate(array('s'=>'Free!','mod'=>'bestkit_opc','js'=>1),$_smarty_tpl);?>
';
</script>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Your shopping cart','mod'=>'bestkit_opc'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


<h1 class="page-heading"><span class="heading-counter heading-counter-3">3</span><?php echo smartyTranslate(array('s'=>'Review your order','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h1>

<?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('summary', null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if (isset($_smarty_tpl->tpl_vars['empty']->value)) {?>
    <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'Your shopping cart is empty.','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
<?php } elseif ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
    <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'This store has not accepted your new order.','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
<?php } else { ?>
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
    <p style="display:none" id="emptyCartWarning" class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'Your shopping cart is empty.','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
    <?php if (isset($_smarty_tpl->tpl_vars['lastProductAdded']->value)&&$_smarty_tpl->tpl_vars['lastProductAdded']->value) {?>
        <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
?>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['id_product']==$_smarty_tpl->tpl_vars['lastProductAdded']->value['id_product']&&(!$_smarty_tpl->tpl_vars['product']->value['id_product_attribute']||($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']==$_smarty_tpl->tpl_vars['lastProductAdded']->value['id_product_attribute']))) {?>
                <div class="cart_last_product">
                    <div class="cart_last_product_header">
                        <div class="left"><?php echo smartyTranslate(array('s'=>'Last added product','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</div>
                    </div>
                    <a  class="cart_last_product_img" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'small');?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/></a>
                    <div class="cart_last_product_content">
                        <h5><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a></h5>
                        <?php if (isset($_smarty_tpl->tpl_vars['product']->value['attributes'])&&$_smarty_tpl->tpl_vars['product']->value['attributes']) {?><a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getProductLink($_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['category']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['attributes'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a><?php }?>
                    </div>
                    <br class="clear" />
                </div>
            <?php }?>
        <?php } ?>
    <?php }?>
    
    <div id="order-detail-content">
        <table id="cart_summary" class="table-opc">
            <colgroup>
                <col width="1" />
                <col />
                <col width="1" />
                <col width="1" />
            </colgroup>
            <thead>
                <tr>
                    <th><?php echo smartyTranslate(array('s'=>'Product','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Description','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</th>
                    
                    <th><?php echo smartyTranslate(array('s'=>'Qty','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Total','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</th>
                    
                </tr>
            </thead>
                <tfoot>
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_products')) {?>
                <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                        <tr>
                            <td colspan="3">
                                <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                                    <?php echo smartyTranslate(array('s'=>'Total products (tax excl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                <?php } else { ?>
                                    <?php echo smartyTranslate(array('s'=>'Total products:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                <?php }?>
                            </td>
                            <td id="total_product" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_products']->value),$_smarty_tpl);?>
</td>
                        </tr>
                    <?php } else { ?>
                        <tr>
                            <td colspan="3">
                                <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                                    <?php echo smartyTranslate(array('s'=>'Total products (tax incl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                <?php } else { ?>
                                    <?php echo smartyTranslate(array('s'=>'Total products:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                <?php }?>
                            </td>
                            <td id="total_product" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_products_wt']->value),$_smarty_tpl);?>
</td>
                        </tr>
                    <?php }?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3"><?php echo smartyTranslate(array('s'=>'Total products:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</td>
                        <td id="total_product" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_products']->value),$_smarty_tpl);?>
</td>
                    </tr>
                <?php }?>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_discount')) {?>
                <tr <?php if ($_smarty_tpl->tpl_vars['total_discounts']->value==0) {?>style="display:none"<?php }?>>
                    <td colspan="3">
                        <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value&&$_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                            <?php echo smartyTranslate(array('s'=>'Total vouchers (tax excl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                        <?php } else { ?>
                            <?php echo smartyTranslate(array('s'=>'Total vouchers:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                        <?php }?>
                    </td>
                    <td id="total_discount" class="price-opc">
                        <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value&&!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                            <?php $_smarty_tpl->tpl_vars['total_discounts_negative'] = new Smarty_variable($_smarty_tpl->tpl_vars['total_discounts']->value*-1, null, 0);?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->tpl_vars['total_discounts_negative'] = new Smarty_variable($_smarty_tpl->tpl_vars['total_discounts_tax_exc']->value*-1, null, 0);?>
                        <?php }?>
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_discounts_negative']->value),$_smarty_tpl);?>

                    </td>
                </tr>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_wrapping')) {?>
                <tr <?php if ($_smarty_tpl->tpl_vars['total_wrapping']->value==0) {?>style="display: none;"<?php }?>>
                    <td colspan="3">
                        <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                            <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                                <?php echo smartyTranslate(array('s'=>'Total gift-wrapping (tax incl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                            <?php } else { ?>
                                <?php echo smartyTranslate(array('s'=>'Total gift-wrapping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                            <?php }?>
                        <?php } else { ?>
                            <?php echo smartyTranslate(array('s'=>'Total gift-wrapping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                        <?php }?>
                    </td>
                    <td id="total_wrapping" class="price-opc">
                        <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                            <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping_tax_exc']->value),$_smarty_tpl);?>

                            <?php } else { ?>
                                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping']->value),$_smarty_tpl);?>

                            <?php }?>
                        <?php } else { ?>
                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping_tax_exc']->value),$_smarty_tpl);?>

                        <?php }?>
                    </td>
                </tr>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_shipping')) {?>
                <?php if ($_smarty_tpl->tpl_vars['total_shipping_tax_exc']->value<=0&&!isset($_smarty_tpl->tpl_vars['virtualCart']->value)) {?>
                    <tr>
                        <td colspan="3"><?php echo smartyTranslate(array('s'=>'Shipping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</td>
                        <td id="total_shipping" class="price-opc free-price-opc"><?php echo smartyTranslate(array('s'=>'Free!','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</td>
                    </tr>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                            <tr <?php if ($_smarty_tpl->tpl_vars['total_shipping_tax_exc']->value<=0) {?> style="display:none;"<?php }?>>
                                <td colspan="3">
                                    <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                                        <?php echo smartyTranslate(array('s'=>'Total shipping (tax excl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                    <?php } else { ?>
                                        <?php echo smartyTranslate(array('s'=>'Total shipping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                    <?php }?>
                                </td>
                                <td id="total_shipping" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_shipping_tax_exc']->value),$_smarty_tpl);?>
</td>
                            </tr>
                        <?php } else { ?>
                            <tr <?php if ($_smarty_tpl->tpl_vars['total_shipping']->value<=0) {?> style="display:none;"<?php }?>>
                                <td colspan="3">
                                    <?php if ($_smarty_tpl->tpl_vars['display_tax_label']->value) {?>
                                        <?php echo smartyTranslate(array('s'=>'Total shipping (tax incl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                    <?php } else { ?>
                                        <?php echo smartyTranslate(array('s'=>'Total shipping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                    <?php }?>
                                </td>
                                <td id="total_shipping" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_shipping']->value),$_smarty_tpl);?>
</td>
                            </tr>
                        <?php }?>
                    <?php } else { ?>
                        <tr <?php if ($_smarty_tpl->tpl_vars['total_shipping_tax_exc']->value<=0) {?> style="display:none;"<?php }?>>
                            <td colspan="3">
                                <?php echo smartyTranslate(array('s'=>'Total shipping:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                            </td>
                            <td id="total_shipping" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_shipping_tax_exc']->value),$_smarty_tpl);?>
</td>
                        </tr>
                    <?php }?>
                <?php }?>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_tax_excl')) {?>
                <tr>
                    <td colspan="3">
                        <?php echo smartyTranslate(array('s'=>'Total (tax excl.):','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                    </td>
                    <td id="total_price_without_tax" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_price_without_tax']->value),$_smarty_tpl);?>
</td>
                </tr>
			<?php }?>
				
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total_tax')) {?>
                <tr>
                    <td colspan="3">
                        <?php echo smartyTranslate(array('s'=>'Total tax:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                    </td>
                    <td id="total_tax" class="price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_tax']->value),$_smarty_tpl);?>
</td>
                </tr>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['opcModuleObj']->value->getConfig('show_total')) {?>
                <tr>
                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                        <td colspan="3"><?php echo smartyTranslate(array('s'=>'Total:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</td>
                        <td>
                            <span id="total_price" class="total-price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_price']->value),$_smarty_tpl);?>
</span>
                        </td>
                    <?php } else { ?>
                        <td colspan="3"><?php echo smartyTranslate(array('s'=>'Total:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</td>
                        <td>
                            <span id="total_price" class="total-price-opc"><?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['total_price_without_tax']->value),$_smarty_tpl);?>
</span>
                        </td>
                    <?php }?>
                </tr>
			<?php }?>
			
			<?php if ($_smarty_tpl->tpl_vars['voucherAllowed']->value) {?>
                <tr>
					<td colspan="4" id="cart_voucher">
						<?php if (isset($_smarty_tpl->tpl_vars['errors_discount']->value)&&$_smarty_tpl->tpl_vars['errors_discount']->value) {?>
							<div class="alert alert-error">
								<ul>
									<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['error']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['errors_discount']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
?>
										<li><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['error']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
									<?php } ?>
								</ul>
							</div>
						<?php }?>
						<form action="<?php if ($_smarty_tpl->tpl_vars['opc']->value) {?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc.php',true);?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order.php',true);?>
<?php }?>" method="post" id="voucher">
							<fieldset>
								<h4><label for="discount_name"><?php echo smartyTranslate(array('s'=>'Vouchers','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</label></h4>
								<p>
									<input type="text" class="discount_name form-control" id="discount_name" name="discount_name" value="<?php if (isset($_smarty_tpl->tpl_vars['discount_name']->value)&&$_smarty_tpl->tpl_vars['discount_name']->value) {?><?php echo $_smarty_tpl->tpl_vars['discount_name']->value;?>
<?php }?>" />
								</p>
								<p class="submit">
									<input type="hidden" name="submitDiscount" />
									<button class="btn btn-default button button-small exclusive" name="submitAddDiscount" id="submitAddDiscount"><span><?php echo smartyTranslate(array('s'=>'OK','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</span></button>
								
									
								</p>
							<?php if ($_smarty_tpl->tpl_vars['displayVouchers']->value) {?>
								<h4 class="title_offers"><?php echo smartyTranslate(array('s'=>'Take advantage of our offers:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h4>
								<div id="display_cart_vouchers">
								<?php  $_smarty_tpl->tpl_vars['voucher'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['voucher']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['displayVouchers']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['voucher']->key => $_smarty_tpl->tpl_vars['voucher']->value) {
$_smarty_tpl->tpl_vars['voucher']->_loop = true;
?>
									<span onclick="$('#discount_name').val('<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['voucher']->value['name'], false);?>
');return false;" class="voucher_name"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['voucher']->value['name'], false);?>
</span> - <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['voucher']->value['description'], false);?>
 <br />
								<?php } ?>
								</div>
							<?php }?>
							</fieldset>
						</form>
					</td>
                </tr>
			<?php }?>
			
            </tfoot>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
?>
                    <?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['quantityDisplayed'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['odd'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->iteration%2, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['ignoreProductLast'] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])||count($_smarty_tpl->tpl_vars['gift_products']->value), null, 0);?>
                    
                    <?php echo $_smarty_tpl->getSubTemplate ("./shopping-cart-product-line.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('productLast'=>$_smarty_tpl->tpl_vars['product']->last,'productFirst'=>$_smarty_tpl->tpl_vars['product']->first), 0);?>

                    
                    <?php if (isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])) {?>
                        <?php  $_smarty_tpl->tpl_vars['customization'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['customization']->_loop = false;
 $_smarty_tpl->tpl_vars['id_customization'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value][$_smarty_tpl->tpl_vars['product']->value['id_address_delivery']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['customization']->key => $_smarty_tpl->tpl_vars['customization']->value) {
$_smarty_tpl->tpl_vars['customization']->_loop = true;
 $_smarty_tpl->tpl_vars['id_customization']->value = $_smarty_tpl->tpl_vars['customization']->key;
?>
                            <tr id="product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
">
                                <td></td>
                                <td colspan="2">
                                    <?php  $_smarty_tpl->tpl_vars['custom_data'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['custom_data']->_loop = false;
 $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['customization']->value['datas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['custom_data']->key => $_smarty_tpl->tpl_vars['custom_data']->value) {
$_smarty_tpl->tpl_vars['custom_data']->_loop = true;
 $_smarty_tpl->tpl_vars['type']->value = $_smarty_tpl->tpl_vars['custom_data']->key;
?>
                                        <?php if ($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->tpl_vars['CUSTOMIZE_FILE']->value) {?>
                                            <div class="customizationUploaded">
                                                <ul class="customizationUploaded">
                                                    <?php  $_smarty_tpl->tpl_vars['picture'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['picture']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['custom_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['picture']->key => $_smarty_tpl->tpl_vars['picture']->value) {
$_smarty_tpl->tpl_vars['picture']->_loop = true;
?>
                                                        <li><img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['pic_dir']->value, false);?>
<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['picture']->value['value'], false);?>
_small" alt="" class="customizationUploaded" /></li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['type']->value==$_smarty_tpl->tpl_vars['CUSTOMIZE_TEXTFIELD']->value) {?>
                                            <ul class="typedText">
                                                <?php  $_smarty_tpl->tpl_vars['textField'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['textField']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['custom_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['textField']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['textField']->key => $_smarty_tpl->tpl_vars['textField']->value) {
$_smarty_tpl->tpl_vars['textField']->_loop = true;
 $_smarty_tpl->tpl_vars['textField']->index++;
?>
                                                    <li>
                                                        <?php if ($_smarty_tpl->tpl_vars['textField']->value['name']) {?>
                                                            <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['textField']->value['name'], false);?>

                                                        <?php } else { ?>
                                                            <?php echo smartyTranslate(array('s'=>'Text #','mod'=>'bestkit_opc'),$_smarty_tpl);?>
<?php echo smarty_modifier_escape(($_smarty_tpl->tpl_vars['textField']->index+1), false);?>

                                                        <?php }?>
                                                        <?php echo smartyTranslate(array('s'=>':','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                                        <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['textField']->value['value'], false);?>

                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php }?>
                                    <?php } ?>
                                </td>
                                <td class="cart_quantity">
                                    <?php if (isset($_smarty_tpl->tpl_vars['cannotModify']->value)&&$_smarty_tpl->tpl_vars['cannotModify']->value==1) {?>
                                        <span style="float:left"><?php if ($_smarty_tpl->tpl_vars['quantityDisplayed']->value==0&&isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value])) {?><?php echo count($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value]);?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['product']->value['cart_quantity']-$_smarty_tpl->tpl_vars['quantityDisplayed']->value;?>
<?php }?></span>
                                    <?php } else { ?>
                                        <div id="cart_quantity_button" class="cart_quantity_button" style="float:left">
                                            <a rel="nofollow" class="cart_quantity_up" id="cart_quantity_up_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp5=ob_get_clean();?><?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,null,"add&amp;id_product=".$_tmp5."&amp;ipa=".$_tmp6."&amp;id_address_delivery=".((string)$_smarty_tpl->tpl_vars['product']->value['id_address_delivery'])."&amp;id_customization=".((string)$_smarty_tpl->tpl_vars['id_customization']->value)."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value));?>
" title="<?php echo smartyTranslate(array('s'=>'Add','mod'=>'bestkit_opc'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['img_dir']->value;?>
icon/quantity_up.gif" alt="<?php echo smartyTranslate(array('s'=>'Add','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" width="14" height="9" /></a><br />
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<($_smarty_tpl->tpl_vars['customization']->value['quantity']-$_smarty_tpl->tpl_vars['quantityDisplayed']->value)||$_smarty_tpl->tpl_vars['product']->value['minimal_quantity']<=1) {?>
                                            <a rel="nofollow" class="cart_quantity_down" id="cart_quantity_down_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp7=ob_get_clean();?><?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
<?php $_tmp8=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,null,"add&amp;id_product=".$_tmp7."&amp;ipa=".$_tmp8."&amp;id_address_delivery=".((string)$_smarty_tpl->tpl_vars['product']->value['id_address_delivery'])."&amp;id_customization=".((string)$_smarty_tpl->tpl_vars['id_customization']->value)."&amp;op=down&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value));?>
" title="<?php echo smartyTranslate(array('s'=>'Subtract','mod'=>'bestkit_opc'),$_smarty_tpl);?>
">
                                                <img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img_dir']->value, false);?>
icon/quantity_down.gif" alt="<?php echo smartyTranslate(array('s'=>'Subtract','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" width="14" height="9" />
                                            </a>
                                            <?php } else { ?>
                                            <a class="cart_quantity_down" style="opacity: 0.3;" id="cart_quantity_down_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['id_customization']->value, false);?>
" href="#" title="<?php echo smartyTranslate(array('s'=>'Subtract','mod'=>'bestkit_opc'),$_smarty_tpl);?>
">
                                                <img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['img_dir']->value, false);?>
icon/quantity_down.gif" alt="<?php echo smartyTranslate(array('s'=>'Subtract','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" width="14" height="9" />
                                            </a>
                                            <?php }?>
                                        </div>
                                        <input type="hidden" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['customization']->value['quantity'], false);?>
" name="quantity_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['id_customization']->value, false);?>
_hidden"/>
                                        <input size="2" type="text" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['customization']->value['quantity'], false);?>
" class="cart_quantity_input" name="quantity_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['id_customization']->value, false);?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
"/>
                                    <?php }?>
                                </td>
                                <td class="cart_delete">
                                    <?php if (isset($_smarty_tpl->tpl_vars['cannotModify']->value)&&$_smarty_tpl->tpl_vars['cannotModify']->value==1) {?>
                                    <?php } else { ?>
                                        <a rel="nofollow" class="cart_quantity_delete" id="<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'];?>
_<?php echo $_smarty_tpl->tpl_vars['id_customization']->value;?>
_<?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_address_delivery']);?>
" href="<?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product']);?>
<?php $_tmp9=ob_get_clean();?><?php ob_start();?><?php echo intval($_smarty_tpl->tpl_vars['product']->value['id_product_attribute']);?>
<?php $_tmp10=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('cart',true,null,"delete&amp;id_product=".$_tmp9."&amp;ipa=".$_tmp10."&amp;id_customization=".((string)$_smarty_tpl->tpl_vars['id_customization']->value)."&amp;id_address_delivery=".((string)$_smarty_tpl->tpl_vars['product']->value['id_address_delivery'])."&amp;token=".((string)$_smarty_tpl->tpl_vars['token_cart']->value));?>
"><?php echo smartyTranslate(array('s'=>'Delete','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
                                    <?php }?>
                                </td>
                            </tr>
                            <?php $_smarty_tpl->tpl_vars['quantityDisplayed'] = new Smarty_variable($_smarty_tpl->tpl_vars['quantityDisplayed']->value+$_smarty_tpl->tpl_vars['customization']->value['quantity'], null, 0);?>
                        <?php } ?>
                        
                        <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity']-$_smarty_tpl->tpl_vars['quantityDisplayed']->value>0) {?><?php echo $_smarty_tpl->getSubTemplate ("./shopping-cart-product-line.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('productLast'=>$_smarty_tpl->tpl_vars['product']->last,'productFirst'=>$_smarty_tpl->tpl_vars['product']->first), 0);?>
<?php }?>
                    <?php }?>
                <?php } ?>
                <?php $_smarty_tpl->tpl_vars['last_was_odd'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->iteration%2, null, 0);?>
                <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['gift_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
?>
                    <?php $_smarty_tpl->tpl_vars['productId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['productAttributeId'] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['quantityDisplayed'] = new Smarty_variable(0, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['odd'] = new Smarty_variable(($_smarty_tpl->tpl_vars['product']->iteration+$_smarty_tpl->tpl_vars['last_was_odd']->value)%2, null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['ignoreProductLast'] = new Smarty_variable(isset($_smarty_tpl->tpl_vars['customizedDatas']->value[$_smarty_tpl->tpl_vars['productId']->value][$_smarty_tpl->tpl_vars['productAttributeId']->value]), null, 0);?>
                    <?php $_smarty_tpl->tpl_vars['cannotModify'] = new Smarty_variable(1, null, 0);?>
                    
                    <?php echo $_smarty_tpl->getSubTemplate ("./shopping-cart-product-line.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('productLast'=>$_smarty_tpl->tpl_vars['product']->last,'productFirst'=>$_smarty_tpl->tpl_vars['product']->first), 0);?>

                <?php } ?>
            </tbody>
            <?php if (sizeof($_smarty_tpl->tpl_vars['discounts']->value)) {?>
                <tbody>
                    <?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['discount']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['discounts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value) {
$_smarty_tpl->tpl_vars['discount']->_loop = true;
?>
                        <tr id="cart_discount_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['discount']->value['id_discount'], false);?>
">
                            <td><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['discount']->value['name'], false);?>
</td>
                            <td>
                                <span class="price-opc">
                                    <?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']*-1),$_smarty_tpl);?>

                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']*-1),$_smarty_tpl);?>

                                    <?php }?>
                                </span>
                            </td>
                            <td>
                                
                                <?php if (strlen($_smarty_tpl->tpl_vars['discount']->value['code'])) {?>
                                    <a href="<?php if ($_smarty_tpl->tpl_vars['opc']->value) {?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order-opc',true);?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true);?>
<?php }?>?deleteDiscount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
" class="cart_discount_delete" attr-id_discount="<?php echo intval($_smarty_tpl->tpl_vars['discount']->value['id_discount']);?>
" title="<?php echo smartyTranslate(array('s'=>'Delete','mod'=>'bestkit_opc'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Delete','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
                                <?php }?>
                                
                            </td>
                            <td>
                                <span class="price-opc">
                                    <?php if (!$_smarty_tpl->tpl_vars['priceDisplay']->value) {?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']*-1),$_smarty_tpl);?>

                                    <?php } else { ?>
                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['displayPrice'][0][0]->displayPriceSmarty(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']*-1),$_smarty_tpl);?>

                                    <?php }?>
                                </span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            <?php }?>
        </table>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['show_option_allow_separate_package']->value) {?>
        <p class="checkbox">
            <label for="allow_seperated_package">
                <input type="checkbox" name="allow_seperated_package" id="allow_seperated_package" <?php if ($_smarty_tpl->tpl_vars['cart']->value->allow_seperated_package) {?>checked="checked"<?php }?> />
                <?php echo smartyTranslate(array('s'=>'Send the available products first','mod'=>'bestkit_opc'),$_smarty_tpl);?>

            </label>
        </p>
    <?php }?>
    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <?php if (Configuration::get('PS_ALLOW_MULTISHIPPING')) {?>
            <p class="checkbox">
                <label for="enable-multishipping">
                    <input type="checkbox" <?php if ($_smarty_tpl->tpl_vars['multi_shipping']->value) {?>checked="checked"<?php }?> id="enable-multishipping" />
                    <?php echo smartyTranslate(array('s'=>'I want to specify a delivery address for each individual product.','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                </label>
            </p>
        <?php }?>
    <?php }?>

    <div id="HOOK_SHOPPING_CART"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART']->value, false);?>
</div>

    
    
    <?php if (!isset($_smarty_tpl->tpl_vars['addresses_style']->value)) {?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['company'] = 'address_company';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['vat_number'] = 'address_company';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['firstname'] = 'address_name';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['lastname'] = 'address_name';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['address1'] = 'address_address1';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['address2'] = 'address_address2';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['city'] = 'address_city';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['country'] = 'address_country';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['phone'] = 'address_phone';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['phone_mobile'] = 'address_phone_mobile';?>
        <?php $_smarty_tpl->createLocalArrayVariable('addresses_style', null, 0);
$_smarty_tpl->tpl_vars['addresses_style']->value['alias'] = 'address_title';?>
    <?php }?>

    <?php if (((!empty($_smarty_tpl->tpl_vars['delivery_option']->value)&&!isset($_smarty_tpl->tpl_vars['virtualCart']->value))||$_smarty_tpl->tpl_vars['delivery']->value->id||$_smarty_tpl->tpl_vars['invoice']->value->id)&&!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <div class="order_delivery clearfix">
            <?php if (!isset($_smarty_tpl->tpl_vars['formattedAddresses']->value)) {?>
                <?php if ($_smarty_tpl->tpl_vars['delivery']->value->id) {?>
                    <ul id="delivery_address" class="address item">
                        <li class="address_title"><?php echo smartyTranslate(array('s'=>'Delivery address','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</li>
                        <?php if ($_smarty_tpl->tpl_vars['delivery']->value->company) {?><li class="address_company"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->company, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li><?php }?>
                        <li class="address_name"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->firstname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->lastname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <li class="address_address1"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->address1, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <?php if ($_smarty_tpl->tpl_vars['delivery']->value->address2) {?><li class="address_address2"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->address2, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li><?php }?>
                        <li class="address_city"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->postcode, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->city, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <li class="address_country"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery']->value->country, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['delivery_state']->value) {?>(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['delivery_state']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
)<?php }?></li>
                    </ul>
                <?php }?>
                <?php if ($_smarty_tpl->tpl_vars['invoice']->value->id) {?>
                    <ul id="invoice_address" class="address alternate_item">
                        <li class="address_title"><?php echo smartyTranslate(array('s'=>'Invoice address','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</li>
                        <?php if ($_smarty_tpl->tpl_vars['invoice']->value->company) {?><li class="address_company"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->company, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li><?php }?>
                        <li class="address_name"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->firstname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->lastname, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <li class="address_address1"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->address1, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <?php if ($_smarty_tpl->tpl_vars['invoice']->value->address2) {?><li class="address_address2"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->address2, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li><?php }?>
                        <li class="address_city"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->postcode, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->city, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</li>
                        <li class="address_country"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice']->value->country, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['invoice_state']->value) {?>(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['invoice_state']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
)<?php }?></li>
                    </ul>
                <?php }?>
            <?php } else { ?>
                <?php  $_smarty_tpl->tpl_vars['address'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['address']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['formattedAddresses']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['address']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['address']->iteration=0;
 $_smarty_tpl->tpl_vars['address']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['address']->key => $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->_loop = true;
 $_smarty_tpl->tpl_vars['address']->iteration++;
 $_smarty_tpl->tpl_vars['address']->index++;
 $_smarty_tpl->tpl_vars['address']->first = $_smarty_tpl->tpl_vars['address']->index === 0;
 $_smarty_tpl->tpl_vars['address']->last = $_smarty_tpl->tpl_vars['address']->iteration === $_smarty_tpl->tpl_vars['address']->total;
?>
                    <ul class="address <?php if ($_smarty_tpl->tpl_vars['address']->last) {?>last_item<?php } elseif ($_smarty_tpl->tpl_vars['address']->first) {?>first_item<?php }?> <?php if ($_smarty_tpl->tpl_vars['address']->index%2) {?>alternate_item<?php } else { ?>item<?php }?>">
                        <li class="address_title"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['address']->value['object']['alias'], false);?>
</li>
                        <?php  $_smarty_tpl->tpl_vars['pattern'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pattern']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['address']->value['ordered']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['pattern']->key => $_smarty_tpl->tpl_vars['pattern']->value) {
$_smarty_tpl->tpl_vars['pattern']->_loop = true;
?>
                            <?php $_smarty_tpl->tpl_vars['addressKey'] = new Smarty_variable(explode(" ",$_smarty_tpl->tpl_vars['pattern']->value), null, 0);?>
                            <li>
                            <?php  $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['key']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['addressKey']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['key']->key => $_smarty_tpl->tpl_vars['key']->value) {
$_smarty_tpl->tpl_vars['key']->_loop = true;
?>
                                <span class="<?php if (isset($_smarty_tpl->tpl_vars['addresses_style']->value[$_smarty_tpl->tpl_vars['key']->value])) {?><?php echo $_smarty_tpl->tpl_vars['addresses_style']->value[$_smarty_tpl->tpl_vars['key']->value];?>
<?php }?>">
                                    <?php if (isset($_smarty_tpl->tpl_vars['address']->value['formated'][$_smarty_tpl->tpl_vars['key']->value])) {?>
                                        <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['address']->value['formated'][$_smarty_tpl->tpl_vars['key']->value], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                    <?php }?>
                                </span>
                            <?php } ?>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            <?php }?>
        </div>
    <?php }?>
    <?php if (!empty($_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART_EXTRA']->value)) {?>
        <div class="cart_navigation_extra">
            <div id="HOOK_SHOPPING_CART_EXTRA"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['HOOK_SHOPPING_CART_EXTRA']->value, false);?>
</div>
        </div>
    <?php }?>
<?php }?>
</div><?php }} ?>
