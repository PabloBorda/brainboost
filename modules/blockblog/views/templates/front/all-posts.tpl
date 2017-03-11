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


{if $blockblogis_search == 1}
<div class="clear"></div>
<h3 class="float-right">{l s='Results for' mod='blockblog'} "{$blockblogsearch|escape:'htmlall':'UTF-8'}"</h3>
<div class="clear"></div>
{/if}

<div class="blog-header-toolbar">
{if $count_all > 0}

<div class="toolbar-top">
			
	<div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if}">
		<ul class="actions">
			<li class="frst">
					<strong>{l s='Posts' mod='blockblog'}  ( {$count_all|escape:'htmlall':'UTF-8'} )</strong>
			</li>
		</ul>
		
		{if $blockblogrsson == 1}
		<ul class="sorter">
			<li>
				<span>
				
			
					<a href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/rss.php" title="{l s='RSS Feed' mod='blockblog'}" target="_blank">
						<img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/img/feed.png" alt="{l s='RSS Feed' mod='blockblog'}" />
					</a>
				</span>
			</li>
			
		</ul>
		{/if}
				
	</div>

</div>



    <ul class="blog-posts">

        {foreach from=$posts item=post name=myLoop}
            <li>
                <div class="top-blog">

                    <h3>
                        <a title="{$post.title|escape:'htmlall':'UTF-8'}"
                           href="{if $blockblogurlrewrite_on == 1}
                            {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}
                          {else}
                            {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}
                          {/if}
                        "
                                >{$post.title|escape:'htmlall':'UTF-8'}</a>

                    </h3>
                    <p class="float-left">

                        <i class="fa fa-folder-open-o"></i>&nbsp;

                        {if isset($post.category_ids[0].title)}
                            {foreach from=$post.category_ids item=category_item name=catItemLoop}
                                <a href="{if $blockblogurlrewrite_on == 1}
                                                {$blockblogcategory_url|escape:'htmlall':'UTF-8'}{$category_item.seo_url|escape:'htmlall':'UTF-8'}
                                             {else}
                                                {$blockblogcategory_url|escape:'htmlall':'UTF-8'}?category_id={$category_item.id|escape:'htmlall':'UTF-8'}
                                             {/if}"
                                   title="{$category_item.title|escape:'htmlall':'UTF-8'}" class="posted_in">{$category_item.title|escape:'htmlall':'UTF-8'}</a>
                                {if count($post.category_ids)>1}
                                    {if $smarty.foreach.catItemLoop.first},&nbsp;{elseif $smarty.foreach.catItemLoop.last}&nbsp;{else},&nbsp;{/if}
                                {else}
                                {/if}

                            {/foreach}

                        {/if}

                    </p>
                    <div class="clear"></div>
                </div>

                <div class="row-custom">
                    {if strlen($post.img)>0}
                        <div class="col-sm-5-custom">
                            <div class="photo-blog">
                                <img class="img-responsive" alt="{$post.title|escape:'htmlall':'UTF-8'}"
                                     src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$post.img|escape:'htmlall':'UTF-8'}">
                            </div>
                        </div>
                    {/if}
                    <div class="col-sm-{if strlen($post.img)>0}7{else}12{/if}-custom">
                        <div class="body-blog">
                            {$post.content|substr:0:$blockblogblog_pl_tr|escape:'htmlall':'UTF-8'}{if strlen($post.content)>$blockblogblog_pl_tr}...{/if}
                            <br>
                            <a title="{$post.title|escape:'htmlall':'UTF-8'}" class="btn readmore"
                               href="{if $blockblogurlrewrite_on == 1}
                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}
                                     {else}
                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}
                                     {/if}">{l s='more' mod='blockblog'}</a>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>

                <div class="top-blog">
                    {if $blockblogp_list_displ_date == 1}
                        <p class="float-left">

                            <time datetime="{$post.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}" pubdate="pubdate"
                                    ><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$post.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</time>


                        </p>
                    {/if}
                    <p class="float-right comment">
                        {if $post.is_liked_post}
                            <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number">{$post.count_like|escape:'htmlall':'UTF-8'}</span>)
                        {else}
                            <span class="post-like-{$post.id|escape:'htmlall':'UTF-8'}">
                            <a onclick="blockblog_like_post({$post.id|escape:'htmlall':'UTF-8'},1)"
                               href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number">{$post.count_like|escape:'htmlall':'UTF-8'}</span>)</a>
                        </span>
                        {/if}
                        &nbsp;
                        <i class="fa fa-comments-o fa-lg"></i>&nbsp; <a href="{if $blockblogurlrewrite_on == 1}
                                                                                {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}#leaveComment
                                                                              {else}
                                                                                {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}#leaveComment
                                                                              {/if}"
                                                                        title="{$post.title|escape:'htmlall':'UTF-8'}"
                                >{$post.count_comments|escape:'htmlall':'UTF-8'} {l s='comments' mod='blockblog'}</a>
                    </p>
                    <div class="clear"></div>
                </div>

            </li>
        {/foreach}

    </ul>



    <div class="toolbar-bottom">

        <div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if} text-align-center">


            {$paging|escape:'quotes':'UTF-8'}
        </div>

    </div>
{else}
    <div class="block-no-items">
        {l s='There are not posts yet' mod='blockblog'}
    </div>
{/if}

</div>

