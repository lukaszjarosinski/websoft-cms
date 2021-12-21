<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa obsługi linków zewnętrznych
class Link
{
	
	function __construct(Base $db,Auth $auth)
	{
		$this->db = $db;
		$this->auth = $auth;
	}
//wyświetlenie listy linków w panelu admina
	function linksList()
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."links ORDER BY id ASC,modified ASC");
		return $rows;
	}
//dodanie/educja linku w panelu admina
	function addEditLink($data)
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
			$query = $this->db->query("UPDATE ".$config['db_prefix']."links SET `anchor` = '".$data['anchor']."',`title` = '".$data['title']."',`url` = '".$data['url']."',`active` = '".$data['active']."',`target` = '".$data['target']."',`rel` = '".$data['rel']."',`modified` = NOW(),`author` = '".$author."',`lang` = '".$data['lang']."' WHERE id = '".$data['id']."'");
			if ($query > 0) return true;
			else return false;
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."links (`anchor`,`title`,`url`,`active`,`target`,`rel`,`author`,`modified`,`lang`) VALUES('".$data['anchor']."','".$data['title']."','".$data['url']."','".$data['active']."','".$data['target']."','".$data['rel']."','".$author."',NOW(),'".$data['lang']."')");
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
	function deleteLink($id)
	{
		global $config;
		$deleted = false;
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."links` WHERE `id` = '".$id."'");
		if ($query > 0) return true;
		else return false;
	}
//walidacja adresu URL
	function validateUrl($data)
	{
		if (!preg_match("#^http(s)?://[a-z0-9-_.]+\.[a-z]{2,4}#i", $data)) return false;
		else return true;	
	}
//pokazanie linku
	function showLink($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."links WHERE id = '$id' LIMIT 1");
		return $rows[0];
	}
//pokazanie linków (np. w stopce)
	function getLinks($html = true)
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."links WHERE active = '1' AND `lang` = '".$_SESSION['lang-code']."' ORDER BY modified ASC,id ASC");
		if (!$html) return $rows;
		else
		{
			if (is_array($rows) AND count(array($rows)))
			{
				$return = "<ul>";
				foreach($rows AS $row)
				{
					if (strstr($row['url'],'http://') OR strstr($row['url'],'https://')) $url = $row['url'];
					else $url = 'http://'.$row['url'];
					if ($row['url'] != '') $return .= "<li><a href=\"".$url."\"".(($row['target'] != '' AND $row['target'] != '_none')?" target=\"".$row['target']."\"":"")."".(($row['rel'] != '')?" rel=\"".$row['rel']."\"":"").">".$row['anchor']."</a></li>";
				}
				$return .= "</ul>";
			}
			return $return;
		}
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