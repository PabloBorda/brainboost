<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:11:07
         compiled from "/home/brainboo/public_html/modules/prestaspeed/views/templates/front/prestaspeed-dash.tpl" */ ?>
<?php /*%%SmartyHeaderCode:120374561458b5a11b3dfbb7-02101657%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '549a840534310cab371988c21b04cf055af7a204' => 
    array (
      0 => '/home/brainboo/public_html/modules/prestaspeed/views/templates/front/prestaspeed-dash.tpl',
      1 => 1486138160,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '120374561458b5a11b3dfbb7-02101657',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'allow_push' => 0,
    'linkpmo' => 0,
    'disc' => 0,
    'pnf' => 0,
    'guest' => 0,
    'pages' => 0,
    'cartsa' => 0,
    'conn' => 0,
    'data' => 0,
    'totsav' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5a11b46d650_05108580',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5a11b46d650_05108580')) {function content_58b5a11b46d650_05108580($_smarty_tpl) {?>      
        <section id="prestaspeed" class="panel widget<?php if ($_smarty_tpl->tpl_vars['allow_push']->value) {?> allow_push<?php }?>">
	<div class="panel-heading">
		<i class="icon-time"></i> <?php echo smartyTranslate(array('s'=>'Data to optimize - Prestaspeed','mod'=>'prestaspeed'),$_smarty_tpl);?>

		<span class="panel-heading-action">
			<a class="list-toolbar-btn" href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" title="<?php echo smartyTranslate(array('s'=>'Configure','mod'=>'prestaspeed'),$_smarty_tpl);?>
">
				<i class="process-icon-configure"></i>
			</a>
			
		</span>
	</div>
	
	<section id="dash_live" class="loading">
		<ul class="data_list_large">
			<li>
				<span class="data_label ">
				<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Discounts:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From expired promotions/vouchers','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
					<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['disc']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
			<li>
				<span class="data_label ">
				<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Pages not found:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From 404 pages not found error','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
					<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['pnf']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
			<li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Guest data:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From all users','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['guest']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
            	<li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Viewed pages:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From all users','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
					<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['pages']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
            	<li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Abandoned carts:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From non register users','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['cartsa']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
            <li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Connection data:','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'From all users','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['conn']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
            <hr />
                <li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Database size','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'Total size of the database','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['data']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
            <hr/>
            <li>
				<span class="data_label ">
					<a  href="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['linkpmo']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
">	<?php echo smartyTranslate(array('s'=>'Total KB saved','mod'=>'prestaspeed'),$_smarty_tpl);?>
</a>
					<small class="text-muted"><br/>
						<?php echo smartyTranslate(array('s'=>'On image compression','mod'=>'prestaspeed'),$_smarty_tpl);?>

					</small>
				</span>
				<span class="data_value2 size_xxl">
				<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['totsav']->value, ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>

				</span>
			</li>
		</ul>
	</section>
	
</section><?php }} ?>
