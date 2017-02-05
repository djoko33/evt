<?php
session_start();
include '../modele/countFrx.php';
$tab=countCodeTrim(convertCode($_GET['code']));
echo json_encode($tab);
?>