<?php
header('Content-type: text/plain; charset=utf-8');

include_once('connect_db.php');
mysqli_query($conn,"set names 'utf8'");//ELLHNIKA
$req = 0;
$ripos = 0;
$kod_stathmou=0;
$date=0;
$time=0;

//ΕΛΕΓΧΟΣ API-KEY
$api = $_GET['api'];
$sql0 = "SELECT id FROM api_keys WHERE id='$api'";
$result = $conn->query($sql0);

if ($result->num_rows == 0) {
	#ΑΝ ΔΕΝ ΥΠΑΡΧΕΙ AYTO TO API-KEY
  		echo "0";
} else {
	if (isset($_GET['request0'])) {
	//emfanisi stathmwn
		$query = "UPDATE api_keys SET req1=req1+1 WHERE id='$api'";
		if (!$query) 
			{
				die('Invalid query: ' . mysql_error());
			}
		$result = $conn->query($query);	
		$query = "SELECT * FROM stations";
		if (!$query) 
			{
				die('Invalid query: ' . mysql_error());
			}
		$result = $conn->query($query);	
		$response = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
		    $row_array['name'] = $row['name'];
		    $row_array['id'] = $row['id'];
		    $row_array['lan'] = $row['lan'];
		    $row_array['lon'] = $row['lon'];
	
		    array_push($response,$row_array);
			}
		}
		echo json_encode($response);
	}//TELOS IF	
	if (isset($_GET['request1'])) //apolyth timi
		{
		$ripos2 = $_GET['ripos2'];
		$stathmos = $_GET['kod_stathmou'];
		$imerominia = $_GET['date'];
		$time = $_GET['time'];
		$api2=$_GET['api'];
		$query = "UPDATE api_keys SET req2=req2+1 WHERE id='$api2'";
		if (!$query) 
			{
				die('Invalid query: ' . mysql_error());
			}
		$result = $conn->query($query);	
		$query2 = "SELECT t1.`"."$time"."` as tim, t2.lan as lan, t2.lon as lon  FROM uploads AS t1 
					INNER JOIN stations AS t2 ON t1.station_id = t2.id 
					WHERE t1.date='$imerominia' AND t1.ripos='$ripos2' AND t2.id='$stathmos'";
		if (!$query2) 
			{
				die('Invalid query: ' . mysqli_error());
			}
		$result2 = $conn->query($query2);	
		$response2 = array();
		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc()) {
		    $row_array2['tim'] = $row2['tim'];
			$row_array2['lan'] = $row2['lan'];
			$row_array2['lon'] = $row2['lon'];
		    array_push($response2,$row_array2);
			}
		}
		echo json_encode($response2);
		}

	if (isset($_GET['request2'])) //mesh timh 
	{
		$ripos3 = $_GET['ripos3'];
		$kod_stathmou3 = $_GET['stathmos3'];
		$date3 = $_GET['imerominia3'];
		$api3=$_GET['api'];
		
		$query = "UPDATE api_keys SET req3=req3+1 WHERE id='$api3'";
		if (!$query) 
			{
				die('Invalid query: ' . mysql_error());
			}
		$result = $conn->query($query);	
		$query3 = "SELECT t1.`1`+`2`+`3`+`4`+`5`+`6`+`7`+`8`+`9`+`10`+`11`+`12`+`13`+`14`+`15`+`16`+`17`+`18`+`19`+`20`+`21`+`22`+`23`+`24` as ripoi, t1.1, t1.2, t1.3, t1.4, t1.5, t1.6, t1.7, t1.8, t1.9, t1.10, t1.11, t1.12, t1.13, t1.14, t1.15, t1.16, t1.17, t1.18, t1.19, t1.20, t1.21, t1.22, t1.23, t1.24, t2.lan as lan, t2.lon as lon FROM uploads AS t1 INNER JOIN stations AS t2 ON t1.station_id = t2.id WHERE t1.ripos='$ripos3' AND t1.date='$date3' AND t1.station_id='$kod_stathmou3'";
		if (!$query3) 
			{
				die('Invalid query: ' . mysql_error());
			}
		$result3 = $conn->query($query3);	
		$response3 = array();
		if ($result3->num_rows > 0) {
			while($row3 = $result3->fetch_assoc()) {
				$row_array3['ripoi'] = $row3['ripoi'];
				$row_array4['1'] = $row3['1'];
				$row_array4['2'] = $row3['2'];
				$row_array4['3'] = $row3['3'];
				$row_array4['4'] = $row3['4'];
				$row_array4['5'] = $row3['5'];
				$row_array4['6'] = $row3['6'];
				$row_array4['7'] = $row3['7'];
				$row_array4['8'] = $row3['8'];
				$row_array4['9'] = $row3['9'];
				$row_array4['10'] = $row3['10'];
				$row_array4['11'] = $row3['11'];
				$row_array4['12'] = $row3['12'];
				$row_array4['13'] = $row3['13'];
				$row_array4['14'] = $row3['14'];
				$row_array4['15'] = $row3['15'];
				$row_array4['16'] = $row3['16'];
				$row_array4['17'] = $row3['17'];
				$row_array4['18'] = $row3['18'];
				$row_array4['19'] = $row3['19'];
				$row_array4['20'] = $row3['20'];
				$row_array4['21'] = $row3['21'];
				$row_array4['22'] = $row3['22'];
				$row_array4['23'] = $row3['23'];
				$row_array4['24'] = $row3['24'];
				$row_array3['lan'] = $row3['lan'];
				$row_array3['lon'] = $row3['lon'];
				array_push($response3,$row_array3);
			}
		}
		$mesh_timi=$row_array3['ripoi'] / 24;
		$fVariance = 0.0;
			foreach ($row_array4 as $i)
			{
				$fVariance += pow($i - $mesh_timi, 2);
			}       
			$size = 24 - 1;
			$typ=sqrt($fVariance)/sqrt($size);
		$response4=array(
		array(
	            "mesh" => $mesh_timi,
	            "typ" => $typ,
				"lan" => $row_array3['lan'],
				"lon" => $row_array3['lon']
			)
			); 
		echo json_encode($response4);	  
	}
} //TELOS 1HS IF
$conn->close();

?>