<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa obsługi galerii zdjęć 
class Gallery
{
	
	function __construct(Base $db,Auth $auth)
	{
		$this->db = $db;
		$this->auth = $auth;
	}
//wyświetlenie listy kategorii galerii w panelu admina
	function categoriesList()
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_categories ORDER BY id ASC,modified ASC");
		return $rows;
	}
//dodanie/edycja kategorii w panelu admina
	function addEditCategory($data)
	{
		global $config;
		if (isset($_FILES['icon']) AND $_FILES['icon'] != '')
		{
			include_once($config['classes_dir'].'/class.uploadfile.php');
			$file = new uploadFile;
			$file->destination($config['gallery_dir']."/");
			$file->source = $_FILES['icon'];
			$file->prefix = $config['min_prefix'];
			$file->thumbWidth = $config['gallery_thumb_width'];
			$file->thumbQuality = $config['gallery_thumb_quality'];
			$file->thumbCreate = true;
			$file->CreateThumbail();
			if (!$file->error)
			{
				if ($file->getFileName() <> '') 
				{
					$temp = explode(".",$file->getFileName());
					$return = array('type'=>'ok','short'=>$temp[0],'text'=>$file->getFileName());
					$icon = $file->getFileName();
				}
				else $return = array('type'=>'error','text'=>'Wystąpił błąd przy wgrywaniu pliku');
			}
			else $return = array('type'=>'error','text'=>'Wystąpił błąd przy wgrywaniu pliku');
		}

		foreach($data AS $key=>$value)
		{
			if ($key == 'text') $data[$key] = $this->filterData($value,array('addslashes'));
			else $data[$key] = $this->filterData($value);		
		}
		$return = false;
		$author = $this->auth->showUserId();
		if ($data['id'] != '')
		{
			if ((isset($icon) AND $icon != '') OR (isset($data['delete_icon']) AND $data['delete_icon'] != ''))
			{
				$query = $this->db->query("SELECT icon FROM ".$config['db_prefix']."gallery_categories WHERE id = '".$data['id']."' LIMIT 1");
				if (isset($query[0]['icon']) AND $query[0]['icon'] != '') 
				{
					if (file_exists($config['gallery_dir'].$config['min_prefix'].$query[0]['icon'])) unlink($config['gallery_dir'].$config['min_prefix'].$query[0]['icon']);
					if (file_exists($config['gallery_dir'].$query[0]['icon'])) unlink($config['gallery_dir'].$query[0]['icon']);
				}
			}
			$query = $this->db->query("UPDATE ".$config['db_prefix']."gallery_categories SET `title` = '".$data['title']."',`author` = '".$author."',`modified` = NOW(),`active` = '".$data['active']."',`text` = '".$data['text']."',`lang` = '".$data['lang']."',`slug` = '".$data['slug']."'".((isset($icon) AND $icon != '')?',`icon` = \''.$icon.'\'':'')."".((isset($data['delete_icon']) AND $data['delete_icon'] != '')?',`icon` = \'\'':'')." WHERE id = '".$data['id']."'");
			if ($query > 0) return true;
			else return false;
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."gallery_categories (`title`,`author`,`modified`,`active`,`text`,`lang`,`slug`,`icon`) VALUES('".$data['title']."','".$author."',NOW(),'".$data['active']."','".$data['text']."','".$data['lang']."','".$data['slug']."'".((isset($icon) AND $icon != '')?',\''.$icon.'\'':',\'\'').")");
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
//trwałe usunięcie kategorii galerii z bazy danych
	function deleteCategory($id)
	{
		global $config;
		$deleted = false;
		$query = $this->db->query("SELECT icon FROM ".$config['db_prefix']."gallery_categories WHERE id = '".$id."' LIMIT 1");
		if (isset($query[0]['icon']) AND $query[0]['icon'] != '') 
		{
			if (file_exists($config['gallery_dir'].$config['min_prefix'].$query[0]['icon'])) unlink($config['gallery_dir'].$config['min_prefix'].$query[0]['icon']);
			if (file_exists($config['gallery_dir'].$query[0]['icon'])) unlink($config['gallery_dir'].$query[0]['icon']);
		}
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."gallery_categories` WHERE `id` = '".$id."'");
		if ($query > 0) return true;
		else return false;
	}

