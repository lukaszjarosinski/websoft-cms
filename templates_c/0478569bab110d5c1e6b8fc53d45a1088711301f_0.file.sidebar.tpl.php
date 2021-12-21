<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:15:10
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/sidebar.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7674ec0cac2_74195780',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0478569bab110d5c1e6b8fc53d45a1088711301f' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/sidebar.tpl',
      1 => 1637670062,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a7674ec0cac2_74195780 (Smarty_Internal_Template $_smarty_tpl) {
?><h2><?php echo $_smarty_tpl->tpl_vars['lang']->value['select_category'];?>
</h2>
<?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getCategories(array(),$_smarty_tpl);
}
}
