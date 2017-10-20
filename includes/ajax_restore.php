<?php 

// Récupère un fichier à la poubelle et le remet d'où il venait

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}


$oldname = $_GET['file'];
$filename = $_GET['file'];
$newname = explode('@~@', $filename);
$newname = "mp3/" . $newname['1'] . "/" . $newname['0'];

rename("../mp3/poubelle/" . $oldname, "../" . $newname);

	
?>