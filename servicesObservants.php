<?php
session_start();
include 'count.php';
$serv=$_GET['serv'];
echo json_encode(countServEmet($serv));
?>