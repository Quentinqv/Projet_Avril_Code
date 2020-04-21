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
					<a href="index.php"><img src="assets\img\logo.png"></a>
				</div>
				<nav>
					<ul id="navigation">
						<div class="menunav">
							<button class="navbtn">Outils</button>
							<div class="contentnav">
								<a href="visualisation.php">Visualisation</a>
								<a href="documentation.php">Documentation</a>
							</div>
						</div>
						<div class="menunav" id="admin">
							<button class="navbtn btndirect" onclick="document.location.href = 'statistiques.php'">Statistiques</button>
						</div>
					</ul>
					<div class="imgtop">
						<a href="profil.php"><img src="API\img\account.png" alt="loupe"></a>
					</div>
				</nav>
			</div>
		</div>
		<div id="page-connexion">
			<div id="inscription">
				<div id="inscription-gauche">
					<h1>Inscription</h1>
						<form action="inscription.php" method="post" id="inscription-1">
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
							<div class="captcha">
								<input type="checkbox" name="checkbox-inscription" id="checkbox-inscription"><label for="checkbox-inscription">Je ne suis pas un robot</label>
							</div>
							<button onclick="VerifForm(this)" id="button-inscrire">S'INSCRIRE</button>
						</form>
					<div id="separation"></div>
					<h3 onclick="AllerConnexion()">J'ai déjà un compte</h3>
				</div>
				<div class="inscription-image"></div>
			</div>
			<div id="connexion">
				<div class="inscription-image"></div>
				<form action="profil.php" method="post" id="connexion-droite">
					<h1>Connexion</h1>
					<input type="text" name="email" placeholder="Email">
					<div class="inscription-mdp">
						<input type="password" name="mdp" placeholder="Mot de passe">
						<button><img src="assets/img/oeil.png" alt="ERROR"/></button>
					</div>
					<div class="captcha">
						<input type="checkbox" name="checkbox-inscription" id="checkbox-connexion"><label for="checkbox-connexion">Je ne suis pas un robot</label>
					</div>
					<button onclick="VerifForm(this)" id="button-inscrire">SE CONNECTER</button>
					<h4 onclick="MDPOublie()">Mot de passe oublié ?</h4>
					<div id="separation"></div>
					<h3 onclick="AllerInscription()">S'inscrire</h3>
				</form>
			</div>
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
	</script>
	</body>
</html>