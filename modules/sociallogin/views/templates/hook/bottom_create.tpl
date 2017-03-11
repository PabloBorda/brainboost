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

<div class="col-xs-12">
    <div class="or-container">
        <hr class="or-hr" />
        <div id="or" class="img-circle">{l s='or' mod='sociallogin'}</div>
    </div>
</div>

{foreach from=$social_networks item=item key=k}
	{if $item.complete_config}
		<div class="text-center col-xs-{if !$button}12{elseif $button}4{else}6{/if} col-sm-{if $sign_in && !$button}6{elseif $button}3{else}4{/if} col-md-{if $sign_in && !$button}6{elseif $button}2{else}4{/if}">
			<a class="btn azm-social azm-size-{$size|intval} azm-{$border_style|escape:'html':'UTF-8'} azm-{$item.icon_class|escape:'html':'UTF-8'}" href="{$item.connect|escape:'html':'UTF-8'}" {if $popup}target="_blank"{/if}>
				<i class="fa fa-{$item.fa_icon|escape:'html':'UTF-8'}"></i> 
            </a>
			<div class="clearfix">&nbsp;</div>
		</div>
	{/if}
{/foreach}