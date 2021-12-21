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
<h3>{$lang.box_edit}</h3>
{if $smarty.request.action == 'edit'}
{assign var=box value=$boxes->showBox($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="box_add">
<p><label for="title">{$lang.title}</label> <input type="text" class="text-input large-input" name="title" id="title" value="{$box.title}" /></p>
<p><label for="active">{$lang.is_active}</label> <input type="radio" name="active" id="active1" value="1"{if $box.active == '1'} checked="checked"{elseif !$box.active} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="active" id="active2" value="0"{if $box.active && $box.active == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="text1">{$lang.content}</label><br /><textarea name="text1" id="text1" class="text-input textarea">{$box.text}</textarea></p>
<p><label for="lang">{$lang.lang}</label> <select name="lang" id="lang" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$installed_languages item=a}
<option value="{$a.lang}"{if $box.lang == ''}{if $a.lang == $default_lang} selected="selected"{/if}{else}{if $box.lang == $a.lang} selected="selected"{/if}{/if}>{$a.name}</option>
{/foreach}
</select></p>
<p><label for="slug">{$lang.slug}</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="{$box.slug}" /></p>
<input type="hidden" name="id" value="{$box.id}" />
<input type="hidden" name="action" value="add" />
<input type="hidden" name="text" id="text" value="" />
<p><input type="submit" name="submit" value="{$lang.submit}" class="button" /></p>
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
var info = $('#box_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
text = editor.getData();
$('#text').val(text);
$.scrollTo('#komunikat',800);
formSubmit('box_add','{/literal}{$domain}{literal}admin/box.php','{/literal}{$domain}{literal}admin/box.php');
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
$('#menu-boxes').addClass('current');
$('#menu-boxes-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}