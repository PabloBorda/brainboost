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

<div id="mywaitlist">
	{capture name=path}<a href="{$link->getPageLink('my-account.php', true)}">{l s='My account' mod='belvg_preorderproducts'}</a><span class="navigation-pipe">{$navigationPipe}</span>{l s='My waitlist' mod='belvg_preorderproducts'}{/capture}

    {if isset($waitlist_errors) && !empty($waitlist_errors)}
        <p class="error">{$waitlist_errors}</p>
    {/if}
    
	{if count($waitlist)}
		{include file="$tpl_dir./errors.tpl"}

		{if $id_customer|intval neq 0}
			<div id="block-history" class="block-center">
				<table class="std">
					<thead>
						<tr>
							<th class="first_item">{l s='Name' mod='belvg_preorderproducts'}</th>
							<th class="item mywaitlist_first">{l s='Attribute name' mod='belvg_preorderproducts'}</th>
							<th class="item mywaitlist_second">{l s='Available' mod='belvg_preorderproducts'}</th>
							<th class="item mywaitlist_second">{l s='Direct Link' mod='belvg_preorderproducts'}</th>
							<th class="last_item mywaitlist_first">{l s='Delete' mod='belvg_preorderproducts'}</th>
						</tr>
					</thead>
					<tbody>
					{section name=i loop=$waitlist}
						<tr id="waitlist_{$waitlist[i].id_product|intval}{$waitlist[i].id_product_attribute|intval}">
							<td class="bold" style="width:220px;"><a href="{$link->getProductLink($waitlist[i].id_product|intval, $waitlist[i].link_rewrite)}" >{$waitlist[i].name|truncate:30:'...'|escape:'htmlall':'UTF-8'}</a></td>
							<td class="align_center">{if  !empty($waitlist[i].attributes_small)} {$waitlist[i].attributes_small|truncate:30:'...'|escape:'htmlall':'UTF-8'}{else}---{/if}</td>
							<td class="align_center">
							{if $waitlist[i].active AND $waitlist[i].availability>0 AND $waitlist[i].available_for_order AND !$PS_CATALOG_MODE}
								<img src="{$img_dir}icon/available.gif" alt="{l s='Available'}" width="14" height="14" />
							{else}
								<img src="{$img_dir}icon/unavailable.gif" alt="{l s='Out of stock'}" width="14" height="14" />
							{/if}
							</td>
							{*<td class="align_center">$waitlist[i].date_add|date_format:"%Y-%m-%d"</td>*}
							<td class="align_center"><a href="{$link->getProductLink($waitlist[i].id_product|intval, $waitlist[i].link_rewrite)}">{l s='View' mod='belvg_preorderproducts'}</a></td>
							<td class="align_center">
								<a href="{$base_dir_ssl}index.php?fc=module&module=belvg_preorderproducts&controller=mywaitlist&deleted=1&id_wait={$waitlist[i].id_belvg_preorder_wait|intval}"><img src="{$content_dir}modules/belvg_preorderproducts/images/delete.png" alt="{l s='Delete' mod='belvg_preorderproducts'}" /></a>
							</td>
						</tr>
					{/section}
					</tbody>
				</table>
			</div>
			<div id="block-order-detail">&nbsp;</div>
		{/if}
	{else}
		<p class="warning">{l s='You do not have any products in waitlist.' mod='belvg_preorderproducts'}</p>
	{/if}

	<ul class="footer_links">
		<li>
			<a class="btn btn-default button button-small" href="{$link->getPageLink('my-account.php', true)}">
				<span><i class="icon-chevron-left"></i>{l s='Back to Your Account' mod='belvg_preorderproducts'}</span>
			</a>
		</li>
		<li>
			<a class="btn btn-default button button-small" href="{$base_dir}">
				<span><i class="icon-chevron-left"></i>{l s='Home' mod='belvg_preorderproducts'}</span>
			</a>
		</li>
	</ul>
</div>
