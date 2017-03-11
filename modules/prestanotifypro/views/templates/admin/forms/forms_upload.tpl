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

<script>
{literal}
	default_lang = '{/literal}{$default_lang|intval}{literal}';
{/literal}
</script>
<form id="form_add" name="form_image">
	<div id="wizard" class="swMain">
	<hr class="clearfix"/>
		<div class="form-group clearfix">
			<label for="form-field-1" class="col-sm-4 control-label">
				{l s='Select your lang' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				<select id="select_lang" name="select_lang" class="selectpicker show-menu-arrow show-tick" data-show-subtext="true">
					{foreach $lang_select as $lang}
						<option value="{$lang.id|intval}" {if ($lang.id === $default_lang)}selected="selected"{/if}>{$lang.title|escape:'htmlall':'UTF-8'}</option>
					{/foreach}
				</select><div class="help-block">{l s='You image will be available for the selected language' mod='prestanotifypro'}</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<label for="upload-image" class="col-sm-4 control-label">
				{l s='Image to upload' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				{foreach $lang_select as $lang}
					<input type="file" class="upload-image upload-image-{$lang.id|intval}" value="" id="upload-image-{$lang.id|intval}" name="upload-image-{$lang.id|intval}" />
				{/foreach}
				<div class="help-block">{l s='Format : JPG, GIF, PNG. Max FileSize (Server settings) : ' mod='prestanotifypro'}{$max_filesize}Mo</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<label for="notif-image-link" class="col-sm-4 control-label">
				{l s='Name' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				{foreach $lang_select as $lang}
					<input type="text" class="form-control upload-image upload-image-{$lang.id|intval}" value="" id="upload-image-name-{$lang.id|intval}" name="upload-image-name-{$lang.id|intval}" />
				{/foreach}
				<div class="help-block">{l s='You can here rename the file' mod='prestanotifypro'}</div>
			</div>
		</div>
	</div>
</form>
