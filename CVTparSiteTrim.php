<?php
session_start();
include 'count.php';
echo json_encode(countCVTSiteTrim(0,2));
?>