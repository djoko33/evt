<?php
include('../connexionPG.php');
$reponse = $bdd->query("DELETE FROM codescvt");
echo "Donn�es effac&eacute;es";
?>