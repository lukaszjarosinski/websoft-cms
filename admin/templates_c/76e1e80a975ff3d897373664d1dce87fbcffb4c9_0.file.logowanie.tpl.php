<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:08:27
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/logowanie.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a765bb1a56d2_03499507',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '76e1e80a975ff3d897373664d1dce87fbcffb4c9' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/logowanie.tpl',
      1 => 1637670066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header_login.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a765bb1a56d2_03499507 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header_login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="login-wrapper" class="png_bg">
			<div id="login-top">
			
				<h1>WAWRUS CMS</h1>
				<img id="logo" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/logo-3d-cms.png" alt="WAWRUS CMS Logo" />
			</div> <!-- End #logn-top -->
			
			<div id="login-content">
				
				<form action="<?php echo $_smarty_tpl->tpl_vars['action']->value;?>
" method="post" name="login">
				
						<?php if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
							<div class="notification <?php echo $_smarty_tpl->tpl_vars['komunikat']->value[1];?>
 png_bg"><a href="javascript:void(0)" class="close"><img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/icons/cross_grey_small.png" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['close_notification'];?>
" alt="<?php echo $_smarty_tpl->tpl_vars['lang']->value['close_notification'];?>
" /></a><div><?php echo $_smarty_tpl->tpl_vars['komunikat']->value[0];?>
</div></div>
						<?php }?>
					
					<p>
						<label for="username"><?php echo $_smarty_tpl->tpl_vars['lang']->value['username'];?>
</label>
						<input class="text-input" type="text" name="username" id="username" />
					</p>
					<div class="clear"></div>
					<p>
						<label for="password"><?php echo $_smarty_tpl->tpl_vars['lang']->value['password'];?>
</label>
						<input class="text-input" type="password" name="password" id="password" />
					</p>
					<div class="clear"></div>
					<p>
						<input class="button" type="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['login'];?>
" name="submit" />
					</p>
					
				</form>
			</div> <!-- End #login-content -->
			
		</div>

<?php echo '<script'; ?>
 type="text/javascript">
window.onload=document.login.username.focus();
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
