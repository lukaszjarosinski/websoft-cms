<?php
/* Smarty version 4.0.0, created on 2021-12-01 12:11:54
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7587abf0f29_94105178',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '024b8d7aa2d17b23acb306c5d027fb8ea098bd26' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/post.tpl',
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
function content_61a7587abf0f29_94105178 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->assign('nextPost',$_smarty_tpl->smarty->registered_objects['posts'][0]->nextPost(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['id']),$_smarty_tpl));?>

<?php $_smarty_tpl->assign('prevPost',$_smarty_tpl->smarty->registered_objects['posts'][0]->prevPost(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['id']),$_smarty_tpl));?>

		<div id="page">
			<div id="content">
				<h2><?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
 <span><?php echo $_smarty_tpl->tpl_vars['lang']->value['written_in'];?>
: <?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->categoryListText(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['id']),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['lang']->value['day'];?>
 <?php echo $_smarty_tpl->tpl_vars['post']->value['created'];?>
. <?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
: <?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getAuthor(array('p1'=>$_smarty_tpl->tpl_vars['post']->value['author']),$_smarty_tpl);?>
</span></h2>
				<div class="hr"></div>
				<?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>

				<div class="never-older"><?php if ($_smarty_tpl->tpl_vars['nextPost']->value) {?><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;
echo $_smarty_tpl->tpl_vars['langcode']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['nextPost']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['nextPost']->value['title'];?>
</a><?php }?> <?php if ($_smarty_tpl->tpl_vars['prevPost']->value) {?><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;
echo $_smarty_tpl->tpl_vars['langcode']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['prevPost']->value['slug'];?>
"><?php echo $_smarty_tpl->tpl_vars['prevPost']->value['title'];?>
</a><?php }?></div>
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
