<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa autoryzacji użytkowników
//Została wykonana również klasa rozszerzająca zawierająca obsługę różych poziomów uprawnień użytkowników - tabel w bazie musi zawierać też pole permissions zawierające liczbowaą listę uprawień rozdzieloną przecinkami
//class AuthPermissions extends Auth {
//	var $permTab;
//	public function login ($username,$password)
//	{
//			global $db;
//			$username = mysql_real_escape_string($username);
//			$password = mysql_real_escape_string($password);
//			$pass = md5($password.$this->salt);
//			$rows = $db->query("SELECT id,username,permissions FROM ".$this->db_table." WHERE `username` = '$username' //AND `pass` = '$pass'");
//			$ile = count($rows);
//			if($ile == 1)
//			{
//				$this->user_id = $rows[0]['id'];
//				$this->username = $rows[0]['username'];
//				$this->ok = true;
//				$this->permTab = $rows[0]['permissions'];
//				$_SESSION['auth_username'] = $username;
//				$_SESSION['auth_password'] = md5($password . $this->salt);
//				$_SESSION['auth_permissions'] = $this->permTab;
//				return true;
//			}
//			else return false;
//	}
//	public function checkPermission($permissionId)
//	{
//		if (empty($permissionId)) return true;
//		elseif (!empty($permissionId) AND !empty($_SESSION['auth_permissions']) AND !empty($_SESSION['auth_username']))
//		{
//			$permissiontab = explode(",",$_SESSION['auth_permissions']);
//			if (in_array($permissionId,$permissiontab)) return true;
//			else return false;
//		}
//		else return false;
//	}
//}
//Funkcja db_table_set($dbtable) - ustalamy, w której tabeli w bazie są przechowowane informacje o użytkownikach. Tabela musizawierać pola username i pass
//Funkcja md5_phase($md5_phase) służy do ustalenia frazy, za pomocą której szyfrowane jest hasło użytkownika w bazie danych
//Logowanie użytkownika login($username,$password), zwraca true lub false
//Na każdej podstronie, która wymaga autoryzacji sesję, czy użytkownik jest zalogowany i istnieje w bazie danych check_session(), zwraca true lub false
//Zmiana hasła użytkownika changePasswd($pass1,$pass2) przesyłane w formularza get lub post, zwraca true lub false
//Wyświetlenie nazwy zalogowanego użytkownika showUsername() - zwraca nazwę użytkownika

class Auth
{
	var $user_id;
	var $username;
	var $password;
	var $ok;
	var $salt;
	var $db_table;
	var $db;
	var $error;
		
	function __construct(Base $db)
	{
		global $config;
		$this->db = $db;
		$this->user_id = 0;
		$this->username = "Guest";
		$this->ok = false;
		return $this->ok;
	}
	
	function check_session($privileges = 'user')
	{
		if(!empty($_SESSION['auth_username']) && !empty($_SESSION['auth_password']))
		{
		$return = $this->check($_SESSION['auth_username'], $_SESSION['auth_password'],$privileges);
		if ($return == true) return true;
		}
		else return false;
		
	}
	
	function login($username, $password, $permissions = 'user')
	{
		$username = addslashes($username);
		$password = addslashes($password);
		$pass = md5($password.$this->salt);
		$rows = $this->db->query("SELECT id,username,permissions FROM ".$this->db_table." WHERE `username` = '$username' AND `pass` = '$pass' AND `active` = '1' AND permissions = '$permissions'");
		$ile = count(array($rows));
		if($ile == 1)
		{
			$this->user_id = $rows[0]['id'];
			$this->username = $rows[0]['username'];
			$this->ok = true;
			$this->permTab = $rows[0]['permissions'];
			$_SESSION['auth_username'] = $username;
			$_SESSION['auth_password'] = md5($password . $this->salt);
			$_SESSION['auth_permissions'] = $this->permTab;
			return true;
		}
		else return false;
	}
	
	public function checkPermission($permissionId)
	{
		if (empty($permissionId)) return true;
		elseif (!empty($permissionId) AND !empty($_SESSION['auth_permissions']) AND !empty($_SESSION['auth_username']))
		{
			if ($permissionId === $permissiontab) return true;
			else return false;
		}
		else return false;
	}
	
	function db_table_set($dbtable)
	{
		$this->db_table = $dbtable;
	}
	
	function md5_phase($md5)
	{
		$this->salt = $md5;
	}
	
	function check($username, $password, $permissions)
	{
		$username = addslashes($username);
		$password = addslashes($password);
		$rows = $this->db->query("SELECT id,pass FROM ".$this->db_table." WHERE username = '$username' AND permissions = '$permissions'");
		$ile = count(array($rows));
		if($ile == 1)
		{
			$db_password = $rows[0]['pass'];
			if($db_password == $password)
			{
				$this->user_id = $rows[0]['id'];
				$this->username = $username;
				$this->ok = true;
				return true;
			}
		}
		else return false;
	}
	
	function logout()
	{
		$this->user_id = 0;
		$this->username = "Guest";
		$this->ok = false;
		$_SESSION['auth_username'] = "";
		$_SESSION['auth_password'] = "";
		$_SESSION['auth_permissions'] = "";
		return true;
	}
	
	function showUsername()
	{
		return $_SESSION['auth_username'];
	}
	
