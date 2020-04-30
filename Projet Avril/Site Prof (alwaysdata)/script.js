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
		if (verfiCaract(['nom-inscription','prenom-inscription'], ",?;:.@/!§ù%*µ$£&") == false) {
			etat = false;
		}
		if (verfiCaract(['email-inscription'], ",?;:/!§ù%*µ$£&") == false) {
			etat = false;
		}
		if (verfiCaract(['tel-inscription'], ",?;:/!§ù%*µ$£&") == false) {
			etat = false;
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

function CheckConnexion(){
	document.getElementById('inscription').style.display = "none";
	document.getElementById('connexion').style.display = "flex";
	document.getElementsByClassName('ErrorMDP')[1].style.display = "block";
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

function AffSearchName(){
	let form = document.getElementById('SearchName');
	if (form.style.opacity == 0) {
		form.animate([
		{display: 'none', opacity: 0, marginTop: "-50px"},
		{display: 'flex', opacity: 1, marginTop: "20px"}
			],500);
		form.style.top = "620px";
		form.style.opacity = 1;
		form.style.zIndex = "1";
		form.style.marginTop = "20px";
	} else {
		form.animate([
		{display: 'flex', opacity: 1, marginTop: "20px"},
		{display: 'none', opacity: 0, marginTop: "-50px"}
			],500);
		form.style.opacity = 0;
		form.style.zIndex = "-1";
		form.style.marginTop = "-50px";
	}
}

function CheckSearchEtudiant(){
	let nom = document.getElementById('nom');
	let prenom = document.getElementById('prenom');
	let email = document.getElementById('email');
	if (nom.value == '' && prenom.value == '' && email.value == '') {
		document.getElementById('ErrorSearch').style.display = 'block';
		return false;
	} else {
		document.getElementById('SearchName').action = 'trombinoscope.php?Etudiant=TRUE';
		document.getElementById('SearchName').submit();
	}
}

function verfiCaract(listeChampsId, caract){
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

function AfficherFiliere(selection,liste,IdGrp){
	if (selection.value == 'filiere') {
		let SelectGroupe = document.getElementById(IdGrp);
		SelectGroupe.innerHTML = "<option value='Groupe'>Groupes</option>";
		SelectGroupe.style.display = "block";
		return false;
	}
	if (selection.value == 'nomsgroupes') {
		let SelectGroupe = document.getElementById(IdGrp);
		SelectGroupe.style.display = "none";
		return false;
	} 
	else {
		let groupes = Object.keys(liste[selection.value]);
		let SelectGroupe = document.getElementById(IdGrp);
		SelectGroupe.style.display = "block";
		SelectGroupe.innerHTML = "";
		let contenu = [];
		for (var i = 0; i < groupes.length; i++) {
			contenu[i] = "<option value='"+groupes[i]+"'>"+groupes[i]+"</option>";
		}
		SelectGroupe.innerHTML = contenu;
		return true;
	}
}

function AffMoreInfos(affall, selection, action = 1){
	let listesChamps = document.getElementsByClassName('MoreInfo');
	if (affall == false) {
		if (action == false) {
			selection.setAttribute('onclick','AffMoreInfos(false, this, true)');
			for (var i = 0; i < listesChamps.length; i++) {
				listesChamps[i].style.display = "none";
			}
		} else {
			selection.setAttribute('onclick','AffMoreInfos(false, this, false)');
			for (var i = 0; i < listesChamps.length; i++) {
				listesChamps[i].style.display = "block";
			}
		}
		
		return true;
	}
	if (affall == true) {
		let idDIV = selection.id.substr(0,selection.id.length-3);
		console.log(document.getElementById(idDIV).style.display);
		if (document.getElementById(idDIV).style.display == "none") {
			document.getElementById(idDIV).style.display = "block";
		} else {
			document.getElementById(idDIV).style.display = "none";
		}
	}
}