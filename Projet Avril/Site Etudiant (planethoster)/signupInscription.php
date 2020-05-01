<?php
	function Inscription($listeCHAMPS, $etu){
		$lst = $listeCHAMPS;
		$sortie = TRUE;
		for ($i=0; $i < sizeof($lst) && $sortie == TRUE; $i++) { 
			if (!isset($_POST[$lst[$i]])) {
				header('location:inscription.php?etat=notfull');
			}
		}

		if ($sortie == TRUE) {
			$infos = array($_POST['nom'],$_POST['prenom'],$_POST['adresse']);
			$caract = ",?;.:/!§ù%*µ$£";
			for ($i=0; $i < sizeof($infos); $i++) { 
				for ($k=0; $k < strlen($infos[$i]); $k++) { 
					for ($l=0; $l < strlen($caract); $l++) { 
						if ($infos[$i][$k] == $caract[$l]) {
							header("location:inscription.php?compte=notcreated");
						}
					}
				}
			}

			$mdpHASH = hash("sha256", $_POST['mdp']);
			$fichier = fopen("admin/comptes.csv", "r");
			while (!feof($fichier)) {
				$ligne = fgetcsv($fichier);
				if ($_POST["tel"] == $ligne[3] || $_POST["email"] == $ligne[4]) {
					header("location:inscription.php?etat=double");
				}
			}

			$laSortie = fopen("admin/comptes.csv", "a+");
			$num = sizeof(file("admin/comptes.csv"))+1;
			fputs($laSortie, $num . ",");
			fputs($laSortie, strtoupper($_POST["nom"]) . ",");
			fputs($laSortie, $_POST["prenom"] . ",");
			if ($etu == TRUE) {
				fputs($laSortie, $_POST["date"] . ",");
			}
			fputs($laSortie, $_POST["email"] . ",");
			fputs($laSortie, $_POST["tel"] . ",");
			fputs($laSortie, $_POST["adresse"] . ",");
			fputs($laSortie, $_POST["filiere"] . ",");
			if ($etu == TRUE) {
				fputs($laSortie, $_POST["groupe"] . ",");
			}
			$alea = uniqid();
			fputs($laSortie, hash('sha256', $_POST['mdp'].$alea). ",");
			if (empty($_POST['photo'])) {
				fputs($laSortie, "account" . ",");
			} else {
				fputs($laSortie, strtoupper($num.'_'.$_POST["nom"].","));
			}
			fputs($laSortie, $alea.',');
			fputs($laSortie, date("Y-m-d à H:i:s").',');
			fputs($laSortie, "0". "\n");
			fclose($laSortie);
			AddLog('inscription',$num);
			Connexion(array('email','mdp'),array('id','nom', 'prenom', 'date', 'email', 'tel', 'adresse', 'filiere', 'groupe', 'mdp', 'img'),"NONE");
			header("location:profil.php");
		}  else {
			header("location:index.php?etat=undefined");
		}
	}

	function cptConnexion(){
		$file = fopen("admin/comptes.csv", "r");
		$contenu = [];
		while (!feof($file)) {
			array_push($contenu, fgetcsv($file));
		}
		foreach ($contenu as $key => $value) {
			if ($value[0] == $_SESSION['id']) {
				$contenu[$key][12] = date("Y-m-d à H:i:s");
				$contenu[$key][13] = intval($contenu[$key][13])+1;
			}
		}
		fclose($file);

		$compte = fopen("admin/comptes.csv", "w");
		for ($i=0; $i < sizeof($contenu)-1; $i++) { 
			if ($i == sizeof($contenu)-1) {
				fputs($compte, implode(',', $contenu[$i]));
			} else {
				fputs($compte, implode(',', $contenu[$i])."\n");
			}
		}
		fclose($compte);
		return TRUE;
	}

	function Connexion($listeCHAMPS,$listeINFOS,$id){
		if (gettype($id) == "integer") {
			$comptes = fopen("admin/comptes.csv", "r");
			for ($i=0; $i < $id; $i++) { 
				$ligne = fgetcsv($comptes);
			}
			$k = 0;
			foreach ($listeINFOS as $key => $value) {
				$_SESSION["$value"] = $ligne[$k];
				$k++;
			}
			return TRUE;
		}
		$lst = $listeCHAMPS;
		$sortie = TRUE;
		for ($i=0; $i < sizeof($lst) && $sortie == TRUE; $i++) {
			if (!isset($_POST[$lst[$i]])) {
				$sortie = FALSE;
			}
		}

		if ($sortie == TRUE) {
			$mdp = hash("sha256", $_POST['mdp']);
			$laSortie = fopen("admin/comptes.csv", "r");
			if ($_POST['email'] == "" || $mdp == hash("sha256", "")) {
				#Les champs sont vides
				exit();
			}
			$fin = FALSE;
			while (!feof($laSortie) && $fin == FALSE) {
				$ligne = fgetcsv($laSortie);
				if ($_POST['email'] == $ligne[4] && hash('sha256', $_POST['mdp'].$ligne[11]) == $ligne[9]) {
					$fin = TRUE;
					$i = 0;
					foreach ($listeINFOS as $key => $value) {
						$$value = $ligne[$i];
						$i++;
					}
				}
			}

			if ($fin == TRUE) {
				foreach ($listeINFOS as $key => $value) {
					$_SESSION["$value"] = $$value;
				}
				cptConnexion();
				AddLog('connexion');
				header("location:profil.php?login=checked");
				exit();
			} 
			if ($fin == FALSE) {
				header("location:inscription.php?login=failed");
				exit();
			}
		}
	}

	function deconnexion($liste){
		session_start();
		$_SESSION = array();
		session_destroy();
		foreach ($liste as $key => $value) {
			unset($_SESSION["$value"]);
		}
		header('location:inscription.php');
		exit();
	}

	function ModifInfos($id, $liste){
		$comptes = fopen("admin/comptes.csv", "r");
		$contenu = array();
		while (!feof($comptes)) {
			array_push($contenu, fgetcsv($comptes));
		}
		unset($contenu[sizeof($contenu)-1]);
		$ligne = $contenu[$id-1];
		$nom = $ligne[1];
		$k = 0;
		foreach ($liste as $key => $value) {
			if (isset($_POST[$value]) && $_POST[$value] != "") {
				if ($value == "mdp") {
					$ligne[$k] = hash("sha256", $_POST[$value]).hash("sha256", $ligne[11]);
					$k++;
				}
				else {
					$ligne[$k] = $_POST[$value];
					$k++;
				}
			} else {
				$k++;
			}
		}
		if ($nom != $ligne[1]) {
			$ligne[10] = $ligne[0].'_'.$ligne[1];
			rename('API/img/'.$ligne[0].'_'.$nom.'.png', 'API/img/'.$ligne[10].'.png');
		}
		#Si il ajoute une image
		$TailleIMG = TRUE;
		if (!empty($_FILES['img_import']['name'])) {
			if ($_FILES['img_import']['size'] > 1000000) {
				$TailleIMG = FALSE;
			} else {
				$type = explode('/',$_FILES['img_import']['type']);
				if ($type[0] != 'image' && $type[1] != 'jpeg' || 'jpg' || 'png') {
					$TailleIMG = FALSE;
				} else {
					$ligne[10] = $ligne[0].'_'.$ligne[1];
					$CheckUpload = move_uploaded_file($_FILES['img_import']['tmp_name'], "API/img/".$ligne[10].'.png');
				}
			}
		}
		$contenu[$id-1] = $ligne;
		fclose($comptes);
		$comptesF = fopen("admin/comptes.csv", "w");
		for ($i=0; $i < sizeof($contenu); $i++) { 
			if ($i == sizeof($contenu)) {
				fputs($comptesF, implode(",", $contenu[$i]));
			} else {
				fputs($comptesF, implode(",", $contenu[$i])."\n");
			}
		}
		$k = 0;
		unset($liste[sizeof($liste)-1]);
		foreach ($liste as $key => $value) {
			$_SESSION["$value"] = $ligne[$k];
			$k++;
		}
	}

	function AddLog($event,$id = 0){
		if ($event != 'appelAPI') {
			$log = fopen("admin/logs.csv", "a");
		}
		$date = date("Y-m-d;H:i:s");
		switch ($event) {
			case 'inscription':
				fputs($log, $event.",".$date.','.$id.'_'.strtoupper($_POST['nom'])."\n");
				break;
			case 'connexion':
				fputs($log, $event.','.$date.','.$_POST['email']."\n");
				break;
			case 'addkey':
				fputs($log, $event.','.$date.','.$_POST['email']."\n");
				break;
			case 'appelAPI':
				$log = fopen("../admin/logs.csv", "a");
				fputs($log, $event.','.$date.','. $_SERVER['REQUEST_URI']."\n");
				fclose($log);
				break;
			default:
				return FALSE;
				break;
		}
		return TRUE;
	}
?>