{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=posts_list value=$posts->postsList($smarty.request.action,$page,$category)}
{assign var=post_all value=$posts->countPosts('post','')}
{assign var=post_trash value=$posts->countPosts('post','trash')}
{assign var=post_element_no value=$posts->elementNo()}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.posts} <a href="post.php?action=add">{$lang.post_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<p><a href="post.php">{$lang.all} ({$post_all})</a> <a href="post.php?action=trash">{$lang.trash} ({$post_trash})</a></p>
<p><form action="post.php" method="get" onsubmit="if ($('#cat1').val != '') $('#cat2').attr('disabled', 'disabled'); else $('#cat1').attr('disabled', 'disabled');">{$lang.filter}: <select name="category" id="cat1">
<option value="">{$lang.select}</option>
{foreach from=$posts->categoryList() item=a}
<option value="{$a.id}"{if $a.id == $category} selected="selected"{/if}>{$a.title}</option>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="category_list_submenu_filter.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}
</select>
<input type="hidden" name="category" value="{$category}" id="cat2" /> 
<input type="hidden" name="page" value="{$page}" /> 
<input type="submit" value="{$lang.submit}" name="submit" class="button" />
</form>
</p>
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.title}</th><th>{$lang.date_modified}</th><th>{$lang.categories}</th><th>{$lang.author}</th><th>{$lang.order}</th>
</tr>
{if $posts_list|@count > 0}
{foreach from=$posts_list item=a}
<tr id="post-{$a.id}"{if $a.status <> ''}  class="{$a.status}"{/if}>
<td>{$a.id}</td>
<td>{$a.title} ({foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
)<br />
<a href="post.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('post.php?action={/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}&amp;id={/literal}{$a.id}{literal}','{/literal}{if $a.status == 'trash'}delete{else}remove{/if}{literal}','post-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}" /> {if $a.status == 'trash'}{$lang.delete}{else}{$lang.remove}{/if}</a>
{if $a.status == 'trash'}<a href="javascript:void(0)" onclick=" execute('post.php?action=restore&amp;id={$a.id}','restore','post-{$a.id}');"><img src="{$domain}/admin/templates/default/images/icons/revert.png" alt="{$lang.restore}" /> {$lang.restore}</a>{/if}
</td>
<td>{$a.modified}</td>
<td>{$posts->categoryListText($a.id)}</td>
<td>{$posts->getAuthor($a.author)}</td>
<td style="text-align:center;"><a href="{$domain}admin/post.php?id={$a.id}&subaction=up" title="{$lang.up}"><img src="{$domain}admin/templates/default/images/up.png" alt="{$lang.up}" /></a><form action="{$domain}admin/post.php?subaction=position" method="post"><input type="hidden" name="id" value="{$a.id}" /><input type="text" name="position" value="{$a.order}" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="{$domain}admin/post.php?id={$a.id}&subaction=down" title="{$lang.down}"><img src="{$domain}admin/templates/default/images/down.png" alt="{$lang.down}" /></a>
</td>
</tr>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="post_list_submenu.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}
{/if}
</table>
{math equation="ceil($post_all / $post_element_no)" assign=pages}
{if $pages > 0}
<div class="pagination">{$lang.page}: 
{section loop=$pages name=nazwa}
<a href="post.php?page={$smarty.section.nazwa.iteration}&category={$category}" class="number">{$smarty.section.nazwa.iteration}</a> 
{/section}
</div>
{/if}
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-posts').addClass('current');
$('#menu-posts-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}