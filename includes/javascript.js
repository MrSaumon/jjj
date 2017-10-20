// On tente de désactiver les double-clics partout...
document.ondblclick = function() { return false; }


// Controle si en lecture, en buffering, etc
window.setInterval(function()
{
	checkstatus();
}, 500);



// Controle de connexion internet sur simon.robadey.ch/jjj/check.php
window.setInterval(function()
{
	if (typeof(songurl) != "undefined")
	{
		checkonline(songurl);
	}
}, 25000);



// =================================================
// Lecture du tag sur le fichier en cours de lecture
window.setInterval(function()
{
	if (typeof(songurl) != "undefined")
	{
		if (songurl.substr(0, 4) == "http")
		{
			readid3(songurl);
		}
		else if (songurl.substr(0, 3) == "mp3")
		{
			// readid dans nextsong() et initiateplaylist()
		}
	}
	
}, 15000);


/* TODO
// Contrôle de l'état du buffer toutes les 11 secondes
window.setInterval(function()
{
	var playing = document.getElementById("audio");
	var bufferseconds = playing.buffered.end(playing.buffered.length-1);
}, 11000);*/
			
	
window.setInterval(function()
{
	var playing = document.getElementById("audio");
}, 1000);		
		
			
window.setTimeout(function() // Une fois au démarrage après 5 secondes
{
	if (typeof(songurl) != "undefined")
	{
		if (songurl.substr(0, 4) == "http")
		{
			readid3(songurl);
		}
		else if (songurl.substr(0, 3) == "mp3")
		{
			// readid dans nextsong() et initiateplaylist()
		}
	}
}, 3000);
// =================================================


// =================================================
// Lecture du tag sur toutes les radios
window.setInterval(function() // Toutes les deux minutes
{
	getallid3() //dans fichier javascript_id3.js
}, 60000);
window.setTimeout(function() // Une fois au démarrage après 5 secondes
{
	getallid3() //dans fichier javascript_id3.js
}, 5000);



function setvolume(volume) 
{
	var playing = document.getElementById("audio");
	playing.volume = volume;
	document.getElementById('volumerange').value = volume;
}


// Génération de la liste de jingles/musique d'attente
function generatejingles()
{
	
}

// A la première ouverture de la page, suppression des entrées dans la base SQL sans date de fin de lecture
function onloadstats() 
{
	if(document.URL.indexOf('?') == -1) // Si on vient d'ouvrir le jukebox (pas de ? dans l'url)
	{ 
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.timeout = 10000;
		xmlhttp.open("GET", "includes/ajax_stats.php?onload", true);
		xmlhttp.send();
	}

}


// Fermeture de la dernière entrée avec la même uuid dans la base SQL
function closestats() 
{
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.timeout = 10000;
	xmlhttp.open("GET", "includes/ajax_stats.php?closestats", true);
	xmlhttp.send();
}


// Changement de radio
function changestation(id,name) 
{
	//STATS
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.timeout = 10000;
	xmlhttp.open("GET", "includes/ajax_stats.php?isplaylist=0&id=" + id, true);
	xmlhttp.send();	
	// Redirection
    var playing = document.getElementById("audio");
	window.location = "index.php?radio=" + id + "&volume=" + Math.round(playing.volume * 100) / 100 +"" 
}


// Changement de playlist
function changeplaylist(id) 
{
	
	//STATS
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.timeout = 10000;
	xmlhttp.open("GET", "includes/ajax_stats.php?isplaylist=1&name=" + id, true);
	xmlhttp.send();
	
	// On attend que ... ca se mélange hyper fort
	boxplaylists.innerHTML = '<img class="playlists" border="0" alt="dice" src="images/dice.gif"/><img class="playlists" border="0" alt="dice" src="images/dice.gif"/><img class="playlists" border="0" alt="dice" src="images/dice.gif"/><img class="playlists" border="0" alt="dice" src="images/dice.gif"/>';
	setTimeout(function() {
	boxplaylists.innerHTML = '<img class="playlists" border="0" alt="Playlist pop" src="logos/pop.png"/ onclick="changeplaylist(\'pop\')"><img class="playlists" border="0" alt="Playlist rock" src="logos/rock.png"/ onclick="changeplaylist(\'rock\')"><img class="playlists" border="0" alt="Playlist divers" src="logos/divers.png"/ onclick="changeplaylist(\'divers\')"><img class="playlists" border="0" alt="Playlist tout" src="logos/tout.png"/ onclick="changeplaylist(\'tout\')">'
    }, 2000); // Synchro avec le sleep de generateplaylist() de functions.php
	
    var playing = document.getElementById("audio");
	window.location = "index.php?playlist=" + id + "&volume=" + Math.round(playing.volume * 100) / 100 +""


}

