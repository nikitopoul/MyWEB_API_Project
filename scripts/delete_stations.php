<?php
include_once('connect_db.php');
mysqli_query($conn,"set names 'utf8'");

$id2 = $_POST['id2'];

$sql0 = "SELECT id FROM stations WHERE id='$id2'";
$result = $conn->query($sql0);

if ($result->num_rows == 0) {
	#ΑΝ ΔΕΝ ΥΠΑΡΧΕΙ Ο ΣΤΑΘΜΟΣ
  //echo "Error: " . $sql0 . "<br>" . $conn->error;
    print "<h4 class='w3-container w3-section w3-red'><strong>Επιλέξτε κάποιον σταθμό που υπάρχει.</strong></h4>";
} else {
	#ΑΝ ΥΠΑΡΧΕΙ: ΤΟΝ ΔΙΑΓΡΑΦΕΙ
	$sql = "DELETE FROM stations WHERE id='$id2'";
	mysqli_query($conn, $sql) or die(mysql_error());
    print "<h4 class='w3-container w3-section w3-green w3-round'><strong>Ο σταθμός $id2 διαγράφηκε.</strong></h4>";

}

$conn->close();
?>