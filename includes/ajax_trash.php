<?php 

// Met un fichier mp3 dans la poubelle en le renommant "nomdefichier@~@répertoire@~@time()"

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}

//if (!isset($_GET['file'])) { die('file unset'); }

$filepath = $_GET['file'];
$folder = explode('/', $filepath);

$filename = basename($_GET['file']) . "@~@" . $folder['1'] . "@~@" . time();

rename("../" . $filepath, "../mp3/poubelle/" . $filename);
?>