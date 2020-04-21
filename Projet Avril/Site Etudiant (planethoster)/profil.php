<?php
	session_start();
	if (!isset($_SESSION['nom'])) {
		header("location:inscription.php");
	}
	include 'signinInscription.php';
	Connexion(array('email', 'mdp'),array("id","nom","prenom","date","email","tel","adresse","filiere","groupe","mdp","img"));
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
						<a href="profil.php"><img src="API\img\account.png" alt="loupe"></a>
					</div>
				</nav>
			</div>
			<div class="commodi">
				<h2>VITOUX QUENTIN</h2>
				<h1>Projet API (Avril 2020)</h1>
				<p>Site WEB de Vitoux Quentin, LPI-WS, Université de Cergy-Pontoise, présentant le projet d'avril 2020</p>
				<div class="bouton">	
					<button class="bouton_orange" onclick="document.location.href = 'index.php#introduction'">En savoir plus</button>
					<button class="bouton_transp" onclick="document.location.href = 'visualisation.php'">Essayer</button>
				</div>
			</div>
		</div>
		<div id="profil">
			<h1>Profil</h1>
			<div id="profil-image">
				<img src="API/img/account.png" alt="ERROR"/>
				<button type="button" onclick="document.location.href = 'deconnexion.php'">Changer l'image</button>
			</div>
			<div id="profil-informations">
				
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
	</body>
</html>