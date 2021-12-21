{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$a item=a}
{assign var=level value=$level2}
<option value="{$a.id}"{if $a.id == $post.parent} selected="selected"{/if}>{"-"|str_repeat:$level} {$a.title}</option>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="page_list_submenu_post.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}