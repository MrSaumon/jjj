<?php
header('Content-type: text/html; charset=utf-8');

require_once("includes/functions.php");
require_once("includes/config.inc.php");
require_once("includes/version.php");
require_once("includes/mpd.class.php");

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}
	
	
	
// Connexion au serveur MPD
$mpd = new MPD($mpdip, $mpdport, $mpdpass);
if ($mpd <> true) 
{
	die('Connexion impossible au serveur MPD');
}


// Récupération des données actuelles
	// $mpd->current_song : array(array([type] => file [name] => blabla.mp3 [basename] => blabla.mp3 [Last-Modified] => date [Artist] =>    [Title] =>    [Album] =>    [Date] =>    [Genre] =>    [Time] => xsecondes    [Pos] => x [Id] => x))
	$data = $mpd->current_song();
	if (isset($data[0]['Artist']) && $data[0]['Artist'] <> '' && isset($data[0]['Title']) && $data[0]['Title'] <> '')
	{
		$songtitle = $data[0]['Artist'] . ' - ' . $data[0]['Title'];
	}
	else
	{
		$songtitle = $data[0]['basename'];
	}
	$currentsongpos = $data[0]['Pos'];
	$currentsongid = $data[0]['Id'];
	$currentsongbasename = $data[0]['basename'];


// Si on veut le morceau suivant :
if (isset($_GET['action']) && $_GET['action'] == "next")
{
	$mpd->next();
}

// Si on veut le morceau précédent :
if (isset($_GET['action']) && $_GET['action'] == "prev")
{
	$mpd->prev();
}

// Si on supprime le morceau :
if (isset($_GET['action']) && $_GET['action'] == "trash")
{
	if(!isset($_GET['id']) || $_GET['id'] == '')
	{
		$idtodelete = $currentsongid;
		$basenametodelete = $currentsongbasename;
	}
	else
	{
		$idtodelete = $_GET['id'];
		$basenametodelete = $_GET['basename'];
	}
	$mpd->playlist_remove($idtodelete);
	// Ajouter l'entrée dans la table "to_trash" - traitée toutes les heures par trash.sh sur le pi
		$sqlip = "bck2800.dyndns.org";
		$sqluser = "jjj";
		$sqlpass = "8P7O8LlrzXMJ29wm";
		$conn = new mysqli($sqlip, $sqluser, $sqlpass, 'jjj');
		if ($conn->connect_error) 
		{
			die("Echec de la connexion: " . $conn->connect_error);
		} 
		mysqli_query($conn, "INSERT INTO to_trash (id, basename) VALUES ('', '" . $basenametodelete . "')")
		 or die (mysqli_error($conn));
}
?>


<html>
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="JJJ : JaJa's Jukebox">
	<meta name="author" content="Simon Robadey">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<link rel="stylesheet" href="includes/default.css?v=<?php echo $offline_version; ?>">
	<title>JJJ - JaJa's Jukebox</title>
	<script type="text/javascript" src="includes/jquery-1.7.2.min.js"></script>
	<script src="includes/javascript.js?v=<?php echo $offline_version; ?>"></script>
	<script src="includes/binaryajax.js?v=<?php echo $offline_version; ?>"></script>
</head>
<body>


<img src="images/redcross.png" width="50" onclick="window.close(this.src)">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="mpd.php"><img src="images/Reload.png" width="80" /></a>
<?php include("includes/scrollbuttons.php");?>


<b><u>En cours de lecture</u></b> :<br/>

<?php echo $songtitle; ?>
<br/>
<a href="mpd.php?action=prev"><img src="images/prev.png" alt="next" width="80" height="80"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="mpd.php?action=trash&id=<?php echo $currentsongid; ?>&basename=<?php echo $currentsongbasename; ?>"><img src="images/trash.png" alt="next" width="80" height="80"/></a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="mpd.php?action=next"><img src="images/next.png" alt="next" width="80" height="80"/></a>
<br/>
&nbsp;
<br/>
<b><u>Playlist</u></b> : <?php echo '(' . count($mpd->playlist()) . ' morceaux)';?><br/>
<?php 
$tracklist = $mpd->playlist();
// on met le fichier en cours de lecture en deuxième position de l'array
$tracklist = array_rotate($tracklist, $currentsongpos-1);
foreach($tracklist as $track)
{
	if ($track['Pos'] == $currentsongpos) { echo "<b>-></b> "; }
	if (isset($track['Artist']) && $track['Artist'] <> '' && isset($track['Title']) && $track['Title'] <> '')
	{
		echo "<font size=\"-1\">" . $track['Artist'] . ' - ' . $track['Title'] . "</font>";
	}
	else
	{
		echo "<font size=\"-1\">" . $track['basename'] . "</font>";
	}
	if ($track['Pos'] == $currentsongpos) { echo " <b><-</b>"; }
	echo "<br/>";
}




// Stats
echo "<hr/><u>Uptime MDZ Radio</u> : " . secondstodate($mpd->server_stats()['playtime']);
//print_r($mpd->count('any','Let It Happen'));
?>

<br/><hr/><br/>
<img src="images/redcross.png" width="50" onclick="window.close(this.src)">

<?php

//Fermeture de la connexion au serveur mpd
	$mpd->close();
?>
</body>
</html>