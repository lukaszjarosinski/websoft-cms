<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:15:10
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7674ec152b7_56515095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2881a367151ec7aa5d39e0ec9d795f71b4e6f14a' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/footer.tpl',
      1 => 1637670062,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a7674ec152b7_56515095 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/lukaszjaro/public_html/demo/cms/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>
	<div id="footer">
		<p>Copyright &copy; 2012 <a href="http://www.lukaszjarosinski.com">Łukasz Jarosiński</a>. All rights reserved. Design by <a href="http://www.freecsstemplates.org">FCT</a>. Photos by <a href="http://fotogrph.com/">fotogrph</a>.</p>
		<?php echo $_smarty_tpl->smarty->registered_objects['links'][0]->getLinks();?>

	</div>
<!-- end #footer -->
<?php echo '<script'; ?>
 type="text/javascript">
<?php $_smarty_tpl->_assignInScope('js_dir', smarty_modifier_replace($_smarty_tpl->tpl_vars['config']->value['js_dir'],$_smarty_tpl->tpl_vars['config']->value['base_dir'],$_smarty_tpl->tpl_vars['config']->value['domain']));?>

$(function() {
	$('a.lightbox').lightBox({
		overlayBgColor: '#000000',
	overlayOpacity: 0.95,
	imageLoading: '<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/lightbox-ico-loading.gif',
	imageBtnClose: '<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/close.png',
	imageBtnPrev: '<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/lightbox-btn-prev.gif',
	imageBtnNext: '<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/lightbox-btn-next.gif',
	containerResizeSpeed: 350,
	txtImage: 'Zdjęcie',
	txtOf: 'z'
	}); // Select all links with lightbox class
});

<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['HOOK_BOTTOM']->value) {
$__section_bottom_2_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['HOOK_BOTTOM']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_bottom_2_total = $__section_bottom_2_loop;
$_smarty_tpl->tpl_vars['__smarty_section_bottom'] = new Smarty_Variable(array());
if ($__section_bottom_2_total !== 0) {
for ($__section_bottom_2_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_bottom']->value['index'] = 0; $__section_bottom_2_iteration <= $__section_bottom_2_total; $__section_bottom_2_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_bottom']->value['index']++){
echo $_smarty_tpl->tpl_vars['HOOK_BOTTOM']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_bottom']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_bottom']->value['index'] : null)];
}
}
}?>
</body>
</html><?php }
}
