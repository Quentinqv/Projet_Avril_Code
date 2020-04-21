<?php
	include 'signupInscription.php';
	if (!empty($_POST['nom'])) {
		$lst = array('nom', 'prenom', 'date', 'tel', 'email', 'adresse', 'filiere', 'groupe', 'mdp');
		Inscription($lst, TRUE);
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="assets\css\reset.css">
		<link rel="stylesheet" type="text/css" href="assets\css\style.css">
		<title>API Projet</title>
	</head>
	<body>
		<?php
			function TrierFiliere(){
				$json = file_get_contents("API/filiere.json");
				$json = json_decode($json, true);
				return $json;
			}

			function AfficherFiliere($liste){
				foreach ($liste as $key => $value) {
					echo("<option value=\"$key\">$key</option>");
				}
			}
		?>
		<header>
		</header>
		<div class="bg_commodi">
			<div id="header">
				<div class="logo">
					<img src="assets\img\logo.png">
				</div>
				<ul>
					<div class="menunav">
						<button class="navbtn btndirect" onclick="document.location.href = 'index.php'">Home</button>
					</div>
					<div class="menunav">
						<button class="navbtn">Outils</button>
						<div class="contentnav">
							<a href="visualisation.php">Visualisation</a>
							<a href="documentation.php">Documentation</a>
						</div>
					</div>
					<div class="menunav">
						<button class="navbtn">Compte</button>
						<div class="contentnav">
							<a href="inscription.php">Inscription</a>
							<a href="connexion.php">Connexion</a>
						</div>
					</div>
					<div class="menunav" id="admin">
						<button class="navbtn">Administration</button>
						<div class="contentnav">
							<a href="modification.php">Modification</a>
							<a href="statistiques.php">Statistiques</a>
						</div>
					</div>
				</ul>
				<div class="imgtop">
					<img src="assets\img\Loupe.png" alt="loupe">
					<img src="assets\img\menu.png" alt="menu">
				</div>
			</div>
		</div>
		<div id="inscription">
			<div id="inscription-gauche">
				<h1>Inscription</h1>
				<div id="inscription-1">
					<div class="champs-alignes">
						<input type="text" name="nom" placeholder="Nom">
						<input type="text" name="prenom" placeholder="Prénom">
						<input type="date" name="date">
					</div>
					<div id="adressePostale">
						<input type="text" name="adresse" placeholder="Adresse Postale">
					</div>
					<div class="champs-alignes">
						<input type="text" name="email" placeholder="Email">
						<input type="text" name="tel" placeholder="Téléphone 06.12.34.56.78">
					</div>
					<div class="champs-alignes">
						<select name="filiere" id="filiere-select" onchange="AfficherGroupe(this)">
							<option value="filiere">Filière</option>
							<?php
								$liste = TrierFiliere();
								AfficherFiliere($liste);
							?>
						</select>
						<select name="groupe" id="groupe-select">
							<option value="Groupe">Groupes</option>
						</select>
					</div>
					<div id="mots-de-passe">
						<div class="inscription-mdp">
							<input type="password" name="mdp" placeholder="Mot de passe">
							<button><img src="assets/img/oeil.png" alt="ERROR"/></button>
						</div>
						<div class="inscription-mdp">
							<input type="password" name="mdpverif" placeholder="Confirmation de Mot de passe">
							<button><img src="assets/img/oeil.png" alt="ERROR"/></button>
						</div>
					</div>
					<div id="captcha">
						<input type="checkbox" name="checkbox-inscription" id="checkbox-inscription"><label for="checkbox-inscription">Je ne suis pas un robot</label>
					</div>
					<button onclick="InscriptionSuivant(this)" id="button-inscrire">S'INSCRIRE</button>
				</div>
				<div id="separation"></div>
				<h3 onclick="AllerConnexion()">J'ai déjà un compte</h3>
			</div>
			<div id="inscription-image">

			</div>

			<!-- <form action="inscription.php" method="post" id="Inscription_Formulaire">
			<h1>Inscription</h1>
			<div id="inscription-haut">
				<div class="inscription-champs">
					<input type="text" name="nom" class="champs-inscription" placeholder="Nom">
					<input type="text" name="prenom" class="champs-inscription" placeholder="Prénom">
					<input type="text" name="date" class="champs-inscription" placeholder="Date de naissance 01/02/2000">
					<input type="text" name="tel" class="champs-inscription" placeholder="Téléphone 06.12.34.56.78">
				</div>
				<div id="inscription-image">
					<img src="API/img/account.png" alt="ERROR"/>
					<button>Ajouter une image</button>
				</div>
				<div class="inscription-champs">
					<input type="text" name="email" class="champs-inscription" placeholder="Email">
					<input type="text" name="adresse" class="champs-inscription" placeholder="Adresse Postale">
					<select name="filiere" id="filiere-select" onchange="AfficherGroupe(this)">
						<option value="filiere">>----------- Filière -----------<</option>
						<?php
							$liste = TrierFiliere();
							AfficherFiliere($liste);
						?>
					</select>
					<select name="groupe" id="groupe-select">
						<option value="Groupe">>----------- Groupe -----------<</option>
					</select>
				</div>
			</div>
			<div id="inscription-bas">
				<div id="inscription-mdp">
					<input type="password" name="mdp" placeholder="Mot de passe">
					<button><img src="assets/img/oeil.png" alt="ERROR"/></button>
				</div>
				<div id="inscription-captcha">
					<input type="checkbox" name="checkbox-inscription" id="checkbox-inscription"><label for="checkbox-inscription">Je ne suis pas un robot</label>
				</div>
				<button type="button" onclick="VerifForm()" id="button-inscrire">S'inscrire</button>
			</div>
			</form> -->
		</div>
	<footer>
		<div id="footer_haut">
			<div class="footer_case">
				<h6 class="footer_title">Le projet</h6>
				<p class="footer_text">Le projet d'avril est une création d'API, le principe est de mettre en place et d'utiliser le format JSON afin de mettre à disposition une API.</p>
			</div>
			<div class="footer_case">
				<h6 class="footer_title">Plan</h6>
				<ul id="temporibus_liste">
					<li>Inscription</li>
					<li>Demander sa clé</li>
					<li>Documentation</li>
					<li>Utilisation</li>
				</ul>
			</div>
			<div class="footer_case">
				<h6 class="footer_title">Informations</h6>
				<ul id="sintet_liste">
					<li class="footer_text"><img src="assets/img/ping.png" alt="ERROR"/>Université de Cergy-Pontoise</li>
					<li class="footer_text"><img src="assets/img/phone.png" alt="ERROR"/>+33 6.51.24.32.66</li>
					<li class="footer_text"><img src="assets/img/mail.png" alt="ERROR"/>quentin.vitoux@gmail.com</li>
				</ul>
			</div>
			<div class="footer_case">
				<h6 class="footer_title">Liens utiles</h6>
				<ul id="molestiae_liste">
					<li><a href="index.php">Accueil</a></li>
					<li><a href="inscription.php">Inscription</a></li>
					<li><a href="documentation.php">Documentation</a></li>
					<li><a href="visualisation.php">Visualisation</a></li>
				</ul>
			</div>
		</div>
		<div id="footer_bas">
			<p class="footer_copyright">Copyright 2020. All Rights Reserved.</p>
		</div>
	</footer>
	<script type="text/javascript">
		function VerifForm(){
			var champs = document.getElementsByClassName('champs-inscription');
			for (var i = 0; i < champs.length; i++) {
				var etat = true;
				if (champs[i] == "") {
					etat = false;
				}
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
	</script>
	</body>
</html>