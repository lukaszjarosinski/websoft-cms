{*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*}
<?xml version="1.0" encoding="utf-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="Description" content="{$meta_description}" />
<meta name="Keywords" content="{$meta_keywords}" />
<meta name="Author" content="www.lukaszjarosinski.com" />
<meta name="Generator" content="WAWRUS CMS v4.2 Blog Edition" />
<title>{$meta_title}</title>
<link href='http://fonts.googleapis.com/css?family=Ubuntu+Condensed&amp;subset=latin,latin-ext' rel='stylesheet' type='text/css' />
<link rel="stylesheet" href="{$theme_path}style.css" type="text/css" />
<script type="text/javascript" src="{$domain}js/jquery/jquery-1.7.1.min.js"></script>
{if $HOOK_TOP}{section name=top loop=$HOOK_TOP}{$HOOK_TOP[top]}{/section}{/if}
<link rel="icon" type="image/vnd.microsoft.icon" href="{$theme_path}/images/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="{$theme_path}/images/favicon.ico" />
{assign var=js_dir value=$config.js_dir|replace:$config.base_dir:$config.domain}
<script src="{$js_dir}lightbox/jquery.lightbox-0.5.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{$js_dir}lightbox/jquery.lightbox-0.5.css" />
</head>
<body{if $post.slug != ''} id="{$post.slug}"{/if}>
	<div id="header" class="container">
		<div id="logo">
			<h1><a href="{$config.domain}">CMS </a></h1>
			<p>design by <a href="http://www.lukaszjarosinski.com">lukaszjarosinski.com</a></p>
		</div>
		<div id="menu">
		{posts->getPages p1='0' p2=true p3='order' p4='ASC' p5=false p6=11}
		</div>
	</div>
<!-- end #header -->
	<div id="wrapper">
		<div id="splash">
			{boxes->displayBox p1='box-header'}
		</div>
		<div id="poptrox"> 
		<!-- start -->
			{assign var=images value=$gallery->displayPicturesFromCategory('kategoria-przykladowa')}
			{assign var=gallery_dir value=$config.gallery_dir|replace:$config.base_dir:$config.domain}
			<ul id="gallery">
				{section name=x loop=$images}
					{if file_exists($config.gallery_dir|cat:$config.min_prefix|cat:$images[x].image)}<li><a class="lightbox" id="{$images[x].image}" href="{$gallery_dir|cat:$images[x].image}" title="{$images[x].text|strip_tags}"><img src="{$gallery_dir}{$config.min_prefix}{$images[x].image}" alt="{$images[x].text|strip_tags}" title="{$images[x].text|strip_tags}" /></a></li>
					{elseif file_exists($config.gallery_dir|cat:$images[x].image)}<li><a href="{$gallery_dir|cat:$images[x].image}" title="{$images[x].text|strip_tags}" class="lightbox"><img src="{$gallery_dir}{$images[x].image}" alt="{$images[x].text|strip_tags}" title="{$images[x].text|strip_tags}" /></a></li>{/if}
				{/section}
			</ul>
			<br class="clear" />
		<!-- end --> 
		</div>