// Démarrage de la lecture d'un fichier de la playlist
function initiateplaylist(currentplaylistkey) 
{

    var playing = document.getElementById("audio");
		if (currentplaylistkey == "1" || currentplaylistkey == null)
		{
			var currentplaylistkey = 1;		
		}
	
	readid3(songsarray[currentplaylistkey]);
	nextbuttondiv.innerHTML = '<img class="nextbuttonimage" width="100" src="images/next.png" onclick="nextsong(' + currentplaylistkey + ')" /><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/><img class="nextbuttonimage" width="100" src="images/trash.png" onclick="trash(' + currentplaylistkey + ')" />';
	checkended(currentplaylistkey);	
}

// Boucle de contrôle de l'état de lecture du fichier de la playlist
function checkended(currentplaylistkey) 
{

	var playing = document.getElementById("audio");
    if((playing.ended == false) || (playing.paused == false)) 
	{
       window.setTimeout(checkended, 1500, currentplaylistkey);
    } else 
	{
		nextsong(currentplaylistkey);
    }
	
}

// Appel du morceau suivant de la playlist
function nextsong(currentplaylistkey) 
{
	currentplaylistkey++;
	if (currentplaylistkey >= songsarray.length)
	{
		var currentplaylistkey = 0;
	}
		var playing = document.getElementById("audio");
		playing.src = songsarray[currentplaylistkey];
		playing.play();
		readid3(songsarray[currentplaylistkey]);
		nextbuttondiv.innerHTML = '<img class="nextbuttonimage" src="images/next.png" onclick="nextsong(' + currentplaylistkey + ')" /><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/><img class="nextbuttonimage" width="100" src="images/trash.png" onclick="trash(' + currentplaylistkey + ')" />';
		checkended(currentplaylistkey);
		
}


//Buffering radio
function buffer(action)
{
	// On désactive le bouton de buffer
	bufferbuttondiv.innerHTML = '<br/><img class="bufferbuttonimage" width="100" src="images/bufferinprogress.png" /> <span id=\"showbuffer\"></span>';
	if (action == "on")
	{
		var initialvolume = document.getElementById('audio').volume
		
		
		//Fadeout radio
		var sound = document.getElementById("audio");
		var fadeoutAudio = setInterval(function () {
			if (sound.volume != 0.0) {
				sound.volume -= 0.1;
				document.getElementById('volumerange').value = sound.volume;
			}
			if (sound.volume < 0.1) {
				sound.volume= 0;
				document.getElementById('volumerange').value = sound.volume;
				clearInterval(fadeoutAudio);
				sound.pause(); // pause radio
				var jinglesound = document.getElementById("jingleplayer");
				jinglesound.currentTime = 0;
				jinglesound.volume = initialvolume; //Volume comme la radio
				jinglesound.play();
				jinglesound.addEventListener("ended", function() // Quand le jingle est fini, fadein radio
				{
					console.log('jingle fini');
					jinglesound.currentTime = 0;
					jinglesound.pause //On sait jamais...
					
					// Fadein radio
					sound.volume = 0;
					document.getElementById('volumerange').value = sound.volume;
					sound.play();
					var fadeinAudio = setInterval(function () {
					if (sound.volume < initialvolume) {
						sound.volume += 0.1;
						document.getElementById('volumerange').value = sound.volume;
					}
					if (sound.volume >= initialvolume) {
						clearInterval(fadeinAudio);
					}
					}, 200);
					
					
					bufferbuttondiv.innerHTML = '<br/><img class="bufferbuttonimage" width="100" src="images/bufferon.png" onclick="buffer(\'on\')" /> <span id=\"showbuffer\"></span>';
				});	
			}
		}, 200);		
	}
}

// Update du curseur de volume
function updatevolumerange(volume) 
{
	document.getElementById('volumerange').value = volume;
}

// Lecture du tag id3
function readid3(song,id='id3') 
{
	if (song.substr(0, 3) == "mp3")
	{

		if (song.length == 0) 
		{ 
			document.getElementById(id).innerHTML = "";
			return;
		} else 
		{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.timeout = 10000;
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById(id).innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "includes/ajax_id3.php?q=" + song, true);
			xmlhttp.send();
		}
		
	}
	else
	{
		if (song.length == 0) { 
			document.getElementById("id3").innerHTML = "";
			return;
		} else 
		{
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.timeout = 10000;
			xmlhttp.onreadystatechange = function() 
			{
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) 
				{
					document.getElementById("id3").innerHTML = xmlhttp.responseText;
				}
			};
			xmlhttp.open("GET", "includes/ajax_id3.php?q=" + song, true);
			xmlhttp.send();
		}
	}
}

