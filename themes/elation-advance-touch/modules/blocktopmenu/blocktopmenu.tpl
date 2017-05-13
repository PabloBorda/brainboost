{if $MENU != ''}
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
			{hook h="displaySocialLoginButtons"}
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
							{if $order_process == 'order'}<a href="{$link->getPageLink("$order_process", true)|escape:'html'}" class="button_small" title="{l s='View my shopping cart' mod='blockcart'}" rel="nofollow">{l s='Cart' mod='blockcart'}</a>{/if}
			<a href="{$link->getPageLink("$order_process", true)|escape:'html'}" id="button_order_cart" class="exclusive{if $order_process == 'order-opc'}_large{/if}" title="{l s='Check out' mod='blockcart'}" rel="nofollow"><span></span>{l s='Check out' mod='blockcart'}</a>
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

{/if}
</div>
