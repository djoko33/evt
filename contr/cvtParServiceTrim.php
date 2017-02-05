<?php
include '../modele/count.php';
$serv=$_GET['serv'];
echo json_encode(countCVTServiceTrim($serv, 'emet', 0,2));
?>