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

{foreach from=$social_networks item=item key=k}
	{if $item.complete_config}
		<div class="text-center col-xs-{if !$button}12{elseif $button}4{else}6{/if} col-sm-{if $sign_in && !$button}6{elseif $button}3{else}4{/if} col-md-{if $sign_in && !$button}6{elseif $button}2{else}4{/if}">
			<button class="btn azm-social {$button_class|escape:'html':'UTF-8'} azm-{$item.icon_class|escape:'html':'UTF-8'}" onclick="window.open('{$item.connect|escape:'html':'UTF-8'}', {if $popup}'_blank'{else}'_self'{/if}, 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')" style="color=white!important;">
				<i class="fa fa-{$item.fa_icon|escape:'html':'UTF-8'}"></i> 
				{if !$button}
					{if $sign_in}{l s='Sign in with' mod='sociallogin'}{/if} 
					{$item.name|escape:'html':'UTF-8'|capitalize}
				{/if}
			</button>
			<div class="clearfix">&nbsp;</div>
		</div>
	{/if}
{/foreach}