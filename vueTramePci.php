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
        <title>Affiche une trame PCI</title>
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

		<div class="col-lg-9">   
			    <h3><?php echo '<b>'.$d[0]['code'].'</b> : '.$d[0]['titre'];?></h3>
		</div>
	</div>
 <!-- row -->
 	<div class="row">
	 	<div class="col-lg-4">
			<p>Copier-Coller votre CR dans un CVT</p>
		</div>
		<div class="col-lg-2">
			<button type="button" class="btn btn-default" id="copy">Copier</button>
		</div>
		<div class="col-lg-6">
			<?php echo '<a href="fiches/'.$d[0]['code'].'.doc">Compl&eacute;ments : <span class="glyphicon glyphicon-file "></span>         </a>';?>
		</div>
	</div>
	 <!-- row -->
	<div class="col-lg-6">
		<textarea class="form-control" rows="20" id="fichePci" name="fichePci" onselect="getSelectedFromTextarea();">
<?php echo $d[0]['trame']; ?>
		</textarea>
	</div>
	
	<div class="col-lg-6">
		<textarea class="form-control" rows="20" id="explications" name="explications" disabled>
<?php echo $d[0]['explications']; ?>
		</textarea>	
	</div>
	
</div>

 <script type="text/javascript">
    var toCopy  = document.getElementById( 'fichePci' ),
    btnCopy = document.getElementById( 'copy' );

	btnCopy.addEventListener( 'click', function(){
		toCopy.select();
		document.execCommand( 'copy' );
		return false;
	} );
</script>
</body>
</html>