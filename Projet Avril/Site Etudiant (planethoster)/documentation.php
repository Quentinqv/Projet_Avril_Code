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
		<div id="IntroVisualisation">
			<h2>DOCUMENTATION</h2>
			<h1>Documentation de l'API</h1>
			<p>Ici se présente toute la documentation de l'API.</p>
			<button class="bouton_orange" onclick="document.location.href = 'index.php#introduction'">En savoir plus</button>
		</div>
	</div>
	<div id="Documentation">
		<h4>Rappel des options rapides disponibles</h4>
		<?php
			echo('<ul>');
			$file = fopen("options.txt", "r");
			$ligne = fgetcsv($file);
			foreach ($ligne as $key => $value) {
				echo("<li title='Voir la doc'><code onclick=\"Redirig(this)\">$value</code></li>");
			}
			echo('</ul>');
		?>
		<h4>Informations</h4>
		<p class="expl_json">Les données récupérées sont au format JSON.</p>
		<h5>Récupération des données</h5>
		<div id="recup_donnees">
			<p>La récupération des données se font grâce à deux fonctions :</p>
				<ol class="list_fct">
					<li>$json = file_get_contents('CHEMIN_JSON');</li>
					<li>$json = json_decode($json);</li>
				</ol>
			<p>Cette methode permet de récupérer les données sous forme d'objet. Ajouter TRUE comme deuxième paramètre à <span class="aff_donnees_code">json_decode($json, true)</span> permet de le transformer en tableau associatif.</p>
			<p class="chemin_json">CHEMIN_JSON correspond à :</p>
			<a class="lien" href="http://localhost/paris.json">http://localhost/paris.json</a>
		</div>
		<h5>Affichage des données</h5>
		<div id="aff_donnees">
			<p>Si le fichier récupéré est sous forme d'objet:</p>
			<p class="aff_donnees_code">$json->legumes->concombre</p>
			<p>Si c'est un tableau associatif:</p>
			<p class="aff_donnees_code">$json['legumes']['concombres']</p>
		</div>
		<h5>Liste des paramètres retournés</h5>
		<div id="liste_infos">
			<ul class="infos1">
				<li id="test1"><code>test1</code> Parametre de la météo</li>
				<li id="test1"><code>test1</code> Parametre de la météo</li>
				<li id="test1"><code>test1</code> Parametre de la météo</li>
			</ul>
			<ul class="infos2">
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
			</ul>
			<ul class="infos1">
				<li id="test1"><code>test1</code> Parametre de la météo</li>
				<li id="test1"><code>test1</code> Parametre de la météo</li>
				<li id="test1"><code>test1</code> Parametre de la météo</li>
			</ul>
			<ul class="infos2">
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
			</ul>
			<ul class="infos3">
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
				<li id="test2"><code>test2</code> Parametre de la météo</li>
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