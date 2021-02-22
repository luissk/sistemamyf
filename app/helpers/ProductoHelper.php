<?php
class ProductoHelper extends Controlador{
    public function __construct()
    {
        
    }

    public function _reemplazaCaracterUrl($String = ''){
    	// $String = strtolower($String);
    	$String = mb_strtolower($String);

        $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
	    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
	    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
	    $String = str_replace(array('í','ì','î','ï'),"i",$String);
	    $String = str_replace(array('é','è','ê','ë'),"e",$String);
	    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
	    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
	    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
	    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
	    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
	    $String = str_replace(array("\\", "¨", "º", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".","°","*"),"",$String);

	    $String = str_replace("-"," ",$String);
    	//$String = str_replace("M²","M2",$String);
	    $String = str_replace("m²","m2",$String);
	    //$String = str_replace("M³","M3",$String);
	    $String = str_replace("m³","m3",$String);
    	$String = trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $String));

	    $String = str_replace("ç","c",$String);
	    $String = str_replace("Ç","C",$String);
	    $String = str_replace("ñ","n",$String);
	    $String = str_replace("Ñ","N",$String);
	    $String = str_replace("Ý","Y",$String);
	    $String = str_replace("ý","y",$String);
	     
	    $String = str_replace("&aacute;","a",$String);
	    $String = str_replace("&Aacute;","A",$String);
	    $String = str_replace("&eacute;","e",$String);
	    $String = str_replace("&Eacute;","E",$String);
	    $String = str_replace("&iacute;","i",$String);
	    $String = str_replace("&Iacute;","I",$String);
	    $String = str_replace("&oacute;","o",$String);
	    $String = str_replace("&Oacute;","O",$String);
	    $String = str_replace("&uacute;","u",$String);
	    $String = str_replace("&Uacute;","U",$String);

	    $String = str_replace(" ","-",$String);
	    
	    return $String;
    }

	function randomString($length = 5) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyz';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	function helper_remove_url_query_args($url,$keys=array()) {
	    $url_parts = parse_url($url);
	    if(empty($url_parts['query']))return $url;
	            
	    parse_str($url_parts['query'], $result_array);
	    foreach ( $keys as $key ) { unset($result_array[$key]); }
	    $url_parts['query'] = http_build_query($result_array);
	    $url = (isset($url_parts["scheme"])?$url_parts["scheme"]."://":"").
	            (isset($url_parts["user"])?$url_parts["user"].":":"").
	            (isset($url_parts["pass"])?$url_parts["pass"]."@":"").
	            (isset($url_parts["host"])?$url_parts["host"]:"").
	            (isset($url_parts["port"])?":".$url_parts["port"]:"").
	            (isset($url_parts["path"])?$url_parts["path"]:"").
	            (isset($url_parts["query"])?"?".$url_parts["query"]:"").
	            (isset($url_parts["fragment"])?"#".$url_parts["fragment"]:"");

	    

	    return $url;
	}
	
}