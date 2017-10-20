<?php 

// Monte le volume windows à 100%
// Nécessite nircmd.exe

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}


exec("cmd /c c:/wamp64/www/jjj/nircmd setsysvolume 65535");
	
?>