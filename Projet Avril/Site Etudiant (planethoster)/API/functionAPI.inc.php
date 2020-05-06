<?php
	function cptKey(){
		$file = fopen("../admin/keys.csv", "r");
		$contenu = [];
		while (!feof($file)) {
			array_push($contenu, fgetcsv($file));
		}
		foreach ($contenu as $key => $value) {
			if ($value[1] == $_GET['key']) {
				if (date("d:H",$contenu[$key][2]) == date("d:H",time())) {
					$contenu[$key][3] = intval($contenu[$key][3])+1;
				} else {
					$contenu[$key][2] = time();
					$contenu[$key][3] = 1;
				}
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
		foreach ($comptes as $key => $value) {
			$comptes[$key] = explode(',', $value);
		}
		foreach ($comptes as $key => $value) {
			$comptes[$value[1].'_'.$value[2]] = $value;
			unset($comptes[$key]);
		}
		ksort($comptes);
		$cpt = 0;
		foreach ($comptes as $key => $value) {
			$comptes[$cpt] = $value;
			unset($comptes[$key]);
			$cpt++;
		}
		$json["Indefini"] = array("Indefini" => array());
		foreach ($comptes as $key => $ligne) {
			foreach ($ligne as $key2 => $value2) {
				if ($key2 == 13) {
					$ligne[$listeinfos[$key2]] = str_replace("\n", '', $value2);
					unset($ligne[$key2]);
				}
				else {
					$ligne[$listeinfos[$key2]] = $value2;
					unset($ligne[$key2]);
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
				$compte['IMG'] = 'https://vitoux-quentin.yo.fr/API/API/img/'.$compte['IMG'].'.png';
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
					$verifNBUtil = cptAPImax($_GET['key']);
					if ($verifNBUtil == FALSE) {
						$json = file_get_contents("../admin/errorAPI.json");
						$jsonERROR = json_decode($json, TRUE);
						$jsonERROR = json_encode($jsonERROR['errorPERSONNE']);
						header("Content-type: application/json");
						echo($jsonERROR);
						return FALSE;
					}
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

	function cptAPImax($key){
		$file = fopen("../admin/keys.csv", "r");
		while (!feof($file)) {
			$ligne = fgetcsv($file);
			if ($ligne[1] == $key) {
				$nbUtil = $ligne[3];
			}
		}
		if ($nbUtil > 30) {
			return FALSE;
		} else {
			return TRUE;
		}
	}
?>
