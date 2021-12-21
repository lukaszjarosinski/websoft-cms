<?
/*
Copyright 2021 by Łukasz Jarosiński
www.lukaszjarosinski.pl
tel. 508 052 990
*/

class Base
{
	var $debug;
	var $connection;
	var $result;
	var $t;
	var $error;

	function connect($user,$password,$host,$db)
	{
		try{
			$this->connection = new PDO("mysql:host=".$host.";dbname=".$db, $user, $password);
		}
		catch (PDOException $e){
			echo "Błąd połączenia z bazą danych";
		}
		if(is_object($this->connection))
		{
			$this->query("SET NAMES UTF8");
			return true;
		}
		else return false;
	}
		
	function disconnect()
	{
		$this->connection = null;
		return 0;
	}
	
	function query($sql,$debug=false)
	{
		if ($debug) echo "<p>".$sql."</p>";
		try {
		$this->result = $this->connection->query($sql);
		$error = $this->connection->errorInfo();
		if($error[0] != 0) echo "<p>Błąd zapytania:</p><p>".$error[2]."</p><p>". $error[0]."</p>";
		if (preg_match("/INSERT/",$sql) OR preg_match("/insert/",$sql))
		{
			$res = $this->lastId();
		}
		elseif (preg_match("/UPDATE/",$sql) OR preg_match("/update/",$sql) OR preg_match("/DELETE/",$sql) OR preg_match("/delete/",$sql))
		{
			$res = $this->affected();
		}
		elseif (preg_match("/SELECT/",$sql) OR preg_match("/select/",$sql))
		{
			$res = $this->rows();
		}
		elseif (preg_match("/SHOW TABLES/",$sql) OR preg_match("/show tables/",$sql))
		{
			$res = $this->rows();
		}
		if (isset($res)) return $res;
		} catch (PDOException $e) {
				echo "Wystąpił błąd z pobieraniem danych:".$e->getMessage();
				return 0;
		}		
	}
	
	function lastId()
	{
		$id = $this->connection->lastInsertId();
		return $id;
	}
	
	function affected()
	{
		$aff = $this->result->rowCount();
		return $aff;
	}
	
	function rows()
	{
		if (!empty($this->result))
		{
			while($t = $this->result->fetch(PDO::FETCH_ASSOC))
			{
				$tab[] = $t;
			}
			if (isset($tab)) return $tab;
		}
		else return false;
	}

}
?>