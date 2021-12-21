{*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
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
<h3>{$lang.post_edit}</h3>
{if $smarty.request.action == 'edit'}
{assign var=post value=$posts->post($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="post_add">
<p><label for="title">{$lang.title}</label> <input type="text" class="text-input large-input" name="title" id="title" value="{$post.title}" /></p>
<p><label for="text1">{$lang.text}</label><br />
<textarea name="text1" id="text1" rows="7" cols="30" class="text-input textarea">{$post.text}</textarea></p>
<p><label for="excerpt">{$lang.excerpt}</label> <textarea name="excerpt" id="excerpt" rows="7" cols="30" class="text-input textarea">{$post.excerpt}</textarea></p>
<p><label for="category">{$lang.category} {$lang.select_multiple}</label> <select name="category[]" id="category" multiple="multiple" size="10" class="medium-input">
{foreach from=$posts->categoryList('published') item=a}
<option value="{$a.id}"{if $smarty.request.action == 'edit' AND $post.categories != '' AND in_array($a.id,$post.categories)} selected="selected"{/if}>{$a.title}</option>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="category_list_submenu_post.tpl" a=$a.submenu level=$level}
{/if}
{/foreach}
</select></p>
<p><label for="slug">{$lang.slug}</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="{$post.slug}" /></p>
<p><label for="link">{$lang.link}</label> <input type="text" class="text-input large-input" name="link" id="link" value="{$post.link}" /></p>
<p><label for="order">{$lang.order}</label> <input type="text" class="text-input large-input" name="order" id="order" value="{$post.order}" /></p>
<p><label for="post_on">{$lang.post_on}</label> <input type="radio" name="post_on" id="post_on1" value="1"{if $post.post_on == '1'} checked="checked"{elseif !$post.post_on} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="post_on" id="post_on2" value="0"{if $post.post_on == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="status">{$lang.status}</label> <input type="radio" name="status" id="status1" value="published"{if $post.status == 'published'} checked="checked"{elseif (!$post.status)} checked="checked"{/if} /> {$lang.published} <input type="radio" name="status" id="status2" value="draw"{if $post.status == draw} checked="checked"{/if} /> {$lang.draw} </p>
<h3>{$lang.seo_section}</h3>
<p><label for="meta_title">{$lang.meta_title}</label> <input type="text" class="text-input large-input" name="meta_title" id="meta_title" value="{$post.meta_title}" /></p>
<p><label for="meta_description">{$lang.meta_description}</label> <textarea name="meta_description" id="meta_description" rows="5" cols="30" class="text-input textarea">{$post.meta_description}</textarea></p>
<p><label for="meta_keywords">{$lang.meta_keywords}</label> <input type="text" class="text-input large-input" name="meta_keywords" id="meta_keywords" value="{$post.meta_keywords}" /></p>
<p><label for="lang">{$lang.lang}</label> <select name="lang" id="lang" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$installed_languages item=a}
<option value="{$a.lang}"{if $post.lang == ''}{if $a.lang == $default_lang} selected="selected"{/if}{else}{if $post.lang == $a.lang} selected="selected"{/if}{/if}>{$a.name}</option>
{/foreach}
</select></p>
<p><label for="attribution">{$lang.attribution}</label> <select name="post1" id="post1" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$posts->postsList('',false) item=pages_list}
<option value="{$pages_list.id}"{if $posts->getAttribution($pages_list.id,$post.id)} selected="selected"{/if}>{$pages_list.title} ({foreach from=$installed_languages item=a}
{if $pages_list.lang == $a.lang}{$a.name}{/if}
{/foreach}
)</option>
{if $pages_list.submenu}
{assign var=level value=$level+1}
{include file="page_list_submenu_langs.tpl" pages_list=$pages_list.submenu level=$level}
{/if}
{/foreach}
</select></p>
<input type="hidden" name="type" value="post" />
<input type="hidden" name="id" value="{$post.id}" />
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
jQuery.validator.addMethod('slugExists', function(value,element) {
wartosc = ($.ajax({
url: "{/literal}{$domain}{literal}admin/post.php?action=slugExists",
async: false,
data: 'slug='+value+'&id={/literal}{$post.id}{literal}'
}));
if(wartosc.responseText == 'true') return true;
else return false;
}, '');
var info = $('#post_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
text = editor.getData();
$('#text').val(text);
$.scrollTo('#komunikat',800);
formSubmit('post_add','{/literal}{$domain}{literal}admin/post.php','{/literal}{$domain}{literal}admin/post.php');
},
rules: {
title: {
required:true,
minlength:3
},
slug: {
required:true,
minlength:3,
slugExists:true
},
post_on: {
required:true
},
status: {
required:true
},
category: {
required:true
}
},

messages: {
title: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
slug: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}",
slugExists:"{/literal}{$lang.slug_exists}{literal}"
},
post_on: {
required:"{/literal}{$lang.field_is_required}{literal}"
},
status: {
required:"{/literal}{$lang.field_is_required}{literal}"
},
category: {
required:"{/literal}{$lang.field_is_required}{literal}"
}
},
errorClass: "error"
});
{/literal}
</script>
<script type="text/javascript">
{literal}
 editor = CKEDITOR.replace( 'text1',
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
$('#menu-posts').addClass('current');
$('#menu-posts-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}