{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$a item=b}
{assign var=level value=$level2}
<option value="{$b.id}"{if $smarty.request.action == 'edit' AND in_array($b.id,$menu.array) AND is_array($menu.array)} selected="selected"{/if}>{"-"|str_repeat:$level} {$b.title}</option>
{if $b.submenu}
{assign var=level value=$level+1}
{include file="all_list_submenu.tpl" a=$b.submenu level=$level}
{/if}
{/foreach}