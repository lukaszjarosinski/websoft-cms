<?
/*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*/
//Klasa obsługi wpisów - copyright by WAWRUS 2009
//Typy postów: "post" - wpis, "category" - kategoria, "page" - strona
//Statusy postów: "draw" - projekt, "published" - opublikowany, "trash" - w koszu
class Posts
{
	
	function __construct(Base $db,Auth $auth)
	{
		$this->db = $db;
		$this->auth = $auth;
	}
//pobranie wszystkich pól związanych z konkretnym wpisem - zwrócenie w formie jednej tablicy	
	function post($id)
	{
		global $config;
		global $where;
		if(is_array($id)) $id = $id['id'];
		else $id = $id;
		$posts = $this->db->query("SELECT * FROM ".$config['db_prefix']."posts WHERE id = '$id' LIMIT 1");
		$comments = $this->db->query("SELECT * FROM ".$config['db_prefix']."comments WHERE post_id = '$id'");
		$metaoptions = $this->db->query("SELECT `key`,`value` FROM ".$config['db_prefix']."metaoptions WHERE post_id = '$id'");
		$post = $posts[0];
		if (!$post) return false;
		if (count(array($metaoptions)) > 0 AND is_array($metaoptions)) foreach($metaoptions AS $option) $post[$option['key']] = $option['value'];
		$post['comments'] = $comments;
		if ($post['type'] == 'post')
		{
			$relations = $this->db->query("SELECT rel.category,posts.title FROM ".$config['db_prefix']."relations AS rel LEFT JOIN ".$config['db_prefix']."posts AS posts ON rel.category = posts.id WHERE rel.post_id = '".$post['id']."' AND posts.type = 'category'");
			if (count(array($relations)) > 0) foreach($relations AS $rel) $post['categories'][] = $rel['category'];
		}
		if (function_exists('strip_array')) $post['text'] = strip_array($post['text']);
		if($where != 'backend') $post['text'] = do_shortcode($post['text']);
		return $post;
	}

//lista kategorii w formie drzewa	
	function categoryList($status = '',$tree = false)
	{
		global $config;
		$rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'category'".(($status != '')?" AND posts.status = '".$status."'":"")." ORDER BY `order` ASC, modified DESC");
		if (!$tree) 
		{
			if($status != 'trash' AND $status != 'draw') return $this->formatTree($rows);
			else return $rows;
		}
	}
//lista kategorii bez drzewa
/*	function postCategoryList($status = '')
	{
		global $config;
		$rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'category'".(($status != '')?" AND status = '".$status."'":"")." ORDER BY `order` ASC, modified DESC");
		return $rows;
	}*/
//tekstowa lista kategorii - używana jako lista kategorii, do których przypisano wpis
	function categoryListText($post_id)
	{
		global $config;
		$rows = $this->db->query("SELECT relations.*,posts.title AS tit FROM ".$config['db_prefix']."relations AS relations LEFT JOIN ".$config['db_prefix']."posts AS posts ON relations.category = posts.id WHERE relations.post_id = '".$post_id."' AND posts.type = 'category' AND posts.status = 'published' AND posts.post_on = '1'");
		if (count(array($rows)) > 0) 
		{
			foreach($rows AS $row) $return[] = $row['tit'];
			return implode(", ",$return);
		}
	}
//lista stron w formie drzewa	
	function pagesList($status = '', $tree = false)
	{
		global $config;
		$rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'page'".(($status != '')?" AND status = '".$status."'":"")." ORDER BY modified DESC");
		if (!$tree) 
		{
			if($status != 'trash') return $this->formatTree($rows);
			else return $rows;
		}
	}
//zwrócenie liczby elementów wyświetlanych w panelu admina - np. paginacja przy wyświetlaniu postów
	function elementNo()
	{
	 global $config;
	 return $config['admin_elements_per_page'];
	}
//lista postów z przypisaną tekstową listą kategorii - listowanie wpisów w panelu admina	
	function postsList($status = '',$page = '',$category = '')
	{
		global $config;
		if ($page == '') $page = 1;
		$from = ceil($page*$config['admin_elements_per_page'])-$config['admin_elements_per_page'];
		$to = ceil($page*$config['admin_elements_per_page']);
		if ($category == '') $rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'post'".(($status != '')?" AND status = '".$status."'":"")." ORDER BY modified DESC LIMIT ".$from.",".$to."");
		else $rows = $this->db->query("SELECT posts.*,rel.category FROM ".$config['db_prefix']."posts AS posts,".$config['db_prefix']."relations AS rel WHERE rel.post_id = posts.id AND rel.category = '".$category."' AND posts.type = 'post'".(($status != '')?" AND status = '".$status."'":"")." ORDER BY modified DESC LIMIT ".$from.",".$to."");
		$ile = count(array($rows));
		for($i=0;$i<$ile;$i++)
		{
		$rows[$i]['categories'] = $this->categoryListText($rows[$i]['id']);
		$i++;
		}
		return $rows;
	}
//pobranie kategorii - we frontendzie
	function getCategories($parent = 0,$html = true,$orderby = 'order',$order = 'ASC',$hideempty = false,$hierarhical = true,$number_posts = false,$exclude = '',$include = '')
	{
		global $config;
		if ($include != '')
		{
			$include_ext_rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."attribution WHERE post1 IN (".$include.")");
			if (count(array(include_ext_rows)) > 0) 
			{
				foreach($include_ext_rows AS $in_ext_rows)
				{
					$include_array[] = $in_ext_rows['post2'];
				}
				$include = $include.((implode(",",$include_array) != '')?",".implode(",",$include_array):"");
			}
		}
		$rows = $this->db->query("SELECT posts.id,posts.title,posts.parent,posts.slug,posts.order,posts.link FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'category' ".(($hierarhical)?"AND posts.parent = '".$parent."'":"")." AND posts.post_on = '1' AND posts.status = 'published'".(($exclude != '')?" AND posts.id NOT IN (".$exclude.")":"")."".(($include != '')?" AND posts.id IN (".$include.")":"")." AND lang = '".$_SESSION['lang-code']."' ORDER BY `".$orderby."` ".$order);
		if ($html == false) return $this->formatTree($rows);
		else
		{
			if (count(array($rows)) > 0)
			{
				$return .= "<ul>\n";
				if(is_array($rows)) foreach($rows AS $row)
				{
					if ($number_posts OR $hideempty) $return_number = $this->db->query("SELECT COUNT(id) AS count FROM ".$config['db_prefix']."relations WHERE category = '".$row['id']."'");
					if (($hideempty AND $return_number[0]['count'] > 0) OR !$hideempty) $return .= "<li><a href=\"".(($row['link'] != '')?$row['link']:$config['domain'].$_SESSION['lang-code']."/".$row['slug'])."\">".$row['title'].(($number_posts)?" (".$return_number[0]['count'].")":"")."</a>\n";
					if ($hierarhical) $return .= $this->getCategories($row['id'],$html,$orderby,$order,$hideempty,$hierarhical,$number_posts,$exclude,$include);
					$return .= "</li>\n";
				}
				$return .= "</ul>\n";
			}
			return $return;
		}
	}
