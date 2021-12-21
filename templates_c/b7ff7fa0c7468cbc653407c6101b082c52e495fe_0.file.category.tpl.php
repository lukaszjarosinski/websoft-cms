<?php
/* Smarty version 4.0.0, created on 2021-12-01 12:09:05
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/category.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a757d13ca1d8_14878116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b7ff7fa0c7468cbc653407c6101b082c52e495fe' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/category.tpl',
      1 => 1638355404,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:sidebar.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_61a757d13ca1d8_14878116 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/lukaszjaro/public_html/demo/cms/libs/plugins/function.math.php','function'=>'smarty_function_math',),));
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->assign('posts_list',$_smarty_tpl->smarty->registered_objects['posts'][0]->getPosts(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['id'],'p2'=>$_smarty_tpl->tpl_vars['page']->value),$_smarty_tpl));?>

		<div id="page">
			<div id="content">
				<h2><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
</h2>
				<?php if (count((($tmp = $_smarty_tpl->tpl_vars['posts_list']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp)) > 0) {?>
				<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts_list']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
				<div class="post">
				<h3><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;
echo $_smarty_tpl->tpl_vars['langcode']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['a']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['a']->value['title'];?>
</a> <span><?php echo $_smarty_tpl->tpl_vars['lang']->value['written'];?>
: <?php echo $_smarty_tpl->tpl_vars['a']->value['created'];?>
, <?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
: <?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getAuthor(array('p1'=>$_smarty_tpl->tpl_vars['a']->value['author']),$_smarty_tpl);?>
</h3>
				<div><?php echo $_smarty_tpl->tpl_vars['a']->value['text'];?>
</div>
				<br /><br />
				</div>
				<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
				<?php $_smarty_tpl->assign('pageNo',$_smarty_tpl->smarty->registered_objects['posts'][0]->pageNo(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['id']),$_smarty_tpl));?>

				<?php if ($_smarty_tpl->tpl_vars['pageNo']->value > 1) {?>
				<div class="paginacja">
				<?php if ($_smarty_tpl->tpl_vars['page']->value > 1) {?><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;
echo $_smarty_tpl->tpl_vars['langcode']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/<?php echo smarty_function_math(array('equation'=>"x - y",'x'=>$_smarty_tpl->tpl_vars['page']->value,'y'=>1),$_smarty_tpl);?>
" class="prev"><?php echo $_smarty_tpl->tpl_vars['lang']->value['last'];?>
</a><?php }?>
				<?php if ($_smarty_tpl->tpl_vars['page']->value < 'pageNo') {?><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;
echo $_smarty_tpl->tpl_vars['langcode']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['slug']->value;?>
/<?php echo smarty_function_math(array('equation'=>"x + y",'x'=>$_smarty_tpl->tpl_vars['page']->value,'y'=>1),$_smarty_tpl);?>
" class="next"><?php echo $_smarty_tpl->tpl_vars['lang']->value['next'];?>
</a><?php }?>
				</div>
				<?php }?>
				<?php } else { ?>
				<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['not_found'];?>
</h3>
				<?php }?>
			</div>
			<div id="sidebar">
				<?php $_smarty_tpl->_subTemplateRender("file:sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
			</div>
		</div>
	</div>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
