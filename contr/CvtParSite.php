<?php
session_start();
include '../modele/count.php';
echo json_encode(countCVTSite(0,2));
?>