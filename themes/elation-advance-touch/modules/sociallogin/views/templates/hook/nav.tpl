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
 <!-- social_login-->
 qweqweqweqweqwe
{if !$logged && in_array('next_login', $positions)}

	<div class="header_social_buttons">
	{foreach from=$social_networks item=item key=k}
		{if $item.complete_config}
			<div class="pull-left">
				<button class="btn azm-social azm-size-32 azm-r-square azm-{$item.icon_class|escape:'htmlall':'UTF-8'}" onclick="window.open('{$item.connect|escape:'htmlall':'UTF-8'}', {if $popup}'_blank'{else}'_self'{/if}, 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')">
					<i class="fa fa-{$item.fa_icon|escape:'htmlall':'UTF-8'}"></i>
				</button>&nbsp;
			</div>
		{/if}
	{/foreach}
	</div>

{/if}

 <!-- social_login end -->