//pobranie postów w kategorii - we frontendzie
	function getPosts($id = '',$page = 1,$orderby = 'order',$order = 'ASC',$exclude = '',$include = '', $limit = true, $number = '')
	{
		global $config;
		if(is_array($id)) $id = $id[key($id)];
		else $id = $id;
		if ($include != '')
		{
			$include_ext_rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."attribution WHERE post1 IN (".$include.")");
			foreach($include_ext_rows AS $in_ext_rows)
			{
				$include_array[] = $in_ext_rows['post2'];
			}
			$include = $include.((implode(",",$include_array) != '')?",".implode(",",$include_array):"");
		}
		if ($limit)
		{
			$howmuch = ($number != '')?$number:$config['frontend_elements_per_page'];
			$from = ($page*$howmuch)-$howmuch;
			$to = $page*$howmuch;
		}
		if ($id != '') $rows = $this->db->query("SELECT rel.post_id,rel.category,posts.* FROM ".$config['db_prefix']."relations AS rel LEFT JOIN ".$config['db_prefix']."posts AS posts ON rel.post_id = posts.id WHERE rel.category = '".$id."' AND posts.type = 'post' AND posts.status = 'published' AND posts.post_on = '1'".(($exclude != '')?" AND posts.id NOT IN (".$exclude.")":"")."".(($include != '')?" AND posts.id IN (".$include.")":"")." AND lang = '".$_SESSION['lang-code']."' ORDER BY posts.`".$orderby."` ".$order.(($limit)?' LIMIT '.$from.','.$to.'':''));
		else $rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'post' AND posts.status = 'published' AND posts.post_on = '1'".(($exclude != '')?" AND posts.id NOT IN (".$exclude.")":"")."".(($include != '')?" AND posts.id IN (".$include.")":"")." AND lang = '".$_SESSION['lang-code']."' ORDER BY posts.`".$orderby."` ".$order.(($limit)?' LIMIT '.$from.','.$to.'':''));
		if (count(array($rows)) > 0) 
		{
			if (is_array($rows)) foreach($rows AS $row)
			{
				if (function_exists('strip_array')) $row['text'] = strip_array($row['text']);
				$row['text'] = do_shortcode($row['text']);
				$rows2[] = $row;
			}
		return $rows2;
		}
	}
