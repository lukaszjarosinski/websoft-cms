{*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*}
<ul id="main-nav">
{if $ADMIN_MENU}{section name=admin_menu loop=$ADMIN_MENU}{$ADMIN_MENU[admin_menu]}{/section}{/if}
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
</div>