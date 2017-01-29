<?php
include('connexion.php');
$reponse = $bdd->query('SELECT * FROM codification ORDER BY categorie, quad');

//echo "<p>".$_POST['cvt_ref']."</p>";

$arrCodes=array();
while ($donnees = $reponse->fetch())
{
 	$arrCodes[]=$donnees;
}
$reponse->closeCursor();
echo json_encode($arrCodes);
?>