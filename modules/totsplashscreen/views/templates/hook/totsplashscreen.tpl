<!-- Block totsplashscreen-->
{if $totSplashScreen}
	 <a href="#totsplashscreen" id="totsplashscreen_link"></a>
	 {if isset($fancybox) && isset($fancybox_style)}
	 	<script type="text/javascript" src="{$fancybox}"></script>
	 	<link rel="stylesheet" href="{$fancybox_style}">
	 {/if}
	 <script>
	 function scrolltopdiv(){
	 $.fancybox.close();
		//var elmnt = document.getElementById("eb-home-block-2");
		//scrollTo(document.body, 0, 100);
		//alert(elmnt);
		//elmnt.scrollTop = 10;
		/*document.querySelector('#eb-grid').scrollIntoView({ 
			behavior: 'smooth'
			
		});*/
		window.scrollTo(0, 2850);
	
	 /* $("input#button1").on('click', function(e) {
    e.preventDefault();
    $('html, body').animate({ 
        scrollTop: $(this.hash).offset().top - $('section#eb-home-block-2').height()
    }, 1000);
});*/
 }
	 $(function(){
		  {literal}
		  $("#totsplashscreen_link").fancybox(
			   {
			   	{/literal}
			   	{if version_compare($smarty.const._PS_VERSION_, '1.5', '>')}
						 {if $totSplashScreen.totsplashscreen_width > 0}
							  width : '{$totSplashScreen.totsplashscreen_width}px',
						 {/if}
						 {if $totSplashScreen.totsplashscreen_height > 0}
							  height: '{$totSplashScreen.totsplashscreen_height}px',
						 {/if}
						 {if $totSplashScreen.totsplashscreen_width > 0 || $totSplashScreen.totsplashscreen_height > 0}
							  autoSize: false,
						 {/if}
						 {if $totSplashScreen.totsplashscreen_permission_mode}
							  closeBtn: false,
						 {/if}
					{literal}
					helpers : {
						 overlay  : {
							  css : {
								   'background' : 'rgba(0, 0, 0, {/literal}{$totSplashScreen.totsplashscreen_opacity / 100}{literal})'
							  },
							  {/literal}
								   {if $totSplashScreen.totsplashscreen_permission_mode}
										closeClick: false,
								   {/if}
							  {literal}
						 }
					}
					{/literal}
				{else}
					padding: 0,
					{if $totSplashScreen.totsplashscreen_permission_mode}
						hideOnOverlayClick: false,
						showCloseButton : false,
					{/if}
					
			   {/if}
			   {literal}
			   }
		  );
		  $("#totsplashscreen_link").click();
		  {/literal}
	 });
	 </script>
	 <style>
		  #fancybox-outer,
		  .fancybox-skin {
			   background : {$totSplashScreen.totsplashscreen_backgroundColor};    
		  }

		  #hiddenSplashScreen {
		  	display: none;
		  }
	 </style>
	 <div id="hiddenSplashScreen">
		 <div id="totsplashscreen">
			  <p>{$totSplashScreen.totsplashscreen_text_before}</p><!--
			  -->{if $totSplashScreen.totsplashscreen_newsletter == 'on' && $install == 'on'}<!--
				   --><div id="totSplashLeft"{if $totSplashScreen.totsplashscreen_fan_page != "on"} class="big"{/if}>
						<h2>{l s='Subscription Newsletter' mod='totSplashScreen'}</h2>
						{l s='Text newsletter' mod='totSplashScreen'}
						{if isset($totsplashscreen_message) && $totsplashscreen_message}
							 <p class="{if $nw_error}warning_inline{else}success_inline{/if}">{$totsplashscreen_message}</p>
						{/if}	
						<form action="" method="post">	
							 <p>
								  <input type="text" name="TOTemail" size="18" value="{if isset($value) && $value}{$value}{else}{l s='your e-mail' mod='totSplashScreen'}{/if}" onfocus="javascript:if(this.value=='{l s='your e-mail' mod='totSplashScreen'}')this.value='';" onblur="javascript:if(this.value=='')this.value='{l s='your e-mail' mod='totSplashScreen'}';" />
							 </p>
							 <input type="hidden" name="TOTaction" value="0" />
							 
							 <center><input type="submit" value="{l s='Subscribe' mod='totSplashScreen'}" class="button" name="TOTsubmitNewsletter" /></center>
							 
						</form>
						<div class="both" style="margin-bottom: 10px;"></div>
				   </div><!--              
			  -->{/if}<!--            
			  -->{if $totSplashScreen.totsplashscreen_fan_page == 'on'}<!--             
				   --><div id="totSplashRight"{if $totSplashScreen.totsplashscreen_newsletter != "on" || $install != "on"} class="big"{/if}>
						<h2>{l s='Become fan' mod='totSplashScreen'}</h2>
						<input type="image" src="//brainboost.ie/img/button1.png" alt="thinker" width="20%"  id="button1" style="float:right;" onclick="javascript:scrolltopdiv();">
						<a href="https://brainboost.ie/index.php?id_product=113&controller=product#.WGamNFOLS00">
							<input type="image" src="//brainboost.ie/img/button2.png" alt="stack" width="20%"  id="button2" style="float:right;" ></a>
						<p>{l s='Text facebook' mod='totSplashScreen'}<br /><br /></p>
						<center>
							 <iframe src="//www.facebook.com/plugins/like.php?href={$totSplashScreen.totsplashscreen_fan_page_url}&amp;send=false&amp;layout=standard&amp;width=150&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; width:250px; height:70px; " allowTransparency="true"></iframe>
						</center>
						 
						<!-- img src="//brainboost.ie/img/button1.png" id="button1" style="float:right;"/>
						<img src="//brainboost.ie/img/button2.png" id="button1" style="float:right;"/ -->						
				   </div><!--              
			  -->{/if}<!--            
			  --><div class="both" style="clear:both"></div>	

			  {if $totSplashScreen.totsplashscreen_permission_mode == 1}
				   <div class="totSplashPermission">
						<a href="#" onclick="$.fancybox.close();" class="{if $totSplashScreen.image_enter == ''}button{/if}">
							 {if $totSplashScreen.image_enter != ''}
								  <img src="{$totSplashScreen.image_enter}" alt="">
							 {else}
								  {l s='Enter' mod='totsplashscreen'}
							 {/if}
						</a>
						<a href="{$totSplashScreen.totsplashscreen_permission_redirect}" class="{if $totSplashScreen.image_enter == ''}button{/if}">
							 {if $totSplashScreen.image_leave != ''}
								  <img src="{$totSplashScreen.image_leave}" alt="">
							 {else}
								  {l s='Leave' mod='totsplashscreen'}
							 {/if}
						</a>
				   </div>
			  {/if}	 
		 </div>
	 </div>
{/if}
<!-- /Block totsplashscreen-->     