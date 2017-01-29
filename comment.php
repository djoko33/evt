<?php
include('connexionPG.php');
$data=$_POST['comment'];
$id=$_POST['id'];
$comm=$bdd->prepare("UPDATE comment SET contenu=? WHERE id=?");
$comm->execute(array($data, $id));
echo "donnees sauvegardees";
?>