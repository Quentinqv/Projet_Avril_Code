<?php
	session_start();
	include 'signupInscription.php';
	if (isset($_GET['modif'])) {
		if ($_GET['modif'] == 'change') {
			ModifInfos($_SESSION['id'],array("id","nom","prenom","date","email","tel","adresse","filiere","groupe","mdp","img","alea"));
		}
	}
	if (isset($_GET['login'])) {
		if ($_GET['login'] == "try") {
			Connexion(array('email', 'mdp'),array("id","nom","prenom","date","email","tel","adresse","filiere","groupe","mdp","img"),"NONE");
		}
	}
	if (!isset($_SESSION['nom'])) {
		header("location:inscription.php");
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
						<a href="profil.php"><img src="API\img\<?php echo($_SESSION['img']); ?>" alt="PP"></a>
					</div>
				</nav>
			</div>
		</div>
		<div id="profil">
			<h1>Profil</h1>
			<form action="profil.php?modif=change" method="post" id="profil-form" enctype="multipart/form-data">
				<div id="profil-image">
					<img src="API/img/<?php echo($_SESSION['img']); ?>" alt="ERROR"/>
					<input type="file" name="img_import" id="img_import">
				</div>
				<div id="profil-informations">
					<div class="infos">
						<p><span>Nom :</span> <span class="infos-php" id="span_nom"><?php echo($_SESSION['nom']); ?></span><input type="text" name="nom" id="input_nom" placeholder="Nouveau Nom" value="<?php echo($_SESSION['nom']); ?>"></p><button type="button" onclick="ChangeProfil('nom')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Prénom :</span> <span class="infos-php" id="span_prenom"> <?php echo($_SESSION['prenom']); ?></span><input type="text" name="prenom" id="input_prenom" placeholder="Nouveau Prénom" value="<?php echo($_SESSION['prenom']); ?>"></p><button type="button" onclick="ChangeProfil('prenom')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Date de naissance :</span class="infos-php"> <span id="span_date"><?php echo($_SESSION['date']); ?></span><input type="date" name="date" id="input_date" value="<?php echo($_SESSION['date']); ?>"></p><button type="button" onclick="ChangeProfil('date')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Email :</span> <span class="infos-php" id="span_email"><?php echo($_SESSION['email']); ?></span><input type="text" name="email" id="input_email" placeholder="Nouveau Email" value="<?php echo($_SESSION['email']); ?>"></p><button type="button" onclick="ChangeProfil('email')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Téléphone :</span> <span class="infos-php" id="span_tel"><?php echo($_SESSION['tel']); ?></span><input type="text" name="tel" id="input_tel" placeholder="Nouveau Numéro" value="<?php echo($_SESSION['tel']); ?>"></p><button type="button" onclick="ChangeProfil('tel')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Adresse :</span> <span class="infos-php" id="span_adresse"><?php echo($_SESSION['adresse']); ?></span><input type="text" name="adresse" id="input_adresse" placeholder="Nouvelle Adresse" value="<?php echo($_SESSION['adresse']); ?>"></p><button type="button" onclick="ChangeProfil('adresse')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Filière :</span> <span class="infos-php" id="span_filiere"><?php echo($_SESSION['filiere']); ?></span><input type="text" name="filiere" id="input_filiere" placeholder="Nouvelle Filière" value="<?php echo($_SESSION['filiere']); ?>"></p><button type="button" onclick="ChangeProfil('filiere')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Groupe :</span> <span class="infos-php" id="span_groupe"><?php echo($_SESSION['groupe']); ?></span><input type="text" name="groupe" id="input_groupe" placeholder="Nouveau Groupe" value="<?php echo($_SESSION['groupe']); ?>"></p><button type="button" onclick="ChangeProfil('groupe')"><img src="assets/img/edit.png"></button>
					</div>
					<div class="infos">
						<p><span>Mot de Passe :</span> <span class="infos-php" id="span_mdp">*****</span><input type="password" name="mdp" id="input_mdp" placeholder="Nouveau Mot de Passe"></p><button type="button" onclick="ChangeProfil('mdp')"><img src="assets/img/edit.png"></button>
					</div>
					<button id="Enregistrer-button" type="button" onclick="ValiderModif(['nom','prenom','date','email','tel','adresse','filiere','groupe','mdp'])">Enregistrer</button>
				</div>
			</form>
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