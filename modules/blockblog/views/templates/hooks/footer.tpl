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

<div class="clear"></div>
<br/>

{if $blockblogcat_footer == 1}

    {if $blockblogis16 == 1}
    <section class="blockblogcat_block_footer footer-block col-xs-12 col-sm-3">
    {else}
	<div id="blockblogcat_block_footer"
         class="block footer-block footer-block-class footer-block-class-first blockmanufacturer"
         style="width:{if $blockblogis_ps15 == 0}190{else}200{/if}px;">
    {/if}

        <h4>
            <a href="{$blockblogcategories_url|escape:'htmlall':'UTF-8'}" title="{l s='Blog Categories' mod='blockblog'}"
                    >{l s='Blog Categories' mod='blockblog'}</a>
        </h4>

		<div class="block_content block-items-data toggle-footer">
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

    {if $blockblogis16 == 1}
        </section>
    {else}
	    </div>
    {/if}
{/if}


{if $blockblogposts_footer == 1}

    {if $blockblogis16 == 1}
        <section class="blockblogposts_block_footer footer-block col-xs-12 col-sm-3">
    {else}
	<div id="blockblogposts_block_footer"
         class="block footer-block footer-block-class blockmanufacturer blockblog-block"
         style="width:{if $blockblogis_ps15 == 0}190{else}200{/if}px;">
    {/if}
        <h4>

            <a href="{$blockblogposts_url|escape:'htmlall':'UTF-8'}" title="{l s='Blog Posts recents' mod='blockblog'}"
                    >{l s='Blog Posts recents' mod='blockblog'}</a>

            {if $blockblogrsson == 1}
                <a  class="margin-left-left-10" href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/rss.php" title="{l s='RSS Feed' mod='blockblog'}" target="_blank">
                    <img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/img/feed.png" alt="{l s='RSS Feed' mod='blockblog'}" />
                </a>
            {/if}

        </h4>
		<div class="block_content block-items-data toggle-footer">
            {if count($blockblogposts) > 0}
                <div class="items-articles-block">

                    {foreach from=$blockblogposts item=items name=myLoop1}
                        {foreach from=$items.data item=blog name=myLoop}
                            <div class="current-item-block">

                                {if $blockblogblock_display_img == 1}
                                    {if strlen($blog.img)>0}
                                        <div class="block-side">
                                            <img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$blog.img|escape:'htmlall':'UTF-8'}"
                                                 title="{$blog.title|escape:'htmlall':'UTF-8'}" alt="{$blog.title|escape:'htmlall':'UTF-8'}"  />
                                        </div>
                                    {/if}
                                {/if}

                                <div class="block-content">
                                    <a class="item-article" title="{$blog.title|escape:'htmlall':'UTF-8'}"
                                       href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}{/if}"
                                            >{$blog.title|escape:'htmlall':'UTF-8'}</a>

                                    <div class="clr"></div>
                                    {if $blockblogblock_display_date == 1}
                                        <span class="float-left block-blog-date"><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$blog.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</span>
                                    {/if}
                                    <span class="float-right comment block-blog-like">
                            {if $blog.is_liked_post}
                                <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number">{$blog.count_like|escape:'htmlall':'UTF-8'}</span>)
                            {else}
                                <span class="post-like-{$blog.id|escape:'htmlall':'UTF-8'}">
                                <a onclick="blockblog_like_post({$blog.id|escape:'htmlall':'UTF-8'},1)"
                                   href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number">{$blog.count_like|escape:'htmlall':'UTF-8'}</span>)</a>
                                </span>
                            {/if}
                                        &nbsp;
                            <a title="{$blog.title|escape:'htmlall':'UTF-8'}"
                               href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}#leaveComment{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}#leaveComment{/if}">
                               <i class="fa fa-comments-o fa-lg"></i>&nbsp;(<span class="the-number">{$blog.count_comments|escape:'htmlall':'UTF-8'}</span>)</a>
                        </span>

                                    <div class="clr"></div>
                                </div>
                            </div>

                        {/foreach}
                    {/foreach}
                    <p class="block-view-all">
                        <a href="{$blockblogposts_url|escape:'htmlall':'UTF-8'}" title="{l s='View all posts' mod='blockblog'}" class="button"
                                ><b>{l s='View all posts' mod='blockblog'}</b></a>
                    </p>

                </div>
            {else}
                <div class="block-no-items">
                    {l s='There are not Posts yet.' mod='blockblog'}
                </div>
            {/if}
		</div>
	{if $blockblogis16 == 1}
        </section>
    {else}
	    </div>
    {/if}
{/if}


