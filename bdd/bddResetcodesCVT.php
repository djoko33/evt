<?php
include('connexionPG.php');
$reponse = $bdd->query("DELETE FROM codescvt");
echo "Données effac&eacute;es";
?>