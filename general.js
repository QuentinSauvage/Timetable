function getME(valeur) {
	if(!valeur)
		return;
	param='v='+valeur;
	$("#matiere").load('matieres.php', param);
	$("#enseignant").load('enseignants.php', param);
}

function getCours(valeur,type) {
	if(valeur=="")
		$("#ctnCreneaux").load('cours.php');
	param='v='+valeur+'&t='+type;
	$("#ctnCreneaux").load('cours.php', param);
}

function getChoix(nom) {
	if(!nom) {
		$("#select").hide();
		getCours();
	} else {
		param='v='+nom.value;
		$("#select").show();
		$("#select").load('choix.php', param);
	}
}

var deroule = false;
$("#logs").on({
	"mouseenter" : function(){
		if(!deroule) {
			$("#listeTop").stop().slideDown(250);
			deroule = true;
		}
	},
	"mouseleave" : function(){
		if(deroule) {
			$("#listeTop").stop().slideUp(250);
			deroule = false;
		}
	}
});

function showModal(creneau, id) {
	$("#modal").css("background-color", $(creneau).css("backgroundColor"));
	$("#modal").css("margin-top", $(creneau).css("marginTop"));
	$("#modal").css("margin-left", $(creneau).css("marginLeft"));
	$("form input").first().val(id);
	$("#modal").fadeIn(250);
}

function hideModal(){
	$("#modal").fadeOut(250);
}
$(window).ready(function() {
	$("#modal").hide();
	$("#infoForm").hide();
	var sPageURL = window.location.search.substring(1);
	var sURLVariables = sPageURL.split('&');
	for (var i = 0; i < sURLVariables.length; i++){
		var sParameterName = sURLVariables[i].split('=');
		if (sParameterName[0] == "error")
			$("#infoForm").show().delay(1000).fadeOut();
	}
});
