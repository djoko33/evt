<?php
function lstCodes() {
	include_once 'connexionPG.php';
	$reponse = $bdd->query('SELECT * FROM codification');
	$libCodes=array();
	while ($donnees = $reponse->fetch())
	{
		$libCodes[$donnees['quad']]=$donnees['libelle_court'];
	}
	$reponse->closeCursor();
	return $libCodes;
}
?>