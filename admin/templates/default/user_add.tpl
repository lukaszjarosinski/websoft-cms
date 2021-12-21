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
<h3>{$lang.user_add}</h3>
{if $smarty.request.action == 'edit'}
{assign var=user value=$auth->showUser($smarty.request.id)}
{/if}
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="user_add">
<p><label for="username">{$lang.username}</label> <input type="text" class="text-input large-input" name="username" id="username" value="{$user.username}" /></p>
<p><label for="pass1">{$lang.password}</label> <input type="password" class="text-input large-input" name="pass1" id="pass1" value="" /></p>
<p><label for="pass2">{$lang.repeat_password}</label> <input type="password" class="text-input large-input" name="pass2" id="pass2" value="" /></p>
<p><label for="display_name">{$lang.display_name}</label> <input type="text" class="text-input large-input" name="display_name" id="display_name" value="{$user.display_name}" /></p><br />
<p><label for="email">{$lang.email_address}</label> <input type="text" class="text-input large-input" name="email" id="email" value="{$user.email}" /></p>
<p><label for="url">{$lang.url_address}</label> <input type="text" class="text-input large-input" name="url" id="url" value="{$user.url}" /></p>
<p><label for="permissions">{$lang.permissions}</label> <input type="radio" name="permissions" id="permissions1" value="admin"{if $user.permissions == 'admin'} checked="checked"{/if} /> {$lang.permission_admin} <input type="radio" name="permissions" id="permissions2" value="user"{if $user.permissions == 'user'} checked="checked"{/if} /> {$lang.permission_user} </p>
<input type="hidden" name="id" value="{$user.id}" />
<input type="hidden" name="action" value="add" />
<p><input type="submit" name="submit" value="{$lang.submit}" class="button" /></p>
</form>
</div>
</div>
</div>
<script type="text/javascript">
{literal}
var info = $('#user_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
$.scrollTo('#komunikat',800);
formSubmit('user_add','{/literal}{$domain}{literal}admin/user.php','{/literal}{$domain}{literal}admin/user.php');
},
rules: {
username: {
required:true,
minlength:5
},
pass1: {
required:true,
minlength:5
},
pass2: {
required:true,
minlength:5
},
permissions: {
required:true
}
},

messages: {
username: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
pass1: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
pass2: {
required:"{/literal}{$lang.field_is_required}{literal}",
minlength:"{/literal}{$lang.minimum_lenght}{literal}"
},
permissions: {
required:"{/literal}{$lang.field_is_required}{literal}"
}
},
errorClass: "error"
});
{/literal}
</script>
<script type="text/javascript">
$('#menu-users').addClass('current');
$('#menu-users-add').addClass('current');
</script>
{include file="footer.tpl"}
{include file="html_footer.tpl"}