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

		<div id="introduction">
			<div id="quis_position">
				<h2>UTILISATION</h2>
				<h1>Outils disponibles</h1>
				<div id="box_quis">
					<div class="autem">
						<img src="assets\img\orange.png" alt="ERROR">
						<p>Visualiser</p>
						<div class="bas_autem">
							<h3>Aperçu de l'API disponible</h3>
							<button onclick="document.location.href = 'visualisation.php'">+</button>
						</div>
					</div>	
					<div class="autem">
						<img src="assets\img\key_img.png" alt="ERROR">
						<p>S'inscrire</p>
						<div class="bas_autem">
							<h3>Demander sa clé d'API</h3>
							<button>+</button>
						</div>
					</div>
					<div class="autem">
						<img src="assets\img\documentation.jpg" alt="ERROR">
						<p>Documentation</p>
						<div class="bas_autem">
							<h3>Voir la documentation de l'API et son utilisation</h3>
							<button onclick="document.location.href = 'documentation.php'">+</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div id="mollitia">
			<div id="mollitia_gauche">
				<img src="assets/img/mac.png" alt="ERROR"/>
			</div>
			<div id="mollitia_droite">
				<h5 class="mollitia_title">UTILISATION</h5>
				<h2 class="mollitia_title2">Une API façonnée en JSON</h2>
				<p class="mollitia_text">Cette API a été créée dans le cadre d'un projet ayant pour but de manipuler le format JSON de manière approfondie, c'est-à-dire aborder la création d'un fichier JSON.</p>
				<button id="mollitia_button" onclick="document.location.href = 'visualisation.php'">Explorer</button>
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