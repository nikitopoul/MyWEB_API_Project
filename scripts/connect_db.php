<?php  
//header('Content-type: text/plain; charset=utf-8');

//----------CONNECTION ME TIN BASI------------
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
 
return $conn;

//mysqli_close($conn);
?>