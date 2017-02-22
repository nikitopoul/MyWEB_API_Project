<!DOCTYPE html>
<html>
 
<head>
<title>Ypeka-API Register</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<div id='nav'> 
  <ul id='navigation'>
    <li><a href="http://www.ypeka.gr/"target="_blank">
    <img src="/img/ypekag.png" id="logo" />
    </a></li>
    <li class='navigation-Blog'>Υπουργείο Περιβάλλοντος Ενέργειας και Κλιματικής Aλλαγής - Σταθμοί Ρύπανσης</a></li>
  </ul>
</div>

<?php
 
include_once('connect_db.php');
mysqli_query($conn,"set names 'utf8'");

 
//******************************************FUNCTIONS DECLARATION*************************************

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



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = " ";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
    echo $randomString;
}


  
// Define variables and initialize with empty values
$emailErr = $passErr = "";
$email = $pass1 = $pass2 = "";




// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){ //otan patisei to register
  
 
    // Validate email address
    if(empty($_POST["email"])){
        $emailErr = '<br>Please enter your email address.';     //douleuei 
    }else{
        $email = filterEmail($_POST["email"]);
        if($email == FALSE){
            $emailErr = '<br>Please enter a valid email address.';
        }
    }
     
    // Validate password(den sygkrinw edw toys 2 kwdikous)
    if(empty($_POST["pass1"])){
        $passErr = '<br>Please enter your password.';    
    }else{
        $pass1 = filterString($_POST["pass1"]);
        if($pass1 == FALSE){
            $passErr = '<br><p class="error"> Please enter a valid password.'; //douleuei
        }
    }

    if(empty($_POST["pass2"])){
        $passErr = '<br>Please enter your password.';     
    }else{
        $pass2 = filterString($_POST["pass1"]);
        if($pass2 == FALSE){
            $passErr = '<br><p class="error"> Please enter a valid password.';
        }
    }
     
    // Check input errors before putting them into the base
    if(empty($emailErr) && empty($passErr)){ //an den exei sumbei kanena lathos 
         
        if ($_POST["pass1"]==$_POST["pass2"]) { //elegxw an einai idia
            
            
            $salt= generateRandomString(); 
            $my_api_key= md5($salt.$email);
             
            $sql = "INSERT INTO api_keys (id) VALUES ('$my_api_key')";
            $sql1 = "INSERT INTO users (email, pass,type,api_key) VALUES ('$email', '$pass1', '0' , '$my_api_key')";
            if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql1)){
            echo '<br><br> <p class="success1">Εγγραφήκατε στο σύστημα. Το API KEY σας είναι το: ';
            echo $my_api_key ;
        } else{
            echo '<br><br> <p class="error1">Υπάρχει ήδη αυτό το email.';
            }
        }else{echo '<br><br> <p class="error1">Οι κωδικοί πρέπει να είναι ίδιοι!';} 
    }
}
 
?>
 
<div class="login">
<form name="signupform" class="input" action="registration.php" method="post">
  <fieldset style="border-color: #008CBA; text-align: center" >
    <legend style="font-size: 120%; text-align: center">Sign up form:</legend>
    <div>E-mail</div>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"> <?php echo $emailErr; ?> </span> <!--to parathuro me to minima lathous pou emfanizei apo katw-->
    <div>Κωδικός:</div>
    <input type="password" id="pass1" name="pass1" value="<?php echo $pass1; ?>">
        <span class="error"> <?php echo $passErr; ?> </span>
    <div>Επαλήθευση Κωδικού:</div>
    <input type="password" id="pass2" name="pass2" value="<?php echo $pass2; ?>">
        <span class="error"> <?php echo $passErr; ?> </span>
    <br>
    <br>
    <button class="button blue" value="Send">Εγγραφή</button>
  </fieldset>
</form>
</div>
</body>
</html>