{*
*  * 2007-2014 PrestaShop
*  ************************************************************************************************************
*  * DISCLAIMER
*  ************************************************************************************************************
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2014 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*  ************************************************************************************************************
*  * ELATION ADVANCE TOUCH THEME
*  * (d) elation3ase theme development
*  * (c) 2014 Elation Base, LLC
*  * (i) elationbase.com | elationbase@gmail.com
*  * See theme's licence agreement at the theme root folder (licence.txt)
*  ************************************************************************************************************
*  * (i) Do not edit this file if you wish to upgrade PrestaShop or this Theme to newer versions in the future.
*  ************************************************************************************************************
*}

<!DOCTYPE HTML>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7 " lang="{$lang_iso}"><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8 ie7" lang="{$lang_iso}"><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9 ie8" lang="{$lang_iso}"><![endif]-->
<!--[if gt IE 8]> <html class="no-js ie9" lang="{$lang_iso}"><![endif]-->
<html lang="{$lang_iso}">
	<head>
		<meta charset="utf-8" />
		<title>{$meta_title|escape:'html':'UTF-8'}</title>
{if isset($meta_description) AND $meta_description}
		<meta name="description" content="{$meta_description|escape:'html':'UTF-8'}" />
{/if}
{if isset($meta_keywords) AND $meta_keywords}
		<meta name="keywords" content="{$meta_keywords|escape:'html':'UTF-8'}" />
{/if}
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,{if isset($nofollow) && $nofollow}no{/if}follow" />
		<meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$favicon_url}?{$img_update_time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$favicon_url}?{$img_update_time}" />
{if isset($css_files)}
	{foreach from=$css_files key=css_uri item=media}
		<link rel="stylesheet" href="{$css_uri}" type="text/css" media="{$media}" />
	{/foreach}
{/if}
		<link rel="stylesheet" href="{$css_dir}elation-base.css" type="text/css" media="{$media}" />
		<link rel="stylesheet" href="{$css_dir}../font/eb-font.css" type="text/css" media="{$media}" />

		{if isset($js_defer) && !$js_defer && isset($js_files) && isset($js_def)}
			{$js_def}
			{foreach from=$js_files item=js_uri}
			<script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
			{/foreach}
		{/if}
		{$HOOK_HEADER}
		{if isset($ebThemeRender)}
			{$ebThemeRender}
		{/if}
		<!--[if IE 8]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

        <link rel="stylesheet" href="/themes/elation-advance-touch/css/modules/welcomescreenvideo/front.css" type="text/css" media="{$media}" />
		<link rel="stylesheet" href="{$css_dir}/modules/blocktopmenu/css/superfish-modified.css" type="text/css" media="{$media}" />
        <script src="/modules/welcomescreenvideo/views/js/front.js"></script>
	</head>
	<body{if isset($page_name)} id="{$page_name|escape:'html':'UTF-8'}"{/if} class="{if isset($page_name)}{$page_name|escape:'html':'UTF-8'}{/if}{if isset($body_classes) && $body_classes|@count} {implode value=$body_classes separator=' '}{/if}{if $hide_left_column} hide-left-column{/if}{if $hide_right_column} hide-right-column{/if}{if $content_only} content_only{/if} lang_{$lang_iso}">
{if $page_name==index || $page_name==product}
<div class="overlay">
<video width="600" height="400" autoplay="" muted="" loop="">
								   <source src="//brainboost.ie/themes/elation-advance-touch/img/flame.mp4" type="video/mp4; codecs=&quot;avc1.42E01E, mp4a.40.2&quot;">
								  </video>
</div>
{/if}

	{if !$content_only}
		{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country}</span></p>
			</div>
		{/if}
		<script>
			if($(window).width()>=600){
			document.getElementById("block_top_menu1").style.display="none";	
				}
			</script>
		<div id="page">
			<div class="header-container">
				<header id="header">
					<div class="banner">
						<div class="container">
							<div class="row">
								{hook h="displayBanner"}
							{if $page_name == 'index' || $page_name=='product'}
							  <div class="row" style='position:relative;background: transparent url("//brainboost.ie/modules/ebhomeblock1/img/8ca754e5e200b58da7f7fe997ce12a05.jpg"); min-height: 872.5px;min-height: 872.5px;background-repeat: no-repeat;background-position: center center;width: 100%;height: 100%;background-size: cover;display: block;'>
							  	<!--<p class="logo_header" style='width:150px;height:150px;position:absolute;left:5%;top:100px;'>
									<a href="http://brainboost_new2/" title="BrainBoost">
										<img class="logo animate" src="http://brainboost_new2/img/europort-logo-1469719481.jpg" alt="BrainBoost"/>
									</a>
								</p>-->
							  	<!--<p class="video_header">

								  <video width="600" height="400" controls="controls" autoplay loop>
								   <source src="//brainboost.ie/themes/elation-advance-touch/BrainBoost Limited-HD.mp4" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
								  </video>

							  	</p>-->
							  </div>
							{/if}
							</div>
						</div>
					</div>
					<!--<div class="topheader">
						<div class="container">
							<div class="row">
							</div>
						</div>
					</div>-->
					<div class="container" id="eb-top">
					

						<div class="row">
							
							<div class="eb-nav">
								{if isset($HOOK_TOP)}{$HOOK_TOP}{/if}
							</div>
					

						
						
						
						</div>
					</div>
				</header>
			</div>
			<div class="columns-container">
				<div id="columns" class="container">
					{if $page_name !='index' && $page_name !='pagenotfound'}
						{include file="$tpl_dir./breadcrumb.tpl"}
					{/if}
					<div class="row">
						<div id="top_column" class="center_column col-xs-12 col-sm-12">{hook h="displayTopColumn"}</div>
					</div>
					<div class="row">
						{if isset($left_column_size) && !empty($left_column_size)}
						<div id="left_column" class="column col-xs-12 col-sm-{$left_column_size|intval}">{$HOOK_LEFT_COLUMN}</div>
						{/if}
						<div id="center_column" class="center_column col-xs-12 col-sm-{12 - $left_column_size - $right_column_size}">
                        <div class="navigation">
                           
                            <div class="col-xs-2 col-sm-2">
                            &nbsp;
                            </div>
                            <div class="col-xs-6 col-sm-6 nav_top_box">
                                   
                                   <div class="col-xs-4 col-sm-4">

										{hook h="displayNav"}

								   </div>
							</div>
						</div>
						<div style="clear:both;"></div>

	{/if}
