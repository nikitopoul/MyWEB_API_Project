//Afto to script xreiazetai gia na prosthesoume kapoion stathmo, 
//dynamika, ΧΩΡΙΣ ΑΝΑΝΕΩΣΗ ΟΛΟΚΛΗΡΗΣ ΤΗΣ ΣΕΛΙΔΑΣ

$("#add").click( function() {

var data = $("#add_form :input").serializeArray();

$.post($("#add_form").attr("action"), data, function(info){ $("#result").html(info); } );
});

$("#add_form").submit( function() {
	return false;
});