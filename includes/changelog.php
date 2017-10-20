<?php
$changelog = '';

if ($offline_version < 0.8)
{
	$changelog .= '<hr/><b>0.8</b><br/>';
	$changelog .= '~ Le lecteur deezer est désormais en ligne sur robadey.ch, réglant le problème des extraits de 30 secondes.<br/>';
	$changelog .= '+ Script pour égaliser le niveau sonore des fichiers mp3.<br/>';
}

if ($offline_version < 0.9)
{
	$changelog .= '<hr/><b>0.9</b><br/>';
	$changelog .= '+ Mise à jour par ftp<br/>';
	$changelog .= '+ Script d\'ajout de fichier par clé USB<br/>';
	$changelog .= '~ Affichage en ~temps réel sur les pages qui lancent un programme externe (normalize/usbcopy)<br/>';
}

if ($offline_version < 0.91)
{
	$changelog .= '<hr/><b>0.91</b><br/>';
	$changelog .= '+ Suppression des mp3s en cours de lecture<br/>';
}

if ($offline_version < 0.92)
{
	$changelog .= '<hr/><b>0.92</b><br/>';
	$changelog .= '+ Les morceaux supprimés des playlists sont déplacés dans le répertoire poubelle au lieu d\'être supprimés<br/>';
	$changelog .= '+ Récupération des fichiers mis à la poubelle<br/>';
}

if ($offline_version < 0.93)
{
	$changelog .= '<hr/><b>0.93</b><br/>';
	$changelog .= '+ Gestion de plusieurs clés usb<br/>';
	$changelog .= '~ Corrections de tonnes de fautes d\'orthographe<br/>';
	$changelog .= '~ Mise en page<br/>';
}

if ($offline_version < 1.00)
{
	$changelog .= '<hr/><b>1.00</b><br/>';
	$changelog .= '~ Nettoyage du code.<br/>';
	$changelog .= '~ Beta-test terminé<br/>';
}

if ($offline_version < 1.01)
{
	$changelog .= '<hr/><b>1.01</b><br/>';
	$changelog .= '~ Mise en page<br/>';
	$changelog .= '+ Suppression des fichiers .bak créés par mp3val<br/>';
}

if ($offline_version < 1.04)
{
	$changelog .= '<hr/><b>1.04</b><br/>';
	$changelog .= '~ Mise en page<br/>';
	$changelog .= '~ Les boutons de défilement vertical fonctionnent correctement<br/>';
	$changelog .= '+ Autoscroll sur la page normalize<br/>';
}

if ($offline_version < 1.06)
{
	$changelog .= '<hr/><b>1.06</b><br/>';
	$changelog .= '+ Gestion des erreurs ftp<br/>';
	$changelog .= '+ Tarball de sécurité avant upload sur ftp maître<br/>';
}

if ($offline_version < 1.07)
{
	$changelog .= '<hr/><b>1.07</b><br/>';
	$changelog .= '~ Update liste radios<br/>';
	$changelog .= '~ Bug de création du tarball corrigé<br/>';
}

if ($offline_version < 1.08)
{
	$changelog .= '<hr/><b>1.08</b><br/>';
	$changelog .= '+ Enregistrement de statistiques<br/>';
}

if ($offline_version < 1.09)
{
	$changelog .= '<hr/><b>1.09</b><br/>';
	$changelog .= '+ Affichage des statistiques (beta-test)<br/>';
}

if ($offline_version < 1.10)
{
	$changelog .= '<hr/><b>1.10</b><br/>';
	$changelog .= '+ Choix de l\'hôte à analyser<br/>';	
	$changelog .= '~ Correction de bugs dans les statistiques<br/>';
}

if ($offline_version < 1.11)
{
	$changelog .= '<hr/><b>1.11</b><br/>';
	$changelog .= '~ Suppression de l\'attribut read-only des fichiers sur la page de normalisation<br/>';
	$changelog .= '- Suppression de la page deezer<br/>';	
}

if ($offline_version < 1.12)
{
	$changelog .= '<hr/><b>1.12</b><br/>';
	$changelog .= '~ Correction de bugs dans les statistiques<br/>';
	$changelog .= '~ Affichage des statistiques en heures:minutes<br/>';
}

if ($offline_version < 1.13)
{
	$changelog .= '<hr/><b>1.13</b><br/>';
	$changelog .= '~ Update radios<br/>';
}

if ($offline_version < 1.14)
{
	$changelog .= '<hr/><b>1.14</b><br/>';
	$changelog .= '~ Changement de répertoire sur le ftp maître<br/>';
}

if ($offline_version < 1.15)
{
	$changelog .= '<hr/><b>1.15</b><br/>';
	$changelog .= '+ Nettoyage des stats au chargement de la page (DELETE > 20h)<br/>';
}

if ($offline_version < 1.16)
{
	$changelog .= '<hr/><b>1.16</b><br/>';
	$changelog .= '+ Cookie uuid pour stats<br/>';
}

