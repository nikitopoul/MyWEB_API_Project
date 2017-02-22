<?php
include_once('connect_db.php');
mysqli_query($conn,"set names 'utf8'");

if($_SERVER["REQUEST_METHOD"] == "POST")
{    
	$name = $_POST['name'];
	$id = $_POST['id'];
	$lan = $_POST['lan'];
	$lon = $_POST['lon'];
      // Validate 
    if(empty($name)||empty($id)||empty($lan)||empty($lon))
    { //an einai adeio to pedio 
      print "<h4 class='w3-container w3-section w3-red'><strong>Παρακαλώ δώστε έγκυρες τιμές για να προσθέσετε σταθμό.</strong></h4>";    
    }
    else
    {
	

	$sql = "INSERT INTO stations (name,id,lan,lon)
	VALUES ('$name', '$id', '$lan', '$lon')";

	if ($conn->query($sql) === TRUE) {
		print "<h4 class='w3-container w3-section w3-green w3-round'><strong>Ο σταθμός $name προστέθηκε στη βάση δεδομένων.</strong></h4>";
   	} else {
   		print "<h4 class='w3-container w3-section w3-red'><strong>Ο σταθμός $name υπάρχει ήδη ως εγγραφή.</strong></h4>";
	}
	}
}
$conn->close();
?>