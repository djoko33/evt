<?php
include('modele/connexionPG.php');

// R�cup�ration des sections
$reponse = $bdd->query('SELECT quad, libelle, categorie FROM codification ORDER BY categorie, quad');
$s="";
while ($donnees = $reponse->fetch())
{
	if(empty($s)){
		echo '<optgroup label="'. htmlspecialchars($donnees['categorie']).'">';
		$s = $donnees['categorie'];
	}
	if($s!=$donnees['categorie']){
		echo '</optgroup><optgroup label="'. htmlspecialchars($donnees['categorie']).'">';
		$s = $donnees['categorie'];
	}
	echo'<option value="'.$donnees['quad'].'" data-subtext="'.$donnees['libelle'].'">'.$donnees['quad'].'</option>';
	//echo'<option value="'.$donnees['quad'].'" data-subtext="'.$donnees['libelle'].'">'.$donnees['quad']." : ".$donnees['libelle'].'</option>';
}
$reponse->closeCursor();?>