<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:10:07
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery_categories.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7661f57e078_81704160',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c9241f7f4a9ba5330a7d7d443514a8f6c2b42ec4' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery_categories.tpl',
      1 => 1637670065,
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
function content_61a7661f57e078_81704160 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php $_smarty_tpl->_assignInScope('gallery_categories_list', $_smarty_tpl->tpl_vars['gallery']->value->categoriesList($_REQUEST['action']));
if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['gallery_categories'];?>
 <a href="gallery.php?action=categories_add"><?php echo $_smarty_tpl->tpl_vars['lang']->value['gallery_categories_add'];?>
</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<table>
<tr>
<th><?php echo $_smarty_tpl->tpl_vars['lang']->value['id'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['title'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['author'];?>
</th><th><?php echo $_smarty_tpl->tpl_vars['lang']->value['date_modified'];?>
</th>
</tr>
<?php if (count($_smarty_tpl->tpl_vars['gallery_categories_list']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['gallery_categories_list']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
<tr id="category-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['a']->value['active'] <> '1') {?>  class="draw"<?php }?>>
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
<a href="gallery.php?action=categories_edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/pencil.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['edit'];?>
</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('<?php echo $_smarty_tpl->tpl_vars['lang']->value['are_you_sure'];?>
')) { execute('gallery.php?action=delete_category&amp;id=<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
','delete','category-<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
');}"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
/admin/templates/default/images/icons/cross.png" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['delete'];?>
" /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['delete'];?>
</a>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['gallery']->value->getAuthor($_smarty_tpl->tpl_vars['a']->value['author']);?>
</td>
<td><?php echo $_smarty_tpl->tpl_vars['a']->value['modified'];?>
</td>
</tr>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}?>
</table>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
$('#menu-gallery').addClass('current');
$('#menu-gallery-categories').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
