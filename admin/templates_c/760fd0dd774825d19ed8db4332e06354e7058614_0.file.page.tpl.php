<?php
/* Smarty version 4.0.0, created on 2021-12-02 09:24:17
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/page.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a882b1a81b12_79856251',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '760fd0dd774825d19ed8db4332e06354e7058614' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/page.tpl',
      1 => 1637670067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.tpl' => 1,
    'file:header.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:page_list_submenu.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a882b1a81b12_79856251 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php $_smarty_tpl->_assignInScope('pages_list', $_smarty_tpl->tpl_vars['posts']->value->pagesList($_REQUEST['action']));
$_smarty_tpl->_assignInScope('level', 0);
$_smarty_tpl->_assignInScope('post_all', $_smarty_tpl->tpl_vars['posts']->value->countPosts('page',''));
$_smarty_tpl->_assignInScope('post_trash', $_smarty_tpl->tpl_vars['posts']->value->countPosts('page','trash'));
if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['pages'];?>
 <a href="page.php?action=add"><?php echo $_smarty_tpl->tpl_vars['lang']->value['page_add'];?>
</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<p><a href="page.php"><?php echo $_smarty_tpl->tpl_vars['lang']->value['all'];?>
 (<?php echo $_smarty_tpl->tpl_vars['post_all']->value;?>
)</a> <a href="page.php?action=trash"><?php echo $_smarty_tpl->tpl_vars['lang']->value['trash'];?>
 (<?php echo $_smarty_tpl->tpl_vars['post_trash']->value;?>
)</a></p>
<table>
<tr>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['title'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['date_modified'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['order'];?>
</th>
</tr>
<?php if (count($_smarty_tpl->tpl_vars['pages_list']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['pages_list']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
$_smarty_tpl->_assignInScope('level', 0);?>
<tr id="post-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] <> '') {?>  class="<?php echo $_smarty_tpl->tpl_vars['a']->value['status'];?>
"<?php }?>>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['title'];?>
 (<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['installed_languages']->value, 'b');
$_smarty_tpl->tpl_vars['b']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->do_else = false;
if ($_smarty_tpl->tpl_vars['a']->value['lang'] == $_smarty_tpl->tpl_vars['b']->value['lang']) {
echo $_smarty_tpl->tpl_vars['b']->value['name'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
)<br />
<a href="page.php?action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/pencil.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['lang']->value['are_you_sure'];?>
')) { execute('page.php?action=<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {?>delete<?php } else { ?>remove<?php }?>&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
','<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {?>delete<?php } else { ?>remove<?php }?>','post-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
');}"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/cross.png" alt="<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {
echo $_smarty_tpl->tpl_vars['lang']->value['delete'];
} else {
echo $_smarty_tpl->tpl_vars['lang']->value['remove'];
}?>" /> <?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {
echo $_smarty_tpl->tpl_vars['lang']->value['delete'];
} else {
echo $_smarty_tpl->tpl_vars['lang']->value['remove'];
}?></a>
<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {?><a href="javascript:void(0)" onclick=" execute('page.php?action=restore&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
','restore','post-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/revert.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['restore'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['restore'];?>
</a><?php }?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['modified'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['posts']->value->getAuthor($_smarty_tpl->tpl_vars['a']->value['author']);?>
</td>
<td style="text-align:center;"><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=up" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/up.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
" /></a><form action="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php?subaction=position" method="post"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
" /><input type="text" name="position" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['order'];?>
" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=down" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/down.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
" /></a>
</td>
</tr>
<?php if ($_smarty_tpl->tpl_vars['a']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:page_list_submenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['a']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
</table>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$('#menu-pages').addClass('current');
$('#menu-pages-list').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
