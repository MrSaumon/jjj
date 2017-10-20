<?php
//Cookie uuid pour stats :

if (!isset($_COOKIE['jjj_uuid']) || ($_COOKIE['jjj_uuid'] == NULL)) 
{ 
	$uuid = uniqid('', true);
	setcookie("jjj_uuid", $uuid);
}


header('Content-type: text/html; charset=utf-8');
set_time_limit(60);


$song = "none"; // Par défaut
$jingle = "none"; // Par défaut

require_once("includes/functions.php");
require_once("includes/version.php");
require_once("includes/radios.php");


if (!isset($_GET['volume']))
{
		$volume = 0.8;
}
else
{
		$volume = $_GET['volume'];
}
	
	
// MENU MAINTENANCE

$whitelist = array(
    '127.0.0.1',
    '::1'
);

if (isset($_GET['action']))
{
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
	}
}

	
if (isset($_GET['action']) && ($_GET['action'] == "shutdown"))
{
	echo'<script type="text/javascript">closestats();</script>';
	sleep(1);
	exec('%windir%\System32\shutdown.exe -s -t 10');
}

$radio = '';
// Récupération du nom, logo, et morceau en cours de la radio/playlist
if (isset($_GET['radio'])) 
{
	$radio = $_GET['radio']; 
	$song = $radiolist[$radio]['2'];
	$logo = $radiolist[$radio]['1'];
	$name = $radiolist[$radio]['0'];
}
elseif (isset($_GET['playlist'])) 
{
	if (!isset($songsarray)) { $songsarray['0'] = ''; }
	$playlist = $_GET['playlist'];
	switch ($playlist) 
	{
		case "pop":
			$songsarray = generateplaylist('pop');
			$song = $songsarray['0'];
			$logo = "logos/pop.png";
			$name = "Playlist Pop";
			break;
		case "rock":
			$songsarray = generateplaylist('rock');
			$song = $songsarray['0'];
			$logo = "logos/rock.png";
			$name = "Playlist Rock";
			break;
		case "divers":
			$songsarray = generateplaylist('divers');
			$song = $songsarray['0'];
			$logo = "logos/divers.png";
			$name = "Playlist Divers";
			break;
		case "tout":
			$songsarray = generateplaylist('tout');
			$song = $songsarray['0'];
			$logo = "logos/tout.png";
			$name = "Playlist Tout";
			break;
		default:
			$song = "none";
	}
}
else
{
	$name = "";
	$logo = "images/muted.png";
	$song = "";
}

// Génération de l'array des jingles
$jinglesarray = generatejingles();
?>



<html>

<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="description" content="JJJ : JaJa's Jukebox">
	<meta name="author" content="Simon Robadey">
	<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
	<META HTTP-EQUIV="Expires" CONTENT="-1">
	<title>JJJ - JaJa's Jukebox</title>
	<link rel="stylesheet" href="includes/default.css?v=<?php echo $offline_version; ?>">
	<script type="text/javascript" src="includes/jquery-1.7.2.min.js"></script>
	<script src="includes/javascript.js?v=<?php echo $offline_version; ?>"></script>
	<script src="includes/javascript_id3.js?v=<?php echo $offline_version; ?>"></script>	
	<script src="includes/binaryajax.js?v=<?php echo $offline_version; ?>"></script>
	<script type="text/javascript">var songurl = "<?php echo $song; ?>";</script>
	<script type="text/javascript">onloadstats();</script>
	<script>$(document).ready(function(){});</script>
	<?php
	if (isset($songsarray))
	{ ?>
		<script type="text/javascript">
		var songsarray = <?php echo json_encode($songsarray); ?>;
		</script> 
	<?php 
	} 
	?>
	
	
</head>

<body onload="setvolume(<?php echo $volume; ?>); generatejingles();<?php if(isset($songsarray)) { echo " initiateplaylist('0');"; }?>">



<!-- Div lecteur html5 invisible main -->
<div id="playerbox">
	<audio id="audio" autoplay>
		<source id="song" src="<?php echo $song ?>" preload="auto" type="audio/mp3" volume="<?php echo $volume; ?>">
	</audio>
</div>

<!-- Div lecteur html5 invisible jingles -->
<div id="playerbox">
	<audio id="jingleplayer">
		<source id="jingle" src="<?php echo $jinglesarray['0'] ?>" preload="auto" type="audio/mp3" volume="<?php echo $volume; ?>">
	</audio>
</div>

<!-- Div affichage ID3 -->
<div id="id3box">
	<span id="id3"></span>
</div>

