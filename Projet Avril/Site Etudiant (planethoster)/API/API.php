<?php
	function JSONInfo($get,$info){
		$file = fopen("../admin/comptes.csv", 'r');
		$liste = array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea');
		$doublon = [];
		$k = 1;
		while (!feof($file)) {
			$ligne = fgetcsv($file);
			$compte = [];
			$i = 0;
			if (empty($ligne)) {
				break;
			}
			foreach ($ligne as $key => $value) {
				$compte[$liste[$i]] = $value;
				$i++;
			}
			if ($compte[$get] == $info) {
				unset($compte['mdp']);
				unset($compte['alea']);
				$doublon['Etudiant'.$k] = $compte;
				$k++;
			}
		}
		if (empty($doublon)) {
			return FALSE;
		} else {
			return $doublon;
		}
	}
	function AffAPI(){
		if (isset($_GET['key'])) {
			$file = fopen("../admin/keys.csv", "r");
			$key = FALSE;
			while (!feof($file)) {
				$ligne = fgetcsv($file);
				if ($ligne[1] == $_GET['key']) {
					$key = TRUE;
				}
			}
			switch ($key) {
				case TRUE:
					#KEY trouvee
					$liste = array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea');
					foreach ($liste as $key => $value) {
						if (isset($_GET[$value])) {
							$compte = JSONInfo($value,$_GET[$value]);
							if ($compte == FALSE) {
								$json = file_get_contents("../admin/errorAPI.json");
								$jsonERROR = json_decode($json, TRUE);
								$jsonERROR = json_encode($jsonERROR['errorPERSONNE']);
								header("Content-type: application/json");
								echo($jsonERROR);
								return FALSE;
							} else {
								$json = json_encode($compte);
								header("Content-type: application/json");
								echo($json);
								return TRUE;
							}
						}
					}
					if (isset($_GET['filiere'])) {
						if (isset($_GET['groupe'])) {
							$json = file_get_contents("../admin/jsonAPI.json");
							$json = json_decode($json, TRUE);
							if (array_key_exists($_GET['groupe'], $json)) {
								$json = json_encode($json[$_GET['filiere']][$_GET['groupe']]);
								header("Content-type: application/json");
								echo($json);
								return TRUE;
							} else {
								$json = file_get_contents("../admin/errorAPI.json");
								$jsonERROR = json_decode($json, TRUE);
								$jsonERROR = json_encode($jsonERROR['errorGROUPE']);
								header("Content-type: application/json");
								echo($jsonERROR);
								return FALSE;
							}
						} else {
							$json = file_get_contents("../admin/jsonAPI.json");
							$json = json_decode($json, TRUE);
							if (array_key_exists($_GET['filiere'], $json)) {
								$json = json_encode($json[$_GET['filiere']]);
								header("Content-type: application/json");
								echo($json);
								return TRUE;
							} else {
								$json = file_get_contents("../admin/errorAPI.json");
								$jsonERROR = json_decode($json, TRUE);
								$jsonERROR = json_encode($jsonERROR['errorFILIERE']);
								header("Content-type: application/json");
								echo($jsonERROR);
								return FALSE;
							}
						}
					}
					else {
						$json = file_get_contents("../admin/jsonAPI.json");
						header("Content-type: application/json");
						echo($json);
						return TRUE;
					}
					break;
				case FALSE:
					#KEY non trouvee
					$jsonERROR = file_get_contents("../admin/errorAPI.json");
					$jsonERROR = json_decode($jsonERROR, TRUE);
					$jsonERROR = json_encode($jsonERROR['errorKEY']);
					header("Content-type: application/json");
					echo($jsonERROR);
					return FALSE;
				default:
					$jsonERROR = file_get_contents("../admin/errorAPI.json");
					$json = json_decode($jsonERROR, TRUE);
					$json = json_encode($jsonERROR['errorKEY']);
					header("Content-type: application/json");
					echo($json);
					return FALSE;
					break;
			}
		} else {
			#KEY non trouvee
			$json = file_get_contents("../admin/jsonAPI.json");
			header("Content-type: application/json");
			echo($json);
			return FALSE;
		}
	}
	AffAPI();
?>