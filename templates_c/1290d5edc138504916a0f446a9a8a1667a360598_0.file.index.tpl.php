<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:15:10
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7674ebde9f9_27422608',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1290d5edc138504916a0f446a9a8a1667a360598' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/index.tpl',
      1 => 1637930968,
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
function content_61a7674ebde9f9_27422608 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->assign('post',$_smarty_tpl->smarty->registered_objects['posts'][0]->post(array('id'=>11),$_smarty_tpl));?>

		<div id="page">
			<div id="content">
				<h2><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
 <span><?php echo $_smarty_tpl->tpl_vars['lang']->value['date'];?>
: <?php echo $_smarty_tpl->tpl_vars['post']->value['created'];?>
, <?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
: <?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getAuthor(array('id'=>$_smarty_tpl->tpl_vars['post']->value['author']),$_smarty_tpl);?>
</span></h2>
				<div class="hr"></div>
				<?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>

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
