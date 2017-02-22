//Afto to script xreiazetai gia na διαγραψουμε kapoion stathmo, 
//dynamika, ΧΩΡΙΣ ΑΝΑΝΕΩΣΗ ΟΛΟΚΛΗΡΗΣ ΤΗΣ ΣΕΛΙΔΑΣ

$("#del").click( function() {

var data = $("#del_form :input").serializeArray();

$.post($("#del_form").attr("action"), data, function(info){ $("#result2").html(info); } );
});

$("#del_form").submit( function() {
	return false;
});