<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:57
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/modules/blockcms/blockcms.tpl" */ ?>
<?php /*%%SmartyHeaderCode:13920261305925602d873fb0-87801619%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f71f847960a7f24e90db7f50324b2142396e272' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/modules/blockcms/blockcms.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '13920261305925602d873fb0-87801619',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'block' => 0,
    'cms_titles' => 0,
    'cms_key' => 0,
    'cms_title' => 0,
    'cms_page' => 0,
    'link' => 0,
    'PS_CATALOG_MODE' => 0,
    'display_stores_footer' => 0,
    'contact_url' => 0,
    'cmslinks' => 0,
    'cmslink' => 0,
    'footer_text' => 0,
    'display_poweredby' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602da6d583_73707731',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602da6d583_73707731')) {function content_5925602da6d583_73707731($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['block']->value==1) {?>
	<!-- Block CMS module -->
	<?php  $_smarty_tpl->tpl_vars['cms_title'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cms_title']->_loop = false;
 $_smarty_tpl->tpl_vars['cms_key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cms_titles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cms_title']->key => $_smarty_tpl->tpl_vars['cms_title']->value) {
$_smarty_tpl->tpl_vars['cms_title']->_loop = true;
 $_smarty_tpl->tpl_vars['cms_key']->value = $_smarty_tpl->tpl_vars['cms_title']->key;
?>
		<section id="informations_block_left_<?php echo $_smarty_tpl->tpl_vars['cms_key']->value;?>
" class="block informations_block_left">
			<p class="title_block">
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_title']->value['category_link'], ENT_QUOTES, 'UTF-8', true);?>
">
					<?php if (!empty($_smarty_tpl->tpl_vars['cms_title']->value['name'])) {?><?php echo $_smarty_tpl->tpl_vars['cms_title']->value['name'];?>
<?php } else { ?><?php echo $_smarty_tpl->tpl_vars['cms_title']->value['category_name'];?>
<?php }?>
				</a>
			</p>
			<div class="block_content list-block">
				<ul>
					<?php  $_smarty_tpl->tpl_vars['cms_page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cms_page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cms_title']->value['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->key => $_smarty_tpl->tpl_vars['cms_page']->value) {
$_smarty_tpl->tpl_vars['cms_page']->_loop = true;
?>
						<?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])) {?>
							<li class="bullet">
								<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>
">
									<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['name'], ENT_QUOTES, 'UTF-8', true);?>

								</a>
							</li>
						<?php }?>
					<?php } ?>
					<?php  $_smarty_tpl->tpl_vars['cms_page'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cms_page']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cms_title']->value['cms']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cms_page']->key => $_smarty_tpl->tpl_vars['cms_page']->value) {
$_smarty_tpl->tpl_vars['cms_page']->_loop = true;
?>
						<?php if (isset($_smarty_tpl->tpl_vars['cms_page']->value['link'])) {?>
							<li>
								<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['link'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
">
									<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cms_page']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>

								</a>
							</li>
						<?php }?>
					<?php } ?>
					<?php if ($_smarty_tpl->tpl_vars['cms_title']->value['display_store']) {?>
						<li>
							<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('stores'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
">
								<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>

							</a>
						</li>
					<?php }?>
				</ul>
			</div>
		</section>
	<?php } ?>
	<!-- /Block CMS module -->
<?php } else { ?>
	<!-- MODULE Block footer -->
	<section class="footer-block col-xs-12 col-sm-2" id="block_various_links_footer">
		<h4><?php echo smartyTranslate(array('s'=>'Information','mod'=>'blockcms'),$_smarty_tpl);?>
</h4>
		<ul class="toggle-footer">
			<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
				<li class="first_item">
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('prices-drop'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>
">
						<?php echo smartyTranslate(array('s'=>'Specials','mod'=>'blockcms'),$_smarty_tpl);?>

					</a>
				</li>
			<?php }?>
			<li class="<?php if ($_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>first_<?php }?>item">
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>
">
					<?php echo smartyTranslate(array('s'=>'New products','mod'=>'blockcms'),$_smarty_tpl);?>

				</a>
			</li>
			<?php if (!$_smarty_tpl->tpl_vars['PS_CATALOG_MODE']->value) {?>
				<li class="item">
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('best-sales'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>
">
						<?php echo smartyTranslate(array('s'=>'Top sellers','mod'=>'blockcms'),$_smarty_tpl);?>

					</a>
				</li>
			<?php }?>
			<?php if ($_smarty_tpl->tpl_vars['display_stores_footer']->value) {?>
				<li class="item">
					<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('stores'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>
">
						<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockcms'),$_smarty_tpl);?>

					</a>
				</li>
			<?php }?>
			<li class="item">
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink($_smarty_tpl->tpl_vars['contact_url']->value,true), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>
">
					<?php echo smartyTranslate(array('s'=>'Contact us','mod'=>'blockcms'),$_smarty_tpl);?>

				</a>
			</li>
			<?php  $_smarty_tpl->tpl_vars['cmslink'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cmslink']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cmslinks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cmslink']->key => $_smarty_tpl->tpl_vars['cmslink']->value) {
$_smarty_tpl->tpl_vars['cmslink']->_loop = true;
?>
				<?php if ($_smarty_tpl->tpl_vars['cmslink']->value['meta_title']!='') {?>
					<li class="item">
						<a href="<?php echo htmlspecialchars(addslashes($_smarty_tpl->tpl_vars['cmslink']->value['link']), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>
">
							<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'], ENT_QUOTES, 'UTF-8', true);?>

						</a>
					</li>
				<?php }?>
			<?php } ?>
			<li>
				<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('sitemap'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Sitemap','mod'=>'blockcms'),$_smarty_tpl);?>
">
					<?php echo smartyTranslate(array('s'=>'Sitemap','mod'=>'blockcms'),$_smarty_tpl);?>

				</a>
			</li>
		</ul>
		<?php echo $_smarty_tpl->tpl_vars['footer_text']->value;?>

	</section>
	<?php if ($_smarty_tpl->tpl_vars['display_poweredby']->value) {?>
	<section class="bottom-footer col-xs-12">
		<div>
			&copy; 2014 <?php echo smartyTranslate(array('s'=>'[1]Ecommerce software by %s[/1]','mod'=>'blockcms','sprintf'=>array('PrestaShop™'),'tags'=>array('<a class="_blank" href="http://www.prestashop.com">')),$_smarty_tpl);?>
  - <a class="_blank" href="http://www.elationbase.com">Theme designed with love <i data-icon="f" class="icon"></i> by Elation Base, LLC.</a>
		</div>
	</section>
	<?php }?>
	<!-- /MODULE Block footer -->
<?php }?>
<?php }} ?>
