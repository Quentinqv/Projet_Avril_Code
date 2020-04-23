<?php
	function TrierFiliere(){
		$json = file_get_contents("API/filiere.json");
		$json = json_decode($json, true);
		return $json;
	}

	$json = TrierFiliere();

	function genereJSON($json, $listeinfos){
		$comptes = file("admin/comptes.csv");
		foreach ($comptes as $key => $value) {
			$ligne = explode(",", $value);
			foreach ($ligne as $key => $value) {
				if ($key == 9 || $key == 11) {
					unset($ligne[$key]);
				} else {
					$ligne[$listeinfos[$key]] = $value;
					unset($ligne[$key]);
				}
			}
			array_push($json[$ligne['Filiere']][$ligne['Groupe']], $ligne);
		}
		$file = fopen("jsonAPI.json", "w");
		$json = json_encode($json);
		fwrite($file, $json);
	}
	genereJSON($json, array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea'));
?>