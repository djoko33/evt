<?php
session_start();
include '../modele/count.php';
$code=$_GET['code'];
$sens=$_GET['sens'];
echo json_encode(codeParServicesTot($code, $sens));
?>