//pobranie liczby stron przy wyświetlaniu postów
	function pageNo($id)
	{
		global $config;
		$rows = $this->db->query("SELECT COUNT(post_id) AS count FROM ".$config['db_prefix']."relations WHERE category = '$id'");
		$pages = ceil($rows[0]['count']/$config['frontend_elements_per_page']);
		return $pages;
	}
//pobranie stron w formie menu - we frontendzie
	function getPages($parent = 0,$html = true,$orderby = 'order',$order = 'ASC',$hierarhical = true,$exclude = '',$include = '')
	{
		global $config;
		if ($include != '')
		{
			$include_ext_rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."attribution WHERE post1 IN (".$include.")");
			if (count(array($include_ext_rows)) > 0)
			{
				foreach($include_ext_rows AS $in_ext_rows)
				{
					$include_array[] = $in_ext_rows['post2'];
				}
				$include = $include.((implode(",",$include_array) != '')?",".implode(",",$include_array):"");
			}
		}
		$rows = $this->db->query("SELECT posts.id,posts.title,posts.parent,posts.slug,posts.order,posts.link FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'page' ".(($hierarhical && $html == true)?"AND posts.parent = '".$parent."'":"")." AND posts.post_on = '1' AND posts.status = 'published'".(($exclude != '')?" AND posts.id NOT IN (".$exclude.")":"")."".(($include != '')?" AND posts.id IN (".$include.")":"")." AND lang = '".$_SESSION['lang-code']."' ORDER BY `".$orderby."` ".$order);
		if ($html == false) 
		{
			if (!$hierarhical) return $rows;
			else return $this->formatTree($rows);
		}
		else
		{
			if (count(array($rows)) > 0)
			{
				$return .= "<ul>\n";
				if(is_array($rows)) foreach($rows AS $row)
				{
					$return .= "<li><a href=\"".(($row['link'] != '')?$row['link']:$config['domain'].$_SESSION['lang-code']."/".$row['slug'])."\">".$row['title'].(($number_posts)?" (".$return_number[0]['count'].")":"")."</a>\n";
					if ($hierarhical) $return .= $this->getPages($row['id'],$html,$orderby,$order,$hierarhical,$exclude,$include);
					$return .= "</li>\n";
				}
				$return .= "</ul>\n";
			}
			return $return;
		}
	}
//lista nadrzędnych stron - w panelu admina, przy dodawaniu strony w formularzu
	function parentPagesList($id = '')
	{
		global $config;
		$rows = $this->db->query("SELECT posts.id,posts.title,posts.parent FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'page'".(($id != '')?" AND id <> '".$id."'":"")." AND posts.status = 'published' AND posts.post_on = '1' ORDER BY modified DESC");
		return $this->formatTree($rows);
	}
//lista nadrzędnych kategorii - w panelu admina, przy dodawaniu kategorii w formularzu	
	function parentCategoriesList($id = '')
	{
		global $config;
		$rows = $this->db->query("SELECT posts.id,posts.title,posts.parent FROM ".$config['db_prefix']."posts AS posts WHERE posts.type = 'category'".(($id != '')?" AND id <> '".$id."'":"")." AND posts.status = 'published' AND posts.post_on = '1' ORDER BY modified DESC");
		return $this->formatTree($rows);
	}
