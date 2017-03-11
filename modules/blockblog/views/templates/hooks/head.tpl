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

{if $blockblogis_blog != 0}
    <meta property="og:title" content="{$blockblogname|escape:'htmlall':'UTF-8'}"/>
    {if strlen($blockblogimg) >0}
        <meta property="og:image" content="{$base_dir_ssl|escape:'htmlall':'UTF-8'}{if $blockblogis_cloud == 1}modules/blockblog/upload/{else}upload/blockblog/{/if}{$blockblogimg|escape:'htmlall':'UTF-8'}"/>
    {/if}
    <meta property="og:type" content="product"/>
{/if}
<!-- Module Blog for PrestaShop -->
{if $blockblogis15 == 0}
    <link href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/css/blog.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/css/blog15.css" rel="stylesheet" type="text/css" media="all" />
    <link href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/css/font-custom.min.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/js/blog.js"></script>

{/if}
{if $blockblogis_ps14 == 1}
    <link href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/views/css/blog14.css" rel="stylesheet" type="text/css" media="all" />
{/if}
{literal}
<script type="text/javascript">
function show_arch(id,column){
	for(i=0;i<100;i++){
		//$('#arch'+i).css('display','none');
		$('#arch'+i+column).hide(200);
	}
	//$('#arch'+id).css('display','block');
	$('#arch'+id+column).show(200);
	
}
</script>
{/literal}

{if $blockblogrsson == 1}
<link rel="alternate" type="application/rss+xml" href="{$base_dir_ssl|escape:'htmlall':'UTF-8'}modules/blockblog/rss.php" />
{/if}
<!-- Module Blog for PrestaShop -->
