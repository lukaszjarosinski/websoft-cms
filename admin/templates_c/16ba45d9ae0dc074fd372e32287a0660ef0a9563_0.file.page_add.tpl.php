<?php
/* Smarty version 4.0.0, created on 2021-12-02 09:24:16
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/page_add.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a882b08765e7_99417314',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '16ba45d9ae0dc074fd372e32287a0660ef0a9563' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/page_add.tpl',
      1 => 1637670067,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:html_header.tpl' => 1,
    'file:header.tpl' => 1,
    'file:menu.tpl' => 1,
    'file:page_list_submenu_post.tpl' => 1,
    'file:page_list_submenu_langs.tpl' => 1,
    'file:footer.tpl' => 1,
    'file:html_footer.tpl' => 1,
  ),
),false)) {
function content_61a882b08765e7_99417314 (Smarty_Internal_Template $_smarty_tpl) {
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
<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['page_add'];?>
</h3>
<?php if ($_REQUEST['action'] == 'edit') {
$_smarty_tpl->_assignInScope('post', $_smarty_tpl->tpl_vars['posts']->value->post($_REQUEST['id']));
}?>
</div>
<div class="content-box-content">
<div class="tab-content default-tab" id="tab1">
<form action="" method="post" id="page_add">
<p><label for="title"><?php echo $_smarty_tpl->tpl_vars['lang']->value['title'];?>
</label> <input type="text" class="text-input large-input" name="title" id="title" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['title'];?>
" /></p>
<p><label for="text1"><?php echo $_smarty_tpl->tpl_vars['lang']->value['text'];?>
</label><br /><textarea name="text1" id="text1" rows="7" cols="30" class="text-input textarea"><?php echo $_smarty_tpl->tpl_vars['post']->value['text'];?>
</textarea></p>
<p><label for="excerpt"><?php echo $_smarty_tpl->tpl_vars['lang']->value['excerpt'];?>
</label> <textarea name="excerpt" id="excerpt" rows="7" cols="30" class="text-input textarea"><?php echo $_smarty_tpl->tpl_vars['post']->value['excerpt'];?>
</textarea></p>
<p><label for="slug"><?php echo $_smarty_tpl->tpl_vars['lang']->value['slug'];?>
</label> <input type="text" class="text-input large-input" name="slug" id="slug" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['slug'];?>
" /></p>
<p><label for="link"><?php echo $_smarty_tpl->tpl_vars['lang']->value['link'];?>
</label> <input type="text" class="text-input large-input" name="link" id="link" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['link'];?>
" /></p>
<p><label for="parent"><?php echo $_smarty_tpl->tpl_vars['lang']->value['parent'];?>
</label> <select name="parent" id="parent" class="medium-input"><option value="">--<?php echo $_smarty_tpl->tpl_vars['lang']->value['select'];?>
--</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value->parentPagesList($_smarty_tpl->tpl_vars['post']->value['id']), 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
$_smarty_tpl->_assignInScope('level', 0);?>
<option value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['a']->value['id'] == $_smarty_tpl->tpl_vars['post']->value['parent']) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['a']->value['title'];?>
</option>
<?php if ($_smarty_tpl->tpl_vars['a']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:page_list_submenu_post.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('a'=>$_smarty_tpl->tpl_vars['a']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select></p>
<p><label for="order"><?php echo $_smarty_tpl->tpl_vars['lang']->value['order'];?>
</label> <input type="text" class="text-input small-input" name="order" id="order" value="<?php echo $_smarty_tpl->tpl_vars['posts']->value->getMaxOrder('page');?>
" /></p>
<p><label for="post_on"><?php echo $_smarty_tpl->tpl_vars['lang']->value['post_on'];?>
</label> <input type="radio" name="post_on" id="post_on1" value="1"<?php if ($_smarty_tpl->tpl_vars['post']->value['post_on'] == '1') {?> checked="checked"<?php } elseif (!$_smarty_tpl->tpl_vars['post']->value['post_on']) {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['yes'];?>
 <input type="radio" name="post_on" id="post_on2" value="0"<?php if ($_smarty_tpl->tpl_vars['post']->value['post_on'] && $_smarty_tpl->tpl_vars['post']->value['post_on'] == '0') {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['no'];?>
 </p>
<p><label for="status"><?php echo $_smarty_tpl->tpl_vars['lang']->value['status'];?>
</label> <input type="radio" name="status" id="status1" value="published"<?php if ($_smarty_tpl->tpl_vars['post']->value['status'] == 'published') {?> checked="checked"<?php } elseif ((!$_smarty_tpl->tpl_vars['post']->value['status'])) {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['published'];?>
 <input type="radio" name="status" id="status2" value="draw"<?php if ($_smarty_tpl->tpl_vars['post']->value['status'] == 'draw') {?> checked="checked"<?php }?> /> <?php echo $_smarty_tpl->tpl_vars['lang']->value['draw'];?>
 </p>

<h3><?php echo $_smarty_tpl->tpl_vars['lang']->value['seo_section'];?>
</h3>
<p><label for="meta_title"><?php echo $_smarty_tpl->tpl_vars['lang']->value['meta_title'];?>
</label> <input type="text" class="text-input large-input" name="meta_title" id="meta_title" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_title'];?>
" /></p>
<p><label for="meta_description"><?php echo $_smarty_tpl->tpl_vars['lang']->value['meta_description'];?>
</label> <textarea name="meta_description" id="meta_description" rows="5" cols="30" class="text-input textarea"><?php echo $_smarty_tpl->tpl_vars['post']->value['meta_description'];?>
</textarea></p>
<p><label for="meta_keywords"><?php echo $_smarty_tpl->tpl_vars['lang']->value['meta_keywords'];?>
</label> <input type="text" class="text-input large-input" name="meta_keywords" id="meta_keywords" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['meta_keywords'];?>
" /></p>
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
"<?php if ($_smarty_tpl->tpl_vars['post']->value['lang'] == '') {
if ($_smarty_tpl->tpl_vars['a']->value['lang'] == $_smarty_tpl->tpl_vars['default_lang']->value) {?> selected="selected"<?php }
} else {
if ($_smarty_tpl->tpl_vars['post']->value['lang'] == $_smarty_tpl->tpl_vars['a']->value['lang']) {?> selected="selected"<?php }
}?>><?php echo $_smarty_tpl->tpl_vars['a']->value['name'];?>
</option>
<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select></p>
<p><label for="attribution"><?php echo $_smarty_tpl->tpl_vars['lang']->value['attribution'];?>
</label> <select name="post1" id="post1" class="small-input"><option value="">--<?php echo $_smarty_tpl->tpl_vars['lang']->value['select'];?>
--</option>
<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['posts']->value->pagesList('',false), 'pages_list');
$_smarty_tpl->tpl_vars['pages_list']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pages_list']->value) {
$_smarty_tpl->tpl_vars['pages_list']->do_else = false;
?>
<option value="<?php echo $_smarty_tpl->tpl_vars['pages_list']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['posts']->value->getAttribution($_smarty_tpl->tpl_vars['pages_list']->value['id'],$_smarty_tpl->tpl_vars['post']->value['id'])) {?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['pages_list']->value['title'];?>
 (<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['installed_languages']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
if ($_smarty_tpl->tpl_vars['pages_list']->value['lang'] == $_smarty_tpl->tpl_vars['a']->value['lang']) {
echo $_smarty_tpl->tpl_vars['a']->value['name'];
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
)</option>
<?php if ($_smarty_tpl->tpl_vars['pages_list']->value['submenu']) {
$_smarty_tpl->_assignInScope('level', $_smarty_tpl->tpl_vars['level']->value+1);
$_smarty_tpl->_subTemplateRender("file:page_list_submenu_langs.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('pages_list'=>$_smarty_tpl->tpl_vars['pages_list']->value['submenu'],'level'=>$_smarty_tpl->tpl_vars['level']->value), 0, true);
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
</select></p>
<input type="hidden" name="type" value="page" />
<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['post']->value['post']['id'];?>
" />
<input type="hidden" name="action" value="add" />
<input type="hidden" name="text" id="text" value="" />
<p><input type="submit" name="submit" value="<?php echo $_smarty_tpl->tpl_vars['lang']->value['submit'];?>
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
jQuery.validator.addMethod('slugExists', function(value,element) {
wartosc = ($.ajax({
url: "<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php?action=slugExists",
async: false,
data: 'slug='+value
}));
if(wartosc.responseText == 'true') return true;
else return false;
}, '');
var info = $('#page_add').validate({
onkeyup:false,
onclick:false,
submitHandler: function() {
text = editor.getData();
$('#text').val(text);
$.scrollTo('#komunikat',800);
formSubmit('page_add','<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php','<?php echo $_smarty_tpl->tpl_vars['domain']->value;?>
admin/page.php');
},
rules: {
title: {
required:true,
minlength:1
},
slug: {
required:true,
minlength:1,
slugExists:true
},
post_on: {
required:true
},
status: {
required:true
}
},

messages: {
title: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
",
minlength:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['minimum_lenght'];?>
"
},
slug: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
",
minlength:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['minimum_lenght'];?>
",
slugExists:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['slug_exists'];?>
"
},
post_on: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
"
},
status: {
required:"<?php echo $_smarty_tpl->tpl_vars['lang']->value['field_is_required'];?>
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
$('#menu-pages').addClass('current');
$('#menu-pages-add').addClass('current');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:html_footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
