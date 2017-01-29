<?php
//injecte dans la table cvt à la colonne index (tsvector(texte+titre))
include('connexionPG.php');// todo changer le chemin
$reponse = $bdd->query("SELECT reference, titre, texte FROM cvt");

$value = array();
$ref=array();
while ($donnees = $reponse->fetch())
{
	$d=$donnees['texte'].' '.$donnees['titre'];
	$value[] = '(to_tsvector('.$bdd->quote($d).')) WHERE reference='.$bdd->quote($donnees['reference']);
}


foreach ($value as $v){
	$req = $bdd->exec('UPDATE cvt SET index ='.$v);
	print_r($req);
}
$reponse->closeCursor();
?>