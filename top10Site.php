<?php
session_start();
include 'count.php';
echo json_encode(top10Site());
?>