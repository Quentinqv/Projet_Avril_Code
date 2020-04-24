<?php
	function generateKey(){
		$file = fopen("admin/keys.csv", "a+");
		$double = TRUE;
		while (!feof($file)) {
			$ligne = fgetcsv($file);
			if ($_POST['email'] == $ligne[0]) {
				$double = FALSE;
			}
		}
		if ($double == TRUE) {
			fputs($file, $_POST['email'].',');
			$key = uniqid();
			fputs($file, $key."\n");
		} else {
			fclose($file);
			return FALSE;
		}
		fclose($file);
		return $key;
	}

	function recupCle(){
		$file = fopen("admin/keys.csv", "r");
		while (!feof($file)) {
			$ligne = fgetcsv($file);
			if ($ligne[0] == $_POST['emailRecup']) {
				fclose($file);
				return $ligne[1];
			}
		}
		fclose($file);
		return FALSE;
	}
	session_start();
	if (!isset($_SESSION['nom'])) {
		$_SESSION['img'] = "account";
	}
	if (isset($_GET['key'])) {
		if ($_GET['key'] == 'created') {
			$key = generateKey();
		}
		if ($_GET['key'] == 'recup') {
			$keyRecup = recupCle();
		}
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
		<header>
		</header>
		<div id="DivIntroVisu">
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
			<div id="IntroVisualisation">
				<h2>DEMANDE</h2>
				<h1>Demander sa clé d'API</h1>
				<p>Demander sa clé afin de pouvoir utiliser l'API.</p>
				<button class="bouton_orange" onclick="document.location.href = '#DemandeCle'">En savoir plus</button>
			</div>
		</div>
		<div id="DemandeCle">
			<div id="cle-gauche">
				<form action="demandeCLE.php?key=created" method="post">
					<h2>Demandez votre clé</h2>
					<h3>Rentrez votre email pour recevoir votre clé</h3>
					<input type="text" name="email" placeholder="Entrez votre email">
					<button type="submit">Générer</button>
					<?php
						if (isset($_GET['key'])) {
							if ($_GET['key'] == 'created') {
								if (gettype($key) == "string")  {
									echo("<h4>Votre clé est : ".$key."</h4>");
								} else {
									echo("<h4>Cette adresse mail est déjà utilisée.</h4>");
								}
							}
						}
					?>
				</form>
			</div>
			<div id="cle-droite">
				<form action="demandeCLE.php?key=recup" method="post">
					<h2>Retrouvez votre clé</h2>
					<h3>Rentrez votre email pour retrouver votre clé</h3>
					<button type="submit">Retrouver</button>
					<input type="text" name="emailRecup" placeholder="Entrez votre email">
					<?php
						if (isset($_GET['key'])) {
							if ($_GET['key'] == 'recup') {
								if (gettype($keyRecup) == "string")  {
									echo("<h4>Votre clé est : ".$keyRecup."</h4>");
								} else {
									echo("<h4>Votre adresse n'a pas été trouvée</h4>");
								}
							}
						}
					?>
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
	</body>
</html>