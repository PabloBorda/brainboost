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
		{l s='Go to' mod='sociallogin'} <a href="https://developers.pinterest.com/apps/" target="_blank">{l s='Pinterest Apps' mod='sociallogin'}</a>
		. {l s='and login with your credentials' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "Create App" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out all the required fields and click on "Create" button.' mod='sociallogin'}:
		<br />
		{l s='Type in "Platform", in "Web" section, "Site URL" field' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop->getBaseURL()|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='In the "Redirect URIs" field type and Enter to Add' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'pinterest'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Then "Save" changes' mod='sociallogin'}.
	</li>
	<li>
		{l s='Copy "App ID" and "App secret" at the top of the page' mod='sociallogin'}.
	</li>
</ol>
<p><b>{l s='Important!' mod='sociallogin'}</b>: {l s='Check "Status" section, In development: You\'re almost ready! You still need at least 1 collaborator to authorize your app before you can submit. Complete requirements to enable your API. You\ll be able to use it until you submit your App for review. After add an user and test your API you will be able to submit for review.' mod='sociallogin'}</p>
<p>{l s='After add an user and test your API you will be able to submit for review.' mod='sociallogin'}</p>
<p>{l s='More info in:' mod='sociallogin'} <a target="_blank" href="https://developers.pinterest.com/docs/api/overview/"><i class="fa fa-external-link"></i> Pinterest</a></p>