<?php
/* Smarty version 4.0.0, created on 2021-12-02 09:24:10
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a882aa60d745_97723453',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3c5f8c35c0109807585c6ed6043e3358a17d8b33' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/index.tpl',
      1 => 1637670066,
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
function content_61a882aa60d745_97723453 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content"> <!-- Main Content Section with everything -->
<?php if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
			<noscript> <!-- Show a notification if the user has disabled javascript -->
				<div class="notification error png_bg">
					<div>
						<?php echo $_smarty_tpl->tpl_vars['lang']->value['javascript_disabled'];?>

					</div>
				</div>
			</noscript>
<h2><?php echo $_smarty_tpl->tpl_vars['lang']->value['hello'];?>
 <a href="user.php?action=edit&id=<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a></h2>
			
			<ul class="shortcut-buttons-set"> <!-- Replace the icons URL's with your own -->
				
				<li><a class="shortcut-button" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php?action=add"><span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/icons/new-page-icon.png" alt="" /><br />
					<?php echo $_smarty_tpl->tpl_vars['lang']->value['create_new_page'];?>

				</span></a></li>
				
				<li><a class="shortcut-button" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/user.php"><span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/icons/User-Clients-icon.png" alt="" /><br />
					<?php echo $_smarty_tpl->tpl_vars['lang']->value['manage_users'];?>

				</span></a></li>
				
				<li><a class="shortcut-button" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/link.php?action=add"><span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/icons/Actions-insert-link-icon.png" alt="" /><br />
					<?php echo $_smarty_tpl->tpl_vars['lang']->value['create_new_link'];?>

				</span></a></li>
				
				<li><a class="shortcut-button" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php"><span>
					<img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/icons/page-edit-icon.png" alt="" /><br />
					<?php echo $_smarty_tpl->tpl_vars['lang']->value['manage_pages'];?>

				</span></a></li>
				
			</ul><!-- End .shortcut-buttons-set -->
			
			<div class="clear"></div>
			
			<div class="content-box">
				<div class="content-box-header">
					<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['author_name'];?>
</h3>
				</div>
				<div class="content-box-content">
					<?php echo $_smarty_tpl->tpl_vars['lang']->value['author_info'];?>

				</div>
			</div>
			
			<div class="clear"></div> <!-- End .clear -->
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
