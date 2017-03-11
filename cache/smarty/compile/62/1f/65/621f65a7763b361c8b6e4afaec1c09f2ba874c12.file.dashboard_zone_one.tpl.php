<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:11:07
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/dashboard_zone_one.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2641664358b5a11b280990-73050046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '621f65a7763b361c8b6e4afaec1c09f2ba874c12' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/modules/sociallogin/views/templates/hook/dashboard_zone_one.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2641664358b5a11b280990-73050046',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'allow_push' => 0,
    'link' => 0,
    'networks' => 0,
    'network' => 0,
    'date_subtitle' => 0,
    'date_format' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5a11b2b9110_14947450',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5a11b2b9110_14947450')) {function content_58b5a11b2b9110_14947450($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/brainboo/public_html/tools/smarty/plugins/modifier.capitalize.php';
?>

<section id="sociallogin" class="panel widget<?php if ($_smarty_tpl->tpl_vars['allow_push']->value) {?> allow_push<?php }?>">
    <div class="panel-heading">
		<i class="icon-time"></i> <?php echo smartyTranslate(array('s'=>'Social Login Registering','mod'=>'sociallogin'),$_smarty_tpl);?>

	</div>
    <section id="_customers" class="loading">
    		<header><i class="icon-user"></i> <?php echo smartyTranslate(array('s'=>'Customers & Social Networks','mod'=>'sociallogin'),$_smarty_tpl);?>
 <span class="subtitle small" id="social-customers-subtitle"></span></header>
    		<ul class="data_list">
    			<li>
    				<span class="data_label"><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminCustomers'), ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smartyTranslate(array('s'=>'New Customers','mod'=>'sociallogin'),$_smarty_tpl);?>
</a></span>
    				<span class="data_value size_md">
    					<span id="social_new_customers"></span>
    				</span>
    			</li>
                <li>
                    <span class="data_label"><?php echo smartyTranslate(array('s'=>'Networks','mod'=>'sociallogin'),$_smarty_tpl);?>
</span>
                    <ul class="data_list_small">
                        <?php  $_smarty_tpl->tpl_vars['network'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['network']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['networks']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['network']->key => $_smarty_tpl->tpl_vars['network']->value) {
$_smarty_tpl->tpl_vars['network']->_loop = true;
?>
            			<li>
            				<span class="data_label"><?php echo smarty_modifier_capitalize(mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['network']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8'));?>
</span>
            				<span class="data_value size_md">
            					<span id="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['network']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
"></span>
            				</span>
            			</li>
                        <?php } ?>
                    </ul>
                </li>
    		</ul>
    	</section>
</section>
<script type="text/javascript">
	date_subtitle = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_subtitle']->value, ENT_QUOTES, 'UTF-8', true);?>
";
	date_format   = "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_format']->value, ENT_QUOTES, 'UTF-8', true);?>
";
</script>

<script type="text/javascript">
    $(document).ready(function() {
    	if (typeof date_subtitle === "undefined")
    		var date_subtitle = '(from %s to %s)';

    	if (typeof date_format === "undefined")
    		var date_format = 'Y-mm-dd';

    	$('#date-start').change(function() {
    		start = Date.parseDate($('#date-start').val(), 'Y-m-d');
    		end = Date.parseDate($('#date-end').val(), 'Y-m-d');
    		$('#social-customers-subtitle').html(sprintf(date_subtitle, start.format(date_format), end.format(date_format)));
    	});

    	$('#date-end').change(function() {
    		start = Date.parseDate($('#date-start').val(), 'Y-m-d');
    		end = Date.parseDate($('#date-end').val(), 'Y-m-d');
    		$('#social-customers-subtitle').html(sprintf(date_subtitle, start.format(date_format), end.format(date_format)));
    	});
    });
</script>
<?php }} ?>
