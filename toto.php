<?php 
include 'connexionPG.php';
$arrCVT=array();
$words=str_replace("+","",$_GET['keyword']);
$word=explode('&',$words);
$search=trim($word[0]);
for ($i = 1; $i < count($word); $i++) {
	$search=$search." & ".trim($word[$i]);	
}

$sql="SELECT reference, titre, texte, action, serv_emet, serv_conc FROM cvt WHERE index @@ to_tsquery('".$search."')";
echo $sql;
$reponse=$bdd->query($sql);

while ($donnees = $reponse->fetch())
{
	array_push($arrCVT, $donnees);
}
$reponse->closeCursor();
echo json_encode($arrCVT);
?>