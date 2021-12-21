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
	if (isset($_REQUEST['iframe']) AND $_REQUEST['iframe'] == 'true' OR (isset($_REQUEST['action']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'))
	{
		switch($_REQUEST['action'])
		{
			case "categories_add":
				require_once($config['classes_dir']."class.formvalidator.php");
				$validator = new FormValidator();
				$validator->addValidation("title","req",$lang['field_is_required']);
				$validator->addValidation("title","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("active","req",$lang['field_is_required']);
				$validator->addValidation("slug","req",$lang['field_is_required']);
				$validator->addValidation("slug","minlen=3",$lang['minimum_lenght']);
				if ($validator->ValidateForm()) 
				{
					$return = $gallery->addEditCategory($_REQUEST);
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
			case "delete_category":
				$return = $gallery->deleteCategory($_REQUEST['id']);
				if ($return) $message = array($lang['deleted'],'success');
				else $message = array($lang['not_deleted'],'error');
			break;
			case "picture_add":
				require_once($config['classes_dir']."class.formvalidator.php");
				$validator = new FormValidator();
				$validator->addValidation("active","req",$lang['field_is_required']);
				if ($validator->ValidateForm()) 
				{
					$return = $gallery->addEditPicture($_REQUEST);
					if ($return) $message = array($lang['saved'],'success');
					else $message = array($lang['not_saved'],'error');
				}
				else 
				{
					$message .= "<p>".$lang['following_errors']."</p><ul>";
					$error_hash = $validator->GetErrors();
					foreach($error_hash as $inpname => $inp_err) $message .= "<li>".$inpname.": ".$inp_err."</li>\n";
					$message .= array($message."</ul>",'error');
				}
			break;
			case "delete":
				$return = $gallery->deletePicture($_REQUEST['id']);
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
		'gallery'=>$gallery,
		'auth_class'=>$auth,
		'auth'=>$auth->showUserId(),
		'min_prefix'=>$config['min_prefix'],
		)
	);
	$smarty->display('gallery'.((isset($_REQUEST['action']) AND $_REQUEST['action'] != '')?'_'.$_REQUEST['action']:'').'.tpl');
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