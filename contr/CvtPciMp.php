<?php
session_start();
include '../modele/count.php';
$mp=$_GET['mp'];
echo json_encode(countNbPciMp($mp));
?>