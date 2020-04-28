function mdpcache(champs){
	var elt = document.getElementById(champs);
	if (elt.type == "password"){
		elt.type='text';
		document.getElementById(champs+'IMG').src = 'assets/img/oeil.png';
	}
	else{
		elt.type='password';
		document.getElementById(champs+'IMG').src = 'assets/img/oeil2.png';
	}
}

function VerifMDP(){
	var mdp1 = document.getElementById('mdp1');
	var mdp2 = document.getElementById('mdp2');
	if (mdp1.value != mdp2.value || mdp1.value === "" || mdp2.value === "") {
		return false;
	}
}
function VerifForm(but){
	if (but === 'inscription') {
		if (VerifMDP() === false) {
			document.getElementsByClassName('ErrorMDP')[0].style.display = "block";
			etat = false;
			return false;
		}
		var champs = document.getElementsByClassName('champs-inscription');
		for (var i = 0; i < champs.length; i++) {
			var etat = true;
			if (champs[i] == "") {
				etat = false;
			}
		}
		let email = document.getElementById('email-inscription').value;
		if (email.slice(-11) != '@u-cergy.fr') {
			etat = false;
		}
		if (document.getElementById('filiere-select').value === 'filiere' || document.getElementById('groupe-select').value === 'Groupe') {
			etat = false;
		}
		if (document.getElementById('checkbox-inscription').checked != true) {
			etat = false;
		}
		if (verfiCaract(['nom-inscription','prenom-inscription','adresse-inscription'], ",?;:.@/!§ù%*µ$£&") == false) {
			etat = false;
		}
		if (verfiCaract(['email-inscription'], ",?;:/!§ù%*µ$£&") == false) {
			etat = false;
		}
		if (verfiCaract(['tel-inscription'], ",?;:/!§ù%*µ$£&") == false) {
			etat = false;
		}
		if (etat == true) {
			document.getElementById('inscription-1').submit();
		} else {
			alert('Tous les champs ne sont pas correctement remplis !');
		}
	}
	if (but === 'connexion') {
		if (document.getElementById('email-connexion').value === "" || document.getElementById('mdpConnexion').value === "" || document.getElementById('checkbox-connexion').checked != true) {
			alert('Tous les champs ne sont pas correctement remplis !');
		} else {
			document.getElementById('connexion-droite').submit();
		}
	}
}

function CheckConnexion(){
	document.getElementById('inscription').style.display = "none";
	document.getElementById('connexion').style.display = "flex";
	document.getElementsByClassName('ErrorMDP')[1].style.display = "block";
}

function AfficherGroupe(selection, idSelect, idGroupe){
	var valeur = selection.value;
	var elt = document.getElementById(idGroupe);
	if (valeur === "filiere") {
		elt.innerHTML = 
		"<option value=\"groupe\">Groupes</option>";
	}
	if (valeur === "L1-MIPI") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"A1\">A1</option>"+
		"<option value=\"A2\">A2</option>"+
		"<option value=\"A3\">A3</option>";
	}
	if (valeur === "L2-MIPI") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"B1\">B1</option>"+
		"<option value=\"B2\">B2</option>"+
		"<option value=\"B3\">B3</option>";
	}
	if (valeur === "LP-RS") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"C1\">C1</option>"+
		"<option value=\"C2\">C2</option>"+
		"<option value=\"C3\">C3</option>";
	}
	if (valeur === "LPI-RIWS") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"D1\">D1</option>"+
		"<option value=\"D2\">D2</option>"+
		"<option value=\"D3\">D3</option>";
	}
	if (valeur === "ECO") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"E1\">E1</option>"+
		"<option value=\"E2\">E2</option>"+
		"<option value=\"E3\">E3</option>";
	}
	if (valeur === "TS1") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupes</option>"+
		"<option value=\"F1\">F1</option>"+
		"<option value=\"F2\">F2</option>"+
		"<option value=\"F3\">F3</option>";
	}
}

function AllerConnexion(){
	var div = document.getElementById('inscription-gauche');
	div.animate(
		[ {left: "0" },
			{left: "50%" }],
		800);
	setTimeout(function(){document.getElementById('inscription').style.display = "none";},800,);
	setTimeout(function(){document.getElementById('connexion').style.display = "flex";},800,);
}

function AllerInscription(){
	var div = document.getElementById('connexion-droite');
	div.animate(
		[ {right: "0" },
			{right: "50%" }],
		800);
	setTimeout(function(){document.getElementById('connexion').style.display = "none";},800,);
	setTimeout(function(){document.getElementById('inscription').style.display = "flex";},800,);
}

function ChangeProfil(champs){
	if (champs == 'filiere') {
		document.getElementById('span_'+champs).style.display = "none";
		document.getElementById('input_'+champs).style.display = "inline-block";
		document.getElementById('span_groupe').style.display = "none";
		document.getElementById('input_groupe').style.display = "inline-block";
	} else {
		document.getElementById('span_'+champs).style.display = "none";
		document.getElementById('input_'+champs).style.display = "inline-block";
	}
}

function ValiderModif(liste){
	for (var i = 0; i < liste.length; i++) {
		if(liste[i].value == ""){
			alert("Tous les champs ne sont pas correctement remplis.");
			return false;
		}
	}
	if (document.getElementById('input_email').value.slice(-11) != '@u-cergy.fr') {
		alert("Tous les champs ne sont pas correctement remplis.");
		return false;
	}
	if (document.getElementById('input_filiere').options[document.getElementById('input_filiere').selectedIndex].value == 'filiere' || document.getElementById('input_groupe').options[document.getElementById('input_groupe').selectedIndex].value == 'Groupe') {
		document.getElementById('input_filiere').options[document.getElementById('input_filiere').selectedIndex].value = "Indéfini";
		document.getElementById('input_groupe').options[document.getElementById('input_groupe').selectedIndex].value = "Indéfini";
	}
	document.getElementById('profil-form').submit();
}

function verfiCaract(listeChampsId, caract){
	//var caract = ",?;:/!§ù%*µ$£&";
	for (var j = 0; j < listeChampsId.length; j++) {
		for (var i = 0; i<document.getElementById(listeChampsId[j]).value.length; i++) {
			for (var k = 0; k < caract.length; k++) {
				if (document.getElementById(listeChampsId[j]).value[i] == caract[k])  {
					alert("Le champs n'est pas valide");
					return(false);
				}
			}
		}
	}
}