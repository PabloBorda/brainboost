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

<div class="form-group clear">
	<label for="form-field-1" class="col-sm-4 control-label">
		{l s='Rule name' mod='prestanotifypro'}
	</label>
	<div class="col-sm-6">
		<input type="text" class="form-control" value="{if isset($rule_name) & !empty($rule_name)}{$rule_name|escape:'htmlall':'UTF-8'}{/if}" id="rule_name" name="rule_name" placeholder="{l s='Rule name' mod='prestanotifypro'}" />
		<div class="clear">&nbsp;</div>
	</div>
</div>