<?php
	function GetJson(){
		#Fais une requete en fonction des parametres demandes
		$key = '5ea2ca13aa5ff';
		if (isset($_GET['Etudiant']) && $_GET['Etudiant'] == 'TRUE') {
			if ($_POST['nom'] != '') {
				$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&Nom='.strtoupper($_POST['nom']));
				$json = json_decode($json, TRUE);
				return array($json,'etudiant');
			}
			if ($_POST['prenom'] != '') {
				$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&Prenom='.$_POST['prenom']);
				$json = json_decode($json, TRUE);
				return array($json,'etudiant');
			}
			if ($_POST['email'] != '') {
				$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&Email='.$_POST['email']);
				$json = json_decode($json, TRUE);
				return array($json,'etudiant');
			}
		}
		if ($_GET['filiere'] == 'TRUE' && $_POST['filiere'] != 'filiere') {
			if ($_POST['filiere'] == 'nomsgroupes') {
				$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere=ALL');
				$json = json_decode($json, TRUE);
				return array($json,'all');
			} else {
				if (isset($_GET['groupe']) && $_GET['groupe'] == 'TRUE' && $_POST['groupe'] != 'Groupe') {
					$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere='.$_POST['filiere'].'&groupe='.$_POST['groupe']);
					$json = json_decode($json, TRUE);
					return array($json,'FiliGrp');
				} else {
					$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere='.$_POST['filiere']);
					$json = json_decode($json, TRUE);
					return array($json,'filiere');
				}
			}
		} else {
			$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere=failed');
			$json = json_decode($json, TRUE);
			return array($json,'error');
		}
	}

	function ListeFiliere($json){
		#Affiche la liste des filieres avec les groupes
		echo("<h2 class='IntroGroupe'>Filières liées au département informatique</h2>
				<div id=\"NomsFiliere\">");
				foreach ($json as $key => $value) {
					echo("<div class=\"EachFiliere\">
							<div class=\"EachFiliereGauche\">
								<h3>Filière :</h3>
								<h3>Groupes :</h3>
							</div>
							<div class=\"EachFiliereDroite\">
								<h4>$key</h4>
								<ul>");
							foreach ($value as $key => $value) {
								echo("<li>$key</li>");
							}
							echo("</div>
						</div>");
				}
		echo("</div>");
		return TRUE;
	}

	function AffStudent($json){
		#Affiche une case pour un élève
		echo("
			<div class=\"mosaiqueGroupe\">
			");
		foreach ($json as $key => $value) {
			echo("
				<div class=\"EachStudent\">
				<img src=".$value['IMG']." alt=\"ERROR\"  id=".$value['Id'].'img'." onclick=\"AffMoreInfos(true,this)\">
				<h3>".$value['Nom']."</h3>
				<h4>".$value['Prenom']."</h4>
				<div class=\"MoreInfo\" id=".$value['Id']." style='display: none'>
					<p>".$value['Date_de_naissance']."</p>
					<p>".$value['Email']."</p>
					<p>".$value['Adresse']."</p>
					<p>".$value['Derniere_connexion']."</p>
				</div>
			</div>
				");
		}
		echo("
			</div>
			");
	}

	function AffFiliere($json){
		echo("
			<h2>Filiere : ".$_POST['filiere']."</h2>
			");
		foreach ($json as $key => $value) {
			echo("<h2 class=\"IntroGroupe\">Groupe : ".$value[0]['Groupe']."</h2>");
			AffStudent($value);
		}
		echo("</div>");
	}

	function AffEtudiantSolo($json){
		if (empty($json['IMG'])) {
			echo('<h2>Aucun élève trouvé</h2>');
		} else {
			echo("
				<div id=\"EtudiantSolo\">
					<div id=\"EtudiantSoloGauche\">
						<img src=".$json['IMG'].">
					</div>
					<div id=\"EtudiantSoloDroite\">
						<div>
							<p>Nom : </p><span>".$json['Nom']."</span>
						</div>
						<div>
							<p>Prenom : </p><span>".$json['Prenom']."</span>
						</div>
						<div>
							<p>Date de naissance : </p><span>".$json['Date_de_naissance']."</span>
						</div>
						<div>
							<p>Email : </p><span>".$json['Email']."</span>
						</div>
						<div>
							<p>Téléphone : </p><span>".$json['Telephone']."</span>
						</div>
						<div>
							<p>Adresse : </p><span>".$json['Adresse']."</span>
						</div>
						<div>
							<p>Filière : </p><span>".$json['Filiere']."</span>
						</div>
						<div>
							<p>Groupe : </p><span>".$json['Groupe']."</span>
						</div>
						<div>
							<p>Dernière connexion : </p><span>".$json['Derniere_connexion']."</span>
						</div>
					</div>
				</div>
				");
		}
	}

	function Cookie($contenu){
		setcookie('LastSearch', '', time()-1);
		unset($_COOKIE['LastSearch']);
		setcookie('LastSearch', $contenu, time() + 365*24*3600);
	}

	function AffJsonCookie($cookie){
		$key = '5ea2ca13aa5ff';
		$liste = explode(',', $cookie);
		if ($liste[0] == 'nomsgroupes') {
			$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere=ALL');
			$json = json_decode($json, TRUE);
			return array($json,'all');
		} else {
			$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere='.$liste[0].'&groupe='.$liste[1]);
			$json = json_decode($json, TRUE);
			return array($json,'FiliGrp');
		}
	}

	function AfficherJson($arrayJson){
		switch ($arrayJson[1]) {
			case 'all':
				ListeFiliere($arrayJson[0]);
				break;
			case 'FiliGrp':
				echo("<h2 class='IntroGroupe'>Filière : ".$arrayJson[0][0]['Filiere']." groupe ".$arrayJson[0][0]['Groupe']."</h2>");
				AffStudent($arrayJson[0]);
				break;
			case 'filiere':
				AffFiliere($arrayJson[0]);
				break;
			case 'etudiant':
				if (sizeof($arrayJson[0]) == 1) {
					if (empty($arrayJson[0][0]['IMG'])) {
						echo('<h2>Aucun élève trouvé</h2>');
					} else {
						AffEtudiantSolo($arrayJson[0][0]);
					}
				} else {
					AffStudent($arrayJson[0]);
				}
				break;
			default:
				return FALSE;
				break;
		}
	}
?>