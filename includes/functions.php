<?php

// Retourne un nom simple selon l'hostname, pour les statistiques
function gethostdisplayname($hostname) 
{
	switch ($hostname) // Liste des hostnames connus
		{
			case 'PC005' : return('FiMM'); break;
			case 'portab' : return('SR2'); break;
			case 'Salon' : return('SR1'); break;
			case 'JAJA' : return('King\'s'); break;
			default : return($hostname);
		}
}


// Retourne une array de la liste de lecture d'une playlist
function generateplaylist($playlist)
{
	$folderarray = array();
	
	switch ($playlist) 
	{
		case "pop":
			$folderarray[] = "mp3/pop";
			break;
		case "rock":
			$folderarray[] = "mp3/rock";
			break;	
		case "divers":
			$folderarray[] = "mp3/divers";
			break;
		case "tout":
			$folderarray = array("mp3/pop","mp3/rock","mp3/divers");
			break;
		default:
			die("switch playlist dans functions.php sur default ?!?!?");
	}
	  
	$files = array();
	$extensions = "mp3";
	
	foreach ($folderarray as $folder) 
	{

	
		$folder = trim($folder);
		$folder = ($folder == '') ? './' : $folder;
 
 
		if (!is_dir($folder)){ echo "PAS DE REPERTOIRE<br/>"; }
 
		if ($dir = @opendir($folder))
		{
			while($file = readdir($dir))
			{
 
				if (!preg_match('/^\.+$/', $file) and 
					preg_match('/\.('.$extensions.')$/', $file))
					{
						$files[] = utf8_encode("$folder/" . $file);
					}            
			}        
			closedir($dir);    
		}

	}
	if (!isset($files['0'])) { $files = array(''); }
	shuffle($files);
	sleep(2); // On mélange hyper fort, en synchro avec l'attente de la redirection javascript dans changeplaylist() !
	return $files;
}

// Retourne une array de la liste des jingles/musiques d'attente
function generatejingles()
{

	$folder = "jingles";  
	$files = array();
	$extensions = "mp3";
	
		$folder = trim($folder);
		$folder = ($folder == '') ? './' : $folder;
 
 
		if (!is_dir($folder)){ echo "PAS DE REPERTOIRE<br/>"; }
 
		if ($dir = @opendir($folder))
		{
			while($file = readdir($dir))
			{
 
				if (!preg_match('/^\.+$/', $file) and 
					preg_match('/\.('.$extensions.')$/', $file))
					{
						$files[] = utf8_encode("$folder/" . $file);
					}            
			}        
			closedir($dir);    
		}


	if (!isset($files['0'])) { $files = array(''); }
	shuffle($files);
	return $files;
}


// Récupération du nom d'artiste / chanson en cours de stream
function getMp3StreamTitle($streamingUrl, $interval, $offset = 0, $headers = true, $artistonly = false)
{
	$needle = 'StreamTitle=';
	$ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';
	$opts = [
		'http' => [
			'method' => 'GET',
			'header' => 'Icy-MetaData: 1',
			'user_agent' => $ua
		]
	];
	if (($headers = get_headers($streamingUrl)))
	{
		foreach ($headers as $h)
			if (strpos(strtolower($h), 'icy-metaint') !== false && ($interval = explode(':', $h)[1]))
				break;
	}
	else
	{
		return false;
	}
	$context = stream_context_create($opts);
	if ($stream = @fopen($streamingUrl, 'r', false, $context))
	{
		$buffer = stream_get_contents($stream, $interval, $offset);
		fclose($stream);
		if (strpos($buffer, $needle) !== false)
		{
			$title = explode($needle, $buffer)[1];
			$title = substr($title, 1, strpos($title, ';') - 2);
			$title = utf8_decode($title);
			$title = trim(str_replace('?', '-', $title));
			if ($artistonly == true) { $title = current(array_slice(explode("-", $title), 0,1)); }
			return $title;
		}
		else
			return getMp3StreamTitle($streamingUrl, $interval, $offset + $interval, false);
	}
	else
		return false;
}


