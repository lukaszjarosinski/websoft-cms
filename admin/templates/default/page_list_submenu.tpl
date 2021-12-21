{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$a item=a}
{assign var=level value=$level2}
<tr id="post-{$a.id}"{if $a.status <> ''}  class="{$a.status}"{/if}>
<td>{$a.id}</td>
<td>|{"_"|str_repeat:$level} {$a.title} ({foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="page.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('page.php?action={/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}&amp;id={/literal}{$a.id}{literal}','{/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}','post-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}" /> {if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}</a>
{if $a.status == 'trash'}<a href="javascript:void(0)" onclick=" execute('page.php?action=restore&amp;id={$a.id}','restore','post-{$a.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore}</a>{/if}
</td>
<td>{$a.modified}</td>
<td>{$posts->getAuthor($a.author)}</td>
<td style="text-align:center;"><a href="{$domain}admin/page.php?id={$a.id}&subaction=up" title="{$lang.up}"><img src="{$domain}admin/templates/default/images/up.png" alt="{$lang.up}" /></a><form action="{$domain}admin/page.php?subaction=position" method="post"><input type="hidden" name="id" value="{$a.id}" /><input type="text" name="position" value="{$a.order}" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="{$domain}admin/page.php?id={$a.id}&subaction=down" title="{$lang.down}"><img src="{$domain}admin/templates/default/images/down.png" alt="{$lang.down}" /></a>
</td>
</tr>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="page_list_submenu.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}