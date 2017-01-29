<?php
session_start();
include 'count.php';
$serv=$_GET['serv'];
echo json_encode(countPFIService($serv, 'emet', 0,2));
?>