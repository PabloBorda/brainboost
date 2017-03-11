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

<div id="blockblogcomm_block_left_spm" class="last-comments-block block {if $blockblogis16 == 1}blockmanufacturer16{else}blockmanufacturer{/if}" >
	<h4 class="title_block">{l s='Blog Last Comments' mod='blockblog'}</h4>
	
       	<div class="block_content">
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
</div>