{if $blockblogcom_footer == 1}
    {if $blockblogis16 == 1}
        <section class="blockblogcomm_block_footer footer-block col-xs-12 col-sm-3">
    {else}

    <div id="blockblogcomm_block_footer"
         class="last-comments-block block footer-block-class footer-block blockmanufacturer"
        style="width:{if $blockblogis_ps15 == 0}190{else}200{/if}px;">
    {/if}

	<h4>{l s='Blog Last Comments' mod='blockblog'}</h4>
	
       	<div class="block_content block-items-data toggle-footer">
            {if count($blockblogcomments) > 0}
                <div class="items-articles-block">
                    {foreach from=$blockblogcomments item=comment name=myLoop}

                        <div class="current-item-block">
                            <a class="item-comm" title="{$comment.comment|escape:'htmlall':'UTF-8'}"

                               href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$comment.post_seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$comment.post_id|escape:'htmlall':'UTF-8'}{/if}"
                                    >
                                {$comment.comment|strip_tags|substr:0:$blockblogblog_com_tr|escape:'htmlall':'UTF-8'}{if strlen($comment.comment)>$blockblogblog_com_tr}...{/if}
                            </a>
                            <div class="clr"></div>
                            <small class="float-left block-blog-date"><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$comment.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</small>
                            <small class="float-right block-blog-date"><i class="fa fa-user"></i>&nbsp;{$comment.name|escape:'htmlall':'UTF-8'}</small>
                            <div class="clr"></div>
                        </div>
                    {/foreach}
                    <p class="block-view-all">
                        <a title="{l s='View all comments' mod='blockblog'}"  class="button"
                           href="{$blockblogcomments_url|escape:'htmlall':'UTF-8'}"><b>{l s='View all comments' mod='blockblog'}</b></a>
                    </p>
                </div>

            {else}
                <div class="block-no-items">
                    {l s='There are not comments yet.' mod='blockblog'}
                </div>
            {/if}
     		</div>
    {if $blockblogis16 == 1}
        </section>
    {else}
	    </div>
    {/if}
{/if}


{if $blockblogarch_footer == 1}

    {if $blockblogis16 == 1}
        <section class="blockblogarch_block_footer footer-block col-xs-12 col-sm-3">
    {else}
    <div id="blockblogarch_block_footer"  class="block footer-block-class footer-block blockmanufacturer"
         style="width:{if $blockblogis_ps15 == 0}190{else}200{/if}px;">
    {/if}

	<h4>{l s='Blog Archives' mod='blockblog'}</h4>
	
       	<div class="block_content block-items-data toggle-footer">
            {if sizeof($blockblogarch)>0}
                <ul class="bullet">
                    {foreach from=$blockblogarch item=items key=year name=myarch}
                        <li><a class="arch-category" href="javascript:void(0)"
                               onclick="show_arch({$smarty.foreach.myarch.index|escape:'htmlall':'UTF-8'},'left')">{$year|escape:'htmlall':'UTF-8'}</a></li>
                        <div id="arch{$smarty.foreach.myarch.index|escape:'htmlall':'UTF-8'}left"
                             {if $smarty.foreach.myarch.first}{else}class="display-none"{/if}
                                >
                            {foreach from=$items item=item name=myLoop1}
                                <li class="arch-subcat">
                                    <a class="arch-subitem" href="{$blockblogposts_url|escape:'htmlall':'UTF-8'}?y={$year|escape:'htmlall':'UTF-8'}&m={$item.month|escape:'htmlall':'UTF-8'}">
                                        {$item.time_add|date_format:"%B"|escape:'htmlall':'UTF-8'}&nbsp;({$item.total|escape:'htmlall':'UTF-8'})
                                    </a>
                                </li>
                            {/foreach}
                        </div>
                    {/foreach}
                </ul>
            {else}
                {l s='There are not Archives yet.' mod='blockblog'}
            {/if}

     		</div>
	
    {if $blockblogis16 == 1}
        </section>
    {else}
	    </div>
    {/if}
{/if}

{if $blockblogsearch_footer == 1}
    {if $blockblogis16 == 1}
        <section class="blockblogarch_block_footer footer-block col-xs-12 col-sm-3">
    {else}

    <div id="blockblogsearch_block_footer"
         class="block footer-block footer-block-class-last blockmanufacturer search_blog"
        style="width:{if $blockblogis_ps15 == 0}190{else}200{/if}px;">
    {/if}
	<h4>{l s='Search in Blog' mod='blockblog'}</h4>
	<div class="block-items-data toggle-footer">
        <form method="get" action="{$blockblogposts_url|escape:'htmlall':'UTF-8'}">
            <div class="block_content">
                <input type="text" value="" class="search-blog" name="search" {if $blockblogis_ps15 == 0}class="search_text"{/if}>
                <input type="submit" value="go" class="button_mini {if $blockblogis_ps15 == 0}search_go{/if}"/>
                {if $blockblogis_ps15 == 0}<div class="clear"></div>{/if}
            </div>
        </form>
	</div>
    {if $blockblogis16 == 1}
        </section>
    {else}
	    </div>
    {/if}
{/if}



<div class="clear"></div>