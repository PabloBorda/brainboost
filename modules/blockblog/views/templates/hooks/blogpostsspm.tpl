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

<div id="blockblogposts_block_left_spm" class="block {if $blockblogis16 == 1}blockmanufacturer16{else}blockmanufacturer{/if} blockblog-block" >
		<h4 class="title_block">
			
				<a href="{$blockblogposts_url|escape:'htmlall':'UTF-8'}" title="{l s='Blog Posts recents' mod='blockblog'}"
					>{l s='Blog Posts recents' mod='blockblog'}</a>

			{if $blockblogrsson == 1}
				<a  class="margin-left-left-10" href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/rss.php" title="{l s='RSS Feed' mod='blockblog'}" target="_blank">
					<img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/img/feed.png" alt="{l s='RSS Feed' mod='blockblog'}" />
				</a>
			{/if}
			
		</h4>
		<div class="block_content">

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
	</div>



