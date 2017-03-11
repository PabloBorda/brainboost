<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:26
         compiled from "/var/www/html/modules/totsplashscreen/views/templates/hook/totsplashscreen.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3741819705891c74ab57595-15247781%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ce161545ed91a0dc8152f1acf789b86e29188d63' => 
    array (
      0 => '/var/www/html/modules/totsplashscreen/views/templates/hook/totsplashscreen.tpl',
      1 => 1483159794,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3741819705891c74ab57595-15247781',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'totSplashScreen' => 0,
    'fancybox' => 0,
    'fancybox_style' => 0,
    'install' => 0,
    'totsplashscreen_message' => 0,
    'nw_error' => 0,
    'value' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74ac91dd4_30525897',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74ac91dd4_30525897')) {function content_5891c74ac91dd4_30525897($_smarty_tpl) {?><!-- Block totsplashscreen-->
<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value) {?>
	 <a href="#totsplashscreen" id="totsplashscreen_link"></a>
	 <?php if (isset($_smarty_tpl->tpl_vars['fancybox']->value)&&isset($_smarty_tpl->tpl_vars['fancybox_style']->value)) {?>
	 	<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['fancybox']->value;?>
"></script>
	 	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['fancybox_style']->value;?>
">
	 <?php }?>
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
		  
		  $("#totsplashscreen_link").fancybox(
			   {
			   	
			   	<?php if (version_compare(@constant('_PS_VERSION_'),'1.5','>')) {?>
						 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_width']>0) {?>
							  width : '<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_width'];?>
px',
						 <?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_height']>0) {?>
							  height: '<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_height'];?>
px',
						 <?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_width']>0||$_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_height']>0) {?>
							  autoSize: false,
						 <?php }?>
						 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_permission_mode']) {?>
							  closeBtn: false,
						 <?php }?>
					
					helpers : {
						 overlay  : {
							  css : {
								   'background' : 'rgba(0, 0, 0, <?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_opacity']/100;?>
)'
							  },
							  
								   <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_permission_mode']) {?>
										closeClick: false,
								   <?php }?>
							  
						 }
					}
					
				<?php } else { ?>
					padding: 0,
					<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_permission_mode']) {?>
						hideOnOverlayClick: false,
						showCloseButton : false,
					<?php }?>
					
			   <?php }?>
			   
			   }
		  );
		  $("#totsplashscreen_link").click();
		  
	 });
	 </script>
	 <style>
		  #fancybox-outer,
		  .fancybox-skin {
			   background : <?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_backgroundColor'];?>
;    
		  }

		  #hiddenSplashScreen {
		  	display: none;
		  }
	 </style>
	 <div id="hiddenSplashScreen">
		 <div id="totsplashscreen">
			  <p><?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_text_before'];?>
</p><!--
			  --><?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_newsletter']=='on'&&$_smarty_tpl->tpl_vars['install']->value=='on') {?><!--
				   --><div id="totSplashLeft"<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_fan_page']!="on") {?> class="big"<?php }?>>
						<h2><?php echo smartyTranslate(array('s'=>'Subscription Newsletter','mod'=>'totSplashScreen'),$_smarty_tpl);?>
</h2>
						<?php echo smartyTranslate(array('s'=>'Text newsletter','mod'=>'totSplashScreen'),$_smarty_tpl);?>

						<?php if (isset($_smarty_tpl->tpl_vars['totsplashscreen_message']->value)&&$_smarty_tpl->tpl_vars['totsplashscreen_message']->value) {?>
							 <p class="<?php if ($_smarty_tpl->tpl_vars['nw_error']->value) {?>warning_inline<?php } else { ?>success_inline<?php }?>"><?php echo $_smarty_tpl->tpl_vars['totsplashscreen_message']->value;?>
</p>
						<?php }?>	
						<form action="" method="post">	
							 <p>
								  <input type="text" name="TOTemail" size="18" value="<?php if (isset($_smarty_tpl->tpl_vars['value']->value)&&$_smarty_tpl->tpl_vars['value']->value) {?><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
