<?php
include('connexionPG.php');

// Récupération des SP
$reponse = $bdd->query('SELECT * FROM sousprocessus ORDER BY mp, sp');
$s="";
while ($donnees = $reponse->fetch())
{
	if(empty($s)){
		echo '<optgroup label="'. htmlspecialchars($donnees['mp']).'">';
		$s = $donnees['mp'];
	}
	if($s!=$donnees['mp']){
		echo '</optgroup><optgroup label="'. htmlspecialchars($donnees['mp']).'">';
		$s = $donnees['mp'];
	}
	echo'<option value="'.$donnees['sp'].'" data-subtext="'.$donnees['sp_libelle'].'">'.$donnees['sp'].'</option>';
}
$reponse->closeCursor();?>