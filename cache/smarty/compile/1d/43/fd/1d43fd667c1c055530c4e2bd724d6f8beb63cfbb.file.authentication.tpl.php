<?php /* Smarty version Smarty-3.1.19, created on 2017-02-02 11:52:25
         compiled from "/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/front/authentication.tpl" */ ?>
<?php /*%%SmartyHeaderCode:105742614258931d79c1cf48-16048019%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d43fd667c1c055530c4e2bd724d6f8beb63cfbb' => 
    array (
      0 => '/var/www/html/themes/elation-advance-touch/modules/sociallogin/views/templates/front/authentication.tpl',
      1 => 1477483391,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '105742614258931d79c1cf48-16048019',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'replace_auth' => 0,
    'email_create' => 0,
    'link' => 0,
    'navigationPipe' => 0,
    'back' => 0,
    'HOOK_CREATE_ACCOUNT_TOP' => 0,
    'genders' => 0,
    'gender' => 0,
    'days' => 0,
    'day' => 0,
    'sl_day' => 0,
    'months' => 0,
    'k' => 0,
    'sl_month' => 0,
    'month' => 0,
    'years' => 0,
    'year' => 0,
    'sl_year' => 0,
    'newsletter' => 0,
    'field_required' => 0,
    'optin' => 0,
    'b2b_enable' => 0,
    'HOOK_CREATE_ACCOUNT_FORM' => 0,
    'network' => 0,
    'id_user' => 0,
    'positions' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58931d79dd47f8_27899580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58931d79dd47f8_27899580')) {function content_58931d79dd47f8_27899580($_smarty_tpl) {?>

<!-- Social Login -->
<?php if (isset($_smarty_tpl->tpl_vars['replace_auth']->value)&&$_smarty_tpl->tpl_vars['replace_auth']->value) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array('path', null, null); ob_start(); ?>
    	<?php if (!isset($_smarty_tpl->tpl_vars['email_create']->value)) {?>
            <?php echo smartyTranslate(array('s'=>'Authentication','mod'=>'sociallogin'),$_smarty_tpl);?>

        <?php } else { ?>
    		<a
            href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"
            rel="nofollow"
            title="<?php echo smartyTranslate(array('s'=>'Authentication','mod'=>'sociallogin'),$_smarty_tpl);?>
">
                <?php echo smartyTranslate(array('s'=>'Authentication','mod'=>'sociallogin'),$_smarty_tpl);?>

            </a>
    		<span class="navigation-pipe"><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['navigationPipe']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
</span>
            <?php echo smartyTranslate(array('s'=>'Create your account','mod'=>'sociallogin'),$_smarty_tpl);?>

    	<?php }?>
    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <!-- Title -->
    <h1 class="page-heading">
        <?php if (!isset($_smarty_tpl->tpl_vars['email_create']->value)) {?>
            <?php echo smartyTranslate(array('s'=>'Authentication','mod'=>'sociallogin'),$_smarty_tpl);?>

        <?php } else { ?>
            <?php echo smartyTranslate(array('s'=>'Create an account','mod'=>'sociallogin'),$_smarty_tpl);?>

        <?php }?>
    </h1>
    <?php if (isset($_smarty_tpl->tpl_vars['back']->value)&&preg_match("/^http/",$_smarty_tpl->tpl_vars['back']->value)) {?>
        <?php $_smarty_tpl->tpl_vars['current_step'] = new Smarty_variable('login', null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./order-steps.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <?php }?>
    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./errors.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <!-- Body authentication -->
    <?php if (!isset($_smarty_tpl->tpl_vars['email_create']->value)) {?>
        <div class="row">
        	<div class="col-xs-12 col-md-6 box">
                <h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Quickly login with your social network:','mod'=>'sociallogin'),$_smarty_tpl);?>
</h3>
                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displaySocialLoginButtons"),$_smarty_tpl);?>

        	</div>
        	<div class="col-xs-12 col-md-6">
    			<form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" id="login_form" class="box">
    				<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Use your store credentials:','mod'=>'sociallogin'),$_smarty_tpl);?>
</h3>
    				<div class="form_content clearfix">
    					<div class="form-group">
    						<label for="email"><?php echo smartyTranslate(array('s'=>'Email address','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    						<input
                            class="is_required validate account_input form-control"
                            data-validate="isEmail"
                            type="email"
                            id="email"
                            name="email"
                            value="<?php if (isset($_POST['email'])) {?><?php echo stripslashes(mb_convert_encoding(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'));?>
<?php }?>" />
    					</div>
    					<div class="form-group">
    						<label for="passwd"><?php echo smartyTranslate(array('s'=>'Password','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    						<input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" />
    					</div>
    					<p class="lost_password form-group">
                            <a href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('password'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Recover your forgotten password','mod'=>'sociallogin'),$_smarty_tpl);?>
" rel="nofollow">
                                <?php echo smartyTranslate(array('s'=>'Forgot your password?','mod'=>'sociallogin'),$_smarty_tpl);?>

                            </a>
                        </p>
    					<p class="submit">
    						<?php if (isset($_smarty_tpl->tpl_vars['back']->value)) {?><input type="hidden" class="hidden" name="back" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['back']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /><?php }?>
    						<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
    							<span>
    								<i class="fa fa-lock left"></i>
    								<?php echo smartyTranslate(array('s'=>'Sign in','mod'=>'sociallogin'),$_smarty_tpl);?>

    							</span>
    						</button>
    					</p>
                        <hr />
                        <p class="lost_password form-group">
                            <a 
                            title="<?php echo smartyTranslate(array('s'=>'Create an account with e-mail address','mod'=>'sociallogin'),$_smarty_tpl);?>
" 
                            href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication'), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
?create_account=1&amp;utm_source=link&amp;utm_medium=button&amp;utm_campaign=social_login<?php if (isset($_smarty_tpl->tpl_vars['back']->value)&&$_smarty_tpl->tpl_vars['back']->value) {?>&amp;back=<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['back']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>">
                                <?php echo smartyTranslate(array('s'=>'No account? create one here','mod'=>'sociallogin'),$_smarty_tpl);?>

                            </a>
                        </p>
    				</div>
    			</form>
        	</div>
        </div>
    <?php } else { ?>
    <!-- Body create account -->
        <form action="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" method="post" id="account-creation_form" class="std box">
            <?php echo $_smarty_tpl->tpl_vars['HOOK_CREATE_ACCOUNT_TOP']->value;?>
 
    		<div class="account_creation">
    			<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Your personal information','mod'=>'sociallogin'),$_smarty_tpl);?>
</h3>
    			<p class="required"><sup>*</sup><?php echo smartyTranslate(array('s'=>'Required field','mod'=>'sociallogin'),$_smarty_tpl);?>
</p>
    			<div class="clearfix col-xs-12">
    				<label><?php echo smartyTranslate(array('s'=>'Title','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    				<br />
    				<?php  $_smarty_tpl->tpl_vars['gender'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['gender']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['genders']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['gender']->key => $_smarty_tpl->tpl_vars['gender']->value) {
$_smarty_tpl->tpl_vars['gender']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['gender']->key;
?>
    					<div class="radio-inline">
    						<label for="id_gender<?php echo intval($_smarty_tpl->tpl_vars['gender']->value->id);?>
" class="top">
    							<input
                                type="radio"
                                name="id_gender"
                                id="id_gender<?php echo intval($_smarty_tpl->tpl_vars['gender']->value->id);?>
"
                                value="<?php echo intval($_smarty_tpl->tpl_vars['gender']->value->id);?>
" <?php if (isset($_POST['id_gender'])&&$_POST['id_gender']==$_smarty_tpl->tpl_vars['gender']->value->id) {?>checked="checked"<?php }?> />
    						    <?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['gender']->value->name, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

    						</label>
    					</div>
    				<?php } ?>
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="customer_firstname"><?php echo smartyTranslate(array('s'=>'First name','mod'=>'sociallogin'),$_smarty_tpl);?>
 <sup>*</sup></label>
    				<input
                    onkeyup="$('#firstname').val(this.value);"
                    type="text" class="is_required validate form-control"
                    data-validate="isName"
                    id="customer_firstname"
                    name="customer_firstname"
                    value="<?php if (isset($_POST['customer_firstname'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['customer_firstname'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="customer_lastname"><?php echo smartyTranslate(array('s'=>'Last name','mod'=>'sociallogin'),$_smarty_tpl);?>
 <sup>*</sup></label>
    				<input
                    onkeyup="$('#lastname').val(this.value);"
                    type="text"
                    class="is_required validate form-control"
                    data-validate="isName"
                    id="customer_lastname"
                    name="customer_lastname"
                    value="<?php if (isset($_POST['customer_lastname'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['customer_lastname'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="email"><?php echo smartyTranslate(array('s'=>'Email','mod'=>'sociallogin'),$_smarty_tpl);?>
 <sup>*</sup></label>
    				<input
                    type="email"
                    class="is_required validate form-control"
                    data-validate="isEmail"
                    id="email"
                    name="email"
                    value="<?php if (isset($_POST['email'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    			</div>
    			<div class="required password form-group col-md-6">
    				<label for="passwd"><?php echo smartyTranslate(array('s'=>'Password','mod'=>'sociallogin'),$_smarty_tpl);?>
 <sup>*</sup></label>
    				<input
                    type="password"
                    class="is_required validate form-control"
                    data-validate="isPasswd"
                    name="passwd" id="passwd" />
    				<span class="form_info"><?php echo smartyTranslate(array('s'=>'(Five characters minimum)','mod'=>'sociallogin'),$_smarty_tpl);?>
</span>
    			</div>
    			<div class="form-group col-md-6">
    				<label><?php echo smartyTranslate(array('s'=>'Date of Birth','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    				<div class="row">
    					<div class="col-xs-4">
    						<select id="days" name="days" class="form-control">
    							<option value="">-</option>
    							<?php  $_smarty_tpl->tpl_vars['day'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['day']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['days']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['day']->key => $_smarty_tpl->tpl_vars['day']->value) {
$_smarty_tpl->tpl_vars['day']->_loop = true;
?>
    								<option value="<?php echo intval($_smarty_tpl->tpl_vars['day']->value);?>
" <?php if (($_smarty_tpl->tpl_vars['sl_day']->value==$_smarty_tpl->tpl_vars['day']->value)) {?> selected="selected"<?php }?>><?php echo intval($_smarty_tpl->tpl_vars['day']->value);?>
&nbsp;&nbsp;</option>
    							<?php } ?>
    						</select>
    						
    					</div>
    					<div class="col-xs-4">
    						<select id="months" name="months" class="form-control">
    							<option value="">-</option>
    							<?php  $_smarty_tpl->tpl_vars['month'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['month']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['months']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['month']->key => $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['month']->key;
?>
    								<option value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_month']->value==$_smarty_tpl->tpl_vars['k']->value)) {?> selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>$_smarty_tpl->tpl_vars['month']->value,'mod'=>'sociallogin'),$_smarty_tpl);?>
&nbsp;</option>
    							<?php } ?>
    						</select>
    					</div>
    					<div class="col-xs-4">
    						<select id="years" name="years" class="form-control">
    							<option value="">-</option>
    							<?php  $_smarty_tpl->tpl_vars['year'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['year']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['years']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['year']->key => $_smarty_tpl->tpl_vars['year']->value) {
$_smarty_tpl->tpl_vars['year']->_loop = true;
?>
    								<option value="<?php echo intval($_smarty_tpl->tpl_vars['year']->value);?>
" <?php if (($_smarty_tpl->tpl_vars['sl_year']->value==$_smarty_tpl->tpl_vars['year']->value)) {?> selected="selected"<?php }?>><?php echo intval($_smarty_tpl->tpl_vars['year']->value);?>
&nbsp;&nbsp;</option>
    							<?php } ?>
    						</select>
    					</div>
    				</div>
    			</div>
    			<?php if (isset($_smarty_tpl->tpl_vars['newsletter']->value)&&$_smarty_tpl->tpl_vars['newsletter']->value) {?>
    				<div class="checkbox">
    					<input type="checkbox" name="newsletter" id="newsletter" value="1" <?php if (isset($_POST['newsletter'])&&$_POST['newsletter']==1) {?> checked="checked"<?php }?> />
    					<label for="newsletter"><?php echo smartyTranslate(array('s'=>'Sign up for our newsletter!','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<?php if (array_key_exists('newsletter',$_smarty_tpl->tpl_vars['field_required']->value)) {?>
    						<sup> *</sup>
    					<?php }?>
    				</div>
    			<?php }?>
    			<?php if (isset($_smarty_tpl->tpl_vars['optin']->value)&&$_smarty_tpl->tpl_vars['optin']->value) {?>
    				<div class="checkbox">
    					<input type="checkbox" name="optin" id="optin" value="1" <?php if (isset($_POST['optin'])&&$_POST['optin']==1) {?> checked="checked"<?php }?> />
    					<label for="optin"><?php echo smartyTranslate(array('s'=>'Receive special offers from our partners!','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<?php if (array_key_exists('optin',$_smarty_tpl->tpl_vars['field_required']->value)) {?>
    						<sup> *</sup>
    					<?php }?>
    				</div>
    			<?php }?>
    		</div>
    		<?php if ($_smarty_tpl->tpl_vars['b2b_enable']->value) {?>
    			<div class="account_creation col-xs-12">
    				<h3 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Your company information','mod'=>'sociallogin'),$_smarty_tpl);?>
</h3>
    				<p class="form-group col-md-6">
    					<label for=""><?php echo smartyTranslate(array('s'=>'Company','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<input
                        type="text"
                        class="form-control"
                        id="company"
                        name="company"
                        value="<?php if (isset($_POST['company'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['company'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="siret"><?php echo smartyTranslate(array('s'=>'SIRET','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<input
                        type="text"
                        class="form-control"
                        id="siret"
                        name="siret"
                        value="<?php if (isset($_POST['siret'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['siret'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="ape"><?php echo smartyTranslate(array('s'=>'APE','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<input
                        type="text"
                        class="form-control"
                        id="ape"
                        name="ape"
                        value="<?php if (isset($_POST['ape'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['ape'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="website"><?php echo smartyTranslate(array('s'=>'Website','mod'=>'sociallogin'),$_smarty_tpl);?>
</label>
    					<input
                        type="text"
                        class="form-control"
                        id="website"
                        name="website"
                        value="<?php if (isset($_POST['website'])) {?><?php echo mb_convert_encoding(htmlspecialchars($_POST['website'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php }?>" />
    				</p>
    			</div>
    		<?php }?>
            <?php echo $_smarty_tpl->tpl_vars['HOOK_CREATE_ACCOUNT_FORM']->value;?>
 
    		<div class="submit clearfix">
    			<input type="hidden" name="email_create" value="1" />
    			<input type="hidden" name="is_new_customer" value="1" />
    			<?php if (isset($_smarty_tpl->tpl_vars['back']->value)) {?><input type="hidden" class="hidden" name="back" value="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['back']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" /><?php }?>
    			<button type="submit" name="submitAccount" id="submitAccount" class="btn btn-default button button-medium">
    				<span><?php echo smartyTranslate(array('s'=>'Register','mod'=>'sociallogin'),$_smarty_tpl);?>
<i class="fa fa-chevron-right right"></i></span>
    			</button>
    			<p class="pull-right required"><span><sup>*</sup><?php echo smartyTranslate(array('s'=>'Required field','mod'=>'sociallogin'),$_smarty_tpl);?>
</span></p>
    		</div>
        </form>
        <button class="btn btn-primary" onclick="window.history.back();"><i class="fa fa-chevron-left left"></i> <?php echo smartyTranslate(array('s'=>'Back','mod'=>'sociallogin'),$_smarty_tpl);?>
</button>
    <?php }?>
<?php } else { ?>
    <?php if (!isset($_smarty_tpl->tpl_vars['network']->value)&&!isset($_smarty_tpl->tpl_vars['id_user']->value)&&isset($_smarty_tpl->tpl_vars['positions']->value)&&is_array($_smarty_tpl->tpl_vars['positions']->value)&&in_array('authentication',$_smarty_tpl->tpl_vars['positions']->value)) {?>
        <div class="box clearfix col-xs-12 col-sm-12">
        	<h2 class="page-subheading"><?php echo smartyTranslate(array('s'=>'Register or login with your account:','mod'=>'sociallogin'),$_smarty_tpl);?>
</h2>
        	<div class="col-xs-12 col-sm-12">
                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0][0]->smartyHook(array('h'=>"displaySocialLoginButtons"),$_smarty_tpl);?>

        	</div>
        </div>
        <div class="col-xs-12">
            <div class="or-container">
                <hr class="or-hr" />
                <div class="or img-circle"><?php echo smartyTranslate(array('s'=>'or','mod'=>'sociallogin'),$_smarty_tpl);?>
</div>
            </div>
        </div>
    <?php }?>
    <!-- / Social Login -->

    <?php echo $_smarty_tpl->getSubTemplate (((string)$_smarty_tpl->tpl_vars['tpl_dir']->value)."./authentication.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<?php }?><?php }} ?>
