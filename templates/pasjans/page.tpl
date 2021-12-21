{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*}
{include file="header.tpl"}
<div class="ad-top">
{$boxes->displayBox(1)}
</div>
<div class="left">
{include file="sidebar.tpl"}
</div>
<div class="content">
<div class="tresc">
<div class="tresc-top"></div>
<div class="tresc-middle">
<img src="{$theme_path}images/pajeczyna.png" class="pajeczyna" alt="" />
<h2>{$post.title} <span>Data: {$post.created}, autor: {$posts->getAuthor($a.author)}</span></h2>
<div class="hr"></div>
{$post.text}
</div>
<div class="tresc-bottom"></div>
</div>
{include file="footer.tpl"}