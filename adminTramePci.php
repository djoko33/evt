<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche une trame PCI</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">
		<style type="text/css">
		    .bs-example{
		    	margin: 20px;
		    }
		    .th {
    text-align: left;
		</style>
    </head>
   
<body>






<div class="container">

<?php
	include('connexionPG.php');
	for ($i = 1; $i < 9; $i++)
	{
		// Récupération des codes PCI du MP
		$rep = $bdd->prepare('SELECT DISTINCT(code), titre FROM pci_fiches WHERE mp= ? ORDER BY code');
		$rep->execute(array($i));
		echo '
	<table class="table">
		<thead>
			<tr>
				<th>Code</th>
				<th>Titre</th>
				<th></th>
			</tr>
		</thead>';	

		while ($don = $rep->fetch())
		{											
				echo '
				<tbody>
			      <tr>
			        <td>'.$don['code'].'</td>
			        <td>'.$don['titre'].'</td>
			        <td><a href="editTramePci.php?code='.$don['code'].'">Editer</a></td>
			      </tr>
				</tbody>';
		}
	echo '</table>';
	}
	$rep->closeCursor();	
?>
   
 

</body>
</html>