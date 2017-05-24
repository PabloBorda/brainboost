<?php /* Smarty version Smarty-3.1.19, created on 2017-05-24 11:27:56
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/modules/blocktopmenu/blocktopmenu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20217347185925602cca7688-68663412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '57217d3e4675239cf219fd00496dc4f3570f656b' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/modules/blocktopmenu/blocktopmenu.tpl',
      1 => 1494682887,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20217347185925602cca7688-68663412',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'MENU' => 0,
    'order_process' => 0,
    'link' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5925602cce4bb3_31519590',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5925602cce4bb3_31519590')) {function content_5925602cce4bb3_31519590($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['MENU']->value!='') {?>
	<!-- Menu -->
	
<div class="eb-top-nav-wrapper animate-fast clearfix">

 <div class="col-xs-8 col-sm-8">
 	<table>
	<tr>
		<td width="100px">
			 <div id="header_logo">
								<a href="//brainboost.ie/" title="BrainBoost">
									<img class="logo animate" src="//brainboost.ie/img/europort-logo-1469719481.jpg" alt="BrainBoost">
								</a>
			 </div>
		</td>
		<td width="220px">
			<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displaySocialLoginButtons"),$_smarty_tpl);?>

		</td>
		<td>
			<table>
						<tr>
							<td>
								<p id="add_to_cart" class="buttons_bottom_block no-print">
									<button type="submit" name="Submit" class="exclusive">
										<span>Add to cart</span>
									</button>
						 		 </p>
							</td>
						</tr>
						<tr>
							<td>
							<?php if ($_smarty_tpl->tpl_vars['order_process']->value=='order') {?><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" class="button_small" title="<?php echo smartyTranslate(array('s'=>'View my shopping cart','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</a><?php }?>
			<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink(((string)$_smarty_tpl->tpl_vars['order_process']->value),true), ENT_QUOTES, 'UTF-8', true);?>
" id="button_order_cart" class="exclusive<?php if ($_smarty_tpl->tpl_vars['order_process']->value=='order-opc') {?>_large<?php }?>" title="<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
" rel="nofollow"><span></span><?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
							</td>
						</tr>
						
			</table>
						
						
						
		</td>
	</tr>
			
	</table>
		
		
	</td>
	</tr>
	</table>
 
 
 
		
 </div>
 </div>
	<!--/ Menu -->
<script>
$("#block_top_menu .cart_block").click(function(){
	//alert('a');
	//$("#cart_block").css("display","block");
	$("#header #block_top_menu #cart_block").toggle();
});
</script>

<?php }?>
</div>
<?php }} ?>
