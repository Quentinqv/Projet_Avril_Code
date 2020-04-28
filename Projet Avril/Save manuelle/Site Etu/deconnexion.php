<?php
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
	deconnexion(array("id","nom","prenom","date","email","tel","adresse","filiere","groupe","mdp","img"));
?>