{*
* 2007-2014 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @version  Release: $Revision$
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}
{if $page_name =='index'}
    <!-- Module EbHomePromos -->
    {if isset($ebhomepromos_slides)}
        <div id="ebhomepromos-slider">
            <ul id="ebhomepromos">
                {foreach from=$ebhomepromos_slides item=slide}
                    {if $slide.active}
                        <li class="ebhomepromos-container">
                        	<img src="{$link->getMediaLink("`$smarty.const._MODULE_DIR_`ebhomepromos/images/`$slide.image|escape:'htmlall':'UTF-8'`")}" alt="{$slide.legend|escape:'htmlall':'UTF-8'}" class="animate-fast"/>
                            {if isset($slide.description) && trim($slide.description) != ''}
                                <div class="ebhomepromos-description animate-fast">
                                	{$slide.description}
                                    {if isset($slide.url)}
                                        <a class="btn" href="{$slide.url|escape:'html':'UTF-8'}" title="{$slide.legend|escape:'html':'UTF-8'}">{l s='Learn more' mod='ebhomepromos'}</a>
                                    {/if}
                                </div>
                            {/if}
                        </li>
                    {/if}
                {/foreach}
            </ul>
        </div>
        {if isset($ebhomepromos)}
                {if $ebhomepromos_slides|@count > 1}
                    {if $ebhomepromos.loop == 1}
                        {addJsDef ebhomepromos_loop=true}
                    {else}
                        {addJsDef ebhomepromos_loop=false}
                    {/if}
                {else}
                    {addJsDef ebhomepromos_loop=false}
                {/if}
                {addJsDef ebhomepromos_width=$ebhomepromos.width}
                {addJsDef ebhomepromos_speed=$ebhomepromos.speed}
                {addJsDef ebhomepromos_pause=$ebhomepromos.pause}
        {/if}
    {/if}
    <!-- /Module EbHomePromos -->
{/if}