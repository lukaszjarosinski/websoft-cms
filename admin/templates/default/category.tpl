{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=category_list value=$posts->categoryList($smarty.request.action)}
{assign var=level value=0}
{assign var=post_all value=$posts->countPosts('category','')}
{assign var=post_trash value=$posts->countPosts('category','trash')}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.categories} <a href="category.php?action=add">{$lang.category_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<p><a href="category.php">{$lang.all} ({$post_all})</a> <a href="category.php?action=trash">{$lang.trash} ({$post_trash})</a></p>
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.title}</th><th>{$lang.date_modified}</th><th>{$lang.author}</th><th>{$lang.order}</th>
</tr>
{if $category_list|@count > 0}
{foreach from=$category_list item=a}
{assign var=level value=0}
<tr id="post-{$a.id}"{if $a.status <> ''}  class="{$a.status}"{/if}>
<td>{$a.id}</td>
<td>{$a.title} ({foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="category.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('category.php?action={/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}&amp;id={/literal}{$a.id}{literal}','{/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}','post-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}" /> {if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}</a>
{if $a.status == 'trash'}<a href="javascript:void(0)" onclick=" execute('category.php?action=restore&amp;id={$a.id}','restore','post-{$a.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore}</a>{/if}
{if $a.status == 'draw'}<a href="javascript:void(0)" onclick=" execute('category.php?action=restore&amp;id={$a.id}','restore','post-{$a.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore_draw}</a>{/if}
</td>
<td>{$a.modified}</td>
<td>{$posts->getAuthor($a.author)}</td>
<td style="text-align:center;"><a href="{$domain}admin/category.php?id={$a.id}&subaction=up" title="{$lang.up}"><img src="{$domain}admin/templates/default/images/up.png" alt="{$lang.up}" /></a><form action="{$domain}admin/category.php?subaction=position" method="post"><input type="hidden" name="id" value="{$a.id}" /><input type="text" name="position" value="{$a.order}" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="{$domain}admin/category.php?id={$a.id}&subaction=down" title="{$lang.down}"><img src="{$domain}admin/templates/default/images/down.png" alt="{$lang.down}" /></a>
</td>
</tr>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="category_list_submenu.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}
{/if}
</table>
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-categories').addClass('current');
$('#menu-categories-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}