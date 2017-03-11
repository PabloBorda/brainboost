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
{if $role == 'images'}
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {l s='You can see all the images available for the selected language' mod='prestanotifypro'}<br />
    {l s='You can upload new images by clicking on "Upload images" button' mod='prestanotifypro'}<br />
</div>
{else}
<div class="alert alert-info">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    {l s='Click on add new notification buton to start creating your box notifications' mod='prestanotifypro'}<br />
</div>
{l s='Notifications created :' mod='prestanotifypro'}<br /><br />
{/if}

<div class="panel-collapse collapse in">
	<div class="table-responsive clearfix">
		<table id="table-{$role|escape:'htmlall':'UTF-8'}" data-type="{$type|escape:'htmlall':'UTF-8'}" data-role="{$role|escape:'htmlall':'UTF-8'}" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered table-hover dataTableHidden">
			<thead>
                <tr>
                {if $role == 'images'}
                    <th class="text-center">{l s='Image Name' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Preview' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Action' mod='prestanotifypro'}</th>
                {else}
                    <th class="text-center">{l s='Name' mod='prestanotifypro'}</th>
                    {if $multishop|intval === 1}<th class="text-center">{l s='Shop' mod='prestanotifypro'}</th>{/if}
                    <th class="text-center">{l s='Start Date' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='End Date' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Type' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Active' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Delay (ms)' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Preview' mod='prestanotifypro'}</th>
                    <th class="text-center">{l s='Actions' mod='prestanotifypro'}</th>
                {/if}
                </tr>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>
</div>