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
{/if}

<div class="blog-post-item">

    {foreach from=$posts item=post name=myLoop}
    <div class="post-page" itemscope itemtype="http://schema.org/Article">

        <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}"/>

        <meta itemprop="datePublished" content="{$post.time_add_rss|escape:'htmlall':'UTF-8'}"/>
        <meta itemprop="dateModified" content="{$post.time_add_rss|escape:'htmlall':'UTF-8'}"/>
        <meta itemprop="headline" content="{$post.title|escape:'htmlall':'UTF-8'}"/>
        <meta itemprop="alternativeHeadline" content="{$post.title|escape:'htmlall':'UTF-8'}"/>

        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
             <meta itemprop="name" content="admin"/>
        </span>


        <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="{$base_dir_ssl|escape:'htmlall':'UTF-8'}img/logo.jpg">
                <meta itemprop="width" content="600">
                <meta itemprop="height" content="60">
            </span>
            <meta itemprop="name" content="{$blockblogsnip_publisher|escape:'htmlall':'UTF-8'}">
        </span>

        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        {if strlen($post.img)>0}
            <meta itemprop="url" content="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$post.img|escape:'htmlall':'UTF-8'}">
            <meta itemprop="width" content="{$blockblogsnip_width|escape:'htmlall':'UTF-8'}">
            <meta itemprop="height" content="{$blockblogsnip_height|escape:'htmlall':'UTF-8'}">

        {else}
            <meta itemprop="image" content="{$base_dir_ssl|escape:'htmlall':'UTF-8'}img/logo.jpg"/>
            <meta itemprop="width" content="600">
            <meta itemprop="height" content="60">
        {/if}
        </div>

        <meta itemprop="description" content="{$post.content|strip_tags|substr:0:140|escape:'htmlall':'UTF-8'}"/>

        {if strlen($post.img)>0}
        <div class="image">
            <img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$post.img|escape:'htmlall':'UTF-8'}"
                 alt="{$post.title|escape:'htmlall':'UTF-8'}" class="img-responsive" />
        </div>
        {/if}


        <div class="top-post">


            <h1>{$post.title|escape:'htmlall':'UTF-8'}</h1>
            <div class="clear"></div>
            {if $blockblogpost_display_date == 1}
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
                <a href="{if $blockblogurlrewrite_on == 1}
                                    {$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}#leaveComment
                                {else}
                                    {$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}#leaveComment
                                {/if}"
                   title="{$post.title|escape:'htmlall':'UTF-8'}"
                        ><i class="fa fa-comments-o fa-lg"></i>&nbsp;{$post.count_comments|escape:'htmlall':'UTF-8'}</a>

            </p>
            <div class="clear"></div>

            {if $is_active == 1}

                    <p class="float-left">

                        <i class="fa fa-folder-open-o"></i>&nbsp;
                        {foreach from=$category_data item=category_item name=catItemLoop}
                            {if isset($category_item.title)}
                                <a href="{if $blockblogurlrewrite_on == 1}
                                                {$blockblogcategory_url|escape:'htmlall':'UTF-8'}{$category_item.seo_url|escape:'htmlall':'UTF-8'}
                                             {else}
                                                {$blockblogcategory_url|escape:'htmlall':'UTF-8'}?category_id={$category_item.id|escape:'htmlall':'UTF-8'}
                                             {/if}"
                                   title="{$category_item.title|escape:'htmlall':'UTF-8'}"
                                   class="posted_in">{$category_item.title|escape:'htmlall':'UTF-8'}</a>
                                {if count($post.category_ids)>1}
                                    {if $smarty.foreach.catItemLoop.first},&nbsp;{elseif $smarty.foreach.catItemLoop.last}&nbsp;{else},&nbsp;{/if}
                                {/if}

                            {/if}
                        {/foreach}

                    </p>
                    <div class="clear"></div>
            {/if}

        </div>





        <div class="body-post">
            {$post.content}
        </div>


        <div class="top-post">
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
                <a href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}#leaveComment{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}#leaveComment{/if}"
                   title="{$post.title|escape:'htmlall':'UTF-8'}"
                        ><i class="fa fa-comments-o fa-lg"></i>&nbsp;{$post.count_comments|escape:'htmlall':'UTF-8'}</a>

            </p>
            <div class="clear"></div>
        </div>


        {if $blockblogis_soc_buttons == 1}
            <div id="sharebox" class="sharebox nomgtop">
                <a class="fb" title="Facebook" rel="nofollow"
                   onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   href="#"><i class="fa fa-facebook"></i> share</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   class="gplus" title="Google Plus" target="_blank" rel="nofollow" href="https://plus.google.com/share?url={if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}"
                        ><i class="fa fa-google-plus"></i> share</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   class="twitter" title="Twitter" rel="nofollow" target="_blank" href="http://twitter.com/intent/tweet?url={if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}&amp;text={$post.content|strip_tags|substr:0:140|escape:'htmlall':'UTF-8'}"
                        ><i class="fa fa-twitter"></i> tweet</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600'); return false;"
                   class="pinterest" title="Pin" rel="nofollow" target="_blank" href="http://pinterest.com/pin/create/button/?url={if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}&amp;media={if strlen($post.img)>0}{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$post.img|escape:'htmlall':'UTF-8'}{else}{$base_dir_ssl|escape:'htmlall':'UTF-8'}img/logo.jpg{/if}&amp;description={$post.content|strip_tags|substr:0:140|escape:'htmlall':'UTF-8'}"
                        ><i class="fa fa-pinterest"></i> pin</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600'); return false;"
                   class="linkedin" title="Linkedin" rel="nofollow" target="_blank"
                   href="http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=EasySocialShareButtons&amp;title={$post.title|escape:'htmlall':'UTF-8'}&amp;url={if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$post.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$post.id|escape:'htmlall':'UTF-8'}{/if}"
                        ><i class="fa fa-linkedin"></i> linkedin</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600'); return false;"
                   class="tumblr" title="Tumblr" rel="nofollow" target="_blank" href="http://www.tumblr.com/share/photo?source={if strlen($post.img)>0}{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$post.img|escape:'htmlall':'UTF-8'}{else}{$base_dir_ssl|escape:'htmlall':'UTF-8'}img/logo.jpg{/if}&amp;caption={$post.title|escape:'htmlall':'UTF-8'}&amp;clickthru="
                        ><i class="fa fa-tumblr"></i> tumblr</a>
                <div class="clear"></div>
            </div>
        {/if}


    </div>
    {/foreach}






