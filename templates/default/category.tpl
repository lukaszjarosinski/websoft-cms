{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="header.tpl"}
{posts->getPosts p1=$post.id p2=$page assign='posts_list'}
		<div id="page">
			<div id="content">
				<h2>{$post.title}</h2>
				{if $posts_list|default:array()|count > 0}
				{foreach from=$posts_list item=a}
				<div class="post">
				<h3><a href="{$domain}{$langcode}/{$a.slug}">{$a.title}</a> <span>{$lang.written}: {$a.created}, {$lang.author}: {posts->getAuthor p1=$a.author}</h3>
				<div>{$a.text}</div>
				<br /><br />
				</div>
				{/foreach}
				{posts->pageNo p1=$post.id assign='pageNo'}
				{if $pageNo > 1}
				<div class="paginacja">
				{if $page > 1}<a href="{$domain}{$langcode}/{$slug}/{math equation="x - y" x=$page y=1}" class="prev">{$lang.last}</a>{/if}
				{if $page < pageNo}<a href="{$domain}{$langcode}/{$slug}/{math equation="x + y" x=$page y=1}" class="next">{$lang.next}</a>{/if}
				</div>
				{/if}
				{else}
				<h3>{$lang.not_found}</h3>
				{/if}
			</div>
			<div id="sidebar">
				{include file="sidebar.tpl"}
			</div>
		</div>
	</div>
{include file="footer.tpl"}