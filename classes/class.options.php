<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa obsługi opcji konfiguracyjnych; służą do skonfigurowania części aspektów serwisu, np. metatagów 
class Options
{
	
	function __construct(Base $db,Auth $auth)
	{
		$this->db = $db;
		$this->auth = $auth;
	}
//wyświetlenie listy opcji w panelu admina
	function optionsList()
	{
		global $config;
		foreach($config['installed_languages'] AS $langs)
		{
			$rows[] = array($langs['lang'],$langs['name'],$this->db->query("SELECT * FROM ".$config['db_prefix']."options WHERE lang = '".$langs['lang']."' ORDER BY id ASC"));
		}
		return $rows;
	}
//dodanie/edycja opcji w panelu admina
	function updateOption($data)
	{
		global $config;
		$error1 = 0;
		$lang = $data['lang'];
		foreach($data AS $key=>$value)
		$q = 'UPDATE '.$config['db_prefix'].'options SET `value` = CASE `key`';
		foreach($data AS $key=>$value) 
		{
			if ($key != 'submit' AND $key != 'action' AND $key != 'lang') 
			{
				$q .= " WHEN '".$this->filterData($key)."' THEN '".$this->filterData($value)."'";
			}
		}
		
		$q .= " END WHERE `lang` = '".$lang."'";
		
		$query = $this->db->query($q);
		if ($query > 0) return true; 
		else return false;
	}
//przefiltrowanie wprowadzonych danych
	function filterData($data,$filter = array('strip_tags','stripslashes'))
	{
		if (!is_array($data)) foreach($filter AS $filt) $data = call_user_func($filt,$data);
		else foreach($filter AS $filt) $data = array_map($filt,$data);
		return $data;
	}

//pobranie konkretnej wartości klucza - we frontendzie
	function getValue($key)
	{
		global $config;
		$key = $this->filterData($key);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."options WHERE `key` = '$key' AND lang = '".$_SESSION['lang-code']."' LIMIT 1");
		if($rows[0]['value'] != '') return $rows[0]['value'];
		else return '';
	}
}
?>