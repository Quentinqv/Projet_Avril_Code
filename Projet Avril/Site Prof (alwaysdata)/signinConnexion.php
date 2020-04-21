<?php
	$lst = array('utilisateur', 'mdp');
	$sortie = TRUE;
	for ($i=0; $i < sizeof($lst) && $sortie == TRUE; $i++) {
		if (!isset($_POST[$lst[$i]])) {
			$sortie = FALSE;
		}
	}

	if ($sortie == TRUE) {
		$pseudo = $_POST['utilisateur'];
		$mdp = $_POST['mdp'];
		$mdp = hash("sha256", $mdp);
		$laSortie = fopen("admin/sortie.csv", "r");
		if ($pseudo == "" || $mdp == hash("sha256", "")) {
			echo("Les champs sont vides.");
			exit();
		}
		$fin = FALSE;
		while (!feof($laSortie) && $fin == FALSE) {
			$ligne = fgetcsv($laSortie);
			$utilisateur = $ligne[1];
			$emdp = end($ligne);

			if ($pseudo == $utilisateur && $mdp == $emdp) {
				$fin = TRUE;
			} else {
				$fin = FALSE;
			}
		}

		if ($fin == TRUE) {
			session_start();
			$_SESSION['pseudo'] = $pseudo;
			$_SESSION['mdp'] = $mdp;
			$fin = 'check';
			header("location:index.php?login=$fin");
			exit();
		} 
		if ($fin == FALSE) {
			$fin = 'fail';
			header("location:inscription.php?login=$fin");
			exit();
		}
	}
?>