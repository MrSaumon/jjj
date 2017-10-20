<?php

// Retourne Auteur - Titre si c'est pour un seul morceau
// Retourne Nomdelaradio || urldulogo || urldustream || couleur du texte de l'id3 à afficher sur le logo || Auteur+chanson si c'est pour toutes les radios

require_once('functions.php');
require_once('radios.php');
if (isset($_GET['q'])) { $q = $_GET['q']; }
if (isset($_GET['radioid'])) { $radioid = $_GET['radioid']; }

// Si c'est pour le morceau en cours :
if (!isset($_GET['allradios']))
{
	if (substr($q,0,7) == "http://")
	{	
		if((getMp3StreamTitle($q, 19200)))
		{
				print(utf8_encode(ucfirst(clean_string(getMp3StreamTitle($q, 19200)))));
		}
	}
	elseif (substr($q,0,3) == "mp3")
	{
		
		$file = "../" . $q;

		if (getMp3FileTitle($file))
		{
			$result = getMp3FileTitle($file);
			if ((isset($result['Author'])) && (isset($result['Title'])))
			{
				echo clean_string(ucfirst($result['Author']) . " - " . $result['Title']);
			}
		}
	}
}
// Si c'est pour toutes les radios:
else
{
	$q = $radiolist[$radioid][2]; // URL du stream -> $q
	if (substr($q,0,7) == "http://")
	{	
		if((getMp3StreamTitle($q, 19200, 0, true, true)))
		{
			// Return [0] || [1] || [2] || [3] || CHANSON
			echo $radiolist[$radioid][0];
			echo " || ";
			echo $radiolist[$radioid][1];
			echo " || ";
			echo $radiolist[$radioid][2];
			echo " || ";
			echo $radiolist[$radioid][3];
			echo " || ";
			print(ucfirst(strtolower(trim(utf8_encode(clean_string(getMp3StreamTitle($q, 19200, 0, true, true)))))));
		}
	}
	elseif (substr($q,0,3) == "mp3")
	{
		
		$file = "../" . $q;

		if (getMp3FileTitle($file))
		{
			$result = getMp3FileTitle($file);
			if (isset($result['Author']))
			{
				echo $radiolist[$radioid][0];
				echo " || ";
				echo $radiolist[$radioid][1];
				echo " || ";
				echo $radiolist[$radioid][2];
				echo " || ";
				echo $radiolist[$radioid][3];
				echo " || ";
				echo ucfirst(strtolower(trim(clean_string($result['Author']))));
			}
			else
			{
				echo $radiolist[$radioid][0];
				echo " || ";
				echo $radiolist[$radioid][1];
				echo " || ";
				echo $radiolist[$radioid][2];
				echo " || ";
				echo $radiolist[$radioid][3];
				echo " || ";
				echo " ";
			}
		}
	}
}

	
?>