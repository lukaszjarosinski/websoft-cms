<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
$where = "backend"; //określenie backend lub frontend serwisu
include_once('../includes/init.php');
//jeżeli użytkownik jest zalogowany - wyświetlenie odpowiedniej strony
$zalogowano = $auth->check_session('admin');
if ($zalogowano)
{
	$smarty->assign(
		array(
		'username'=>$auth->showName(),
		'zalogowano'=>$zalogowano,
		'auth_class'=>$auth,
		'auth'=>$auth->showUserId(),
		)
	);
	$wynik = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
	$wynik .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:schemaLocation=\"http://www.google.com/schemas/sitemap/0.84 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">\n";
	$rows = $db->query("SELECT id,title,type,modified,slug FROM ".$config['db_prefix']."posts");
	foreach($rows AS $row)
	{
		$wynik .= "
		<url>
		<loc>".$config['domain'].$config['default_lang']."/".$row['slug']."</loc>
		<lastmod>".substr($row['modified'],0,10)."</lastmod>
		<changefreq>weekly</changefreq>
		<priority>";
		if ($row['type'] == 'page') $wynik .= "0.90";
		elseif($row['type'] == 'category') $wynik .= "0.80";
		else $wynik .= "0.70";
		$wynik .= "</priority>
		</url>\n
		";
	}
	$wynik .= "</urlset>";
	$plik = fopen($config['base_dir'].'sitemap.xml','w+');
	$zapisano = fwrite($plik,$wynik);
	fclose($plik);
	if ($zapisano) $komunikat = $lang['sitemap_created'];
	else $komunikat = $lang['sitemap_not_created'];
	$smarty->assign(
		array(
		'komunikat'=>'<div class="notification success png_bg"><a href="javascript:void(0)" class="close"><img src="'.$config['domain'].'admin/templates/default/images/icons/cross_grey_small.png" title="{$lang.close_notification}" alt="'.$lang['close_notification'].'" /></a><div>'.$komunikat.'</div></div>'
		)
	);
	$smarty->display('index.tpl');
}
//jeżeli użytkownik jest niezalogowany, wyświetlenie formularza logowania
else
{
	//wyświetlenie komunikatu o tym, że został wylogowany
	if (isset($_REQUEST['subaction']) AND $_REQUEST['subaction'] == 'logout') $smarty->assign('komunikat',array($lang['logged_out'],'success'));
	//wyświetlenie komunikatu o tym, że nieprawidłowy login i hasło
	if (isset($_REQUEST['username']) AND $_REQUEST['username'] <> '' AND isset($_REQUEST['password']) AND $_REQUEST['password'] <> '' AND !$zalogowano) $smarty->assign('komunikat',array($lang['invalid_username_password'],'error'));
		$smarty->assign(
		array(
		'action'=>$_SERVER['PHP_SELF'],
		)
	);
	$smarty->display('logowanie.tpl');
}
//rozłączenie z bazą danych
$db->disconnect();
?>