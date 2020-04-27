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
	if (isset($_GET['filiere']) && !empty($_POST['filiere']) || isset($_GET['Etudiant']) && $_GET['Etudiant'] == 'TRUE') {
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
			<div id="DivSearchName">
				<button type="button" onclick="AffSearchName()" id="BtnEtu">Rechercher un étudiant</button>
				<form id="SearchName" action="trombinoscope.php" method="post">
					<input type="text" name="nom" placeholder="Nom" id="nom">
					<input type="text" name="prenom" placeholder="Prenom" id="prenom">
					<input type="text" name="email" placeholder="Email" id="email">
					<button type="button" onclick="CheckSearchEtudiant()">Chercher</button>
				</form>
				<p id="ErrorSearch">Veuillez renseigner un champs.</p>
			</div>
		</div>
		<div id="mosaique">
			<?php
				if (isset($_POST['filiere']) || isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['email'])) {
					AfficherJson($json);
				}

				function AffEtudiantSolo($json){
					echo("
						<div id=\"EtudiantSolo\">
							<div id=\"EtudiantSoloGauche\">
								<img src=".$json[0]['IMG'].">
							</div>
							<div id=\"EtudiantSoloDroite\">
								<div>
									<p>Nom : </p><span>".$json[0]['Nom']."</span>
								</div>
								<div>
									<p>Prenom : </p><span>".$json[0]['Prenom']."</span>
								</div>
								<div>
									<p>Date de naissance : </p><span>".$json[0]['Date_de_naissance']."</span>
								</div>
								<div>
									<p>Email : </p><span>".$json[0]['Email']."</span>
								</div>
								<div>
									<p>Téléphone : </p><span>".$json[0]['Telephone']."</span>
								</div>
								<div>
									<p>Adresse : </p><span>".$json[0]['Adresse']."</span>
								</div>
								<div>
									<p>Filière : </p><span>".$json[0]['Filiere']."</span>
								</div>
								<div>
									<p>Groupe : </p><span>".$json[0]['Groupe']."</span>
								</div>
								<div>
									<p>Dernière connexion : </p><span>".$json[0]['Derniere_connexion']."</span>
								</div>
							</div>
						</div>
						");
				}
			?>
			<!-- <div id="EtudiantSolo">
				<div id="EtudiantSoloGauche">
					<img src="https://vitoux-quentin.yo.fr/API/API/img/103_PIGNON.png">
				</div>
				<div id="EtudiantSoloDroite">
					<div>
						<p>Nom : </p><span>Le nom</span>
					</div>
					<div>
						<p>Prenom : </p><span>Le nom</span>
					</div>
					<div>
						<p>Date de naissance : </p><span>Le nom</span>
					</div>
					<div>
						<p>Email : </p><span>Le nom</span>
					</div>
					<div>
						<p>Téléphone : </p><span>Le nom</span>
					</div>
					<div>
						<p>Adresse : </p><span>Le nom</span>
					</div>
					<div>
						<p>Filière : </p><span>Le nom</span>
					</div>
					<div>
						<p>Groupe : </p><span>Le nom</span>
					</div>
					<div>
						<p>Dernière connexion : </p><span>Le nom</span>
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