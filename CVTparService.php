<?php
session_start();
include 'count.php';
$serv=$_GET['serv'];
echo json_encode(countCVTService($serv, 'emet', 0,2));
?>