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
			case "add":
				require_once($config['classes_dir']."class.formvalidator.php");
				$validator = new FormValidator();
				$validator->addValidation("title","req",$lang['field_is_required']);
				$validator->addValidation("title","minlen=3",$lang['minimum_lenght']);
				$validator->addValidation("slug","req",$lang['field_is_required']);
				//$validator->addValidation("array","req",$lang['field_is_required']);
				$validator->addValidation("active","req",$lang['field_is_required']);
				if ($validator->ValidateForm()) 
				{
					$return = $posts->addEditMenu($_REQUEST);
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
				$return = $posts->deleteMenu($_REQUEST['id']);
				if ($return) $message = array($lang['deleted'],'success');
				else $message = array($lang['not_deleted'],'error');
			break;
			case "slugExists":
				if (isset($_REQUEST['id'])) $id = $_REQUEST['id'];
				else $id = '';
				echo $message = $posts->menuSlugExists($_REQUEST['slug'],$id);
				exit;
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
		'posts'=>$posts,
		'auth_class'=>$auth,
		'auth'=>$auth->showUserId(),
		)
	);
	$smarty->display('menus'.((isset($_REQUEST['action']) AND $_REQUEST['action'] != '')?'_'.$_REQUEST['action']:'').'.tpl');
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