{if count($related_products)>0}
<div class="rel-products-block">
<div class="related-products-title"><i class="fa fa-book fa-lg"></i>&nbsp;{l s='Related Products' mod='blockblog'}</div>
<div class="clear"></div>

<ul>
	{foreach from=$related_products item=product name=myLoop}
	<li class="clearfix">
					{if $product.picture}
					<a title="{$product.title|escape:'htmlall':'UTF-8'}" href="{$product.product_url|escape:'htmlall':'UTF-8'}" class="products-block-image">
						<img alt="{$product.title|escape:'htmlall':'UTF-8'}" src="{$product.picture|escape:'htmlall':'UTF-8'}" class="img-responsive" />
					</a>
					{/if}
					<div class="clear"></div>
					<div class="product-content">
						<h5>
							<a title="{$product.title|escape:'htmlall':'UTF-8'}" href="{$product.product_url|escape:'htmlall':'UTF-8'}"
								class="product-name">
								{$product.title|escape:'quotes':'UTF-8'}
							</a>
						</h5>
						<p class="product-description">{$product.description|strip_tags|substr:0:$blockblogblog_rp_tr|escape:'UTF-8'}{if strlen($product.description)>$blockblogblog_rp_tr}...{/if}</p>
					</div>
				</li>
		{/foreach}

</ul>

<div class="clear"></div>
</div>
{/if}


{if count($related_posts)>0}





<div class="rel-posts-block">

