{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="header.tpl"}
{posts->nextPost p1=$post.id assign='nextPost'}
{posts->prevPost p1=$post.id assign='prevPost'}
		<div id="page">
			<div id="content">
				<h2>{$post.title} <span>{$lang.written_in}: {posts->categoryListText p1=$post.id} {$lang.day} {$post.created}. {$lang.author}: {posts->getAuthor p1=$post.author}</span></h2>
				<div class="hr"></div>
				{$post.text}
				<div class="never-older">{if $nextPost}<a href="{$domain}{$langcode}/{$nextPost.slug}">{$nextPost.title}</a>{/if} {if $prevPost}<a href="{$domain}{$langcode}/{$prevPost.slug}">{$prevPost.title}</a>{/if}</div>
			</div>
			<div id="sidebar">
				{include file="sidebar.tpl"}
			</div>
		</div>
	</div>
{include file="footer.tpl"}