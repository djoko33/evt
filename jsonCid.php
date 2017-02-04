<?php
session_start();
include('connexionPtirex.php');

$arrFrx=array();
if (isset($_GET['code']))
	{$reponse = $ptirex->prepare('SELECT numrex AS reference, titre, date, type, notes FROM cid LEFT JOIN codescid ON cid.numrex = codescid.reference WHERE code=? AND (dateevt BETWEEN ? AND ?)');
	$reponse->execute(array($_GET['code'], $_SESSION["debut"], $_SESSION["fin"]));}

		//conserver reference en premier (adh�rence avec le JS pour le lien vers la reference)

while ($donnees = $reponse->fetch())
{
 	array_push($arrFrx, $donnees);
}
$reponse->closeCursor();
echo json_encode($arrFrx);
?>