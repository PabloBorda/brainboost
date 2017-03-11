{**
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
* @author    PrestaShop SA <contact@prestashop.com>
* @copyright 2007-2014 PrestaShop SA
* @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
* International Registered Trademark & Property of PrestaShop SA
*}

{literal}
<script>
	ps_version = '{/literal}{$ps_version|intval}{literal}';
	multishop = '{/literal}{$multishop|intval}{literal}';
	default_lang = '{/literal}{$default_lang|intval}{literal}';
	admin_module_ajax_url = '{/literal}{$controller_url}{literal}';
	admin_module_controller = "{/literal}{$controller_name|escape:'htmlall':'UTF-8'}{literal}";
{/literal}
	next_message = '{l s=' Next' mod='prestanotifypro' js=1}';
	prev_message = '{l s=' Back' mod='prestanotifypro' js=1}';
	skip_message = '{l s=' Skip' mod='prestanotifypro' js=1}';
	save_message = '{l s=' Save' mod='prestanotifypro' js=1}';
	close_message = '{l s='Close' mod='prestanotifypro' js=1}';
	delete_message = '{l s='Delete' mod='prestanotifypro' js=1}';
	delete_notif_message = '{l s='Are you sure you want to delete this notification?' mod='prestanotifypro' js=1}';
	delete_image_message = '{l s='Are you sure you want to delete this image?' mod='prestanotifypro' js=1}';
    records_msg = '{l s='Show' mod='prestanotifypro' js=1}';
	zero_records_msg = '{l s='Nothing found' mod='prestanotifypro' js=1}';
    form_title_image = '{l s='Image Upload' mod='prestanotifypro' js=1}';
    form_title_notification = '{l s='Notification' mod='prestanotifypro' js=1}';
</script>

{if $ps_version == 0}
<div class="bootstrap">
	<!-- Beautiful header -->
	{include file="./header.tpl"}
{/if}
	<!-- Module content -->
	<!-- Module content -->
	<div id="modulecontent" class="clearfix">
		<!-- Nav tabs -->
		<div class="col-lg-2">
			<div class="list-group">
				<a href="#documentation" class="list-group-item active" data-toggle="tab"><i class="icon-book"></i> {l s='Documentation' mod='prestanotifypro'}</a>
				<a href="#filemanager" class="filemanager list-group-item" data-toggle="tab"><i class="icon icon-picture-o" data-target="table-images"></i> {l s='Image Manager' mod='prestanotifypro'}</a>
				<a href="#congif" class="list-group-item" data-toggle="tab"><i class="icon-indent" data-target="table-notif"></i> {l s='Configuration' mod='prestanotifypro'}</a>
				<a href="#faq" class="faq list-group-item" data-toggle="tab"><i class="icon-comments"></i> {l s='FAQ' mod='prestanotifypro'}</a>
				<a href="#contacts" class="contacts list-group-item" data-toggle="tab"><i class="icon-envelope"></i> {l s='Contact' mod='prestanotifypro'}</a>
			</div>
			<div class="list-group">
				<a class="list-group-item"><i class="icon-info"></i> {l s='Version' mod='prestanotifypro'} {$module_version|escape:'htmlall':'UTF-8'}</a>
			</div>			
			<div class="list-group">
				<a class="list-group-item" href="javascript:$('#clearcache').submit();"><i class="icon-trash-o"></i> {l s='CLEAR CACHE' mod='prestanotifypro'}</a>
				<form method="post" action="" class="hidden" id="clearcache">
					<input type="hidden" value="1" name="ClearCache">
					<input type="submit" name="submitClearCache" value="1">
				</form>
			</div>
		</div>
		<!-- Tab panes -->
		<div class="tab-content col-lg-10">
			{if isset($rights_alert) && !empty($rights_alert)}
				{$rights_alert}
			{else}
				{if isset($cookie_error) && !empty($cookie_error)}
					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">×</button>
						{l s='You are using different addresses to access your backoffice and to access your frontoffice.' mod='prestanotifypro'}<br />
						{l s='Your current host is :' mod='prestanotifypro'} {$current_host}.
						{l s='Your frontoffice host is:' mod='prestanotifypro'} {$main_host}<br />
						{l s='Please access your backoffice with this address: ' mod='prestanotifypro'} <a href="http://{$main_host}/backoffice"> http://{$main_host}/backoffice </a> {l s='and click on "CLEAR CACHE" again. ' mod='prestanotifypro'}<br /> 
					</div>
				{/if}
				{if $submit}
					{if isset($config_warnings) && !empty($config_warnings)}
						<div class="alert alert-danger">
							<ul>
							{foreach from=$config_warnings item=error}
								<li>{$error}</li>
							{/foreach}
							</ul>
						</div>
					{/if}
					{if isset($clearcache) && !empty($clearcache)}
					<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">×</button>
						{l s='Cache cleared !' mod='prestanotifypro'}
					</div>
					{/if}

				{/if}
				<div class="tab-pane active panel" id="documentation">
					{include file="./tabs/documentation.tpl"}
				</div>

				<div class="tab-pane panel" id="congif">
					{include file="./tabs/config.tpl"}
				</div>			

				<div class="tab-pane panel" id="filemanager">
					{include file="./tabs/filemanager.tpl"}
				</div>

				<div class="tab-pane panel" id="faq">
					{include file="./tabs/faq.tpl"}
				</div>

				{include file="./tabs/contact.tpl"}
			{/if}
		</div>
	</div>
{if $ps_version == 0}
	<!-- Manage translations -->
	{include file="./translations.tpl"}
</div>
{/if}
