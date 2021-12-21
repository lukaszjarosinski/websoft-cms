<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa obsługi boksów z zawartością; mogą posłużyć do wstawienia dowolnej zawartości w dowolne miejsce 
class Boxes
{
	function __construct(Base $db,Auth $auth)
	{
		$this->db = $db;
		$this->auth = $auth;
	}
//wyświetlenie listy linków w panelu admina
	function boxesList()
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."boxes ORDER BY id ASC,modified ASC");
		return $rows;
	}
//dodanie/educja linku w panelu admina
	function addEditBox($data)
	{
		global $config;
		foreach($data AS $key=>$value)
		{
			if ($key == 'text') $data[$key] = $this->filterData($value,array('addslashes'));
			else $data[$key] = $this->filterData($value);		
		}
		$return = false;
		$author = $this->auth->showUserId();
		if ($data['id'] != '')
		{
			$query = $this->db->query("UPDATE ".$config['db_prefix']."boxes SET `title` = '".$data['title']."',`author` = '".$author."',`modified` = NOW(),`active` = '".$data['active']."',`text` = '".$data['text']."',`lang` = '".$data['lang']."',`slug` = '".$data['slug']."' WHERE id = '".$data['id']."'");
			if ($query > 0) return true;
			else return false;
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."boxes (`title`,`author`,`modified`,`active`,`text`,`lang`,`slug`) VALUES('".$data['title']."','".$author."',NOW(),'".$data['active']."','".$data['text']."','".$data['lang']."','".$data['slug']."')");
			if ($query > 0) return true;
			else return false;
		}
	}
//przefiltrowanie wprowadzonych danych
	function filterData($data,$filter = array('strip_tags','stripslashes'))
	{
		if (!is_array($data)) foreach($filter AS $filt) $data = call_user_func($filt,$data);
		else foreach($filter AS $filt) $data = array_map($filt,$data);
		return $data;
	}
//trwałe usunięcie linku z bazy danych
	function deleteBox($id)
	{
		global $config;
		$deleted = false;
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."boxes` WHERE `id` = '".$id."'");
		if ($query > 0) return true;
		else return false;
	}

//pokazanie boksu
	function showBox($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."boxes WHERE id = '$id' LIMIT 1");
		if (function_exists('strip_array')) $rows[0]['text'] = strip_array($rows[0]['text']);
		return $rows[0];
	}
//wyświetlenie boxu  - we frontendzie
	function displayBox($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."boxes WHERE slug = '$id' AND active = '1' AND lang = '".$_SESSION['lang-code']."' LIMIT 1");
		if($rows[0]['text'] != '') return (function_exists('strip_array'))?strip_array($rows[0]['text']):$rows[0]['text'];
		else return '';
	}
//zwrócenie informacji o autorze danego postu - współpracuje z klasą Auth
	function getAuthor($id)
	{
		$data = $this->auth->showUser($id); 
		if(isset($data[0]['display_name']) AND !is_numeric($data[0]['display_name'])) return $data[0]['display_name'];
		else return $data['display_name'];
	}
}
?>