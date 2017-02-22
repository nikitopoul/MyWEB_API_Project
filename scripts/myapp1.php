<html>
	<head>
		<title>Usage of API</title>
			<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
			<link rel="stylesheet" type="text/css" href="style.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
			<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
		<style>
			html, body 
      		{
       		 height: 100%;
       		 margin: 0;
       		 padding: 0;
     		}
     		 #map 
     		{
       	 	height: 100%;
     		}
		</style>
	</head>

<body>
		
<div class="w3-third">

<!--ΕΔΩ ΓΙΝΕΤΑΙ ΤΟ ΠΡΩΤΟ REQUEST: ΕΜΦΑΝΙΣΗ ΟΛΩΝ ΤΩΝ ΣΤΑΘΜΩΝ ΣΤΟ ΧΑΡΤΗ-->
	<div class="w3-col w3-container w3-sand">
		<form action="post1.php" method="POST" id="post_form" class="w3-container">
		<h3>Εμφάνιση Σταθμών</h3>		
		<input type="submit" id="req1" class="w3-btn w3-white w3-border w3-round-large" name="req1" value="Εμφάνιση" />
		</form>
	</div>

<!--ΕΔΩ ΓΙΝΕΤΑΙ ΤΟ 2ο REQUEST: ΑΠΟΛΥΤΗΣ ΤΙΜΗΣ ΡΥΠΑΝΣΗΣ-->
	<div class="w3-col w3-container w3-light-grey">
	        <form action="post2.php" method="POST" id="post_form2" class="w3-container">
	            <h3>Απόλυτη τιμή ρύπανσης</h3>
	            <p>Οι τιμές θα εμφανιστούν όταν κάνετε κλικ τον σταθμό στο χάρτη. </p>
	            <div class="w3-row-padding">
	                <div class="w3-third">      
	                    <input class="w3-input" type="text" name="ripos2" placeholder="Τύπος Ρύπου" required/>
	                </div>
	                <div class="w3-third">      
	                    <input class="w3-input" type="text" name="kod_stathmou" id='kod_stathmou' placeholder="Κωδικός Σταθμού" required/>
	                </div>
	                <div class="w3-third">      
	                    <input type="date-local" class="w3-input" name="date" placeholder="Ημερομηνία" required/>
	                </div>
	            </div>
	            <div class="w3-row-padding">
		            <div class="w3-third">      
		                <input type="text" class="w3-input" name="time" placeholder="Ώρα" required/>
		            </div>
		            <div class="w3-twothird">
		                <input type="submit" class="w3-btn w3-white w3-border w3-round-large" id="req2" name="req2" value="Υπολογισμός Απόλυτης Τιμής"/>
		            </div>
		        </div>
	        </form>
	</div>

<!--ΕΔΩ ΓΙΝΕΤΑΙ ΤΟ 3ο REQUEST: ΕΜΦΑΝΙΣΗ ΜΕΣΗΣ ΤΙΜΗΣ ΡΥΠΑΝΣΗΣ ΚΛΠ-->
	<div class="w3-col w3-container w3-blue-grey">
        <form action="post3.php" method="POST" id="post_form3" class="w3-container">
                <h3>Μέση τιμή ρύπανσης</h3>
                <p> Οι τιμές θα εμφανιστούν όταν κάνετε κλικ τον σταθμό στο χάρτη.</p>
                <div class="w3-row-padding">
		            <div class="w3-third">          
	                    <input class="w3-input" type="text" name="ripos3" placeholder="Τύπος Ρύπου" required>
	                </div>
	                <div class="w3-third">      
	                    <input class="w3-input" type="text" name="stathmos3" placeholder="Σταθμός" required>
	                </div>
	                <div class="w3-third">      
	                    <input type="date_local" class="w3-input" name="imerominia3" placeholder="Ημερομηνία" required>
	                </div>
                </div>
                <input type="submit" class="w3-btn w3-white w3-border w3-round-large" id="req3" name="req3" value="Υπολογισμός Μέσης Τιμής"></input>
        </form>
    </div>
