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
<div style="display:none">
	<div id="prestanotifypro">
		{if $prestanotifypro_type == 'image'}
			<a href="{$shadow_box_content_link}">
				<img src="{$prestanotifypro_img_path}{$shadow_box_content|escape:'htmlall':'UTF-8'}" alt="" width="100%"/>
			</a>
		{else}

		{/if}
	</div>
</div>
{if $ps_version <= '1.6'}
	{include file='./js_1-6.tpl'}
{else}
	{include file='./js_1-7.tpl'}
{/if}
