<?
/*
Copyright 2012 by Łukasz Jarosiński
www.lukaszjarosinski.com
tel. 508 052 990
*/
//Tutaj będą includowane pliki modułów - z poszczególnych katalogów
//Przykład:
//include_once($config['modules_dir'].'module1.php');
//include_once($config['modules_dir'].'module2.php');

//W razie potrzeby dodania czegoś w nagłówku używamy komendy $smarty-append('HOOK_TOP','kod_do_umieszczenia');

//funkcja wstawiająca mapę google poprzez shortcode. Pełny przykład użycia [map text="text na dymku" id="id elementu, w którym będzie mapa" width="szerokość elementu w pikselach" height="wysokość elementu w pikselach" latlng="współrzędne - domyślnie ustawione na punkt w poblizu Szczecina" zoom="wartość zbliżenia od 0 do 14" address="adres do geokodowania, jeżeli pusty, brane są punkty współrzędnych"]. Pozostałe style elementu można ustawić korzystając z arkusza stylów.
function googleMap($attr)
{
	global $smarty;
	$smarty->append('HOOK_BOTTOM','
	<script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
	<script type="text/javascript">
	<!--
		var mapa; 		// obiekt globalny
		var dymek; 		// okno z informacjami
		var geokoder 	= new google.maps.Geocoder();

		function objectToString(o)
		{
			var parse = function(_o)
			{
				var a = [], t;
        for(var p in _o)
				{
					if(_o.hasOwnProperty(p))
					{
						t = _o[p];
            if(t && typeof t == "object")
						{
							a[a.length]= p + ":{ " + arguments.callee(t).join(", ") + "}";
            }
            else
						{
							if(typeof t == "string")
							{
								a[a.length] = [ "\"" + t.toString() + "\"" ];
							}
							else
							{
								a[a.length] = [ "" + t.toString()];
							}
						}
					}
        }
				return a;
			}
			return "{" + parse(o).join(", ") + "}";
		}	
		function dodajMarker(lat,lng,txt)
    {
      // tworzymy marker z współrzędnymi i opcjami z argumentów funkcji dodajMarker
			var opcjeMarkera =  
			{ 
				position: new google.maps.LatLng(lat,lng), 
				map: mapa
			}
			opcjeMarkera.position = new google.maps.LatLng(lat,lng);

			opcjeMarkera.map = mapa; // obiekt mapa jest obiektem globalnym!
			var marker = new google.maps.Marker(opcjeMarkera);
			marker.txt=txt;
     
			google.maps.event.addListener(marker,"click",function()
			{
				dymek.setContent(marker.txt);
				dymek.open(mapa,marker);
			});
			return marker;
		}
						
		function mapaStart()  
		{  
			var wspolrzedne = new google.maps.LatLng("'.((isset($attr['latlng']) AND $attr['latlng'] != '')?$attr['latlng']:'53.41935400090768,14.58160400390625').'");
			var opcjeMapy = {
				zoom: '.((isset($attr['zoom']) AND $attr['zoom'] != '')?$attr['zoom']:'11').',
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			mapa = new google.maps.Map(document.getElementById("'.$attr['id'].'"), opcjeMapy);
			/*google.maps.event.trigger(marker,"click");*/
			dymek = new google.maps.InfoWindow();

			geokoder.geocode({address: "'.((isset($attr['address']) AND $attr['address'] != '')?$attr['address']:'').'"}, function(wyniki, status)
			{
				if(status == google.maps.GeocoderStatus.OK)
				{
					mapa.setCenter(wyniki[0].geometry.location);
					var wspolrzedne = objectToString(wyniki[0].geometry.location);
					wspolrzedne = wspolrzedne.substr(1,wspolrzedne.length-1);
					wspolrzedne = wspolrzedne.substr(0,wspolrzedne.length-1);
					var array = wspolrzedne.split(",");
					marker = dodajMarker(array[0],array[1],"'.((isset($attr['text']) AND $attr['text'] != '')?$attr['text']:$attr['address']).'")
				}
				else
				{
					marker = dodajMarker("'.((isset($attr['latlng']) AND $attr['latlng'] != '')?$attr['latlng']:'53.41935400090768,14.58160400390625').'","'.((isset($attr['text'])?$attr['text']:'')).'");
				}
			});
				
		}  
		$(document).ready(function() {mapaStart();});
		-->
		</script>
		');
	return '<div id="'.$attr['id'].'" style="width:'.((isset($attr['width']) AND $attr['width'] != '')?$attr['width']:'400').'px;height:'.((isset($attr['height']) AND $attr['height'] != '')?$attr['height']:'400').'px;"></div>';
}
add_shortcode('map','googleMap');

//funkcja wstawiająca formularz kontaktowy na stronę. Pełny przykład użycia [contactform id="id formularza" com_id="id pola z komunikatem po wysłaniu" email="e-mail docelowy dla formularza" subject="temat wysyłanego maila"]
function contactForm($attr)
{
	global $smarty, $config, $lang;
	$contact_form = '<script src="'.$config['domain'].'js/contactform.js" type="text/javascript"></script>
	<div id="'.((isset($attr['com_id']) AND $attr['com_id'] != '')?$attr['com_id']:'komunikat').'"></div>
		<form id="'.$attr['id'].'" method="post" action="">
		<p><label for="name">'.$lang['contact_name'].'</label> <input type="text" name="Imie_i_nazwisko" /></p>
		<p><label for="email">'.$lang['contact_email'].'</label> <input type="text" name="E-mail" /></p>
		<p><label for="odpowiedz">'.$lang['contact_answer_over'].'</label> <input type="radio" name="Prosze_o_odpowiedz_przez" value="telefon" /> '.$lang['contact_answer_phone'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="Prosze_o_odpowiedz_przez" value="email" checked="checked" /> '.$lang['contact_answer_email'].'</p>
		<p><label for="message">'.$lang['contact_message'].'</label> <textarea name="Wiadomosc"></textarea><input type="hidden" name="contact_form" value="1" /><input type="hidden" name="target" value="'.$attr['email'].'" /><input type="hidden" name="subject" value="'.((isset($attr['subject']) AND $attr['subject'] != '')?$attr['subject']:'').'" /></p>
		</form>
		<p style="text-align:center"><button onclick="sendForm(\''.$attr['id'].'\',\''.((isset($attr['com_id']) AND $attr['com_id'] != '')?$attr['com_id']:'komunikat').'\',\''.$config['domain'].'images/ajax-loader.gif\',\''.$config['domain'].'\')">'.$lang['contact_send'].'</button></p>
		<p>'.$lang['contact_required_fields'].'</p>
		<div style="clear:both"></div>';
		return $contact_form;
}
add_shortcode('contactform','contactForm');

//usunięcie elementu tablicy - podczas dodawania pól dodatkowych postu
function arrayElementDelete($ary,$key_to_be_deleted)
{
	foreach($key_to_be_deleted AS $key) unset($ary[$key]);
	return $ary;
}

//funkcja obsługująca formularz kontaktowy
function contactFormSend()
{
	global $config, $lang;
	require_once($config['classes_dir']."class.formvalidator.php");
	$validator = new FormValidator();
	$validator->addValidation("E-mail","req",$lang['field_is_required']);
	$validator->addValidation("E-mail","email",$lang['email']);
	if ($validator->ValidateForm()) 
	{			
		$post = arrayElementDelete($_POST,array('contact_form','target','subject'));
		$message = '';
		foreach($post as $key=>$value) $message .= "<p>".$key.": ".filterData($value)."</p>";
	
		require_once($config['classes_dir']."phpmailer/class.phpmailer.php");

		$mail = new PHPMailer();

		$mail->IsSMTP();                                      // set mailer to use SMTP
		$mail->Host = $config['smtp_server'];  // specify main and backup server
		$mail->SMTPAuth = true;     // turn on SMTP authentication
		$mail->Username = $config['smtp_username'];  // SMTP username
		$mail->Password = $config['smtp_password']; // SMTP password

		$mail->From = $config['smtp_username'];
		$mail->FromName = $_SERVER['HTTP_HOST'];
		$mail->AddAddress(filterData($_POST['target']));
		$mail->AddReplyTo($config['smtp_username']);
		$mail->Port = $config['smtp_port'];
		if ($config['smtp_port'] == '465') $mail->SMTPSecure = "ssl";

		$mail->WordWrap = 70;                                 // set word wrap to 50 characters
		$mail->IsHTML(true);                                  // set email format to HTML
		$mail->CharSet = 'utf-8';
		$mail->Subject = filterData($_POST['subject']);

		require_once($config['classes_dir'].'class.html2text.php');
		$h2t = new html2text($message);
		$message_alt = $h2t->get_text();

		$mail->Body    = $message;
		$mail->AltBody = $message_alt;

		if($mail->Send()) echo "<p>".$lang['contact_sended']."</p>";
		else echo "<p>".$lang['contact_send_problem']."</p>";
		$mail->ClearAllRecipients();
		$mail->ClearReplyTos();
		$mail->ClearAttachments();
		$mail->ClearCustomHeaders();
	}
	else 
	{
		$message = "<p>".$lang['following_errors']."</p><ul>";
		$error_hash = $validator->GetErrors();
		foreach($error_hash as $inpname => $inp_err) $message .= "<li>".$inpname.": ".$inp_err."</li>\n";
		$message .= "</ul>";
		echo $message;
	}
	exit;
}
if (isset($_POST['contact_form']) AND $_POST['contact_form'] == 1) contactFormSend();
//funkcja wstawiająca galerię na stronę. Pełny przykład użycia [displaypictures slug="slug galerii"]
require($config['classes_dir'].'class.gallery.php');
$gallery = new Gallery($db,$auth);
function displayPictures($attr)
{
	global $gallery, $config, $smarty;
	$smarty->append('HOOK_BOTTOM','
	<script src="'.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'lightbox/jquery.lightbox-0.5.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="'.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'lightbox/jquery.lightbox-0.5.css" />
	<script type="text/javascript">
$(function() {
	$(\'a.lightbox\').lightBox({
	overlayBgColor: \'#000000\',
	overlayOpacity: 0.95,
	imageLoading: \''.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'/lightbox/lightbox-ico-loading.gif\',
	imageBtnClose: \''.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'/lightbox/close.png\',
	imageBtnPrev: \''.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'/lightbox/lightbox-btn-prev.gif\',
	imageBtnNext: \''.str_replace($config['base_dir'],$config['domain'],$config['js_dir']).'/lightbox/lightbox-btn-next.gif\',
	containerResizeSpeed: 350,
	txtImage: \'Zdjęcie\',
	txtOf: \'z\'
	}); // Select all links with lightbox class
});
</script>
');
	$pictures_list1 = $gallery->displayPicturesFromCategory($attr['slug']);
	if (count(array($pictures_list1)) > 0 AND is_array($pictures_list1)) 
	{
		$return = "<ul id=\"gallery\">";
		foreach($pictures_list1 AS $pictures_list)
		{
			if (file_exists($config['gallery_dir'].$config['min_prefix'].$pictures_list['image']) AND file_exists($config['gallery_dir'].$pictures_list['image'])) $return .= "<li><a href=\"".str_replace($config['base_dir'],$config['domain'],$config['gallery_dir']).$pictures_list['image']."\" class=\"lightbox\" title=\"".strip_tags($pictures_list['text'])."\"><img src=\"".str_replace($config['base_dir'],$config['domain'],$config['gallery_dir']).$config['min_prefix'].$pictures_list['image']."\" alt=\"".strip_tags($pictures_list['text'])."\" /></a></li>";
			elseif (!file_exists($config['gallery_dir'].$config['min_prefix'].$pictures_list['image']) AND file_exists($config['gallery_dir'].$pictures_list['image'])) $return .= "<li><a href=\"".str_replace($config['base_dir'],$config['domain'],$config['gallery_dir']).$pictures_list['image']."\" class=\"lightbox\" title=\"".strip_tags($pictures_list['text'])."\"><img src=\"".str_replace($config['base_dir'],$config['domain'],$config['gallery_dir']).$pictures_list['image']."\" alt=\"".strip_tags($pictures_list['text'])."\" /></a></li>";
		}
		$return .= "</ul>";
		return $return;
	}
	else return;
}
add_shortcode('displaypictures','displayPictures');
?>