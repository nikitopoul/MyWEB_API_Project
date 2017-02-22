<?php
include_once('connect_db.php');
mysqli_query($conn,"set names 'utf8'");


if (!$conn) {
	echo "could not connect to the database";
}else{
if (isset($_POST['queryString'])) {
	$queryString = $conn->real_escape_string($_POST['queryString']);
	if (strlen($queryString)>0) {
		$query=$conn->query("SELECT id FROM stations WHERE id LIKE '".$queryString."%' ORDER BY id ASC LIMIT 10");
		if ($query) {
			while ($result = $query ->fetch_object()) {
				echo '<li onClick="fill(\''.$result->id.'\');">'.$result->id.'</li>';
				}
		}
	}else {
		echo "there was a problem with the query";
	}
}
if (isset($_POST['queryString2'])) {
	$queryString = $conn->real_escape_string($_POST['queryString2']);
	if (strlen($queryString)>0) {
		$query=$conn->query("SELECT id FROM stations WHERE id LIKE '".$queryString."%' ORDER BY id ASC LIMIT 10");
		if ($query) {
			while ($result = $query ->fetch_object()) {
				echo '<li onClick="fill2(\''.$result->id.'\');">'.$result->id.'</li>';
				}
		}
	}else {
		echo "there was a problem with the query";
	}
}
}


?>