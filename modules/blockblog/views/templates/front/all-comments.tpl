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

{capture name=path}
{$meta_title|escape:'htmlall':'UTF-8'}
{/capture}

{if $blockblogis16 == 0}
{include file="$tpl_dir./breadcrumb.tpl"}
<h2 class="background-none">{$meta_title|escape:'htmlall':'UTF-8'}</h2>
{else}
<h1 class="page-heading">{$meta_title|escape:'htmlall':'UTF-8'}</h1>
{/if}



<div class="blog-header-toolbar">
{if $count_all > 0}

<div class="toolbar-top">
			
	<div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if}">
		<ul class="actions">
			<li class="frst">
					<strong>{l s='Comments' mod='blockblog'}  ( {$count_all|escape:'htmlall':'UTF-8'} )</strong>
			</li>
		</ul>
		
	</div>

</div>



    <ul class="blog-posts">

        {foreach from=$comments item=comment name=myLoop}
            <li>
                <div class="top-blog">

                    {$comment.comment|strip_tags|escape:'htmlall':'UTF-8'}

                    <br/>
                    <small class="float-right block-blog-date"><i class="fa fa-user"></i>&nbsp;{$comment.name|escape:'htmlall':'UTF-8'}</small>

                    <div class="clear"></div>
                        <p class="float-left">

                            <time datetime="{$comment.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}" pubdate="pubdate"
                                    ><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$comment.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</time>

                        </p>
                    <p class="float-right comment">
                        <i class="fa fa-list-alt fa-lg"></i>&nbsp; <a href="{if $blockblogurlrewrite_on == 1}
                                                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$comment.post_seo_url|escape:'htmlall':'UTF-8'}
                                                                      {else}
                                                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$comment.post_seo_url|escape:'htmlall':'UTF-8'}
                                                                      {/if}"
                                                                      title="{$comment.post_title|escape:'htmlall':'UTF-8'}"
                                >{$comment.post_title|escape:'htmlall':'UTF-8'}</a>
                    </p>

                    <div class="clear"></div>
                </div>


            </li>
        {/foreach}

    </ul>




<div class="toolbar-bottom">
	<div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if} text-align-center" >
		{$paging|escape:'quotes':'UTF-8'}
    </div>
</div>
{else}
	<div class="block-no-items">
	{l s='There are not comments yet' mod='blockblog'}
	</div>
{/if}

</div>
