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
		{l s='Go to' mod='sociallogin'} <a href="https://developer.paypal.com/developer/applications/" target="_blank">{l s='Paypal Dashboard' mod='sociallogin'}</a>
		. {l s='and login with your credentials' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "Create App" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out application details and click on "Create App"' mod='sociallogin'}.
        <br />
        {l s='Click on "Live" tab on top of configuration page. Go to "LIVE APP SETTINGS" section and' mod='sociallogin'}:
		<br />
		{l s='In the "Return URL" field' mod='sociallogin'}:
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'paypal'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Then, enable "Log In with PayPal" and click on "Advanced Options".' mod='sociallogin'}.
		<br />
		{l s='Check "Basic authentication" and "Personal Information"' mod='sociallogin'}.
        <br />
        {l s='You need to copy your "Privacy policy URL" and "User agreement URL" into "Links shown on customer consent page" section' mod='sociallogin'}.
        <br />
        {l s='Last, click on "Save" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Copy "Client ID" and "Secret" under "Credential Pairs" section' mod='sociallogin'}.
	</li>
</ol>