<?php } else { ?><?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'totSplashScreen'),$_smarty_tpl);?>
<?php }?>" onfocus="javascript:if(this.value=='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'totSplashScreen'),$_smarty_tpl);?>
')this.value='';" onblur="javascript:if(this.value=='')this.value='<?php echo smartyTranslate(array('s'=>'your e-mail','mod'=>'totSplashScreen'),$_smarty_tpl);?>
';" />
							 </p>
							 <input type="hidden" name="TOTaction" value="0" />
							 
							 <center><input type="submit" value="<?php echo smartyTranslate(array('s'=>'Subscribe','mod'=>'totSplashScreen'),$_smarty_tpl);?>
" class="button" name="TOTsubmitNewsletter" /></center>
							 
						</form>
						<div class="both" style="margin-bottom: 10px;"></div>
				   </div><!--              
			  --><?php }?><!--            
			  --><?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_fan_page']=='on') {?><!--             
				   --><div id="totSplashRight"<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_newsletter']!="on"||$_smarty_tpl->tpl_vars['install']->value!="on") {?> class="big"<?php }?>>
						<h2><?php echo smartyTranslate(array('s'=>'Become fan','mod'=>'totSplashScreen'),$_smarty_tpl);?>
</h2>
						<input type="image" src="//brainboost.ie/img/button1.png" alt="thinker" width="20%"  id="button1" style="float:right;" onclick="javascript:scrolltopdiv();">
						<a href="https://brainboost.ie/index.php?id_product=113&controller=product#.WGamNFOLS00">
							<input type="image" src="//brainboost.ie/img/button2.png" alt="stack" width="20%"  id="button2" style="float:right;" ></a>
						<p><?php echo smartyTranslate(array('s'=>'Text facebook','mod'=>'totSplashScreen'),$_smarty_tpl);?>
<br /><br /></p>
						<center>
							 <iframe src="//www.facebook.com/plugins/like.php?href=<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_fan_page_url'];?>
&amp;send=false&amp;layout=standard&amp;width=150&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=35" scrolling="no" frameborder="0" style="border:none; width:250px; height:70px; " allowTransparency="true"></iframe>
						</center>
						 
						<!-- img src="//brainboost.ie/img/button1.png" id="button1" style="float:right;"/>
						<img src="//brainboost.ie/img/button2.png" id="button1" style="float:right;"/ -->						
				   </div><!--              
			  --><?php }?><!--            
			  --><div class="both" style="clear:both"></div>	

			  <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_permission_mode']==1) {?>
				   <div class="totSplashPermission">
						<a href="#" onclick="$.fancybox.close();" class="<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['image_enter']=='') {?>button<?php }?>">
							 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['image_enter']!='') {?>
								  <img src="<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['image_enter'];?>
" alt="">
							 <?php } else { ?>
								  <?php echo smartyTranslate(array('s'=>'Enter','mod'=>'totsplashscreen'),$_smarty_tpl);?>

							 <?php }?>
						</a>
						<a href="<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['totsplashscreen_permission_redirect'];?>
" class="<?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['image_enter']=='') {?>button<?php }?>">
							 <?php if ($_smarty_tpl->tpl_vars['totSplashScreen']->value['image_leave']!='') {?>
								  <img src="<?php echo $_smarty_tpl->tpl_vars['totSplashScreen']->value['image_leave'];?>
" alt="">
							 <?php } else { ?>
								  <?php echo smartyTranslate(array('s'=>'Leave','mod'=>'totsplashscreen'),$_smarty_tpl);?>

							 <?php }?>
						</a>
				   </div>
			  <?php }?>	 
		 </div>
	 </div>
<?php }?>
<!-- /Block totsplashscreen-->     <?php }} ?>
