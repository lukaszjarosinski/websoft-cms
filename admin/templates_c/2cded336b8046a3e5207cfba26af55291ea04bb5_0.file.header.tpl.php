<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:20:47
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7689f081355_62044473',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2cded336b8046a3e5207cfba26af55291ea04bb5' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/header.tpl',
      1 => 1637670066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a7689f081355_62044473 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="body-wrapper"> <!-- Wrapper for the radial gradient background -->
		
		<div id="sidebar"><div id="sidebar-wrapper"> <!-- Sidebar with logo and menu -->
			
			<h1 id="sidebar-title"><a href="#">WAWRUS CMS</a></h1>
			<p style="margin:0;padding:0;text-align:right"><img id="logo" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/default/images/logo-3d-cms.png" alt="WAWRUS CMS Logo" /></p>
		  
			<!-- Logo (221px wide) -->
		  
			<!-- Sidebar Profile links -->
			<div id="profile-links">
				<?php if ($_smarty_tpl->tpl_vars['zalogowano']->value) {
echo $_smarty_tpl->tpl_vars['lang']->value['hello'];?>
 <a href="user.php?action=edit&amp;id=<?php echo $_smarty_tpl->tpl_vars['auth_class']->value->showUserId();?>
"><?php echo $_smarty_tpl->tpl_vars['username']->value;?>
</a><br />
				<br />
				<a href="../" target="_blank"><?php echo $_smarty_tpl->tpl_vars['lang']->value['view_the_site'];?>
</a> | <a href="?subaction=logout" title="<?php echo $_smarty_tpl->tpl_vars['lang']->value['logout'];?>
"><?php echo $_smarty_tpl->tpl_vars['lang']->value['logout'];?>
</a><?php }?>
			</div>   
<?php }
}
