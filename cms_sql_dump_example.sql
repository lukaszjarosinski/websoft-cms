SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE TABLE `cms_attribution` (
  `post1` bigint(20) NOT NULL,
  `post2` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `cms_boxes` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'tytuł, głównie dla panelu admina',
  `author` bigint(20) NOT NULL COMMENT 'autor boksu',
  `modified` datetime NOT NULL COMMENT 'data modyfikacji',
  `active` tinyint(4) NOT NULL COMMENT 'aktywny?',
  `text` text CHARACTER SET utf8 NOT NULL COMMENT 'zawartość',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '''pl''' COMMENT 'język',
  `slug` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'skrót nazwy, bez spacji, polskich znaków itp'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms_boxes` (`id`, `title`, `author`, `modified`, `active`, `text`, `lang`, `slug`) VALUES
(1, 'Boks w nagłówku', 1, '2012-11-17 11:28:02', 1, '<p>\r\n	<span>Witaj!</span>&nbsp; To jest testowa wersja systemu WCMS w wersji 4.0. Zapraszamy również na <a href=\"http://www.lukaszjarosinski.com\" target=\"_blank\">www.lukaszjarosinski.com</a>.</p>\r\n', 'pl', 'box-header');

CREATE TABLE `cms_comments` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL COMMENT 'id wpisu, którego dotyczy',
  `text` text CHARACTER SET utf8 NOT NULL COMMENT 'treść',
  `active` tinyint(1) NOT NULL COMMENT 'czy aktywny',
  `author_id` bigint(20) NOT NULL COMMENT 'id autora',
  `created` datetime NOT NULL COMMENT 'data utworzenia',
  `parent` bigint(20) NOT NULL COMMENT 'nadrzędny'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela komentarzy do wpisów';

CREATE TABLE `cms_gallery_categories` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'nazwa kategorii',
  `author` bigint(20) NOT NULL COMMENT 'autor',
  `modified` datetime NOT NULL COMMENT 'data ostatniej modyfikacji',
  `active` tinyint(1) NOT NULL COMMENT 'czy kategoria aktywna',
  `text` text CHARACTER SET utf8 NOT NULL COMMENT 'opis',
  `lang` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'język',
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'skrót nazwy, bez spacji, polskich znaków itp.',
  `icon` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'ikonka'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms_gallery_categories` (`id`, `title`, `author`, `modified`, `active`, `text`, `lang`, `slug`, `icon`) VALUES
(34, 'Kategoria przykładowa', 1, '2012-12-12 16:40:11', 1, '<p>\r\n	Jakiś opis kategorii przykładowej</p>\r\n', 'pl', 'kategoria-przykladowa', 'allegro.jpg');

CREATE TABLE `cms_gallery_pictures` (
  `id` bigint(20) NOT NULL,
  `author` bigint(20) NOT NULL COMMENT 'autor',
  `modified` datetime NOT NULL COMMENT 'data ostatniej modyfikacji',
  `active` tinyint(1) NOT NULL COMMENT 'czy zdjęcie aktywne',
  `text` text CHARACTER SET utf8 NOT NULL COMMENT 'opis',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT 'język',
  `image` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'nazwa obrazka',
  `category_id` bigint(20) NOT NULL COMMENT 'numer kategorii',
  `position` bigint(20) NOT NULL COMMENT 'kolejność zdjęć'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms_gallery_pictures` (`id`, `author`, `modified`, `active`, `text`, `lang`, `image`, `category_id`, `position`) VALUES
(2, 1, '2012-07-26 10:02:58', 1, '<p>\r\n	Krótki opis</p>\r\n', 'pl', 'full-pics01.jpg', 34, 1),
(4, 1, '2012-07-26 09:45:39', 1, '<p>\r\n	Kr', 'pl', 'full-pics03.jpg', 34, 3),
(5, 1, '2012-07-26 09:47:56', 1, '<p>\r\n	Kr', 'pl', 'full-pics02.jpg', 34, 2);

CREATE TABLE `cms_links` (
  `id` bigint(20) NOT NULL,
  `anchor` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'anchor text',
  `title` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'tytuł',
  `url` text CHARACTER SET utf8 NOT NULL COMMENT 'adres docelowy',
  `active` tinyint(4) NOT NULL COMMENT 'czy aktywny?',
  `target` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT 'gdzie otwierać?',
  `rel` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'atrybut rel',
  `author` bigint(20) NOT NULL COMMENT 'autor',
  `modified` datetime NOT NULL COMMENT 'data modyfikacji',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '''pl''' COMMENT 'język'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela linków';

INSERT INTO `cms_links` (`id`, `anchor`, `title`, `url`, `active`, `target`, `rel`, `author`, `modified`, `lang`) VALUES
(1, 'Projektowanie stron www', 'Tworzenie stron www', 'http://www.lukaszjarosinski.com', 1, '_blank', '', 1, '2012-11-17 11:28:20', 'pl'),
(2, 'Tusze do drukarek', 'Tanie tusze i tonery do drukarek', 'http://www.tanie-tusze.net', 1, '_blank', '', 1, '2012-07-27 13:44:09', 'pl');

CREATE TABLE `cms_menus` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `cms_menus` (`id`, `title`, `slug`, `active`) VALUES
(1, 'Menu górne', 'menu-gorne', 1);

CREATE TABLE `cms_menus_content` (
  `id` bigint(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  `post` bigint(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `cms_menus_content` (`id`, `menu_id`, `post`) VALUES
(1, 1, 9),
(2, 1, 7),
(3, 1, 13),
(4, 1, 12),
(5, 1, 11);

CREATE TABLE `cms_metaoptions` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL COMMENT 'id wpisu, którego dotyczy',
  `key` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'klucz',
  `value` text CHARACTER SET utf8 NOT NULL COMMENT 'wartość'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela dotycząca dodatkowych pól do wpisów (np. meta tagi, miniaturki)';

CREATE TABLE `cms_options` (
  `id` int(10) NOT NULL,
  `key` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'klucz',
  `value` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'wartość',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL COMMENT 'język'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `cms_options` (`id`, `key`, `value`, `lang`) VALUES
(1, 'meta_title', 'Wersja demonstracyjna systemu WCMS 4.0', 'pl'),
(2, 'meta_description', 'Wersja demonstracyjna systemu WCMS 4.0 - meta description', 'pl'),
(3, 'meta_keywords', 'system cms, wcms, tworzenie stron, projektowanie stron', 'pl'),
(4, 'robots', 'index, follow', 'pl'),
(7, 'meta_title', 'Title en', 'en'),
(8, 'meta_description', 'Description en', 'en'),
(9, 'meta_keywords', 'Keywords en', 'en'),
(10, 'robots', 'index, follow', 'en');

CREATE TABLE `cms_posts` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'tytuł wpisu, kategorii',
  `text` text CHARACTER SET utf8 NOT NULL COMMENT 'treść',
  `excerpt` text CHARACTER SET utf8 NOT NULL COMMENT 'wypis',
  `type` text CHARACTER SET utf8 NOT NULL COMMENT 'typ wpisu (np. strona, kategoria itd.)',
  `slug` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'krótka nazwa (linki)',
  `parent` bigint(20) NOT NULL COMMENT 'nadrzędny',
  `order` bigint(20) NOT NULL COMMENT 'pozycja w menu',
  `post_on` tinyint(1) NOT NULL COMMENT 'wpis aktywny/widoczny',
  `created` datetime NOT NULL COMMENT 'data utworzenia',
  `modified` datetime NOT NULL COMMENT 'data modyfikacji',
  `author` bigint(20) NOT NULL COMMENT 'autor',
  `status` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'status (widoczny, usunięty itd.)',
  `lang` varchar(10) CHARACTER SET utf8 NOT NULL DEFAULT '''pl''' COMMENT 'język',
  `link` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'link do zewnętrznej strony'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='tabela wpisów (kategorie, wpisy, strony itd.)';

INSERT INTO `cms_posts` (`id`, `title`, `text`, `excerpt`, `type`, `slug`, `parent`, `order`, `post_on`, `created`, `modified`, `author`, `status`, `lang`, `link`) VALUES
(1, 'Kategoria 1', '', '', 'category', 'kategoria-1', 0, 2, 1, '0000-00-00 00:00:00', '2012-07-27 13:36:33', 1, 'published', 'pl', ''),
(5, 'Kategoria 2', '', '', 'category', 'kategoria-2', 1, 3, 1, '2011-12-21 23:18:58', '2012-01-08 23:29:37', 1, 'published', 'pl', ''),
(7, 'Kontakt', '<p>\r\n	[map id=\"mapka\" address=\"Sportowa 2, Suchań\" latlng=\"51.754240,19.467773\" text=\"sad\" width=\"550\" height=\"300\"]</p>\r\n<p>\r\n	[contactform email=\"biuro@wawrus.pl\" id=\"contactform\" com_id=\"komunikat\"]</p>\r\n', 'Strona z danymi kontaktowymi', 'page', 'kontakt', 0, 4, 1, '2012-01-02 17:14:19', '2012-11-17 11:55:58', 1, 'published', 'pl', ''),
(8, 'Lorem ipsum', '<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et condimentum tortor. Donec nec massa at nulla dapibus rutrum vel eget erat. Cras accumsan, velit iaculis vehicula accumsan, elit est iaculis enim, quis porttitor nisl sapien tincidunt tellus. Donec adipiscing enim sed urna ultrices tincidunt. Duis sagittis auctor augue id commodo. Mauris eu lacus ut libero vehicula bibendum. Nam pulvinar tempus mi vel dapibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum in ante ac turpis tincidunt sollicitudin. Aenean id nibh vestibulum tortor luctus pretium. Quisque ac ligula ullamcorper dui imperdiet ultricies. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>\r\n	<p>\r\n		Curabitur est nibh, pretium ut iaculis quis, tempor eget ligula. Nullam ac lectus justo. Nam dictum malesuada velit at interdum. Sed lobortis, felis et sagittis ornare, massa purus lacinia turpis, a dignissim mi ligula vehicula mauris. Mauris ut elit tellus, at venenatis enim. Mauris nec turpis velit. Suspendisse ut risus purus.</p>\r\n	<p>\r\n		Donec at tempus metus. Praesent sit amet egestas libero. Ut ut tortor elit. Suspendisse aliquam consectetur leo et commodo. Etiam magna risus, congue ac faucibus id, cursus eu leo. Cras eu nisi purus. Curabitur pretium est sed libero rhoncus a venenatis nunc pretium. Suspendisse porta tristique nulla eu tempus. Cras ut risus at tortor porttitor sagittis. Aliquam sit amet massa ante, ac sodales urna. In non massa non lorem egestas sollicitudin. Etiam eu velit nibh, mollis adipiscing massa. Nam bibendum scelerisque orci, at imperdiet sapien gravida at. Nullam quis mauris sit amet magna elementum molestie. Quisque dignissim porttitor lorem eget viverra.</p>\r\n	<p>\r\n		Aliquam quis ante vitae mi tempor congue. Praesent eget ipsum ornare felis dictum tempor rutrum vel nibh. In ultrices scelerisque faucibus. In sem velit, imperdiet sit amet ultrices non, consectetur vitae dui. Mauris lacus purus, egestas non mattis nec, molestie eu tellus. Praesent at dolor vel mauris blandit ultricies. Curabitur et lorem nisl. Pellentesque dictum, nisl vitae fringilla blandit, nibh risus vestibulum est, a feugiat arcu magna in ipsum. Ut scelerisque posuere arcu, nec condimentum sapien auctor a. Vivamus urna lorem, ornare feugiat dictum sit amet, placerat ac massa. Vestibulum placerat pellentesque neque, vel vulputate nisl tincidunt ac. Nulla eu elit sapien. Nulla aliquam facilisis porttitor. Curabitur dignissim, magna ac blandit lobortis, urna lectus blandit tellus, eu gravida urna odio et ipsum. Vestibulum tincidunt molestie lectus, quis convallis magna scelerisque in.</p>\r\n	<p>\r\n		Phasellus consectetur nisl sed mauris ultrices vulputate. Quisque quis ipsum ut eros pharetra luctus eget in mauris. Maecenas a vehicula nulla. Aliquam laoreet, urna id varius tempor, libero purus semper sapien, eget rutrum elit neque at magna. Curabitur blandit gravida metus et porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis vestibulum congue sem id tempor. Nam condimentum, nisl id dictum cursus, quam elit vestibulum elit, quis dignissim sem massa in augue. Integer urna libero, ultrices eget pharetra et, pretium a ante. Nullam cursus faucibus congue. Morbi faucibus fermentum pellentesque. Quisque sem libero, semper ut ornare a, lobortis non orci.</p>\r\n</div>\r\n', 'Lorem ipsum', 'post', 'lorem-ipsum', 0, 1, 1, '2012-01-02 17:53:48', '2012-11-17 11:41:26', 1, 'published', 'pl', ''),
(9, 'Oferta', '<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam et leo augue. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut id turpis nisi, eget ullamcorper turpis. Pellentesque facilisis sem eu velit dignissim sagittis. Cras nisl nisl, elementum non lacinia ut, iaculis sed risus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Aliquam consequat, diam ac facilisis ullamcorper, ligula velit rhoncus libero, ut dictum massa tellus nec elit. Curabitur egestas felis id purus mollis cursus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Mauris in odio lorem, vehicula ultricies leo. Sed vitae porta velit. Integer id molestie sapien. Vestibulum ultricies neque ac lorem hendrerit vulputate.</p>\r\n	<p>\r\n		Praesent quis mi libero. Etiam porta, erat nec pharetra accumsan, nisi leo tristique risus, non pellentesque erat risus sollicitudin tortor. Morbi nec nisl est. Cras sem mauris, lacinia vel ultrices consectetur, lacinia et orci. Nulla porta nulla quis nulla ullamcorper eu semper ligula mollis. Praesent at fermentum tortor. Donec eleifend eleifend sapien convallis dictum. Aliquam ut nulla enim. Curabitur a libero lacus, ac porttitor urna. Proin sodales, sem id feugiat adipiscing, magna turpis blandit ipsum, sit amet accumsan augue nisi vitae odio.</p>\r\n	<p>\r\n		[box id=\'box-header\']</p>\r\n	<p>\r\n		In et ligula sit amet ipsum vulputate fermentum ac lacinia eros. Integer eros dui, ultrices quis luctus vitae, malesuada vel est. Donec mi metus, laoreet eu pulvinar ut, feugiat at odio. Quisque molestie mauris at dolor vehicula non euismod odio vehicula. Nam ut metus dui. Aliquam erat volutpat. Etiam sollicitudin commodo est vel cursus.</p>\r\n	<p>\r\n		Nunc aliquam, est vehicula euismod tristique, mi mauris tincidunt urna, sed rhoncus nulla libero id dui. Suspendisse ut turpis ligula, et bibendum sapien. Praesent eu tortor est, nec fringilla justo. Donec iaculis est quis enim lobortis rutrum. Etiam eleifend egestas magna id suscipit. Nam viverra, ipsum eget laoreet ullamcorper, dui arcu fermentum purus, vel vulputate metus purus dictum leo. Sed eu nisl sit amet urna ultricies egestas a eu nulla. Praesent eget nisl a lacus aliquam tincidunt.</p>\r\n	<p>\r\n		Mauris mi nulla, feugiat vitae scelerisque vitae, aliquam id arcu. Donec vel augue id lorem volutpat viverra at ac enim. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Fusce blandit bibendum dignissim. Nam molestie tellus non risus luctus accumsan. Mauris quis lacus magna, nec convallis sem. Fusce facilisis rutrum leo, consectetur fringilla odio iaculis sit amet. Etiam tincidunt, erat vehicula tincidunt blandit, nisl est iaculis quam, vitae consectetur mi metus eget augue. Curabitur gravida porta massa ut consequat. Morbi dignissim, mi id porta porta, lectus lorem fermentum nunc, eget venenatis felis nibh ut lacus. Vestibulum cursus risus sit amet lorem sodales vitae interdum est commodo. Praesent interdum sem eu erat viverra non mattis elit accumsan. Nullam convallis ultricies rhoncus. Nulla commodo ultricies augue et pretium. Proin viverra elementum dolor, quis aliquet risus suscipit at. Fusce fringilla hendrerit vestibulum.</p>\r\n</div>\r\n', 'Lorem ipsum', 'page', 'oferta', 0, 1, 1, '2012-05-21 15:48:45', '2012-12-05 10:01:06', 1, 'published', 'pl', ''),
(10, 'Dolor sit amet', '<p style=\"text-align: right;\">\r\n	<img alt=\"\" src=\"http://lukaszjarosinski.pl/demo/cms/images/userfiles/file/picture.jpg\" style=\"width: 500px; height: 500px; float: right;\" /></p>\r\n<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vehicula libero vitae augue sollicitudin posuere. Praesent quis mi at mi tincidunt lacinia. Maecenas quis felis urna, a condimentum nunc. Donec nibh tellus, suscipit quis ultricies vitae, dapibus in risus. Aenean elit tortor, imperdiet nec auctor nec, condimentum eu augue. Nam pharetra ante in lectus tempus vitae aliquam odio scelerisque. Curabitur luctus purus suscipit arcu interdum accumsan. Maecenas ut diam ipsum, ut ultricies diam. Maecenas fringilla mauris vitae urna consectetur eget iaculis massa pharetra. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris imperdiet sagittis fermentum. Donec urna nibh, pellentesque quis volutpat eu, vulputate quis ipsum. Ut sit amet mi sit amet metus blandit sollicitudin sit amet sed ante.</p>\r\n	<p>\r\n		Nulla nibh augue, malesuada a pellentesque ut, iaculis sed orci. Nam non ipsum eu metus lobortis venenatis. Etiam lorem erat, porttitor a elementum sit amet, fermentum nec magna. Suspendisse posuere elit vitae mauris porttitor id pharetra magna mattis. Morbi id mauris quis sapien laoreet aliquet venenatis nec mi. Donec ligula metus, malesuada ut scelerisque nec, cursus at nisi. Duis massa sapien, luctus sed laoreet eget, dictum eget enim. Sed pretium ligula quam. Duis mollis nunc non odio auctor pharetra. Morbi eleifend accumsan tristique. Integer luctus diam eu lectus pellentesque malesuada. Sed nec lorem tellus, eget suscipit enim. Nunc auctor, nibh nec blandit fringilla, dui nisl fermentum nisi, sagittis accumsan magna erat vel elit. Aenean auctor venenatis turpis, ut pretium quam ultrices venenatis.</p>\r\n	<p>\r\n		Curabitur sed massa sem, ut ultrices lectus. Nulla pulvinar elit odio, sit amet iaculis nunc. Fusce ut orci lorem, quis malesuada enim. Integer enim massa, viverra eget semper a, condimentum sed orci. Pellentesque malesuada venenatis interdum. Fusce vestibulum gravida varius. Donec purus ante, tempus non dictum vel, vestibulum imperdiet risus. In nec ipsum tortor, vitae vehicula quam. Nullam sem dui, auctor sit amet tempor semper, faucibus vitae lacus. Aenean viverra mattis suscipit. Etiam sit amet lectus quis enim ultrices cursus. Vestibulum a arcu eget est ultrices adipiscing non ut eros. Suspendisse mattis aliquet nisl eget facilisis. Aliquam erat volutpat. Etiam ante felis, tristique ut ornare quis, sollicitudin vitae arcu.</p>\r\n	<p>\r\n		Curabitur pharetra blandit nibh, quis euismod dui porttitor eu. Aenean lectus sem, commodo id venenatis id, dignissim sodales ipsum. Nam tristique ultrices orci congue cursus. Morbi semper ornare mattis. Proin laoreet facilisis suscipit. Integer arcu ligula, pulvinar sed porta at, elementum id turpis. Fusce a diam nisl, sit amet pulvinar velit. Etiam sit amet bibendum augue. Proin non leo lectus, ac mollis odio. Cras facilisis aliquam tincidunt. Integer nunc ipsum, elementum sed interdum at, congue sed arcu. Morbi non mattis augue. Quisque rhoncus augue vitae neque mattis mollis. Proin ac tortor leo. Suspendisse nec lectus et odio fermentum dapibus nec nec nisl.</p>\r\n	<p>\r\n		Duis risus nunc, cursus quis tempus sed, fringilla eget mi. Vestibulum tincidunt mollis ornare. Sed mollis eleifend neque in dignissim. Nullam sed nunc nisi. Ut dui enim, rutrum eu imperdiet quis, volutpat eu enim. Sed congue leo nec libero egestas malesuada. Proin ante erat, tempor vitae laoreet nec, tempor sed lectus. Pellentesque non ante metus, eget facilisis ante. Integer aliquet erat eget erat dapibus imperdiet. Duis ac mi ac sem cursus faucibus id ac justo. Aenean at augue mi, at eleifend odio. Praesent ut fringilla urna.</p>\r\n</div>\r\n', 'Dolor sit amet', 'post', 'dolor-sit-amet', 0, 1, 1, '2012-07-27 12:41:45', '2012-11-17 11:42:48', 1, 'published', 'pl', ''),
(11, 'Strona główna', '<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras et dui a massa blandit tristique ut eu mi. Cras sit amet euismod urna. Praesent nec justo mi. Donec a bibendum dolor. Vivamus eros arcu, feugiat id dapibus id, varius in eros. Suspendisse potenti. Nullam blandit sapien eu ipsum auctor pretium. Cras sit amet neque at tortor lacinia suscipit.</p>\r\n	<p>\r\n		Maecenas convallis pellentesque nunc vel ultrices. Nullam vel quam sem, id vehicula eros. Integer auctor tempus magna ac tempus. In hac habitasse platea dictumst. Nullam molestie urna eget magna mollis varius. Nulla facilisi. Aenean id velit sem, ut bibendum ipsum.</p>\r\n	<p>\r\n		Ut eget hendrerit urna. Quisque vel velit tellus, ac pulvinar tortor. Praesent malesuada, dolor sed sodales dignissim, lorem dui fringilla turpis, quis convallis est neque id ante. Nam metus dui, tristique et ultricies eget, ultrices id nibh. Fusce viverra ultricies dolor non elementum. Suspendisse luctus quam et enim imperdiet dapibus sit amet vitae mi. Nullam at arcu a lectus fermentum iaculis. Pellentesque tincidunt vulputate nulla in rhoncus. Ut et nulla risus. Integer dolor ipsum, eleifend vel porttitor vitae, euismod laoreet augue.</p>\r\n	<p>\r\n		In ac mauris lacus, a pellentesque nunc. Maecenas eu purus turpis. Donec pretium felis a justo rhoncus gravida. Vivamus eget risus lectus, ac tempor dui. Phasellus malesuada eros quis massa dignissim congue. Aliquam dapibus est blandit quam mollis quis mollis ipsum gravida. Aenean sit amet neque eu mauris imperdiet lobortis et vitae nibh. In vel nibh dolor, eu congue sem.</p>\r\n	<p>\r\n		Morbi tristique, lacus tempor vehicula lobortis, eros diam dignissim dui, nec vehicula diam tortor sit amet turpis. Duis scelerisque metus nec risus porttitor interdum dignissim commodo lorem. Phasellus ut nisl eu massa faucibus luctus. Etiam ullamcorper sem tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Donec nunc justo, tristique nec accumsan eu, consequat vitae orci. Cras egestas iaculis gravida. Proin convallis malesuada mi adipiscing faucibus. Integer molestie scelerisque lacus in placerat.</p>\r\n</div>\r\n', 'Krótki tekst', 'page', 'strona-glowna', 0, 2, 1, '2012-07-27 13:20:48', '2012-11-17 11:43:31', 1, 'published', 'pl', ''),
(12, 'Produkty', '<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ut nibh at ligula tincidunt viverra ut at tellus. Nullam et dolor venenatis felis congue elementum quis ac lectus. Morbi felis quam, varius ac placerat interdum, adipiscing sit amet justo. Morbi in libero nibh. Nunc viverra elementum lorem eget tincidunt. Maecenas tincidunt diam quis sem convallis malesuada. Mauris eu turpis a lorem fermentum fermentum. Nullam at erat dignissim est iaculis faucibus. Fusce tempus pretium tellus eget eleifend. Quisque erat lectus, venenatis eu aliquet a, aliquet non ipsum.</p>\r\n	<p>\r\n		Nulla nibh odio, egestas sed eleifend eget, sollicitudin et nulla. Donec semper libero eget odio placerat in vehicula eros sodales. Vestibulum nec urna libero, porttitor eleifend purus. Sed nec enim orci. Nulla venenatis nulla id eros vestibulum congue pretium urna luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare fringilla feugiat.</p>\r\n	<p>\r\n		Integer ligula ante, pulvinar in ultricies sit amet, laoreet ut urna. Praesent et tincidunt purus. Curabitur at massa sem, in ultricies mi. Curabitur leo sapien, fringilla ac ullamcorper gravida, auctor non elit. Vivamus sit amet neque lectus. Sed varius massa nec mauris suscipit congue. Praesent sagittis lorem eu ante cursus elementum. Etiam risus leo, mattis interdum tincidunt at, sollicitudin sed lacus. Nam sed eros vitae erat dictum tincidunt quis in felis. Nam non felis a risus porta placerat. Proin ullamcorper scelerisque nisi, non vestibulum lectus rhoncus vel.</p>\r\n	<p>\r\n		Suspendisse vel metus ut ipsum ullamcorper faucibus sed sit amet massa. Integer imperdiet ullamcorper arcu ut lacinia. Vestibulum magna nibh, dapibus eget fringilla eget, ullamcorper non felis. Ut arcu sem, sagittis et commodo ac, ultricies a sapien. Proin sit amet lorem lacus. Duis sit amet nisl aliquet metus congue sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus in velit est, vitae aliquam turpis. Cras condimentum urna eros, a pretium lacus. Morbi posuere bibendum erat. Vivamus tempor mauris eget neque imperdiet vitae tincidunt sem tempus. Ut venenatis, augue sed euismod consectetur, eros libero semper metus, et hendrerit mi turpis vel est. Vivamus pretium mi eget sapien congue malesuada. Fusce gravida felis sit amet nulla consequat accumsan. Sed sed mi massa, eget hendrerit quam.</p>\r\n	<p>\r\n		Nulla suscipit ornare mauris, sed tincidunt enim consequat eget. Ut quis enim quis erat sagittis bibendum a eget augue. Nunc molestie augue a lacus fermentum euismod. Sed sed turpis mi. Fusce et facilisis dui. Etiam dapibus euismod ligula, quis porta nisi vehicula vel. Nunc erat dui, condimentum non faucibus nec, scelerisque at ligula. Suspendisse turpis nulla, iaculis sit amet pulvinar id, blandit eu lorem.</p>\r\n</div>\r\n', '', 'page', 'produkty', 0, 2, 1, '2012-11-17 11:45:40', '2012-11-17 11:45:40', 1, 'published', 'pl', ''),
(13, 'Referencje', '<div id=\"lipsum\">\r\n	<p>\r\n		Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse ut nibh at ligula tincidunt viverra ut at tellus. Nullam et dolor venenatis felis congue elementum quis ac lectus. Morbi felis quam, varius ac placerat interdum, adipiscing sit amet justo. Morbi in libero nibh. Nunc viverra elementum lorem eget tincidunt. Maecenas tincidunt diam quis sem convallis malesuada. Mauris eu turpis a lorem fermentum fermentum. Nullam at erat dignissim est iaculis faucibus. Fusce tempus pretium tellus eget eleifend. Quisque erat lectus, venenatis eu aliquet a, aliquet non ipsum.</p>\r\n	<p>\r\n		Nulla nibh odio, egestas sed eleifend eget, sollicitudin et nulla. Donec semper libero eget odio placerat in vehicula eros sodales. Vestibulum nec urna libero, porttitor eleifend purus. Sed nec enim orci. Nulla venenatis nulla id eros vestibulum congue pretium urna luctus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur ornare fringilla feugiat.</p>\r\n	<p>\r\n		Integer ligula ante, pulvinar in ultricies sit amet, laoreet ut urna. Praesent et tincidunt purus. Curabitur at massa sem, in ultricies mi. Curabitur leo sapien, fringilla ac ullamcorper gravida, auctor non elit. Vivamus sit amet neque lectus. Sed varius massa nec mauris suscipit congue. Praesent sagittis lorem eu ante cursus elementum. Etiam risus leo, mattis interdum tincidunt at, sollicitudin sed lacus. Nam sed eros vitae erat dictum tincidunt quis in felis. Nam non felis a risus porta placerat. Proin ullamcorper scelerisque nisi, non vestibulum lectus rhoncus vel.</p>\r\n	<p>\r\n		Suspendisse vel metus ut ipsum ullamcorper faucibus sed sit amet massa. Integer imperdiet ullamcorper arcu ut lacinia. Vestibulum magna nibh, dapibus eget fringilla eget, ullamcorper non felis. Ut arcu sem, sagittis et commodo ac, ultricies a sapien. Proin sit amet lorem lacus. Duis sit amet nisl aliquet metus congue sagittis. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vivamus in velit est, vitae aliquam turpis. Cras condimentum urna eros, a pretium lacus. Morbi posuere bibendum erat. Vivamus tempor mauris eget neque imperdiet vitae tincidunt sem tempus. Ut venenatis, augue sed euismod consectetur, eros libero semper metus, et hendrerit mi turpis vel est. Vivamus pretium mi eget sapien congue malesuada. Fusce gravida felis sit amet nulla consequat accumsan. Sed sed mi massa, eget hendrerit quam.</p>\r\n	<p>\r\n		Nulla suscipit ornare mauris, sed tincidunt enim consequat eget. Ut quis enim quis erat sagittis bibendum a eget augue. Nunc molestie augue a lacus fermentum euismod. Sed sed turpis mi. Fusce et facilisis dui. Etiam dapibus euismod ligula, quis porta nisi vehicula vel. Nunc erat dui, condimentum non faucibus nec, scelerisque at ligula. Suspendisse turpis nulla, iaculis sit amet pulvinar id, blandit eu lorem.</p>\r\n</div>\r\n', 'Referencje', 'page', 'referencje', 0, 3, 1, '2012-11-17 11:46:32', '2012-11-17 11:46:32', 1, 'published', 'pl', '');

CREATE TABLE `cms_relations` (
  `id` bigint(20) NOT NULL,
  `post_id` bigint(20) NOT NULL COMMENT 'id postu',
  `category` bigint(20) NOT NULL COMMENT 'id kategorii'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='przypisanie wpisów do kategorii itd.';

INSERT INTO `cms_relations` (`id`, `post_id`, `category`) VALUES
(5, 8, 1),
(13, 10, 1),
(14, 10, 5),
(18, 0, 1);

CREATE TABLE `cms_users` (
  `ID` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(60) NOT NULL DEFAULT '' COMMENT 'nazwa użytkownika',
  `pass` varchar(64) NOT NULL DEFAULT '' COMMENT 'hasło w md5',
  `permissions` enum('admin','user') NOT NULL DEFAULT 'user' COMMENT 'uprawnienia',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT 'e-mail',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT 'adres strony www',
  `avatar` varchar(50) NOT NULL DEFAULT '' COMMENT 'adres avatara',
  `registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'data rejestracji',
  `activation_key` varchar(60) NOT NULL DEFAULT '' COMMENT 'kod aktywacji',
  `display_name` varchar(250) NOT NULL DEFAULT '' COMMENT 'wyświetlana nazwa (np. imię, nick)',
  `active` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'czy aktywny?'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

INSERT INTO `cms_users` (`ID`, `username`, `pass`, `permissions`, `email`, `url`, `avatar`, `registered`, `activation_key`, `display_name`, `active`) VALUES
(1, 'admin', '7cd1726ba9c7fa87c0aa7eeec072aad9', 'admin', 'lukaszjarosinski@gmail.com', 'http://www.lukaszjarosinski.pl', '', '2011-12-19 11:28:03', '', 'Administrator', 1);

ALTER TABLE `cms_attribution`
  ADD UNIQUE KEY `post1` (`post1`,`post2`);

	ALTER TABLE `cms_boxes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lang` (`lang`,`slug`);

ALTER TABLE `cms_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`,`active`);

ALTER TABLE `cms_gallery_categories`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cms_gallery_pictures`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cms_links`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`),
  ADD KEY `lang` (`lang`);

ALTER TABLE `cms_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `active` (`active`);

ALTER TABLE `cms_menus_content`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cms_metaoptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`key`);

ALTER TABLE `cms_options`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `cms_posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `parent` (`parent`),
  ADD KEY `author` (`author`),
  ADD KEY `post_on` (`post_on`),
  ADD KEY `lang` (`lang`);

ALTER TABLE `cms_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`);

ALTER TABLE `cms_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_login_key` (`username`),
  ADD KEY `user_permissions` (`permissions`);

ALTER TABLE `cms_boxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `cms_comments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `cms_gallery_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

ALTER TABLE `cms_gallery_pictures`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `cms_links`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `cms_menus`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

ALTER TABLE `cms_menus_content`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

ALTER TABLE `cms_metaoptions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

ALTER TABLE `cms_options`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

ALTER TABLE `cms_posts`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

ALTER TABLE `cms_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

ALTER TABLE `cms_users`
  MODIFY `ID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;
