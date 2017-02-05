<?php
session_start();
include '../modele/count.php';
echo json_encode(countCvtEmis($_GET['type']));
?>