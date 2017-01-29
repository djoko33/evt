<?php
session_start();
include 'count.php';
$nqme=array("EM01", "EM02", "EM06", "EM08", "EM09", "EM17", "EM19", "OM11", "PH05");
$surete=array("EM01");
$pa=array("nqme"=>$nqme, "surete"=>$surete);
$serv=$_GET['serv'];
$plan=$pa[$_GET['pa']];
$sens=$_GET['sens'];
echo json_encode(planAction($serv, $sens, $plan));
?>