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
	if (isset($_REQUEST['action']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
		switch($_REQUEST['action'])
		{
			case "add":
				$return = $auth->addUser($_REQUEST);
				if ($return) $message = array($lang['saved'],'success');
				else {
				$message = array("<p>".$lang['not_saved']."</p>"."<ul>".$auth->errorDisplay()."</ul>",'error');
				}
			break;
			case "delete":
				$return = $auth->deleteUser($_REQUEST['id']);
				if ($return) $message = array($lang['deleted'],'success');
				else $message = array($lang['not_deleted'],'error');
			break;
		}
		if (isset($message) AND $message != '') $smarty->assign('komunikat',$message);
		$output = $smarty->fetch('komunikat.tpl');
		echo $output;
		exit;
	}
	
	$smarty->assign(
		array(
		'auth_class'=>$auth,
		'username'=>$auth->showName(),
		'zalogowano'=>$zalogowano,
		'auth'=>$auth->showUserId(),
		)
	);
	$smarty->display('user'.((isset($_REQUEST['action']) AND $_REQUEST['action'] != '')?'_'.$_REQUEST['action']:'').'.tpl');
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