{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
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
<link rel="stylesheet" href="{$theme_path}style.css" type="text/css" />
<script type="text/javascript" src="{$domain}js/jquery/jquery-1.7.1.min.js"></script>
{if $HOOK_TOP}{section name=top loop=$HOOK_TOP}{$HOOK_TOP[top]}{/section}{/if}
<link rel="icon" type="image/vnd.microsoft.icon" href="{$theme_path}/images/favicon.ico" />
<link rel="shortcut icon" type="image/x-icon" href="{$theme_path}/images/favicon.ico" />
</head>
<body{if $post.slug != ''} id="{$post.slug}"{/if}>
<div id="kontener">
<div class="inside">