//zapisywanie informacji o wpisie - zarówno dodanie, jak i edycja konkretnego wpisu
	function addEditPost($data)
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
			$query = $this->db->query("UPDATE ".$config['db_prefix']."posts SET `title` = '".$data['title']."',`text` = '".$data['text']."',`excerpt` = '".$data['excerpt']."',`type` = 'post',`slug` = '".$data['slug']."',`order` = '".$data['order']."',`post_on` = '".$data['post_on']."',`modified` = NOW(),`author` = '".$author."',`status` = '".$data['status']."',`lang` = '".$data['lang']."',`link` = '".$data['link']."' WHERE id = '".$data['id']."'");
			if ($query > 0) $return = true;
			$post_id = $data['id'];
			$return = $this->toCategory($data,$post_id);
			$return = $this->Attribution($data['post1'],$post_id);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$post_id);
			return $return;		
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."posts (`title`,`text`,`excerpt`,`type`,`slug`,`order`,`post_on`,`created`,`modified`,`author`,`status`,`lang`,`link`) VALUES('".$data['title']."','".$data['text']."','".$data['excerpt']."','post','".$data['slug']."','".$data['order']."','".$data['post_on']."',NOW(),NOW(),'".$author."','".$data['status']."','".$data['lang']."','".$data['link']."')");
			if ($query > 0) $return = true;
			$return = $this->toCategory($data,$query);
			$return = $this->Attribution($data['post1'],$query);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$query);
			return $return;
		}
	}
//zapisywanie informacji o stronie - zarówno dodanie, jak i edycja konkretnej strony
	function addEditPage($data)
	{
		global $config;
		foreach($data AS $key=>$value)
		{
			if ($key == 'text' OR $key == 'title') $data[$key] = $this->filterData($value,array('addslashes'));
			else $data[$key] = $this->filterData($value);		
		}
		$return = false;
		$author = $this->auth->showUserId();
		if ($data['id'] != '')
		{
			$query = $this->db->query("UPDATE ".$config['db_prefix']."posts SET `title` = '".$data['title']."',`text` = '".$data['text']."',`excerpt` = '".$data['excerpt']."',`type` = 'page',`slug` = '".$data['slug']."',`parent` = '".$data['parent']."',`order` = '".$data['order']."',`post_on` = '".$data['post_on']."',`modified` = NOW(),`author` = '".$author."',`status` = '".$data['status']."',`lang` = '".$data['lang']."',`link` = '".$data['link']."' WHERE id = '".$data['id']."'");
			if ($query > 0) $return = true;
			$post_id = $data['id'];
			$return = $this->Attribution($data['post1'],$post_id);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$post_id);
			return $return;		
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."posts (`title`,`text`,`excerpt`,`type`,`slug`,`parent`,`order`,`post_on`,`created`,`modified`,`author`,`status`,`lang`,`link`) VALUES('".$data['title']."','".$data['text']."','".$data['excerpt']."','page','".$data['slug']."','".$data['parent']."','".$data['order']."','".$data['post_on']."',NOW(),NOW(),'".$author."','".$data['status']."','".$data['lang']."','".$data['link']."')");
			if ($query > 0) $return = true;
			$return = $this->Attribution($data['post1'],$query);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$query);
			return $return;
		}
	}
//zapisywanie informacji o kategorii - zarówno dodanie, jak i edycja konkretnek kategorii
	function addEditCategory($data)
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
			$query = $this->db->query("UPDATE ".$config['db_prefix']."posts SET `title` = '".$data['title']."',`status` = '".$data['status']."',`slug` = '".$data['slug']."',`parent` = '".$data['parent']."',`order` = '".$data['order']."',`post_on` = '".$data['post_on']."',`modified` = NOW(),`author` = '".$author."',`lang` = '".$data['lang']."',`link` = '".$data['link']."' WHERE id = '".$data['id']."'");
			if ($query > 0) $return = true;
			$post_id = $data['id'];
			$return = $this->Attribution($data['post1'],$post_id);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$post_id);
			return $return;		
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."posts (`title`,`type`,`slug`,`parent`,`order`,`post_on`,`created`,`modified`,`author`,`status`,`lang`,`link`) VALUES('".$data['title']."','category','".$data['slug']."','".$data['parent']."','".$data['order']."','".$data['post_on']."',NOW(),NOW(),'".$author."','".$data['status']."','".$data['lang']."','".$data['link']."')");
			if ($query > 0) $return = true;
			$return = $this->Attribution($data['post1'],$query);
			$array = array('id','action','title','text','excerpt','type','slug','parent','order','post_on','author','status','category','submit','lang','link','text1','post1');
			$data = $this->arrayElementDelete($data,$array);
			if (count(array($data)) > 0) $return = $this->addMeta($data,$query);
			return $return;
		}
	}
