<?php
include('connexionPG.php');
//on vide la table
$reponse = $bdd->query("DELETE FROM codescvt");
//traitement codes
$reponse = $bdd->query('SELECT reference, emetteur, serv_emet, serv_conc,  dateCVT, codes, nature FROM cvt');
$sqlLdd = 'INSERT INTO codescvt (reference, emetteur, serv_emet, serv_conc,  datecvt, code, nature, categorie, pfi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
$ldd=$bdd->prepare($sqlLdd);
$i=0;
while ($donnees = $reponse->fetch())
{
	$codes=explode(",", $donnees['codes']);
	foreach ($codes as $c)
	{		
		$ldd->execute(array($donnees['reference'], $donnees['emetteur'], $donnees['serv_emet'], $donnees['serv_conc'], $donnees['datecvt'], $c, $donnees['nature'], 4, 0));
		$i++;
	}
}
echo $i.' codes pour '.$reponse->rowCount().' CVT';
$reponse->closeCursor();

?>