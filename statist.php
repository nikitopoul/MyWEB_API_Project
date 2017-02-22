<html>
<head>
<title>Ypeka-API Statistics</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css"> 
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<style>
body {
    background-image: url("/img/43.jpg");
}
hr{ 
	 border-style: solid; 
	 border-color: black; 
}
</style>
</head>
<body>
<div id='nav'> 
  <ul id='navigation'>
	<li><a href="http://www.ypeka.gr/"target="_blank">
    <img src="/img/ypekag.png" id="logo" /></a>
	</li>
    <li class='navigation-Blog'>Υπουργείο Περιβάλλοντος Ενέργειας και Κλιματικής Aλλαγής - Σταθμοί Ρύπανσης</li>
  </ul>
 </div>
<br>
<div class="w3-container">
	<h1 align='center'>Στατιστικά στοιχεία σχετικά με τα Request των χρηστών</h1>
</div>
<div class="w3-container">
	<br>

	<?php	
		$api  = '0';
		$flag = $_GET['flag'];

	if ($_GET['flag']=='0') {
		echo "<div id='show'>
		<!--	ΑΝΑΝΕΩΝΕΤΑΙ ΑΝΑ 5 ΔΕΥΤΕΡΟΛΕΠΤΑ				-->
		<!--	ΤΑ ΔΕΔΟΜΕΝΑ ΦΟΡΤΩΝΟΝΤΑΙ ΑΠΟ ΤΟ show.php 	-->

		</div>";}
		else {
			$api  = $_GET['api'];
			echo "<div id='show'>
			<!--	ΑΝΑΝΕΩΝΕΤΑΙ ΑΝΑ 5 ΔΕΥΤΕΡΟΛΕΠΤΑ				-->
			<!--	ΤΑ ΔΕΔΟΜΕΝΑ ΦΟΡΤΩΝΟΝΤΑΙ ΑΠΟ ΤΟ show.php 	-->

		</div>";		 
		} ?>

</div>
<br>
<br>
<div class="w3-container w3-green">
<p style="color:black;">2009-2016 © ΥΠΕΝ - Αμαλιάδος 17, 115 23 Αθήνα, τηλ. 213 1515 000</p>
</div>
<script type="text/javascript">
		$(document).ready(function() {
			setInterval(function () {
				$('#show').load('show.php?api='+'<?php echo $api?>'+'&flag='+<?php echo $flag?>)
			}, 5000);
		});
	</script>
</body>
</html>