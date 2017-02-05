<?php
session_start();
include '../modele/count.php';
echo json_encode(planAction($_GET['serv'], $_GET['sens'], lstCodesPA($_GET['pa'])));
?>