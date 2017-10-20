<?php
header('Content-type: text/html; charset=utf-8');
set_time_limit(6000);

require_once("includes/functions.php");
require_once("includes/version.php");
require_once("includes/MPD.php");

	$whitelist = array(
    '127.0.0.1',
    '::1'
	);
	if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist))
	{
		die("Utilisable uniquement en local.");
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
<?php include("includes/scrollbuttons.php"); ?>


<?php
print(MPD::status());
?>


<hr/>
<br/>
<img src="images/redcross.png" width="50" onclick="window.close(this.src)">
</body>
</html>