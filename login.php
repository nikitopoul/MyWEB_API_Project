<!DOCTYPE html>
<html>
<head>
<title> Ypeka-Api Login  </title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head> <!-- poy kleinw to head -->
<style type="text/css">
  body {
    background-image: url("/img/11.png");
    /*background-attachment: fixed; /*gia na meinei h eikona*/
}
</style>
<body>

<div id='nav'> 
  <ul id='navigation'>
  <li><a href="http://www.ypeka.gr/"target="_blank">
    <img src="/img/ypekag.png" id="logo" />
  </a></li>
    <li class='navigation-Blog'>Υπουργείο Περιβάλλοντος Ενέργειας και Κλιματικής Aλλαγής - Σταθμοί Ρύπανσης</li>
  </ul>
  </div>

<?php
 
include_once('connect_db.php');
 
 
// Functions to filter user inputs
     
function filterEmail($field){
    // Sanitize e-mail address
    $field = filter_var(trim($field), FILTER_SANITIZE_EMAIL);
     
    // Validate e-mail address
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return FALSE;
    }
}
function filterString($field){
    // Sanitize string
    $field = filter_var(trim($field), FILTER_SANITIZE_STRING);
    if(!empty($field)){
        return $field;
    }else{
        return FALSE;
    }
}
  
// Define variables and initialize with empty values
$emailErr = $passErr = ""; //ta minimata lathous 
$email = $pass = ""; //ta pedia pou dinei o xristis 
  
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{ // molis patisei to log in 
   
      // Validate email address
    if(empty($_POST["email"]))
    { //an einai adeio to pedio toy email
      $emailErr = '<br>Please enter your email address.';     
    }
    else
    {
      $email = filterEmail($_POST["email"]); //an den einai adeio
    
    if($email == FALSE)
    { //to filterEmail kanei return FALSE
      $emailErr = '<br>Please enter a valid email address.';
    }
  }
       
      // Validate password(den sygkrinw edw toys 2 kwdikous) AKYRO!!!!!!
  if(empty($_POST["pass"]))
  {
    $passErr = '<br>Please enter your password.';     
  }
  else
  {
    $pass = filterString($_POST["pass"]);
          
    if($pass == FALSE)
    {
      $passErr = '<br><p class="error"> Please enter a valid password.';
    }
  }
      
      // Check input errors before putting them into the base
  if(empty($emailErr) && empty($passErr))
  { //an sta minimata lathous den exei graftei tipota ara den uparxoun lathi
     #EDW PREPEI NA ELEGKSOUME AN TO EMAIL KAI PASSWORD YPARXEI STH BASH
    $query = "SELECT api_key FROM users WHERE email='$email' AND pass='$pass'";
  
    if(mysqli_query($conn, $query)){
      $result = $conn->query($query); //γινεται το πρωτο query
  
      if ($result->num_rows > 0) 
        { //to login tha einai epituximeno giati tha exei epistrepsei grammes
          // output data of each row
          $query1 = "SELECT type FROM users WHERE email='$email' AND pass='$pass'"; //checkarw an einai user i admin          
          $result1 = $conn->query($query1); //to result1 exei to type 0 i 1
          $row1 = $result1->fetch_assoc();     
          while($row = $result->fetch_assoc()) 
          {
            if($row1["type"]=='0') 
            { 
              $flag = 1;
              header("Location:/statist.php?flag=".$flag."&api=".$row["api_key"]); //i selida toy xristi
            }else 
              {header("Location:/selida.html"); //i selida toy diaxeiristi
              }
          }
      
      }else{
        echo '<br><br> <p class="error1"> Έχετε κάνει λάθος τον κωδικό ή το email.</p>';
      }
    }
  }
}//server_post
?>

<div class="login">
<form name="loginform" class="input" action="login.php" method="post">
  <fieldset style="border-color: #008CBA; text-align: center" >
    <legend style="font-size: 120%; text-align: center">Login form:</legend>
    <div>E-mail</div>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"> <?php echo $emailErr; ?> </span> <!--to parathuro me to minima lathous pou emfanizei apo katw-->
    <div>Κωδικός:</div>
    <input type="password" id="pass" name="pass" value="<?php echo $pass; ?>">
        <span class="error"> <?php echo $passErr; ?> </span>
    <br>
    <br>
    <input type="submit" class="button green" value="Σύνδεση">
  <p align="center"> <a href="registration.php" style='color:#258e8e'> or register here  </a> </p>
  </fieldset>
</form>
</div>


</body>
</html>