//zapisywanie pól dodatkowych postu - np. informacje na potrzeby seo i można dodać wiele innych pól dodatkowych - wystarczy w formularzu dodawania wpisu/kategorii/strony dodać odpowiednie pole
	function addMeta($data,$post_id)
	{
		global $config;
		foreach($data AS $key=>$value) $query = $this->db->query("INSERT INTO ".$config['db_prefix']."metaoptions (`post_id`,`key`,`value`) VALUES('".$post_id."','".$key."','".$value."') ON DUPLICATE KEY UPDATE `value` = '".$value."'");
		return true;
	}
//przypisanie wpisów, stron, kategorii dla wersji językowych
	function Attribution($post1,$post2)
	{
		global $config;
		$query = $this->db->query("DELETE FROM ".$config['db_prefix']."attribution WHERE ".(($post2 != '')?"post2 = '".$post2."'":"post1 = '".$post1."'"));
		if ($post1 != '' AND $post2 != '') $query = $this->db->query("INSERT IGNORE INTO ".$config['db_prefix']."attribution VALUES('".$post1."','".$post2."')");
		if ($query > 0) $return = true;
		else $return = false;
		return $return;
	}
//pokazanie przypisania wpisów, stron, kategorii dla wersji językowych
	function getAttribution($post1,$post2)
	{
		global $config;
		$query = $this->db->query("SELECT * FROM ".$config['db_prefix']."attribution WHERE post1 = '".$post1."' AND post2 = '".$post2."' LIMIT 1");
		if (count(array($query)) == 1) return true;
		else return false;
	}
//przypisanie wpisu do kategorii - najpierw usuwa wszystkie przypisania, a następnie dodaje je od nowa
	function toCategory($data,$post_id)
	{
		global $config;
		$query = $this->db->query("DELETE FROM ".$config['db_prefix']."relations WHERE `post_id` = '".$post_id."'");
		if (is_array($data['category'])) foreach($data['category'] AS $cat) $query = $this->db->query("INSERT INTO ".$config['db_prefix']."relations (post_id,category) VALUES('".$post_id."','".$cat."')");
		else $query = $this->db->query("INSERT INTO ".$config['db_prefix']."relations (post_id,category) VALUES('".$post_id."','".$data['category']."')");
		if ($query > 0) $return = true;
		return $return;
	}
//sprawdzenie czy slug (skrót) postu istnieje już w bazie danych
	function slugExists($slug,$id)
	{
		global $config;
		$exists = false;
		$query = $this->db->query("SELECT COUNT(id) AS count FROM ".$config['db_prefix']."posts WHERE slug = '".$slug."'".(($id != '')?" AND `id` <> '".$id."'":"")."");
		if ($query[0]['count'] > 0 OR $slug == str_replace("/","",$config['catalog'])) $exists = "false";
		else $exists = "true";
		return $exists;
	}
//trwałe usunięcie wpisu i wszystkich z nim powiązanych pól dodatkowych, komentarzy itd.
	function deletePost($id)
	{
		global $config;
		$deleted = false;
		$query1 = $this->db->query("DELETE FROM `".$config['db_prefix']."posts` WHERE `id` = '".$id."'");
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."metaoptions` WHERE `post_id` = '".$id."'");
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."comments` WHERE `post_id` = '".$id."'");
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."relations` WHERE `post_id` = '".$id."'");
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."attribution` WHERE `post2` = '".$id."'");
		if ($query1 > 0) $deleted = true;
		return $deleted;
	}
//przeniesienie wpisu do kosza	
	function removePost($id)
	{
		global $config;
		$deleted = false;
		$query = $this->db->query("UPDATE `".$config['db_prefix']."posts` SET `status` = 'trash', `modified` = NOW() WHERE `id` = '".$id."'");
		if ($query > 0) $deleted = true;
		return $deleted;
	}
