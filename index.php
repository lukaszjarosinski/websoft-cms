<?
/*
Copyright 2012 by WAWRUS Agencja Interaktywna
www.wawrus.pl
tel. 91 562 42 66
*/
$where = "frontend"; //okreœlenie backend lub frontend serwisu
include_once('includes/init.php');
$smarty->registerObject('posts',$posts);
$smarty->registerObject('boxes',$boxes,null,false);
$smarty->registerObject('links',$link,null,false);
$smarty->registerObject('gallery',$gallery,null,false);
$smarty->assign(
		array(
		'gallery'=>$gallery
		)
	);
$smarty->assign('theme_path',$config['domain'].'templates/'.$config[$where.'_theme']."/");
$smarty->assign('config',$config);
//includowanie pliku function.php z szablonu, je¿eli istnieje
if (file_exists($config['templates_dir']."/".$config[$where.'_theme']."/functions.php")) include_once($config['templates_dir']."/".$config[$where.'_theme']."/functions.php");
if (count($url_array) == count(explode("/",$config['catalog'])) OR !in_array($url_array[$url_array_no],$languages_array))
{
//Strona g³ówna
	if (isset($post['meta_title']) AND $post['meta_title'] != '') $meta_title = $post['meta_title'];
	else $meta_title = $config['meta_title'];
	if (isset($post['meta_description']) AND $post['meta_description'] != '') $meta_description = $post['meta_description'];
	else $meta_description = $config['meta_description'];
	if (isset($post['meta_keywords']) AND $post['meta_keywords'] != '') $meta_keywords = $post['meta_keywords'];
	else $meta_keywords = $config['meta_keywords'];
	$smarty->assign('meta_title',$meta_title);
	$smarty->assign('meta_description',$meta_description);
	$smarty->assign('meta_keywords',$meta_keywords);
	$smarty->display('index.tpl');
}
else
{
	$post = $posts->postExists($url_array);
	if(!$post) 
	{
	
		$smarty->display('404.tpl');
	}
	else
	{
		if(count($post) == 1)
		{
			$post = $post[0];
			if (isset($post['meta_title']) AND $post['meta_title'] != '') $meta_title = $post['meta_title'];
			else $meta_title = $config['meta_title'];
			if (isset($post['meta_description']) AND $post['meta_description'] != '') $meta_description = $post['meta_description'];
			else $meta_description = $config['meta_description'];
			if (isset($post['meta_keywords']) AND $post['meta_keywords'] != '') $meta_keywords = $post['meta_keywords'];
			else $meta_keywords = $config['meta_keywords'];
			$smarty->assign('post',$post);
			$smarty->assign('meta_title',$meta_title);
			$smarty->assign('meta_description',$meta_description);
			$smarty->assign('meta_keywords',$meta_keywords);
			if ($post['type'] == 'category') 
			{
				if (isset($url_array[2]) AND is_numeric($url_array[2])) $page = $url_array[2];
				else $page = 1;
				$smarty->assign('page',$page);
				if (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/category-".$post['slug'].".tpl")) $smarty->display("category-".$post['slug'].".tpl");
				elseif (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/category-".$post['id'].".tpl")) $smarty->display("category-".$post['id'].".tpl");
				else $smarty->display('category.tpl');
			}
			elseif ($post['type'] == 'post') 
			{
		
				if (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/post-".$post['slug'].".tpl")) $smarty->display("post-".$post['slug'].".tpl");
				elseif (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/post-".$post['id'].".tpl")) $smarty->display("post-".$post['id'].".tpl");
				else $smarty->display('post.tpl');
			}
			elseif ($post['type'] == 'page') 
			{
				if (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/page-".$post['slug'].".tpl")) $smarty->display("page-".$post['slug'].".tpl");
				elseif (file_exists($config['base_dir']."templates/".$config[$where.'_theme']."/page-".$post['id'].".tpl")) $smarty->display("page-".$post['id'].".tpl");
				else $smarty->display('page.tpl');
			}
		}
		else
		{
		
			$smarty->display('index.tpl');
		}
	}
}

//roz³¹czenie z baz¹ danych
$db->disconnect();
?>