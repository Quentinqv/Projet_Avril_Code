<?php
	session_start();
	if (isset($_GET['create'])) {
		if ($_GET['create'] == 'try') {
			include 'signupInscription.php';
			Inscription(array('nom','prenom','filiere','tel','email'),FALSE);
		}
	}
	if (isset($_GET['login'])) {
		if ($_GET['login'] == 'try') {
			include 'signupInscription.php';
			Connexion(array('email','mdp'),array('id', 'nom', 'prenom', 'email', 'tel', 'filiere'),'NONE');
		}
	}

	#PARTIE API
	if (isset($_GET['filiere']) && !empty($_POST['filiere'])) {
		include 'functionAPI.php';
		$json = GetJson();
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Trombinoscope</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" href="https://use.typekit.net/aeb7isn.css">
		<script src="script.js" type="text/javascript"></script>
	</head>
	<body>
		<?php
			function TrierFiliere(){
				$json = file_get_contents("admin/filiere.json");
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
	<main id="mainTrombi">
		<h1>Trombinoscope</h1>
		<div id="choix-trombi">
			<h3>Choix :</h3>
			<form action="trombinoscope.php" method="post" id="form-trombi">
				<select name="filiere" id="filiere-select" onchange="AfficherGroupe(this, 'filiere-select', 'groupe-select')">
					<option value="filiere">Filière</option>
					<option value="nomsgroupes">Noms + Groupes</option>
					<?php
						$liste = TrierFiliere();
						AfficherFiliere($liste);
					?>
				</select>
				<select name="groupe" id="groupe-select">
					<option value="Groupe">Groupes</option>
				</select>
				<button>MOSAÏQUE</button>
				<button>LISTE</button>
				<button type="button" id="chercher" onclick="ValidTrombi()">CHERCHER</button>
			</form>
			<p id="ERRORmsg">Veuillez choisir une filière et/ou un groupe.</p>
		</div>
		<?php
			function AffStudent($json){
				echo("
					<div class=\"mosaiqueGroupe\">
					");
				foreach ($json as $key => $value) {
					echo("
						<div class=\"EachStudent\">
						<img src=".$value['IMG']." alt=\"ERROR\"/>
						<h3>".$value['Nom']."</h3>
						<h4>".$value['Prenom']."</h4>
						<div class=\"MoreInfo\">
							<h5>".$value['Date_de_naissance']."</h5>
							<h5>".$value['Email']."</h5>
							<h5>".$value['Adresse']."</h5>
							<h5>".$value['Derniere_connexion']."</h5>
						</div>
					</div>
						");
				}
				echo("
					</div>
					");
			}

			function AffFiliere($json){
				$groupes = array_keys($json[0]);
				echo("
					<h2>Filiere : ".$_POST['filiere']."</h2>
					");
				foreach ($json[0] as $key => $value) {
					echo("<h2 class=\"IntroGroupe\">Groupe : ".$value[0]['Groupe']."</h2>");
					AffStudent($value);
				}
				echo("</div>");
			}
		?>
		<div id="mosaique">
			<?php
				AffFiliere($json);
			?>
			<!-- <h2>Filiere : LaFiliere</h2>
			<h2 class="IntroGroupe">Groupe : LeGroupe</h2>
			<div class="mosaiqueGroupe">
				<div class="EachStudent">
					<img src="https://vitoux-quentin.yo.fr/API/API/img/account.png" alt="ERROR"/>
					<h3>NOM</h3>
					<h4>Prenom</h4>
					<div class="MoreInfo">
						<h5>Date de naissance</h5>
						<h5>email</h5>
						<h5>adresse</h5>
						<h5>derniere connexion</h5>
					</div>
				</div>
			</div> -->
		</div>
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
	</body>
</html>