<?php
session_start();
include 'count.php';
$code=$_GET['code'];
echo json_encode(countCodeParTrim($code));
?>