<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 12:12:55
         compiled from "/var/www/html/themes/elation-advance-touch/modules/belvg_preorderproducts/views/frontend/preorderproducts.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18905571325891d0c77a88b3-91693754%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd07353a26de009995063193d2e008449da64cfcb' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/belvg_preorderproducts/views/frontend/preorderproducts.tpl',
      1 => 1476995956,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18905571325891d0c77a88b3-91693754',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isLogged' => 0,
    'po_items' => 0,
    'po_item' => 0,
    'allow_product_tab' => 0,
    'po_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891d0c77fbf22_67004316',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891d0c77fbf22_67004316')) {function content_5891d0c77fbf22_67004316($_smarty_tpl) {?>

<!-- Belvg_PreOrderProducts -->

<script type="text/javascript">
	var isLogged = <?php echo $_smarty_tpl->tpl_vars['isLogged']->value;?>

</script>


<?php if (count($_smarty_tpl->tpl_vars['po_items']->value)) {?>
    <style type="text/css">
        .defaultCountdown { width: 250px; height: 60px; margin: 0 0 10px 0; padding: 10px 0 0 0; display:block; font-weight: bold; font-size:13px }
    </style>

    <div style="clear:both;"></div>

    <?php  $_smarty_tpl->tpl_vars['po_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['po_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['po_items']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['po_item']->key => $_smarty_tpl->tpl_vars['po_item']->value) {
$_smarty_tpl->tpl_vars['po_item']->_loop = true;
?>
    <span id="pp_<?php echo intval($_smarty_tpl->tpl_vars['po_item']->value['id_product_attribute']);?>
" class="pp_countdown_container">
        <?php if (isset($_smarty_tpl->tpl_vars['po_item']->value['po_item'])&&$_smarty_tpl->tpl_vars['po_item']->value['po_item']->active&&$_smarty_tpl->tpl_vars['allow_product_tab']->value) {?>
            <span id="defaultCountdown_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
" class="defaultCountdown"></span>
            <span id="preorder_availability_value_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
" class="warning_inline"><?php echo smartyTranslate(array('s'=>'Your order will be formed after the product is back in stock','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</span>
            <input type="submit" id="add_to_preorder_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
" class="add_to_preorder exclusive" value="<?php echo smartyTranslate(array('s'=>'Pre-Order','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
" name="PreOrderSubmit">
            <input type="hidden" name="id_preorder" value="<?php if ((isset($_smarty_tpl->tpl_vars['po_product']->value))) {?><?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
<?php }?>" />

            <?php if ($_smarty_tpl->tpl_vars['po_item']->value['po_item']->countdown_active&&$_smarty_tpl->tpl_vars['po_item']->value['po_item']->active) {?>
                
                <script type="text/javascript">
                $(function () {
                    var austDay = new Date("<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->expire_datetime;?>
"); //'06 March 2012 16:32:22'
                    //var austDay = new Date('6 March 2012 16:32:22');
                    $('#defaultCountdown_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
').countdown({until: austDay, onExpiry: ajaxPreorder.switchStatus, serverSync: ajaxPreorder.serverTime});
                    $('#year').text(austDay.getFullYear());

                });
                </script>
                
            <?php } else { ?>
                <style type="text/css">
                    #defaultCountdown_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['po_item']->id_belvg_preorder_product;?>
 { display:none }
                </style>
            <?php }?>
        <?php }?>

        <br>
        <span class="reloadWaitContent">
        <?php if ((isset($_smarty_tpl->tpl_vars['po_item']->value['wait_id'])&&$_smarty_tpl->tpl_vars['po_item']->value['wait_id']&&$_smarty_tpl->tpl_vars['isLogged']->value)) {?>
            <span class="wait_container">
                <input type="submit" id="unsubscribe_me_<?php echo $_smarty_tpl->tpl_vars['po_item']->value['wait_id'];?>
" class="exclusive_large waitsubmit" value="<?php echo smartyTranslate(array('s'=>'Unsubscribe me','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
" name="waitsubmit">
                <input type="hidden" name="action" value="unsubscribe" />
                <input type="hidden" name="wait_id" value="<?php echo $_smarty_tpl->tpl_vars['po_item']->value['wait_id'];?>
" />
            </span>
        <?php } else { ?>
            <span class="wait_container">
                <input type="submit" class="exclusive_large waitsubmit" value="<?php echo smartyTranslate(array('s'=>'Notify me when back in stock','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
" name="waitsubmit">
                <input type="hidden" name="action" value="subscribe" />
            </span>
        <?php }?>
        </span>

    </span>
    <?php } ?>
<?php }?>
<!-- /Belvg_PreOrderProducts -->
<?php }} ?>
