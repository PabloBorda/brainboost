<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:34:04
         compiled from "/var/www/html/themes/elation-advance-touch/modules/belvg_preorderproducts/views/admin/productAdminTab.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8898560105891c7ac9a03f7-88733059%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbf77c5b2c804e0cb74195cff04ea027205b34a3' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/belvg_preorderproducts/views/admin/productAdminTab.tpl',
      1 => 1476995956,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8898560105891c7ac9a03f7-88733059',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'belvg_pp_errors' => 0,
    'belvg_pp_data' => 0,
    'pp_item' => 0,
    'server_time_load' => 0,
    'po_product' => 0,
    'id_product' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c7aca7c123_08000926',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c7aca7c123_08000926')) {function content_5891c7aca7c123_08000926($_smarty_tpl) {?>

<div id="belvg-preorderproducts" class="panel product-tab">
    <?php echo $_smarty_tpl->tpl_vars['belvg_pp_errors']->value;?>

	<input type="hidden" name="submitted_tabs[]" value="Belvg_PreOrderProducts" />
	<h4><?php echo smartyTranslate(array('s'=>'Pre-Order Products','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</h4>
	<div class="separation"></div>
    <?php if (count($_smarty_tpl->tpl_vars['belvg_pp_data']->value['attributes_resume'])) {?>
	<fieldset style="border:none;">
        <table border="0" cellpadding="0" cellspacing="0" class="table">
            <col width="600px"/>
            <col/>
            <col/>
            <col/>
            <col/>
            <thead>
                <tr>
                    <th><?php echo smartyTranslate(array('s'=>'Name','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Allow pre-order','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Allow countdown','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Date available','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</th>
                    <th><?php echo smartyTranslate(array('s'=>'Init Qty','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</th>
                </tr>
            </thead>
            <tbody>
                <?php  $_smarty_tpl->tpl_vars['pp_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['pp_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['belvg_pp_data']->value['attributes_resume']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['collection']['index']=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['pp_item']->key => $_smarty_tpl->tpl_vars['pp_item']->value) {
$_smarty_tpl->tpl_vars['pp_item']->_loop = true;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['collection']['index']++;
?>
                <tr class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['collection']['index']%2!=0) {?>alt<?php }?>">
                    <td><?php echo $_smarty_tpl->tpl_vars['pp_item']->value['attribute_designation'];?>
</td>
                    <td>
                        <input type="checkbox" class="allow_pre_order" name="allow_pre_order[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['collection']['index'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['pp_item']->value['id_product_attribute'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])&&($_smarty_tpl->tpl_vars['pp_item']->value['po_product']->active))) {?> checked="checked" <?php }?> />
                    </td>
                    <td>
                        <input type="checkbox" class="allow_countdown" name="allow_countdown[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['collection']['index'];?>
]" value="<?php echo $_smarty_tpl->tpl_vars['pp_item']->value['id_product_attribute'];?>
" <?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])&&($_smarty_tpl->tpl_vars['pp_item']->value['po_product']->countdown_active))) {?> checked="checked" <?php }?> />
                    </td>
                    <td>
                        <input type="text" class="datepicker" name="expire_datetime[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['collection']['index'];?>
]" value="<?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product']))) {?><?php echo $_smarty_tpl->tpl_vars['pp_item']->value['po_product']->expire_datetime;?>
<?php }?>" <?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])&&!$_smarty_tpl->tpl_vars['pp_item']->value['po_product']->countdown_active)||!isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])) {?> style="display:none" <?php }?> />
                    </td>
                    <td>
                        <input type="text" class="qty" name="qty[<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['collection']['index'];?>
]" value="<?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product']))) {?><?php echo $_smarty_tpl->tpl_vars['pp_item']->value['po_product']->quantity;?>
<?php } else { ?>100<?php }?>" <?php if ((isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])&&!$_smarty_tpl->tpl_vars['pp_item']->value['po_product']->countdown_active)||!isset($_smarty_tpl->tpl_vars['pp_item']->value['po_product'])) {?> style="display:none" <?php }?> />
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    
        <input type="hidden" value="0" name="cc"/>
        <div class="clear">&nbsp;</div>
        
        <label><?php echo smartyTranslate(array('s'=>'Server Time','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
:</label>
        <div class="margin-form">
            <div id="server_time_load" style="padding-top:3px"><?php echo $_smarty_tpl->tpl_vars['server_time_load']->value;?>
</div>
        </div>
        <div class="clear">&nbsp;</div>

        <input type="hidden" name="id_preorder" value="<?php if ((isset($_smarty_tpl->tpl_vars['po_product']->value))) {?><?php echo $_smarty_tpl->tpl_vars['po_product']->value->id;?>
<?php }?>" />
        <input type="hidden" name="id_product" value="<?php if ((isset($_smarty_tpl->tpl_vars['id_product']->value))) {?><?php echo $_smarty_tpl->tpl_vars['id_product']->value;?>
<?php }?>" />
	</fieldset>
    <?php } else { ?>
        <div class="warn"><?php echo smartyTranslate(array('s'=>'No availiable products for preorder (qty>0)','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</div>
    <?php }?>
	<div class="separation"></div>
	<div class="clear">&nbsp;</div>
    
    
    <script type="text/javascript">
        $('.qty').change(function() {
            if($(this).val() > 0){
                $(this).parents("tr:first").find(".allow_pre_order").attr('checked', true);
            }
        });
    
        $(document).ready(function(){
            $('.datepicker').datetimepicker({
                prevText: '',
                nextText: '',
                dateFormat: 'yy-mm-dd',

                // Define a custom regional settings in order to use PrestaShop translation tools
                currentText: 'Now',
                closeText: 'Done',
                ampm: false,
                amNames: ['AM', 'A'],
                pmNames: ['PM', 'P'],
                timeFormat: 'hh:mm:ss tt',
                timeSuffix: '',
                timeOnlyTitle: 'Choose Time',
                timeText: 'Time',
                hourText: 'Hour',
                minuteText: 'Minute',
            });
            
            /*$( ".allow_countdown" ).each(function( index ) {
                manageAttr(this);
            });*/
        });
        
        $( ".allow_countdown" ).click(function() {
            manageAttr(this);
        });
        
        function manageAttr(obj) {
            if ($(obj).attr("checked")) {
                $(obj).parents("tr").find(".datepicker").fadeIn()
                $(obj).parents("tr").find(".qty").fadeIn()
            } else {
                $(obj).parents("tr").find(".datepicker").fadeOut()
                $(obj).parents("tr").find(".qty").fadeOut()
            }
        }
    </script>
    

    <div class="separation"></div>
    <div class="clear">&nbsp;</div>

    <div class="panel-footer">
        <a href="<?php echo Context::getContext()->link->getAdminLink('AdminProducts');?>
" class="btn btn-default"><i class="process-icon-cancel"></i> <?php echo smartyTranslate(array('s'=>'Cancel','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> <?php echo smartyTranslate(array('s'=>'Save and stay','mod'=>'belvg_preorderproducts'),$_smarty_tpl);?>
</button>
    </div>
</div><?php }} ?>
