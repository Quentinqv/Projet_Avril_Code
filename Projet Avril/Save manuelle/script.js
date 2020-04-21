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
		if (document.getElementById('filiere-select').value === 'filiere' || document.getElementById('groupe-select').value === 'Groupe') {
			etat = false;
		}
		if (document.getElementById('checkbox-inscription').checked != true) {
			etat = false;
		}
		if (etat == true) {
			formulaire = document.getElementById('Inscription_Formulaire');
			formulaire.submit();
		} else {
			alert('Tous les champs ne sont pas remplis !');
		}
	}
	if (but === 'connexion') {
		if (document.getElementById('email-connexion').value === "" || document.getElementById('mdpConnexion').value === "" || document.getElementById('checkbox-connexion').checked != true) {
			alert('Tous les champs ne sont pas remplis !');
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

function AfficherGroupe(selection){
	var valeur = selection.value;
	var elt = document.getElementById('groupe-select');
	if (valeur === "filiere") {
		elt.innerHTML = 
		"<option value=\"groupe\">Groupes</option>";
	}
	if (valeur === "L1-MIPI") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"A1\">A1</option>"+
		"<option value=\"A2\">A2</option>"+
		"<option value=\"A3\">A3</option>";
	}
	if (valeur === "L2-MIPI") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"B1\">B1</option>"+
		"<option value=\"B2\">B2</option>"+
		"<option value=\"B3\">B3</option>";
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