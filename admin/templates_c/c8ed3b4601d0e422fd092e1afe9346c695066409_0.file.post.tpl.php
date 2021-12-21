<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:11:53
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a766895d6d75_99328147',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8ed3b4601d0e422fd092e1afe9346c695066409' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/post.tpl',
      1 => 1637670067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.tpl' => 1,
    'file:header.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:category_list_submenu_filter.tpl' => 1,
    'file:post_list_submenu.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a766895d6d75_99328147 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/lukaszjaro/public_html/demo/cms/libs/plugins/function.math.php','function'=>'smarty_function_math',),));
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php $_smarty_tpl->_assignInScope('posts_list', $_smarty_tpl->tpl_vars['posts']->value->postsList($_REQUEST['action'],$_smarty_tpl->tpl_vars['page']->value,$_smarty_tpl->tpl_vars['category']->value));
$_smarty_tpl->_assignInScope('post_all', $_smarty_tpl->tpl_vars['posts']->value->countPosts('post',''));
$_smarty_tpl->_assignInScope('post_trash', $_smarty_tpl->tpl_vars['posts']->value->countPosts('post','trash'));
$_smarty_tpl->_assignInScope('post_element_no', $_smarty_tpl->tpl_vars['posts']->value->elementNo());
if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['posts'];?>
 <a href="post.php?action=add"><?php echo $_smarty_tpl->tpl_vars['lang']->value['post_add'];?>
</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<p><a href="post.php"><?php echo $_smarty_tpl->tpl_vars['lang']->value['all'];?>
 (<?php echo $_smarty_tpl->tpl_vars['post_all']->value;?>
)</a> <a href="post.php?action=trash"><?php echo $_smarty_tpl->tpl_vars['lang']->value['trash'];?>
 (<?php echo $_smarty_tpl->tpl_vars['post_trash']->value;?>
)</a></p>
<p><form action="post.php" method="get" onsubmit="if ($('#cat1').val != '') $('#cat2').attr('disabled', 'disabled'); else $('#cat1').attr('disabled', 'disabled');"><?php echo $_smarty_tpl->tpl_vars['lang']->value['filter'];?>
: <select name="category" id="cat1">
<option value=""><?php echo $_smarty_tpl->tpl_vars['lang']->value['select'];?>
</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value->categoryList(), 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['a']->value['id'] == $_smarty_tpl->tpl_vars['category']->value) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['a']->value['title'];?>
</option>
<?php if ($_smarty_tpl->tpl_vars['a']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:category_list_submenu_filter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['a']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select>
<input type="hidden" name="category" value="<?php echo $_smarty_tpl->tpl_vars['category']->value;?>
" id="cat2" /> 
<input type="hidden" name="page" value="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
" /> 
<input type="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['submit'];?>
" name="submit" class="button" />
</form>
</p>
<table>
<tr>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['title'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['date_modified'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['categories'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['order'];?>
</th>
</tr>
<?php if (count($_smarty_tpl->tpl_vars['posts_list']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts_list']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
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
<a href="post.php?action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/pencil.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['lang']->value['are_you_sure'];?>
')) { execute('post.php?action=<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {?>delete<?php } else { ?>remove<?php }?>&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
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
<?php if ($_smarty_tpl->tpl_vars['a']->value['status'] == 'trash') {?><a href="javascript:void(0)" onclick=" execute('post.php?action=restore&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
','restore','post-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
');"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/revert.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['restore'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['restore'];?>
</a><?php }?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['modified'];?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['posts']->value->categoryListText($_smarty_tpl->tpl_vars['a']->value['id']);?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['posts']->value->getAuthor($_smarty_tpl->tpl_vars['a']->value['author']);?>
</td>
<td style="text-align:center;"><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/post.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=up" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/up.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
" /></a><form action="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/post.php?subaction=position" method="post"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
" /><input type="text" name="position" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['order'];?>
" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/post.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=down" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/down.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
" /></a>
</td>
</tr>
<?php if ($_smarty_tpl->tpl_vars['a']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:post_list_submenu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['a']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
</table>
<?php echo smarty_function_math(array('equation'=>"ceil(".((string)$_smarty_tpl->tpl_vars['post_all']->value)." / ".((string)$_smarty_tpl->tpl_vars['post_element_no']->value).")",'assign'=>'pages'),$_smarty_tpl);?>

<?php if ($_smarty_tpl->tpl_vars['pages']->value > 0) {?>
<div class="pagination"><?php echo $_smarty_tpl->tpl_vars['lang']->value['page'];?>
: 
<?php
$__section_nazwa_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['pages']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_nazwa_0_total = $__section_nazwa_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_nazwa'] = new Smarty_Variable(array());
if ($__section_nazwa_0_total !== 0) {
for ($_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration'] = 1, $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['index'] = 0; $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration'] <= $__section_nazwa_0_total; $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration']++, $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['index']++){
?>
<a href="post.php?page=<?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration'] : null);?>
&category=<?php echo $_smarty_tpl->tpl_vars['category']->value;?>
" class="number"><?php echo (isset($_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_section_nazwa']->value['iteration'] : null);?>
</a> 
<?php
}
}
?>
</div>
<?php }?>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$('#menu-posts').addClass('current');
$('#menu-posts-list').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
