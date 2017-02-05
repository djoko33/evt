<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Affiche un code</title>
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
		</style>
    </head>
    <style>
    form
    {
        text-align:center;
    }
    </style>
<body>
<?php
include('../connexion.php');
$reponse = $bdd->query('SELECT * FROM codification WHERE quad=\''.$_POST['quad'].'\'');
while ($donnees = $reponse->fetch())
{
	$quad=$donnees['quad'];
	$lib=$donnees['libelle'];
	$cat=$donnees['categorie'];
	$lib_court=$donnees['libelle_court'];
}
$reponse->closeCursor();
?>   
<div class="bs-example">
    <form class="form-horizontal" action="code_post.php" method="post">
        <div class="form-group">
        	<label class="control-label col-xs-2">Code</label>
            <div class="col-xs-2"><input type="text" class="form-control" id="quad" name="quad" value="<?php echo $quad;?>" readonly></div>   
            <label class="control-label col-xs-2">Libelle Court</label>
            <div class="col-xs-2"><input type="text" class="form-control col-xs-2" id="libelle_court" name="libelle_court" value="<?php echo $lib_court;?>"></div>   
        </div>            
        <div class="form-group">
            <label class="control-label col-xs-2" for="libelle">Libelle</label>
            <div class="col-xs-2"><input type="text" class="form-control" id="libelle" name="libelle" value="<?php echo $lib;?>"></div>            
			<div>
	        	<select class="selectpicker CAT col-xs-4" id="categorie" name="categorie" data-live-search="true" title="Codification">
					<?php include 'choixCategorie.php'; 	?>
				</select>
			</div>
	   
        </div>
       
		<br>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
</div>
<script>
$(document).ready(function() {
	$('.selectpicker').selectpicker();
	<?php echo "$('.CAT').selectpicker('val', '".$cat."');\n";
	?>
			});
</script>


</body>
</html>