if ($offline_version < 1.17)
{
	$changelog .= '<hr/><b>1.17</b><br/>';
	$changelog .= '+ Affichage du titre en cours sur toutes les radios<br/>';
	$changelog .= '~ Timeout sur les requêtes xmlhttp<br/>';
}

if ($offline_version < 1.18)
{
	$changelog .= '<hr/><b>1.18</b><br/>';
	$changelog .= '~ Update radios<br/>';
}

if ($offline_version < 1.19)
{
	$changelog .= '<hr/><b>1.19</b><br/>';
	$changelog .= '~ Update radios<br/>';
}

if ($offline_version < 1.21)
{
	$changelog .= '<hr/><b>1.21</b><br/>';
	$changelog .= '~ Nettoyage du code/commentaires<br/>';
}

if ($offline_version < 1.22)
{
	$changelog .= '<hr/><b>1.22</b><br/>';
	$changelog .= '~ Utilisation de google charts pour les statistiques (-JScanvas)<br/>';
}

if ($offline_version < 1.23)
{
	$changelog .= '<hr/><b>1.23</b><br/>';
	$changelog .= '- Suppression du contrôle de connexion internet synchrone<br/>';
}

if ($offline_version < 1.24)
{
	$changelog .= '<hr/><b>1.24</b><br/>';
	$changelog .= '+ Retour du contrôle de connexion internet, asynchrone<br/>';
}

if ($offline_version < 1.26)
{
	$changelog .= '<hr/><b>1.26</b><br/>';
	$changelog .= '~ Correction de bug dans les statistiques<br/>';
}

if ($offline_version < 1.27)
{
	$changelog .= '<hr/><b>1.27</b><br/>';
	$changelog .= '~ Correction de bugs de récupération du titre en cours<br/>';
}

if ($offline_version < 1.28)
{
	$changelog .= '<hr/><b>1.28</b><br/>';
	$changelog .= '+ Radio MDZ@Jaja\'s<br/>';
}

if ($offline_version < 1.29)
{
	$changelog .= '<hr/><b>1.29</b><br/>';
	$changelog .= '~ Ajustements des statistiques (affichage dès 3% d\'audimat)<br/>';
}

if ($offline_version < 1.30)
{
	$changelog .= '<hr/><b>1.30</b><br/>';
	$changelog .= '+ Boutons next et poubelle sur radio MDZ at Jaja\'s<br/>';
}
if ($offline_version < 1.31)
{
	$changelog .= '<hr/><b>1.31</b><br/>';
	$changelog .= '~ Update radios<br/>';
}
if ($offline_version < 1.32)
{
	$changelog .= '<hr/><b>1.32</b><br/>';
	$changelog .= '+ Top 6 radios dans les stats<br/>';
	$changelog .= '+ Affichage des stats uniquement sur les 30 derniers jours<br/>';
	$changelog .= '~ Réorganisation des radios selon écoute<br/>';
}
if ($offline_version < 1.33)
{
	$changelog .= '<hr/><b>1.33</b><br/>';
	$changelog .= '~ Update radios<br/>';
	$changelog .= '~ Amélioration du shuffle des playlists';
}
if ($offline_version < 1.34)
{
	$changelog .= '<hr/><b>1.34</b><br/>';
	$changelog .= '~ Contrôle de la connexion internet même si on lit une playlist<br/>';
}
if ($offline_version < 1.35)
{
	$changelog .= '<hr/><b>1.35</b><br/>';
	$changelog .= '~ Correction de bugs d\'affichage du bouton skip/trash<br/>';
}
// Pas de 1.36 ? Qu'est-ce que j'ai foutu...
if ($offline_version < 1.37)
{
	$changelog .= '<hr/><b>1.37</b><br/>';
	$changelog .= '~ Démarrage du XHR des stats avant la redirection sur la nouvelle playlist/radio<br/>';
}
if ($offline_version < 1.38)
{
	$changelog .= '<hr/><b>1.38</b><br/>';
	$changelog .= '+ Ajout du buffering radio par jingle.<br/>';
}
$changelog .= '<hr/>';
if ($offline_version < 1.39)
{
	$changelog .= '<hr/><b>1.39</b><br/>';
	$changelog .= '~ Modifications du script de normalization (réparation, valeurs de retour, etc.)<br/>';
}
if ($offline_version < 1.40)
{
	$changelog .= '<hr/><b>1.40</b><br/>';
	$changelog .= '+ Mp3splt pour les playlists.<br/>';
}
if ($offline_version < 1.41)
{
	$changelog .= '<hr/><b>1.41</b><br/>';
	$changelog .= '~ Buffering radio avec fadein/fadeout<br/>';
}
if ($offline_version < 1.42)
{
	$changelog .= '<hr/><b>1.42</b><br/>';
	$changelog .= '+ Scroll auto sur la page de mise à jour<br/>';
}
$changelog .= '<hr/>';

/*
TODO :
Scraper accuradio, spotify, soundcloud...
Affichage du buffer actuel sur les radios
Affichage de la qualité de réception par un graphique (bon courage)
*/

?>