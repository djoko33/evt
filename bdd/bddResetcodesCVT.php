<?php
include('../modele/connexionPG.php');
$reponse = $bdd->query("DELETE FROM codescvt");
echo "Donn�es effac&eacute;es";
?>