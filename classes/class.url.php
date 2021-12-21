<?
/*
Copyright 2012 by £ukasz Jarosiñski
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Klasa parsuj¹ca adresy URL
class URL {

	function sUrl() {
		global $config;
		$catalog = $config['catalog'];
		$return = explode('/',substr(getenv('REQUEST_URI'),1));
		$howmuch = count(array($return));
		$_pth = $catalog;
		if(!empty($_pth)) 
		{
			$pth = explode('/',$catalog);
			for($i = 0; $i < $howmuch; $i++) 
			{
				if(isset($pth[$i]) AND $return[$i] == $pth[$i]) unset($return[$i]);
			}
			array_splice($return,0,0);
		} 
		foreach($return as $k=>$v) $return[$k] = htmlspecialchars(addslashes($v));
		return $return;
	}

	function _parse($url) 
	{
		$url = substr($url,1,strlen($url));
		$url = explode('&',$url);
		foreach($url as $k => $v) 
		{
			$v = explode('=',$url[$k]);
			$GET[$v[0]] = $v[1];
		} 
		return $GET;
	}

	function _url($name) 
	{ # parse url
		$sign = '-';
		$n = str_replace(' ',$sign,$name);
		$n = strip_tags($n);
		$n = str_replace("/",$sign,$n);
		$n = str_replace('\"',$sign,$n);
		$n = str_replace('.',$sign,$n);
		$n = str_replace(',','',$n);
		$n = str_replace('?','',$n);
		$n = str_replace('!','',$n);
		$n = str_replace('(','',$n);
		$n = str_replace(')','',$n);
		$n = str_replace(']','',$n);
		$n = str_replace('[','',$n);
		$n = str_replace(':','',$n);
		$n = str_replace('&','',$n);
		$n = str_replace('%','',$n);
		$n = str_replace('#','',$n);
		$n = str_replace('"','',$n);
		$n = str_replace(' - ','',$n);
		$n = str_replace('--','-',$n);
		$n = str_replace('--','-',$n);
	$n = str_replace('ndash;-','',$n);
		$n = str_replace("'m",$sign.'am',$n);
		$n = str_replace("'ve",$sign.'have',$n);
		$n = str_replace("'s",$sign.'is',$n);
		$n = str_replace("'",'',$n);
		if(substr($n,-1) == '.') $n = substr($n,0,strlen($n)-1);
		if(substr($n,-1) == $sign) $n = substr($n,0,strlen($n)-1);
		if(substr($n,-1) == $sign) $n = substr($n,0,strlen($n)-1);
		if(substr($n,-1) == $sign) $n = substr($n,0,strlen($n)-1);
		return strtolower($n);
	}
}
?>