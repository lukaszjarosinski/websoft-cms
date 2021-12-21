<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:10:03
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/options.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7661b5faf67_59270098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f479f3a794d6268868cff889ff9b2c63dc95f07b' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/options.tpl',
      1 => 1637670067,
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
function content_61a7661b5faf67_59270098 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<?php $_smarty_tpl->_assignInScope('options_list1', $_smarty_tpl->tpl_vars['options']->value->optionsList());
if (count($_smarty_tpl->tpl_vars['options_list1']->value) > 0) {
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options_list1']->value, 'y');
$_smarty_tpl->tpl_vars['y']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['y']->value) {
$_smarty_tpl->tpl_vars['y']->do_else = false;
?>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['options'];?>
 - <?php echo $_smarty_tpl->tpl_vars['y']->value[1];?>
</h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="options<?php echo $_smarty_tpl->tpl_vars['y']->value[0];?>
">
<?php $_smarty_tpl->_assignInScope('options_list', $_smarty_tpl->tpl_vars['y']->value[2]);
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['options_list']->value, 'x');
$_smarty_tpl->tpl_vars['x']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['x']->value) {
$_smarty_tpl->tpl_vars['x']->do_else = false;
$_smarty_tpl->_assignInScope('xk', $_smarty_tpl->tpl_vars['x']->value['key']);?>
<p><label for="<?php echo $_smarty_tpl->tpl_vars['x']->value['key'];
echo $_smarty_tpl->tpl_vars['y']->value[0];?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value[$_smarty_tpl->tpl_vars['xk']->value];?>
</label> <input type="text" class="text-input medium-input" name="<?php echo $_smarty_tpl->tpl_vars['x']->value['key'];?>
" id="<?php echo $_smarty_tpl->tpl_vars['x']->value['key'];
echo $_smarty_tpl->tpl_vars['y']->value[0];?>
" value="<?php echo $_smarty_tpl->tpl_vars['x']->value['value'];?>
" /></p>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
<input type="hidden" name="lang" value="<?php echo $_smarty_tpl->tpl_vars['x']->value['lang'];?>
" />
<input type="hidden" name="action" value="update" />
<p><input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['submit'];?>
" class="button" /></p>
</form>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">

var info = $('#options<?php echo $_smarty_tpl->tpl_vars['y']->value[0];?>
').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
formSubmit('options<?php echo $_smarty_tpl->tpl_vars['y']->value[0];?>
','<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/options.php');
},
rules: {
},

messages: {
},
errorClass: "input-notification error png_bg"
});

<?php echo '</script'; ?>
>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
}
echo '<script'; ?>
 type="text/javascript">
$('#menu-added').addClass('current');
$('#menu-added-options').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
