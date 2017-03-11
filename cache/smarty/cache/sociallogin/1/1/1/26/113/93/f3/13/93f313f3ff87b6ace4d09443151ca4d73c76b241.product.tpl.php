<?php /*%%SmartyHeaderCode:3020211105891af450f3e87-21662510%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
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
  'nocache_hash' => '3020211105891af450f3e87-21662510',
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
  'unifunc' => 'content_5891af451612f3_76273466',
  'cache_lifetime' => 31536000,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891af451612f3_76273466')) {function content_5891af451612f3_76273466($_smarty_tpl) {?><div class="panel panel-default clearfix"><div class="panel-heading"><h3 class="panel-title">Register or login with your account:</h2></div><div class="panel-body"><div class="col-xs-12"><div class="col-xs-4 col-sm-3 col-lg-2"> <button class="btn azm-social azm-size-48 azm-0 azm-facebook" onclick="window.open('https://brainboost.ie/index.php?p=facebook&amp;back=&amp;request_uri=%2Findex.php%3Fid_product%3D113%26controller%3Dproduct&amp;utm_source=button&amp;utm_medium=facebook&amp;utm_campaign=social_login&amp;fc=module&amp;module=sociallogin&amp;controller=login', '_blank', 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')"> <i class="fa fa-facebook"></i> </button></div><div class="col-xs-4 col-sm-3 col-lg-2"> <button class="btn azm-social azm-size-48 azm-0 azm-google-plus" onclick="window.open('https://brainboost.ie/index.php?p=google&amp;back=&amp;request_uri=%2Findex.php%3Fid_product%3D113%26controller%3Dproduct&amp;utm_source=button&amp;utm_medium=google&amp;utm_campaign=social_login&amp;fc=module&amp;module=sociallogin&amp;controller=login', '_blank', 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')"> <i class="fa fa-google-plus"></i> </button></div><div class="col-xs-4 col-sm-3 col-lg-2"> <button class="btn azm-social azm-size-48 azm-0 azm-instagram" onclick="window.open('https://brainboost.ie/index.php?p=instagram&amp;back=&amp;request_uri=%2Findex.php%3Fid_product%3D113%26controller%3Dproduct&amp;utm_source=button&amp;utm_medium=instagram&amp;utm_campaign=social_login&amp;fc=module&amp;module=sociallogin&amp;controller=login', '_blank', 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')"> <i class="fa fa-instagram"></i> </button></div><div class="col-xs-4 col-sm-3 col-lg-2"> <button class="btn azm-social azm-size-48 azm-0 azm-linkedin" onclick="window.open('https://brainboost.ie/index.php?p=linkedin&amp;back=&amp;request_uri=%2Findex.php%3Fid_product%3D113%26controller%3Dproduct&amp;utm_source=button&amp;utm_medium=linkedin&amp;utm_campaign=social_login&amp;fc=module&amp;module=sociallogin&amp;controller=login', '_blank', 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')"> <i class="fa fa-linkedin"></i> </button></div></div><div class="clearfix"></div><div class="col-xs-12"><div class="or-container"><hr class="or-hr" /><div class="or img-circle">or</div></div></div><div class="clearfix"></div><div class="col-xs-12"><div class="text-center"> <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal"> Log in with e-mail </button></div><div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body"><form action="https://brainboost.ie/index.php?controller=authentication" method="post" id="login_form" class="box"><h3 class="page-subheading">Already registered?</h3><div class="form_content clearfix"><div class="form-group"> <label for="email">Email address</label> <input class="is_required validate account_input form-control" data-validate="isEmail" type="email" id="email" name="email" value="" /></div><div class="form-group"> <label for="passwd">Password</label> <input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" /></div><p class="lost_password form-group"> <a href="https://brainboost.ie/index.php?controller=password" title="Recover your forgotten password" rel="nofollow">Forgot your password?</a></p><p class="submit"> <button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium"> <span> <i class="icon-lock left"></i> Sign in </span> </button></p></div></form></div></div></div></div></div></div><div class="panel-footer"> Don't have an account? <a href="https://brainboost.ie/index.php?controller=authentication?create_account=1&amp;utm_source=link&amp;utm_medium=button&amp;utm_campaign=social_login">Sign up</a></div></div><?php }} ?>
