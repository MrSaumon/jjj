<?php 

// Vide entièrement la poubelle de mp3

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}

$trash_files = scandir('../mp3/poubelle/');
$trash_file = array();
$i = 0;
foreach($trash_files as $trash_file)
{
	if ($trash_file == '.' || $trash_file == '..')  
	{ 
		continue; 
	}
	$i++;
	unlink("../mp3/poubelle/" . $trash_file);
}
?>