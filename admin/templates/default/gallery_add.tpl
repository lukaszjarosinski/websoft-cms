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
<h3>{$lang.gallery_pictures_add}</h3>
{if $smarty.request.action == 'edit'}
{assign var=picture value=$gallery->showPicture($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="picture_add" name="picture_add" enctype="multipart/form-data">
<p><label for="active">{$lang.is_active}</label> <input type="radio" name="active" id="active1" value="1"{if $picture.active == '1'} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="active" id="active2" value="0"{if $picture.active == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="position">{$lang.position}</label> <input type="text" name="position" id="position" class="text-input small-input" value="{$gallery->getMaxOrder()}" /></p>
<p><label for="text1">{$lang.content}</label><br /><textarea name="text1" id="text1" class="text-input textarea">{$picture.text}</textarea></p>
<p><label for="lang">{$lang.lang}</label> <select name="lang" id="lang" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$installed_languages item=a}
<option value="{$a.lang}"{if $picture.lang == ''}{if $a.lang == $default_lang} selected="selected"{/if}{else}{if $picture.lang == $a.lang} selected="selected"{/if}{/if}>{$a.name}</option>
{/foreach}
</select></p>
<p><label for="category">{$lang.category}</label> <select name="category_id" id="category_id" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$gallery->getActiveCategories() item=a}
<option value="{$a.id}"{if $a.id == $picture.category_id} selected="selected"{/if}>{$a.title}</option>
{/foreach}
</select></p>
{if ($picture.image <> '')}
{assign var=image value="`$gallery_dir``$min_prefix``$picture.image`"}
{if file_exists($image)}<p><label>{$lang.actual_image}</label> <img src="{$domain}images/gallery/{$min_prefix}{$picture.image}" alt="" /></p>
<p><span>{$lang.delete_image}</span> <input type="checkbox" name="delete_picture" id="delete_picture" value="1" /></p>
{/if}
{/if}
<p><label for="image">{$lang.image}</label> <input type="file" class="text-input large-input" name="image" id="image" /></p>
<input type="hidden" name="id" value="{$picture.id}" />
<input type="hidden" name="action" value="picture_add" />
<input type="hidden" name="text" id="text" value="" />
<p><input type="submit" name="submit1" value="{$lang.submit}" class="button" /></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
{literal}
var info = $('#picture_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
text = editor.getData();
$('#text').val(text);
$('#komunikat').append('<iframe name="float_frame" id="float_frame"></iframe>');
$('#picture_add').attr('target','float_frame');
$('#picture_add').attr('action','{/literal}{$domain}{literal}admin/gallery.php?iframe=true');
document.forms["picture_add"].submit();
$("#float_frame").load(function(){
response = $("#float_frame").contents().find("html").html();
$.scrollTo('#komunikat',800);
$('#komunikat').html(response);
setTimeout(function() {window.location.href='{/literal}{$domain}{literal}admin/gallery.php'},2000);
});
},
rules: {
active: {
required:true
}
},

messages: {
active: {
required:"{/literal}{$lang.field_is_required}{literal}"
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
$('#menu-gallery-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}