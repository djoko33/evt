<?php
session_start();
include 'count.php';
echo json_encode(countCvtEmis($_GET['type']));
?>