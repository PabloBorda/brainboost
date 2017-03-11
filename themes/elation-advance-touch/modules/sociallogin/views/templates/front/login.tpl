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
	{l s='Social Network Login' mod='sociallogin'}
{/capture}

<h1 class="page-subheading">{l s='Social Network Login' mod='sociallogin'}</h1>

{include file="$tpl_dir./errors.tpl"}

<ul class="footer_links clearfix">
    {if isset($is_logged) && $is_logged}
	<li>
		<a class="btn btn-defaul button button-small" href="{$link->getModuleLink('sociallogin', 'account', [], true)|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Back to connect social networks' mod='sociallogin'}</span>
		</a>
	</li>
	<li>
		<a class="btn btn-defaul button button-small" href="{$link->getPageLink('my-account', true)|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Back to my account' mod='sociallogin'}</span>
		</a>
	</li>
    {else}
	<li>
		<a class="btn btn-defaul button button-small" href="{$link->getPageLink('authentication', true)|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Back to authentication' mod='sociallogin'}</span>
		</a>
	</li>
    {/if}
	<li>
		<a class="btn btn-defaul button button-small" href="{$base_dir|escape:'htmlall':'UTF-8'}">
			<span><i class="icon-chevron-left"></i> {l s='Home' mod='sociallogin'}</span>
		</a>
	</li>
</ul>