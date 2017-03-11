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

<ul>
	<li>
		{l s='We recommend use "Only account creation" in "Preferences" > "Customers"' mod='sociallogin'}.
	</li>
	<li>
		{l s='Click on each social network tab to configure the "Api Key" and "Secret Key"' mod='sociallogin'}.
	</li>
	<li>
		{l s='In "Home" tab you can configure style and size of buttons, also position and type of register' mod='sociallogin'}.
	</li>
	<li>
		{l s='Review your "Log" in "Advanced settings" if you want to know if some logged customer have another customer account' mod='sociallogin'}.
	</li>
    <li>
        {l s='After install module, if you need to use navigation bar buttons, change position of hook and positioned it first place' mod='sociallogin'}
    </li>
    <li>
        {l s='If you have a custom module that override order-opc.tpl or authentication.tpl and you want to place our buttons, simply include next line on your template file: ' mod='sociallogin'}
        <code>{literal}{hook h='displaySocialLoginButtons'}{/literal}</code>
    </li>
    <li>
        {l s='You can custom our templates by copying file from "/modules/sociallogin/views/templates/" to "/themes/YOUR_THEME/modules/sociallogin/views/templates/" and modify their content, only for expert users.' mod='sociallogin'}
    </li>
</ul>
<hr />
<a id="screenshots_button" href="#screenshots">
	<button class="btn btn-default">
		<i class="icon-question-sign"></i> {l s='Click here to here some screenshots' mod='sociallogin'}
	</button>
</a>
<div style="display:none">
	<div id="screenshots" class="carousel slide">
		<ol class="carousel-indicators">
			<li data-target="#screenshots" data-slide-to="1" class="active"></li>
			<li data-target="#screenshots" data-slide-to="2"></li> {*Facebook*}
			<li data-target="#screenshots" data-slide-to="3"></li>
			<li data-target="#screenshots" data-slide-to="4"></li> {*Google*}
			<li data-target="#screenshots" data-slide-to="5"></li>
			<li data-target="#screenshots" data-slide-to="6"></li> {*LinkedIn*}
			<li data-target="#screenshots" data-slide-to="7"></li>
			<li data-target="#screenshots" data-slide-to="8"></li> {*Microsoft*}
			<li data-target="#screenshots" data-slide-to="9"></li>
			<li data-target="#screenshots" data-slide-to="9"></li>
			<li data-target="#screenshots" data-slide-to="10"></li> {*Twitter*}
			<li data-target="#screenshots" data-slide-to="11"></li>
			<li data-target="#screenshots" data-slide-to="12"></li> {*Yahoo*}
		</ol>
		<div class="carousel-inner">
			<div class="item active">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/facebook-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Facebook Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/facebook-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Facebook Status
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/google-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Google APIs
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/google-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Google Credentials
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/google-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Google Auth Screen
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/linkedin-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					LinkedIn Authentication
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/linkedin-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					LinkedIn Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/microsoft-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Microsoft Basic Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/microsoft-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Microsoft API Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/microsoft-3.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Microsoft App Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/twitter-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Twitter Details
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/twitter-2.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Twitter Settings
				</div>
				<div class="clear">&nbsp;</div>
			</div>
			<div class="item">
				<img src="{$module_path|escape:'htmlall':'UTF-8'}views/img/yahoo-1.png" style="margin:auto">
				<div style="text-align:center;font-size:1.4em;margin-top:10px;font-weight:700">
					Yahoo General
				</div>
				<div class="clear">&nbsp;</div>
			</div>
		</div>
		<a class="left carousel-control" href="#screenshots" data-slide="prev">
			<span class="icon-prev"></span>
		</a>
		<a class="right carousel-control" href="#screenshots" data-slide="next">
			<span class="icon-next"></span>
		</a>
	</div>
</div>