<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:11:53
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/category_list_submenu_filter.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a76689600500_73826314',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0b9a1a751d1e930656ad9746247c23804fa176f4' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/category_list_submenu_filter.tpl',
      1 => 1638358922,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:category_list_submenu_filter.tpl' => 2,
  ),
),false)) {
function content_61a76689600500_73826314 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('level2', $_smarty_tpl->tpl_vars['level']->value);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['a']->value, 'b');
$_smarty_tpl->tpl_vars['b']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->do_else = false;
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level2']->value);?>
<option value="<?php echo $_smarty_tpl->tpl_vars['b']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['b']->value['id'] == $_smarty_tpl->tpl_vars['category']->value) {?> selected="selected"<?php }?>><?php echo str_repeat("-",$_smarty_tpl->tpl_vars['level']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['b']->value['title'];?>
</option>
<?php if ($_smarty_tpl->tpl_vars['b']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:category_list_submenu_filter.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['b']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
