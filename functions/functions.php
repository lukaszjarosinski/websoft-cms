<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Plik z przydatnymi funkcjami - copyright by WAWRUS 2009
//Funkcja wyświetlająca zawartość wybranego pliku (jako string)
function file_content($plik)
{
	$wskaznik_pliku = fopen($plik,'r');
	$zawartosc_pliku = fread($wskaznik_pliku,filesize($plik));
	return $zawartosc_pliku;
}

//Funkcja wyświetlająca błąd krytyczny
function critical_error($msg = '')
{
	$smarty->assign(
		array()
	);
	$smarty->display('critical_error.tpl');
	exit;
}

//Funkcja zamieniająca znaki specjalne oraz polskie znaki na odpowiedniki - szczególnie przydatna przy generowaniu tytułów na potrzeby modrewrite
function stripText($text)
{
	$text = html_entity_decode($text);
	$szukaj = array(
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
	$zamieniaj = array(
		'-',
		'',
		'',
		'-',
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
		'-',
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
	$text = str_replace($szukaj, $zamieniaj, $text); // Zamiana znaków z tablic
	return $text;
}
//Funkcja filtrująca zmienne przekazywane przez GET, POST, REQUEST - zabezpiecza przed atakiem SQL Injection, usuwa znaczniki HTML
function filterData($data,$filter = array('strip_tags','stripslashes'))
{
	if (count($filter) > 0)
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
//Funkcja wysyłająca e-mail przy pomocy klasy PHPMailer
function sendmail($do,$do_name,$temat,$wiadomosc)
{
	global $config;
	require_once($config['classes_dir']."phpmailer/class.phpmailer.php");

	$mail = new PHPMailer();

	$mail->IsSMTP();                                      // set mailer to use SMTP
	$mail->Host = $config['smtp_server'];  // specify main and backup server
	$mail->SMTPAuth = true;     // turn on SMTP authentication
	$mail->Username = $config['smtp_username'];  // SMTP username
	$mail->Password = $config['smtp_password']; // SMTP password

	$mail->From = $config['smtp_username'];
	$mail->FromName = $_SERVER['HTTP_HOST'];
	$mail->AddAddress($do,$do_name);
	$mail->AddReplyTo($config['smtp_username']);

	$mail->WordWrap = 70;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML
	$mail->Port = $config['smtp_port'];
	if ($config['smtp_port'] == '465') $mail->SMTPSecure = "ssl";
	$mail->CharSet = 'utf-8';
	$mail->Subject = $temat;

	require_once($config['classes_dir']."class.html2text.php");
	$h2t = new html2text($wiadomosc);
	$wiadomosc_alt = $h2t->get_text();
	
	//$mail->SMTPDebug = 2;

	$mail->Body    = $wiadomosc;
	$mail->AltBody = $wiadomosc_alt;

	if($mail->Send()) $wyslano = true;
	else $wyslano = false;
	$mail->ClearAllRecipients();
	$mail->ClearReplyTos();
	$mail->ClearAttachments();
	$mail->ClearCustomHeaders();
	return $wyslano;
}

function size($value)
{
	$size = strlen($value);
	$kilobites=$size/1024;
	return round($kilobites,2)." kB";
}

function shortText($co,$ile_slow = 10)
{
	$rozbity = explode(" ",$co);
	$tekst = '';
	for($i=0;$i<$ile_slow;$i++)
	{
		$tekst .= $rozbity[$i]." ";
	}
	return $tekst;
}
?>