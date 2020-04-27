<?php
	function GetJson(){
		$key = '5ea57c1065ea6';
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

	/*function AffStudent($json){
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
		</div>
			");
	}*/

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
				# code...
				break;
			default:
				# code...
				break;
		}
	}
?>