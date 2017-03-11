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

<a role-id="{$row_id|intval}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="list-action-enable action-{if $status|intval == 1}enabled{else}disabled{/if}" title="{if $status|intval == 1}{l s='Enabled' mod='prestanotifypro'}{else}{l s='Disabled' mod='prestanotifypro'}{/if}">
	<i class="icon-check {if $status|intval != 1}hidden{/if}"></i>
	<i class="icon-remove {if $status|intval == 1}hidden{/if}" ></i>
</a>