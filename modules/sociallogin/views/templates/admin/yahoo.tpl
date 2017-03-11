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
		{l s='Go to' mod='sociallogin'} <a href="http://developer.yahoo.com/" target="_blank">{l s='Yahoo Developer Network' mod='sociallogin'}</a>
		. {l s='Click on "My Projects" under your profile menu' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on the "Create a Project" button' mod='sociallogin'}.
	</li>
	<li>
		{l s='Fill out all the required fields and select' mod='sociallogin'}:
		<br />
		{l s='Under "Application Type"' mod='sociallogin'}: <i>{l s='Web Application' mod='sociallogin'}.</i>
		<br />
		{l s='Type in "Home Page URL"' mod='sociallogin'}: 
		<input class="fixed-width-xxl" type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$shop->getBaseURL()|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Fill the "Callback Domain"' mod='sociallogin'}: 
		<input type="text" readonly="readonly" onclick="this.focus();this.select()" value="{$link->getModuleLink('sociallogin', 'login', ['p' => 'yahoo'], true)|escape:'htmlall':'UTF-8'}"></input>
		<br />
		{l s='Under "API Permissions" select' mod='sociallogin'}: {l s='"Profiles (Social Directory)" with "Read/Write Public and Private" permission' mod='sociallogin'}.
		<br />
		{l s='Fill all the other required fields and then click on "Crate App"' mod='sociallogin'}.
	</li>
	<li>
		{l s='In "APIs and Services" menu, under "Authentication Information: OAuth" copy and paste bellow the "Client ID (Consumer Key)" and "Client Secret (Consumer Secret)"' mod='sociallogin'}.
	</li>
	<li>
		{l s='Follow the instructions in' mod='sociallogin'} <a target="_blank" href="https://developer.apps.yahoo.com/manage">https://developer.apps.yahoo.com/manage</a> {l s='to verify your domain' mod='sociallogin'}.
	</li>
</ol>