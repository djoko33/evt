<?php
include('../connexionPG.php');
$deb=$_POST['dateDebut'];
$fin=$_POST['dateFin'];
$reponse = $bdd->prepare("UPDATE options SET value = ? WHERE id = ?");
$reponse->execute(array($deb,1));
$reponse->execute(array($fin,2));
echo "MAJ OK";
?>