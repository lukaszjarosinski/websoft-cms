<?
/*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*/
//konfiguracja domeny
$config['domain'] = "";
//konfiguracja katalogów serwisu
$config['catalog'] = "/demo/cms";
$config['base_dir'] = $_SERVER['DOCUMENT_ROOT'].$config['catalog']."/";
$config['admin_dir'] = $config['base_dir']."admin/";
$config['classes_dir'] = $config['base_dir']."classes/";
$config['gallery_dir'] = $config['base_dir']."images/gallery/";
$config['banner_dir'] = $config['base_dir']."images/banner/";
$config['functions_dir'] = $config['base_dir']."functions/";
$config['languages_dir'] = $config['base_dir']."languages/";
$config['smartylib_dir'] = $config['base_dir']."libs/";
$config['js_dir'] = $config['base_dir']."js/";
$config['includes_dir'] = $config['base_dir']."includes/";
$config['modules_dir'] = $config['base_dir']."modules/";
$config['templates_dir'] = $config['base_dir']."templates/";
$config['userfiles_dir'] = $config['base_dir']."images/userfiles/";

$config['admin_url'] = str_replace($config['base_dir'],$config['domain'],$config['admin_dir']);
$config['classes_url'] = str_replace($config['base_dir'],$config['domain'],$config['classes_dir']);
$config['gallery_url'] = str_replace($config['base_dir'],$config['domain'],$config['gallery_dir']);
$config['banner_url'] = str_replace($config['base_dir'],$config['domain'],$config['banner_dir']);
$config['functions_url'] = str_replace($config['base_dir'],$config['domain'],$config['functions_dir']);
$config['languages_url'] = str_replace($config['base_dir'],$config['domain'],$config['languages_dir']);
$config['smartylib_url'] = str_replace($config['base_dir'],$config['domain'],$config['smartylib_dir']);
$config['js_url'] = str_replace($config['base_dir'],$config['domain'],$config['js_dir']);
$config['includes_url'] = str_replace($config['base_dir'],$config['domain'],$config['includes_dir']);
$config['modules_url'] = str_replace($config['base_dir'],$config['domain'],$config['modules_dir']);
$config['templates_url'] = str_replace($config['base_dir'],$config['domain'],$config['templates_dir']);
$config['userfiles_url'] = str_replace($config['base_dir'],$config['domain'],$config['userfiles_dir']);
//konfiguracja bazy danych
$config['db_host'] = "";
$config['db_name'] = "";
$config['db_user'] = "";
$config['db_password'] = "";
//konfiguracja prefixu tabel w bazie danych
$config['db_prefix'] = "cms_";
//dane do szyfrowania hase³ itd.
$config['md5_phase'] = "awefqa239i012e";
$config['min_prefix'] = "mini_";
//konfiguracja serwera smtp do wysy³ki maili
$config['smtp_server'] = "";
$config['smtp_username'] = "";
$config['smtp_password'] = "";
$config['smtp_port'] = 465;
//aktualny szablon graficzny w panelu admina
$config['backend_theme'] = 'default';
//aktualny szablon graficzny w serwisie
$config['frontend_theme'] = 'default';
//liczba elementów wyœwietlanych w panelu admina
$config['admin_elements_per_page'] = "10";
//liczba elementówn wyœwietlanych we frontendzie
$config['frontend_elements_per_page'] = "10";
//tryb dzia³ania serwisu: 0 tryb normalny, 1 tryb produkcyjny. Istotne dla wydajnoœci serwisu
$config['mode'] = 0;
//domyœlny jêzyk serwisu
$config['default_lang'] = "pl";
//zainstalowane jêzyki
$config['installed_languages'] = array(array('lang'=>'pl','name'=>'Polski'));
//szerokoœæ i wysokoœæ miniaturki zdjêcia w galerii
$config['gallery_thumb_width'] = "295";
$config['gallery_thumb_height'] = "295";
//jakoœæ miniaturki zdjêcia w galerii
$config['gallery_thumb_quality'] = "80";
//czy przycinaæ miniaturki do równego rozmiaru
$config['gallery_crop'] = false;
//kod Google Analitycs lub innych statystyk
$config['statistics_code'] = "";
?>