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
		{l s='Go to' mod='sociallogin'} <a href="https://dev.twitter.com/apps" target="_blank">{l s='Twitter Developers' mod='sociallogin'}</a>
		. {l s='and login with your credentials' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "Create New App" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out all the required fields and' mod='sociallogin'}:
		<br />
		{l s='Type in "Website"' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop->getBaseURL()|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='In the "Callback URL" field' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'twitter'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Read and agree to rules, and then "Create your Twitter application"' mod='sociallogin'}.
		<br />
		{l s='Go to "Settings" tab, check the option "Allow this application to be used to Sign in with Twitter" and click on "Update settings"' mod='sociallogin'}.
	</li>
	<li>
		{l s='Copy "API key" and "API secret" under "API Keys" menu' mod='sociallogin'}.
	</li>
	<li>
		{l s='Request your API for whitelist to get email address in' mod='sociallogin'} <a href="https://support.twitter.com/forms/platform">{l s='this form' mod='sociallogin'}</a>.
	</li>
</ol>
<p>{l s='More info in:' mod='sociallogin'} <a target="_blank" href="https://dev.twitter.com/rest/reference/get/account/verify_credentials"><i class="fa fa-external-link"></i> Twitter</a></p>