<!--ΕΔΩ ΓΙΝΕΤΑΙ ΤΟ 4ο ΚΟΥΜΠΙ: HEATMAP-->
   
	<div class="w3-col w3-container w3-sand">
		<form action="myapp1.php" method="POST" id="post_form4" class="w3-container">
			<h3>Εμφάνιση των τιμών σε heatmap</h3>	
			<input type="radio" name="select" value="select1" id="select1"> Απόλυτη τιμή 
  			<input type="radio" name="select" value="select2" id="select2"> Μέση τιμή<br>
			<input type="submit" id="req4" class="w3-btn w3-white w3-border w3-round-large" name="req4" value="Εμφάνιση" />
			

		</form>
		
	</div>
</div>

<div class="w3-twothird">
	<div id="map"></div>
 	 
</div>


<script type="text/javascript">

  
function initMap() 
    {
    	var tlan=[];
    	var tlon=[];
    	var tname=[];
    	var tid=[];
    	var theat=[]; //για μεση τιμη
    	var theat2=[]; //για απολυτη τιμη
    	var heatmapDATA=[];
    	var size;
    	var obj,obj1,obj2;
    	var heatmap;
    	

    	var marker;
  		var myLatLng = {lat:  37.98, lng: 23.72};
  		var map = new google.maps.Map(document.getElementById('map'), {
    		zoom: 6,
    		center: myLatLng,
    		mapTypeId: google.maps.MapTypeId.HYBRID
  		});

  		
  		$("#req1").click( function() {
  		//GIA NA PAROUME TO JSON ARXEIO APO TO API1 KAI NA EMFANISOUME
  		//DYNAMIKA TA MARKERS STON XARTH (MESW TOY post1.js)
			var data = $("#post_form :input").serializeArray();
			
			//ΜΕ ΑΥΤΗ ΤΗΝ ΕΝΤΟΛΗ ΠΑΙΡΝΕΙ ΔΥΝΑΜΙΚΑ ΤΟ JSON ΑΡΧΕΙΟ api_response ΣΤΟ info
			//ΚΑΙ ΤΟ ΑΝΑΛΥΟΥΜΕ ΣΕ OBJECT ΓΙΑ ΝΑ ΤΟ ΔΟΥΛΕΨΕΙ Η JAVASCRIPT
			//H ENTOLH AYTH EINAI JQUERY ENTOLH
			//"#post_form").attr("action") ΑΥΤΟ ΔΕΙΧΝΕΙ ΣΕ ΠΟΙΟ URL ΘΕΛΟΥΜΕ ΝΑ ΕΧΟΥΜΕ ΔΥΝΑΜΙΚΗ ΑΠΟΣΤΟΛΗ
			//data ΕΙΝΑΙ ΤΑ ΔΕΔΟΜΕΝΑ ΠΟΥ ΣΤΕΛΝΟΥΜΕ ΑΠΟ ΤΗΝ ΦΟΡΜΑ.(ΕΔΩ ΔΕ ΧΡΕΙΑΖΕΤΑΙ, ΑΛΛΑ ΕΜΕΙΣ ΣΤΕΛΝΟΥΜΕ)
			//ΤΟ FUNCTION ΘΑ ΤΡΕΞΕΙ ΜΟΝΟ ΑΝ ΕΙΝΑΙ ΕΠΙΤΥΧΕΣ ΤΟ REQUEST
			//TO INFO ΕΙΝΑΙ ΤΟ api_response
			$.post($("#post_form").attr("action"), data, function(info){ 
				if (info != 0) {
					obj = JSON.parse(info);
					size =Object.keys(obj).length;
					var infowindow =  new google.maps.InfoWindow({content: ""});
					for (var i = 0; i < size; i++) {//ena marker gia kathe stathmo
						tlan.push(obj[i].lan);//arrays gia na exoume plhrofories gia na xrhs/oume meta
						tlon.push(obj[i].lon);
						tname.push(obj[i].name);
						tid.push(obj[i].id);
						theat.push(0); //gia apoluti timi
						theat2.push(0); //gia mesi timi
	
						var lan= Number(obj[i].lan);//dioti ta krataei
						var lon= Number(obj[i].lon);//ws strings, enw emeis ta theloume se number morfh
						var location = {lat:  lan, lng: lon};
						var titlos = obj[i].name;
						var id = obj[i].id;
						var mywindow = new google.maps.InfoWindow({content: titlos});
						marker = new google.maps.Marker({
						  position: location,
						  map: map,
						  title: titlos,
						  id: id
						});
						var html = "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'><tr class='w3-grey'><th>Σταθμός</th><th>Γ.Μήκος</th><th>Γ.Πλάτος</th></tr><tr><td>"+titlos+"</td><td>"+lan+"</td><td>"+lon+ "</td></tr></table>";//για να δωσει αμεσα τις πληροφοριες στα markers

						bindInfoWindow(marker, map, infowindow, html);
					}//telos for
				}//telos if
				else{alert("Το API-key που χρησιμοποιείται δεν υπάρχει στη βάση.");}
			});	
		});

		$("#post_form").submit( function() {
			return false;
		});


//--------------------ΑΠΟΛΥΤΗ ΤΙΜΗ = 2ο REQUEST----------------------------------//
  		$("#req2").click( function() {

			var data = $("#post_form2 :input").serializeArray();

			$.post($("#post_form2").attr("action"), data, function(info){
				if (info != 0) {
					obj1 = JSON.parse(info);
					//document.getElementById("demo").innerHTML =obj1[0].lan+'kai'+obj1[0].lon+'kai'+obj1[0].tim;
					var infowindow =  new google.maps.InfoWindow({content: ""});
					for (var i = 0; i<size; i++) {
						if ( obj1[0].lan==tlan[i] ) {
							theat[i] = obj1[0].tim;
							var lan= Number(obj1[0].lan);//dioti ta krataei
							var lon= Number(obj1[0].lon);//ws strings, enw emeis ta theloume se number morfh
							var location = {lat:  lan, lng: lon};
							var titlos = tname[i];
							var mywindow = new google.maps.InfoWindow({content: titlos});
							//document.getElementById("demo").innerHTML =obj1[0].lan+'kai'+obj1[0].lon+'kai'+obj1[0].tim;

							var marker = new google.maps.Marker({
					  			position: location,
					  			map: map,
					  			title: titlos
							});
							var html = "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'><tr class='w3-grey'><th>Σταθμός</th><th>Γ.Μήκος</th><th>Γ.Πλάτος</th><th>Τιμή Ρύπανσης</th></tr><tr><td>"+titlos+"</td><td>"+tlan[i]+"</td><td>"+tlon[i]+ "</td><td>"+obj1[0].tim+ "</td></tr></table>";
							bindInfoWindow(marker, map, infowindow, html);
							break;
						}//telos if
					}//telos for
				}//telos if
				else{alert("Το API-key που χρησιμοποιείται δεν υπάρχει στη βάση.");}
			});	
		});


		$("#post_form2").submit( function() {
			return false;
		});
//--------------------------------------------------------------------------------//

//--------------------ΜΕΣΗ ΤΙΜΗ = 3ο REQUEST----------------------------------//
  		$("#req3").click( function() {
			var data = $("#post_form3 :input").serializeArray();

			$.post($("#post_form3").attr("action"), data, function(info){
				if (info != 0) {
					obj2 = JSON.parse(info);
					//document.getElementById("demo").innerHTML =obj2[0].lan+'kai'+obj2[0].lon+'kai'+obj2[0].mesh+'kai'+obj2[0].typ;
					var infowindow =  new google.maps.InfoWindow({content: ""});
					for (var i = 0; i<size; i++) {
						if ( obj2[0].lan==tlan[i] ) {
							theat2[i] = obj2[0].mesh;
							
							var lan= Number(obj2[0].lan);//dioti ta krataei
							var lon= Number(obj2[0].lon);//ws strings, enw emeis ta theloume se number morfh
							var location = {lat:  lan, lng: lon};
							var titlos = tname[i];
							var mywindow = new google.maps.InfoWindow({content: titlos});
							//document.getElementById("demo").innerHTML =obj2[0].lan+'kai'+obj2[0].lon+'kai'+obj2[0].mesh+'kai'+obj2[0].typ;

							var marker = new google.maps.Marker({
					  			position: location,
					  			map: map,
					  			title: titlos
							});
							var html = "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'><tr class='w3-grey'><th>Σταθμός</th><th>Γ.Μήκος</th><th>Γ.Πλάτος</th><th>Μέση Τιμή Ρύπανσης</th><th>Τυπική Απόκλιση</th></tr><tr><td>"+titlos+"</td><td>"+tlan[i]+"</td><td>"+tlon[i]+ "</td><td>"+obj2[0].mesh+ "</td><td>"+obj2[0].typ+ "</td></tr></table>";
							bindInfoWindow(marker, map, infowindow, html);
							break;
						}//telos if
					}//telos for
				}//telos if
				else{alert("Το API-key που χρησιμοποιείται δεν υπάρχει στη βάση.");}
			});	

		});


		$("#post_form3").submit( function() {
			return false;
		});
//--------------------------------------------------------------------------------//

//-------------heatmap----------------------------------//
  		$("#req4").click( function() 
  		{
 
  			
  				if(document.getElementById("select1").checked==true)
  				{
					var data = $("#post_form4 :input").serializeArray(); //axreiasto
			
					$.post($("#post_form4").attr("action"), data, function(info)
					{ 
					//document.getElementById("demo").innerHTML = theat;
					//document.getElementById("demo").innerHTML = theat2;

					//an ksanapatithei to koympi
					
						
						for (var i = 0; i < size; i++) 
						{
							heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.1 });
						}

				
						
						for (var i = 0; i < size; i++) 
						{
							if(theat[i]==0)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.1 }); }
							else if (theat[i]>1 && theat[i]<25)
					 			{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.2 }); }
					 		else if (theat[i]>=25 && theat[i]<45)
					 			{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.3 }); }
							else if(theat[i]>=46 && theat[i]<70)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.4 }); }
							else if(theat[i]>=71 && theat[i]<90)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.5 }); }
							else if(theat[i]>=91 && theat[i]<110)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.6 }); }
							else if(theat[i]>=111 && theat[i]<130)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.7 }); }
							else if(theat[i]>=131 && theat[i]<160)
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.8 }); }
							else 
								{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.9 }); } 
						} // -------end for

						heatmap = new google.maps.visualization.HeatmapLayer({
							data: heatmapDATA,
							dissipating:true,
							//opacity:true,
							radius:60
							} );

						heatmap.setMap(map);
						//setTimeout(function(){},5000);
						//heatmap.setMap(null);
					
						//heatmap.set('radius',heatmap.get('radius')?null:30); //tha exw statheri aktina			
			
						//if else (document.getElementById("select1").checked==true)

				});	//telos eswteriki function

			} // kleinei i if


			else if (document.getElementById("select2").checked==true)
			{

				var data = $("#post_form4 :input").serializeArray(); //axreiasto
			
				$.post($("#post_form4").attr("action"), data, function(info)
				{ 
					//document.getElementById("demo").innerHTML = theat;
					//document.getElementById("demo").innerHTML = theat2;

					//an ksanapatithei to koympi
					for (var i = 0; i < size; i++) 
					{
						heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.1 });
					}

				


					for (var i = 0; i < size; i++) 
					{
						if(theat2[i]==0)
							{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.1 }); }
						else if (theat2[i]>1 && theat2[i]<45)
					 		{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.3 }); }
						else if(theat2[i]>46 && theat2[i]<90)
							{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.5 }); }
						else 
							{heatmapDATA.push({location: new google.maps.LatLng(tlan[i], tlon[i]),   weight:0.9 }); } 
					} // -------end for

					heatmap = new google.maps.visualization.HeatmapLayer({
						data: heatmapDATA,
						dissipating:true,
						//opacity:true,
						radius:60
						} );
						//heatmap.set('radius',heatmap.get('radius')?null:30); //tha exw statheri aktina
						heatmap.setMap(map);


					
			
						//if else (document.getElementById("select1").checked==true)

				});	//telos eswteriki function
			}
			else alert("Επιλέξτε τον τύπο προβολής!"); //αν δεν εχει επιλεξει κανενα κουμπι


		}); //telos ekswteriki function 


		$("#post_form4").submit( function() {
			return false;
		});

}//ΤΕΛΟΣ INITMAP


function bindInfoWindow(marker, map, infowindow, description) {
//se kathe click σε καποιο μαρκερ θα εμφανιζουμε πληροφοριες μεσω του infowindow	
    marker.addListener('click', function() {
        infowindow.setContent(description);
        infowindow.open(map, this);
    });
}
</script>

<!--
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_NlWzYaVIoxdj5iMihcrFHC3CjciC2LI&callback=initMap"
    	async defer>
</script>  to diko mou api key gia ton google maps -->

<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_NlWzYaVIoxdj5iMihcrFHC3CjciC2LI&libraries=visualization&callback=initMap">
    </script> <!--to diko mou api key gia ton heat map --> 
</body>
</html>