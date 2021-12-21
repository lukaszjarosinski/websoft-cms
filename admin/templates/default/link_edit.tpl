{*
Copyright 2012 by Łukasz Jarosiński
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
<h3>{$lang.link_edit}</h3>
{if $smarty.request.action == 'edit'}
{assign var=link value=$links->showLink($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="link_add">
<p><label for="anchor">{$lang.anchor}</label> <input type="text" class="text-input large-input" name="anchor" id="anchor" value="{$link.anchor}" /></p>
<p><label for="title">{$lang.title}</label> <input type="text" class="text-input large-input" name="title" id="title" value="{$link.title}" /></p>
<p><label for="url">{$lang.url_address}</label> <input type="text" class="text-input large-input" name="url" id="url" value="{$link.url}" /></p>
<p><label for="active">{$lang.is_active}</label> <input type="radio" name="active" id="active1" value="1"{if $link.active == '1'} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="active" id="active2" value="0"{if $link.active == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="target">{$lang.target}</label><br />
<input type="radio" name="target" value="_blank"{if $link.target == '_blank'} checked="checked"{/if}  />
<code>_blank</code> &mdash; nowe okno lub karta.<br />
<input type="radio" name="target" value="_top"{if $link.target == '_top'} checked="checked"{/if}  />
<code>_top</code> &mdash; bieżące okno lub karta, bez ramek.<br />
<input type="radio" name="target" value=""{if $link.target == ''} checked="checked"{/if}  />
<code>_none</code> &mdash; to samo okno lub karta.
</p>
<p><label for="rel">{$lang.rel}</label> <input type="text" class="text-input large-input" name="rel" id="rel" value="{$link.rel}" /></p>
<p><label for="lang">{$lang.lang}</label> <select name="lang" id="lang" class="small-input"><option value="">--{$lang.select}--</option>
{foreach from=$installed_languages item=a}
<option value="{$a.lang}"{if $link.lang == ''}{if $a.lang == $default_lang} selected="selected"{/if}{else}{if $link.lang == $a.lang} selected="selected"{/if}{/if}>{$a.name}</option>
{/foreach}
</select></p>
<input type="hidden" name="id" value="{$link.id}" />
<input type="hidden" name="action" value="add" />
<p><input type="submit" name="submit" value="{$lang.submit}" class="button" /></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
{literal}
var info = $('#link_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
$.scrollTo('#komunikat',800);
formSubmit('link_add','{/literal}{$domain}{literal}admin/link.php','{/literal}{$domain}{literal}admin/link.php');
},
rules: {
title: {
required:true,
minlength:3
},
anchor: {
required:true,
minlength:3
},
url: {
required:true,
minlength:3
},
active: {
required:true
}
},

messages: {
title: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
anchor: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
url: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
active: {
required:"{/literal}{$lang.field_is_required}{literal}"
}
},
errorClass: "error"
});
{/literal}
</script>
<script type="text/javascript">
$('#menu-links').addClass('current');
$('#menu-links-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}