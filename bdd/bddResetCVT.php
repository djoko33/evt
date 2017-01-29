<?php
include('connexionPG.php');
$reponse = $bdd->query("DELETE FROM cvt");
echo "Données effac&eacute;es";
?>