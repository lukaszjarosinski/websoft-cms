<?php
/* Smarty version 4.0.0, created on 2021-12-01 13:20:47
  from '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/menu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.0.0',
  'unifunc' => 'content_61a7689f0875a8_61320462',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '74ffb0ce6d76c05928976228a801f062023daf9b' => 
    array (
      0 => '/home/lukaszjaro/public_html/demo/cms/admin/templates/default/menu.tpl',
      1 => 1637670066,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61a7689f0875a8_61320462 (Smarty_Internal_Template $_smarty_tpl) {
?><ul id="main-nav">
<?php if ($_smarty_tpl->tpl_vars['ADMIN_MENU']->value) {
$__section_admin_menu_0_loop = (is_array(@$_loop=$_smarty_tpl->tpl_vars['ADMIN_MENU']->value) ? count($_loop) : max(0, (int) $_loop));
$__section_admin_menu_0_total = $__section_admin_menu_0_loop;
$_smarty_tpl->tpl_vars['__smarty_section_admin_menu'] = new Smarty_Variable(array());
if ($__section_admin_menu_0_total !== 0) {
for ($__section_admin_menu_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_admin_menu']->value['index'] = 0; $__section_admin_menu_0_iteration <= $__section_admin_menu_0_total; $__section_admin_menu_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_admin_menu']->value['index']++){
echo $_smarty_tpl->tpl_vars['ADMIN_MENU']->value[(isset($_smarty_tpl->tpl_vars['__smarty_section_admin_menu']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_admin_menu']->value['index'] : null)];
}
}
}?>
<li><a href="#" class="nav-top-item" id="menu-posts">Wpisy</a>
<ul>
<li><a href="post.php" id="menu-posts-list">Lista wpisów</a></li>
<li><a href="post.php?action=add" id="menu-posts-add">Dodaj nowy</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-pages">Strony</a>
<ul>
<li><a href="page.php" id="menu-pages-list">Lista stron</a></li>
<li><a href="page.php?action=add" id="menu-pages-add">Dodaj nową</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-categories">Kategorie</a>
<ul>
<li><a href="category.php" id="menu-categories-list">Lista kategorii</a></li>
<li><a href="category.php?action=add" id="menu-categories-add">Dodaj nową</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-menus">Konfiguracja menu</a>
<ul>
<li><a href="menus.php" id="menu-menus-list">Lista menu</a></li>
<li><a href="menus.php?action=add" id="menu-menus-add">Dodaj nowe</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-links">Odnośniki</a>
<ul>
<li><a href="link.php" id="menu-links-list">Lista odnośników</a></li>
<li><a href="link.php?action=add" id="menu-links-add">Dodaj nowy</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-users">Użytkownicy</a>
<ul>
<li><a href="user.php" id="menu-users-list">Lista użytkowników</a></li>
<li><a href="user.php?action=add" id="menu-users-add">Dodaj nowego</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-boxes">Boksy z zawartością</a>
<ul>
<li><a href="box.php" id="menu-boxes-list">Lista boksów</a></li>
<li><a href="box.php?action=add" id="menu-boxes-add">Dodaj nowy</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-gallery">Galeria zdjęć</a>
<ul>
<li><a href="gallery.php?action=categories" id="menu-gallery-categories">Zarządzanie kategoriami</a></li>
<li><a href="gallery.php" id="menu-gallery-list">Edytuj zdjęcia</a></li>
<li><a href="gallery.php?action=add" id="menu-gallery-add">Dodaj nowe zdjęcie</a></li>
</ul>
</li>
<li><a href="#" class="nav-top-item" id="menu-added">Dodatki</a>
<ul>
<li><a href="instrukcja-cms.pdf" id="menu-added-help">Pomoc</a></li>
<li><a href="sitemap.php" id="menu-added-sitemap">Wygeneruj mapę strony</a></li>
<li><a href="options.php" id="menu-added-options">Konfiguracja</a></li>
</ul>
</li>
</ul>
</div>
</div><?php }
}
