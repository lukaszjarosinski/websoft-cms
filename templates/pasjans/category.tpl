{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*}
{include file="header.tpl"}
{assign var=posts_list value=$posts->getPosts($post.id,$page)}
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
<h2>Graj za darmo</h2>
<div class="hr"></div>
<h3>Gry w kategorii "{$post.title}"</h3>
{if $posts_list|count > 0}
{foreach from=$posts_list item=a}
<div class="post">
<h4><a href="{$domain}{$langcode}/{$a.slug}">{$a.title}</a> <span>Napisano dnia: {$a.created}, autor: {$posts->getAuthor($a.author)}</h4>
<div>{$a.text}</div>
</div>
{/foreach}
{if $posts->pageNo($post.id) > 1}
<div class="paginacja">
{if $page > 1}<a href="{$domain}{$langcode}/{$slug}/{math equation="x - y" x=$page y=1}" class="prev">Poprzednie</a>{/if}
{if $page < $posts->pageNo($post.id)}<a href="{$domain}{$langcode}/{$slug}/{math equation="x + y" x=$page y=1}" class="next">Nastêpne</a>{/if}
</div>
{/if}
{else}
<h3>Nie znaleziono gier</h3>
{/if}
</div>
<div class="tresc-bottom"></div>
</div>

<div class="tresc">
<div class="tresc-top"></div>
<div class="tresc-middle">
<img src="{$theme_path}images/pajeczyna.png" class="pajeczyna" alt="" />
<h2>Popularne gry pasjans</h2>
<div class="hr"></div>

</div>
<div class="tresc-bottom"></div>
</div>
{include file="footer.tpl"}