<div class="related-posts-title"><i class="fa fa-list-alt fa-lg"></i>&nbsp;{l s='Related Posts' mod='blockblog'}</div>

    <div class="other-posts">


        <ul class="row-custom">
            {foreach from=$related_posts item=relpost name=myLoop}
            <li class="col-sm-4-custom">
                {if strlen($relpost.img)>0}
                    <div class="block-top">
                        <a title="{$relpost.title|escape:'htmlall':'UTF-8'}"
                           href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$relpost.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$relpost.id|escape:'htmlall':'UTF-8'}{/if}">
                            <img alt="{$relpost.title|escape:'htmlall':'UTF-8'}" class="img-responsive"
                                 src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{$blockblogpic|escape:'htmlall':'UTF-8'}{$relpost.img|escape:'htmlall':'UTF-8'}">
                        </a>
                    </div>
                {/if}


                <div class="block-content"><h4 class="block-heading">
                        <a title="{$relpost.title|escape:'htmlall':'UTF-8'}"
                           href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$relpost.seo_url|escape:'htmlall':'UTF-8'}{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$relpost.id|escape:'htmlall':'UTF-8'}{/if}"
                                >{$relpost.title|escape:'htmlall':'UTF-8'}</a></h4></div>
                <div class="block-footer">
                    <p class="float-left">
                        <time pubdate="pubdate" datetime="{$relpost.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}"
                                ><i class="fa fa-clock-o fa-lg"></i>&nbsp;&nbsp;{$relpost.time_add|date_format:"%d/%m/%Y"|escape:'htmlall':'UTF-8'}
                        </time>
                    </p>
                    <p class="float-right comment">

                        {if $relpost.is_liked_post}
                            <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number">{$relpost.count_like|escape:'htmlall':'UTF-8'}</span>)
                        {else}
                            <span class="post-like-{$relpost.id|escape:'htmlall':'UTF-8'}">
                            <a onclick="blockblog_like_post({$relpost.id|escape:'htmlall':'UTF-8'},1)"
                               href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number">{$relpost.count_like|escape:'htmlall':'UTF-8'}</span>)</a>
                        </span>
                        {/if}

                        &nbsp;
                        <a href="{if $blockblogurlrewrite_on == 1}{$blockblogpost_url|escape:'htmlall':'UTF-8'}{$relpost.seo_url|escape:'htmlall':'UTF-8'}#leaveComment{else}{$blockblogpost_url|escape:'htmlall':'UTF-8'}?post_id={$relpost.id|escape:'htmlall':'UTF-8'}#leaveComment{/if}"
                           title="{$relpost.title|escape:'htmlall':'UTF-8'}"
                                ><i class="fa fa-comments-o fa-lg"></i>&nbsp;{$relpost.count_comments|escape:'htmlall':'UTF-8'}</a>


                    </p>

                    <div class="clear"></div>
                </div>
            </li>
            {/foreach}

        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>


</div>
{/if}


{if $blockblogis16==1}<div class="clear"></div>{/if}
{if $count_all>0}
<div class="blog-block-comments">

<div class="toolbar-top">

	<div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if}">
		<ul class="actions">
			<li class="frst">
					<strong><i class="fa fa-comments-o fa-lg"></i>&nbsp;{l s='Comments' mod='blockblog'}  ( {$count_all|escape:'htmlall':'UTF-8'} )</strong>
			</li>
		</ul>
	</div>

</div>
    <div class="clear"></div>


    <div class="post-comments-items">
{foreach from=$comments item=comment name=myLoop}
    <div class="row-custom">
        <div class="col-md-2-custom col-sm-2-custom">
            <figure class="thumbnail">
                <img src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/img/logo_comments.png" class="img-responsive">
                <figcaption class="text-center image-name">{$comment.name|escape:'htmlall':'UTF-8'}</figcaption>
            </figure>
        </div>
        <div class="col-md-10-custom col-sm-10-custom">
            <div class="panel panel-default arrow left">
                <div class="panel-body">
                    <header class="text-left">
                        <div class="comment-user"><i class="fa fa-user"></i>&nbsp;{$comment.name|escape:'htmlall':'UTF-8'}</div>
                        <time datetime="{$comment.time_add|escape:'htmlall':'UTF-8'}" class="comment-date"><i class="fa fa-clock-o"></i>&nbsp;{$comment.time_add|escape:'htmlall':'UTF-8'}</time>
                    </header>
                    <div class="comment-post">{$comment.comment|escape:'htmlall':'UTF-8'}</div>

                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>