//przywrócenie postu w kosza - oznaczenie jako opublikowany	
	function restorePost($id)
	{
		global $config;
		$deleted = false;
		$query = $this->db->query("UPDATE `".$config['db_prefix']."posts` SET `status` = 'published', `modified` = NOW() WHERE `id` = '".$id."'");
		if ($query > 0) $deleted = true;
		return $deleted;
	}
//przefiltrowanie wprowadzonych danych
	function filterData($data,$filter = array('strip_tags','stripslashes'))
	{
		if (count(array($filter)) > 0)
		{
			if (!is_array($data)) foreach($filter AS $filt) 
			{
				if(function_exists($filt)) $data = call_user_func($filt,$data);
				else $data = $data;
			}
			else foreach($filter AS $filt) 
			{
				if(function_exists($filt)) $data = array_map($filt,$data);
				else $data = $data;
			}
			return $data;
		}
		else return $data;
	}
//usunięcie elementu tablicy - podczas dodawania pól dodatkowych postu
	function arrayElementDelete($ary,$key_to_be_deleted)
  {
		foreach($key_to_be_deleted AS $key) unset($ary[$key]);
		return $ary;
  }
//usunięcie polskich znaków, zamiana spacji w podkreślniki itd.
	function deletePolish($text)
	{
		$text = html_entity_decode($text);
		$search = array(
			' ',
			'/',
			'\'',
			'&',
			'%',
			'ć',
			'ś',
			'ą',
			'ż',
			'ź',
			'ó',
			'ł',
			'ś',
			'ż',
			'ń',
			'ę',
			'$',
			'(',
			')',
			'?',
			'!',
			'-',
			':',
			';',
			',',
			'Ć',
			'Ś',
			'Ą',
			'Ż',
			'Ź',
			'Ó',
			'Ł',
			'Ś',
			'Ż',
			'Ń',
			'Ę',
		);
		$change = array(
			'_',
			'',
			'',
			'_',
			'',
			'c',
			's',
			'a',
			'z',
			'z',
			'o',
			'l',
			's',
			'z',
			'n',
			'e',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'c',
			's',
			'a',
			'z',
			'z',
			'o',
			'l',
			's',
			'z',
			'n',
			'e',
		);
		$text = strtolower($text); // Zamiana na małe litery
		$text = str_replace($search, $change, $text); // Zamiana znaków z tablic
		return $text;
	}
//formowarowanie drzewa - tworzenie tablicy przy wyświetlaniu list kategorii w formie drzewa, stron w formie drzewa itd.	
	function formatTree($tree, $parent = 0)
	{
		$tree2 = array();
    if (count(array($tree)) > 0) foreach($tree as $i => $item){
			if($item['parent'] == $parent){
				$tree2[$item['id']] = $item;
        $tree2[$item['id']]['submenu'] = $this->formatTree($tree, $item['id']);
			}
		}
		return $tree2;
	}
