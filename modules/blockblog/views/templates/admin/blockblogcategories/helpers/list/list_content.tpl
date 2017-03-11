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

{extends file="helpers/list/list_content.tpl"}
    {block name="td_content"}
        {if isset($params.type_custom) && $params.type_custom == 'title_category'}
            {if isset($tr[$key])}
                <span class="label-tooltip" data-original-title="{l s='Click here to see blog category on your site' mod='blockblog'}" data-toggle="tooltip">

                    <a href="
                    {if $params.is_rewrite == 0}
                        {$link->getModuleLink('blockblog', 'category', [], true, {$tr.id_lang|escape:'htmlall':'UTF-8'}, {$tr.id_shop|escape:'htmlall':'UTF-8'})|escape:'htmlall':'UTF-8'}?category_id={$tr['id']|escape:'htmlall':'UTF-8'}
                    {else}
                        {$params.base_dir_ssl|escape:'htmlall':'UTF-8'}{$params.iso_code|escape:'htmlall':'UTF-8'}blog/category/{$tr.seo_url|escape:'htmlall':'UTF-8'}
                    {/if}
                    "
                       style="text-decoration:underline" target="_blank">
                        {$tr[$key]|escape:'htmlall':'UTF-8'}
                    </a>
                </span>
            {/if}

        {elseif isset($params.type_custom) && $params.type_custom == 'is_active'}

            <span id="activeitem{$tr['id']|escape:'htmlall':'UTF-8'}">
                    <span class="label-tooltip" data-original-title="{l s='Click here to activate or deactivate category on your site' mod='blockblog'}" data-toggle="tooltip">
                    <a href="javascript:void(0)" onclick="blockblog_list({$tr['id']|escape:'htmlall':'UTF-8'},'active',{$tr[$key]|escape:'htmlall':'UTF-8'},'category');" style="text-decoration:none">
                        <img src="../img/admin/../../modules/blockblog/views/img/{if $tr[$key] == 1}ok.gif{else}no_ok.gif{/if}"  />
                    </a>
                </span>
            </span>

        {else}
            {$smarty.block.parent}
        {/if}


    {/block}