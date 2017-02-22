<?php
	include_once('connect_db.php');
	
	//if(/*isset($_GET['00000000000000000000'/*alliws !...'api_key'*]*/1)#an einai o admin
	$flag = $_GET['flag'];
	$api  = $_GET['api'];
	if($flag==0){#an einai o admin
		echo "<div class='w3-container'>";
		echo "<h3 align='center'>Όλα τα request που έγιναν ανά είδος για όλα τα API keys:</h3>";
		echo "<div class='w3-container'><h4 align='left'>Σταθμοί καταγραφής:</h4>";
		$query = "SELECT id, req1 FROM api_keys";
		if (!$query) 
		{
			die('Invalid query: ' . mysql_error());
		}
		$result = $conn->query($query);	
		$response = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc())
			{
				$row_array['id'] = $row['id'];
				$row_array['req1'] = $row['req1'];
				array_push($response,$row_array);
			}
		}
		$jdata=json_encode($response);
		$data=json_decode($jdata,true);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data as $number=>$row_array){
				echo '<tr>
						<td>' . $row_array['id'] . '</td>
						<td>' . $row_array['req1'] . '</td>
					</tr>';
		}
		echo "</table> </div> <div class='w3-container'>";
		echo "<h4 align='left'>Απόλυτη Τιμή Ρυπανσης:</h4>";
		$query2 = "SELECT id, req2 FROM api_keys";
		if (!$query2) 
		{
			die('Invalid query: ' . mysql_error());
		}
		$result2 = $conn->query($query2);	
		$response2 = array();
		if ($result2->num_rows > 0) {
			while($row2 = $result2->fetch_assoc())
			{
				$row_array2['id'] = $row2['id'];
				$row_array2['req2'] = $row2['req2'];
				array_push($response2,$row_array2);
			}
		}
		$jdata2=json_encode($response2);
		$data2=json_decode($jdata2, true);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data2 as $number=>$row_array2){
				echo '<tr>
						<td>' . $row_array2['id'] . '</td>
						<td>' . $row_array2['req2'] . '</td>
					</tr>';
		}
		echo "</table> </div> <div class='w3-container'>";
		echo "<h4 align='left'>Μέση Τιμή Ρυπανσης:</h4>";
		$query3 = "SELECT id, req3 FROM api_keys";
		if (!$query3) 
		{
			die('Invalid query: ' . mysql_error());
		}
		$result3 = $conn->query($query3);	
		$response3 = array();
		if ($result3->num_rows > 0) {
			while($row3 = $result3->fetch_assoc())
			{
				$row_array3['id'] = $row3['id'];
				$row_array3['req3'] = $row3['req3'];
				array_push($response3,$row_array3);
			}
		}
		$jdata3=json_encode($response3);
		$data3=json_decode($jdata3,true);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data3 as $number=>$row_array3){
				echo '<tr>
						<td>' . $row_array3['id'] . '</td>
						<td>' . $row_array3['req3'] . '</td>
					</tr>';
		}
		echo "</table> </div>";
		echo "</div> <hr> <div class='w3-container'>";
		echo "<h3 align='center'>Τα 10 API keys με τα περισσότερα requests:</h3> <br>";
		$query4 = "SELECT id, (req1+req2+req3) FROM api_keys ORDER BY -(req1+req2+req3) LIMIT 10";
		if (!$query4) 
		{
			die('Invalid query: ' . mysql_error());
		}
		$result4 = $conn->query($query4);	
		$response4 = array();
		if ($result4->num_rows > 0) {
			while($row4 = $result4->fetch_assoc())
			{
				$row_array4['id'] = $row4['id'];
				$row_array4['(req1+req2+req3)'] = $row4['(req1+req2+req3)'];
				array_push($response4,$row_array4);
			}
		}
		$jdata4=json_encode($response4);
		$data4=json_decode($jdata4,true);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data4 as $number=>$row_array4){
				echo '<tr>
						<td>' . $row_array4['id'] . '</td>
						<td>' . $row_array4['(req1+req2+req3)'] . '</td>
					</tr>';
		}
		echo "</table> </div>";
		echo "<hr> <div class='w3-container'>";
		echo "<h3 align='center'>Συνολικός αριθμός API keys που έχουν εκδοθεί:</h3>";
		$query5 = "SELECT COUNT(id) as count from api_keys";
		if (!$query5) 
		{
			die('Invalid query: ' . mysql_error());
		}
		$result5 = $conn->query($query5);
		$row = mysqli_fetch_row($result5);
		echo "<h3 align='center'>$row[0]</h3> </div>";
		
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////
	else
	{
		echo "<div class='w3-container'>";
		echo "<h3 align='center'>Όλα τα request που έγιναν ανά είδος για το API key $api</h3>";
		echo "<h4 align='left'>Σταθμοί καταγραφής:</h4>";
		$query6 = "SELECT req1 FROM api_keys WHERE id='$api'";
		if (!$query6) 
		{
			die('Invalid query: ' . mysqli_error());
		}
		$result6 = $conn->query($query6);	
		$response6 = array();
		if ($result6->num_rows > 0) {
			while($row6 = $result6->fetch_assoc())
			{
				$row_array6['req1'] = $row6['req1'];
				array_push($response6,$row_array6);
			}
		}
		$jdata6=json_encode($response6);
		$data=json_decode($jdata6);
		//print_r ($data);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data as $number){
				echo '<tr>
						<td>' . $api . '</td>
						<td>' . $row_array6['req1'] . '</td>
					</tr>';
		}
		echo "</table>";
		echo "<br>";
		echo "<h4 align='left'>Απόλυτη Τιμή Ρυπανσης:</h4>";
		$query7 = "SELECT req2 FROM api_keys WHERE id='$api'";
		if (!$query7) 
		{
			die('Invalid query: ' . mysqli_error());
		}
		$result7 = $conn->query($query7);	
		$response7 = array();
		if ($result7->num_rows > 0) {
			while($row7 = $result7->fetch_assoc())
			{
				$row_array7['req2'] = $row7['req2'];
				array_push($response7,$row_array7);
			}
		}
		$jdata7=json_encode($response7);
		$data7=json_decode($jdata7);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data as $number){
				echo '<tr>
						<td>' . $api . '</td>
						<td>' . $row_array7['req2'] . '</td>
					</tr>';
		}
		echo "</table>";
		echo "<br>";
		echo "<h4 align='left'>Μέση Τιμή Ρυπανσης:</h4>";
		$query8 = "SELECT req3 FROM api_keys WHERE id='$api'";
		if (!$query8) 
		{
			die('Invalid query: ' . mysqli_error());
		}
		$result8 = $conn->query($query8);	
		$response8 = array();
		if ($result8->num_rows > 0) {
			while($row8 = $result8->fetch_assoc())
			{
				$row_array8['req3'] = $row8['req3'];
				array_push($response8,$row_array8);
			}
		}
		$jdata8=json_encode($response8);
		$data8=json_decode($jdata8);
		echo "<table class='w3-table w3-striped w3-bordered w3-border w3-hoverable' border='1'>
				<tr class='w3-grey'>
				<th>ID</th>
				<th>Αριθμός Requests</th>
				</tr>";
		foreach($data as $number){
				echo '<tr>
						<td>' . $api . '</td>
						<td>' . $row_array8['req3'] . '</td>
					</tr>';
		}
		echo "</table> </div>";
	}
?>