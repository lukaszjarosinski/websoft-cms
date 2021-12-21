{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{foreach from=$a item=a}
<option value="{$a.id}">{"-"|str_repeat:$level} {$a.title}</option>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="post_list_submenu_post.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}