// Contrôle de l'état de lecture pour affichage sur la page d'index (en buffering, en lecture, etc.)
function checkstatus() 
{
	if (document.getElementById("audio"))
	{
		var playing = document.getElementById("audio");

		if (playing.readyState == 0) 
		{
			if (playing.networkState == 3)
			{
				streamstatus.innerHTML = '<img class="streamstatuslogo" src="images/redcross.png" />';
			}
			else
			{
				streamstatus.innerHTML = '<img class="streamstatuslogo" src="images/buffering.gif" />';
			}
		}
		else if (playing.readyState == 1)
		{
		streamstatus.innerHTML = '<img class="streamstatuslogo" src="images/buffering.gif" />';
		}
		else if (playing.readyState == 2)
		{
		streamstatus.innerHTML = '<img class="streamstatuslogo" src="images/buffering.gif" />';
		}
		else if (playing.readyState == 3)
		{
		streamstatus.innerHTML = '<img class="streamstatuslogo" src="images/buffering.gif" />';
		}
		else if (playing.readyState == 4)
		{
		streamstatus.innerHTML = '';
		}
		else
		{
		streamstatus.innerHTML = '???!?!?!?!?';
		}
	}
}

// Affichage des boutons d'état de connexion au net
var iwasoffline = false;
function checkonline(songurl){
	if (typeof songurl != 'undefined')
	{
		var xhr = new XMLHttpRequest(),
			method = "GET",
			url = "http://simon.robadey.ch/jjj/jjjcheck.php";

		xhr.open(method, url, true);
		xhr.onreadystatechange = function () {
				if(xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
					showonline(200);
				}
				if(xhr.readyState === XMLHttpRequest.DONE && xhr.status != 200) {
					showonline(0);
				}
				
			};
		xhr.send();			
	}
}

function showonline(status)
{
	if (status == 200)
	{
		//Connexion ok -> bouton vert
		connectionstatus.innerHTML = '<img class="connectionstatuslogo" width="20px" src="images/greenbutton.png" />';
		if (iwasoffline == true)
		{
			iwasoffline = false;
			setTimeout(function () 
			{
				var playing = document.getElementById("audio");
				playing.pause();
				setTimeout(function () 
				{		
					var playing = document.getElementById("audio");
					playing.load();
				}, 1000);
				setTimeout(function () 
				{		
					var playing = document.getElementById("audio");
					playing.play();
				}, 2000);
				iwasoffline = false;
			}, 5000);
		}	
	}
	else
	{
		// Connexion pas ok -> boutons rouges
		connectionstatus.innerHTML = '<img class="connectionstatuslogo" width="20px" src="images/redbutton.png" />';
		connectionstatuswarning.innerHTML = '<img class="connectionstatuslogo" width="20px" src="images/redbutton.png" />';
		iwasoffline = true;
		setTimeout(function () 
		{
			connectionstatuswarning.innerHTML = '';
		}, 60000);
	}
}



// Ajout du fichier en cours de lecture à la poubelle
function trash(currentplaylistkey) 
{
	$.ajax({
          url: 'includes/ajax_trash.php',
          data: {'file' : songsarray[currentplaylistkey] }
        });
	
	songsarray.splice(currentplaylistkey, 1);
	
	// 	currentplaylistkey++; pas nécessaire, on splice l'array
	
	if (currentplaylistkey >= songsarray.length)
	{
		var currentplaylistkey = 0;
	}
		var playing = document.getElementById("audio");
		playing.src = songsarray[currentplaylistkey];
		playing.play();
		readid3(songsarray[currentplaylistkey]);
		nextbuttondiv.innerHTML = '<img class="nextbuttonimage" src="images/next.png" onclick="nextsong(' + currentplaylistkey + ')" /><br/>&nbsp;<br/>&nbsp;<br/>&nbsp;<br/><img class="nextbuttonimage" width="100" src="images/trash.png" onclick="trash(' + currentplaylistkey + ')" />';
		checkended(currentplaylistkey);
		
}

// Restauration du fichier poubelle -> playlist
function restore(file) 
{
	$.ajax({
          url: 'includes/ajax_restore.php',
          data: {'file' : file }
        });
		setTimeout(function()
		{
    		location.reload();
		}, 500);
}

// Vider la poubelle
function empty_trash() 
{
	if(confirm('Vider la poubelle ?'))
	{
		$.ajax({
          url: 'includes/ajax_empty_trash.php',
        });
		setTimeout(function()
		{
    		location.reload();
		}, 2500);

	}
}

// Mettre le volume windows à 100%
function volume() 
{
	$.ajax({
          url: 'includes/ajax_volume.php',
        });
}