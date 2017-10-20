<?php

// Gestion des statistiques d'écoute.
// Appelé à chaque changement de radio/playlist + au chargement de la page


// Si le cookie jjj_uuid n'existe pas, on laisse tomber les stats
if (!isset($_COOKIE['jjj_uuid']) || ($_COOKIE['jjj_uuid'] == NULL)) 
{
	die('nocookie');
}
else
{
	$jjj_uuid = $_COOKIE['jjj_uuid'];
}


require_once('config.inc.php');



// Connexion sql
$conn = new mysqli($sqlip, $sqluser, $sqlpass, 'jjj');
if ($conn->connect_error) 
{
    die("Echec de la connexion: " . $conn->connect_error);
} 


// On crée la table hostname si elle existe pas encore :
if ($conn->query("CREATE TABLE IF NOT EXISTS " . gethostname() . " 
	(
		id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		nom VARCHAR(30) NOT NULL,
		isplaylist INT(1) NOT NULL,
		start TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
		end TIMESTAMP NULL,
		uuid varchar(23) NOT NULL
	)") === FALSE) 
{
    die("Echec création de la table");
}

// Ouverture de la page
if (isset($_GET['onload'])) // Suppression de toutes les entrées sans timestamp de fin
{
	mysqli_query($conn, "DELETE FROM " . gethostname() . " WHERE end IS NULL");
}

// Nouvelle radio en lecture
if (isset($_GET['isplaylist']) && ($_GET['isplaylist'] == 0))
{
	// Mise à jour du end de la dernière entrée
	mysqli_query($conn, "UPDATE " . gethostname() . " SET end=current_timestamp WHERE end IS NULL AND uuid = '$jjj_uuid' ORDER BY id DESC LIMIT 1");
	// On récupère l'array des radios au moment de l'ajout
	require_once('radios.php');
	$radioname = $radiolist[$_GET['id']][0];
	// Insertion de la nouvelle entrée, si la radio a un nom
	if ($radiolist[$_GET['id']][0] <> '')
	{
		mysqli_query($conn, "INSERT INTO " . gethostname() . " (nom, isplaylist, start, end, uuid) VALUES ('" . $radioname . "', '0', current_timestamp, NULL, '" . $jjj_uuid . "')") or die (mysqli_error($conn));
	}
}

// Nouvelle playlist en lecture
if (isset($_GET['isplaylist']) && ($_GET['isplaylist'] == 1))
{
	// Mise à jour du end de la dernière entrée
	mysqli_query($conn, "UPDATE " . gethostname() . " SET end=current_timestamp WHERE end IS NULL AND uuid = '$jjj_uuid' ORDER BY id DESC LIMIT 1");
	// Insertion de la nouvelle entrée
	mysqli_query($conn, "INSERT INTO " . gethostname() . " (nom, isplaylist, start, end, uuid) VALUES ('" . $_GET['name'] . "', '1', current_timestamp , NULL, '" . $jjj_uuid . "')") or die (mysqli_error($conn));
}

// On part de la page index
if (isset($_GET['closestats']))
{
	// Mise à jour du end de la dernière entrée
	mysqli_query($conn, "UPDATE " . gethostname() . " SET end=current_timestamp WHERE id > 0 ORDER BY id DESC LIMIT 1") or die (mysqli_error($conn));
}

?>