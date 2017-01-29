<?php
session_start();
include 'count.php';
$nqme=array("EM01", "EM02", "EM06", "EM08", "EM09", "EM17", "EM19", "OM11", "PH05");
$surete=array("EM05", "EM08", "EM13", "MA14", "SN01", "SN03", "SN14", "SN16");
$pa=array("nqme"=>$nqme, "surete"=>$surete);
$plan=$pa[$_GET['pa']];
echo json_encode(planActionSite($plan));
?>