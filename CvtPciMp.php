<?php
session_start();
include 'countTdb.php';
$mp=$_GET['mp'];
echo json_encode(countNbPciMp($mp));
?>