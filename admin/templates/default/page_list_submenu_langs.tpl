{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{assign var=level2 value=$level}
{foreach from=$pages_list item=pages_listvar}
{assign var=level value=$level2}
<option value="{$pages_listvar.id}"{if $posts->getAttribution($pages_listvar.id,$post.id)} selected="selected"{/if}>{$pages_listvar.title} ({foreach from=$installed_languages item=a}
{if $pages_listvar.lang == $a.lang}{$a.name}{/if}
{/foreach}
)</option>
{if $pages_listvar.submenu}
{assign var=level value=$level+1}
{include file="page_list_submenu_post.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}