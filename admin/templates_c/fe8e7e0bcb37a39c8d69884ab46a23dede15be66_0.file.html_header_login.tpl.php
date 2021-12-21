<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:08:27
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/html_header_login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a765bb1b1358_80615290',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fe8e7e0bcb37a39c8d69884ab46a23dede15be66' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/html_header_login.tpl',
      1 => 1637670066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a765bb1b1358_80615290 (Smarty_Internal_Template $_smarty_tpl) {
echo '<?'; ?>
xml version="1.0" encoding="utf-8"<?php echo '?>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="Author" content="www.lukaszjarosinski.com" />
<title><?php echo $_smarty_tpl->tpl_vars['lang']->value['index_title'];?>
 - <?php echo $_smarty_tpl->tpl_vars['lang']->value['cms_name'];?>
</title>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/reset.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/invalid.css" type="text/css" media="screen" />	
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/red.css" type="text/css" media="screen" />  
<!--[if lte IE 7]>
<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/templates/<?php echo $_smarty_tpl->tpl_vars['theme']->value;?>
/css/ie.css" type="text/css" media="screen" />
<![endif]-->
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/menu.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/jquery/jquery-1.7.1.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/jquery/jquery.validate.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/universal.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/ckeditor/ckeditor.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/simpla.jquery.configuration.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/facebox.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/jquery/jquery.wysiwyg.js"><?php echo '</script'; ?>
>
<!--[if IE 6]>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/DD_belatedPNG_0.0.7a.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
	DD_belatedPNG.fix('.png_bg, img, li');
<?php echo '</script'; ?>
>
<![endif]-->
</head>
<body id="login">
<noscript>
<p class="warning"><?php echo $_smarty_tpl->tpl_vars['lang']->value['javascript_disabled'];?>
</p>
</noscript>
<?php }
}
