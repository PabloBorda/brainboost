<?php /* Smarty version Smarty-3.1.19, created on 2017-05-23 01:34:33
         compiled from "/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-carrier.tpl" */ ?>
<?php /*%%SmartyHeaderCode:104773519592383994bae34-75578170%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '74afadbd272471770a2f5326e4b394db4eb57d92' => 
    array (
      0 => '/home/brainboo/public_html/modules/bestkit_opc/views/templates/front/order-carrier.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '104773519592383994bae34-75578170',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'opc' => 0,
    'virtual_cart' => 0,
    'giftAllowed' => 0,
    'cart' => 0,
    'multi_shipping' => 0,
    'link' => 0,
    'isVirtualCart' => 0,
    'delivery_option_list' => 0,
    'option_list' => 0,
    'id_address' => 0,
    'key' => 0,
    'delivery_option' => 0,
    'option' => 0,
    'carrier' => 0,
    'cookie' => 0,
    'free_shipping' => 0,
    'use_taxes' => 0,
    'product' => 0,
    'HOOK_EXTRACARRIER_ADDR' => 0,
    'address' => 0,
    'carriers' => 0,
    'HOOK_BEFORECARRIER' => 0,
    'recyclablePackAllowed' => 0,
    'recyclable' => 0,
    'gift_wrapping_price' => 0,
    'priceDisplay' => 0,
    'total_wrapping_tax_exc_cost' => 0,
    'total_wrapping_cost' => 0,
    'back' => 0,
    'is_guest' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_592383996aefe8_96464693',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_592383996aefe8_96464693')) {function content_592383996aefe8_96464693($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<div id="carrier_area">
    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        
            <script type="text/javascript">
                var orderProcess = 'order';
                var currencySign = '{$currencySign|html_entity_decode:2:"UTF-8"}';
                var currencyRate = '{$currencyRate|floatval}';
                var currencyFormat = '{$currencyFormat|intval}';
                var currencyBlank = '{$currencyBlank|intval}';
                var txtProduct = "{l s='product' mod='bestkit_opc'}";
                var txtProducts = "{l s='products' mod='bestkit_opc'}";
                var orderUrl = '{$link->getPageLink("order", true)|escape:false}';
                var msg = "{l s='You must agree to the terms of service before continuing.' js=1 mod='bestkit_opc'}";

                function acceptCGV() {
                    if ($('#cgv').length && !$('input#cgv:checked').length) {
                        alert(msg);
                        return false;
                    }
                    else {
                        return true;
                    }
                }
            </script>
        
    <?php } else { ?>
        <script type="text/javascript">
            var txtFree = "<?php echo smartyTranslate(array('s'=>'Free!','mod'=>'bestkit_opc'),$_smarty_tpl);?>
";
        </script>
    <?php }?>

    <?php if (isset($_smarty_tpl->tpl_vars['virtual_cart']->value)&&!$_smarty_tpl->tpl_vars['virtual_cart']->value&&$_smarty_tpl->tpl_vars['giftAllowed']->value&&$_smarty_tpl->tpl_vars['cart']->value->gift==1) {?>
        
            <script type="text/javascript">
                $('document').ready( function(){
                    if ($('input#gift').is(':checked')){
                        $('#gift_msg').slideDown();
                    }
                });
            </script>
        
    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'bestkit_opc'),$_smarty_tpl);?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <h1 class="page-heading"><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h1>
    <?php } else { ?>
        <h1 class="page-heading"><span class="heading-counter heading-counter-2">2</span><?php echo smartyTranslate(array('s'=>'Delivery methods','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h1>
    <?php }?>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
        <?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('shipping', null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

        <form id="form" action="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,"multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), false);?>
" method="post" onsubmit="return acceptCGV();">
    <?php } else { ?>
        <div id="opc_delivery_methods" class="opc-main-block">
            <div id="opc_delivery_methods-overlay" class="overlay-opc" style="display: none;"></div>
    <?php }?>

    <div class="box box-opc">

    <?php if (isset($_smarty_tpl->tpl_vars['virtual_cart']->value)&&$_smarty_tpl->tpl_vars['virtual_cart']->value) {?>
        <input id="input_virtual_carrier" class="hidden" type="hidden" name="id_carrier" value="0" />
    <?php } else { ?>
        <?php if (isset($_smarty_tpl->tpl_vars['isVirtualCart']->value)&&$_smarty_tpl->tpl_vars['isVirtualCart']->value) {?>
            <div class="item">
                <p class="alert alert-warning"><?php echo smartyTranslate(array('s'=>'No carrier needed for this order','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</p>
            </div>
        <?php }?>

        <div class="item">
            <?php if (isset($_smarty_tpl->tpl_vars['delivery_option_list']->value)) {?>
                <?php  $_smarty_tpl->tpl_vars['option_list'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option_list']->_loop = false;
 $_smarty_tpl->tpl_vars['id_address'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['delivery_option_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['option_list']->key => $_smarty_tpl->tpl_vars['option_list']->value) {
$_smarty_tpl->tpl_vars['option_list']->_loop = true;
 $_smarty_tpl->tpl_vars['id_address']->value = $_smarty_tpl->tpl_vars['option_list']->key;
?>
                    
                    <div class="shipping-delivery-opc">
                    <?php  $_smarty_tpl->tpl_vars['option'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['option']->_loop = false;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['option_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['option']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['option']->key => $_smarty_tpl->tpl_vars['option']->value) {
$_smarty_tpl->tpl_vars['option']->_loop = true;
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['option']->key;
 $_smarty_tpl->tpl_vars['option']->index++;
?>
                        <label for="delivery_option_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['id_address']->value, false);?>
_<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['option']->index, false);?>
" class="shipping-delivery-item-opc">
                            <table class="resume table-opc">
                                <colgroup>
                                    <col width="1" />
                                    <col width="1" />
                                    <col />
                                    <col width="1" />
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="radio-inline">
                                                <input class="delivery_option_radio" type="radio" name="delivery_option[<?php echo $_smarty_tpl->tpl_vars['id_address']->value;?>
]" onchange="<?php if ($_smarty_tpl->tpl_vars['opc']->value) {?>updateCarrierSelectionAndGift();<?php } else { ?>updateExtraCarrier('<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
', <?php echo $_smarty_tpl->tpl_vars['id_address']->value;?>
);<?php }?>" id="delivery_option_<?php echo $_smarty_tpl->tpl_vars['id_address']->value;?>
_<?php echo $_smarty_tpl->tpl_vars['option']->index;?>
" value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if (isset($_smarty_tpl->tpl_vars['delivery_option']->value[$_smarty_tpl->tpl_vars['id_address']->value])&&$_smarty_tpl->tpl_vars['delivery_option']->value[$_smarty_tpl->tpl_vars['id_address']->value]==$_smarty_tpl->tpl_vars['key']->value) {?>checked="checked"<?php }?> />
                                            </div>
                                        </td>
                                        <td>
                                            <?php  $_smarty_tpl->tpl_vars['carrier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['carrier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['option']->value['carrier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['carrier']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['carrier']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['carrier']->key => $_smarty_tpl->tpl_vars['carrier']->value) {
$_smarty_tpl->tpl_vars['carrier']->_loop = true;
 $_smarty_tpl->tpl_vars['carrier']->iteration++;
 $_smarty_tpl->tpl_vars['carrier']->last = $_smarty_tpl->tpl_vars['carrier']->iteration === $_smarty_tpl->tpl_vars['carrier']->total;
?>
                                                <?php if ($_smarty_tpl->tpl_vars['carrier']->value['logo']) {?>
                                                    <img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['logo'], false);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->name, false);?>
" class="shipping-logo-opc" />
                                                <?php } elseif (!$_smarty_tpl->tpl_vars['option']->value['unique_carrier']) {?>
                                                    <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->name, false);?>

                                                    <?php if (!$_smarty_tpl->tpl_vars['carrier']->last) {?> - <?php }?>
                                                <?php }?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->tpl_vars['option']->value['unique_carrier']) {?>
                                                <?php  $_smarty_tpl->tpl_vars['carrier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['carrier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['option']->value['carrier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['carrier']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['carrier']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['carrier']->key => $_smarty_tpl->tpl_vars['carrier']->value) {
$_smarty_tpl->tpl_vars['carrier']->_loop = true;
 $_smarty_tpl->tpl_vars['carrier']->iteration++;
 $_smarty_tpl->tpl_vars['carrier']->last = $_smarty_tpl->tpl_vars['carrier']->iteration === $_smarty_tpl->tpl_vars['carrier']->total;
?>
                                                    <h4 class="shipping-title-opc"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->name, false);?>
</h4>
                                                <?php } ?>
                                                <?php if (isset($_smarty_tpl->tpl_vars['carrier']->value['instance']->delay[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])) {?>
                                                    <div class="shipping-desc-opc"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->delay[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], false);?>
</div>
                                                <?php }?>
                                            <?php }?>
                                            <?php if (count($_smarty_tpl->tpl_vars['option_list']->value)>1) {?>
                                                <?php if ($_smarty_tpl->tpl_vars['option']->value['is_best_grade']) {?>
                                                    <?php if ($_smarty_tpl->tpl_vars['option']->value['is_best_price']) {?>
                                                        <div class="delivery_option_best delivery_option_icon"><?php echo smartyTranslate(array('s'=>'The best price and speed','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</div>
                                                    <?php } else { ?>
                                                        <div class="delivery_option_fast delivery_option_icon"><?php echo smartyTranslate(array('s'=>'The fastest','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</div>
                                                    <?php }?>
                                                <?php } else { ?>
                                                    <?php if ($_smarty_tpl->tpl_vars['option']->value['is_best_price']) {?>
                                                        <div class="delivery_option_best_price delivery_option_icon"><?php echo smartyTranslate(array('s'=>'The best price','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</div>
                                                    <?php }?>
                                                <?php }?>
                                            <?php }?>
                                        </td>
                                        <td>
                                            <?php if ($_smarty_tpl->tpl_vars['option']->value['total_price_with_tax']&&!$_smarty_tpl->tpl_vars['free_shipping']->value) {?>
                                                <div class="shipping-price-opc">
                                                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value==1) {?>
                                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['option']->value['total_price_with_tax']),$_smarty_tpl);?>

                                                        <br />
                                                        <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                                    <?php } else { ?>
                                                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['option']->value['total_price_without_tax']),$_smarty_tpl);?>

                                                        <br />
                                                        <?php echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                                    <?php }?>
                                                </div>
                                            <?php } else { ?>
                                                <span class="price-opc free-price-opc"><?php echo smartyTranslate(array('s'=>'Free!','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</span>
                                            <?php }?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table-opc <?php if (isset($_smarty_tpl->tpl_vars['delivery_option']->value[$_smarty_tpl->tpl_vars['id_address']->value])&&$_smarty_tpl->tpl_vars['delivery_option']->value[$_smarty_tpl->tpl_vars['id_address']->value]==$_smarty_tpl->tpl_vars['key']->value) {?>selected<?php }?> <?php if ($_smarty_tpl->tpl_vars['option']->value['unique_carrier']) {?>hidden<?php }?>">
                                <?php  $_smarty_tpl->tpl_vars['carrier'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['carrier']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['option']->value['carrier_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['carrier']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['carrier']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['carrier']->key => $_smarty_tpl->tpl_vars['carrier']->value) {
$_smarty_tpl->tpl_vars['carrier']->_loop = true;
 $_smarty_tpl->tpl_vars['carrier']->iteration++;
 $_smarty_tpl->tpl_vars['carrier']->last = $_smarty_tpl->tpl_vars['carrier']->iteration === $_smarty_tpl->tpl_vars['carrier']->total;
?>
                                    <tr>
                                        <?php if (!$_smarty_tpl->tpl_vars['option']->value['unique_carrier']) {?>
                                            <td>
                                                <input type="hidden" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->id, false);?>
" name="id_carrier" />
                                                <?php if ($_smarty_tpl->tpl_vars['carrier']->value['logo']) {?>
                                                    <img src="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['logo'], false);?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->name, false);?>
" class="shipping-logo-opc" />
                                                <?php }?>
                                            </td>
                                            <td>
                                                <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->name, false);?>

                                            </td>
                                        <?php }?>
                                        <td <?php if ($_smarty_tpl->tpl_vars['option']->value['unique_carrier']) {?>colspan="2"<?php }?>>
                                            <input type="hidden" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->id, false);?>
" name="id_carrier" />
                                            <?php if (isset($_smarty_tpl->tpl_vars['carrier']->value['instance']->delay[$_smarty_tpl->tpl_vars['cookie']->value->id_lang])) {?>
                                                <small>
                                                    <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['carrier']->value['instance']->delay[$_smarty_tpl->tpl_vars['cookie']->value->id_lang], false);?>

                                                    <br />
                                                    <?php if (count($_smarty_tpl->tpl_vars['carrier']->value['product_list'])<=1) {?>
                                                        (<?php echo smartyTranslate(array('s'=>'product concerned:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                                    <?php } else { ?>
                                                        (<?php echo smartyTranslate(array('s'=>'products concerned:','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                                    <?php }?>
                                                    
                                                    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['carrier']->value['product_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
?><?php if ($_smarty_tpl->tpl_vars['product']->index==4) {?><acronym title="<?php }?><?php if ($_smarty_tpl->tpl_vars['product']->index>=4) {?><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
<?php if (!$_smarty_tpl->tpl_vars['product']->last) {?>, <?php } else { ?>">...</acronym>)<?php }?><?php } else { ?><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
<?php if (!$_smarty_tpl->tpl_vars['product']->last) {?>, <?php } else { ?>)<?php }?><?php }?><?php } ?>
                                                </small>
                                            <?php }?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </label>
                    <?php } ?>
                    </div>
                    <div class="hook_extracarrier" id="HOOK_EXTRACARRIER_<?php echo $_smarty_tpl->tpl_vars['id_address']->value;?>
"><?php if (isset($_smarty_tpl->tpl_vars['HOOK_EXTRACARRIER_ADDR']->value)&&isset($_smarty_tpl->tpl_vars['HOOK_EXTRACARRIER_ADDR']->value[$_smarty_tpl->tpl_vars['id_address']->value])) {?><?php echo $_smarty_tpl->tpl_vars['HOOK_EXTRACARRIER_ADDR']->value[$_smarty_tpl->tpl_vars['id_address']->value];?>
<?php }?></div>
                    <?php }
if (!$_smarty_tpl->tpl_vars['option_list']->_loop) {
?>
                    <p class="alert alert-warning" id="noCarrierWarning">
                        <?php  $_smarty_tpl->tpl_vars['address'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['address']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value->getDeliveryAddressesWithoutCarriers(true); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['address']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['address']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['address']->key => $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->_loop = true;
 $_smarty_tpl->tpl_vars['address']->iteration++;
 $_smarty_tpl->tpl_vars['address']->last = $_smarty_tpl->tpl_vars['address']->iteration === $_smarty_tpl->tpl_vars['address']->total;
?>
                            <?php if (empty($_smarty_tpl->tpl_vars['address']->value->alias)) {?>
                                <?php echo smartyTranslate(array('s'=>'No carriers available.','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                            <?php } else { ?>
                                <?php echo smartyTranslate(array('s'=>'No carriers available for the address "%s".','sprintf'=>$_smarty_tpl->tpl_vars['address']->value->alias,'mod'=>'bestkit_opc'),$_smarty_tpl);?>

                            <?php }?>
                            <?php if (!$_smarty_tpl->tpl_vars['address']->last) {?>
                                <br />
                            <?php }?>
                        <?php } ?>
                    </p>
                <?php } ?>
            <?php }?>
        </div>

        <div class="item">
            
            <div id="HOOK_BEFORECARRIER"><?php if (isset($_smarty_tpl->tpl_vars['carriers']->value)&&isset($_smarty_tpl->tpl_vars['HOOK_BEFORECARRIER']->value)) {?><?php echo $_smarty_tpl->tpl_vars['HOOK_BEFORECARRIER']->value;?>
<?php }?></div>
            <?php if ($_smarty_tpl->tpl_vars['recyclablePackAllowed']->value) {?>
                <div class="checkbox">
                    <label for="recyclable">
                        <div class="checker hover <?php if ($_smarty_tpl->tpl_vars['recyclable']->value==1) {?>active<?php }?> focus" id="uniform-recyclable">
                                <span>
                                    <input type="checkbox" name="recyclable" id="recyclable" value="1" <?php if ($_smarty_tpl->tpl_vars['recyclable']->value==1) {?>checked="checked"<?php }?> />
                                </span>
                        </div>
                        <?php echo smartyTranslate(array('s'=>'I agree to receive my order in recycled packaging','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                    </label>
                </div>
            <?php }?>
        </div>
                <div style="display: none;" id="extra_carrier"></div>
                <?php if ($_smarty_tpl->tpl_vars['giftAllowed']->value) {?>
                    <div class="item">
                        <h2 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Gift','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</h2>
                        <div class="checkbox">
                            <label for="gift">
                                <div class="checker <?php if ($_smarty_tpl->tpl_vars['cart']->value->gift==1) {?>active<?php }?> focus" id="uniform-gift">
                                    <span>
                                        <input type="checkbox" name="gift" id="gift" value="1" <?php if ($_smarty_tpl->tpl_vars['cart']->value->gift==1) {?>checked="checked"<?php }?> />
                                    </span>
                                </div>
                                <?php echo smartyTranslate(array('s'=>'I would like my order to be gift-wrapped','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <?php if ($_smarty_tpl->tpl_vars['gift_wrapping_price']->value>0) {?>
                                    (<?php echo smartyTranslate(array('s'=>'Additional cost of','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                    <span class="price-opc" id="gift-price">
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1) {?>
                                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping_tax_exc_cost']->value),$_smarty_tpl);?>

                                        <?php } else { ?>
                                            <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['convertPrice'][0][0]->convertPrice(array('price'=>$_smarty_tpl->tpl_vars['total_wrapping_cost']->value),$_smarty_tpl);?>

                                        <?php }?>
                                    </span>
                                    <?php if ($_smarty_tpl->tpl_vars['use_taxes']->value) {?>
                                        <?php if ($_smarty_tpl->tpl_vars['priceDisplay']->value==1) {?>
                                            <?php echo smartyTranslate(array('s'=>'(tax excl.)','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                        <?php } else { ?>
                                            <?php echo smartyTranslate(array('s'=>'(tax incl.)','mod'=>'bestkit_opc'),$_smarty_tpl);?>

                                        <?php }?>
                                    <?php }?>)
                                <?php }?>
                            </label>
                        </div>
                        <div id="gift_msg" class="textarea" style="display:none;">
                            <label for="gift_message"><?php echo smartyTranslate(array('s'=>'If you wish, you can add a note to the gift:','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</label>
                            <textarea rows="5" cols="35" id="gift_message" name="gift_message" class="form-control"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value->gift_message, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</textarea>
                        </div>
                    </div>
                <?php }?>
            <?php }?>

        

        <?php echo $_smarty_tpl->getSubTemplate (Module::getInstanceByName('bestkit_opc')->getTemplatePath('order-message.tpl'), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    </div>

    <?php if (!$_smarty_tpl->tpl_vars['opc']->value) {?>
            <p class="submit">
                <input type="hidden" name="step" value="3" />
                <input type="hidden" name="back" value="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['back']->value, false);?>
" />
                <?php if (!$_smarty_tpl->tpl_vars['is_guest']->value) {?>
                    <?php if ($_smarty_tpl->tpl_vars['back']->value) {?>
                        <a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,"step=1&back=".((string)$_smarty_tpl->tpl_vars['back']->value)."&multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), false);?>
" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" class="button">&laquo; <?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
                    <?php } else { ?>
                        <a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,"step=1&multi-shipping=".((string)$_smarty_tpl->tpl_vars['multi_shipping']->value)), false);?>
" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" class="button">&laquo; <?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
                    <?php }?>
                <?php } else { ?>
                        <a href="<?php ob_start();?><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['multi_shipping']->value, false);?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->tpl_vars['link']->value->getPageLink('order',true,null,"multi-shipping=".$_tmp1);?>
" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
" class="button">&laquo; <?php echo smartyTranslate(array('s'=>'Previous','mod'=>'bestkit_opc'),$_smarty_tpl);?>
</a>
                <?php }?>
                <?php if (isset($_smarty_tpl->tpl_vars['virtual_cart']->value)&&$_smarty_tpl->tpl_vars['virtual_cart']->value||(isset($_smarty_tpl->tpl_vars['delivery_option_list']->value)&&!empty($_smarty_tpl->tpl_vars['delivery_option_list']->value))) {?>
                    <input type="submit" name="processCarrier" value="<?php echo smartyTranslate(array('s'=>'Next','mod'=>'bestkit_opc'),$_smarty_tpl);?>
 &raquo;" class="exclusive" />
                <?php }?>
            </p>
        </form>
    <?php } else { ?>
        </div>
    <?php }?>
</div>
<?php }} ?>
