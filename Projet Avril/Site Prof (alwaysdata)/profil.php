<?php
	session_start();
	if (empty($_SESSION['nom'])) {
		header('location:connexion.php?login=NotLogin');
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Connexion</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
		<link rel="stylesheet" href="https://use.typekit.net/aeb7isn.css"/>
		<script src="script.js"></script>
	</head>
	<body>
	<header>
		<div id="imgHeader">
			<a href="index.php"><img src="assets/img/logodepinfo.png" alt="ERROR"/></a>
		</div>
		<ul>
			<li><a href="trombinoscope.php">Trombinoscope</a></li>
			<li id="btn-inscription"><a href="index.php#formulaire-craft">Inscription</a></li>
			<li id="btn-connexion"><a href="connexion.php">Connexion</a></li>
			<li><a href="profil.php">Profil</a></li>
		</ul>
	</header>
	<main>
		<h1>Profil</h1>
		<div id="Profil">
			<div id="EtudiantSoloGauche">
				<div>
					<img src="assets/img/logo.png" alt="ERROR"/>
				</div>
			</div>
			<div id="EtudiantSoloDroite">
				<div>
					<p>Nom : </p><span><?php echo($_SESSION['nom']) ?></span>
				</div>
				<div>
					<p>Prenom : </p><span><?php echo($_SESSION['prenom']) ?></span>
				</div>
				<div>
					<p>Email : </p><span><?php echo($_SESSION['email']) ?></span>
				</div>
				<div>
					<p>Téléphone : </p><span><?php echo($_SESSION['tel']) ?></span>
				</div>
				<div>
					<p>Filière : </p><span><?php echo($_SESSION['filiere']) ?></span>
				</div>
			</div>
		</div>
		<div id="DivBtnDeco">
			<button type="button" onclick="document.location.href = 'index.php?login=logout'" id="BtnDeco">Se déconnecter</button>
		</div>
	</main>
	<footer>
		<div id="logo-rs-footer">
			<a href="https://www.u-cergy.fr/" target="blank"><img src="assets/img/globe.png" alt="ERROR"/></a>
			<a href="https://www.linkedin.com/edu/school?id=12494" target="blank"><img src="assets/img/LinkedIn.png" alt="ERROR"/></a>
			<a href="https://twitter.com/UniversiteCergy" target="blank"><img src="assets/img/twitter.png" alt="ERROR"/></a>
		</div>
		<div id="liens-footer">
			<a>Université de Cergy-Pontoise</a>
			<a>Département Informatique</a>
			<a>Conditions gérérales</a>
			<a>Mentions légales</a>
		</div>
	</footer>
	<?php
		if (isset($_SESSION['nom'])) {
			if ($_SESSION['nom'] != '') {
				echo('<script>
					document.getElementById(\'btn-inscription\').style.display = "none";
					document.getElementById(\'btn-connexion\').style.display = "none";
					document.getElementById(\'formulaire-craft\').style.display = "none";
					</script>
					');
			}
		}
	?>
	</body>
</html>