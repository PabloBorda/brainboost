{*
/**
 * StorePrestaModules SPM LLC.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 *
 /*
 *
 * @author    StorePrestaModules SPM
 * @category content_management
 * @package blockblog
 * @copyright Copyright StorePrestaModules SPM
 * @license   StorePrestaModules SPM
 */
*}

{extends file="helpers/form/form.tpl"}
{block name="field"}
	{if $input.type == 'item_date'}

        <div class="row">
            <div class="input-group col-lg-4">
                <input id="{if isset($input.id)}{$input.id|escape:'htmlall':'UTF-8'}{else}{$input.name|escape:'htmlall':'UTF-8'}{/if}"
                       type="text" data-hex="true"
                       {if isset($input.class)}class="{$input.class}"
                       {else}class="item_datepicker"{/if} name="time_add" value="{$input.time_add|escape:'html':'UTF-8'}" />
                <span class="input-group-addon"><i class="icon-calendar-empty"></i></span>
            </div>
        </div>

    {literal}

        <script type="text/javascript">
            $('document').ready( function() {

                var dateObj = new Date();
                var hours = dateObj.getHours();
                var mins = dateObj.getMinutes();
                var secs = dateObj.getSeconds();
                if (hours < 10) { hours = "0" + hours; }
                if (mins < 10) { mins = "0" + mins; }
                if (secs < 10) { secs = "0" + secs; }
                var time = " "+hours+":"+mins+":"+secs;

                if ($(".item_datepicker").length > 0)
                    $(".item_datepicker").datepicker({prevText: '',nextText: '',dateFormat: 'yy-mm-dd'+time});

            });
        </script>
    {/literal}

    {elseif $input.type == 'language_item' || $input.type == 'shop_item'}


        <div class="col-lg-9 margin-form">


            <div class="form-group margin-item-form-top-left">
                <span class="badge">
                {$input.values|escape:'htmlall':'UTF-8'}
                    </span>
            </div>





            {if isset($input.desc) && !empty($input.desc)}
                <p class="help-block">
                    {$input.desc|escape:'htmlall':'UTF-8'}
                </p>
            {/if}
        </div>
    {elseif $input.type == 'item_url'}

        <div class="col-lg-9 margin-form">


            <div class="form-group margin-item-form-top-left">



            {if strlen($input.img)>0}
                <img src="{$input.logo_img_path|escape:'htmlall':'UTF-8'}{$input.img|escape:'htmlall':'UTF-8'}" class="img-thumbnail" style="width: 50px;margin-right:10px"/>
            {/if}

            <span class="label-tooltip" data-original-title="{l s='Click here to see blog post on your site' mod='blockblog'}" data-toggle="tooltip">

                    <span class="badge">
                    <a href="
                    {if $input.is_rewrite == 0}
                        {$link->getModuleLink('blockblog', 'post', [], true, {$input.id_lang|escape:'htmlall':'UTF-8'}, {$input.id_shop|escape:'htmlall':'UTF-8'})|escape:'htmlall':'UTF-8'}?post_id={$input.post_id|escape:'htmlall':'UTF-8'}
                    {else}
                        {$input.base_dir_ssl|escape:'htmlall':'UTF-8'}{$input.iso_code|escape:'htmlall':'UTF-8'}blog/post/{$input.seo_url|escape:'htmlall':'UTF-8'}
                    {/if}
                    " target="_blank"
                       >

                        {if $input.is_rewrite == 0}
                            {$link->getModuleLink('blockblog', 'post', [], true, {$input.id_lang|escape:'htmlall':'UTF-8'}, {$input.id_shop|escape:'htmlall':'UTF-8'})|escape:'htmlall':'UTF-8'}?post_id={$input.post_id|escape:'htmlall':'UTF-8'}
                        {else}
                            {$input.base_dir_ssl|escape:'htmlall':'UTF-8'}{$input.iso_code|escape:'htmlall':'UTF-8'}blog/post/{$input.seo_url|escape:'htmlall':'UTF-8'}
                        {/if}

                    </a>

                    </span>

                </span>

            </div>




            {if isset($input.desc) && !empty($input.desc)}
                <p class="help-block">
                    {$input.desc|escape:'htmlall':'UTF-8'}
                </p>
            {/if}
        </div>
	{else}
		{$smarty.block.parent}
	{/if}
{/block}
