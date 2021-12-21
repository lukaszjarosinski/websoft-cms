<?php
/* Smarty version 4.0.0, created on 2021-12-01 11:54:42
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a75472b99db1_95999870',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9d1a3e6322c453e5aa854c92b6ed1991f5e5bc8e' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/page.tpl',
      1 => 1637670062,
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
function content_61a75472b99db1_95999870 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
		<div id="page">
			<div id="content">
				<h2><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
 <span><?php echo $_smarty_tpl->tpl_vars['lang']->value['date'];?>
: <?php echo $_smarty_tpl->tpl_vars['post']->value['created'];?>
, <?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
: <?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getAuthor(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['author']),$_smarty_tpl);?>
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
