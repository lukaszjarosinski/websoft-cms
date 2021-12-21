<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:15:10
  from '/home/lukaszjaro/public_html/demo/cms/templates/default/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7674ebfaf42_68703292',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c82f2d362a51cdef6f874b852169a3e612999dcb' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/templates/default/header.tpl',
      1 => 1637928826,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a7674ebfaf42_68703292 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/lukaszjaro/public_html/demo/cms/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
echo '<?'; ?>
xml version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="Description" content="<?php echo $_smarty_tpl->tpl_vars['meta_description']->value;?>
" />
<meta name="Keywords" content="<?php echo $_smarty_tpl->tpl_vars['meta_keywords']->value;?>
" />
<meta name="Author" content="www.lukaszjarosinski.com" />
<meta name="Generator" content="WAWRUS CMS v4.2 Blog Edition" />
<title><?php echo $_smarty_tpl->tpl_vars['meta_title']->value;?>
</title>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['theme_path']->value;?>
style.css" type="text/css" />
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/jquery/jquery-1.7.1.min.js"><?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['HOOK_TOP']->value) {
$__section_top_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['HOOK_TOP']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_top_0_total = $__section_top_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_top'] = new Smarty_Variable(array());
if ($__section_top_0_total !== 0) {
for ($__section_top_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_top']->value['index'] = 0; $__section_top_0_iteration <= $__section_top_0_total; $__section_top_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_top']->value['index']++){
echo $_smarty_tpl->tpl_vars['HOOK_TOP']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_top']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_top']->value['index'] : null)];
}
}
}?>
<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->tpl_vars['theme_path']->value;?>
/images/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->tpl_vars['theme_path']->value;?>
/images/favicon.ico" />
<?php $_smarty_tpl->_assignInScope('js_dir', smarty_modifier_replace($_smarty_tpl->tpl_vars['config']->value['js_dir'],$_smarty_tpl->tpl_vars['config']->value['base_dir'],$_smarty_tpl->tpl_vars['config']->value['domain']));
echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/jquery.lightbox-0.5.js" type="text/javascript"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['js_dir']->value;?>
lightbox/jquery.lightbox-0.5.css" />
</head>
<body<?php if ($_smarty_tpl->tpl_vars['post']->value['slug'] != '') {?> id="<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
"<?php }?>>
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="<?php echo $_smarty_tpl->tpl_vars['config']->value['domain'];?>
">CMS </a></h1>
			<p>design by <a href="http://www.lukaszjarosinski.com">lukaszjarosinski.com</a></p>
		</div>
		<div id="menu">
		<?php echo $_smarty_tpl->smarty->registered_objects['posts'][0]->getPages(array('p1'=>'0','p2'=>true,'p3'=>'order','p4'=>'ASC','p5'=>false,'p6'=>11),$_smarty_tpl);?>

		</div>
	</div>
<!-- end #header -->
	<div id="wrapper">
		<div id="splash">
			<?php echo $_smarty_tpl->smarty->registered_objects['boxes'][0]->displayBox('box-header');?>

		</div>
		<div id="poptrox"> 
		<!-- start -->
			<?php $_smarty_tpl->_assignInScope('images', $_smarty_tpl->tpl_vars['gallery']->value->displayPicturesFromCategory('kategoria-przykladowa'));?>
			<?php $_smarty_tpl->_assignInScope('gallery_dir', smarty_modifier_replace($_smarty_tpl->tpl_vars['config']->value['gallery_dir'],$_smarty_tpl->tpl_vars['config']->value['base_dir'],$_smarty_tpl->tpl_vars['config']->value['domain']));?>
			<ul id="gallery">
				<?php
$__section_x_1_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['images']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_x_1_total = $__section_x_1_loop;
$_smarty_tpl->tpl_vars['__smarty_section_x'] = new Smarty_Variable(array());
if ($__section_x_1_total !== 0) {
for ($__section_x_1_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] = 0; $__section_x_1_iteration <= $__section_x_1_total; $__section_x_1_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']++){
?>
					<?php if (file_exists((($_smarty_tpl->tpl_vars['config']->value['gallery_dir']).($_smarty_tpl->tpl_vars['config']->value['min_prefix'])).($_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image']))) {?><li><a class="lightbox" id="<?php echo $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image'];?>
" href="<?php echo ($_smarty_tpl->tpl_vars['gallery_dir']->value).($_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image']);?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['gallery_dir']->value;
echo $_smarty_tpl->tpl_vars['config']->value['min_prefix'];
echo $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image'];?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
" /></a></li>
					<?php } elseif (file_exists(($_smarty_tpl->tpl_vars['config']->value['gallery_dir']).($_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image']))) {?><li><a href="<?php echo ($_smarty_tpl->tpl_vars['gallery_dir']->value).($_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image']);?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
" class="lightbox"><img src="<?php echo $_smarty_tpl->tpl_vars['gallery_dir']->value;
echo $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['image'];?>
" alt="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
" title="<?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['images']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_x']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_x']->value['index'] : null)]['text']);?>
" /></a></li><?php }?>
				<?php
}
}
?>
			</ul>
			<br class="clear" />
		<!-- end --> 
		</div><?php }
}
