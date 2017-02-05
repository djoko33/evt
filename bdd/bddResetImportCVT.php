<?php
include('../modele/connexionPG.php');
$reponse = $bdd->exec("DELETE FROM importcvt");
echo $reponse.' CVT supprimes';
?>