<?php
	session_start();
	if (!empty($_SESSION['nom'])) {
		header('location:profil.php');
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" href="https://use.typekit.net/aeb7isn.css">
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
	<header>
		<div id="imgHeader">
			<a href="index.php"><img src="assets/img/logodepinfo.png"></a>
		</div>
		<ul>
			<li><a href="trombinoscope.php">Trombinoscope</a></li>
			<li><a href="index.php#formulaire-craft">Inscription</a></li>
			<li><a href="connexion.php">Connexion</a></li>
			<li><a href="profil.php">Profil</a></li>
		</ul>
	</header>
	<main>
		<h1>Se connecter</h1>
		<form id="connexion-droite" action="trombinoscope.php?login=try" method="post">
			<input type="text" name="email" placeholder="Email" id="email-connexion">
			<div class="inscription-mdp">
				<input type="password" name="mdp" placeholder="Mot de passe" id="mdpConnexion">
				<button type="button" onclick="mdpcache('mdpConnexion')"><img src="assets/img/oeil2.png" alt="ERROR" id="mdpConnexionIMG" /></button>
			</div>
			<p id="ERRORmsg">Le mot de passe est incorrect.</p>
			<?php
				if (isset($_GET['login'])) {
					if ($_GET['login'] == 'failed') {
						echo('<script>document.getElementById("ERRORmsg").style.display = "block";</script>');
					}
				}
			?>
			<button type="button" onclick="VerifForm('connexion')">Se connecter</button>
		</form>
	</main>
	<footer>
		<div id="logo-rs-footer">
			<a href="https://www.u-cergy.fr/" target="blank"><img src="assets/img/globe.png"></a>
			<a href="https://www.linkedin.com/edu/school?id=12494" target="blank"><img src="assets/img/LinkedIn.png"></a>
			<a href="https://twitter.com/UniversiteCergy" target="blank"><img src="assets/img/twitter.png"></a>
		</div>
		<div id="liens-footer">
			<a>Université de Cergy-Pontoise</a>
			<a>Département Informatique</a>
			<a>Conditions gérérales</a>
			<a>Mentions légales</a>
		</div>
	</footer>
	<?php
		if (isset($_GET['login'])) {
			if ($_GET['login'] == 'failed') {
				echo('<script>document.getElementById("ERRORmsg").style.display = "block";</script>');
			}
			if ($_GET['login'] == 'NotLogin') {
				echo('<script>alert("Vous n\'êtes pas connecté !")</script>');
			}
		}
	?>
	</body>
</html>