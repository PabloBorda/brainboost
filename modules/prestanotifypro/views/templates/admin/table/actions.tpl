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
<div class="btn-group-action fleft">
	<div class="btn-group">
        {if $role == 'images'}
            <a role-id="{$row_id|escape:'htmlall':'UTF-8'}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="pointer delete btn btn-default">
                <i class="icon-trash"></i> {l s='Delete' mod='prestanotifypro'}
            </a>
        {else}
            <a role-id="{$row_id|intval}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="pointer edit btn btn-default">
                <i class="icon-pencil"></i> {l s='Edit' mod='prestanotifypro'}
            </a>
            
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="notif_delete" aria-expanded="true">
                <i class="icon-caret-down"></i>&nbsp;
            </button>
            <ul aria-labelledby="notif_delete" class="dropdown-menu" role="menu">
                <li class="pointer">
                    <a role-id="{$row_id|intval}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="pointer delete">
                        <i class="icon-trash"></i> {l s='Delete' mod='prestanotifypro'}
                    </a>
                </li>
            </ul>
        {/if}
	</div>
</div>