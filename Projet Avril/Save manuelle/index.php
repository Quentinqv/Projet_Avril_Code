<!DOCTYPE html>
<html lang="fr">
	<head>
		<title>Accueil Administration</title>
		<meta charset="utf-8"/>
		<link rel="stylesheet" type="text/css" href="assets/css/reset.css">
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link rel="stylesheet" href="https://use.typekit.net/aeb7isn.css">
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
		<ul>
			<li><a href="trombinoscope.php">Trombinoscope</a></li>
			<li><a href="inscription.php">Inscription</a></li>
			<li><a href="index.php#connexion">Connexion</a></li>
		</ul>
	</header>
		<div id="dl-craft">
			<div id="dl-craft-gauche">
				<img src="assets/img/logodepinfo.png" alt="ERROR"/>
				<p>Site réservé à l'administration de l'Université de Cergy-Pontoise.</p>
				<button onclick="document.location.href = 'index.php#connexion'">Se connecter</button>
			</div>
			<div id="dl-craft-droite">
				<img src="assets/img/logo.png" alt="ERROR"/>
			</div>
		</div>
	<main>
		<h1>Trombinoscope</h1>
		<div class="div-craft">
			<div class="div-craft-gauche">
				<img src="assets/img/appCraft.png" alt="ERROR"/>
			</div>
			<div class="div-craft-droite">
				<h2>mosaïque</h2>
				<p>Une mosaïque des étudiants est disponible pour toutes les classes du département informatique.</p>
				<p class="intro-liste">Plusieurs informations sont disponibles :</p>
				<div id="liste-infos">
					<ul>
						<li>Nom</li>
						<li>Prenom</li>
						<li>Date de naissance</li>
						<li>Email</li>
					</ul>
					<ul>
						<li>Téléphone</li>
						<li>Adresse</li>
						<li>Dernière connexion</li>
						<li>Nombre de connexion</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="valeurs-craft">
			<div>
				<h2>les outils</h2>
			</div>
			<div id="valeurs-blocs-craft">
				<div class="valeurs-bleu">
					<h3>recherche</h3>
					<p>La dernière recherche est disponible rapidement permettant un accès instantané aux professeurs.</p>
				</div>
				<div class="valeurs-rouge">
					<h3>Liste</h3>
					<p>Le trombinoscope propose plusieurs choix d'affichage, il en propose en réalité deux. Le premier est une mosaïque avec l'image de chaque personne, et le deuxième est une liste. Cet affichage est plus pratique pour observer les informations rapidement comme les dernières connexions.</p>
				</div>
				<div class="valeurs-bleu">
					<h3>Imprimer</h3>
					<p>Le trombinoscope offre la possiblité de l'imprimer et de l'enregistrer au format PDF. Ici encore sous plusieurs formats.</p>
				</div>
			</div>
		</div>
		<div id="formulaire-craft">
			<div>
				<h2>s'enregistrer</h2>
			</div>
			<form action="trombinoscope.php?create=try" method="post" id="formulaire">
				<div id="form-haut">
					<div id="form-gauche">
						<input type="text" name="nom" placeholder="Nom">
						<select name="filiere" id="filiere-select">
							<option value="filiere">Filière Principale</option>
							<?php
								$liste = TrierFiliere();
								AfficherFiliere($liste);
							?>
						</select>
					</div>
					<div id="form-droite">
						<input type="text" name="prenom" placeholder="Prénom">
						<input type="text" name="tel" placeholder="Numéro de téléphone">
					</div>
				</div>
				<div id="form-bas">
					<input type="text" name="mail" placeholder="Adresse mail">
					<input type="text" name="mdp" placeholder="Mot de passe">
				</div>
				<button>Créer</button>
			</form>
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