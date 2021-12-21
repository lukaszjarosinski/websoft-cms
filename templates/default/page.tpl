{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="header.tpl"}
		<div id="page">
			<div id="content">
				<h2>{$post.title} <span>{$lang.date}: {$post.created}, {$lang.author}: {posts->getAuthor p1=$post.author}</span></h2>
				<div class="hr"></div>
				{$post.text}
			</div>
			<div id="sidebar">
				{include file="sidebar.tpl"}
			</div>
		</div>
	</div>
{include file="footer.tpl"}