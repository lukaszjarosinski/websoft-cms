{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$a item=b}
{assign var=level value=$level2}
<option value="{$b.id}"{if $b.id == $category} selected="selected"{/if}>{"-"|str_repeat:$level} {$b.title}</option>
{if $b.submenu}
{assign var=level value=$level+1}
{include file="category_list_submenu_filter.tpl" a=$b.submenu level=$level}
{/if}
{/foreach}