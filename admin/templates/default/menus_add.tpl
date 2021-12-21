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
<h3>{$lang.menu_add}</h3>
{if $smarty.request.action == 'edit'}
{assign var=menu value=$posts->showMenu($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="menu_add">
<p><label for="title">{$lang.title}</label> <input type="text" class="text-input large-input" name="title" id="title" value="{$menu.title}" /></p>
<p><label for="slug">{$lang.slug}</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="{$menu.slug}" /></p>
<p><label for="active">{$lang.is_active}</label> <input type="radio" name="active" id="active1" value="1"{if $menu.active == '1'} checked="checked"{/if} /> {$lang.yes} <input type="radio" name="active" id="active2" value="0"{if $menu.active == '0'} checked="checked"{/if} /> {$lang.no} </p>
<p><label for="array">{$lang.select_what} {$lang.select_multiple}</label> <select name="array[]" id="array" multiple="multiple" size="10" class="large-input">
{foreach from=$posts->allList('published') item=a}
<option value="{$a.id}"{if $smarty.request.action == 'edit' AND in_array($a.id,$menu.array)} selected="selected"{/if}>{$a.title}</option>
{if $a.submenu}
{assign var=level value=$level+1}
{include file="all_list_submenu.tpl" a=$a.submenu level=$level}
{assign var=level value=0}
{/if}
{assign var=level value=0}
{/foreach}
</select></p>
<input type="hidden" name="id" value="{$lmenu.id}" />
<input type="hidden" name="action" value="add" />
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
url: "{/literal}{$domain}{literal}admin/menus.php?action=slugExists",
async: false,
data: 'slug='+value
}));
if(wartosc.responseText == 'true') return true;
else return false;
}, '');
var info = $('#menu_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
$.scrollTo('#komunikat',800);
formSubmit('menu_add','{/literal}{$domain}{literal}admin/menus.php','{/literal}{$domain}{literal}admin/menus.php');
},
rules: {
title: {
required:true,
minlength:3
},
slug: {
required:true,
minlength:3
},
active: {
required:true
},
'array[]': {
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
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
active: {
required:"{/literal}{$lang.field_is_required}{literal}"
},
'array[]': {
required:"{/literal}{$lang.field_is_required}{literal}"
}
},
errorClass: "error"
});
{/literal}
</script>
<script type="text/javascript">
$('#menu-menus').addClass('current');
$('#menu-menus-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}