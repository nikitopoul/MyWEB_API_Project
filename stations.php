<!--       ΣΕΛΙΔΑ ΔΙΑΧΕΙΡΙΣΗΣ ΣΤΑΘΜΩΝ - ΠΡΟΣΘΗΚΗ/ΔΙΑΓΡΑΦΗ ΣΤΑΘΜΟΥ+ΑΝΕΒΑΣΜΑ csv     -->
<!DOCTYPE html>
<html>
<head>
<title>Σταθμοί</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<link rel="stylesheet" type="text/css" href="style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script><!--Για να πετύχει το ανέβασμα του csv χωρίς ανανέωση σελίδας -->


<style>
        .progress { position:relative; width:400px; border: 1px solid #ddd; padding: 1px; border-radius: 3px; height: 2px;}
        .bar { background-color: #B4F5B4; width:0%; height:6px; border-radius: 4px; }
        .percent { position:absolute; display:inline-block; top:3px; left:48%; }
        #status{margin-top: 30px;}
        .suggestionsBox{
          position: relative;
          left: 200px;
          width: 200px;
          margin: 10px 0px 0px 0px;
        }
        .suggestionList{
          margin: 0px;
          padding: 0px;
        }
        .suggestionList li{
          margin: 0px;
          cursor: pointer;
        }
        .suggestionList li:hover{
          background-color: #666
        }
        .tabs {display:none;}
</style>
</head>
<body>

<div id='nav'> 
  <ul id='navigation'>
  <li><a href="http://www.ypeka.gr/"target="_blank">
    <img src="/img/ypekag.png" id="logo" />
  </a></li>
    <li class='navigation-Blog'>Υπουργείο Περιβάλλοντος Ενέργειας και Κλιματικής αλλαγής - Σταθμοί Ρύπανσης</a></li>
  </ul>
</div>

<div class='w3-container'>
  <div class="w3-row w3-center">
    <h1>Σελίδα Διαχείρισης Σταθμών</h1>
  </div>

  <div class="w3-row">    <!--ΓΙΑ ΝΑ ΑΦΗΣΕΙ ΛΙΓΟ ΚΕΝΟ-->
    <p></p>
  </div>

  <div class="w3-row">
    <div class="w3-quarter  w3-col">
      <nav class="w3-sidenav w3-light-grey w3-card-2" style="width:17%">
        <div class="w3-container">
          <h5>Menu</h5>
        </div>
        <a href="#" class="tablink" onclick="openCity(event, 'add_stations');">Προσθήκη Σταθμού</a>
        <a href="#" class="tablink" onclick="openCity(event, 'del_stations');">Διαγραφή Σταθμού</a>
        <a href="#" class="tablink" onclick="openCity(event, 'insert');">Εισαγωγή Δεδομένων</a>
      </nav>
      </div>

    <div class="w3-container w3-col" style="margin-left: 220px">

    <div id="add_stations" class="w3-container tabs">
      <h2>Προσθήκη Σταθμού</h2>
      <div class="w3-col s6">
      <form action="add_stations.php" id="add_form" method="post">
      <!--ΦΟΡΜΑ ΓΙΑ ΠΡΟΣΘΗΚΗ-->
        <p>Προσθέστε έναν σταθμό καταγραφής στη βάση δεδομένων.</p>

        <label class="w3-label"><b>Όνομα Σταθμού</b></label>
        <input class="w3-input w3-animate-input" type="text" name="name" style="width:350px">

        <label class="w3-label"><b>Κωδικός Σταθμού</b></label>
        <input class="w3-input w3-animate-input" type="text" name="id" style="width:350px">
        

        <label class="w3-label"><b>Γεωγραφικό μήκος</b></label>
        <input class="w3-input w3-animate-input" type="text" name="lan" style="width:350px">

        <label class="w3-label"><b>Γεωγραφικό πλάτος</b></label>
        <input class="w3-input w3-animate-input" type="text" name="lon" style="width:350px">

        <p>      
        <button type="submit" id="add" class="w3-btn w3-blue">Προσθήκη</button></p>
      </form> 
      <p />
      <span id="result"></span>


    </div>
    </div>

    <div id="del_stations" class="w3-container tabs">
      <h2>Διαγραφή Σταθμού</h2>
      <div class="w3-col s6">
      <form action="delete_stations.php" id="del_form" method="post">
      <!--ΦΟΡΜΑ ΓΙΑ ΔΙΑΓΡΑΦΗ-->
        <p>Διαγράψτε έναν σταθμό καταγραφής από τη βάση δεδομένων.</p>

        <label class="w3-label"><b>Κωδικός Σταθμού</b></label>
        <input class="w3-input w3-animate-input" type="text" name="id2" id="stathmos" onkeyup="lookup(this.value);" onblur="fill();" style="width:350px">
        
        <p>      
        <button type="submit" id="del" class="w3-btn w3-blue">Διαγραφή</button></p>

      </form> 
      <span id="result2"></span>
      <br><br>
      <div align="left" class="suggestionBox" id="suggestions" style="display:none;">
      <div align="left" class="suggestionList" id="autoSuggestionsList">
        &nbsp;
      </div>
      </div>

    </div>
    </div>

      <div id="insert" class="w3-container tabs">
           <h2>Εισαγωγή Δεδομένων</h2>
           <div class="w3-col s6">
              <form action="csv.php" method="post" enctype='multipart/form-data'>
              <!--ΦΟΡΜΑ ΓΙΑ CSV-->
                <p>Ανέβασε ένα νέο csv αρχείο και πάτησε το κουμπί για να ολοκληρωθεί η προσθήκη του στη βάση.</p>
          
                <label class="w3-label"><b>Κωδικός Σταθμού</b></label>
                <input class="w3-input w3-animate-input" type="text" name="id" id="id" onkeyup="lookup2(this.value);" onblur="fill2();" placeholder="id" style="width:350px">
                
                <label class="w3-label"><b>Έτος</b></label>
                <input class="w3-input w3-animate-input" type="text" name="year" id="year" placeholder="year" style="width:350px">
          
                <label class="w3-label"><b>Τύπος Ρύπου</b></label>
                <input class="w3-input w3-animate-input" type="text" name="ripos" id="ripos" placeholder="ripos" style="width:350px">
                
                <label class="w3-label"><b>Ανέβασμα Αρχείου</b></label>
                <input type='file' name='filename' id="filename"><br />
                <p></p>
                <div class="progress">
                  <div class="bar"></div >
                  <div class="percent">0%</div >        
                </div>
                <p></p><p></p>

                <p>      
                <button type="submit" name="submit" class="w3-btn w3-blue">Προσθήκη</button></p>
              </form>
              
              <div id="status"></div>
              <div align="left" class="suggestionBox" id="suggestions2" style="display:none;">
              <div align="left" class="suggestionList" id="autoSuggestionsList2">
                &nbsp;
              </div>
              </div>
            </div>
        </div>

    </div>

  </div>
</div>
<!--ΑΥΤΑ ΤΑ ΑΡΧΕΙΑ ΤΑ ΧΡΕΙΑΖΟΜΑΣΤΕ ΓΙΑ ΝΑ ΓΙΝΕΤΑΙ Η ΠΡΟΣΘΗΚΗ/ΔΙΑΓΡΑΦΗ ΔΥΝΑΜΙΚΑ, ΧΩΡΙΣ ΝΑ ΦΟΡΤΩΝΕΤΑΙ ΟΛΟΚΛΗΡΗ Η ΣΕΛΙΔΑ-->

<script>
function openCity(evt, cityName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("tabs");
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" w3-red", ""); 
  }
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " w3-red";
}

