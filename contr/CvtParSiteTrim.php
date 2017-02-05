<?php
session_start();
include '../modele/count.php';
echo json_encode(countCVTSiteTrim(0,2));
?>