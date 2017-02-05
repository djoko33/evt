<?php
session_start();
include '../modele/countTdb.php';
$serv=$_GET['serv'];
echo json_encode(countNbPciEmet($serv));
?>