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
		{l s='Go to' mod='sociallogin'} <a href="https://github.com/settings/developers" target="_blank">{l s='Github Oauth Applications' mod='sociallogin'}</a>
		. {l s='and login with your credentials' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "register an application" link on section "Developer Applications"' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out all the required fields' mod='sociallogin'}:
		<br />
		{l s='Type in "Homepage URL" field' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop->getBaseURL()|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='In the "Authorization callback URL" field' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'github'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Then click on "Register Application" button.' mod='sociallogin'}.
	</li>
	<li>
		{l s='Copy "Client ID" and "Client Secret" at the top of the page' mod='sociallogin'}.
	</li>
</ol>
<p>{l s='More info in:' mod='sociallogin'} <a target="_blank" href="https://developer.github.com/v3/oauth/"><i class="fa fa-external-link"></i> Github</a></p>