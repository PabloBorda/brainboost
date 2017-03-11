{*
* 2007-2014 PrestaShop
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2014 PrestaShop SA
* @license   http://addons.prestashop.com/en/content/12-terms-and-conditions-of-use
* International Registered Trademark & Property of PrestaShop SA
*}

	{foreach from=$lang_select key=k item=lang}
		<div id="img-lang-{$lang.id|intval}" class="img-lang-hidecontrol" {if ($lang.id !== $default_lang)}hidden{/if}>
			<div class="form-group clearfix">
				<label for="notif-image" class="col-sm-4 control-label">
					{l s='Image' mod='prestanotifypro'}
				</label>
				<div class="col-sm-6">
					{assign var=selected_image value=""}
					{if isset($obj) && isset($obj->id)}
						{assign var=selected_image value=$obj->getAttribute('image', $lang.id|intval)}
					{/if}
					<select id="notif-image-{$lang.id|intval}" name="notif-image-{$lang.id|intval}" class="selectpicker show-menu-arrow show-tick notif-image notif-image-{$lang.id|intval}">
						{if !empty($images)}
							{foreach $images[$lang.id|intval] as $img}
								<option value="{$img}" {if $selected_image == $img}selected="selected"{/if}>{$img}</option>
							{/foreach}
						{/if}
					</select><br /><div class="help-block">{l s='Select between one of the images available for this language' mod='prestanotifypro'}<br />{l s='You can upload new images on the image manager tab' mod='prestanotifypro'}</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label for="notif-image-link" class="col-sm-4 control-label">
					{l s='Link' mod='prestanotifypro'}
				</label>
				<div class="col-sm-6">
					<input type="text" class="form-control notif-image notif-image-{$lang.id|intval}" value="{if isset($obj) && isset($obj->id)}{$obj->getAttribute('image-link', $lang.id|intval)}{/if}" id="notif-image-link-{$lang.id|intval}" name="notif-image-link-{$lang.id|intval}" />
					<div class="help-block">{l s='web page your customer will be redirected to by clicking on this notification' mod='prestanotifypro'}</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label for="notif-image-link" class="col-sm-4 control-label">
					{l s='Width' mod='prestanotifypro'}
				</label>
				<div class="col-sm-6">
					<input type="text" class="form-control notif-image notif-image-{$lang.id|intval}" value="{if isset($obj) && isset($obj->id) && (int)$obj->getAttribute('image-width', $lang.id) > 0}{$obj->getAttribute('image-width', $lang.id|intval)}{else}500{/if}" id="notif-image-width-{$lang.id|intval}" name="notif-image-width-{$lang.id|intval}" />
					<div class="help-block">{l s='in pixel' mod='prestanotifypro'}</div>
				</div>
			</div>
			<div class="form-group clearfix">
				<label for="notif-image-link" class="col-sm-4 control-label">
					{l s='Height' mod='prestanotifypro'}
				</label>
				<div class="col-sm-6">
					<input type="text" class="form-control notif-image notif-image-{$lang.id|intval}" value="{if isset($obj) && isset($obj->id) && (int)$obj->getAttribute('image-height', $lang.id) > 0}{$obj->getAttribute('image-height', $lang.id|intval)}{else}500{/if}" id="notif-image-height-{$lang.id|intval}" name="notif-image-height-{$lang.id|intval}" />
					<div class="help-block">{l s='in pixel' mod='prestanotifypro'}</div>
				</div>
			</div>
		</div>
	{/foreach}