//pokazanie kategorii galerii
	function showCategory($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_categories WHERE id = '$id' LIMIT 1");
		return $rows[0];
	}
	
//wyświetlenie listy zdjęć w danej kategorii galerii w panelu admina
	function picturesList($category)
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_pictures WHERE `category_id` = '$category' ORDER BY `position` ASC,modified ASC");
		return $rows;
	}
//dodanie/edycja zdjęcia w panelu admina
	function addEditPicture($data)
	{
		global $config;
		if (isset($_FILES['image']) AND $_FILES['image'] != '')
		{
			include_once($config['classes_dir'].'/class.uploadfile.php');
			$file = new uploadFile;
			$file->destination($config['gallery_dir']."/");
			$file->source = $_FILES['image'];
			$file->prefix = $config['min_prefix'];
			$file->thumbWidth = $config['gallery_thumb_width'];
			$file->thumbQuality = $config['gallery_thumb_quality'];
			$file->thumbCreate = true;
			if ($config['gallery_crop'])
			{
				$file->crop = true;
				$file->cropped_width = $config['gallery_thumb_width']+20;
				$file->cropped_height = $config['gallery_thumb_height']+20;
			}
			$file->CreateThumbail();
			if (!$file->error)
			{
				if ($file->getFileName() <> '') 
				{
					$temp = explode(".",$file->getFileName());
					$return = array('type'=>'ok','short'=>$temp[0],'text'=>$file->getFileName());
					$image = $file->getFileName();
				}
				else $return = array('type'=>'error','text'=>'Wystąpił błąd przy wgrywaniu pliku');
			}
			else $return = array('type'=>'error','text'=>'Wystąpił błąd przy wgrywaniu pliku');
		}

		foreach($data AS $key=>$value)
		{
			if ($key == 'text') $data[$key] = $this->filterData($value,array('addslashes'));
			else $data[$key] = $this->filterData($value);		
		}
		$return = false;
		$author = $this->auth->showUserId();
		if ($data['id'] != '')
		{
			if ((isset($image) AND $image != '') OR (isset($data['delete_picture']) AND $data['delete_picture'] != ''))
			{
				$this->deletePicture($data['id'],false);
				$query = $this->db->query("SELECT image FROM ".$config['db_prefix']."gallery_pictures WHERE id = '".$data['id']."' LIMIT 1");
				if (isset($query[0]['image']) AND $query[0]['image'] != '') 
				{
					if (file_exists($config['gallery_dir'].$config['min_prefix'].$query[0]['image'])) unlink($config['gallery_dir'].$config['min_prefix'].$query[0]['image']);
					if (file_exists($config['gallery_dir'].$query[0]['image'])) unlink($config['gallery_dir'].$query[0]['image']);
				}
			}
			$query = $this->db->query("UPDATE ".$config['db_prefix']."gallery_pictures SET `author` = '".$author."',`modified` = NOW(),`active` = '".$data['active']."',`text` = '".$data['text']."',`lang` = '".$data['lang']."',`position` = '".$data['position']."'".((isset($image) AND $image != '')?',`image` = \''.$image.'\'':'')."".((isset($data['delete_picture']) AND $data['delete_picture'] != '')?',`image` = \'\'':'').",`category_id` = '".$data['category_id']."' WHERE id = '".$data['id']."'");
			if ($query > 0) return true;
			else return false;
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."gallery_pictures (`author`,`modified`,`active`,`text`,`lang`,`image`,`category_id`,`position`) VALUES('".$author."',NOW(),'".$data['active']."','".$data['text']."','".$data['lang']."','".((isset($image) AND $image != '')?$image:'')."','".$data['category_id']."','".$data['position']."')");
			if ($query > 0) return true;
			else return false;
		}
	}

