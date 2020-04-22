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
			$infos = array($_POST['nom'],$_POST['prenom']);
			$caract = ",?;.:/!§ù%*µ$£";
			for ($i=0; $i < sizeof($infos); $i++) { 
				for ($k=0; $k < strlen($infos[$i]); $k++) { 
					for ($l=0; $l < strlen($caract); $l++) { 
						if ($infos[$i][$k] == $caract[$l]) {
							header("location:inscription.php?compte=notfull");
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
			if ($_POST["nom"] == "" || $_POST["prenom"] == "" || $_POST["mdp"] == hash("sha256", "" || $_POST["date"] == "" || $_POST["tel"] == "" || $_POST["email"] == "" || $_POST["adresse"] == "")) {
				header('location:inscription.php?etat=notfull');
			}

			$laSortie = fopen("admin/comptes.csv", "a+");
			$num = sizeof(file("admin/comptes.csv"))+1;
			fputs($laSortie, $num . ",");
			fputs($laSortie, strtoupper($_POST["nom"]) . ",");
			fputs($laSortie, $_POST["prenom"] . ",");
			fputs($laSortie, $_POST["date"] . ",");
			fputs($laSortie, $_POST["email"] . ",");
			fputs($laSortie, $_POST["tel"] . ",");
			fputs($laSortie, $_POST["adresse"] . ",");
			if ($etu == TRUE) {
				fputs($laSortie, $_POST["filiere"] . ",");
				fputs($laSortie, $_POST["groupe"] . ",");
			}
			$alea = hash("sha256", uniqid($_POST['email']));
			fputs($laSortie, $mdpHASH.$alea. ",");
			if (empty($_POST['photo'])) {
				fputs($laSortie, "account.png" . ",");
			} else {
				fputs($laSortie, strtoupper($num.'_'.$_POST["nom"].","));
			}
			fputs($laSortie, $alea. "\n");
			fclose($laSortie);
			Connexion(array('email','mdp'),array('id','nom', 'prenom', 'date', 'tel', 'email', 'adresse', 'filiere', 'groupe', 'mdp', 'img'),"NONE");
			header("location:profil.php");
		}  else {
			header("location:index.php?etat=undefined");
		}
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
				if ($_POST['email'] == $ligne[4] && $mdp.$ligne[sizeof($ligne)-1] == $ligne[9]) {
					$fin = TRUE;
					$i = 0;
					foreach ($listeINFOS as $key => $value) {
						$$value = $ligne[$i];
						$i++;
					}
				} else {
					$fin = FALSE;
				}
			}

			if ($fin == TRUE) {
				session_start();
				foreach ($listeINFOS as $key => $value) {
					$_SESSION["$value"] = $$value;
				}
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
		$ligne[sizeof($ligne)-2] = $ligne[0].'_'.$ligne[1];
		if (isset($_FILES['img_import']['tmp_name'])) {
			move_uploaded_file($_FILES['img_import']['tmp_name'], "API/img/".$ligne[sizeof($ligne)-2].'.png');
		}
		if ($nom != $ligne[1]) {
			rename('API/img/'.$ligne[0].'_'.$nom.'.png', 'API/img/'.$ligne[sizeof($ligne)-2].'.png');
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
?>