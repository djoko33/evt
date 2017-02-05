<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title></title>
	    <script src="../../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap-theme.min.css">
	
    </head>
    
<body>
<?php
include('connexionPG.php');
$exp=$_POST['explications'];
$tram=$_POST['trame'];
$cod=$_POST['code'];
$tit=$_POST['titre'];
$reponse = $bdd->prepare('UPDATE pci_fiches SET explications=?, trame=? , titre= ? WHERE code = ?');
$reponse->execute(array($exp, $tram, $tit, $cod));
echo '<p>fiche '.$cod.' MAJ</p>';
?>


<br>
<div class="container">
	<div class="row">
		<div class="col-lg-2">
			<a href="bdd/vueAdmin.php" class="btn btn-default" role="button">Retour Admin</a>

		</div>
		<div class="col-lg-2">
			<a href="main.php" class="btn btn-primary" role="button">Retour Page Principale</a>
		</div>
	</div>
</div>
</body>
</html>
