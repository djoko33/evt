<?php 
include('connexionPG.php');
$reponse = $bdd->prepare('SELECT * FROM pci_fiches WHERE code = ?');
$reponse->execute(array($_GET['code']));
$d=$reponse->fetchAll();
$reponse->closeCursor();?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Edite une trame PCI</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">
    	<link rel="stylesheet" href="css/vue.css" type="text/css">
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


<div class="container">	
 <form action="editTramePciPost.php" method="post">
 	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="main.php"><span class="glyphicon glyphicon-home logo-small-red"></span></a>
			</p>
	    </div>
	    <div class="col-lg-1">
	        <p>
  			
			</p>
		</div>
		<div class="col-lg-1">
	        <p>

			</p>
		</div>       	     

		<div class="col-lg-2">   
			    <label><?php echo $d[0]['code'];?></label>
		</div>
		<div class="col-lg-6">   
			    <input type="text" class="form-control" name="titre" value="<?php echo $d[0]['titre'];?>">
		</div>
	</div>
 <!-- row -->

	<div class="row">
		<div class="col-lg-6">
			<textarea class="form-control" rows="20" id="fichePci" name="trame">
<?php echo $d[0]['trame']; ?>
			</textarea>
		</div>	
		<div class="col-lg-6">
			<textarea class="form-control" rows="20" id="explications" name="explications" >
<?php echo $d[0]['explications']; ?>
			</textarea>
		</div>
	</div>
<!-- row -->
<br>
<input type="hidden" name="code" value=<?php echo $_GET['code'];?>>
<input type="submit" class="btn btn-default" id="submit" value="Sauvegarder">

</form>	
</div>

</body>
</html>