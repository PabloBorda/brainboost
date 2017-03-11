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

<!-- Social Login -->
{if isset($replace_auth) && $replace_auth}
    {capture name=path}
    	{if !isset($email_create)}
            {l s='Authentication' mod='sociallogin'}
        {else}
    		<a
            href="{$link->getPageLink('authentication', true)|escape:'htmlall':'UTF-8'}"
            rel="nofollow"
            title="{l s='Authentication' mod='sociallogin'}">
                {l s='Authentication' mod='sociallogin'}
            </a>
    		<span class="navigation-pipe">{$navigationPipe|escape:'htmlall':'UTF-8'}</span>
            {l s='Create your account' mod='sociallogin'}
    	{/if}
    {/capture}
    <!-- Title -->
    <h1 class="page-heading">
        {if !isset($email_create)}
            {l s='Authentication' mod='sociallogin'}
        {else}
            {l s='Create an account' mod='sociallogin'}
        {/if}
    </h1>
    {if isset($back) && preg_match("/^http/", $back)}
        {assign var='current_step' value='login'}
        {include file="$tpl_dir./order-steps.tpl"}
    {/if}
    {include file="$tpl_dir./errors.tpl"}
    <!-- Body authentication -->
    {if !isset($email_create)}
        <div class="row">
        	<div class="col-xs-12 col-md-6 box">
                <h3 class="page-subheading">{l s='Quickly login with your social network:' mod='sociallogin'}</h3>
                {hook h="displaySocialLoginButtons"}
        	</div>
        	<div class="col-xs-12 col-md-6">
    			<form action="{$link->getPageLink('authentication', true)|escape:'htmlall':'UTF-8'}" method="post" id="login_form" class="box">
    				<h3 class="page-subheading">{l s='Use your store credentials:' mod='sociallogin'}</h3>
    				<div class="form_content clearfix">
    					<div class="form-group">
    						<label for="email">{l s='Email address' mod='sociallogin'}</label>
    						<input
                            class="is_required validate account_input form-control"
                            data-validate="isEmail"
                            type="email"
                            id="email"
                            name="email"
                            value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'htmlall':'UTF-8'|stripslashes}{/if}" />
    					</div>
    					<div class="form-group">
    						<label for="passwd">{l s='Password' mod='sociallogin'}</label>
    						<input class="is_required validate account_input form-control" type="password" data-validate="isPasswd" id="passwd" name="passwd" value="" />
    					</div>
    					<p class="lost_password form-group">
                            <a href="{$link->getPageLink('password')|escape:'htmlall':'UTF-8'}" title="{l s='Recover your forgotten password' mod='sociallogin'}" rel="nofollow">
                                {l s='Forgot your password?' mod='sociallogin'}
                            </a>
                        </p>
    					<p class="submit">
    						{if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}
    						<button type="submit" id="SubmitLogin" name="SubmitLogin" class="button btn btn-default button-medium">
    							<span>
    								<i class="fa fa-lock left"></i>
    								{l s='Sign in' mod='sociallogin'}
    							</span>
    						</button>
    					</p>
                        <hr />
                        <p class="lost_password form-group">
                            <a 
                            title="{l s='Create an account with e-mail address' mod='sociallogin'}" 
                            href="{$link->getPageLink('authentication')|escape:'htmlall':'UTF-8'}?create_account=1&amp;utm_source=link&amp;utm_medium=button&amp;utm_campaign=social_login{if isset($back) && $back}&amp;back={$back|escape:'htmlall':'UTF-8'}{/if}">
                                {l s='No account? create one here' mod='sociallogin'}
                            </a>
                        </p>
    				</div>
    			</form>
        	</div>
        </div>
    {else}
    <!-- Body create account -->
        <form action="{$link->getPageLink('authentication', true)|escape:'htmlall':'UTF-8'}" method="post" id="account-creation_form" class="std box">
            {$HOOK_CREATE_ACCOUNT_TOP} {* HTML CONTENT *}
    		<div class="account_creation">
    			<h3 class="page-subheading">{l s='Your personal information' mod='sociallogin'}</h3>
    			<p class="required"><sup>*</sup>{l s='Required field' mod='sociallogin'}</p>
    			<div class="clearfix col-xs-12">
    				<label>{l s='Title' mod='sociallogin'}</label>
    				<br />
    				{foreach from=$genders key=k item=gender}
    					<div class="radio-inline">
    						<label for="id_gender{$gender->id|intval}" class="top">
    							<input
                                type="radio"
                                name="id_gender"
                                id="id_gender{$gender->id|intval}"
                                value="{$gender->id|intval}" {if isset($smarty.post.id_gender) && $smarty.post.id_gender == $gender->id}checked="checked"{/if} />
    						    {$gender->name|escape:'htmlall':'UTF-8'}
    						</label>
    					</div>
    				{/foreach}
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="customer_firstname">{l s='First name' mod='sociallogin'} <sup>*</sup></label>
    				<input
                    onkeyup="$('#firstname').val(this.value);"
                    type="text" class="is_required validate form-control"
                    data-validate="isName"
                    id="customer_firstname"
                    name="customer_firstname"
                    value="{if isset($smarty.post.customer_firstname)}{$smarty.post.customer_firstname|escape:'htmlall':'UTF-8'}{/if}" />
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="customer_lastname">{l s='Last name' mod='sociallogin'} <sup>*</sup></label>
    				<input
                    onkeyup="$('#lastname').val(this.value);"
                    type="text"
                    class="is_required validate form-control"
                    data-validate="isName"
                    id="customer_lastname"
                    name="customer_lastname"
                    value="{if isset($smarty.post.customer_lastname)}{$smarty.post.customer_lastname|escape:'htmlall':'UTF-8'}{/if}" />
    			</div>
    			<div class="required form-group col-md-6">
    				<label for="email">{l s='Email' mod='sociallogin'} <sup>*</sup></label>
    				<input
                    type="email"
                    class="is_required validate form-control"
                    data-validate="isEmail"
                    id="email"
                    name="email"
                    value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'htmlall':'UTF-8'}{/if}" />
    			</div>
    			<div class="required password form-group col-md-6">
    				<label for="passwd">{l s='Password' mod='sociallogin'} <sup>*</sup></label>
    				<input
                    type="password"
                    class="is_required validate form-control"
                    data-validate="isPasswd"
                    name="passwd" id="passwd" />
    				<span class="form_info">{l s='(Five characters minimum)' mod='sociallogin'}</span>
    			</div>
    			<div class="form-group col-md-6">
    				<label>{l s='Date of Birth' mod='sociallogin'}</label>
    				<div class="row">
    					<div class="col-xs-4">
    						<select id="days" name="days" class="form-control">
    							<option value="">-</option>
    							{foreach from=$days item=day}
    								<option value="{$day|intval}" {if ($sl_day == $day)} selected="selected"{/if}>{$day|intval}&nbsp;&nbsp;</option>
    							{/foreach}
    						</select>
    						{*
    							{l s='January' mod='sociallogin'}
    							{l s='February' mod='sociallogin'}
    							{l s='March' mod='sociallogin'}
    							{l s='April' mod='sociallogin'}
    							{l s='May' mod='sociallogin'}
    							{l s='June' mod='sociallogin'}
    							{l s='July' mod='sociallogin'}
    							{l s='August' mod='sociallogin'}
    							{l s='September' mod='sociallogin'}
    							{l s='October' mod='sociallogin'}
    							{l s='November' mod='sociallogin'}
    							{l s='December' mod='sociallogin'}
    						*}
    					</div>
    					<div class="col-xs-4">
    						<select id="months" name="months" class="form-control">
    							<option value="">-</option>
    							{foreach from=$months key=k item=month}
    								<option value="{$k|escape:'htmlall':'UTF-8'}" {if ($sl_month == $k)} selected="selected"{/if}>{l s=$month mod='sociallogin'}&nbsp;</option>
    							{/foreach}
    						</select>
    					</div>
    					<div class="col-xs-4">
    						<select id="years" name="years" class="form-control">
    							<option value="">-</option>
    							{foreach from=$years item=year}
    								<option value="{$year|intval}" {if ($sl_year == $year)} selected="selected"{/if}>{$year|intval}&nbsp;&nbsp;</option>
    							{/foreach}
    						</select>
    					</div>
    				</div>
    			</div>
    			{if isset($newsletter) && $newsletter}
    				<div class="checkbox">
    					<input type="checkbox" name="newsletter" id="newsletter" value="1" {if isset($smarty.post.newsletter) AND $smarty.post.newsletter == 1} checked="checked"{/if} />
    					<label for="newsletter">{l s='Sign up for our newsletter!' mod='sociallogin'}</label>
    					{if array_key_exists('newsletter', $field_required)}
    						<sup> *</sup>
    					{/if}
    				</div>
    			{/if}
    			{if isset($optin) && $optin}
    				<div class="checkbox">
    					<input type="checkbox" name="optin" id="optin" value="1" {if isset($smarty.post.optin) AND $smarty.post.optin == 1} checked="checked"{/if} />
    					<label for="optin">{l s='Receive special offers from our partners!' mod='sociallogin'}</label>
    					{if array_key_exists('optin', $field_required)}
    						<sup> *</sup>
    					{/if}
    				</div>
    			{/if}
    		</div>
    		{if $b2b_enable}
    			<div class="account_creation col-xs-12">
    				<h3 class="page-subheading">{l s='Your company information' mod='sociallogin'}</h3>
    				<p class="form-group col-md-6">
    					<label for="">{l s='Company' mod='sociallogin'}</label>
    					<input
                        type="text"
                        class="form-control"
                        id="company"
                        name="company"
                        value="{if isset($smarty.post.company)}{$smarty.post.company|escape:'htmlall':'UTF-8'}{/if}" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="siret">{l s='SIRET' mod='sociallogin'}</label>
    					<input
                        type="text"
                        class="form-control"
                        id="siret"
                        name="siret"
                        value="{if isset($smarty.post.siret)}{$smarty.post.siret|escape:'htmlall':'UTF-8'}{/if}" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="ape">{l s='APE' mod='sociallogin'}</label>
    					<input
                        type="text"
                        class="form-control"
                        id="ape"
                        name="ape"
                        value="{if isset($smarty.post.ape)}{$smarty.post.ape|escape:'htmlall':'UTF-8'}{/if}" />
    				</p>
    				<p class="form-group col-md-6">
    					<label for="website">{l s='Website' mod='sociallogin'}</label>
    					<input
                        type="text"
                        class="form-control"
                        id="website"
                        name="website"
                        value="{if isset($smarty.post.website)}{$smarty.post.website|escape:'htmlall':'UTF-8'}{/if}" />
    				</p>
    			</div>
    		{/if}
            {$HOOK_CREATE_ACCOUNT_FORM} {* HTML CONTENT *}
    		<div class="submit clearfix">
    			<input type="hidden" name="email_create" value="1" />
    			<input type="hidden" name="is_new_customer" value="1" />
    			{if isset($back)}<input type="hidden" class="hidden" name="back" value="{$back|escape:'htmlall':'UTF-8'}" />{/if}
    			<button type="submit" name="submitAccount" id="submitAccount" class="btn btn-default button button-medium">
    				<span>{l s='Register' mod='sociallogin'}<i class="fa fa-chevron-right right"></i></span>
    			</button>
    			<p class="pull-right required"><span><sup>*</sup>{l s='Required field' mod='sociallogin'}</span></p>
    		</div>
        </form>
        <button class="btn btn-primary" onclick="window.history.back();"><i class="fa fa-chevron-left left"></i> {l s='Back' mod='sociallogin'}</button>
    {/if}
{else}
    {if !isset($network) && !isset($id_user) && isset($positions) && is_array($positions) && in_array('authentication', $positions)}
        <div class="box clearfix col-xs-12 col-sm-12">
        	<h2 class="page-subheading">{l s='Register or login with your account:' mod='sociallogin'}</h2>
        	<div class="col-xs-12 col-sm-12">
                {hook h="displaySocialLoginButtons"}
        	</div>
        </div>
        <div class="col-xs-12">
            <div class="or-container">
                <hr class="or-hr" />
                <div class="or img-circle">{l s='or' mod='sociallogin'}</div>
            </div>
        </div>
    {/if}
    <!-- / Social Login -->

    {include file="$tpl_dir./authentication.tpl"}
{/if}