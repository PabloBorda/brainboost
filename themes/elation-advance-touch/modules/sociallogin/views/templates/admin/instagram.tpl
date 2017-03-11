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
		{l s='Go to' mod='sociallogin'} <a href="https://instagram.com/developer/" target="_blank">{l s='Instagram Developers' mod='sociallogin'}</a>
		. {l s='and login with your credentials' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "Register your Application" button, then click on "Register a new client" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out all the required fields and' mod='sociallogin'}:
		<br />
		{l s='Type in "Website URL"' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop->getBaseURL()|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='In the "Valid redirect URIs" field' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'instagram'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Click on "Register" button to finish process' mod='sociallogin'}.
	</li>
	<li>
		{l s='Copy "CLIENT ID" and "CLIENT SECRET" under "API Keys" menu' mod='sociallogin'}.
	</li>
</ol>