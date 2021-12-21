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
{assign var=options_list1 value=$options->optionsList()}
{if $options_list1|@count > 0}
{foreach from=$options_list1 item=y}
<div class="content-box">
<div class="content-box-header">
<h3>{$lang.options} - {$y.1}</h3>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="options{$y.0}">
{assign var=options_list value=$y.2}
{foreach from=$options_list item=x}
{assign var=xk value=$x.key}
<p><label for="{$x.key}{$y.0}">{$lang.$xk}</label> <input type="text" class="text-input medium-input" name="{$x.key}" id="{$x.key}{$y.0}" value="{$x.value}" /></p>
{/foreach}
<input type="hidden" name="lang" value="{$x.lang}" />
<input type="hidden" name="action" value="update" />
<p><input type="submit" name="submit" value="{$lang.submit}" class="button" /></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
{literal}
var info = $('#options{/literal}{$y.0}{literal}').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
formSubmit('options{/literal}{$y.0}{literal}','{/literal}{$domain}{literal}admin/options.php');
},
rules: {
},

messages: {
},
errorClass: "input-notification error png_bg"
});
{/literal}
</script>
{/foreach}
{/if}
<script type="text/javascript">
$('#menu-added').addClass('current');
$('#menu-added-options').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}