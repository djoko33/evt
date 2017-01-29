<?php
session_start();
include('connexionPG.php');

$arrCVT=array();
if (isset($_GET['serv_conc']))
	{
		$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (codes LIKE ?) AND (serv_conc = ?) AND (nature = ?) AND (datecvt BETWEEN ? AND ?)');
		$reponse->execute(array("%".$_GET['code']."%", $_GET['serv_conc'], $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));
		//conserver reference en premier (adhérence avec le JS pour le lien vers la reference)
	}
else 
	{
		$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (codes LIKE ?) AND (serv_emet = ?) AND (nature = ?) AND (datecvt BETWEEN ? AND ?)');
		$reponse->execute(array("%".$_GET['code']."%", $_GET['serv_emet'], $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));
		//conserver reference en premier (adhérence avec le JS pour le lien vers la reference)
	}

while ($donnees = $reponse->fetch())
{
 	//$arrCVT[]=$donnees;
 	array_push($arrCVT, $donnees);
}
$reponse->closeCursor();
echo json_encode($arrCVT);
?>