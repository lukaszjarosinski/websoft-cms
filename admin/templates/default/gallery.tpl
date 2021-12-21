{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{assign var=gallery_pictures_list value=$gallery->picturesList($smarty.request.gallery_id)}
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.gallery_pictures} <a href="gallery.php?action=add">{$lang.gallery_pictures_add}</a></h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<table>
<tr>
<th>{$lang.id}</th><th>{$lang.image}</th><th>{$lang.action}</th><th>{$lang.author}</th><th>{$lang.date_modified}</th><th>{$lang.category}</th><th>{$lang.order}</th>
</tr>
{if $gallery_pictures_list|default:array()|@count > 0}
{foreach from=$gallery_pictures_list item=a}
<tr id="picture-{$a.id}"{if $a.active <> '1'}  class="draw"{/if}>
<td>{$a.id}</td>
<td>
{if ($a.image <> '')}
{assign var=big_image value="`$gallery_dir``$a.image`"}
{assign var=min_image value="`$gallery_dir``$min_prefix``$a.image`"}
{if file_exists($big_image)}{assign var=image value=$big_image}
{elseif file_exists($min_image)}{assign var=image value=$min_image}{/if}
{if file_exists($image)}<img src="{$domain}images/gallery/{if file_exists($min_image)}{$min_prefix}{/if}{$a.image}" alt="" />{/if}
{/if}
<br /> {foreach from=$installed_languages item=b}
{if $a.lang == $b.lang}{$b.name}{/if}
{/foreach}
</td>
<td><a href="gallery.php?action=edit&amp;id={$a.id}"><img src="{$domain}/admin/templates/default/images/icons/pencil.png" alt="{$lang.edit}" /> {$lang.edit}</a> &nbsp;&nbsp;&nbsp;
<a href="javascript:void(0)" onclick="if (confirm('{$lang.are_you_sure}')) {literal}{ execute('gallery.php?action=delete&amp;iframe=true&amp;id={/literal}{$a.id}{literal}','delete','picture-{/literal}{$a.id}{literal}');}{/literal}"><img src="{$domain}/admin/templates/default/images/icons/cross.png" alt="{$lang.delete}" /> {$lang.delete}</a>
</td>
<td>{$gallery->getAuthor($a.author)}</td>
<td>{$a.modified}</td>
<td>{assign var=category value=$gallery->showCategory($a.category_id)}<a href="{$domain}admin/gallery.php?action=categories_edit&id={$category.id}">{$category.title}</a></td>
<td style="text-align:center;"><a href="{$domain}admin/gallery.php?id={$a.id}&subaction=up" title="{$lang.up}"><img src="{$domain}admin/templates/default/images/up.png" alt="{$lang.up}" /></a><form action="{$domain}admin/gallery.php?subaction=position" method="post"><input type="hidden" name="id" value="{$a.id}" /><input type="text" name="position" value="{$a.position}" class="text-input tiny-input" style="text-align:center;" /> <input type="submit" value="OK" name="submit" class="button" /></form><a href="{$domain}admin/gallery.php?id={$a.id}&subaction=down" title="{$lang.down}"><img src="{$domain}admin/templates/default/images/down.png" alt="{$lang.down}" /></a>
</td>
</tr>
{/foreach}
{/if}
<tr>
<td colspan="6">
{assign var=gallery_categories value=$gallery->categoriesList()}
<p>{if $gallery_pictures_list|default:array()|@count == 0}{$lang.category_empty}{/if} {$lang.select_gallery}</p>
<ul>
{foreach from=$gallery_categories item=x}
<li><a href="{$domain}admin/gallery.php?gallery_id={$x.id}">{$x.title}</a></li>
{/foreach}
</ul>
</td>
</tr>
</table>
</div>
</div>
</div>
<script type="text/javascript">
$('#menu-gallery').addClass('current');
$('#menu-gallery-list').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}