<?php
session_start();
//$_SESSION["debut"]='2017-01-01';
//$_SESSION["fin"]='2017-12-01';
include 'countfrx.php';
$tab=countCodeTrim(convertCode($_GET['code']));
echo json_encode($tab);
?>