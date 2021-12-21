<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
session_start();
header("Content-Type: text/html; charset=UTF-8");
//podstawowe dane dla aplikacji, deklaracja zmiennych itp - pliki główne serwisu
if ($where == 'backend') require('../config.php');
elseif ($where == 'frontend') require('config.php');
else die();
//przekierowanie na domenę z www jeżeli nie jest na serwerze lokalnym
$whitelist = array('localhost', '127.0.0.1');
if(!in_array($_SERVER['HTTP_HOST'], $whitelist))
{
	if (substr($_SERVER['HTTP_HOST'],0,3) != 'www') 
	{
		header('HTTP/1.1 301 Moved Permanently');
		header('Location: http://www.'.$_SERVER['HTTP_HOST']
		.$_SERVER['REQUEST_URI']);
	}
}
require($config['classes_dir'].'class.auth.php');
require($config['smartylib_dir'].'bootstrap.php');
require($config['classes_dir'].'class.db.php');
require($config['functions_dir'].'functions.php');
require($config['functions_dir'].'shortcodes.php');
require($config['classes_dir'].'class.url.php');
require($config['classes_dir'].'class.options.php');
require($config['languages_dir'].'languages_codes.php');
global $config;
//deklaracja klasy bazy danych
$db = new Base;
global $db;
$db->connect($config['db_user'],$config['db_password'],$config['db_host'],$config['db_name']);
define('DEFAULT_CHARSET', 'utf-8');
//tworzenie slugu wpisu
if	($where == 'backend' AND isset($_REQUEST['data']) AND $_REQUEST['data'] != '' AND isset($_REQUEST['slugCreate']) AND $_REQUEST['slugCreate'] == 'true')
{
	echo $data = stripText(filterData($_REQUEST['data'],array('addslashes')));
	exit();
}
//deklaracja klasy parsowania adresów
$url = new URL();
$url_array = $url->sURL();
//przechwycenie języka
if ($where == 'backend')
{
	if (isset($_REQUEST['lang-code'])) $_SESSION['lang-code'] = filterData($_REQUEST['lang-code']);
	elseif (isset($_SESSION['lang-code']) AND $_SESSION['lang-code'] <> '') $_SESSION['lang-code'] = $_SESSION['lang-code'];
	else $_SESSION['lang-code'] = $config['default_lang'];
	require($config['languages_dir'].$_SESSION['lang-code'].'/lang.'.$_SESSION['lang-code'].'.php');
}
elseif ($where == 'frontend')
{
	$url_array_no = count(explode("/",$config['catalog']))-1;
	if(isset($url_array[$url_array_no]) AND in_array($url_array[$url_array_no],$languages_array)) $_SESSION['lang-code'] = $url_array[$url_array_no];
	else 
	{
		if ($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
		{
			header('Location: '.$config['domain'].$config['default_lang']);
			exit;
		}
	}
	require($config['languages_dir'].$_SESSION['lang-code'].'/lang.'.$_SESSION['lang-code'].'.php');
}
//inicjalizacja Smarty
global $config;
$smarty = new Smarty();
if ($where == 'frontend')
{
	$smarty->template_dir = $config['base_dir'].'templates/'.$config['frontend_theme'].'/';
	$smarty->compile_dir  = $config['base_dir'].'templates_c/';
	$smarty->config_dir   = $config['base_dir'].'configs/';
	$smarty->cache_dir    = $config['base_dir'].'cache/';
}
elseif ($where == 'backend')
{
	$smarty->template_dir = $config['admin_dir'].'templates/'.$config['backend_theme'].'/';
	$smarty->compile_dir  = $config['admin_dir'].'templates_c/';
	$smarty->config_dir   = $config['admin_dir'].'configs/';
	$smarty->cache_dir    = $config['admin_dir'].'cache/';
}
else critical_error($msg);
if ($config['mode'] == 0)
{
	$smarty->force_compile = false;
	$smarty->caching = false;
}
else
{
	$smarty->force_compile = true;
	$smarty->caching = false;
	$smarty->debugging = true; //włączenie debugowania w smarty
}
//deklaracja klasy autoryzacji
$auth = new Auth($db);
$auth->db_table_set($config['db_prefix']."users");
$auth->md5_phase($config['md5_phase']);
if (isset($_REQUEST['subaction']) AND $_REQUEST['subaction'] == 'logout') $auth->logout();
//logowanie po wysłaniu formularza
if (isset($_REQUEST['username']) AND $_REQUEST['username'] <> '' AND isset($_REQUEST['password']) AND $_REQUEST['password'] <> '' AND !isset($zalogowano)) 
{
	if ($where == 'backend') $permissions = 'admin';
	elseif ($where == 'frontend') $permissions = 'user';
	else critical_error($msg);
	$zalogowano = $auth->login($_REQUEST['username'],$_REQUEST['password'],$permissions);
}
if ($where == 'backend') $theme = $config['backend_theme'];
elseif ($where == 'frontend') $theme = $config['frontend_theme'];
else critical_error($msg);
$smarty->assign(array(
'langcode'=>$_SESSION['lang-code'],
'lang'=>$lang,
'theme'=>$theme,
'catalog'=>$config['catalog'],
'domain'=>$config['domain'],
'installed_languages'=>$config['installed_languages'],
'gallery_dir'=>$config['gallery_dir'],
'default_lang'=>$config['default_lang'],
));
//pobieranie opcji konfiguracyjnych serwisu
$options = new Options($db,$auth);
$config['meta_title'] = $options->getValue('meta_title');
$config['meta_description'] = $options->getValue('meta_description');
$config['meta_keywords'] = $options->getValue('meta_keywords');
$config['robots'] = $options->getValue('robots');
//pliki specyficzne dla poszczególnych rodzajów systemu
require($config['classes_dir'].'class.posts.php');
$posts = new Posts($db,$auth);
require($config['classes_dir'].'class.links.php');
$link = new Link($db,$auth);
require($config['classes_dir'].'class.boxes.php');
$boxes = new Boxes($db,$auth);
function displayBox($attr)
{
	global $boxes;
	return $boxes->displayBox($attr['id']);
}
add_shortcode('box','displayBox');
//ładowanie statystyk oglądalności
if ($config['statistics_code'] != '') $smarty->append('HOOK_BOTTOM',$config['statistics_code']);
if (get_magic_quotes_gpc()) {
	function strip_array($var) {
		return is_array($var)? array_map("strip_array", $var):stripslashes($var);
	}
	$_POST = strip_array($_POST);
	$_SESSION = strip_array($_SESSION);
	$_GET = strip_array($_GET);
}
//ładowanie dodatkowych klas, modułów
include($config['modules_dir'].'/index.php');
?>