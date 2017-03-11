<?php /* Smarty version Smarty-3.1.19, created on 2017-02-02 11:55:18
         compiled from "/var/www/html/modules/blockblog/views/templates/front/category.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117026632458931e260721f1-89406739%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4899b0bcc33f9aa376ac72839686238a212265c0' => 
    array (
      0 => '/var/www/html/modules/blockblog/views/templates/front/category.tpl',
      1 => 1475588147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117026632458931e260721f1-89406739',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'meta_title' => 0,
    'blockblogis16' => 0,
    'count_all' => 0,
    'blockblogrsson' => 0,
    'base_dir_ssl' => 0,
    'posts' => 0,
    'post' => 0,
    'blockblogurlrewrite_on' => 0,
    'blockblogpost_url' => 0,
    'blockblogcategory_url' => 0,
    'category_item' => 0,
    'blockblogpic' => 0,
    'blockblogblog_pl_tr' => 0,
    'blockblogp_list_displ_date' => 0,
    'paging' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58931e2618b335_17243417',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58931e2618b335_17243417')) {function content_58931e2618b335_17243417($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/html/tools/smarty/plugins/modifier.date_format.php';
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

<h2><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h2>
<?php } else { ?>
<h1 class="page-heading"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['meta_title']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</h1>
<?php }?>


<div class="blog-header-toolbar">
<?php if ($_smarty_tpl->tpl_vars['count_all']->value>0) {?>

<div class="toolbar-top">
			
	<div class="<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==1) {?>sortTools sortTools16<?php } else { ?>sortTools<?php }?>">
		<ul class="actions">
			<li class="frst">
					<strong><?php echo smartyTranslate(array('s'=>'Posts','mod'=>'blockblog'),$_smarty_tpl);?>
  ( <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['count_all']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 )</strong>
			</li>
		</ul>
		
		<?php if ($_smarty_tpl->tpl_vars['blockblogrsson']->value==1) {?>
		<ul class="sorter">
			<li>
				<span>
				
			
					<a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/rss.php" title="<?php echo smartyTranslate(array('s'=>'RSS Feed','mod'=>'blockblog'),$_smarty_tpl);?>
" target="_blank">
						<img src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/img/feed.png" alt="<?php echo smartyTranslate(array('s'=>'RSS Feed','mod'=>'blockblog'),$_smarty_tpl);?>
" />
					</a>
				</span>
			</li>
			
		</ul>
		<?php }?>
				
	</div>

</div>


    <ul class="blog-posts">

        <?php  $_smarty_tpl->tpl_vars['post'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['post']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['posts']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['post']->key => $_smarty_tpl->tpl_vars['post']->value) {
$_smarty_tpl->tpl_vars['post']->_loop = true;
?>
            <li>
                <div class="top-blog">

                    <h3>
                        <a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                           href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
                            <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                          <?php } else { ?>
                            <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                          <?php }?>
                        "
                                ><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>

                    </h3>
                    <p class="float-left">

                        <i class="fa fa-folder-open-o"></i>&nbsp;

                        <?php if (isset($_smarty_tpl->tpl_vars['post']->value['category_ids'][0]['title'])) {?>
                            <?php  $_smarty_tpl->tpl_vars['category_item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['category_item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['post']->value['category_ids']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
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
                                    <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
                                                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogcategory_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                             <?php } else { ?>
                                                <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogcategory_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?category_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                             <?php }?>"
                                        title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="posted_in"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['category_item']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</a>
                                <?php if (count($_smarty_tpl->tpl_vars['post']->value['category_ids'])>1) {?>
                                    <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['catItemLoop']['first']) {?>,&nbsp;<?php } elseif ($_smarty_tpl->getVariable('smarty')->value['foreach']['catItemLoop']['last']) {?>&nbsp;<?php } else { ?>,&nbsp;<?php }?>
                                <?php } else { ?>
                                <?php }?>

                           <?php } ?>

                        <?php }?>

                    </p>
                    <div class="clear"></div>
                </div>

                <div class="row-custom">
                    <?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?>
                    <div class="col-sm-5-custom">
                        <div class="photo-blog">
                            <img class="img-responsive" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
                                 src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpic']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['img'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">
                        </div>
                    </div>
                    <?php }?>
                    <div class="col-sm-<?php if (strlen($_smarty_tpl->tpl_vars['post']->value['img'])>0) {?>7<?php } else { ?>12<?php }?>-custom">
                        <div class="body-blog">
                            <?php echo mb_convert_encoding(htmlspecialchars(substr(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['post']->value['content']),0,$_smarty_tpl->tpl_vars['blockblogblog_pl_tr']->value), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php if (strlen($_smarty_tpl->tpl_vars['post']->value['content'])>$_smarty_tpl->tpl_vars['blockblogblog_pl_tr']->value) {?>...<?php }?>
                            <br>
                            <a title="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['title'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="btn readmore"
                               href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
                                        <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['seo_url'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                     <?php } else { ?>
                                        <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogpost_url']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?post_id=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['id'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

                                     <?php }?>"><?php echo smartyTranslate(array('s'=>'more','mod'=>'blockblog'),$_smarty_tpl);?>
</a>
                        </div>
                    </div>
                </div>

                <div class="clear"></div>

                <div class="top-blog">
                    <?php if ($_smarty_tpl->tpl_vars['blockblogp_list_displ_date']->value==1) {?>
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
                        <i class="fa fa-comments-o fa-lg"></i>&nbsp; <a href="<?php if ($_smarty_tpl->tpl_vars['blockblogurlrewrite_on']->value==1) {?>
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
                            ><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['count_comments'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
 <?php echo smartyTranslate(array('s'=>'comments','mod'=>'blockblog'),$_smarty_tpl);?>
</a>
                </p>
                <div class="clear"></div>
                </div>

            </li>
        <?php } ?>

    </ul>





<div class="toolbar-bottom">
			
	<div class="<?php if ($_smarty_tpl->tpl_vars['blockblogis16']->value==1) {?>sortTools sortTools16<?php } else { ?>sortTools<?php }?> text-align-center">
		

					<?php echo preg_replace("%(?<!\\\\)'%", "\'",$_smarty_tpl->tpl_vars['paging']->value);?>

			</div>

		</div>
<?php } else { ?>
	<div class="block-no-items">
	<?php echo smartyTranslate(array('s'=>'There are not posts yet','mod'=>'blockblog'),$_smarty_tpl);?>

	</div>
<?php }?>

</div>

<?php }} ?>
