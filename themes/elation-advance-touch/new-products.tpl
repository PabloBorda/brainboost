{*
*  * 2007-2014 PrestaShop
*  ************************************************************************************************************
*  * DISCLAIMER
*  ************************************************************************************************************
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*  ************************************************************************************************************
*  * ELATION ADVANCE TOUCH THEME
*  * (d) elation3ase theme development
*  * (c) 2014 Elation Base, LLC
*  * (i) elationbase.com | elationbase@gmail.com
*  * See theme's licence agreement at the theme root folder (licence.txt)
*  ************************************************************************************************************
*  * (i) Do not edit this file if you wish to upgrade PrestaShop or this Theme to newer versions in the future. 
*  ************************************************************************************************************
*}


{capture name=path}{l s='New products'}{/capture}

<h1 class="page-heading product-listing">{l s='New products'}</h1>

{if $products}
	<div class="content_sortPagiBar">
    	<div class="sortPagiBar clearfix">
			{include file="./product-sort.tpl"}
			{include file="./nbr-product-page.tpl"}
		</div>
    	<div class="top-pagination-content clearfix">
        	{include file="./product-compare.tpl"}
            {include file="$tpl_dir./pagination.tpl"}
        </div>
	</div>

	{include file="./product-list.tpl" products=$products}

	<div class="content_sortPagiBar">
        <div class="bottom-pagination-content clearfix">
        	{include file="./product-compare.tpl"}
			{include file="./pagination.tpl" paginationId='bottom'}
        </div>
	</div>
	{else}
	<p class="alert alert-warning">{l s='No new products.'}</p>
{/if}