<?php
	include 'API/functionAPI.inc.php';
	$json = TrierFiliere('API/');
	genereJSON($json, array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea', 'Derniere_connexion', 'Nb_total_de_connexion'),'./');
	session_start();
	if (!isset($_SESSION['nom'])) {
		$_SESSION['img'] = "account";
	}
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css"/>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css"/>
		<title>API Projet</title>
	</head>
	<body>
	<header>
	</header>
	<div id="DivIntroVisu">
		<div id="header">
			<div class="logo">
				<a href="index.php"><img src="assets/img/logo.PNG" alt="ERROR"/></a>
			</div>
			<nav>
				<ul id="navigation">
					<li><a href="visualisation.php">Visualisation</a></li>
					<li><a href="documentation.php">Documentation</a></li>
					<li><a href="demandeCLE.php">Demander sa clé</a></li>
				</ul>
				<div class="imgtop">
					<a href="profil.php"><img src="API/img/<?php echo($_SESSION['img']); ?>.png" alt="PP"/></a>
				</div>
			</nav>
		</div>
		<div id="IntroVisualisation">
			<h2>DOCUMENTATION</h2>
			<h1>Documentation de l'API</h1>
			<p>Ici se présente toute la documentation de l'API.</p>
			<button class="bouton_orange" onclick="document.location.href = '#Documentation'">En savoir plus</button>
		</div>
	</div>
	<div id="Documentation">
		<h4>Rappel des options rapides disponibles</h4>
		<?php
			echo('<ul>');
			$file = fopen("API/options.txt", "r");
			$ligne = fgetcsv($file);
			unset($ligne[sizeof($ligne)-1]);
			foreach ($ligne as $key => $value) {
				echo("<li title='Voir la doc'><code onclick=\"Redirig(this)\">$value</code></li>");
			}
			echo('</ul>');
		?>
		<h4>Informations</h4>
		<p class="expl_json">Les données récupérées sont au format JSON.</p>
		<h5>Récupération des données</h5>
		<div id="recup_donnees">
			<p>La récupération des données se font grâce à deux fonctions en PHP :</p>
				<ol class="list_fct">
					<li>$json = file_get_contents('CHEMIN_JSON');</li>
					<li>$json = json_decode($json);</li>
				</ol>
			<p>Cette methode permet de récupérer les données sous forme d'objet. Ajouter TRUE comme deuxième paramètre à <span class="aff_donnees_code">json_decode($json, true)</span> permet de le transformer en tableau associatif.</p>
			<p class="chemin_json">CHEMIN_JSON correspond à :</p>
			<a class="lien" href="https://vitoux-quentin.yo.fr/API/API/API.php">https://vitoux-quentin.yo.fr/API/API/API.php?key=[YOURKEY]&amp;Nom=[NAME]</a>
			<p id="intro-param">Plusieurs paramètres peuvent être donnés afin d'avoir une meilleure visibilité ou des informations plus précises.</p>
			<ul class="liste-param">
				<li>Id</li>
				<li>Nom</li>
				<li>Prenom</li>
				<li>Date_de_naissance</li>
				<li>Email</li>
				<li>Telephone</li>
				<li>Adresse</li>
				<li>Filiere</li>
				<li>Groupe</li>
				<li>IMG</li>
				<li>Derniere_connexion</li>
				<li>Nb_total_de_connexion</li>
			</ul>
			<p>Si la filière et le groupe sont donnés, l'API retourne le groupe. Si le groupe n'est pas trouvé, toutes les filières sont retournées.</p>
			<p>Si l'argument <span class="aff_donnees_code">filiere=ALL</span>, alors la liste des filières ainsi que les groupes sont retournés.</p>
		</div>
		<h5>Affichage des données</h5>
		<div id="aff_donnees">
			<p>Si le fichier récupéré est sous forme d'objet:</p>
			<p class="aff_donnees_code">$json->L1-MIPI->A1</p>
			<p>Si c'est un tableau associatif:</p>
			<p class="aff_donnees_code">$json['L1-MIPI']['A1']</p>
		</div>
		<h5>Liste des paramètres retournés</h5>
		<div id="liste_infos">
			<ul class="infos1">
				<li id="L1-MIPI"><code>L1-MIPI</code> Contient tous les groupes de L1-MIPI</li>
			</ul>
			<ul class="infos2">
				<li id="A1"><code>A1</code> Contient les étudiants du groupe A1</li>
				<li id="A2"><code>A2</code> Contient les étudiants du groupe A2</li>
				<li id="A3"><code>A3</code> Contient les étudiants du groupe A3</li>
			</ul>
			<ul class="infos3">
				<li id="0"><code>0</code> Numéro de l'étudiant</li>
			</ul>
			<ul class="infos4">
				<li id="Id"><code>Id</code> Id unique de l'étudiant</li>
				<li id="Nom"><code>Nom</code> Nom</li>
				<li id="Prenom"><code>Prenom</code> Prénom</li>
				<li id="Date_de_naissance"><code>Date_de_naissance</code> Date de naissance</li>
				<li id="Email"><code>Email</code> Email</li>
				<li id="Telephone"><code>Telephone</code> Téléphone</li>
				<li id="Adresse"><code>Adresse</code> Adresse</li>
				<li id="Filiere"><code>Filiere</code> Filière</li>
				<li id="Groupe"><code>Groupe</code> Groupe</li>
				<li id="IMG"><code>IMG</code> Lien de l'image</li>
				<li id="Derniere_connexion"><code>Derniere_connexion</code> Date et heure de la dernière connexion</li>
				<li id="Nb_total_de_connexion"><code>Nb_total_de_connexion</code> Nombre total de connexion</li>
			</ul>
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
	<script>
		function Redirig(elt){
			texte = elt.innerHTML;
			document.location.href = "documentation.php#"+texte;
		}
	</script>
	</body>
</html>