<?php
session_start();
include 'count.php';
$sp=$_GET['sp'];
echo json_encode(countSPParTrim($sp));
?>