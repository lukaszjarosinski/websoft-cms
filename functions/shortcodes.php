<?php
//zestaw funkcji do dodawania tzw. shortcodes (zasada działania znana z systemu Wordpress). Przykłady poniżej:
//
//[shortcode /]
//[shortcode foo="bar" baz="bing" /]
//[shortcode foo="bar"]content[/shortcode]
//<code>
//$out = do_shortcode($content);
//</code>

$shortcode_tags = array();
//dodawanie shortcode
//<code>
//[footag foo="bar"]
//function footag_func($atts) {
//return "foo = {$atts[foo]}";
//}
//add_shortcode('footag', 'footag_func');
//</code>
function add_shortcode($tag, $func) {
	global $shortcode_tags;

	if ( is_callable($func) )
		$shortcode_tags[$tag] = $func;
}
//usuwanie obsługi danego shortcode
function remove_shortcode($tag) {
	global $shortcode_tags;

	unset($shortcode_tags[$tag]);
}
//usuwanie obsługi shortcodes
function remove_all_shortcodes() {
	global $shortcode_tags;

	$shortcode_tags = array();
}
//wykonanie shortcode
function do_shortcode($content) {
	global $shortcode_tags;

	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;

	$pattern = get_shortcode_regex();
	return preg_replace_callback('/'.$pattern.'/s', 'do_shortcode_tag', $content);
}
//pobieranie wyrażenia regularnego dla shortcode
function get_shortcode_regex() {
	global $shortcode_tags;
	$tagnames = array_keys($shortcode_tags);
	$tagregexp = join( '|', array_map('preg_quote', $tagnames) );

	return '\[('.$tagregexp.')\b(.*?)(?:(\/))?\](?:(.+?)\[\/\1\])?';
}

function do_shortcode_tag($m) {
	global $shortcode_tags;

	$tag = $m[1];
	$attr = shortcode_parse_atts($m[2]);

	if ( isset($m[4]) ) {
		// enclosing tag - extra parameter
		return call_user_func($shortcode_tags[$tag], $attr, $m[4], $tag);
	} else {
		// self-closing tag
		return call_user_func($shortcode_tags[$tag], $attr, NULL, $tag);
	}
}

//pobranie wszystkich atrybutów danego shortcode
function shortcode_parse_atts($text) {
	$atts = array();
	$pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
	$text = preg_replace("/[\x{00a0}\x{200b}]+/u", " ", $text);
	if ( preg_match_all($pattern, $text, $match, PREG_SET_ORDER) ) {
		foreach ($match as $m) {
			if (!empty($m[1]))
				$atts[strtolower($m[1])] = stripcslashes($m[2]);
			elseif (!empty($m[3]))
				$atts[strtolower($m[3])] = stripcslashes($m[4]);
			elseif (!empty($m[5]))
				$atts[strtolower($m[5])] = stripcslashes($m[6]);
			elseif (isset($m[7]) and strlen($m[7]))
				$atts[] = stripcslashes($m[7]);
			elseif (isset($m[8]))
				$atts[] = stripcslashes($m[8]);
		}
	} else {
		$atts = ltrim($text);
	}
	return $atts;
}

function shortcode_atts($pairs, $atts) {
	$atts = (array)$atts;
	$out = array();
	foreach($pairs as $name => $default) {
		if ( array_key_exists($name, $atts) )
			$out[$name] = $atts[$name];
		else
			$out[$name] = $default;
	}
	return $out;
}

//usunięcie shortcodes z danej zawartości
function strip_shortcodes( $content ) {
	global $shortcode_tags;

	if (empty($shortcode_tags) || !is_array($shortcode_tags))
		return $content;

	$pattern = get_shortcode_regex();

	return preg_replace('/'.$pattern.'/s', '', $content);
}
?>