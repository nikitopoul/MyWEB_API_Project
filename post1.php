<?php
header('Content-type: text/plain; charset=utf-8');
#ΕΜΦΑΝΙΣΗ ΣΤΑΘΜΩΝ

		//mesw ths diefthinsis stelnoume me get request, kai me thn file_get pairnoyme thn apanthsh
		$api_response = file_get_contents("http://localhost/myapi1.php?request0=1&api=687e161606decab91fac285c54ec8442");
		print $api_response;
		
	?>