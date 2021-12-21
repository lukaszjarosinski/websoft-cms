<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:11:22
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery_categories_edit.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7666a0d04b2_60718785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72a85382962eadde1822056b35ab80a18f8c11ec' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/gallery_categories_edit.tpl',
      1 => 1637670065,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.tpl' => 1,
    'file:header.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a7666a0d04b2_60718785 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:html_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="main-content">
<?php if ($_smarty_tpl->tpl_vars['komunikat']->value <> '') {?>
<p class="komunikat"><?php echo $_smarty_tpl->tpl_vars['komunikat']->value;?>
</p>
<?php }?>
<div id="komunikat"></div>
<div class="content-box">
<div class="content-box-header">
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['gallery_categories_edit'];?>
</h3>
<?php if ($_REQUEST['action'] == 'categories_edit') {
$_smarty_tpl->_assignInScope('category', $_smarty_tpl->tpl_vars['gallery']->value->showCategory($_REQUEST['id']));
}?>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="category_add" name="category_add" enctype="multipart/form-data">
<p><label for="title"><?php echo $_smarty_tpl->tpl_vars['lang']->value['title'];?>
</label> <input type="text" class="text-input large-input" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
" /></p>
<p><label for="active"><?php echo $_smarty_tpl->tpl_vars['lang']->value['is_active'];?>
</label> <input type="radio" name="active" id="active1" value="1"<?php if ($_smarty_tpl->tpl_vars['category']->value['active'] == '1') {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['yes'];?>
 <input type="radio" name="active" id="active2" value="0"<?php if ($_smarty_tpl->tpl_vars['category']->value['active'] == '0') {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['no'];?>
 </p>
<p><label for="text1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['content'];?>
</label><br /><textarea name="text1" id="text1" class="text-input textarea"><?php echo $_smarty_tpl->tpl_vars['category']->value['text'];?>
</textarea></p>
<p><label for="lang"><?php echo $_smarty_tpl->tpl_vars['lang']->value['lang'];?>
</label> <select name="lang" id="lang" class="small-input"><option value="">--<?php echo $_smarty_tpl->tpl_vars['lang']->value['select'];?>
--</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['installed_languages']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['a']->value['lang'];?>
"<?php if ($_smarty_tpl->tpl_vars['category']->value['lang'] == '') {
if ($_smarty_tpl->tpl_vars['a']->value['lang'] == $_smarty_tpl->tpl_vars['default_lang']->value) {?> selected="selected"<?php }
} else {
if ($_smarty_tpl->tpl_vars['category']->value['lang'] == $_smarty_tpl->tpl_vars['a']->value['lang']) {?> selected="selected"<?php }
}?>><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select></p>
<p><label for="slug"><?php echo $_smarty_tpl->tpl_vars['lang']->value['slug'];?>
</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['slug'];?>
" /></p>
<?php if (($_smarty_tpl->tpl_vars['category']->value['icon'] <> '')) {
$_smarty_tpl->_assignInScope('big_image', ((string)$_smarty_tpl->tpl_vars['gallery_dir']->value).((string)$_smarty_tpl->tpl_vars['category']->value['icon']));
$_smarty_tpl->_assignInScope('min_image', ((string)$_smarty_tpl->tpl_vars['gallery_dir']->value).((string)$_smarty_tpl->tpl_vars['min_prefix']->value).((string)$_smarty_tpl->tpl_vars['category']->value['icon']));
if (file_exists($_smarty_tpl->tpl_vars['big_image']->value)) {
$_smarty_tpl->_assignInScope('image', $_smarty_tpl->tpl_vars['big_image']->value);
} elseif (file_exists($_smarty_tpl->tpl_vars['min_image']->value)) {
$_smarty_tpl->_assignInScope('image', $_smarty_tpl->tpl_vars['min_image']->value);
}
if (file_exists($_smarty_tpl->tpl_vars['image']->value)) {?><p><label><?php echo $_smarty_tpl->tpl_vars['lang']->value['actual_icon'];?>
</label> <img src="<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
images/gallery/<?php if (file_exists($_smarty_tpl->tpl_vars['min_image']->value)) {
echo $_smarty_tpl->tpl_vars['min_prefix']->value;
}
echo $_smarty_tpl->tpl_vars['category']->value['icon'];?>
" alt="" /></p>
<p><span><?php echo $_smarty_tpl->tpl_vars['lang']->value['delete_icon'];?>
</span> <input type="checkbox" name="delete_icon" id="delete_icon" value="1" /></p>
<?php }
}?>
<p><label for="icon"><?php echo $_smarty_tpl->tpl_vars['lang']->value['icon'];?>
</label> <input type="file" class="text-input large-input" name="icon" id="icon" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['icon'];?>
" /></p>
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
" />
<input type="hidden" name="action" value="categories_add" />
<input type="hidden" name="text" id="text" value="" />
<input type="hidden" name="iframe" id="iframe" value="true" />
<p><input type="submit" name="submit1" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['submit'];?>
" class="button" /></p>
</form>
</div>
</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">

$('#title').change(function() {
title = $(this).val();
$.ajax({
url: "<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/?slugCreate=true&data="+title
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
$('#category_add').attr('action','<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php');
document.forms["category_add"].submit();
$("#float_frame").load(function(){
response = $("#float_frame").contents().find("html").html();
$.scrollTo('#komunikat',800);
$('#komunikat').html(response);
setTimeout(function() {window.location.href='<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/gallery.php?action=categories'},2000);
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
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
",
minlength:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['minimum_lenght'];?>
"
},
active: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
"
},
slug: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
",
minlength:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['minimum_lenght'];?>
"
}
},
errorClass: "error"
});

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">

 var editor = CKEDITOR.replace( 'text1',
    {
        filebrowserBrowseUrl : '<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/ckeditor/filemanager/connectors/php/connector.php',
        filebrowserUploadUrl : '<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/ckeditor/uploader/upload.php?Type=Image&Connector=<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
js/ckeditor/filemanager/connectors/php/connector.php',
				resize_enabled: false,
				scayt_autoStartup: false,
				entities: false
});

<?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
$('#menu-gallery').addClass('current');
$('#menu-gallery-categories').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
