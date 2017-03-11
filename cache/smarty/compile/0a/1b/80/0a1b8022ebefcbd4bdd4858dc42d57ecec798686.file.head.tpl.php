<?php /* Smarty version Smarty-3.1.19, created on 2017-02-01 11:32:26
         compiled from "/var/www/html/modules/blockblog/views/templates/hooks/head.tpl" */ ?>
<?php /*%%SmartyHeaderCode:743930095891c74a4cd3b5-13199768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a1b8022ebefcbd4bdd4858dc42d57ecec798686' => 
    array (
      0 => '/var/www/html/modules/blockblog/views/templates/hooks/head.tpl',
      1 => 1475588147,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '743930095891c74a4cd3b5-13199768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'blockblogis_blog' => 0,
    'blockblogname' => 0,
    'blockblogimg' => 0,
    'base_dir_ssl' => 0,
    'blockblogis_cloud' => 0,
    'blockblogis15' => 0,
    'blockblogis_ps14' => 0,
    'blockblogrsson' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_5891c74a507111_80945482',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5891c74a507111_80945482')) {function content_5891c74a507111_80945482($_smarty_tpl) {?>

<?php if ($_smarty_tpl->tpl_vars['blockblogis_blog']->value!=0) {?>
    <meta property="og:title" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogname']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
    <?php if (strlen($_smarty_tpl->tpl_vars['blockblogimg']->value)>0) {?>
        <meta property="og:image" content="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
<?php if ($_smarty_tpl->tpl_vars['blockblogis_cloud']->value==1) {?>modules/blockblog/upload/<?php } else { ?>upload/blockblog/<?php }?><?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['blockblogimg']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"/>
    <?php }?>
    <meta property="og:type" content="product"/>
<?php }?>
<!-- Module Blog for PrestaShop -->
<?php if ($_smarty_tpl->tpl_vars['blockblogis15']->value==0) {?>
    <link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/css/blog.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/css/blog15.css" rel="stylesheet" type="text/css" media="all" />
    <link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/css/font-custom.min.css" rel="stylesheet" type="text/css" media="all" />
    <script type="text/javascript" src="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/js/blog.js"></script>

<?php }?>
<?php if ($_smarty_tpl->tpl_vars['blockblogis_ps14']->value==1) {?>
    <link href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/views/css/blog14.css" rel="stylesheet" type="text/css" media="all" />
<?php }?>

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


<?php if ($_smarty_tpl->tpl_vars['blockblogrsson']->value==1) {?>
<link rel="alternate" type="application/rss+xml" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['base_dir_ssl']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
modules/blockblog/rss.php" />
<?php }?>
<!-- Module Blog for PrestaShop -->
<?php }} ?>
