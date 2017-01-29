<?php
include('connexionPG.php');
$exp=$_POST['explications'];
$tram=$_POST['trame'];
$cod=$_POST['code'];
$tit=$_POST['titre'];
$reponse = $bdd->prepare('UPDATE pci_fiches SET explications=?, trame=? , titre= ? WHERE code = ?');
$reponse->execute(array($exp, $tram, $tit, $cod));


?>