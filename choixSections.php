<?php
include('connexionPG.php');

// Récupération des sections
$reponse = $bdd->query('SELECT section, service FROM sections ORDER BY service, section');

// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
$s="";
while ($donnees = $reponse->fetch())
{
	if(empty($s)){
		echo '<optgroup label="'. htmlspecialchars($donnees['service']).'">';
		$s = $donnees['service'];
	}
	if($s!=$donnees['service']){
		echo '</optgroup><optgroup label="'.$donnees['service'].'">';
		$s = $donnees['service'];
	}
	echo'<option value="'.trim($donnees['service']).'-'.trim($donnees['section']).'">'.trim($donnees['service']).'-'.trim($donnees['section']).'</option>';
}

$reponse->closeCursor();?>