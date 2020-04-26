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
					$json = file_get_contents('https://vitoux-quentin.yo.fr/API/API/API.php?key='.$key.'&filiere='.$_POST['filiere'].'&groupes='.$_POST['groupe']);
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

	function AfficherJson($arrayJson){
		switch ($arrayJson[1]) {
			case 'all':
				# code...
				break;
			
			default:
				# code...
				break;
		}
	}
?>