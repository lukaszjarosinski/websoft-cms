<?
/*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*/
$where = "backend"; //okre¶lenie backend lub frontend serwisu
include_once('../includes/init.php');
//je¿eli u¿ytkownik jest zalogowany - wy¶wietlenie odpowiedniej strony
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
	$smarty->display('index.tpl');
}
//je¿eli u¿ytkownik jest niezalogowany, wy¶wietlenie formularza logowania
else
{
	//wy¶wietlenie komunikatu o tym, ¿e zosta³ wylogowany
	if (isset($_REQUEST['subaction']) AND $_REQUEST['subaction'] == 'logout') $smarty->assign('komunikat',array($lang['logged_out'],'success'));
	//wy¶wietlenie komunikatu o tym, ¿e nieprawid³owy login i has³o
	if (isset($_REQUEST['username']) AND $_REQUEST['username'] <> '' AND isset($_REQUEST['password']) AND $_REQUEST['password'] <> '' AND !$zalogowano) $smarty->assign('komunikat',array($lang['invalid_username_password'],'error'));
		$smarty->assign(
		array(
		'action'=>$_SERVER['PHP_SELF'],
		)
	);
	$smarty->display('logowanie.tpl');
}
//roz³±czenie z baz± danych
$db->disconnect();
?>