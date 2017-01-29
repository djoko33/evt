<?php
session_start();
include 'count.php';
$sp=$_GET['sp'];
$sens=$_GET['sens'];
echo json_encode(SPParServicesTot($sp, $sens));
?>