//zwrócenie liczby postów określonego typu (wpis, kategoria, strona) i statusie (draw, published, trash)	
	function countPosts($type,$status)
	{
		global $config;
		$rows = $this->db->query("SELECT count(posts.id) AS count FROM ".$config['db_prefix']."posts AS posts WHERE ".(($type != '')?"posts.type = '".$type."'":"")."".(($status != '')?" AND posts.status = '".$status."'":"")."");
		return $rows[0]['count'];
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
//sprawdzenie czy post istnieje o danym slugu istnieje (po parsowaniu urla), jeżeli tak, pobranie posta i zwrócenie jego danych, jeżeli nie, zwraca false
	function postExists($array)
	{
		global $config;
		$arr = implode("','",$array);
		$rows = $this->db->query("SELECT id FROM ".$config['db_prefix']."posts WHERE slug IN('".$arr."') AND lang = '".$_SESSION['lang-code']."'");
		if(count(array($rows)) > 0) foreach($rows AS $row)
		{
			if ($row['id'] != '' AND is_numeric($row['id'])) $return[] = $this->post($row['id']);
		}
		if (isset($return)) return $return;
		else return false;
	}
//sprawdzenie id posta o danym slugu (po parsowaniu urla)
	function postIdByUrl($array)
	{
		global $config;
		$arr = implode("','",$array);
		$rows = $this->db->query("SELECT id FROM ".$config['db_prefix']."posts WHERE slug IN('".$arr."') AND lang = '".$_SESSION['lang-code']."'");
		if(count(array($rows)) > 0) foreach($rows AS $row)
		{
			if ($row['id'] != '' AND is_numeric($row['id'])) $return[] = $row['id'];
		}
		if (isset($return)) return $return;
		else return false;
	}
//link do następnego postu	
	function nextPost($id)
	{
		global $config;
		if(is_array($id)) $id = $id[key($id)];
		else $id = $id;
		$rows = $this->db->query("SELECT title,slug FROM ".$config['db_prefix']."posts WHERE created > (SELECT created FROM ".$config['db_prefix']."posts WHERE id = '".$id."' LIMIT 1) AND type = 'post' AND lang = '".$_SESSION['lang-code']."' ORDER BY created ASC LIMIT 1");
		if (count(array($rows)) > 0) return $rows[0];
		else return false;
	}
//link do poprzedniego postu	
	function prevPost($id)
	{
		global $config;
		if(is_array($id)) $id = $id[key($id)];
		else $id = $id;
		$rows = $this->db->query("SELECT title,slug FROM ".$config['db_prefix']."posts WHERE created < (SELECT created FROM ".$config['db_prefix']."posts WHERE id = '".$id."' LIMIT 1) AND type = 'post' AND lang = '".$_SESSION['lang-code']."' ORDER BY created ASC LIMIT 1");
		if (count(array($rows)) > 0) return $rows[0];
		else return false;
	}
	
//string id do breadcrumb
	function breadcrumbString($id)
	{
		global $config;
		if(is_array($id)) $id = $id[key($id)];
		else $id = $id;
		$return .= $id."|";
		$rows = $this->db->query("SELECT parent FROM ".$config['db_prefix']."posts WHERE `id` = '".$id."' LIMIT 1");
		if ($rows[0]['parent'] != 0) $return .= $this->breadcrumbString($rows[0]['parent']);
		return $return;
	}
	function getMaxOrder($type)
	{
		global $config;
		$rows = $this->db->query("SELECT MAX(`order`) AS max FROM ".$config['db_prefix']."posts WHERE `type` = '".$type."' LIMIT 1");
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
		if ($to == 'up' OR $to == 'down') $rows = $this->db->query("UPDATE ".$config['db_prefix']."posts SET `order` = `order`".(($to == 'up')?'-':'+')."1 WHERE `id` = '".$id."' LIMIT 1");
		else return false;
	}

	function position($id,$position)
	{
		global $config;
		if (is_numeric($position)) $rows = $this->db->query("UPDATE ".$config['db_prefix']."posts SET `order` = '".$position."' WHERE `id` = '".$id."' LIMIT 1");
		else return false;
	}
	
//pokazanie linku
	function showMenu($id)
	{
		global $config;
		$id = $this->filterData($id);
		$rows = $this->db->query("SELECT menus.* FROM ".$config['db_prefix']."menus AS menus WHERE menus.id = '".$id."' LIMIT 1");
		$array = $this->db->query("SELECT * FROM ".$config['db_prefix']."menus_content WHERE menu_id = '".$id."'");
		if (count(array($array)) > 0) foreach($array AS $arr) $rows[0]['array'][] = $arr['post'];
		else $rows[0]['array'] = array();
		//print_r($rows);
		return $rows[0];
	}
//lista wszystkich postów - listowanie postów w panelu admina	przy tworzeniu menu
	function allList()
	{
		global $config;
		$rows = $this->db->query("SELECT posts.* FROM ".$config['db_prefix']."posts AS posts ORDER BY `order` DESC");
		return $this->formatTree($rows);
	}
	
	function breadcrumbArray($id)
	{
		return explode('|',$this->breadcrumbString($id));
	}
	//lista menu
	function menusList()
	{
		global $config;
		$rows = $this->db->query("SELECT * FROM ".$config['db_prefix']."menus");
		return $rows;
	}
//zapisywanie informacji o wpisie - zarówno dodanie, jak i edycja konkretnego wpisu
	function addEditMenu($data)
	{
		global $config;
		//$data[$key] = $this->filterData($value);		
		
		$return = false;
		$author = $this->auth->showUserId();
		if ($data['id'] != '')
		{
			$query = $this->db->query("UPDATE ".$config['db_prefix']."menus SET `title` = '".$data['title']."',`slug` = '".$data['slug']."',`active` = '".$data['active']."' WHERE id = '".$data['id']."'");
			if ($query > 0) $return = true;
			$menu_id = $data['id'];
			$return = $this->addEditMenuContent($data,$menu_id);
			return $return;		
		}
		else
		{
			$query = $this->db->query("INSERT INTO ".$config['db_prefix']."menus (`title`,`slug`,`active`) VALUES('".$data['title']."','".$data['slug']."','".$data['active']."')");
			if ($query > 0) $return = true;
			$return = $this->addEditMenuContent($data,$query);
			return $return;
		}
	}
//dodanie zawartości menu - najpierw usuwa całą zawartość, a następnie dodaje ją od nowa
	function addEditMenuContent($data,$menu_id)
	{
		global $config;
		$query = $this->db->query("DELETE FROM ".$config['db_prefix']."menus_content WHERE `menu_id` = '".$menu_id."'");
		if (is_array($data['array'])) foreach($data['array'] AS $menu) $query = $this->db->query("INSERT INTO ".$config['db_prefix']."menus_content (`menu_id`,`post`) VALUES('".$menu_id."','".$menu."')");
		else $query = $this->db->query("INSERT INTO ".$config['db_prefix']."menus_content (`menu_id`,`post`) VALUES('".$menu_id."','".$data['array']."')");
		if ($query > 0) $return = true;
		return $return;
	}
//sprawdzenie czy slug (skrót) menu istnieje już w bazie danych
	function menuSlugExists($slug,$id)
	{
		global $config;
		$exists = false;
		$query = $this->db->query("SELECT COUNT(id) AS count FROM ".$config['db_prefix']."menus WHERE slug = '".$slug."'".(($id != '')?" AND `id` <> '".$id."'":"")."");
		if ($query[0]['count'] > 0 OR $slug == str_replace("/","",$config['catalog'])) $exists = "false";
		else $exists = "true";
		return $exists;
	}
//trwałe usunięcie menu
	function deleteMenu($id)
	{
		global $config;
		$deleted = false;
		$query1 = $this->db->query("DELETE FROM `".$config['db_prefix']."menus` WHERE `id` = '".$id."'");
		$query = $this->db->query("DELETE FROM `".$config['db_prefix']."menus_content` WHERE `menu_id` = '".$id."'");
		if ($query1 > 0) $deleted = true;
		return $deleted;
	}
//wyświetlanie menu
	function getMenu($slug,$html = true,$orderby = 'order',$order = 'ASC',$hierarhical = true)
	{
		global $config;
		$rows = $this->db->query("SELECT menus.id AS menu_id,menus_content.post AS post_id, posts.id,posts.title,posts.parent,posts.slug,posts.order,posts.link FROM `".$config['db_prefix']."menus` AS menus LEFT JOIN `".$config['db_prefix']."menus_content` AS menus_content ON menus_content.menu_id = menus.id LEFT JOIN `".$config['db_prefix']."posts` AS posts ON posts.id = menus_content.post WHERE menus.active = '1' AND posts.post_on = '1' AND posts.status = 'published' AND posts.lang = '".$_SESSION['lang-code']."' AND menus.slug = '".$slug."' ORDER BY `posts`.`".$orderby."` ".$order);
		if ($html == false) 
		{
			if (!$hierarhical) return $rows;
			else return $this->formatTree($rows);
		}
		else
		{
			if (count(array($rows)) > 0)
			{
				$return .= "<ul>\n";
				foreach($rows AS $row)
				{
					$return .= "<li><a href=\"".(($row['link'] != '')?$row['link']:$config['domain'].$_SESSION['lang-code']."/".$row['slug'])."\">".$row['title'].(($number_posts)?" (".$return_number[0]['count'].")":"")."</a>\n";
					if ($hierarhical) $return .= $this->getPages($row['id'],$html,$orderby,$order,$hierarhical,$exclude,$include);
					$return .= "</li>\n";
				}
				$return .= "</ul>\n";
			}
			return $return;
		}
	}
}
?>