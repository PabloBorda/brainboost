{*
* 2016 Jorge Vargas
*
* NOTICE OF LICENSE
*
* This source file is subject to the End User License Agreement (EULA)
*
* See attachmente file LICENSE
*
* @author    Jorge Vargas <https://addons.prestashop.com/es/Write-to-developper?id_product=17423>
* @copyright 2007-2016 Jorge Vargas
* @link      http://addons.prestashop.com/es/2_community?contributor=3167
* @license   End User License Agreement (EULA)
* @package   sociallogin
* @version   1.0
*}

{if !$logged}
<div class="panel panel-default clearfix">
    <div class="panel-heading">
        <h3 class="panel-title">{l s='Register or login with your account:' mod='sociallogin'}</h2>
    </div>
    <div class="panel-body">
    	<div class="col-xs-12">
    		{foreach from=$social_networks item=item key=k}
    			{if $item.complete_config}
    				<div class="col-xs-4 col-sm-3 col-lg-2">
    					<button class="btn azm-social azm-size-{$size|intval} azm-{$border_style|escape:'html':'UTF-8'} azm-{$item.icon_class|escape:'htmlall':'UTF-8'}" onclick="window.open('{$item.connect|escape:'html':'UTF-8'}', {if $popup}'_blank'{else}'_self'{/if}, 'menubar=no, status=no, copyhistory=no, width=640, height=640, top=220, left=640')">
    						<i class="fa fa-{$item.fa_icon|escape:'html':'UTF-8'}"></i>
    					</button>
    				</div>
    			{/if}
    		{/foreach}
    	</div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <div class="or-container">
                <hr class="or-hr" />
                <div class="or img-circle">{l s='or' mod='sociallogin'}</div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
            <!-- Button trigger modal -->
            <div class="text-center">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                    {l s='Log in with e-mail' mod='sociallogin'}
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
                            <form action="{$link->getPageLink('authentication', true)|escape:'html':'UTF-8'}" method="post" id="login_form" class="box">
                    			<h3 class="page-subheading">{l s='Already registered?' mod='sociallogin'}</h3>
                    			<div class="form_content clearfix">
                    				<div class="form-group">
                    					<label for="email">{l s='Email address' mod='sociallogin'}</label>
                    					<input class="is_required validate account_input form-control" data-validate="isEmail" type="email" id="email" name="email" value="{if isset($smarty.post.email)}{$smarty.post.email|stripslashes|escape:'htmlall':'UTF-8'}{/if}" />
                    				</div>
                    				<div class="form-group">
                    					<label for="passwd">{l s='Password' mod='sociallogin'}</label>
                    					<input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" />
                    				</div>
                    				<p class="lost_password form-group">
                                        <a href="{$link->getPageLink('password')|escape:'html':'UTF-8'}" title="{l s='Recover your forgotten password' mod='sociallogin'}" rel="nofollow">{l s='Forgot your password?' mod='sociallogin'}</a>
                                    </p>
                    				<p class="submit">
                    					{if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'html':'UTF-8'}" />{/if}
                    					<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
                    						<span>
                    							<i class="icon-lock left"></i>
                    							{l s='Sign in' mod='sociallogin'}
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
        {l s='Don\'t have an account?' mod='sociallogin'} <a href="{$link->getPageLink('authentication')|escape:'html':'UTF-8'}?create_account=1&amp;utm_source=link&amp;utm_medium=button&amp;utm_campaign=social_login">{l s='Sign up' mod='sociallogin'}</a>
    </div>
</div>
{/if}