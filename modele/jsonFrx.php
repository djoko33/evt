<?php
session_start();
include('connexionPtirex.php');

$arrFrx=array();
if (isset($_GET['code']))
	{$reponse = $ptirex->prepare('SELECT numrex AS reference, service, titre, date, type, famille, notes FROM frx LEFT JOIN codesfrx ON frx.numrex = codesfrx.reference WHERE code=? AND (dateevt BETWEEN ? AND ?)');
	$reponse->execute(array($_GET['code'], $_SESSION["debut"], $_SESSION["fin"]));}

		//conserver reference en premier (adh�rence avec le JS pour le lien vers la reference)

while ($donnees = $reponse->fetch())
{
 	$donnees['service']=substr($donnees['service'], 8); //supprime le mot service stocké dans la base
 	array_push($arrFrx, $donnees);
}
$reponse->closeCursor();
echo json_encode($arrFrx);
?>