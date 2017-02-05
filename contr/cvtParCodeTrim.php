<?php
session_start();
include '../modele/count.php';
$code=$_GET['code'];
echo json_encode(countCodeParTrim($code));
?>