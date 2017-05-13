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
<div class='split_here'></div>
{include file="$tpl_dir./errors.tpl"}
{if $errors|@count == 0}
	{if !isset($priceDisplayPrecision)}
		{assign var='priceDisplayPrecision' value=2}
	{/if}
	{if !$priceDisplay || $priceDisplay == 2}
		{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL, $priceDisplayPrecision)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
	{elseif $priceDisplay == 1}
		{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL, $priceDisplayPrecision)}
		{assign var='productPriceWithoutReduction' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
	{/if}
	<div class="primary_block eb-wrapper clearfix eb-product" itemscope itemtype="http://schema.org/Product">

		{if !$content_only}
			<div class="container">
				<div class="top-hr"></div>
			</div>
		{/if}
		{if isset($adminActionDisplay) && $adminActionDisplay}
			<div id="admin-action">
				<p>{l s='This product is not visible to your customers.'}
					<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
					<input type="submit" value="{l s='Publish'}" name="publish_button" class="exclusive" />
					<input type="submit" value="{l s='Back'}" name="lnk_view" class="exclusive" />
				</p>
				<p id="admin-action-result"></p>
			</div>
		{/if}
		{if isset($confirmation) && $confirmation}
			<p class="confirmation">
				{$confirmation}
			</p>
		{/if}
		<!-- left infos-->
		<div class="pb-left-column">
			<!-- product img-->
			<div id="image-block" class="clearfix">
				{if $product->on_sale}
					<span class="sale-box no-print">
						<span class="sale-label">{l s='Sale!'}</span>
					</span>
				{elseif $product->specificPrice && $product->specificPrice.reduction && $productPriceWithoutReduction > $productPrice}
					<span class="discount">{l s='Reduced price!'}</span>
				{/if}
				{if $have_image}
					<span id="view_full_size">
						{if $jqZoomEnabled && $have_image && !$content_only}
							<a class="" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" rel="gal1" href="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_ebt')|escape:'html':'UTF-8'}" itemprop="url">
								<img id="img_01" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" data-zoom-image="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox_ebt')|escape:'html':'UTF-8'}"/>
							</a>
						{else}
							<img id="bigpic" itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large_default')|escape:'html':'UTF-8'}" title="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" alt="{if !empty($cover.legend)}{$cover.legend|escape:'html':'UTF-8'}{else}{$product->name|escape:'html':'UTF-8'}{/if}" width="{$largeSize.width}" height="{$largeSize.height}"/>
							{if !$content_only}
								<span class="span_link no-print">{l s='View larger'}</span>
							{/if}
						{/if}
					</span>
				{else}
					<span id="view_full_size">
						<img itemprop="image" src="{$img_prod_dir}{$lang_iso}-default-large_ebt.jpg" id="bigpic" alt="" title="{$product->name|escape:'html':'UTF-8'}" width="{$largeSize.width}" height="{$largeSize.height}"/>
						{if !$content_only}
							<span class="span_link">
								{l s='View larger'}
							</span>
						{/if}
					</span>
				{/if}
			</div> <!-- end image-block -->
			{if isset($images) && count($images) > 1}
				<p class="resetimg clear no-print">
					<span id="wrapResetImages" style="display: none;">
						<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" name="resetImages">
							<i class="icon-repeat"></i>
							{l s='Display all pictures'}
						</a>
					</span>
				</p>
			{/if}
		</div> <!-- end pb-left-column -->
		<!-- end left infos-->
		<!-- center infos -->
		<div class="pb-center-column">
			{if $product->online_only}
				<p class="online_only">{l s='Online only'}</p>
			{/if}

			<h1 itemprop="name">{$product->name|escape:'html':'UTF-8'}</h1>
			<!-- pb-right-column-->
			<div class="pb-right-column col-xs-12 col-sm-4 col-md-3">
				{if ($product->show_price && !isset($restricted_country_mode)) || isset($groups) || $product->reference || (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
				<!-- add to cart form-->
				<form id="buy_block" {if $PS_CATALOG_MODE && !isset($groups) && $product->quantity > 0}class="hidden"{/if} action="{$link->getPageLink('cart')|escape:'html':'UTF-8'}" method="post">
					<!-- hidden datas -->
					<p class="hidden">
						<input type="hidden" name="token" value="{$static_token}" />
						<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
						<input type="hidden" name="add" value="1" />
						<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
					</p>
					
					<div class="box-info-product">
					<div class="box-cart-bottom addtocart_top">
							<div{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE} class="unvisible"{/if}>
								<p id="add_to_cart" class="buttons_bottom_block no-print">
									<button type="submit" name="Submit" class="exclusive">
										<span>{l s='Add to cart'}</span>
									</button>
								</p>
					</div></div>
						<div class="content_prices clearfix">
							{if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
								<!-- prices -->
								<div class="price">
									<p class="our_price_display" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
										<link itemprop="availability" {if $product->quantity <= 0}href="http://schema.org/OutOfStock"{else}href="http://schema.org/InStock"{/if}>
										{if $priceDisplay >= 0 && $priceDisplay <= 2}
											<span id="our_price_display" itemprop="price">{convertPrice price=$productPrice}</span>
											<!--{if $tax_enabled  && ((isset($display_tax_label) && $display_tax_label == 1) || !isset($display_tax_label))}
												{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
											{/if}-->
											<meta itemprop="priceCurrency" content="{$currency->iso_code}" />
										{/if}
									</p>
									<p id="reduction_percent" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'percentage'} style="display:none;"{/if}>
										<span id="reduction_percent_display">
											{if $product->specificPrice && $product->specificPrice.reduction_type == 'percentage'}-{$product->specificPrice.reduction*100}%{/if}
										</span>
									</p>
									<p id="old_price"{if (!$product->specificPrice || !$product->specificPrice.reduction) && $group_reduction == 1} class="hidden"{/if}>
										{if $priceDisplay >= 0 && $priceDisplay <= 2}
											<span id="old_price_display">{if $productPriceWithoutReduction > $productPrice}{convertPrice price=$productPriceWithoutReduction}{/if}</span>
											<!-- {if $tax_enabled && $display_tax_label == 1}{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}{/if} -->
										{/if}
									</p>
									{if $priceDisplay == 2}
										<br />
										<span id="pretaxe_price">
											<span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>
											{l s='tax excl.'}
										</span>
									{/if}
								</div> <!-- end prices -->
								<p id="reduction_amount" {if !$product->specificPrice || $product->specificPrice.reduction_type != 'amount' || $product->specificPrice.reduction|floatval ==0} style="display:none"{/if}>
									<span id="reduction_amount_display">
									{if $product->specificPrice && $product->specificPrice.reduction_type == 'amount' && $product->specificPrice.reduction|intval !=0}
										-{convertPrice price=$productPriceWithoutReduction-$productPrice|floatval}
									{/if}
									</span>
								</p>
								{if $packItems|@count && $productPrice < $product->getNoPackPrice()}
									<p class="pack_price">{l s='Instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
								{/if}
								{if $product->ecotax != 0}
									<p class="price-ecotax">{l s='Include'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='For green tax'}
										{if $product->specificPrice && $product->specificPrice.reduction}
										<br />{l s='(not impacted by the discount)'}
										{/if}
									</p>
								{/if}
								{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
									{math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
									<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'html':'UTF-8'}</p>
								{/if}
							{else}
								{if $product->description_short || $packItems|@count > 0}
									<div id="short_description_block">
										{if $product->description_short}
											<div id="short_description_content123" class="rte align_justify" itemprop="description">{$product->description_short}</div>
										{/if}

										{if $product->description}
											<p class="buttons_bottom_block">
												<a href="javascript:{ldelim}{rdelim}" class="button">
													{l s='More details'}
												</a>
											</p>
										{/if}
										<!--{if $packItems|@count > 0}
											<div class="short_description_pack">
											<h3>{l s='Pack content'}</h3>
												{foreach from=$packItems item=packItem}

												<div class="pack_content">
													{$packItem.pack_quantity} x <a href="{$link->getProductLink($packItem.id_product, $packItem.link_rewrite, $packItem.category)|escape:'html':'UTF-8'}">{$packItem.name|escape:'html':'UTF-8'}</a>
													<p>{$packItem.description_short}</p>
												</div>
												{/foreach}
											</div>
										{/if}-->
									</div> <!-- end short_description_block -->
								{/if}
							{/if} {*close if for show price*}
							<div class="clear"></div>
						</div> <!-- end content_prices -->

						{if $product->show_price && !isset($restricted_country_mode) && !$PS_CATALOG_MODE}
							{if $product->description_short || $packItems|@count > 0}
								<div id="short_description_block">
									{if $product->description_short}
										<div id="short_description_content" class="rte align_justify" itemprop="description">{$product->description_short}</div>
									{/if}

									{if $product->description}
										<p class="buttons_bottom_block">
											<a href="javascript:{ldelim}{rdelim}" class="button">
												{l s='More details'}
											</a>
										</p>
									{/if}
								</div> <!-- end short_description_block -->
							{/if}
						{/if}


						<div class="product_attributes clearfix">
							<!-- quantity wanted -->
							{if !$PS_CATALOG_MODE}
							<p id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
								<label>{l s='Quantity:'}</label>
								<input type="text" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}{if $product->minimal_quantity > 1}{$product->minimal_quantity}{else}1{/if}{/if}" />
								<a href="#" data-field-qty="qty" class="btn btn-default button-minus product_quantity_down">
									<span><i class="icon-minus"></i></span>
								</a>
								<a href="#" data-field-qty="qty" class="btn btn-default button-plus product_quantity_up ">
									<span><i class="icon-plus"></i></span>
								</a>
								<span class="clearfix"></span>
							</p>
							{/if}
							<!-- minimal quantity wanted -->
							<p id="minimal_quantity_wanted_p"{if $product->minimal_quantity <= 1 || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
								{l s='This product is not sold individually. You must select at least'} <b id="minimal_quantity_label">{$product->minimal_quantity}</b> {l s='quantity for this product.'}
							</p>
							{if isset($groups)}
								<!-- attributes -->
								<div id="attributes">
									<div class="clearfix"></div>
									{foreach from=$groups key=id_attribute_group item=group}
										{if $group.attributes|@count}
											<fieldset class="attribute_fieldset">
												<label class="attribute_label" {if $group.group_type != 'color' && $group.group_type != 'radio'}for="group_{$id_attribute_group|intval}"{/if}>{$group.name|escape:'html':'UTF-8'} :&nbsp;</label>
												{assign var="groupName" value="group_$id_attribute_group"}
												<div class="attribute_list">
													{if ($group.group_type == 'select')}
														<select name="{$groupName}" id="group_{$id_attribute_group|intval}" class="form-control attribute_select no-print">
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'html':'UTF-8'}">{$group_attribute|escape:'html':'UTF-8'}</option>
															{/foreach}
														</select>
													{elseif ($group.group_type == 'color')}
														<ul id="color_to_pick_list" class="clearfix">
															{assign var="default_colorpicker" value=""}
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																<li{if $group.default == $id_attribute} class="selected"{/if}>
																	<a href="{$link->getProductLink($product)|escape:'html':'UTF-8'}" id="color_{$id_attribute|intval}" name="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" class="color_pick{if ($group.default == $id_attribute)} selected{/if}" style="background: {$colors.$id_attribute.value|escape:'html':'UTF-8'};" title="{$colors.$id_attribute.name|escape:'html':'UTF-8'}">
																		{if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}
																			<img src="{$img_col_dir}{$id_attribute|intval}.jpg" alt="{$colors.$id_attribute.name|escape:'html':'UTF-8'}" width="20" height="20" />
																		{/if}
																	</a>
																</li>
																{if ($group.default == $id_attribute)}
																	{$default_colorpicker = $id_attribute}
																{/if}
															{/foreach}
														</ul>
														<input type="hidden" class="color_pick_hidden" name="{$groupName|escape:'html':'UTF-8'}" value="{$default_colorpicker|intval}" />
													{elseif ($group.group_type == 'radio')}
														<ul>
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																<li>
																	<input type="radio" class="attribute_radio" name="{$groupName|escape:'html':'UTF-8'}" value="{$id_attribute}" {if ($group.default == $id_attribute)} checked="checked"{/if} />
																	<span>{$group_attribute|escape:'html':'UTF-8'}</span>
																</li>
															{/foreach}
														</ul>
													{/if}
												</div> <!-- end attribute_list -->
											</fieldset>
										{/if}
									{/foreach}
								</div> <!-- end attributes -->
							{/if}
						</div> <!-- end product_attributes -->
						<div class="box-cart-bottom">
							<div{if (!$allow_oosp && $product->quantity <= 0) || !$product->available_for_order || (isset($restricted_country_mode) && $restricted_country_mode) || $PS_CATALOG_MODE} class="unvisible"{/if}>
								<p id="add_to_cart" class="buttons_bottom_block no-print">
									<button type="submit" name="Submit" class="exclusive">
										<span>{l s='Add to cart'}</span>
									</button>
								</p>
							</div>
						</div> <!-- end box-cart-bottom -->
					</div> <!-- end box-info-product -->
				</form>
				{/if}
			</div> <!-- end pb-right-column-->
			<!-- If content_only -->
			{if !$content_only}
				{if isset($addThisRender)}
				<!-- AddThis Social Sharing -->
					{$addThisRender}
				{/if}

			<p id="product_reference"{if empty($product->reference) || !$product->reference} style="display: none;"{/if}>
				<label>{l s='Model'} </label>
				<span class="editable" itemprop="sku">{if !isset($groups)}{$product->reference|escape:'html':'UTF-8'}{/if}</span>
			</p>
			{capture name=condition}
				{if $product->condition == 'new'}{l s='New'}
				{elseif $product->condition == 'used'}{l s='Used'}
				{elseif $product->condition == 'refurbished'}{l s='Refurbished'}
				{/if}
			{/capture}
			<p id="product_condition"{if !$product->condition} style="display: none;"{/if}>
				<label>{l s='Condition'} </label>
				<span class="editable" itemprop="condition">{$smarty.capture.condition}</span>
			</p>
			{if ($display_qties == 1 && !$PS_CATALOG_MODE && $PS_STOCK_MANAGEMENT && $product->available_for_order)}
				<!-- number of item in stock -->
				<p id="pQuantityAvailable"{if $product->quantity <= 0} style="display: none;"{/if}>
					<span id="quantityAvailable">{$product->quantity|intval}</span>
					<span {if $product->quantity > 1} style="display: none;"{/if} id="quantityAvailableTxt">{l s='Item'}</span>
					<span {if $product->quantity == 1} style="display: none;"{/if} id="quantityAvailableTxtMultiple">{l s='Items'}</span>
				</p>
			{/if}
			{if $PS_STOCK_MANAGEMENT}
				<!-- availability -->
				<p id="availability_statut"{if ($product->quantity <= 0 && !$product->available_later && $allow_oosp) || ($product->quantity > 0 && !$product->available_now) || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none;"{/if}>
					{*<span id="availability_label">{l s='Availability:'}</span>*}
					<span id="availability_value"{if $product->quantity <= 0} class="warning_inline"{/if}>{if $product->quantity <= 0}{if $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{else}{$product->available_now}{/if}</span>
				</p>
				<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties || $product->quantity <= 0) || $allow_oosp || !$product->available_for_order || $PS_CATALOG_MODE} style="display: none"{/if} >{l s='Warning: Last items in stock!'}</p>
			{/if}
			<p id="availability_date"{if ($product->quantity > 0) || !$product->available_for_order || $PS_CATALOG_MODE || !isset($product->available_date) || $product->available_date < $smarty.now|date_format:'%Y-%m-%d'} style="display: none;"{/if}>
				<span id="availability_date_label">{l s='Availability date:'}</span>
				<span id="availability_date_value">{dateFormat date=$product->available_date full=false}</span>
			</p>
			<!-- Out of stock hook -->
			<div id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
				{$HOOK_PRODUCT_OOS}
			</div>
			{if isset($HOOK_EXTRA_RIGHT) && $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}
			{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}
			{if !$content_only}
				<!-- usefull links-->
				<ul id="usefull_link_block" class="clearfix no-print">
					{if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
					<li class="print">
						<a href="javascript:print();">
							{l s='Print'}
						</a>
					</li>
					{if $have_image && !$jqZoomEnabled}{/if}
				</ul>
			{/if}
		{/if} <!-- / If content_only -->
		</div>
		<!-- end center infos-->
	</div> <!-- end primary_block -->

	{if !$content_only}
	{if isset($images) && count($images) > 0}
	<div class="eb-thumbnails-block">
		<div class="eb-wrapper">
			<!-- thumbnails -->
			<div id="views_block" class="clearfix {if isset($images) && count($images) < 2}hidden{/if}">
				{if isset($images) && count($images) > 2}
					<span class="view_scroll_spacer">
						<a id="view_scroll_left" class="" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">
							{l s='Previous'}
						</a>
					</span>
				{/if}
				<div id="thumbs_list">
					<ul id="thumbs_list_frame">
					{if isset($images)}
						{foreach from=$images item=image name=thumbnails}
							{assign var=imageIds value="`$product->id`-`$image.id_image`"}
							{if !empty($image.legend)}
								{assign var=imageTitle value=$image.legend|escape:'html':'UTF-8'}
							{else}
								{assign var=imageTitle value=$product->name|escape:'html':'UTF-8'}
							{/if}
							<li id="thumbnail_{$image.id_image}"{if $smarty.foreach.thumbnails.last} class="last"{/if}>
								<a
									{if $jqZoomEnabled && $have_image && !$content_only}
                                    	id="img_01"
										href="#"
                                       data-image="{$link->getImageLink($product->link_rewrite, $imageIds, 'large_ebt')|escape:'html':'UTF-8'}"
                                       data-zoom-image="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_ebt')|escape:'html':'UTF-8'}"
									{else}
										href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox_ebt')|escape:'html':'UTF-8'}"
										data-fancybox-group="other-views"
										class="fancybox{if $image.id_image == $cover.id_image} shown{/if}"
									{/if}
									title="{$imageTitle}">
									<img class="img-responsive" id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'home_ebt')|escape:'html':'UTF-8'}" alt="{$imageTitle}" title="{$imageTitle}" height="{$mediumSize.height}" width="{$mediumSize.width}" itemprop="image" />
								</a>
							</li>
						{/foreach}
					{/if}
					</ul>
				</div> <!-- end thumbs_list -->
				{if isset($images) && count($images) > 2}
					<a id="view_scroll_right" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">
						{l s='Next'}
					</a>
				{/if}
			</div> <!-- end views-block -->
			<!-- end thumbnails -->
		</div>
	</div>
	{/if}
		{/if}

	
<style>
.weight{
    float: right;
    text-align: right;
    margin-left: -5% !important;
}
.weighttest{
	color:#fff;
	padding:21px !important;
}
.accordion_product.components {
   
    margin: 0 auto;
    height:auto;
    width: 670px;
}

.accordion_product.components > ul > li,
.components .accordion_product-title,
.components .accordion_product-content,
.components .accordion_product-separator {
    float: none;
}

.accordion_product.components > ul > li {
    //background-color: #1f1f1f;
    //margin-right: -0px;
    //margin-bottom: -318px
}

.components .accordion_product-select:checked ~ .accordion_product-separator {
    margin-right: 0px;
    margin-bottom: 318px;
}

.components .accordion_product-title,
.components .accordion_product-select  {
    background-color: #2d2d2d;
    color: #ffffff;
    width: 90%;
    height: 40px;
    font-size: 25px;
}

.components .accordion_product-title span {
    margin-bottom: 20px; 
    margin-left: 20px;
}

.components .accordion_product-select:hover ~ .accordion_product-title,
.components .accordion_product-select:checked ~ .accordion_product-title {
    background-color: #3068cc;
}

.components .accordion_product-title span  {	
    transform: rotate(0deg);
    -o-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
    -ms-writing-mode: lr-tb;
    filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0);
    margin-bottom: 0px;
    line-height: 40px;
}

.components .accordion_product-content {
    background-color: #3e3e3e;
    color: #f5f2f0;
    height: 316px;
    width: 90%;
    //padding: 27px;
	display:none;
}

.components .accordion_product-title,
.components .accordion_product-select:checked ~ .accordion_product-content {
    margin-right: 0px;
    margin-bottom: 0px;
}

/* Do not change following properties, they aren't 
generated automatically and are common for each slider. */
.accordion_product {
    overflow: hidden;
}

.accordion_product > ul {
    margin: 0;
    padding: 0;
    list-style: none;
    width: 101%;
}

.accordion_product > ul > li,
.accordion_product-title {
    position: relative;
}

.accordion_product-select {
    cursor: pointer;
    position: absolute;
    opacity: 0;
    top: 0;
    left: 0;
    margin: 0;
    z-index: 1;
}

.accordion_product-title span {
    display: block;
    position: absolute;
    bottom: 0px;
    width: 100%;
    white-space: nowrap;
}

.accordion_product-content {
    position: relative;
    overflow: auto;
}

.accordion_product-separator {
    transition: margin 0.3s ease 0.1s;
    -o-transition: margin 0.3s ease 0.1s;
    -moz-transition: margin 0.3s ease 0.1s;
    -webkit-transition: margin 0.3s ease 0.1s;
}
div.radio{
opacity:0;
}
.accordion_product-title:hover{
	background-color:#3068cc !important;
	cursor:pointer;
}
</style>
<script>
$(".accordion_product-title").click(function(){

	$(".accordion_product-content").hide();
	$(".accordion_product-title").css("background-color","#2d2d2d");
	$(this).next(".accordion_product-content").slideDown();
	$(this).css("background-color","#3068cc");
	
})
</script>
{strip}
{strip}
{if isset($smarty.get.ad) && $smarty.get.ad}
{addJsDefL name=ad}{$base_dir|cat:$smarty.get.ad|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{if isset($smarty.get.adtoken) && $smarty.get.adtoken}
{addJsDefL name=adtoken}{$smarty.get.adtoken|escape:'html':'UTF-8'}{/addJsDefL}
{/if}
{addJsDef allowBuyWhenOutOfStock=$allow_oosp|boolval}
{addJsDef availableNowValue=$product->available_now|escape:'quotes':'UTF-8'}
{addJsDef availableLaterValue=$product->available_later|escape:'quotes':'UTF-8'}
{addJsDef attribute_anchor_separator=$attribute_anchor_separator|addslashes}
{addJsDef attributesCombinations=$attributesCombinations}
{addJsDef currencySign=$currencySign|html_entity_decode:2:"UTF-8"}
{addJsDef currencyRate=$currencyRate|floatval}
{addJsDef currencyFormat=$currencyFormat|intval}
{addJsDef currencyBlank=$currencyBlank|intval}
{addJsDef currentDate=$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}
{if isset($combinations) && $combinations}
	{addJsDef combinations=$combinations}
	{addJsDef combinationsFromController=$combinations}
	{addJsDef displayDiscountPrice=$display_discount_price}
	{addJsDefL name='upToTxt'}{l s='Up to' js=1}{/addJsDefL}
{/if}
{if isset($combinationImages) && $combinationImages}
	{addJsDef combinationImages=$combinationImages}
{/if}
{addJsDef customizationFields=$customizationFields}
{addJsDef default_eco_tax=$product->ecotax|floatval}
{addJsDef displayPrice=$priceDisplay|intval}
{addJsDef ecotaxTax_rate=$ecotaxTax_rate|floatval}
{addJsDef group_reduction=$group_reduction}
{if isset($cover.id_image_only)}
	{addJsDef idDefaultImage=$cover.id_image_only|intval}
{else}
	{addJsDef idDefaultImage=0}
{/if}
{addJsDef img_ps_dir=$img_ps_dir}
{addJsDef img_prod_dir=$img_prod_dir}
{addJsDef id_product=$product->id|intval}
{addJsDef jqZoomEnabled=$jqZoomEnabled|boolval}
{addJsDef maxQuantityToAllowDisplayOfLastQuantityMessage=$last_qties|intval}
{addJsDef minimalQuantity=$product->minimal_quantity|intval}
{addJsDef noTaxForThisProduct=$no_tax|boolval}
{addJsDef oosHookJsCodeFunctions=Array()}
{addJsDef productHasAttributes=isset($groups)|boolval}
{addJsDef productPriceTaxExcluded=($product->getPriceWithoutReduct(true)|default:'null' - $product->ecotax)|floatval}
{addJsDef productBasePriceTaxExcluded=($product->base_price - $product->ecotax)|floatval}
{addJsDef productReference=$product->reference|escape:'html':'UTF-8'}
{addJsDef productAvailableForOrder=$product->available_for_order|boolval}
{addJsDef productPriceWithoutReduction=$productPriceWithoutReduction|floatval}
{addJsDef productPrice=$productPrice|floatval}
{addJsDef productUnitPriceRatio=$product->unit_price_ratio|floatval}
{addJsDef productShowPrice=(!$PS_CATALOG_MODE && $product->show_price)|boolval}
{addJsDef PS_CATALOG_MODE=$PS_CATALOG_MODE}
{if $product->specificPrice && $product->specificPrice|@count}
	{addJsDef product_specific_price=$product->specificPrice}
{else}
	{addJsDef product_specific_price=array()}
{/if}
{if $display_qties == 1 && $product->quantity}
	{addJsDef quantityAvailable=$product->quantity}
{else}
	{addJsDef quantityAvailable=0}
{/if}
{addJsDef quantitiesDisplayAllowed=$display_qties|boolval}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'percentage'}
	{addJsDef reduction_percent=$product->specificPrice.reduction*100|floatval}
{else}
	{addJsDef reduction_percent=0}
{/if}
{if $product->specificPrice && $product->specificPrice.reduction && $product->specificPrice.reduction_type == 'amount'}
	{addJsDef reduction_price=$product->specificPrice.reduction|floatval}
{else}
	{addJsDef reduction_price=0}
{/if}
{if $product->specificPrice && $product->specificPrice.price}
	{addJsDef specific_price=$product->specificPrice.price|floatval}
{else}
	{addJsDef specific_price=0}
{/if}
{addJsDef specific_currency=($product->specificPrice && $product->specificPrice.id_currency)|boolval} {* TODO: remove if always false *}
{addJsDef stock_management=$stock_management|intval}
{addJsDef taxRate=$tax_rate|floatval}
{addJsDefL name=doesntExist}{l s='This combination does not exist for this product. Please select another combination.' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMore}{l s='This product is no longer in stock' js=1}{/addJsDefL}
{addJsDefL name=doesntExistNoMoreBut}{l s='with those attributes but is available with others.' js=1}{/addJsDefL}
{addJsDefL name=fieldRequired}{l s='Please fill in all the required fields before saving your customization.' js=1}{/addJsDefL}
{addJsDefL name=uploading_in_progress}{l s='Uploading in progress, please be patient.' js=1}{/addJsDefL}
{/strip}
{/if}
