{*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*}
{include file="html_header.tpl"}
{include file="header.tpl"}
{include file="menu.tpl"}
<div id="main-content">
{if $komunikat <> ""}
<p class="komunikat">{$komunikat}</p>
{/if}
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.gallery_categories_edit}</h3>
{if $smarty.request.action == 'categories_edit'}
{assign var=category value=$gallery->showCategory($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="category_add" name="category_add" enctype="multipart/form-data">
<p><label for="title">{$lang.title}</label> <input type="text" class="text-input large-input" name="title" id="title" value="{$category.title}" /></p>
<p><label for="active">{$lang.is_active}</label> <input type="radio" name="active" id="active1" value="1"{if $category.active == '1'} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="active" id="active2" value="0"{if $category.active == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="text1">{$lang.content}</label><br /><textarea name="text1" id="text1" class="text-input textarea">{$category.text}</textarea></p>
<p><label for="lang">{$lang.lang}</label> <select name="lang" id="lang" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$installed_languages item=a}
<option value="{$a.lang}"{if $category.lang == ''}{if $a.lang == $default_lang} selected="selected"{/if}{else}{if $category.lang == $a.lang} selected="selected"{/if}{/if}>{$a.name}</option>
{/foreach}
</select></p>
<p><label for="slug">{$lang.slug}</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="{$category.slug}" /></p>
{if ($category.icon <> '')}
{assign var=big_image value="`$gallery_dir``$category.icon`"}
{assign var=min_image value="`$gallery_dir``$min_prefix``$category.icon`"}
{if file_exists($big_image)}{assign var=image value=$big_image}
{elseif file_exists($min_image)}{assign var=image value=$min_image}{/if}
{if file_exists($image)}<p><label>{$lang.actual_icon}</label> <img src="{$domain}images/gallery/{if file_exists($min_image)}{$min_prefix}{/if}{$category.icon}" alt="" /></p>
<p><span>{$lang.delete_icon}</span> <input type="checkbox" name="delete_icon" id="delete_icon" value="1" /></p>
{/if}
{/if}
<p><label for="icon">{$lang.icon}</label> <input type="file" class="text-input large-input" name="icon" id="icon" value="{$category.icon}" /></p>
<input type="hidden" name="id" value="{$category.id}" />
<input type="hidden" name="action" value="categories_add" />
<input type="hidden" name="text" id="text" value="" />
<input type="hidden" name="iframe" id="iframe" value="true" />
<p><input type="submit" name="submit1" value="{$lang.submit}" class="button" /></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
{literal}
$('#title').change(function() {
title = $(this).val();
$.ajax({
url: "{/literal}{$domain}admin/?slugCreate=true{literal}&data="+title
}).done(function(data) {
$('#slug').val(data);
});
});
var info = $('#category_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
text = editor.getData();
$('#text').val(text);
$('#komunikat').append('<iframe name="float_frame" id="float_frame"></iframe>');
$('#category_add').attr('target','float_frame');
$('#category_add').attr('action','{/literal}{$domain}{literal}admin/gallery.php');
document.forms["category_add"].submit();
$("#float_frame").load(function(){
response = $("#float_frame").contents().find("html").html();
$.scrollTo('#komunikat',800);
$('#komunikat').html(response);
setTimeout(function() {window.location.href='{/literal}{$domain}{literal}admin/gallery.php?action=categories'},2000);
});
},
rules: {
title: {
required:true,
minlength:3
},
active: {
required:true
},
slug: {
required:true,
minlength:3
}
},

messages: {
title: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
active: {
required:"{/literal}{$lang.field_is_required}{literal}"
},
slug: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
}
},
errorClass: "error"
});
{/literal}
</script>
<script type="text/javascript">
{literal}
 var editor = CKEDITOR.replace( 'text1',
    {
        filebrowserBrowseUrl : '{/literal}{$domain}{literal}js/ckeditor/filemanager/browser/default/browser.html?Connector={/literal}{$domain}{literal}js/ckeditor/filemanager/connectors/php/connector.php',
        filebrowserUploadUrl : '{/literal}{$domain}{literal}js/ckeditor/uploader/upload.php?Type=Image&Connector={/literal}{$domain}{literal}js/ckeditor/filemanager/connectors/php/connector.php',
				resize_enabled: false,
				scayt_autoStartup: false,
				entities: false
});
{/literal}
</script>
<script type="text/javascript">
$('#menu-gallery').addClass('current');
$('#menu-gallery-categories').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}