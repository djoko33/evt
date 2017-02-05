<?php
session_start();
include '../modele/count.php';
echo json_encode(top10Site());
?>