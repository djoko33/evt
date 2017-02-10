<?php
session_start();
include '../modele/count.php';
$sp=$_GET['sp'];
echo json_encode(countSPParMois($sp));
?>