// Lecture du tag id3 d'un fichier de playlist
function getMp3FileTitle($file){
    $id3v23 = array("TIT2","TALB","TPE1","TRCK","TDRC","TLEN","USLT");
    $id3v22 = array("TT2","TAL","TP1","TRK","TYE","TLE","ULT");
    $fsize = @filesize($file);
    $fd = @fopen($file,"r");
    $tag = @fread($fd,$fsize);
    $tmp = "";
    @fclose($fd);
    if (substr($tag,0,3) == "ID3") {
        $result['FileName'] = $file;
        $result['TAG'] = substr($tag,0,3);
        $result['Version'] = hexdec(bin2hex(substr($tag,3,1))).".".hexdec(bin2hex(substr($tag,4,1)));
    }
	else
	{
		return false;
	}
    if($result['Version'] == "4.0" || $result['Version'] == "3.0"){
        for ($i=0;$i<count($id3v23);$i++){
            if (strpos($tag,$id3v23[$i].chr(0))!= FALSE){
                $pos = strpos($tag, $id3v23[$i].chr(0));
                $len = hexdec(bin2hex(substr($tag,($pos+5),3))) + 1;
                $data = substr($tag, $pos, 9+$len);
                for ($a=0;$a<strlen($data);$a++){
                    $char = substr($data,$a,1);
                    if($char >= " " && $char <= "~") $tmp.=$char;
                }
                if(substr($tmp,0,4) == "TIT2") $result['Title'] = substr($tmp,4);
                if(substr($tmp,0,4) == "TALB") $result['Album'] = substr($tmp,4);
                if(substr($tmp,0,4) == "TPE1") $result['Author'] = substr($tmp,4);
                if(substr($tmp,0,4) == "TRCK") $result['Track'] = substr($tmp,4);
                if(substr($tmp,0,4) == "TDRC") $result['Year'] = substr($tmp,4);
                if(substr($tmp,0,4) == "TLEN") $result['Length'] = substr($tmp,4);
                if(substr($tmp,0,4) == "USLT") $result['Lyric'] = substr($tmp,7);
                $tmp = "";
            }
        }
    }
    if($result['Version'] == "2.0"){
        for ($i=0;$i<count($id3v22);$i++){
            if (strpos($tag,$id3v22[$i].chr(0))!= FALSE){
                $pos = strpos($tag, $id3v22[$i].chr(0));
                $len = hexdec(bin2hex(substr($tag,($pos+3),3)));
                $data = substr($tag, $pos, 6+$len);
                for ($a=0;$a<strlen($data);$a++){
                    $char = substr($data,$a,1);
                    if($char >= " " && $char <= "~") $tmp.=$char;
                }
                if(substr($tmp,0,3) == "TT2") $result['Title'] = substr($tmp,3);
                if(substr($tmp,0,3) == "TAL") $result['Album'] = substr($tmp,3);
                if(substr($tmp,0,3) == "TP1") $result['Author'] = substr($tmp,3);
                if(substr($tmp,0,3) == "TRK") $result['Track'] = substr($tmp,3);
                if(substr($tmp,0,3) == "TYE") $result['Year'] = substr($tmp,3);
                if(substr($tmp,0,3) == "TLE") $result['Length'] = substr($tmp,3);
                if(substr($tmp,0,3) == "ULT") $result['Lyric'] = substr($tmp,6);
                $tmp = "";
            }
        }
    }
    return $result;
}

// Retourne jours/heures/minutes/secondes depuis secondes
function secondstodate($seconds)
{
    $ret = "";

    $days = intval(intval($seconds) / (3600*24));
    if($days> 0)
    {
        $ret .= "$days jours ";
    }

    $hours = (intval($seconds) / 3600) % 24;
    if($hours > 0)
    {
        $ret .= "$hours heures ";
    }

    $minutes = (intval($seconds) / 60) % 60;
    if($minutes > 0)
    {
        $ret .= "$minutes minutes ";
    }

    $seconds = intval($seconds) % 60;
    if ($seconds > 0) {
        $ret .= "$seconds secondes";
    }

    return $ret;
}


// Retourne une $array "décalée" de $shift
function array_rotate($array, $shift) {
    if(!is_array($array) || !is_numeric($shift)) {
        if(!is_array($array)) error_log(__FUNCTION__.' expects first argument to be array; '.gettype($array).' received.');
        if(!is_numeric($shift)) error_log(__FUNCTION__.' expects second argument to be numeric; '.gettype($shift)." `$shift` received.");
        return $array;
    }
    $shift %= count($array); //we won't try to shift more than one array length
    if($shift < 0) $shift += count($array);//handle negative shifts as positive
    return array_merge(array_slice($array, $shift, NULL, true), array_slice($array, 0, $shift, true));
}



// Retourne une taille de fichier human-readable
function file_size($size) 
{ 
	$filesizename = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB"); 
	return $size ? round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $filesizename[$i] : '0 Bytes'; 
} 
 
// Retourne un string sans caractères accentués
function clean_string($name)
{
	 $utf8 = array(
        '/[áàâãªä]/u'   =>   'a',
        '/[ÁÀÂÃÄ]/u'    =>   'A',
        '/[ÍÌÎÏ]/u'     =>   'I',
        '/[íìîï]/u'     =>   'i',
        '/[éèêë]/u'     =>   'e',
        '/[ÉÈÊË]/u'     =>   'E',
        '/[óòôõºö]/u'   =>   'o',
        '/[ÓÒÔÕÖ]/u'    =>   'O',
        '/[úùûü]/u'     =>   'u',
        '/[ÚÙÛÜ]/u'     =>   'U',
        '/ç/'           =>   'c',
        '/Ç/'           =>   'C',
        '/ñ/'           =>   'n',
        '/Ñ/'           =>   'N',
        '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
        '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
        '/[“”«»„]/u'    =>   ' ', // Double quote
        '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
		'/[\[\]%&\'=()*+°§~@;]/u'    	=>   ' ',
    );
    return preg_replace(array_keys($utf8), array_values($utf8), $name);
}

 
?>