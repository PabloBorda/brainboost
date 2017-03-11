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
<form id="form_add" name="form_notif">
	<div id="wizard" class="swMain">
		<div class="form-group clearfix">
			<label for="notif_name" class="col-sm-4 control-label">
				{l s='Notification name' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="{if isset($obj) && isset($obj->name)}{$obj->name|escape:'htmlall':'UTF-8'}{/if}" id="notif_name" name="notif_name" placeholder="{l s='Notification name' mod='prestanotifypro'}" />
			</div>
		</div>
		

		<div class="form-group clearfix">
			<label for="notif_date_start" class="col-sm-4 control-label">
				{l s='Notification date start (leave blank if not needed)' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				<input type="text" class="form-control date" value="{if isset($obj) && isset($obj->date_start) && !empty($obj->date_start) && $obj->date_start != '0000-00-00 00:00:00'}{$obj->date_start|escape:'htmlall':'UTF-8'}{/if}" readonly id="notif_date_start" name="notif_date_start" />
			</div>
		</div>
		
	
		<div class="form-group clearfix">
			<label for="notif_date_end" class="col-sm-4 control-label">
				{l s='Notification date end (leave blank if not needed)' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				<input type="text" class="form-control date" readonly value="{if isset($obj) && isset($obj->date_end) && !empty($obj->date_end) && $obj->date_end != '0000-00-00 00:00:00'}{$obj->date_end|escape:'htmlall':'UTF-8'}{/if}" id="notif_date_end" name="notif_date_end" />
			</div>
		</div>
		

			<!-- Remove comment when html becomes available		
			<div class="form-group clearfix">
			<label for="notif-type" class="col-sm-4 control-label">
				{l s='Notification type' mod='prestanotifypro'}
			</label>
			<div class="col-sm-6">
				<select id="notif-type" name="notif-type" class="selectpicker show-menu-arrow show-tick" data-show-subtext="true">
					<option value="image" {if (!isset($obj) || (isset($obj->type) && $obj->type === 'image'))}selected="selected"{/if}>{l s='Image'}</option>
					<option value="html" {if (isset($obj) && isset($obj->type) && $obj->type === 'html')}selected="selected"{/if}>{l s='Html'}</option>
				</select>
			</div>
		</div> --> 
		

		<div class="form-group clearfix">
			<label for="notif_name" class="col-sm-4 control-label">
				{l s='Notification delay' mod='prestanotifypro'}
				<p class="help-block" style="margin-top:-3px;font-style:italic">in ms (ex 1500 = 1.5sec)</p>
			</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" value="{if isset($obj) && isset($obj->delay)}{$obj->delay|escape:'htmlall':'UTF-8'}{else}1500{/if}" id="notif_delay" name="notif_delay" />
			</div>
		</div>	

	<hr class="clearfix"/>
		<div class="alert alert-info">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			{l s='Fill all the languages available on your shop if you want the notification to be displayed for these languages' mod='prestanotifypro'}<br />
			{l s='You can activate new languages on the localization tab' mod='prestanotifypro'}
		</div>

	<div id="step-image" {if (isset($obj->type) && isset($obj->type) && $obj->type != 'image')}class="hidden"{/if}>
		<div class="form-group clearfix">
		<label for="form-field-1" class="col-sm-4 control-label">
			{l s='Select your lang' mod='prestanotifypro'}
		</label>
		<div class="col-sm-6">
			{foreach from=$lang_select key=k item=lang}
				<button type="button" value="{$lang.id|intval}" class="lang_selector {if ($lang.id === $default_lang)}selected btn-primary {/if}btn btn-default">{$k|escape:'html'}</button>
			{/foreach}
			<p>&nbsp;</p>
		</div>
		{include file="./forms_image.tpl"}
	</div>
	<div id="step-html" {if (!isset($obj->type) || (isset($obj->type) && isset($obj->type) && $obj->type != 'html'))}class="hidden"{/if}>
		{include file="./forms_html.tpl"}
	</div>
	</div>
</form>
