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

<div class="col-xs-2">
    <ul class="nav nav-tabs tabs-left list-group">
    	<li class="list-group-item {if $tab_active == 'home'}active{/if}"><a href="#home" data-toggle="tab"><i class="fa fa-home"></i> {l s='Home' mod='sociallogin'}</a></li>
    	{foreach from=$social_networks item=item key=k}
    	<li class="list-group-item {if $tab_active == $item.name}active{/if}">
            <a href="#{$item.name|escape:'htmlall':'UTF-8'}" data-toggle="tab">
                <i class="fa fa-{if $item.name == 'microsoft'}windows{else}{$item.name|escape:'htmlall':'UTF-8'}{/if}"></i> {$item.name|escape:'htmlall':'UTF-8'|capitalize}
            </a>
        </li>
    	{/foreach}
    </ul>
</div>