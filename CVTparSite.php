<?php
session_start();
include 'count.php';
echo json_encode(countCVTSite(0,2));
?>