<?php
header('Content-type: text/plain; charset=utf-8');
#ΕΜΦΑΝΙΣΗ ΑΠΟΛΥΤΗΣ ΤΙΜΗΣ

		$api_response = file_get_contents("http://localhost/myapi1.php?request1=1&ripos2=".$_POST["ripos2"]."&kod_stathmou=".$_POST["kod_stathmou"]."&date=".$_POST["date"]."&time=".$_POST["time"]."&api=687e161606decab91fac285c54ec8442");
		print $api_response;	
	?>