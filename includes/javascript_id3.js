function getallid3()
{	

		var xmlhttp0 = new XMLHttpRequest();
		xmlhttp0.timeout = 15000;
		xmlhttp0.onreadystatechange = function() 
		{
			if (xmlhttp0.readyState == 4 && xmlhttp0.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray0 = xmlhttp0.responseText.split("||");
				var canvas0 = document.getElementById("radioimage_0");
				var context0 = canvas0.getContext("2d");
				var imageObj0 = new Image();
				imageObj0.onload = function()
				{
					context0.clearRect(0, 0, canvas0.width, canvas0.height);
					context0.drawImage(imageObj0, 0, 0, 120, 120);
					context0.font = "12pt Andale Tahoma";
					context0.fillStyle = responseArray0[3];
					context0.fillText(responseArray0[4], 0, 115);
				};
				imageObj0.src = responseArray0[1];
			}
		};
		xmlhttp0.open("GET", "includes/ajax_id3.php?allradios=true&radioid=0", true);
		xmlhttp0.send();	

		
		
		var xmlhttp1 = new XMLHttpRequest();
		xmlhttp1.timeout = 15000;
		xmlhttp1.onreadystatechange = function() 
		{
			if (xmlhttp1.readyState == 4 && xmlhttp1.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray1 = xmlhttp1.responseText.split("||");
				var canvas1 = document.getElementById("radioimage_1");
				var context1 = canvas1.getContext("2d");
				var imageObj1 = new Image();
				imageObj1.onload = function()
				{
					context1.clearRect(0, 0, canvas1.width, canvas1.height);
					context1.drawImage(imageObj1, 0, 0, 120, 120);
					context1.font = "12pt Andale Tahoma";
					context1.fillStyle = responseArray1[3];
					context1.fillText(responseArray1[4], 0, 115);
				};
				imageObj1.src = responseArray1[1];
			}
		};
		xmlhttp1.open("GET", "includes/ajax_id3.php?allradios=true&radioid=1", true);
		xmlhttp1.send();	
		
		
		
		var xmlhttp2 = new XMLHttpRequest();
		xmlhttp2.timeout = 15000;
		xmlhttp2.onreadystatechange = function() 
		{
			if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray2 = xmlhttp2.responseText.split("||");
				var canvas2 = document.getElementById("radioimage_2");
				var context2 = canvas2.getContext("2d");
				var imageObj2 = new Image();
				imageObj2.onload = function()
				{
					context2.clearRect(0, 0, canvas2.width, canvas2.height);
					context2.drawImage(imageObj2, 0, 0, 120, 120);
					context2.font = "12pt Andale Tahoma";
					context2.fillStyle = responseArray2[3];
					context2.fillText(responseArray2[4], 0, 115);
				};
				imageObj2.src = responseArray2[1];
			}
		};
		xmlhttp2.open("GET", "includes/ajax_id3.php?allradios=true&radioid=2", true);
		xmlhttp2.send();	


		var xmlhttp3 = new XMLHttpRequest();
		xmlhttp3.timeout = 15000;
		xmlhttp3.onreadystatechange = function() 
		{
			if (xmlhttp3.readyState == 4 && xmlhttp3.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray3 = xmlhttp3.responseText.split("||");
				var canvas3 = document.getElementById("radioimage_3");
				var context3 = canvas3.getContext("2d");
				var imageObj3 = new Image();
				imageObj3.onload = function()
				{
					context3.clearRect(0, 0, canvas3.width, canvas3.height);
					context3.drawImage(imageObj3, 0, 0, 120, 120);
					context3.font = "12pt Andale Tahoma";
					context3.fillStyle = responseArray3[3];
					context3.fillText(responseArray3[4], 0, 115);
				};
				imageObj3.src = responseArray3[1];
			}
		};
		xmlhttp3.open("GET", "includes/ajax_id3.php?allradios=true&radioid=3", true);
		xmlhttp3.send();
		
		
		var xmlhttp4 = new XMLHttpRequest();
		xmlhttp4.timeout = 15000;
		xmlhttp4.onreadystatechange = function() 
		{
			if (xmlhttp4.readyState == 4 && xmlhttp4.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray4 = xmlhttp4.responseText.split("||");
				var canvas4 = document.getElementById("radioimage_4");
				var context4 = canvas4.getContext("2d");
				var imageObj4 = new Image();
				imageObj4.onload = function()
				{
					context4.clearRect(0, 0, canvas4.width, canvas4.height);
					context4.drawImage(imageObj4, 0, 0, 120, 120);
					context4.font = "12pt Andale Tahoma";
					context4.fillStyle = responseArray4[3];
					context4.fillText(responseArray4[4], 0, 115);
				};
				imageObj4.src = responseArray4[1];
			}
		};
		xmlhttp4.open("GET", "includes/ajax_id3.php?allradios=true&radioid=4", true);
		xmlhttp4.send();

		
		var xmlhttp5 = new XMLHttpRequest();
		xmlhttp5.timeout = 15000;
		xmlhttp5.onreadystatechange = function() 
		{
			if (xmlhttp5.readyState == 4 && xmlhttp5.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray5 = xmlhttp5.responseText.split("||");
				var canvas5 = document.getElementById("radioimage_5");
				var context5 = canvas5.getContext("2d");
				var imageObj5 = new Image();
				imageObj5.onload = function()
				{
					context5.clearRect(0, 0, canvas5.width, canvas5.height);
					context5.drawImage(imageObj5, 0, 0, 120, 120);
					context5.font = "12pt Andale Tahoma";
					context5.fillStyle = responseArray5[3];
					context5.fillText(responseArray5[4], 0, 115);
				};
				imageObj5.src = responseArray5[1];
			}
		};
		xmlhttp5.open("GET", "includes/ajax_id3.php?allradios=true&radioid=5", true);
		xmlhttp5.send();

		
		var xmlhttp6 = new XMLHttpRequest();
		xmlhttp6.timeout = 15000;
		xmlhttp6.onreadystatechange = function() 
		{
			if (xmlhttp6.readyState == 4 && xmlhttp6.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray6 = xmlhttp6.responseText.split("||");
				var canvas6 = document.getElementById("radioimage_6");
				var context6 = canvas6.getContext("2d");
				var imageObj6 = new Image();
				imageObj6.onload = function()
				{
					context6.clearRect(0, 0, canvas6.width, canvas6.height);
					context6.drawImage(imageObj6, 0, 0, 120, 120);
					context6.font = "12pt Andale Tahoma";
					context6.fillStyle = responseArray6[3];
					context6.fillText(responseArray6[4], 0, 115);
				};
				imageObj6.src = responseArray6[1];
			}
		};
		xmlhttp6.open("GET", "includes/ajax_id3.php?allradios=true&radioid=6", true);
		xmlhttp6.send();

		
		var xmlhttp7 = new XMLHttpRequest();
		xmlhttp7.timeout = 15000;
		xmlhttp7.onreadystatechange = function() 
		{
			if (xmlhttp7.readyState == 4 && xmlhttp7.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray7 = xmlhttp7.responseText.split("||");
				var canvas7 = document.getElementById("radioimage_7");
				var context7 = canvas7.getContext("2d");
				var imageObj7 = new Image();
				imageObj7.onload = function()
				{
					context7.clearRect(0, 0, canvas7.width, canvas7.height);
					context7.drawImage(imageObj7, 0, 0, 120, 120);
					context7.font = "12pt Andale Tahoma";
					context7.fillStyle = responseArray7[3];
					context7.fillText(responseArray7[4], 0, 115);
				};
				imageObj7.src = responseArray7[1];
			}
		};
		xmlhttp7.open("GET", "includes/ajax_id3.php?allradios=true&radioid=7", true);
		xmlhttp7.send();
		
		
		var xmlhttp8 = new XMLHttpRequest();
		xmlhttp8.timeout = 15000;
		xmlhttp8.onreadystatechange = function() 
		{
			if (xmlhttp8.readyState == 4 && xmlhttp8.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray8 = xmlhttp8.responseText.split("||");
				var canvas8 = document.getElementById("radioimage_8");
				var context8 = canvas8.getContext("2d");
				var imageObj8 = new Image();
				imageObj8.onload = function()
				{
					context8.clearRect(0, 0, canvas8.width, canvas8.height);
					context8.drawImage(imageObj8, 0, 0, 120, 120);
					context8.font = "12pt Andale Tahoma";
					context8.fillStyle = responseArray8[3];
					context8.fillText(responseArray8[4], 0, 115);
				};
				imageObj8.src = responseArray8[1];
			}
		};
		xmlhttp8.open("GET", "includes/ajax_id3.php?allradios=true&radioid=8", true);
		xmlhttp8.send();
		
		
		var xmlhttp9 = new XMLHttpRequest();
		xmlhttp9.timeout = 15000;
		xmlhttp9.onreadystatechange = function() 
		{
			if (xmlhttp9.readyState == 4 && xmlhttp9.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray9 = xmlhttp9.responseText.split("||");
				var canvas9 = document.getElementById("radioimage_9");
				var context9 = canvas9.getContext("2d");
				var imageObj9 = new Image();
				imageObj9.onload = function()
				{
					context9.clearRect(0, 0, canvas9.width, canvas9.height);
					context9.drawImage(imageObj9, 0, 0, 120, 120);
					context9.font = "12pt Andale Tahoma";
					context9.fillStyle = responseArray9[3];
					context9.fillText(responseArray9[4], 0, 115);
				};
				imageObj9.src = responseArray9[1];
			}
		};
		xmlhttp9.open("GET", "includes/ajax_id3.php?allradios=true&radioid=9", true);
		xmlhttp9.send();

		
		var xmlhttp10 = new XMLHttpRequest();
		xmlhttp10.timeout = 15000;
		xmlhttp10.onreadystatechange = function() 
		{
			if (xmlhttp10.readyState == 4 && xmlhttp10.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray10 = xmlhttp10.responseText.split("||");
				var canvas10 = document.getElementById("radioimage_10");
				var context10 = canvas10.getContext("2d");
				var imageObj10 = new Image();
				imageObj10.onload = function()
				{
					context10.clearRect(0, 0, canvas10.width, canvas10.height);
					context10.drawImage(imageObj10, 0, 0, 120, 120);
					context10.font = "12pt Andale Tahoma";
					context10.fillStyle = responseArray10[3];
					context10.fillText(responseArray10[4], 0, 115);
				};
				imageObj10.src = responseArray10[1];
			}
		};
		xmlhttp10.open("GET", "includes/ajax_id3.php?allradios=true&radioid=10", true);
		xmlhttp10.send();

		var xmlhttp11 = new XMLHttpRequest();
		xmlhttp11.timeout = 15000;
		xmlhttp11.onreadystatechange = function() 
		{
			if (xmlhttp11.readyState == 4 && xmlhttp11.status == 200) 
			{
				
				//Split de la réponse en array javascript
				// [0] = nom de la radio ; [1] = url du logo ; [2] = url du stream ; [3] = Code couleur du texte
				var responseArray11 = xmlhttp11.responseText.split("||");
				var canvas11 = document.getElementById("radioimage_11");
				var context11 = canvas11.getContext("2d");
				var imageObj11 = new Image();
				imageObj11.onload = function()
				{
					context11.clearRect(0, 0, canvas11.width, canvas11.height);
					context11.drawImage(imageObj11, 0, 0, 120, 120);
					context11.font = "12pt Andale Tahoma";
					context11.fillStyle = responseArray11[3];
					context11.fillText(responseArray11[4], 0, 115);
				};
				imageObj11.src = responseArray11[1];
			}
		};
		xmlhttp11.open("GET", "includes/ajax_id3.php?allradios=true&radioid=11", true);
		xmlhttp11.send();		

}