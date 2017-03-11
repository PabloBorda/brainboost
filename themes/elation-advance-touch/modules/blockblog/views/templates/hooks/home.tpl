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
<div class="navigation">
{if $blockblogblock_last_home == 1}

<div {if $blockblogis_ps15 !=0}id=""{/if}>
	<div id="blockblogblock_block_left"
         class="block {if $blockblogis16 == 1}blockmanufacturer16{else}blockmanufacturer{/if} blockblog-block {if $blockblogis_ps15 == 0}margin-top-10{/if}">

		<h3 class="title_block {if $blockblogrsson == 0}rss-home-block{/if}">

			<div {if $blockblogrsson == 1}class="float-left"{/if}>
				<a href="{$blockblogposts_url|escape:'htmlall':'UTF-8'}" title="{l s='Blog Posts recents' mod='blockblog'}"
					>{l s='Blog Posts recents' mod='blockblog'}</a>

			</div>
			{if $blockblogrsson == 1}
			<!--<div class="float-left margin-left-left-10">
				<a href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/rss.php" title="{l s='RSS Feed' mod='blockblog'}" target="_blank">
					<img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/img/feed.png" alt="{l s='RSS Feed' mod='blockblog'}" />
				</a>
			</div>-->
			{/if}

			<div class="clear"></div>
		</h3>
		<div class="block_content block-items-data">
		{if count($blockblogposts) > 0}
            {if $blockblogblog_h == 1}
                <div class="items-articles-block">
            {else}
                <ul class="product_list grid row homefeatured tab-pane active eb-grid bubblegrow" style="padding:0 !important;">
            {/if}
	     {foreach from=$blockblogposts item=items name=myLoop1}
	    	{foreach from=$items.data item=blog name=myLoop}

	    	{if $blockblogblog_h == 1}


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
                           href="{if $blockblogurlrewrite_on == 1}
                                    {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}
                                 {else}
                                    {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}
                                 {/if}
                                "
                                >{$blog.title|escape:'htmlall':'UTF-8'}</a>
                                <div>{$blog.content|strip_tags|substr:0:$blockblogblog_p_tr|escape:'htmlall':'UTF-8'}{if strlen($blog.content)>$blockblogblog_p_tr}...{/if}</div>

                        <div class="clr"></div>

                        {if $blockblogblock_display_date == 1}
                            <!--<span class="float-left block-blog-date"><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$blog.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</span>-->
                        {/if}

                        <span class="comment block-blog-like">
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
                               href="{if $blockblogurlrewrite_on == 1}
                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}#leaveComment
                                     {else}
                                        {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}#leaveComment
                                     {/if}"><i
                                        class="fa fa-comments-o fa-lg"></i>&nbsp;(<span class="the-number">{$blog.count_comments|escape:'htmlall':'UTF-8'}</span>)</a>
                        </span>


                        <div class="clr"></div>
                    </div>
                </div>




	    	{elseif $blockblogblog_h == 2}


		   <li class="vertical-b col-sm-4 col-md-3" style="margin-bottom:30px;" class="{if $smarty.foreach.myLoop.first}first_item{elseif $smarty.foreach.myLoop.last}last_item{else}item{/if}">

		    	<table width="100%">

		    				{if strlen($blog.img)>0}
		    				<tr>
		    					<td align="center" class="text-align-center">
		    						{if $blockblogurlrewrite_on == 1}
			    						<a href="{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}"
			    		  				title="{$blog.title|escape:'htmlall':'UTF-8'}">
			    					{else}
			    						<a href="{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}"
			    		  				title="{$blog.title|escape:'htmlall':'UTF-8'}">
			    		  			{/if}
			    						<img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$blog.img|escape:'htmlall':'UTF-8'}"
			    						     title="{$blog.title|escape:'htmlall':'UTF-8'}"
			    						     alt="{$blog.title|escape:'htmlall':'UTF-8'}" />
			    						</a>

		    					</td>
		    					</tr>
		    				{/if}
		    				<tr>
		    					<td class="v-b-title {if strlen($blog.img)==0}v-b-bottom{/if}">

		    							{if $blockblogurlrewrite_on == 1}
	    								<a href="{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}"
		    		  						   title="{$blog.title|escape:'htmlall':'UTF-8'}">
	    								{else}
	    									<a href="{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}"
		    		  						   title="{$blog.title|escape:'htmlall':'UTF-8'}">
		    		  					{/if}
		    		  					<b>
		    		  						{$blog.title|escape:'htmlall':'UTF-8'}
		    		  					</b>
		    		  					</a>

		    					</td>
		    				</tr>
		    				<tr>
		    				<td class="v-footer">
		    				{if $blockblogblock_display_date == 1}
                                <!--<span class="float-left block-blog-date"><i class="fa fa-clock-o fa-lg"></i>&nbsp;{$blog.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}</span>-->
                            {/if}

                                <span class="comment block-blog-like">
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
                                       href="{if $blockblogurlrewrite_on == 1}
                                                {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$blog.seo_url|escape:'htmlall':'UTF-8'}#leaveComment
                                             {else}
                                                {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$blog.id|escape:'htmlall':'UTF-8'}#leaveComment
                                             {/if}"><i
                                                class="fa fa-comments-o fa-lg"></i>&nbsp;(<span class="the-number">{$blog.count_comments|escape:'htmlall':'UTF-8'}</span>)</a>
                                </span>
		    		        </td>
		    				</tr>
		    		</table>
		   </li>


		   {/if}

	    	{/foreach}
	    {/foreach}
        {if $blockblogblog_h == 1}
	        </div>
        {else}
            </ul>

        {/if}
	    <div class="prfb-clear"></div>
	    {else}
		<div class="block-no-items">
			{l s='There are not Posts yet.' mod='blockblog'}
		</div>
		{/if}
		</div>
	</div>
</div>
{/if}
</div>
<div class="clearfix"></div>
