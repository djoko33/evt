<?php
include('../modele/connexionPG.php');
$reponse = $bdd->query("DELETE FROM cvt");
echo "Donn�es effac&eacute;es";
?>