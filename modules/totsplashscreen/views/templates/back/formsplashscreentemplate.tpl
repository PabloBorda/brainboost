<script type="text/javascript">
	var iso = '{$isoTinyMCE}';
	var pathCSS = '{$_THEME_CSS_DIR_}';
	var ad = '{$ad}';
</script>
{include file='./multilangform/js.tpl'}
<script type="text/javascript">id_language = Number({$defaultLanguage});</script>
<h2>{l s='module totSplashScreen' mod='totsplashscreen'}</h2>
<fieldset class="width6">
	<legend><img src="{$path}logo.gif">{l s='Settings for totSplashScreen' mod='totsplashscreen'}</legend>
	<form method="post" action="{$url}" enctype="multipart/form-data">

		<label for="name">{l s='Template\'s name' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="text" value="{$name}" id="name" name="name">
		</div>
		<div class="clear both"></div>

		<label for="fan_page">{l s='Display Facebook page zone ?' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="checkbox" id="fan_page" name="fan_page" onClick=" javascript:$('.fanpage').toggle();" style="margin-top:3px;" {$checked}>
		</div>
		<div class="clear both"></div>

		<div class="fan_page_toggle">
			<label for="fan_page_url">{l s='Facebook Fan Page link' mod='totsplashscreen'}</label>
			<div class="margin-form">
				<div>
					<input type="text" id="fan_page_url" name="fan_page_url" size="64" value="{$totsplashscreen_fan_page_url}" >
				</div>
				<p class="preference_description">{l s='Fan page full URL, example : https://www.facebook.com/pages/Exclu-Mariagecom/103202581933' mod='totsplashscreen'}</p>
			</div>
			<div class="clear both"></div>
		</div>

		<label for="newsletter">{l s='Display Newsletter zone' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<div>
				<input type="checkbox" id="newsletter" name="newsletter" {$checked_newsletter}>
			</div>
			<p class="preference_description">
				{l s='Blocknewsletter module must be installed' mod='totsplashscreen'} : {$txt}
			</p>
		</div>
		<div class="clear both"></div>

		<label for="">{l s='Message before central zone' mod='totsplashscreen'}</label>
		<div class="margin-form">
			{if $create}
				{include file='./multilangform/textarea.tpl' textareaname='message' value=''}
			{else}
				{include file='./multilangform/textarea.tpl' textareaname='message' value=$message}
			{/if}
		</div>
		<div class="clear both"></div>

		<label for="width">{l s='Width of the popup' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="text" value="{$width}" id="width" name="width">px
		</div>
		<div class="clear both"></div>

		<label for="height">{l s='Height of the popup' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="text" value="{$height}" id="height" name="height">px
		</div>
		<div class="clear both"></div>

		<label for="backgroundColor">{l s='Background color of the popup' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="text" value="{$backgroundColor}" id="backgroundColor" name="backgroundColor">
		</div>
		<div class="clear both"></div>

		<label for="opacity">{l s='Opacity of layer' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="text" value="{$opacity}" id="opacity" name="opacity">
			<p class="preference_description">
				{l s='value between 0 and 100' mod='totsplashscreen'}
			</p>
		</div>
		<div class="clear both"></div>

		<label>{l s='Permission mode' mod='totsplashscreen'}</label>
		<div class="margin-form">
			<input type="radio" name="permission_mode" value="1" {if $permission_mode == 1} checked {/if}>{l s='Yes'}&nbsp;&nbsp;&nbsp;
			<input type="radio" name="permission_mode" value="0" {if $permission_mode == 0} checked {/if}>{l s='No'}<br>
			<p class="preference_description">
				{l s='Two buttons "Coming in" and "Leave" will appear in the centre of the popup if permission mode is enabled' mod='totsplashscreen'}
			</p>
		</div>
		<div class="clear both"></div>
		
		<div class="permission_toggle">
			<label for="permission_redirect">{l s='Redirection address' mod='totsplashscreen'}</label>
			<div class="margin-form">
				<input type="text" name="permission_redirect" id="permission_redirect" value="{$permission_redirect}">
			</div>
			<div class="clear both"></div>

			<label for="image_enter">{l s='Enter image' mod='totsplashscreen'}</label>
			<div class="margin-form">
				<input type="file" name="image_enter" id="image_enter">
			</div>
			<div class="clear both"></div>

			<label for="image_leave">{l s='Leave image' mod='totsplashscreen'}</label>
			<div class="margin-form">
				<input type="file" name="image_leave" id="image_leave">
			</div>
			<div class="clear both"></div>
		</div>

		<div class="margin-form">
			{if isset($id)}
				<input type="hidden" name="idtemplate" value="{$id}">
			{else}
				<input type="hidden" name="newTemplateForm" value="1">
			{/if}
			<input type="submit" class="button">	
			<a href="{$url}">
				<input type="button" class="button" value="{l s='Go back to module' mod='totsplashscreen'}">
			</a>	
		</div>
		<div class="clear both"></div>


	</form>
</fieldset>
<script type="text/javascript">
	function delcookie() {
		var date = new Date();
		date.setTime(date.getTime());
		var expires = "; expires=" + date.toGMTString();
		document.cookie = "totSplashScreen=view" + expires + "; path=' . $url . '";
		document.cookie = "totsplashscreen_count_page=1" + expires + "; path=' . $url . '";
		alert("{l s='Cookie deleted, please refresh homepage to display Splash Screen again' mod='totsplashscreen'}");
	}

	$(function(){
		
		$('input[name=permission_mode]').click(function(){
			var val = $(this).val();
			if (val == 1) {
				$('.permission_toggle').slideDown();
			}
			else {
				$('.permission_toggle').slideUp();	
			}
		});

		$('#fan_page').click(function(){
			if ($(this).is(':checked')) {
				$('.fan_page_toggle').slideDown();
			}
			else {
				$('.fan_page_toggle').slideUp();
			}
		});

		$('input[name=permission_mode]:checked').click();

		if (!$('#fan_page').is(':checked')) {
			$('.fan_page_toggle').slideUp();
		}
	});
</script>
<br >
<fieldset class="width6">
	<legend><img src="{$path}logo.gif">{l s='Help' mod='totsplashscreen'}</legend>
	<p>
		- {l s='You can use as much as you want a template for create a Splash Screen.' mod='totsplashscreen'}<br >
		- {l s='If you display the facebook and newsletter zones with a dark background color for the popup, you can modify the color of the text only by CSS.' mod='totsplashscreen'}<br >
		- {l s='For add a video from Youtube for example, you have to copy/paste the embeded code of the video in the text editor which is displayed when you click to the button \"HTML\"' mod='totsplashscreen'}<br >
		- {l s='If you set the opacity with a value of 100, your customers won\'t be able to see other thing than your popup. It is really useful when you want to hide the page displayed and enable the permission mode.' mod='totsplashscreen'}<br >
		- {l s='For personnalize the buttons \"Enter\" and \"Leave\", you can add an image for each.' mod='totsplashscreen'} <br >
		- {l s='For newsletter subscription parameters, please check the bloc newsletter settings page :' mod='totsplashscreen'} <a style="text-decoration:underline;" target="_blank" href="{$url}&configure=blocknewsletter&tab_module=front_office_features&module_name=blocknewsletter">{l s='here' mod='totsplashscreen'}</a> <br >
	</p>
</fieldset>