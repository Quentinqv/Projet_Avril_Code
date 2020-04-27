<?php
	session_start();
	if (!isset($_SESSION['nom'])) {
		$_SESSION['img'] = "account";
	}
	include 'signupInscription.php';
	if (!empty($_POST['nom'])) {
		$lst = array('nom', 'prenom', 'date', 'email', 'tel', 'adresse', 'filiere', 'groupe', 'mdp');
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
		<script src="script.js" type="text/javascript"></script>
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
					<a href="index.php"><img src="assets\img\logo.PNG" alt="ERROR"/></a>
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
						<a href="profil.php"><img src="API\img\<?php echo($_SESSION['img']); ?>.png" alt="PP"></a>
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
								<input type="text" name="nom" placeholder="Nom" class="champs-inscription">
								<input type="text" name="prenom" placeholder="Prénom" class="champs-inscription">
								<input type="date" name="date" class="champs-inscription">
							</div>
							<div id="adressePostale">
								<input type="text" name="adresse" placeholder="Adresse Postale" class="champs-inscription">
							</div>
							<div class="champs-alignes">
								<input type="text" name="email" placeholder="Email" class="champs-inscription">
								<input type="text" name="tel" placeholder="Téléphone 06.12.34.56.78" class="champs-inscription">
							</div>
							<div class="champs-alignes">
								<select name="filiere" id="filiere-select" onchange="AfficherGroupe(this, 'filiere-select', 'groupe-select')">
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
									<input type="password" name="mdp" placeholder="Mot de passe" onchange="document.getElementsByClassName('ErrorMDP')[0].style.display = 'none'" id="mdp1">
									<button type="button" onclick="mdpcache('mdp1')"><img src="assets/img/oeil2.png" alt="ERROR" id="mdp1IMG" /></button>
								</div>
								<div class="inscription-mdp">
									<input type="password" name="mdpverif" placeholder="Confirmation de Mot de passe" onchange="document.getElementsByClassName('ErrorMDP')[0].style.display = 'none'" id="mdp2">
									<button type="button" onclick="mdpcache('mdp2')"><img src="assets/img/oeil2.png" alt="ERROR" id="mdp2IMG" /></button>
								</div>
							</div>
							<p class="ErrorMDP">Les mots de passe ne correspondent pas.</p>
							<div class="captcha">
								<input type="checkbox" name="checkbox-inscription" id="checkbox-inscription"><label for="checkbox-inscription">Je ne suis pas un robot</label>
							</div>
							<button type="button" onclick="VerifForm('inscription')" id="button-inscrire">S'INSCRIRE</button>
						</form>
					<div id="separation"></div>
					<h3 onclick="AllerConnexion()">J'ai déjà un compte</h3>
				</div>
				<div class="inscription-image"></div>
			</div>
			<div id="connexion">
				<div class="inscription-image"></div>
				<form action="profil.php?login=try" method="post" id="connexion-droite">
					<h1>Connexion</h1>
					<input type="text" name="email" placeholder="Email" id="email-connexion">
					<div class="inscription-mdp">
						<input type="password" name="mdp" placeholder="Mot de passe" id="mdpConnexion">
						<button type="button" onclick="mdpcache('mdpConnexion')"><img src="assets/img/oeil2.png" alt="ERROR" id="mdpConnexionIMG" /></button>
					</div>
					<p class="ErrorMDP">Mot de passe incorect.</p>
					<div class="captcha">
						<input type="checkbox" name="checkbox-inscription" id="checkbox-connexion"><label for="checkbox-connexion">Je ne suis pas un robot</label>
					</div>
					<button type="button" onclick="VerifForm('connexion')" id="button-inscrire">SE CONNECTER</button>
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
	<?php
		if (isset($_GET['login'])) {
			if ($_GET['login'] == 'failed') {
				echo("<script type='text/javascript'> CheckConnexion(); </script>");
			}
		}
	?>
	</body>
</html>