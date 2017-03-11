{*
* 2007-2013 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
*         DISCLAIMER   *
* *************************************** */
/* Do not edit or add to this file if you wish to upgrade Prestashop to newer
* versions in the future.
* ****************************************************
* @category   Belvg
* @package    Belvg_PreOrderProducts
* @author    Alexander Simonchik <support@belvg.com>
* @site    [censored by addons.prestashop.com]
* @support@belvg.com 
* @copyright  Copyright (c) 2010 - 2013 BelVG LLC. (http://www.belvg.com)
* @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt
*}

<div id="belvg-preorderproducts" class="panel product-tab">
    {$belvg_pp_errors}
	<input type="hidden" name="submitted_tabs[]" value="Belvg_PreOrderProducts" />
	<h4>{l s='Pre-Order Products' mod='belvg_preorderproducts'}</h4>
	<div class="separation"></div>
    {if count($belvg_pp_data.attributes_resume)}
	<fieldset style="border:none;">
        <table border="0" cellpadding="0" cellspacing="0" class="table">
            <col width="600px"/>
            <col/>
            <col/>
            <col/>
            <col/>
            <thead>
                <tr>
                    <th>{l s='Name' mod='belvg_preorderproducts'}</th>
                    <th>{l s='Allow pre-order' mod='belvg_preorderproducts'}</th>
                    <th>{l s='Allow countdown' mod='belvg_preorderproducts'}</th>
                    <th>{l s='Date available' mod='belvg_preorderproducts'}</th>
                    <th>{l s='Init Qty' mod='belvg_preorderproducts'}</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$belvg_pp_data.attributes_resume item=pp_item name=collection}
                <tr class="{if $smarty.foreach.collection.index % 2 != 0}alt{/if}">
                    <td>{$pp_item.attribute_designation}</td>
                    <td>
                        <input type="checkbox" class="allow_pre_order" name="allow_pre_order[{$smarty.foreach.collection.index}]" value="{$pp_item.id_product_attribute}" {if (isset($pp_item.po_product) && ($pp_item.po_product->active))} checked="checked" {/if} />
                    </td>
                    <td>
                        <input type="checkbox" class="allow_countdown" name="allow_countdown[{$smarty.foreach.collection.index}]" value="{$pp_item.id_product_attribute}" {if (isset($pp_item.po_product) && ($pp_item.po_product->countdown_active))} checked="checked" {/if} />
                    </td>
                    <td>
                        <input type="text" class="datepicker" name="expire_datetime[{$smarty.foreach.collection.index}]" value="{if (isset($pp_item.po_product))}{$pp_item.po_product->expire_datetime}{/if}" {if  (isset($pp_item.po_product) && !$pp_item.po_product->countdown_active) || !isset($pp_item.po_product) } style="display:none" {/if} />
                    </td>
                    <td>
                        <input type="text" class="qty" name="qty[{$smarty.foreach.collection.index}]" value="{if (isset($pp_item.po_product))}{$pp_item.po_product->quantity}{else}{*$pp_item.quantity*}100{/if}" {if  (isset($pp_item.po_product) && !$pp_item.po_product->countdown_active) || !isset($pp_item.po_product) } style="display:none" {/if} />
                    </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
    
        <input type="hidden" value="0" name="cc"/>
        <div class="clear">&nbsp;</div>
        
        <label>{l s='Server Time' mod='belvg_preorderproducts'}:</label>
        <div class="margin-form">
            <div id="server_time_load" style="padding-top:3px">{$server_time_load}</div>
        </div>
        <div class="clear">&nbsp;</div>

        <input type="hidden" name="id_preorder" value="{if (isset($po_product))}{$po_product->id}{/if}" />
        <input type="hidden" name="id_product" value="{if (isset($id_product))}{$id_product}{/if}" />
	</fieldset>
    {else}
        <div class="warn">{l s='No availiable products for preorder (qty>0)' mod='belvg_preorderproducts'}</div>
    {/if}
	<div class="separation"></div>
	<div class="clear">&nbsp;</div>
    
    {literal}
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
    {/literal}

    <div class="separation"></div>
    <div class="clear">&nbsp;</div>

    <div class="panel-footer">
        <a href="{Context::getContext()->link->getAdminLink('AdminProducts')}" class="btn btn-default"><i class="process-icon-cancel"></i> {l s='Cancel' mod='belvg_preorderproducts'}</a>
        <button type="submit" name="submitAddproduct" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save' mod='belvg_preorderproducts'}</button>
        <button type="submit" name="submitAddproductAndStay" class="btn btn-default pull-right"><i class="process-icon-save"></i> {l s='Save and stay' mod='belvg_preorderproducts'}</button>
    </div>
</div>