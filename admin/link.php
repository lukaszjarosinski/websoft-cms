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
				require_once($config['classes_dir']."class.formvalidator.php");
				$validator = new FormValidator();
				$validator->addValidation("title","req",$lang['field_is_required']);
				$validator->addValidation("title","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("anchor","req",$lang['field_is_required']);
				$validator->addValidation("anchor","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("url","req",$lang['field_is_required']);
				$validator->addValidation("url","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("active","req",$lang['field_is_required']);
				if ($validator->ValidateForm()) 
				{
					$return = $link->addEditLink($_REQUEST);
					if ($return) $message = array($lang['saved'],'success');
					else $message = array($lang['not_saved'],'error');
				}
				else 
				{
					$message1 = "<p>".$lang['following_errors']."</p><ul>";
					$error_hash = $validator->GetErrors();
					foreach($error_hash as $inpname => $inp_err) $message1 .= "<li>".$inpname.": ".$inp_err."</li>\n";
					$message = array($message1."</ul>",'error');
				}
			break;
			case "delete":
				$return = $link->deleteLink($_REQUEST['id']);
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
		'username'=>$auth->showName(),
		'zalogowano'=>$zalogowano,
		'links'=>$link,
		'auth_class'=>$auth,
		'auth'=>$auth->showUserId(),
		)
	);
	$smarty->display('link'.((isset($_REQUEST['action']) AND $_REQUEST['action'] != '')?'_'.$_REQUEST['action']:'').'.tpl');
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