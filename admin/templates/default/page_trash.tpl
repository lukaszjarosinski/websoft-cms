{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=pages_list value=$posts->pagesList($smarty.request.action)}
{assign var=level value=0}
{assign var=post_all value=$posts->countPosts('page','')}
{assign var=post_trash value=$posts->countPosts('page','trash')}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.pages} <a href="page.php?action=add">{$lang.page_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<p><a href="page.php">{$lang.all} ({$post_all})</a> <a href="page.php?action=trash">{$lang.trash} ({$post_trash})</a></p>
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.title}</th><th>{$lang.date_modified}</th><th>{$lang.author}</th>
</tr>
{if $pages_list|@count > 0}
{foreach from=$pages_list item=a}
{assign var=level value=0}
<tr id="post-{$a.id}"{if $a.status <> ''}  class="{$a.status}"{/if}>
<td>{$a.id}</td>
<td>{$a.title} ({foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="page.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('page.php?action={/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}&amp;id={/literal}{$a.id}{literal}','{/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}','post-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}" /> {if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}</a>
{if $a.status == 'trash'}<a href="javascript:void(0)" onclick=" execute('page.php?action=restore&amp;id={$a.id}','restore','post-{$a.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore}</a>{/if}
</td>
<td>{$a.modified}</td>
<td>{$posts->getAuthor($a.author)}</td>
</tr>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="page_list_submenu.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}
{/if}
</table>
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-pages').addClass('current');
$('#menu-pages-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}