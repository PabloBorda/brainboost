{*
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*}

{capture name=path}
	<a href="{$link->getPageLink('my-account', true)|escape:'htmlall':'UTF-8'}" title="{l s='My account' mod='sociallogin'}" rel="nofollow">
		{l s='My account' mod='sociallogin'}
	</a>
	<span class="navigation-pipe">
		{$navigationPipe|escape:'htmlall':'UTF-8'}
	</span>
	{l s='Social Account Linking' mod='sociallogin'}
{/capture}

{assign var=configure_url value=[
	'facebook' => 'https://www.facebook.com/settings?tab=applications',
    'github' => 'https://github.com/settings/applications',
	'google' => 'https://plus.google.com/apps',
    'instagram' => 'https://instagram.com/accounts/manage_access/',
	'linkedin' => 'https://www.linkedin.com/secure/settings?userAgree',
	'microsoft' => 'https://account.live.com/consent/Manage',
    'paypal' => 'https://www.paypal.com/webapps/auth/identity/myactivity?execution=e1s1',
    'pinterest' => 'https://es.pinterest.com/settings/',
	'twitter' => 'https://twitter.com/settings/applications',
	'yahoo' => 'https://api.login.yahoo.com/WSLogin/V1/unlink']}

<h1 class="page-subheading">{l s='Social Account Linking' mod='sociallogin'}</h1>
<p>{l s='Here you will connect your social accounts to login easily in our shop.' mod='sociallogin'}</p>

{include file="$tpl_dir./errors.tpl"}

{if isset($confirmations) && $confirmations|count}
    {foreach $confirmations as $confirmation}
    <p class="alert alert-success"> {l s=$confirmation mod='sociallogin'}</p>
    {/foreach}
{/if}

<div class="box">
	<div class="panel panel-default">
		<table class="table">
			<thead>
				<tr>
					<th>{l s='Network'  mod='sociallogin'}</th>
					<th>{l s='Action'  mod='sociallogin'}</th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$social_networks item=item key=k}
					{if $item.complete_config}
					<tr>
						<td>
							<p class="btn azm-social azm-size-48 azm-r-square azm-{$item.icon_class|escape:'htmlall':'UTF-8'}">
								<i class="fa fa-{$item.fa_icon|escape:'htmlall':'UTF-8'}"></i>
							</p>
						</td>
						<td>
							{if !$customer_log[$item.name]}
								<button class="btn btn-success" onclick="connectSocial('{$item.connect|escape:'htmlall':'UTF-8'}', '{l s='Confirm that you want to connect %s to your account' sprintf=$item.name|escape:'htmlall':'UTF-8'|capitalize mod='sociallogin'}', {if isset($popup) && $popup}'_blank'{else}'_self'{/if})">
									<i class="fa fa-sign-in"></i> {l s='Connect' mod='sociallogin'}
								</button>
							{else}
								<button class="btn btn-danger" onclick="deleteSocial('{$item.delete|escape:'htmlall':'UTF-8'}', '{l s='Confirm that you want to disconnet %s from your account' sprintf=$item.name|escape:'htmlall':'UTF-8'|capitalize mod='sociallogin'}')">
									<i class="fa fa-trash-o"></i> {l s='Disconnect' mod='sociallogin'}
								</button>
							{/if}
							{if isset($configure_url[$item.name])}
							<a class="btn btn-link" href="{$configure_url[$item.name]|escape:'htmlall':'UTF-8'}" title="{l s='Configure' mod='sociallogin'} {$item.name|escape:'htmlall':'UTF-8'|capitalize}" target="_blank">
								<i class="fa fa-external-link"></i> {l s='Configure' mod='sociallogin'}
							</a>
							{/if}
						</td>
					</tr>
					{/if}
				{/foreach}
			</tbody>
		</table>
	</div>
	<p>&nbsp;</p>
	<p class="alert alert-warning">{l s='You can connect your social accounts, but if you have your email in other registered customer account you will login in the other account. Remember that duplicated account is prohibited in our terms and conditions.' mod='sociallogin'}</p>
</div>
<ul class="footer_links clearfix">
	<li>
		<a class="btn btn-defaul button button-small" href="{$link->getPageLink('my-account', true)|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Back to your account' mod='sociallogin'}</span>
		</a>
	</li>
	<li>
		<a class="btn btn-defaul button button-small" href="{$base_dir|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Home' mod='sociallogin'}</span>
		</a>
	</li>
</ul>