{/foreach}
</div>
    <div class="clear"></div>

<div class="toolbar-bottom">
	<div class="{if $blockblogis16==1}sortTools sortTools16{else}sortTools{/if} text-align-center">
						{$paging|escape:'quotes':'UTF-8'}
	</div>
</div>
    <div class="clear"></div>


</div>

{/if}


{if $post.is_comments == 0}
 <div class="block-no-items">
	{l s='Comments are Closed for this post' mod='blockblog'}
</div>
{else}
<div id="succes-comment">
{l s='Your comment  has been sent successfully. Thanks for comment!' mod='blockblog'}
</div>



<div class="leaveComment-title"><i class="fa fa-comment-o fa-lg"></i> {l s='Leave a Comment' mod='blockblog'}</div>


<div id="leaveComment">


    <div class="alert alert-danger display-none" id="alert-comment"></div>
    <div class="alert alert-success display-none" id="alertsuccess-comment"></div>
    <form action="#" method="post" class="form-horizontal add-comment-form" id="commentform">

    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="name-blockblog">{l s='Name' mod='blockblog'}:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <input type="text" class="form-control" id="name-blockblog" placeholder="{l s='Name' mod='blockblog'}" onkeyup="check_inpName_blockblog();" onblur="check_inpName_blockblog();" />
            <div id="error_name-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="email-blockblog">{l s='Email' mod='blockblog'}:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <input type="email" class="form-control" id="email-blockblog" placeholder="{l s='Email' mod='blockblog'}" onkeyup="check_inpEmail_blockblog();" onblur="check_inpEmail_blockblog();"/>
            <div id="error_email-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="comment-blockblog">{l s='Comment' mod='blockblog'}:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <textarea rows="3" class="form-control" id="comment-blockblog" placeholder="{l s='Comment' mod='blockblog'}" onkeyup="check_inpText_blockblog();" onblur="check_inpText_blockblog();"></textarea>
            <div id="error_comment-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="captcha-blockblog">{l s='Captcha' mod='blockblog'}:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <img width="100" height="26" alt="{l s='Captcha' mod='blockblog'}" class="float-left secureCodReview"
                 src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/captcha.php"/>

            <input type="text" class="form-control inpCaptcha" id="captcha-blockblog" onkeyup="check_inpCaptcha_blockblog();" onblur="check_inpCaptcha_blockblog();" />
            <div class="clear"></div>
            <div id="error_captcha-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>

    <div class="form-group">
        <div class="col-xs-offset-3-custom col-xs-9-custom">
            <input type="button" onclick="add_comment({$post.id|escape:'htmlall':'UTF-8'})" class="btn-custom btn-primary-custom" value="{l s='Comment' mod='blockblog'}"/>
        </div>
        <div class="clear"></div>

    </div>

        <div class="clear"></div>
    </form>




</div>


{/if}

</div>




{literal}
<script type="text/javascript">

    $(document).ready(function(){
        $('#name-blockblog').val('');
        $('#email-blockblog').val('');
        $('#comment-blockblog').val('');
        $('#captcha-blockblog').val('');
    });


function trim(str) {
	   str = str.replace(/(^ *)|( *$)/,"");
	   return str;
	   }

