{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=users_list value=$auth_class->usersList($smarty.request.action)}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.users} <a href="user.php?action=add">{$lang.user_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.username}</th><th>{$lang.registered}</th><th>{$lang.permission}</th>
</tr>
{if $users_list|@count > 0}
{foreach from=$users_list item=a}
<tr id="user-{$a.id}"{if $a.active <> '1'}  class="draw"{/if}>
<td>{$a.id}</td>
<td>{$a.username}<br />
<a href="user.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
{if $a.id != $auth_class->showUserId()}<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('user.php?action=delete&amp;id={/literal}{$a.id}{literal}','delete','user-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{$lang.delete}" /> {$lang.delete}</a>{/if}
</td>
<td>{$a.registered}</td>
<td>{$auth_class->permissionNicename($a.permissions)}</td>
</tr>
{/foreach}
{/if}
</table>
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-users').addClass('current');
$('#menu-users-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}