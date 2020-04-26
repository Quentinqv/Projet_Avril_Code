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
		if (document.getElementById('filiere-select').value === 'filiere') {
			etat = false;
		}
		if (etat == true) {
			document.getElementById('formulaire').submit();
		} else {
			alert('Tous les champs ne sont pas remplis !');
		}
	}
	if (but === 'connexion') {
		if (document.getElementById('email-connexion').value === "" || document.getElementById('mdpConnexion').value === "") {
			alert('Tous les champs ne sont pas remplis !');
		} else {
			document.getElementById('connexion-droite').submit();
		}
	}
}

function ValiderModif(liste){
	for (var i = 0; i < liste.length; i++) {
		if(liste[i].value == ""){
			alert("Tous les champs ne sont pas remplis.");
			return false;
		}
	}
	document.getElementById('profil-form').submit();
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
			document.getElementById('inscription-1').submit();
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

function AfficherGroupe(selection, idSelect, idGroupe){
	var valeur = selection.value;
	var elt = document.getElementById(idGroupe);
	elt.style.display = "block";
	if (valeur === "filiere") {
		elt.innerHTML = 
		"<option value=\"groupe\">Groupes</option>";
	}
	if (valeur === "nomsgroupes") {
		elt.style.display = "none";
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
	if (valeur === "LP-RS") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"C1\">C1</option>"+
		"<option value=\"C2\">C2</option>"+
		"<option value=\"C3\">C3</option>";
	}
	if (valeur === "LPI-RIWS") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"D1\">D1</option>"+
		"<option value=\"D2\">D2</option>"+
		"<option value=\"D3\">D3</option>";
	}
	if (valeur === "ECO") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"E1\">E1</option>"+
		"<option value=\"E2\">E2</option>"+
		"<option value=\"E3\">E3</option>";
	}
	if (valeur === "TS1") {
		elt.innerHTML = 
		"<option value=\"Groupe\">Groupe</option>"+
		"<option value=\"F1\">F1</option>"+
		"<option value=\"F2\">F2</option>"+
		"<option value=\"F3\">F3</option>";
	}
}

function ValidTrombi(){
	document.getElementById("ERRORmsg").style.display = "none";
	var selectF = document.getElementById('filiere-select').value;
	var selectG = document.getElementById('groupe-select').value;
	if (selectF == 'filiere' && selectG == 'Groupe') {
		document.getElementById("ERRORmsg").style.display = "block";
		return false;
	}

	var formu = document.getElementById('form-trombi');
	if (selectF == 'nomsgroupes') {
		formu.action = "trombinoscope.php?filiere=TRUE";
		formu.submit();
		return true;
	}
	else {
		if (selectG == 'Groupe') {
			formu.action = "trombinoscope.php?filiere=TRUE";
		} else {
			formu.action = "trombinoscope.php?filiere=TRUE&groupe=TRUE";
		}
	}
	formu.submit();
}