(function() {
 
    var bar = $('.bar');
    var percent = $('.percent');
    var status = $('#status');
 
    $('form').ajaxForm({
        beforeSend: function() {
            status.empty();
            var percentVal = '0%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        success: function() {
            var percentVal = '100%';
            bar.width(percentVal)
            percent.html(percentVal);
        },
        complete: function(xhr) {
            status.html(xhr.responseText);
        }
    });
})();

function lookup(emfanisi) {
    if (emfanisi.length == 0) {
      $('$suggestions').hide();
    }else{
      $.post("searchresults.php", {queryString: ""+emfanisi+""}, function(data){
        if (data.length>0) {
          $('#suggestions').show();
          $('#autoSuggestionsList').html(data);
        }
      });
    }
  }
function lookup2(emfanisi) {
    if (emfanisi.length == 0) {
      $('$suggestions2').hide();
    }else{
      $.post("searchresults.php", {queryString2: ""+emfanisi+""}, function(data){
        if (data.length>0) {
          $('#suggestions2').show();
          $('#autoSuggestionsList2').html(data);
        }
      });
    }
  }

  function fill(thisValue){
    $('#stathmos').val(thisValue);
    setTimeout("$('#suggestions').hide();", 200);
  }
  function fill2(thisValue){
    $('#id').val(thisValue);
    setTimeout("$('#suggestions2').hide();", 200);
  }

</script>

<script src="add_stations.js" type="text/javascript"></script>
<script src="del_stations.js" type="text/javascript"></script>

</body>
</html> 