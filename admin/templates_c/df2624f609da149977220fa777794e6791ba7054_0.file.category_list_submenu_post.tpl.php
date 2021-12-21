<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:20:47
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/category_list_submenu_post.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7689f09aa27_77661386',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'df2624f609da149977220fa777794e6791ba7054' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/category_list_submenu_post.tpl',
      1 => 1638358971,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:category_list_submenu_post.tpl' => 2,
  ),
),false)) {
function content_61a7689f09aa27_77661386 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_assignInScope('level2', $_smarty_tpl->tpl_vars['level']->value);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['a']->value, 'b');
$_smarty_tpl->tpl_vars['b']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['b']->value) {
$_smarty_tpl->tpl_vars['b']->do_else = false;
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level2']->value);?>
<option value="<?php echo $_smarty_tpl->tpl_vars['b']->value['id'];?>
"<?php if ($_REQUEST['action'] == 'edit' && $_smarty_tpl->tpl_vars['post']->value['categories'] != '' && in_array($_smarty_tpl->tpl_vars['b']->value['id'],$_smarty_tpl->tpl_vars['post']->value['categories'])) {?> selected="selected"<?php }?>><?php echo str_repeat("-",$_smarty_tpl->tpl_vars['level']->value);?>
 <?php echo $_smarty_tpl->tpl_vars['b']->value['title'];?>
</option>
<?php if ($_smarty_tpl->tpl_vars['b']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:category_list_submenu_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['b']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
}
