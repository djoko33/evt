<?php
include('../connexionPG.php');
$reponse = $bdd->exec("DELETE FROM importcvt");
echo $reponse.' CVT supprimes';
?>