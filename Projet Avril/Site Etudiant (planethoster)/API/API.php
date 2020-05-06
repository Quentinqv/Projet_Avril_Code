<?php
	include '../functionLog.inc.php';
	include 'functionAPI.inc.php';
    $json = TrierFiliere('./');
	genereJSON($json, array('Id', 'Nom', 'Prenom', 'Date_de_naissance', 'Email', 'Telephone', 'Adresse', 'Filiere', 'Groupe', 'mdp', 'IMG', 'alea', 'Derniere_connexion', 'Nb_total_de_connexion'),'../');
	AddLog('appelAPI');
	AffAPI();
?>