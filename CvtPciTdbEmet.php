<?php
session_start();
include 'countTdb.php';
$serv=$_GET['serv'];
echo json_encode(countNbPciEmet($serv));
?>