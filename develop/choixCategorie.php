<?php
include('connexion.php');
// Récupération des sections
$reponse = $bdd->query('SELECT DISTINCT categorie FROM codification ORDER BY categorie');
$s="";
while ($donnees = $reponse->fetch())
{
	echo'<option value="'.$donnees['categorie'].'">'.$donnees['categorie'].'</option>';
	//echo'<option value="'.$donnees['quad'].'" data-subtext="'.$donnees['libelle'].'">'.$donnees['quad']." : ".$donnees['libelle'].'</option>';
}
$reponse->closeCursor();?>