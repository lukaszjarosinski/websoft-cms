{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$a item=b}
{assign var=level value=$level2}
<tr id="post-{$b.id}"{if $b.status <> ''}  class="{$b.status}"{/if}>
<td>{$b.id}</td>
<td>|{"_"|str_repeat:$level} {$b.title} ({foreach from=$installed_languages item=b}
{if $b.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="category.php?action=edit&amp;id={$b.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('category.php?action={/literal}{if $b.status == 'trash'}delete{else}remove{/if}{literal}&amp;id={/literal}{$b.id}{literal}','{/literal}{if $b.status == 'trash'}delete{else}remove{/if}{literal}','post-{/literal}{$b.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{if $b.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}" /> {if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}</a>
{if $b.status == 'trash'}<a href="javascript:void(0)" onclick=" execute('category.php?action=restore&amp;id={$b.id}','restore','post-{$b.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore}</a>{/if}
{if $b.status == 'draw'}<a href="javascript:void(0)" onclick=" execute('category.php?action=restore&amp;id={$b.id}','restore','post-{$b.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore_draw}</a>{/if}
</td>
<td>{$b.modified}</td>
<td>{$posts->getAuthor($b.author)}</td>
<td style="text-align:center;"><a href="{$domain}admin/category.php?id={$b.id}&subaction=up" title="{$lang.up}"><img src="{$domain}admin/templates/default/images/up.png" alt="{$lang.up}" /></a><form action="{$domain}admin/category.php?subaction=position" method="post"><input type="hidden" name="id" value="{$b.id}" /><input type="text" name="position" value="{$b.order}" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="{$domain}admin/category.php?id={$b.id}&subaction=down" title="{$lang.down}"><img src="{$domain}admin/templates/default/images/down.png" alt="{$lang.down}" /></a>
</td>
</tr>
{if $b.submenu}
{assign var=level value=$level+1}
{include file="category_list_submenu.tpl" a=$b.submenu level=$level}
{/if}
{/foreach}