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

{if isset($user_code) && isset($network)}
<div class="alert alert-info">
	<h2>{l s='Complete your register' mod='sociallogin'}</h2>
	<ul>
		<li>{l s='Please, fill in some missing fields in the form to complete your registration with' mod='sociallogin'} {$network|escape:'html':'UTF-8'|capitalize}.</li>
		<li>{l s='After registering, you will be able to login with your social account when you return.' mod='sociallogin'}.</li>
	</ul>
	<p><a class="alert-link" href="{$link->getPageLink('authentication', true)|escape:'html':'UTF-8'}" title="{l s='Back' mod='sociallogin'}">&laquo; {l s='Back' mod='sociallogin'}</a></p>
</div>

<div class="social_login">
    <input type="hidden" name="user_code" value="{$user_code|escape:'html':'UTF-8'}" />
    <input type="hidden" name="network" value="{$network|escape:'html':'UTF-8'}" />
</div>
{/if}