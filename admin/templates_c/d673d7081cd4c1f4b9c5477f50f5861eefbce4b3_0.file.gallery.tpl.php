<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:08:27
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a765bb31c0f9_96915162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd673d7081cd4c1f4b9c5477f50f5861eefbce4b3' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery.tpl',
      1 => 1638360491,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.tpl' => 1,
    'file:header.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a765bb31c0f9_96915162 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php $_smarty_tpl->_assignInScope('gallery_pictures_list', $_smarty_tpl->tpl_vars['gallery']->value->picturesList($_REQUEST['gallery_id']));
if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['gallery_pictures'];?>
 <a href="gallery.php?action=add"><?php echo $_smarty_tpl->tpl_vars['lang']->value['gallery_pictures_add'];?>
</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<table>
<tr>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['image'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['action'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['date_modified'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['category'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['order'];?>
</th>
</tr>
<?php if (count((($tmp = $_smarty_tpl->tpl_vars['gallery_pictures_list']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp)) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gallery_pictures_list']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
<tr id="picture-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['a']->value['active'] <> '1') {?>  class="draw"<?php }?>>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
</td>
<td>
<?php if (($_smarty_tpl->tpl_vars['a']->value['image'] <> '')) {
$_smarty_tpl->_assignInScope('big_image', ((string)$_smarty_tpl->tpl_vars['gallery_dir']->value).((string)$_smarty_tpl->tpl_vars['a']->value['image']));
$_smarty_tpl->_assignInScope('min_image', ((string)$_smarty_tpl->tpl_vars['gallery_dir']->value).((string)$_smarty_tpl->tpl_vars['min_prefix']->value).((string)$_smarty_tpl->tpl_vars['a']->value['image']));
if (file_exists($_smarty_tpl->tpl_vars['big_image']->value)) {
$_smarty_tpl->_assignInScope('image', $_smarty_tpl->tpl_vars['big_image']->value);
} elseif (file_exists($_smarty_tpl->tpl_vars['min_image']->value)) {
$_smarty_tpl->_assignInScope('image', $_smarty_tpl->tpl_vars['min_image']->value);
}
if (file_exists($_smarty_tpl->tpl_vars['image']->value)) {?><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
images/gallery/<?php if (file_exists($_smarty_tpl->tpl_vars['min_image']->value)) {
echo $_smarty_tpl->tpl_vars['min_prefix']->value;
}
echo $_smarty_tpl->tpl_vars['a']->value['image'];?>
" alt="" /><?php }
}?>
<br /> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['installed_languages']->value, 'b');
$_smarty_tpl->tpl_vars['b']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->do_else = false;
if ($_smarty_tpl->tpl_vars['a']->value['lang'] == $_smarty_tpl->tpl_vars['b']->value['lang']) {
echo $_smarty_tpl->tpl_vars['b']->value['name'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</td>
<td><a href="gallery.php?action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/pencil.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['lang']->value['are_you_sure'];?>
')) { execute('gallery.php?action=delete&amp;iframe=true&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
','delete','picture-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
');}"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/cross.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['delete'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['delete'];?>
</a>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['gallery']->value->getAuthor($_smarty_tpl->tpl_vars['a']->value['author']);?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['modified'];?>
</td>
<td><?php $_smarty_tpl->_assignInScope('category', $_smarty_tpl->tpl_vars['gallery']->value->showCategory($_smarty_tpl->tpl_vars['a']->value['category_id']));?><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?action=categories_edit&id=<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
</a></td>
<td style="text-align:center;"><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=up" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/up.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['up'];?>
" /></a><form action="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?subaction=position" method="post"><input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
" /><input type="text" name="position" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['position'];?>
" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
&subaction=down" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/down.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['down'];?>
" /></a>
</td>
</tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
<tr>
<td colspan="6">
<?php $_smarty_tpl->_assignInScope('gallery_categories', $_smarty_tpl->tpl_vars['gallery']->value->categoriesList());?>
<p><?php if (count((($tmp = $_smarty_tpl->tpl_vars['gallery_pictures_list']->value ?? null)===null||$tmp==='' ? array() ?? null : $tmp)) == 0) {
echo $_smarty_tpl->tpl_vars['lang']->value['category_empty'];
}?> <?php echo $_smarty_tpl->tpl_vars['lang']->value['select_gallery'];?>
</p>
<ul>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gallery_categories']->value, 'x');
$_smarty_tpl->tpl_vars['x']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['x']->value) {
$_smarty_tpl->tpl_vars['x']->do_else = false;
?>
<li><a href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?gallery_id=<?php echo $_smarty_tpl->tpl_vars['x']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['x']->value['title'];?>
</a></li>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</ul>
</td>
</tr>
</table>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$('#menu-gallery').addClass('current');
$('#menu-gallery-list').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
