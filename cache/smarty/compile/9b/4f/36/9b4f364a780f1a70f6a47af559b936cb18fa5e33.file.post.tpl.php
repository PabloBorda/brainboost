<?php /* Smarty version Smarty-3.1.19, created on 2017-03-07 07:10:53
         compiled from "/home/brainboo/public_html/modules/blockblog/views/templates/front/post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193028082258be5cfd06e593-38752046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9b4f364a780f1a70f6a47af559b936cb18fa5e33' => 
    array (
      0 => '/home/brainboo/public_html/modules/blockblog/views/templates/front/post.tpl',
      1 => 1486138160,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193028082258be5cfd06e593-38752046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'blockblogis16' => 0,
    'posts' => 0,
    'blockblogurlrewrite_on' => 0,
    'blockblogpost_url' => 0,
    'post' => 0,
    'base_dir_ssl' => 0,
    'blockblogsnip_publisher' => 0,
    'blockblogpic' => 0,
    'blockblogsnip_width' => 0,
    'blockblogsnip_height' => 0,
    'blockblogpost_display_date' => 0,
    'is_active' => 0,
    'category_data' => 0,
    'category_item' => 0,
    'blockblogcategory_url' => 0,
    'blockblogis_soc_buttons' => 0,
    'related_products' => 0,
    'product' => 0,
    'blockblogblog_rp_tr' => 0,
    'related_posts' => 0,
    'relpost' => 0,
    'count_all' => 0,
    'comments' => 0,
    'comment' => 0,
    'paging' => 0,
    'blockblog_msg_name' => 0,
    'blockblog_msg_em' => 0,
    'blockblog_msg_comm' => 0,
    'blockblog_msg_cap' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58be5cfd503068_62787302',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58be5cfd503068_62787302')) {function content_58be5cfd503068_62787302($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_modifier_escape')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.escape.php';
?>

<?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==0) {?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./breadcrumb.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?>

<div class="blog-post-item">

    <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
    <div class="post-page" itemscope itemtype="http://schema.org/Article">

        <meta itemscope itemprop="mainEntityOfPage"  itemType="https://schema.org/WebPage" itemid="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>"/>

        <meta itemprop="datePublished" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['time_add_rss'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
        <meta itemprop="dateModified" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['time_add_rss'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
        <meta itemprop="headline" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
        <meta itemprop="alternativeHeadline" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>

        <span itemprop="author" itemscope itemtype="https://schema.org/Person">
             <meta itemprop="name" content="admin"/>
        </span>


        <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
            <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                <meta itemprop="url" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
img/logo.jpg">
                <meta itemprop="width" content="600">
                <meta itemprop="height" content="60">
            </span>
            <meta itemprop="name" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogsnip_publisher']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
        </span>

        <div itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?>
            <meta itemprop="url" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
            <meta itemprop="width" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogsnip_width']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
            <meta itemprop="height" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogsnip_height']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">

        <?php } else { ?>
            <meta itemprop="image" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
img/logo.jpg"/>
            <meta itemprop="width" content="600">
            <meta itemprop="height" content="60">
        <?php }?>
        </div>

        <meta itemprop="description" content="<?php echo mb_convert_encoding(htmlspecialchars(substr(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['content']),0,140), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>

        <?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?>
        <div class="image">
            <img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                 alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="img-responsive" />
        </div>
        <?php }?>


        <div class="top-post">


            <h1><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h1>
            <div class="clear"></div>
            <?php if ($_smarty_tpl->tpl_vars['blockblogpost_display_date']->value==1) {?>
                <p class="float-left">
                    <time datetime="<?php echo mb_convert_encoding(htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['time_add'],"%d/%m/%Y"), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" pubdate="pubdate"
                            ><i class="fa fa-clock-o fa-lg"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['post']->value['time_add'],"%d/%m/%Y"), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</time>
                </p>
            <?php }?>

            <p class="float-right comment">
                <?php if ($_smarty_tpl->tpl_vars['post']->value['is_liked_post']) {?>
                    <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)
                <?php } else { ?>
                    <span class="post-like-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                            <a onclick="blockblog_like_post(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
,1)"
                               href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)</a>
                        </span>
                <?php }?>

                &nbsp;
                <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
                                    <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment
                                <?php } else { ?>
                                    <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment
                                <?php }?>"
                   title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                        ><i class="fa fa-comments-o fa-lg"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_comments'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>

            </p>
            <div class="clear"></div>

            <?php if ($_smarty_tpl->tpl_vars['is_active']->value==1) {?>

                    <p class="float-left">

                        <i class="fa fa-folder-open-o"></i>&nbsp;
                        <?php  $_smarty_tpl->tpl_vars['category_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['category_data']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['category_item']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['category_item']->iteration=0;
 $_smarty_tpl->tpl_vars['category_item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['category_item']->key => $_smarty_tpl->tpl_vars['category_item']->value) {
$_smarty_tpl->tpl_vars['category_item']->_loop = true;
 $_smarty_tpl->tpl_vars['category_item']->iteration++;
 $_smarty_tpl->tpl_vars['category_item']->index++;
 $_smarty_tpl->tpl_vars['category_item']->first = $_smarty_tpl->tpl_vars['category_item']->index === 0;
 $_smarty_tpl->tpl_vars['category_item']->last = $_smarty_tpl->tpl_vars['category_item']->iteration === $_smarty_tpl->tpl_vars['category_item']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['catItemLoop']['first'] = $_smarty_tpl->tpl_vars['category_item']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['catItemLoop']['last'] = $_smarty_tpl->tpl_vars['category_item']->last;
?>
                            <?php if (isset($_smarty_tpl->tpl_vars['category_item']->value['title'])) {?>
                                <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
                                                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogcategory_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                             <?php } else { ?>
                                                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogcategory_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?category_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                             <?php }?>"
                                   title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                                   class="posted_in"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>
                                <?php if (count($_smarty_tpl->tpl_vars['post']->value['category_ids'])>1) {?>
                                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['catItemLoop']['first']) {?>,&nbsp;<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['catItemLoop']['last']) {?>&nbsp;<?php } else { ?>,&nbsp;<?php }?>
                                <?php }?>

                            <?php }?>
                        <?php } ?>

                    </p>
                    <div class="clear"></div>
            <?php }?>

        </div>





        <div class="body-post">
            <?php echo $_smarty_tpl->tpl_vars['post']->value['content'];?>

        </div>


        <div class="top-post">
            <p class="float-right comment">
                <?php if ($_smarty_tpl->tpl_vars['post']->value['is_liked_post']) {?>
                    <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)
                <?php } else { ?>
                    <span class="post-like-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                            <a onclick="blockblog_like_post(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
,1)"
                               href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)</a>
                        </span>
                <?php }?>

                &nbsp;
                <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment<?php }?>"
                   title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                        ><i class="fa fa-comments-o fa-lg"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_comments'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>

            </p>
            <div class="clear"></div>
        </div>


        <?php if ($_smarty_tpl->tpl_vars['blockblogis_soc_buttons']->value==1) {?>
            <div id="sharebox" class="sharebox nomgtop">
                <a class="fb" title="Facebook" rel="nofollow"
                   onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>','', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   href="#"><i class="fa fa-facebook"></i> share</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   class="gplus" title="Google Plus" target="_blank" rel="nofollow" href="https://plus.google.com/share?url=<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>"
                        ><i class="fa fa-google-plus"></i> share</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600'); return false;"
                   class="twitter" title="Twitter" rel="nofollow" target="_blank" href="http://twitter.com/intent/tweet?url=<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>&amp;text=<?php echo mb_convert_encoding(htmlspecialchars(substr(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['content']),0,140), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                        ><i class="fa fa-twitter"></i> tweet</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600'); return false;"
                   class="pinterest" title="Pin" rel="nofollow" target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>&amp;media=<?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
img/logo.jpg<?php }?>&amp;description=<?php echo mb_convert_encoding(htmlspecialchars(substr(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['content']),0,140), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                        ><i class="fa fa-pinterest"></i> pin</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600'); return false;"
                   class="linkedin" title="Linkedin" rel="nofollow" target="_blank"
                   href="http://www.linkedin.com/shareArticle?mini=true&amp;ro=true&amp;trk=EasySocialShareButtons&amp;title=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&amp;url=<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>"
                        ><i class="fa fa-linkedin"></i> linkedin</a>
                <a onclick="window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600'); return false;"
                   class="tumblr" title="Tumblr" rel="nofollow" target="_blank" href="http://www.tumblr.com/share/photo?source=<?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
img/logo.jpg<?php }?>&amp;caption=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
&amp;clickthru="
                        ><i class="fa fa-tumblr"></i> tumblr</a>
                <div class="clear"></div>
            </div>
        <?php }?>


    </div>
    <?php } ?>






<?php if (count($_smarty_tpl->tpl_vars['related_products']->value)>0) {?>
<div class="rel-products-block">
<div class="related-products-title"><i class="fa fa-book fa-lg"></i>&nbsp;<?php echo smartyTranslate(array('s'=>'Related Products','mod'=>'blockblog'),$_smarty_tpl);?>
</div>
<div class="clear"></div>

<ul>
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
	<li class="clearfix">
					<?php if ($_smarty_tpl->tpl_vars['product']->value['picture']) {?>
					<a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="products-block-image">
						<img alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['picture'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="img-responsive" />
					</a>
					<?php }?>
					<div class="clear"></div>
					<div class="product-content">
						<h5>
							<a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
								class="product-name">
								<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['product']->value['title']);?>

							</a>
						</h5>
						<p class="product-description"><?php echo smarty_modifier_escape(substr(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['description']),0,$_smarty_tpl->tpl_vars['blockblogblog_rp_tr']->value), 'UTF-8');?>
<?php if (strlen($_smarty_tpl->tpl_vars['product']->value['description'])>$_smarty_tpl->tpl_vars['blockblogblog_rp_tr']->value) {?>...<?php }?></p>
					</div>
				</li>
		<?php } ?>

</ul>

<div class="clear"></div>
</div>
<?php }?>


<?php if (count($_smarty_tpl->tpl_vars['related_posts']->value)>0) {?>





<div class="rel-posts-block">

<div class="related-posts-title"><i class="fa fa-list-alt fa-lg"></i>&nbsp;<?php echo smartyTranslate(array('s'=>'Related Posts','mod'=>'blockblog'),$_smarty_tpl);?>
</div>

    <div class="other-posts">


        <ul class="row-custom">
            <?php  $_smarty_tpl->tpl_vars['relpost'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['relpost']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['related_posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['relpost']->key => $_smarty_tpl->tpl_vars['relpost']->value) {
$_smarty_tpl->tpl_vars['relpost']->_loop = true;
?>
            <li class="col-sm-4-custom">
                <?php if (strlen($_smarty_tpl->tpl_vars['relpost']->value['img'])>0) {?>
                    <div class="block-top">
                        <a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                           href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>">
                            <img alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="img-responsive"
                                 src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                        </a>
                    </div>
                <?php }?>


                <div class="block-content"><h4 class="block-heading">
                        <a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                           href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>"
                                ><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a></h4></div>
                <div class="block-footer">
                    <p class="float-left">
                        <time pubdate="pubdate" datetime="<?php echo mb_convert_encoding(htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['relpost']->value['time_add'],"%d/%m/%Y"), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                                ><i class="fa fa-clock-o fa-lg"></i>&nbsp;&nbsp;<?php echo mb_convert_encoding(htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['relpost']->value['time_add'],"%d/%m/%Y"), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                        </time>
                    </p>
                    <p class="float-right comment">

                        <?php if ($_smarty_tpl->tpl_vars['relpost']->value['is_liked_post']) {?>
                            <i class="fa fa-thumbs-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)
                        <?php } else { ?>
                            <span class="post-like-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                            <a onclick="blockblog_like_post(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
,1)"
                               href="javascript:void(0)"><i class="fa fa-thumbs-o-up fa-lg"></i>&nbsp;(<span class="the-number"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['count_like'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>)</a>
                        </span>
                        <?php }?>

                        &nbsp;
                        <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment<?php } else { ?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
#leaveComment<?php }?>"
                           title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                                ><i class="fa fa-comments-o fa-lg"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['relpost']->value['count_comments'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>


                    </p>

                    <div class="clear"></div>
                </div>
            </li>
            <?php } ?>

        </ul>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>


</div>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==1) {?><div class="clear"></div><?php }?>
<?php if ($_smarty_tpl->tpl_vars['count_all']->value>0) {?>
<div class="blog-block-comments">

<div class="toolbar-top">

	<div class="<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==1) {?>sortTools sortTools16<?php } else { ?>sortTools<?php }?>">
		<ul class="actions">
			<li class="frst">
					<strong><i class="fa fa-comments-o fa-lg"></i>&nbsp;<?php echo smartyTranslate(array('s'=>'Comments','mod'=>'blockblog'),$_smarty_tpl);?>
  ( <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['count_all']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 )</strong>
			</li>
		</ul>
	</div>

</div>
    <div class="clear"></div>


    <div class="post-comments-items">
<?php  $_smarty_tpl->tpl_vars['comment'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['comment']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comments']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['comment']->key => $_smarty_tpl->tpl_vars['comment']->value) {
$_smarty_tpl->tpl_vars['comment']->_loop = true;
?>
    <div class="row-custom">
        <div class="col-md-2-custom col-sm-2-custom">
            <figure class="thumbnail">
                <img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/img/logo_comments.png" class="img-responsive">
                <figcaption class="text-center image-name"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</figcaption>
            </figure>
        </div>
        <div class="col-md-10-custom col-sm-10-custom">
            <div class="panel panel-default arrow left">
                <div class="panel-body">
                    <header class="text-left">
                        <div class="comment-user"><i class="fa fa-user"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['name'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</div>
                        <time datetime="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['time_add'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="comment-date"><i class="fa fa-clock-o"></i>&nbsp;<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['time_add'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</time>
                    </header>
                    <div class="comment-post"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['comment']->value['comment'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</div>

                </div>
            </div>

        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>


<?php } ?>
</div>
    <div class="clear"></div>

<div class="toolbar-bottom">
	<div class="<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==1) {?>sortTools sortTools16<?php } else { ?>sortTools<?php }?> text-align-center">
						<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['paging']->value);?>

	</div>
</div>
    <div class="clear"></div>


</div>

<?php }?>


<?php if ($_smarty_tpl->tpl_vars['post']->value['is_comments']==0) {?>
 <div class="block-no-items">
	<?php echo smartyTranslate(array('s'=>'Comments are Closed for this post','mod'=>'blockblog'),$_smarty_tpl);?>

</div>
<?php } else { ?>
<div id="succes-comment">
<?php echo smartyTranslate(array('s'=>'Your comment  has been sent successfully. Thanks for comment!','mod'=>'blockblog'),$_smarty_tpl);?>

</div>



<div class="leaveComment-title"><i class="fa fa-comment-o fa-lg"></i> <?php echo smartyTranslate(array('s'=>'Leave a Comment','mod'=>'blockblog'),$_smarty_tpl);?>
</div>


<div id="leaveComment">


    <div class="alert alert-danger display-none" id="alert-comment"></div>
    <div class="alert alert-success display-none" id="alertsuccess-comment"></div>
    <form action="#" method="post" class="form-horizontal add-comment-form" id="commentform">

    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="name-blockblog"><?php echo smartyTranslate(array('s'=>'Name','mod'=>'blockblog'),$_smarty_tpl);?>
:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <input type="text" class="form-control" id="name-blockblog" placeholder="<?php echo smartyTranslate(array('s'=>'Name','mod'=>'blockblog'),$_smarty_tpl);?>
" onkeyup="check_inpName_blockblog();" onblur="check_inpName_blockblog();" />
            <div id="error_name-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="email-blockblog"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'blockblog'),$_smarty_tpl);?>
:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <input type="email" class="form-control" id="email-blockblog" placeholder="<?php echo smartyTranslate(array('s'=>'Email','mod'=>'blockblog'),$_smarty_tpl);?>
" onkeyup="check_inpEmail_blockblog();" onblur="check_inpEmail_blockblog();"/>
            <div id="error_email-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="comment-blockblog"><?php echo smartyTranslate(array('s'=>'Comment','mod'=>'blockblog'),$_smarty_tpl);?>
:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <textarea rows="3" class="form-control" id="comment-blockblog" placeholder="<?php echo smartyTranslate(array('s'=>'Comment','mod'=>'blockblog'),$_smarty_tpl);?>
" onkeyup="check_inpText_blockblog();" onblur="check_inpText_blockblog();"></textarea>
            <div id="error_comment-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>
    <div class="form-group">
        <label class="control-label col-xs-3-custom" for="captcha-blockblog"><?php echo smartyTranslate(array('s'=>'Captcha','mod'=>'blockblog'),$_smarty_tpl);?>
:<span class="req">*</span></label>
        <div class="col-xs-9-custom">
            <img width="100" height="26" alt="<?php echo smartyTranslate(array('s'=>'Captcha','mod'=>'blockblog'),$_smarty_tpl);?>
" class="float-left secureCodReview"
                 src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/captcha.php"/>

            <input type="text" class="form-control inpCaptcha" id="captcha-blockblog" onkeyup="check_inpCaptcha_blockblog();" onblur="check_inpCaptcha_blockblog();" />
            <div class="clear"></div>
            <div id="error_captcha-blockblog" class="errorTxtAdd"></div>
        </div>
        <div class="clear"></div>

    </div>

    <div class="form-group">
        <div class="col-xs-offset-3-custom col-xs-9-custom">
            <input type="button" onclick="add_comment(<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
)" class="btn-custom btn-primary-custom" value="<?php echo smartyTranslate(array('s'=>'Comment','mod'=>'blockblog'),$_smarty_tpl);?>
"/>
        </div>
        <div class="clear"></div>

    </div>

        <div class="clear"></div>
    </form>




</div>


<?php }?>

</div>





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
                field_state_change('name-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
			} else if(error_type == 2){
                field_state_change('email-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_em']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
			} else if(error_type == 3){
                field_state_change('comment-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_comm']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
			} else if(error_type == 4){
                field_state_change('captcha-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_cap']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
			} else {
				alert(data.message);
			}
			var count = Math.random();
			document.getElementById('secureCodReview').src = "";
			document.getElementById('secureCodReview').src = "<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/captcha.php?re=" + count;



		}
	}, 'json');
    }
}



    function check_inpName_blockblog()
    {

        var name_blockblog = trim(document.getElementById('name-blockblog').value);

        if (name_blockblog.length == 0)
        {
            field_state_change('name-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_name']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
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
            field_state_change('comment-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_comm']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
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
            field_state_change('email-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_em']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
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
            field_state_change('captcha-blockblog','failed', '<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblog_msg_cap']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
');
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
<?php }} ?>
