<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:59
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6397228945925602f2de2d8-22193520%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fa0021c498f966bfe402979b61b3fecfc216e487' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/footer.tpl',
      1 => 1494682887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6397228945925602f2de2d8-22193520',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content_only' => 0,
    'right_column_size' => 0,
    'HOOK_RIGHT_COLUMN' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602f3070f9_89382914',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602f3070f9_89382914')) {function content_5925602f3070f9_89382914($_smarty_tpl) {?>

<?php if (!$_smarty_tpl->tpl_vars['content_only']->value) {?>
					</div><!-- #center_column -->
					<?php if (isset($_smarty_tpl->tpl_vars['right_column_size']->value)&&!empty($_smarty_tpl->tpl_vars['right_column_size']->value)) {?>
						<div id="right_column" class="col-xs-12 col-sm-<?php echo intval($_smarty_tpl->tpl_vars['right_column_size']->value);?>
 column"><?php echo $_smarty_tpl->tpl_vars['HOOK_RIGHT_COLUMN']->value;?>
</div>
					<?php }?>
					</div><!-- .row -->
				</div><!-- #columns -->
			</div><!-- .columns-container -->
			<!-- Footer -->
			
		</div><!-- #page -->
		<a class="top"></a>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./global.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</body>
</html><?php }} ?>
