<?php

include 'connect_db.php';
mysqli_query($conn,"set names 'utf8'"); #χωρις αυτό δεν λειτουργούν τα ελληνικά

$ripos = $_POST['ripos'];
$id = $_POST['id'];
$year = $_POST['year'];

// ΕΛΕΓΧΟΣ ΓΙΑ ΤΟ ΑΝ ΕΧΕΙ ΔΩΣΕΙ ΤΑ ΣΤΟΙΧΕΙΑ Ο ΧΡΗΣΤΗΣ
if(empty($_POST["ripos"]) || empty($_POST["id"]) || empty($_POST["year"])){
    print "<h5 class='w3-container w3-section w3-red'><strong>Συμπληρώστε όλα τα στοιχεία παρακαλώ.</strong></h4>";
}else{

$sql0 = "SELECT id FROM stations WHERE id='$id'";
$result0 = $conn->query($sql0);

// ΕΛΕΓΧΟΣ ΓΙΑ ΤΟ ΑΝ ΥΠΑΡΧΕΙ Ο ΣΤΑΘΜΟΣ
if ($result0->num_rows == 0) {
        #ΑΝ ΔΕΝ ΥΠΑΡΧΕΙ Ο ΣΤΑΘΜΟΣ
        //echo "Error: " . $sql0 . "<br>" . $conn->error;
        print "<h4 class='w3-container w3-section w3-red'><strong>Επιλέξτε κάποιον σταθμό που υπάρχει.</strong></h4>";
} else {
        
        #ΑΝ ΥΠΑΡΧΕΙ: KANEI TO ANEBASMA
        if (isset($_POST['submit'])) {

            #ADEIASMA TOU PINAKA   ---->ΔΕΝ ΧΡΕΙΑΖΕΤΑΙ
            //$deleterecords = "TRUNCATE TABLE uploads"; //empty the table of its current records
            //mysqli_query($conn, $deleterecords);


            /*
            if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                echo "<h5>" . "Το αρχείο ". $_FILES['filename']['name'] ." ανέβηκε." . "</h5>";
                //echo "<h2>Displaying contents:</h2>";
                //readfile($_FILES['filename']['tmp_name']);
            }*/
        
            //Import uploaded file to Database
            $handle = fopen($_FILES['filename']['tmp_name'], "r");
            while (($data = fgetcsv($handle, 8096, ",")) !== FALSE) {
                    $import="INSERT into uploads values ('$ripos', '$year', '$id', '$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$data[7]','$data[8]','$data[9]','$data[10]','$data[11]','$data[12]','$data[13]','$data[14]','$data[15]','$data[16]','$data[17]','$data[18]','$data[19]','$data[20]','$data[21]','$data[22]','$data[23]','$data[24]')";
                    #θέλει mysqli και όχι mysql
                    mysqli_query($conn, $import) or die('ΠΡΕΠΕΙ ΝΑ ΒΑΛΕΤΕ ΔΙΑΦΟΡΕΤΙΚΟ ΤΥΠΟ ΡΥΠΟΥ ΑΝ ΑΝΕΒΑΖΕΤΕ ΓΙΑ ΤΟΝ ΙΔΙΟ ΣΤΑΘΜΟ');
            }
            fclose($handle);
            print '<h4 class="w3-container w3-section w3-green w3-round"><strong>Ανέβασμα στη βάση δεδομένων επιτυχές.</strong></h4>';
            }
        
            //view upload form
        
}
}
 ?>