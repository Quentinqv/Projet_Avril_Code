<?php
	function cptKey(){
		$file = fopen("../admin/keys.csv", "r");
		$contenu = [];
		while (!feof($file)) {
			array_push($contenu, fgetcsv($file));
		}
		foreach ($contenu as $key => $value) {
			if ($value[1] == $_GET['key']) {
				$contenu[$key][2] = date("Y-m-d à H:i:s");
				$contenu[$key][3] = intval($contenu[$key][3])+1;
			}
		}
		fclose($file);

		$keys = fopen("../admin/keys.csv", "w");
		for ($i=0; $i < sizeof($contenu)-1; $i++) { 
			if ($i == sizeof($contenu)-1) {
				fputs($keys, implode(',', $contenu[$i]));
			} else {
				fputs($keys, implode(',', $contenu[$i])."\n");
			}
		}
		fclose($keys);
		return TRUE;
	}

	function TrierFiliere($doc){
		$json = file_get_contents($doc."filiere.json");
		$json = json_decode($json, true);
		return $json;
	}

	function genereJSON($json, $listeinfos,$API){
		$comptes = file($API."admin/comptes.csv");
		$json["Indefini"] = array("Indefini" => array());
		foreach ($comptes as $key => $value) {
			$ligne = explode(",", $value);
			foreach ($ligne as $key => $value) {
				if ($key == 13) {
					$ligne[$listeinfos[$key]] = str_replace("\n", '', $value);
					unset($ligne[$key]);
				}
				else {
					$ligne[$listeinfos[$key]] = $value;
					unset($ligne[$key]);
				}
			}
			$ligne['IMG'] = 'https://vitoux-quentin.yo.fr/API/API/img/'.$ligne['IMG'].'.png';
			unset($ligne['mdp']);
			unset($ligne['alea']);
			array_push($json[$ligne['Filiere']][$ligne['Groupe']], $ligne);
		}
		$file = fopen($API."admin/jsonAPI.json", "w");
		$json = json_encode($json);
		fwrite($file, $json);
	}

	function JSONInfo($get,$info){
		$file = fopen("../admin/comptes.csv", 'r');
		$liste = array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea', 'Derniere_connexion', 'Nb_total_de_connexion');
		$doublon = [];
		$k = 0;
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
				$doublon[$k] = $compte;
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
					cptKey();
					$liste = array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea', 'Derniere_connexion', 'Nb_total_de_connexion');
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
						if ($_GET['filiere'] == 'ALL') {
							$json = file_get_contents("filiere.json");
							header("Content-type: application/json");
							echo($json);
							return TRUE;
						}
						if (isset($_GET['groupe'])) {
							$json = file_get_contents("../admin/jsonAPI.json");
							$json = json_decode($json, TRUE);
							if (array_key_exists($_GET['groupe'], $json[$_GET['filiere']])) {
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
			$jsonERROR = file_get_contents("../admin/errorAPI.json");
			$json = json_decode($jsonERROR, TRUE);
			$json = json_encode($json['errorKEY']);
			header("Content-type: application/json");
			echo($json);
			return FALSE;
		}
	}
?>