<!-- Div affichage logo radio/playlist -->
<div id="currentlyplaying">
	<a onclick="checkstatus();"><img class="currentlyplayinglogo" src="<?php echo $logo; ?>" /></a>
	<div id="streamstatus"></div><!-- Icone sur le logo (buffering en cours, etc.) -->
	<div id="nextbuttondiv"></div><!-- Next si playlist -->
	<?php if ($radio <> '') { echo "<div id=\"bufferbuttondiv\"><br/><img class=\"bufferbuttonimage\" width=\"100\" src=\"images/bufferon.png\" onclick=\"buffer('on')\" /> <span id=\"showbuffer\"></span></div>"; } //Buffering si radio ?>
</div> <!-- EO Div affichage logo radio/playlist -->

<!-- Div boutons verts/rouges selon état connexion internet -->
<div id="connectionstatus"></div>
<div id="connectionstatuswarning"></div>

<!-- Div slider volume -->
<div id="volume">
	<div class="volumeslider"><input type="range" readonly min="0" max="1" step="0.05" value="<?php echo $volume; ?>" id="volumerange"></div>
	<a onclick="document.getElementById('audio').volume += 0.1; updatevolumerange(document.getElementById('audio').volume);"><img class="volume" src="images/volume-up.gif" /></a>
	<a onclick="document.getElementById('audio').volume -= 0.1; updatevolumerange(document.getElementById('audio').volume);"><img class="volume" src="images/volume-down.png" /></a>
</div>


<!-- Div liste icônes radios -->
<div id="boxradios">
<?php
foreach ($radiolist as $radioindex => $radioitems) 
{
	echo "<canvas class=\"radio\" width=\"120\" height=\"120\" id=\"radioimage_" . $radioindex . "\" onclick=\"changestation('" . $radioindex . "', '" . $radioitems['0'] . "')\"></canvas>";

	echo 
	'
		<script language="javascript">
	    var canvas' . $radioindex . ' = document.getElementById("radioimage_' . $radioindex . '");
		var context' . $radioindex . ' = canvas' . $radioindex . '.getContext("2d");
		var imageObj' . $radioindex . ' = new Image();
		imageObj' . $radioindex . '.onload = function(){
         context' . $radioindex . '.drawImage(imageObj' . $radioindex . ', 0, 0, 120, 120);
         context' . $radioindex . '.font = "20pt Calibri";
		 context' . $radioindex . '.fillStyle = "' . $radioitems['3'] . '";
         context' . $radioindex . '.fillText("", 10, 20);
		};
		imageObj' . $radioindex . '.src ="' . $radioitems['1'] . '"; 
		</script>
	';
}

?>
</div>​


<!-- Div liste icônes playlists -->
<div id="boxplaylists">
		<img class="playlists" border="0" alt="Playlist pop" src="logos/pop.png"/ onclick="changeplaylist('pop')">
		<img class="playlists" border="0" alt="Playlist rock" src="logos/rock.png"/ onclick="changeplaylist('rock')">
		<img class="playlists" border="0" alt="Playlist divers" src="logos/divers.png"/ onclick="changeplaylist('divers')">
		<img class="playlists" border="0" alt="Playlist tout" src="logos/tout.png"/ onclick="changeplaylist('tout')">
</div>​


<!-- Div Menu maintenance -->
<div id="menu">
	<ul>
		<li><a href="#"><img src="images/wrench.png" width="50"></a>
			<ul>
				<li><a href="index.php?action=shutdown" onclick="return confirm('Eteindre l\'ordinateur ?');">ETEINDRE</a></li>
				<li>&nbsp;</li>				
				<li><a onclick="volume()">Volume 100%</a></li>
				<li>&nbsp;</li>
				<li><a onclick="window.open('mpd.php','mpd','width=800,height=800,toolbar=no,location=no,scrollbars=no,status=no,resizable=no');">Radio MDZ</a></li>				
				<li>&nbsp;</li>
				<li><a onclick="window.open('stats.php?hostname=<?php echo gethostname(); ?>','stats','width=800,height=800,toolbar=no,location=no,scrollbars=no,status=no,resizable=no');">Statistiques</a></li>				
				<li>&nbsp;</li>
				<li><a onclick="window.open('normalize.php','normalize','width=800,height=800,toolbar=no,location=no,scrollbars=no,status=no,resizable=no');">(P)réparation playlists</a></li>
				<li>&nbsp;</li>
				<li><a onclick="window.open('update.php','update','width=800,height=800');">Mise à jour ?</a></li>
				<li>&nbsp;</li>
				<li><a onclick="window.open('usbcopy.php','usbcopy','width=800,height=800');">Ajouter musique</a></li>
				<li>&nbsp;</li>
				<li><a onclick="window.open('trash.php','trash','width=800,height=800');">Poubelle</a></li>				
			<ul>
		</li>
	</ul>
</div>

</body>
</html>