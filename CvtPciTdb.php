<?php
session_start();
include 'countTdB.php';
$serv=$_GET['serv'];
echo json_encode(countNbPci($serv));
?>