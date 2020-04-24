<?php
	include 'API/functionAPI.php';
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
			<h2>VISUALISATION</h2>
			<h1>Aperçu de l'API</h1>
			<p>Cette page permet de visualiser l'API ainsi que d'accéder rapidement à la documentation de grandes parties en survolant un point précis.</p>
			<button class="bouton_orange" onclick="document.location.href = '#Visualisation'">En savoir plus</button>
		</div>
	</div>
	<div id="Visualisation">
		<h3>Visualisation de l'API</h3>
		<div>
			<?php
				function AffJson($link){
					$json = file_get_contents($link);
					$json = json_decode($json, true);
					$lstInfos = array();
					echo("<pre id='affjson'>");
					echo("<h1 onclick='document.location.href = \"index.php\"'>$link</h1>");
					foreach ($json as $key => $value) {
						if (is_array($value)) {
							foreach ($value as $key2 => $value2) {
								if (is_array($value2)) {
									foreach ($value2 as $key3 => $value3) {
										if (is_array($value2)) {
											if (is_array($value3)) {
												foreach ($value3 as $key4 => $value4) {
													$value2[$key3]['<span class="link4" id="'.$key4.'" onclick="Redirig(this)" title=\'Voir la doc\'>'.$key4.'</span>'] = $value3[$key4];
													array_push($lstInfos, $key4);
													unset($value2[$key3][$key4]);
												}
											}
										}
										$value[$key2]['<span class="link3" id="'.$key3.'" title=\'Voir la doc\'>'.$key3.'</span>'] = $value2[$key3];
										unset($value[$key2][$key3]);
									}
								}
								$json[$key]['<span class="link" id="'.$key2.'" onclick="Redirig(this)" title=\'Voir la doc\'>'.$key2.'</span>'] = $value[$key2];
								array_push($lstInfos, $key2);
								unset($json[$key][$key2]);
							}
						}
						$json['<span class="link2" id="'.$key.'" onclick="Redirig(this)" title=\'Voir la doc\'>'.$key.'</span>'] = $json[$key];
						array_push($lstInfos, $key);
						unset($json[$key]);
					}
					print_r($json);
					echo("</pre>");
					$lstInfos = array_unique($lstInfos);
					return $lstInfos;
				}

				function AffInfos($lst){
					echo('<div id="InfosVisu">');
					echo('<h4>Voici quelques informations disponibles grâce à l\'API.</h4>');
					echo('<ul>');
					$file = fopen("API/options.txt", "w");
					foreach ($lst as $key => $value) {
						echo("<li title='Voir la doc'><code onclick=\"Redirig(this)\">$value</code></li>");
						if ($key != sizeof($lst) - 1) {
							fwrite($file, $value.",");
						} else {
							fwrite($file, $value);
						}
					}
					echo('</ul>');
					echo('</div>');
				}

				$lstinfos = AffJson("admin/jsonAPI.json");
				AffInfos($lstinfos);
			?>
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