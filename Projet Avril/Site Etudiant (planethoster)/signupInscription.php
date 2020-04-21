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

	function Connexion($listeCHAMPS,$listeINFOS){
		$lst = array('email', 'mdp');
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
				if ($_POST['email'] == $ligne[4] && $mdp == $ligne[9]) {
					$fin = TRUE;
					$id = $ligne[0];
					$nom = $ligne[1];
					$prenom = $ligne[2];
					$date = $ligne[3];
					$email = $ligne[4];
					$tel = $ligne[5];
					$adresse = $ligne[6];
					$filiere = $ligne[7];
					$groupe = $ligne[8];
					$mdp = $ligne[9];
					$img = $ligne[10];
				} else {
					$fin = FALSE;
				}
			}

			if ($fin == TRUE) {
				session_start();
				$_SESSION['id'] = $id;
				$_SESSION['nom'] = $nom;
				$_SESSION['prenom'] = $prenom;
				$_SESSION['date'] = $date;
				$_SESSION['email'] = $email;
				$_SESSION['tel'] = $tel;
				$_SESSION['adresse'] = $adresse;
				$_SESSION['filiere'] = $filiere;
				$_SESSION['groupe'] = $groupe;
				$_SESSION['mdp'] = $mdp;
				$_SESSION['img'] = $img;
				header("location:inscription.php?login=checked");
				exit();
			} 
			if ($fin == FALSE) {
				header("location:inscription.php?login=failed");
				exit();
			}
		}
	}
?>