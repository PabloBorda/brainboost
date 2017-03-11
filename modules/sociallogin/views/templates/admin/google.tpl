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

<ol>
	<li>
		{l s='Go to' mod='sociallogin'} <a href="https://code.google.com/apis/console/" target="_blank">{l s='Google Api Console' mod='sociallogin'}</a>
		{l s='link and log in with your Google account' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on "Create Project" and fill the field "PROJECT NAME" and hit "Create" button to save' mod='sociallogin'}.
	</li>
	<li>
		{l s='Go to "APIs" under "APIS & AUTH" and click search "Google+ API" and enable it' mod='sociallogin'}.
	</li>
	<li>
		{l s='Go to "CREDENTIALS" under "APIS & AUTH" and click on "Create new Client ID"' mod='sociallogin'}.
	</li>
	<li>
		{l s='Select' mod='sociallogin'} {l s='"APLICATION TYPE"' mod='sociallogin'}: <i>{l s='Web Application' mod='sociallogin'}</i>
		{l s='and type in the fields' mod='sociallogin'}:
		<br />
		{l s='"AUTHORIZED JAVASCRIPT ORIGINS"' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop_protocol|escape:'htmlall':'UTF-8'}{$shop->domain|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='"AUTHORIZED REDIRECT URI"' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'google'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='and click on "Create Client ID"' mod='sociallogin'}
	</li>
	<li>
		{l s='Copy the Google generated "CLIENT ID" and "CLIENT SECRET" and insert them bellow' mod='sociallogin'}.
	</li>
</ol>