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
			fputs($laSortie, $mdpHASH . ",");
			if (empty($_POST['photo'])) {
				fputs($laSortie, "account" . "\n");
			} else {
				fputs($laSortie, strtoupper($_POST["nom"]).'_'.$_POST["prenom"] . "\n");
			}
			fclose($laSortie);
			$_SESSION['prenom'] = $_POST["prenom"];
			$_SESSION['mdp'] = hash("sha256", $_POST['mdp']);
			$etat = 'created';
			header("location:index.php?etat=$etat");
		}  else {
			$etat = 'undefined';
			header("location:index.php?etat=$etat");
		}
	}
?>