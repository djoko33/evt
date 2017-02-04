<?php
include('../connexionPG.php');
//traitement SP
$reponse = $bdd->query('SELECT reference, emetteur, serv_emet, serv_conc,  dateCVT, sp, nature FROM cvt');
$sqlSP = 'INSERT INTO spcvt (reference, emetteur, serv_emet, serv_conc,  datecvt, sp, nature, categorie, pfi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$sp=$bdd->prepare($sqlSP);
while ($donnees = $reponse->fetch())
{
	$sps=explode(",", $donnees['sp']);
	foreach ($sps as $c)
	{		
		$sp->execute(array($donnees['reference'], $donnees['emetteur'], $donnees['serv_emet'], $donnees['serv_conc'], $donnees['datecvt'], $c, $donnees['nature'], 4, 0));
	}
}
$reponse->closeCursor();
echo "Traitement SP Termine"
?>