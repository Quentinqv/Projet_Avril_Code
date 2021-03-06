<?php
	session_start();
	if (empty($_SESSION['nom'])) {
		header('location:connexion.php?login=NotLogin');
	}
	if (isset($_GET['create'])) {
		if ($_GET['create'] == 'try') {
			include 'functionLog.inc.php';
			Inscription(array('nom','prenom','filiere','tel','email'),FALSE);
		}
	}
	if (isset($_GET['login'])) {
		if ($_GET['login'] == 'try') {
			include 'functionLog.inc.php';
			Connexion(array('email','mdp'),array('id', 'nom', 'prenom', 'email', 'tel', 'filiere'),'NONE');
		}
	}

	#PARTIE API
	function GoAPI(){
		include 'functionAPI.inc.php';
		if (isset($_GET['lastSearch'])) {
			if ($_GET['lastSearch'] == 'go') {
				$arrayjson = AffJsonCookie($_COOKIE['LastSearch']);
				return $arrayjson;
			}
		}
		if ((isset($_GET['filiere']) && !empty($_POST['filiere']) || isset($_GET['Etudiant']) && $_GET['Etudiant'] == 'TRUE')) {
			if (isset($_POST['filiere']) && isset($_POST['groupe'])) {
				Cookie($_POST['filiere'].','.$_POST['groupe']);
			}
			$json = GetJson();
			return $json;
		}
	}
	$json = GoAPI();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Trombinoscope</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" media="screen"/>
		<link rel="stylesheet" href="impression/stylePrint.css" type="text/css" media="print"/>
		<link rel="stylesheet" href="https://use.typekit.net/aeb7isn.css"/>
		<script src="script.js"></script>
	</head>
	<body>
		<?php
			function TrierFiliere(){
				$json = file_get_contents("https://vitoux-quentin.yo.fr/API/API/filiere.json");
				return $json;
			}

			function AfficherFiliere($liste){
				foreach ($liste as $key => $value) {
					echo("<option value=\"$key\">$key</option>");
				}
			}

			$liste = json_decode(TrierFiliere());
		?>
		<script type="text/javascript">
			var json = <?php echo(TrierFiliere()) ?>;
		</script>
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
	<main id="mainTrombi">
		<h1>Trombinoscope</h1>
		<div id="choix-trombi">
			<h3>Choix :</h3>
			<form action="trombinoscope.php" method="post" id="form-trombi">
				<select name="filiere" id="filiere-select" onchange="AfficherFiliere(this,json,'groupe-select')">
					<option value="filiere">Filière</option>
					<option value="nomsgroupes">Noms + Groupes</option>
					<?php
						AfficherFiliere($liste);
					?>
				</select>
				<select name="groupe" id="groupe-select">
					<option value="Groupe">Groupes</option>
				</select>
				<button type="button" onclick="MettreMosaique()" id="btn-mosaique">MOSAÏQUE</button>
				<button type="button" onclick="MettreListe()" id="btn-liste">LISTE</button>
				<button type="button" id="infos-btn" onclick="AffMoreInfos(false, this, true)">PLUS D'INFOS</button>
				<button type="button" id="lastSearch-btn" onclick="document.location.href = 'trombinoscope.php?lastSearch=go'">DERNIERE RECHERCHE</button>
				<button type="button" onclick="window.print()" id="print-btn">IMPRIMER</button>
				<button type="button" id="chercher" onclick="ValidTrombi()">CHERCHER</button>
			</form>
			<p id="ERRORmsg">Veuillez choisir une filière et/ou un groupe.</p>
			<div id="DivSearchName">
				<button type="button" onclick="AffSearchName()" id="BtnEtu">Rechercher un étudiant</button>
				<form id="SearchName" action="trombinoscope.php" method="post">
					<input type="text" name="nom" placeholder="Nom" id="nom"/>
					<input type="text" name="prenom" placeholder="Prenom" id="prenom"/>
					<input type="text" name="email" placeholder="Email" id="email"/>
					<button type="button" onclick="CheckSearchEtudiant()">Chercher</button>
				</form>
				<p id="ErrorSearch">Veuillez renseigner un champs.</p>
			</div>
		</div>
		<div id="mosaique">
			<?php
				if (isset($_POST['filiere']) || isset($_POST['nom']) || isset($_POST['prenom']) || isset($_POST['email']) || isset($_GET['lastSearch']) && $_GET['lastSearch'] == 'go') {
					AfficherJson($json);
					echo('<script>document.getElementById("print-btn").style.display = "block";
						document.getElementById("infos-btn").style.display = "block";</script>');
				}
			?>
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
					</script>
					');
			}
		}
		if (isset($_COOKIE['lastSearch'])) {
			if (!empty($_COOKIE['lastSearch'])) {
				echo('<script>
					document.getElementById(\'lastSearch-btn\').style.display = "block";
					</script>
					');
			} else {
				echo('<script>
					document.getElementById(\'lastSearch-btn\').style.display = "none";
					</script>
					');
			}
		}
		if (isset($_GET['Etudiant'])) {
			echo("<script>
				document.getElementById('print-btn').style.display = 'none';
				document.getElementById('btn-liste').style.display = 'none';
				</script>");
		}
		if (isset($_GET['filiere'])) {
			if ($_POST['filiere'] == 'nomsgroupes') {
				echo("<script>
				document.getElementById('btn-liste').style.display = 'none';
				</script>");
			}
		}
	?>
	</body>
</html>