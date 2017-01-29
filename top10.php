<?php
session_start();
include 'count.php';
$serv=$_GET['serv'];
$sens=$_GET['sens'];
echo json_encode(top10($serv, $sens));
?>