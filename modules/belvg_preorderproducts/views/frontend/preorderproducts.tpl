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
 * @site    
 * @copyright  Copyright (c) 2010 - 2013 BelVG LLC. (http://www.belvg.com)
 * @license    http://store.belvg.com/BelVG-LICENSE-COMMUNITY.txt 
 *}

<!-- Belvg_PreOrderProducts -->
{literal}
<script type="text/javascript">
	var isLogged = {/literal}{$isLogged}{literal}
</script>
{/literal}

{if count($po_items)}
    <style type="text/css">
        .defaultCountdown { width: 250px; height: 60px; margin: 0 0 10px 0; padding: 10px 0 0 0; display:block; font-weight: bold; font-size:13px }
    </style>

    {foreach from=$po_items item=po_item name=po}
    <span id="pp_{$po_item.id_product_attribute|intval}" class="pp_countdown_container">
        {if isset($po_item.po_item) && $po_item.po_item->active && $allow_product_tab}
            <span id="defaultCountdown_{$po_item.po_item->id_belvg_preorder_product}" class="defaultCountdown"></span>
            <span id="preorder_availability_value_{$po_item.po_item->id_belvg_preorder_product}" class="warning_inline">{l s='Your order will be formed after the product is back in stock' mod='belvg_preorderproducts'}</span>
            <input type="submit" id="add_to_preorder_{$po_item.po_item->id_belvg_preorder_product}" class="add_to_preorder exclusive" value="{l s='Pre-Order' mod='belvg_preorderproducts'}" name="PreOrderSubmit">
            <input type="hidden" name="id_preorder" value="{if (isset($po_product))}{$po_item.po_item->id_belvg_preorder_product}{/if}" />

            {if $po_item.po_item->countdown_active && $po_item.po_item->active}
                {literal}
                <script type="text/javascript">
                $(function () {
                    var austDay = new Date("{/literal}{$po_item.po_item->expire_datetime}{literal}"); //'06 March 2012 16:32:22'
                    //var austDay = new Date('6 March 2012 16:32:22');
                    $('#defaultCountdown_{/literal}{$po_item.po_item->id_belvg_preorder_product}{literal}').countdown({until: austDay, onExpiry: ajaxPreorder.switchStatus, serverSync: ajaxPreorder.serverTime});
                    $('#year').text(austDay.getFullYear());
                    
                });
                </script>
                {/literal}
            {else}
                <style type="text/css">
                    #defaultCountdown_{$po_item.po_item->id_belvg_preorder_product} {literal}{ display:none }{/literal}
                </style>
            {/if}
        {/if}

        <br>
        <span class="reloadWaitContent">
        {if (isset($po_item.wait_id) && $po_item.wait_id && $isLogged)}
            <span class="wait_container">
                <input type="submit" id="unsubscribe_me_{$po_item.wait_id}" class="exclusive_large waitsubmit" value="{l s='Unsubscribe me' mod='belvg_preorderproducts'}" name="waitsubmit">
                <input type="hidden" name="action" value="unsubscribe" />
                <input type="hidden" name="wait_id" value="{$po_item.wait_id}" />
            </span>
        {else}
            <span class="wait_container">
                <input type="submit" class="exclusive_large waitsubmit" value="{l s='Notify me when back in stock' mod='belvg_preorderproducts'}" name="waitsubmit">
                <input type="hidden" name="action" value="subscribe" />
            </span>
        {/if}
        </span>

    </span>
    {/foreach}
{/if}
<!-- /Belvg_PreOrderProducts -->
