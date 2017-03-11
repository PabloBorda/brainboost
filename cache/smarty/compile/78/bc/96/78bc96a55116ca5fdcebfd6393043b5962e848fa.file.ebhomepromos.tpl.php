<?php /* Smarty version Smarty-3.1.19, created on 2017-02-28 16:49:52
         compiled from "/home/brainboo/public_html/themes/elation-advance-touch/modules/ebhomepromos/views/templates/hook/ebhomepromos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:11318916758b5aa30e31078-34229474%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '78bc96a55116ca5fdcebfd6393043b5962e848fa' => 
    array (
      0 => '/home/brainboo/public_html/themes/elation-advance-touch/modules/ebhomepromos/views/templates/hook/ebhomepromos.tpl',
      1 => 1486138161,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '11318916758b5aa30e31078-34229474',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'page_name' => 0,
    'ebhomepromos_slides' => 0,
    'slide' => 0,
    'link' => 0,
    'ebhomepromos' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.19',
  'unifunc' => 'content_58b5aa30f2aea6_68213442',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_58b5aa30f2aea6_68213442')) {function content_58b5aa30f2aea6_68213442($_smarty_tpl) {?>
<?php if ($_smarty_tpl->tpl_vars['page_name']->value=='index') {?>
    <!-- Module EbHomePromos -->
    <?php if (isset($_smarty_tpl->tpl_vars['ebhomepromos_slides']->value)) {?>
        <br><br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Latest news:</b><br>
        <div id="ebhomepromos-slider">
            <ul id="ebhomepromos">
                <?php  $_smarty_tpl->tpl_vars['slide'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['slide']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ebhomepromos_slides']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['slide']->key => $_smarty_tpl->tpl_vars['slide']->value) {
$_smarty_tpl->tpl_vars['slide']->_loop = true;
?>
                    <?php if ($_smarty_tpl->tpl_vars['slide']->value['active']) {?>
                        <li class="ebhomepromos-container" onmouseover='$("#ebhomepromos-container-header<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
").hide();' onmouseout='$("#ebhomepromos-container-header<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
").show();'>
                        	<img src="<?php echo $_smarty_tpl->tpl_vars['link']->value->getMediaLink("/upload/blockblog/".((string)mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['image'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8')));?>
" alt="<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" class="animate-fast" />
                        	<div class="ebhomepromos-container-header" id="ebhomepromos-container-header<?php echo mb_convert_encoding(htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true), "HTML-ENTITIES", 'UTF-8');?>
" > <h4><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
</a></h4></div>
                            <?php if (isset($_smarty_tpl->tpl_vars['slide']->value['description'])&&trim($_smarty_tpl->tpl_vars['slide']->value['description'])!='') {?>
                                <div class="ebhomepromos-description animate-fast">
                                	<h4><a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo $_smarty_tpl->tpl_vars['slide']->value['title'];?>
</a></h4>
                                	<p><?php echo $_smarty_tpl->tpl_vars['slide']->value['description'];?>
</p>
                                    <?php if (isset($_smarty_tpl->tpl_vars['slide']->value['url'])) {?>
                                        <a class="btn" href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['url'], ENT_QUOTES, 'UTF-8', true);?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['slide']->value['legend'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo smartyTranslate(array('s'=>'Learn more','mod'=>'ebhomepromos'),$_smarty_tpl);?>
</a>
                                    <?php }?>
                                </div>
                            <?php }?>
                        </li>
                    <?php }?>
                <?php } ?>
            </ul>
        </div>
        <?php if (isset($_smarty_tpl->tpl_vars['ebhomepromos']->value)) {?>
                <?php if (count($_smarty_tpl->tpl_vars['ebhomepromos_slides']->value)>1) {?>
                    <?php if ($_smarty_tpl->tpl_vars['ebhomepromos']->value['loop']==1) {?>
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_loop'=>true),$_smarty_tpl);?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_loop'=>false),$_smarty_tpl);?>

                    <?php }?>
                <?php } else { ?>
                    <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_loop'=>false),$_smarty_tpl);?>

                <?php }?>
                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_width'=>$_smarty_tpl->tpl_vars['ebhomepromos']->value['width']),$_smarty_tpl);?>

                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_speed'=>$_smarty_tpl->tpl_vars['ebhomepromos']->value['speed']),$_smarty_tpl);?>

                <?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['addJsDef'][0][0]->addJsDef(array('ebhomepromos_pause'=>$_smarty_tpl->tpl_vars['ebhomepromos']->value['pause']),$_smarty_tpl);?>

        <?php }?>
    <?php }?>
    <!-- /Module EbHomePromos -->
<?php }?>
<?php }} ?>