function add_comment(id_post){

    var is_name = check_inpName_blockblog();
    var is_comment = check_inpText_blockblog();
    var is_email = check_inpEmail_blockblog();
    var is_captcha = check_inpCaptcha_blockblog();

    if(is_name && is_comment && is_email && is_captcha){

	var _name_review = $('#name-blockblog').val();
	var _email_review = $('#email-blockblog').val();
	var _text_review = $('#comment-blockblog').val();
	var _captcha = $('#captcha-blockblog').val();



	$('#leaveComment').css('opacity','0.5');
	$.post(baseDir+'modules/blockblog/ajax.php',
			{action:'addcomment',
			 name:_name_review,
			 email:_email_review,
			 id_post:id_post,
			 captcha:_captcha,
			 text_review:_text_review
			 },
	function (data) {
		if (data.status == 'success') {

                $('#name-blockblog').val('');
                $('#email-blockblog').val('');
                $('#comment-blockblog').val('');
                $('#captcha-blockblog').val('');

				$('#leaveComment').hide();
                $('.leaveComment-title').hide();
				$('#succes-comment').show();



			$('#leaveComment').css('opacity','1');


		} else {

            $('#leaveComment').css('opacity','1');

			var error_type = data.params.error_type;

			if(error_type == 1){
                field_state_change('name-blockblog','failed', '{/literal}{$blockblog_msg_name|escape:'htmlall':'UTF-8'}{literal}');
			} else if(error_type == 2){
                field_state_change('email-blockblog','failed', '{/literal}{$blockblog_msg_em|escape:'htmlall':'UTF-8'}{literal}');
			} else if(error_type == 3){
                field_state_change('comment-blockblog','failed', '{/literal}{$blockblog_msg_comm|escape:'htmlall':'UTF-8'}{literal}');
			} else if(error_type == 4){
                field_state_change('captcha-blockblog','failed', '{/literal}{$blockblog_msg_cap|escape:'htmlall':'UTF-8'}{literal}');
			} else {
				alert(data.message);
			}
			var count = Math.random();
			document.getElementById('secureCodReview').src = "";
			document.getElementById('secureCodReview').src = "{/literal}{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/{literal}captcha.php?re=" + count;



		}
	}, 'json');
    }
}



    function check_inpName_blockblog()
    {

        var name_blockblog = trim(document.getElementById('name-blockblog').value);

        if (name_blockblog.length == 0)
        {
            field_state_change('name-blockblog','failed', '{/literal}{$blockblog_msg_name|escape:'htmlall':'UTF-8'}{literal}');
            return false;
        }
        field_state_change('name-blockblog','success', '');
        return true;
    }

    function check_inpText_blockblog()
    {

        var comment_blockblog = trim(document.getElementById('comment-blockblog').value);

        if (comment_blockblog.length == 0)
        {
            field_state_change('comment-blockblog','failed', '{/literal}{$blockblog_msg_comm|escape:'htmlall':'UTF-8'}{literal}');
            return false;
        }
        field_state_change('comment-blockblog','success', '');
        return true;
    }

    function check_inpEmail_blockblog()
    {

        var email_blockblog = trim(document.getElementById('email-blockblog').value);

        if (email_blockblog.length == 0)
        {
            field_state_change('email-blockblog','failed', '{/literal}{$blockblog_msg_em|escape:'htmlall':'UTF-8'}{literal}');
            return false;
        }
        field_state_change('email-blockblog','success', '');
        return true;
    }

    function check_inpCaptcha_blockblog()
    {

        var captcha_blockblog = trim(document.getElementById('captcha-blockblog').value);

        if (captcha_blockblog.length != 6)
        {
            field_state_change('captcha-blockblog','failed', '{/literal}{$blockblog_msg_cap|escape:'htmlall':'UTF-8'}{literal}');
            return false;
        }
        field_state_change('captcha-blockblog','success', '');
        return true;
    }



    function field_state_change(field, state, err_text)
    {

        var field_label = $('label[for="'+field+'"]');
        var field_div_error = $('#'+field);

        if (state == 'success')
        {
            field_label.removeClass('error-label');
            field_div_error.removeClass('error-current-input');
        }
        else
        {
            field_label.addClass('error-label');
            field_div_error.addClass('error-current-input');
        }
        document.getElementById('error_'+field).innerHTML = err_text;

    }

</script>
{/literal}