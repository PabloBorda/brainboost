{*
/**
 * StorePrestaModules SPM LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
 /*
 * 
 * @author    StorePrestaModules SPM
 * @category content_management
 * @package blockblog
 * @copyright Copyright StorePrestaModules SPM
 * @license   StorePrestaModules SPM
 */
*}

	<div id="blockblogcat_block_left_spm" class="block margin-top-10 {if $blockblogis16 == 1}blockmanufacturer16{else}blockmanufacturer{/if}" >
		<h4 class="title_block">
			<a href="{$blockblogcategories_url|escape:'htmlall':'UTF-8'}" title="{l s='Blog Categories' mod='blockblog'}"
				>{l s='Blog Categories' mod='blockblog'}</a>
		</h4>
		<div class="block_content">

            {if count($blockblogcategories) > 0}
            <div class="items-cat-block">
                {foreach from=$blockblogcategories item=items name=myLoop1}
                    {foreach from=$items.data item=blog name=myLoop}
                        <div class="name-category">
                            <a title="{$blog.title|escape:'htmlall':'UTF-8'}"
                               href="{if $blockblogurlrewrite_on == 1}{$blockblogcategory_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogcategory_url|escape:'htmlall':'UTF-8'}?category_id={$blog.id|escape:'htmlall':'UTF-8'}{/if}"
                                    >{$blog.title|escape:'htmlall':'UTF-8'}</a>
                        </div>
                    {/foreach}
                {/foreach}
                <p class="block-view-all category-button-view-all">
                    <a title="{l s='View all categories' mod='blockblog'}"  class="button"
                       href="{$blockblogcategories_url|escape:'htmlall':'UTF-8'}"><b>{l s='View all categories' mod='blockblog'}</b></a>
                </p>
            </div>


	    {else}
		<div class="block-no-items">
			{l s='There are not Categories yet.' mod='blockblog'}
		</div>
		{/if}
		</div>
	</div>





