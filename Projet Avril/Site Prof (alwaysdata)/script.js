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

function MettreListe(){
	document.getElementById('btn-liste').style.display = 'none';
	document.getElementById('btn-mosaique').style.display = 'block';
	document.getElementById('infos-btn').style.display = 'none';
	let divGrp = document.getElementsByClassName('mosaiqueGroupe')[0];
	divGrp.style.flexDirection = "column";
	let Etudiant = document.getElementsByClassName('EachStudent');
	let legende = Etudiant[0].cloneNode(true);
	legende.style.backgroundColor = '#111111';
	legende.getElementsByTagName('h3')[0].innerHTML = 'NOM';
	legende.getElementsByTagName('h3')[0].style.marginLeft = '10px';
	legende.getElementsByTagName('h4')[0].innerHTML = 'Prenom';
	legende.getElementsByTagName('img')[0].id = 'imgemail';
	legende.getElementsByClassName('MoreInfo')[0].id = 'moreinfoemail';
	legende.getElementsByClassName('MoreInfo')[0].getElementsByTagName('p')[0].innerHTML = 'Date de naissance';
	legende.getElementsByClassName('MoreInfo')[0].getElementsByTagName('p')[1].innerHTML = 'Email';
	legende.getElementsByClassName('MoreInfo')[0].getElementsByTagName('p')[2].innerHTML = 'Adresse';
	legende.getElementsByClassName('MoreInfo')[0].getElementsByTagName('p')[3].innerHTML = 'Dernière Connexion';
	legende.getElementsByClassName('MoreInfo')[0].getElementsByTagName('p')[3].style.marginRight = '10px';
	divGrp.prepend(legende);
	for (var i = 0; i < Etudiant.length; i++) {
		Etudiant[i].style.width = "100%";
		Etudiant[i].style.justifyContent = "space-between";
		Etudiant[i].style.flexDirection = "row";
		Etudiant[i].style.textAlign = 'left';
		Etudiant[i].style.height = '40px';
		Etudiant[i].style.borderBottom = 'solid 1px #EAA63A';
		Etudiant[i].getElementsByTagName('h3')[0].style.width = '10%';
		Etudiant[i].getElementsByTagName('h4')[0].style.width = '10%';
		Etudiant[i].getElementsByTagName('img')[0].style.display = 'none';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.display = 'flex';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.flexDirection = 'row';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.width = '80%';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.justifyContent = "space-between";
	}
}

function MettreMosaique(){
	document.getElementById('btn-liste').style.display = 'block';
	document.getElementById('btn-mosaique').style.display = 'none';
	document.getElementById('infos-btn').style.display = 'block';
	let divGrp = document.getElementsByClassName('mosaiqueGroupe')[0];
	divGrp.style.flexDirection = "row";
	let Etudiant = document.getElementsByClassName('EachStudent');
	Etudiant[0].remove();
	for (var i = 0; i < Etudiant.length; i++) {
		Etudiant[i].style.width = "200px";
		Etudiant[i].style.justifyContent = "start";
		Etudiant[i].style.flexDirection = "column";
		Etudiant[i].style.textAlign = 'center';
		Etudiant[i].style.height = 'auto';
		Etudiant[i].style.borderBottom = 'none';
		Etudiant[i].getElementsByTagName('h3')[0].style.width = 'auto';
		Etudiant[i].getElementsByTagName('h4')[0].style.width = 'auto';
		Etudiant[i].getElementsByTagName('img')[0].style.display = 'block';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.display = 'none';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.flexDirection = 'none';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.width = 'auto';
		Etudiant[i].getElementsByClassName('MoreInfo')[0].style.justifyContent = "none";
	}
}