{*
* 2007-2015 PrestaShop
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
<div class="btn-group-action">
	<div class="btn-group">
        {if $role == 'images'}
            <a role-id="{$row_id|escape:'htmlall':'UTF-8'}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="pointer preview btn btn-default">
                <i class="icon-eye"></i> {l s='Preview' mod='prestanotifypro'}
            </a>
        {else}
            <a data-lang="{$default_lang|intval}" role-id="{$row_id|intval}" data-role="{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" class="btn btn-default preview">
                <i class="icon-eye"></i>&nbsp;{$lang_select.$default_lang_iso.title} <small class="muted text-muted">{$lang_select.$default_lang_iso.subtitle}</small>
            </a>
            <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="multilang_preview" aria-expanded="true">
                <i class="icon-caret-down"></i>&nbsp;
            </button>
            <ul aria-labelledby="multilang_preview" class="dropdown-menu" role="menu">
                <li class="pointer">
                {foreach from=$lang_select key=k item=lang_preview}
                    {if $k !== $default_lang_iso}
                    <a data-lang="{$lang_preview.id|intval}" role-id="{$row_id|intval}" data-role="{$role|escape:'htmlall':'UTF-8'}"  data-type="{$type|escape:'htmlall':'UTF-8'}" class="pointer preview">
                        <i class="icon-eye"></i>&nbsp;{$lang_preview.title|escape:'htmlall':'UTF-8'} <small class="muted text-muted">{$lang_preview.subtitle|escape:'htmlall':'UTF-8'}</small>
                    </a>
                    {/if}
                {/foreach}
                </li>
            </ul>
        {/if}
	</div>
</div>