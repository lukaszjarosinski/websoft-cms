<?
/*
Copyright 2012 by ?ukasz Jarosi?ski
www.lukaszjarosinski.com
tel. 508 052 990
*/
$where = "backend"; //okre?lenie backend lub frontend serwisu
include_once('../includes/init.php');
//je?eli u?ytkownik jest zalogowany - wy?wietlenie odpowiedniej strony
$zalogowano = $auth->check_session('admin');
if ($zalogowano)
{
	if (isset($_REQUEST['action']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') 
	{
		switch($_REQUEST['action'])
		{
			case "update":
				require_once($config['classes_dir']."class.formvalidator.php");
				$validator = new FormValidator();
				$validator->addValidation("meta_title","req",$lang['field_is_required']);
				$validator->addValidation("meta_title","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("meta_description","req",$lang['field_is_required']);
				$validator->addValidation("meta_description","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("meta_keywords","req",$lang['field_is_required']);
				$validator->addValidation("meta_keywords","minlen=3",$lang['minimum_lenght']);
				if ($validator->ValidateForm()) 
				{
					$return = $options->updateOption($_REQUEST);
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
		'options'=>$options,
		'auth_class'=>$auth,
		'auth'=>$auth->showUserId(),
		)
	);
	$smarty->display('options.tpl');
}
//je?eli u?ytkownik jest niezalogowany, wy?wietlenie formularza logowania
else
{
	//wy?wietlenie komunikatu o tym, ?e zosta? wylogowany
	if (isset($_REQUEST['subaction']) AND $_REQUEST['subaction'] == 'logout') $smarty->assign('komunikat',array($lang['logged_out'],'success'));
	//wy?wietlenie komunikatu o tym, ?e nieprawid?owy login i has?o
	if (isset($_REQUEST['username']) AND $_REQUEST['username'] <> '' AND isset($_REQUEST['password']) AND $_REQUEST['password'] <> '' AND !$zalogowano) $smarty->assign('komunikat',array($lang['invalid_username_password'],'error'));
		$smarty->assign(
		array(
		'action'=>$_SERVER['PHP_SELF'],
		)
	);
	$smarty->display('logowanie.tpl');
}
//roz??czenie z baz? danych
$db->disconnect();
?>