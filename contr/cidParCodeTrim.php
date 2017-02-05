<?php
session_start();
include '../modele/countCid.php';
$tab=countCodeTrim(convertCode($_GET['code']));
echo json_encode($tab);
?>