<?php
header('Content-type: text/plain; charset=utf-8');
#ΕΜΦΑΝΙΣΗ ΣΤΑΘΜΩΝ

		$api_response = file_get_contents("http://localhost/myapi1.php?request2=1&ripos3=".$_POST["ripos3"]."&stathmos3=".$_POST["stathmos3"]."&imerominia3=".$_POST["imerominia3"]."&api=687e161606decab91fac285c54ec8442");
		
		print $api_response;	
	?>