	function showName()
	{
		$username = $_SESSION['auth_username'];
		$rows = $this->db->query("SELECT display_name FROM ".$this->db_table." WHERE username = '$username' LIMIT 1");
		return $rows[0]['display_name'];
	}
	
	function changePasswd($pass1,$pass2)
	{
	$pass1 = addslashes($pass1);
	$pass2 = addslashes($pass2);
	if ($pass1 === $pass2)
	{
	$user = $_SESSION['auth_username'];
	$pass = $_SESSION['auth_password'];
	$new_pass = md5($pass1.$this->salt);
	$rows = $this->db->query("UPDATE ".$this->db_table." SET pass = '$new_pass' WHERE username = '$user'");
	if ($rows == 1) 
	{
	$res = "ok";
	$_SESSION['auth_password'] = $new_pass;
	}
	else $res = "db_error";
	}
	else $res = "not_valid_pass";
	return $res;
	}
	
	function showUserId()
	{
		return $this->user_id;
	}
	
	function usersList()
	{
		$rows = $this->db->query("SELECT id,username,email,display_name,url,avatar,permissions,registered,active FROM ".$this->db_table."".(($permissions != '')?" WHERE permission = '".$permissions."'":"")." ORDER BY username ASC,registered DESC");
		return $rows;
	}
	
	function permissionNicename($permission)
	{
		global $lang;
		switch($permission)
		{
			case "admin": $return = $lang['permission_admin']; break;
			case "user": $return = $lang['permission_user']; break;
		}
		return $return;
	}
	
	function deleteUser($id)
	{
		$id = addslashes($id);
		$rows = $this->db->query("DELETE FROM ".$this->db_table." WHERE id = '$id' LIMIT 1");
		if ($rows > 0) return true;
		else return false;
	}
	
	function addUser($data)
	{
		global $config;
		$username = addslashes($data['username']);
		if (!$data['id'])
		{
			$rows = $this->db->query("SELECT COUNT(id) AS count FROM ".$this->db_table." WHERE username = '$username'");
			if (isset($rows) AND $rows[0]['count'] > 0) $this->error[] = 'exists';
		}
		$pass1 = addslashes($data['pass1']);
		$pass2 = addslashes($data['pass2']);
		if ($pass1 === $pass2) $pass = md5($pass1.$this->salt);
		else $this->error[] = 'pass';
		$display_name = addslashes($data['display_name']);
		$email = addslashes($data['email']);
		$permissions = addslashes($data['permissions']);
		if (isset($data['avatar'])) $avatar = addslashes($data['avatar']);
		else $avatar = "";
		if (!$this->validateEmail($email) AND $email != '') $this->error[] = 'email';
		$url = addslashes($data['url']);
		if (!$this->validateUrl($url) AND $url != '') $this->error[] = 'url';
		if ($_SESSION['auth_permissions'] != 'admin') $active = 0;
		else $active = 1;
		$activation_key = md5(uniqid(mt_rand(),true));
		if (!isset($this->error) OR (isset($this->error) AND !is_array($this->error)))
		{
			if ($data['id'] == '') 
			{
				$rows = $this->db->query("INSERT INTO ".$this->db_table." (`username`,`pass`,`permissions`,`email`,`url`,`avatar`,`registered`,`activation_key`,`display_name`,`active`) VALUES('$username','$pass','$permissions','$email','$url','$avatar',NOW(),'$activation_key','$display_name','$active')");
			}
			else {
				$id = addslashes(strip_tags(($data['id'])));
				if ($pass1 === $pass2 AND ($_SESSION['auth_permissions'] == 'admin' OR $this->showUsername() == $username) AND $pass1 != '') $to_query = ",`pass` = '$pass'";
				$rows = $this->db->query("UPDATE ".$this->db_table." SET username = '$username',display_name = '$display_name', email = '$email',url = '$url',activation_key = '$activation_key',active = '$active'".((isset($to_query) AND $to_query != '')?$to_query:"").", avatar = '$avatar', permissions = '$permissions', url = '$url' WHERE id = '$id'");
			}
			if ($rows > 0) return true;
			else return false;
		}
		else return false;
	}
	
	function validateEmail($data)
	{
		if (!preg_match("/^[a-zA-Z0-9_\.\-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $data)) return false;
		else return true;
	}
	
	function validateUrl($data)
	{
		if (!preg_match("#^http(s)?://[a-z0-9-_.]+\.[a-z]{2,4}#i", $data)) return false;
		else return true;	
	}
	
	function showError()
	{
		return $this->error;
		$this->error = '';
	}
	
	function showUser($id)
	{
		if(is_array($id)) $id = $id['id'];
		else $id = $id;
		$id = addslashes($id);
		$rows = $this->db->query("SELECT * FROM ".$this->db_table." WHERE id = '$id' LIMIT 1");
		return $rows[0];
	}
	
	function errorDisplay($isHtml = true)
	{
		global $lang;
		$return = '';
		foreach ($this->error AS $err) $return .= (($isHtml)?"<li>":"").$lang[$err].(($isHtml)?"</li>":"");
		return $return;
	}
	
	function activateUser($code)
	{
		global $config,$db,$auth;
		$rows = $this->db->query("UPDATE ".$auth->db_table." SET `active` = '1' WHERE `activation_key` = '$code' LIMIT 1");
		if ($rows > 0) return true;
		else return false;
	}

}
?>