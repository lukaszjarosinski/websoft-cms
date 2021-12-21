{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*}
{include file="header.tpl"}
{assign var=nextPost value=$posts->nextPost($post.id)}
{assign var=prevPost value=$posts->prevPost($post.id)}
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
<h2>{$post.title} <span>Napisano w: {$posts->categoryListText($post.id)} dnia {$post.created}. Autor: {$posts->getAuthor($a.author)}</h2>
<div class="hr"></div>
{$post.text}
<div class="never-older">{if $nextPost}<a href="{$domain}{$langcode}/{$nextPost.slug}">{$nextPost.title}</a>{/if} {if $prevPost}<a href="{$domain}{$langcode}/{$prevPost.slug}">{$prevPost.title}</a>{/if}</div>
</div>
<div class="tresc-bottom"></div>
</div>
{include file="footer.tpl"}