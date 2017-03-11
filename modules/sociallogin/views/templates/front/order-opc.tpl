{*
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*}

{if $opc}
	{assign var="back_order_page" value="order-opc.php"}
	{else}
	{assign var="back_order_page" value="order.php"}
{/if}

{if $PS_CATALOG_MODE}
	{capture name=path}{l s='Your shopping cart' mod='sociallogin'}{/capture}
	<h2 id="cart_title">{l s='Your shopping cart' mod='sociallogin'}</h2>
	<p class="alert alert-warning">{l s='Your new order was not accepted.' mod='sociallogin'}</p>
{else}
	{if $productNumber}
		<!-- Shopping Cart -->
		{include file="$tpl_dir./shopping-cart.tpl"}
		<!-- End Shopping Cart -->
		{if $is_logged AND !$is_guest}
			{include file="$tpl_dir./order-address.tpl"}
		{else}
			<!-- Create account / Guest account / Login block -->
			{include file="./order-opc-new-account.tpl"}
			<!-- END Create account / Guest account / Login block -->
		{/if}
		<!-- Carrier -->
		{include file="$tpl_dir./order-carrier.tpl"}
		<!-- END Carrier -->
	
		<!-- Payment -->
		{include file="$tpl_dir./order-payment.tpl"}
		<!-- END Payment -->
	{else}
		{capture name=path}{l s='Your shopping cart' mod='sociallogin'}{/capture}
		<h2 class="page-heading">{l s='Your shopping cart' mod='sociallogin'}</h2>
		{include file="$tpl_dir./errors.tpl"}
		<p class="alert alert-warning">{l s='Your shopping cart is empty.' mod='sociallogin'}</p>
	{/if}
{strip}
{addJsDef imgDir=$img_dir}
{addJsDef authenticationUrl=$link->getPageLink("authentication", true)|escape:'quotes':'UTF-8'}
{addJsDef orderOpcUrl=$link->getPageLink("order-opc", true)|escape:'quotes':'UTF-8'}
{addJsDef historyUrl=$link->getPageLink("history", true)|escape:'quotes':'UTF-8'}
{addJsDef guestTrackingUrl=$link->getPageLink("guest-tracking", true)|escape:'quotes':'UTF-8'}
{addJsDef addressUrl=$link->getPageLink("address", true, NULL, "back={$back_order_page}")|escape:'quotes':'UTF-8'}
{addJsDef orderProcess='order-opc'}
{addJsDef guestCheckoutEnabled=$PS_GUEST_CHECKOUT_ENABLED|intval}
{assign var=currencySign value=$currencySign|html_entity_decode:2:'UTF-8'|escape:'htmlall':'UTF-8'}
{addJsDef currencySign=$currencySign|escape:'quotes':'UTF-8'}
{addJsDef currencyRate=$currencyRate|floatval}
{addJsDef currencyFormat=$currencyFormat|intval}
{addJsDef currencyBlank=$currencyBlank|intval}
{addJsDef displayPrice=$priceDisplay}
{addJsDef taxEnabled=$use_taxes}
{addJsDef conditionEnabled=$conditions|intval}
{addJsDef vat_management=$vat_management|intval}
{addJsDef errorCarrier=$errorCarrier|@addcslashes:'\''}
{addJsDef errorTOS=$errorTOS|@addcslashes:'\''}
{addJsDef checkedCarrier=$checked|intval}
{addJsDef addresses=array()}
{addJsDef isVirtualCart=$isVirtualCart|intval}
{addJsDef isPaymentStep=$isPaymentStep|intval}
{addJsDefL name=txtWithTax}{l s='(tax incl.)' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtWithoutTax}{l s='(tax excl.)' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtHasBeenSelected}{l s='has been selected' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtNoCarrierIsSelected}{l s='No carrier has been selected' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtNoCarrierIsNeeded}{l s='No carrier is needed for this order' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtConditionsIsNotNeeded}{l s='You do not need to accept the Terms of Service for this order.' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtTOSIsAccepted}{l s='The service terms have been accepted' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtTOSIsNotAccepted}{l s='The service terms have not been accepted' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtThereis}{l s='There is' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtErrors}{l s='Error(s)' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtDeliveryAddress}{l s='Delivery address' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtInvoiceAddress}{l s='Invoice address' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtModifyMyAddress}{l s='Modify my address' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtInstantCheckout}{l s='Instant checkout' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtSelectAnAddressFirst}{l s='Please start by selecting an address.' js=1 mod='sociallogin'}{/addJsDefL}
{addJsDefL name=txtFree}{l s='Free' js=1 mod='sociallogin'}{/addJsDefL}

{capture}{if $back}&mod={$back|urlencode|escape:'quotes':'UTF-8'}{/if}{/capture}
{capture name=addressUrl}{$link->getPageLink('address', true, NULL, 'back='|cat:$back_order_page|cat:'?step=1'|cat:$smarty.capture.default)|escape:'quotes':'UTF-8'}{/capture}
{addJsDef addressUrl=$smarty.capture.addressUrl}
{capture}{'&multi-shipping=1'|urlencode|escape:'quotes':'UTF-8'}{/capture}
{addJsDef addressMultishippingUrl=$smarty.capture.addressUrl|cat:$smarty.capture.default}
{capture name=addressUrlAdd}{$smarty.capture.addressUrl|cat:'&id_address='|escape:'quotes':'UTF-8'}{/capture}
{addJsDef addressUrlAdd=$smarty.capture.addressUrlAdd}
{addJsDef opc=$opc|boolval}
{capture}<h3 class="page-subheading">{l s='Your billing address' js=1 mod='sociallogin'}</h3>{/capture}
{addJsDefL name=titleInvoice}{$smarty.capture.default|@addcslashes:'\''|escape:'quotes':'UTF-8'}{/addJsDefL}
{capture}<h3 class="page-subheading">{l s='Your delivery address' js=1 mod='sociallogin'}</h3>{/capture}
{addJsDefL name=titleDelivery}{$smarty.capture.default|@addcslashes:'\''|escape:'quotes':'UTF-8'}{/addJsDefL}
{capture}<a class="button button-small btn btn-default" href="{$smarty.capture.addressUrlAdd|escape:'quotes':'UTF-8'}" title="{l s='Update' js=1 mod='sociallogin'}"><span>{l s='Update' js=1 mod='sociallogin'}<i class="icon-chevron-right right"></i></span></a>{/capture}
{addJsDefL name=liUpdate}{$smarty.capture.default|@addcslashes:'\''|escape:'quotes':'UTF-8'}{/addJsDefL}
{/strip}
{/if}