//trwałe usunięcie zdjęcia z galerii z bazy danych
	function deletePicture($id,$dbase = true)
	{
		global $config;
		$query = $this->db->query("SELECT image FROM ".$config['db_prefix']."gallery_pictures WHERE id = '".$id."' LIMIT 1");
		if (isset($query[0]['image']) AND $query[0]['image'] != '') 
		{
			if (file_exists($config['gallery_dir'].$config['min_prefix'].$query[0]['image'])) unlink($config['gallery_dir'].$config['min_prefix'].$query[0]['image']);
			if (file_exists($config['gallery_dir'].$query[0]['image'])) unlink($config['gallery_dir'].$query[0]['image']);
			if (file_exists($config['gallery_dir']."2-".$config['min_prefix'].$query[0]['image'])) unlink($config['gallery_dir']."2-".$config['min_prefix'].$query[0]['image']);
			if (file_exists($config['gallery_dir']."2-".$query[0]['image'])) unlink($config['gallery_dir']."2-".$query[0]['image']);
		}
		if ($dbase) $query = $this->db->query("DELETE FROM `".$config['db_prefix']."gallery_pictures` WHERE `id` = '".$id."'");
		if ($query > 0) return true;
		else return false;
	}

//pokazanie zdjęcia galerii
	function showPicture($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_pictures WHERE id = '$id' LIMIT 1");
		return $rows[0];
	}
	
//wyświetlenie listy zdjęć z danej kategorii galerii  - we frontendzie
	function displayPicturesFromCategory($slug)
	{
		global $config;
		$slug = $this->filterData($slug);
		$rows = $this->db->query("SELECT id FROM ".$config['db_prefix']."gallery_categories WHERE `slug` = '$slug' AND lang = '".$_SESSION['lang-code']."' AND active = '1' LIMIT 1");
		$category_id = $rows[0]['id'];
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_pictures WHERE `category_id` = '$category_id' AND active = '1' AND lang = '".$_SESSION['lang-code']."' AND image <> '' ORDER BY position ASC, image ASC");
		if($rows > 0) return $rows;
		else return '';
	}
//zwrócenie informacji o autorze danego postu - współpracuje z klasą Auth
	function getAuthor($id)
	{
		if(is_array($id)) $id = $id[key($id)];
		else $id = $id;
		$data = $this->auth->showUser($id); 
		if(isset($data[0]['display_name']) AND !is_numeric($data[0]['display_name'])) return $data[0]['display_name'];
		else return $data['display_name'];
	}
//wyświetlenie listy kategorii aktywnych - w panelu admina
	function getActiveCategories()
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."gallery_categories WHERE `active` = '1' ORDER BY id ASC,modified ASC");
		return $rows;
	}
	function getMaxOrder()
	{
		global $config;
		$rows = $this->db->query("SELECT MAX(`position`) AS max FROM ".$config['db_prefix']."gallery_pictures LIMIT 1");
		if ($rows[0]['max'] != '')
		{
			$max = $rows[0]['max']+1;
			return $max;
		}
		else return '0';		
	}
	
	function order($id,$to)
	{
		global $config;
		if ($to == 'up' OR $to == 'down') $rows = $this->db->query("UPDATE ".$config['db_prefix']."gallery_pictures SET `position` = `position`".(($to == 'up')?'-':'+')."1 WHERE `id` = '".$id."' LIMIT 1");
		else return false;
	}
	
	function position($id,$position)
	{
		global $config;
		if (is_numeric($position)) $rows = $this->db->query("UPDATE ".$config['db_prefix']."gallery_pictures SET `position` = '".$position."' WHERE `id` = '".$id."' LIMIT 1");
		else return false;
	}
}
?>