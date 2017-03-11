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

{if $blockblogtab_blog_pr == 1}

{if $blockblogbtabs_type == 1}

{if count($blockblogcategories) > 0}
<h3 class="page-product-heading" id="#idTab999">
	{l s='Blog' mod='blockblog'}
</h3>
{/if}

{/if}

{/if}


{if $blockblogtab_blog_pr == 1}

{if count($blockblogcategories) > 0}
<div id="idTab999" >
	    <ul class="bullet">
	    {foreach from=$blockblogcategories item=items name=myLoop1}
	    	{foreach from=$items.data item=blog name=myLoop}
	    	
	    	<li class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">
	    		   
	    		   {if $blockblogurlrewrite_on == 1}
		    		<a href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogiso_lng|escape:'htmlall':'UTF-8'}blog/category/{$blog.seo_url|escape:'htmlall':'UTF-8'}" 
		    		   title="{$blog.title|escape:'htmlall':'UTF-8'}">{$blog.title|escape:'htmlall':'UTF-8'}</a>
		    		{else}
		    		<a href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/blockblog-category.php?category_id={$blog.id|escape:'htmlall':'UTF-8'}" 
		    		   title="{$blog.title|escape:'htmlall':'UTF-8'}">{$blog.title|escape:'htmlall':'UTF-8'}</a>
		    		{/if}
	    		
	    	</li>
	    	{/foreach}
	    {/foreach}
	    </ul>
</div>

{/if}

{/if}

