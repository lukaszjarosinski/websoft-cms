{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=boxes_list value=$boxes->boxesList($smarty.request.action)}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.boxes} <a href="box.php?action=add">{$lang.box_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.title}</th><th>{$lang.author}</th><th>{$lang.date_modified}</th>
</tr>
{if $boxes_list|@count > 0}
{foreach from=$boxes_list item=a}
<tr id="box-{$a.id}"{if $a.active <> '1'}  class="draw"{/if}>
<td>{$a.id}</td>
<td>{$a.title} ({foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="box.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('box.php?action=delete&amp;id={/literal}{$a.id}{literal}','delete','box-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{$lang.delete}" /> {$lang.delete}</a>
</td>
<td>{$boxes->getAuthor($a.author)}</td>
<td>{$a.modified}</td>
</tr>
{/foreach}
{/if}
</table>
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-boxes').addClass('current');
$('#menu-boxes-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}