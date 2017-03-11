<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 12:12:55
         compiled from "/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18061889555891d0c7732d52-06956650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '93f313f3ff87b6ace4d09443151ca4d73c76b241' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/product.tpl',
      1 => 1477483392,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18061889555891d0c7732d52-06956650',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'logged' => 0,
    'social_networks' => 0,
    'item' => 0,
    'size' => 0,
    'border_style' => 0,
    'popup' => 0,
    'link' => 0,
    'back' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891d0c7792034_07880521',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891d0c7792034_07880521')) {function content_5891d0c7792034_07880521($_smarty_tpl) {?>

<?php if (!$_smarty_tpl->tpl_vars['logged']->value) {?>
<div class="panel panel-default clearfix">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo smartyTranslate(array('s'=>'Register or login with your account:','mod'=>'sociallogin'),$_smarty_tpl);?>
</h2>
    </div>
    <div class="panel-body">
    	<div class="col-xs-12">
    		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['social_networks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
    			<?php if ($_smarty_tpl->tpl_vars['item']->value['complete_config']) {?>
    				<div class="col-xs-4 col-sm-3 col-lg-2">
    					<button class="btn azm-social azm-size-<?php echo intval($_smarty_tpl->tpl_vars['size']->value);?>
 azm-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['border_style']->value, ENT_QUOTES, 'UTF-8', true);?>
 azm-<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['icon_class'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" onclick="window.open('<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['connect'], ENT_QUOTES, 'UTF-8', true);?>
', <?php if ($_smarty_tpl->tpl_vars['popup']->value) {?>'_blank'<?php } else { ?>'_self'<?php }?>, 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')">
    						<i class="fa fa-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['item']->value['fa_icon'], ENT_QUOTES, 'UTF-8', true);?>
"></i>
    					</button>
    				</div>
    			<?php }?>
    		<?php } ?>
    	</div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <div class="or-container">
                <hr class="or-hr" />
                <div class="or img-circle"><?php echo smartyTranslate(array('s'=>'or','mod'=>'sociallogin'),$_smarty_tpl);?>
</div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <!-- Button trigger modal -->
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    <?php echo smartyTranslate(array('s'=>'Log in with e-mail','mod'=>'sociallogin'),$_smarty_tpl);?>

                </button>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true);?>
" method="post" id="login_form" class="box">
                    			<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Already registered?','mod'=>'sociallogin'),$_smarty_tpl);?>
</h3>
                    			<div class="form_content clearfix">
                    				<div class="form-group">
                    					<label for="email"><?php echo smartyTranslate(array('s'=>'Email address','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
                    					<input class="is_required validate account_input form-control" data-validate="isEmail" type="email" id="email" name="email" value="<?php if (isset($_POST['email'])) {?><?php echo mb_convert_encoding(htmlspecialchars(stripslashes($_POST['email']), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
                    				</div>
                    				<div class="form-group">
                    					<label for="passwd"><?php echo smartyTranslate(array('s'=>'Password','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
                    					<input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" />
                    				</div>
                    				<p class="lost_password form-group">
                                        <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('password'), ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo smartyTranslate(array('s'=>'Recover your forgotten password','mod'=>'sociallogin'),$_smarty_tpl);?>
" rel="nofollow"><?php echo smartyTranslate(array('s'=>'Forgot your password?','mod'=>'sociallogin'),$_smarty_tpl);?>
</a>
                                    </p>
                    				<p class="submit">
                    					<?php if (isset($_smarty_tpl->tpl_vars['back']->value)) {?><input type="hidden" class="hidden" name="back" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['back']->value, ENT_QUOTES, 'UTF-8', true);?>
" /><?php }?>
                    					<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
                    						<span>
                    							<i class="icon-lock left"></i>
                    							<?php echo smartyTranslate(array('s'=>'Sign in','mod'=>'sociallogin'),$_smarty_tpl);?>

                    						</span>
                    					</button>
                    				</p>
                    			</div>
                    		</form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / modal -->
        </div>
    </div>
    <div class="panel-footer">
        <?php echo smartyTranslate(array('s'=>'Don\'t have an account?','mod'=>'sociallogin'),$_smarty_tpl);?>
 <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication'), ENT_QUOTES, 'UTF-8', true);?>
?create_account=1&amp;utm_source=link&amp;utm_medium=button&amp;utm_campaign=social_login"><?php echo smartyTranslate(array('s'=>'Sign up','mod'=>'sociallogin'),$_smarty_tpl);?>
</a>
    </div>
</div>
<?php }?><?php }} ?>
