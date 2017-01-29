<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - TdB PCI";
include_once 'header.php';
?>

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

		<div class="col-lg-3">   
			    <h2><?php echo "TdB PCI"; ?></h2>
		</div>
		<form action=<?php echo "vueSiteTdb.php" ?> method="post" enctype="multipart/form-data">
			<div class="col-lg-4">   
				<br> 			
					<div class="input-daterange input-group" id="datepicker">	    
					    <input type="text" class="input form-control" data-provide="datepicker" name="debut" value=<?php echo $_SESSION["debut"] ?> data-date-format="yyyy-mm-dd" data-date-language="fr"/>
					    <span class="input-group-addon">au</span>
					    <input type="text" class="input form-control" data-provide="datepicker" name="fin" value=<?php echo $_SESSION["fin"] ?> data-date-format="yyyy-mm-dd" data-date-language="fr"/>
						
					</div>						
			</div>
			<div class="col-lg-2"> 
				<br>  
			    <input type="submit" class="btn btn-default" value="Rafraichir">
			</div>
		</form>	
	</div>

<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
			<?php
			include_once "countTdb.php";
	        
	        $id="nbPci Site";
	        if ($_GET['mp']==0) {
	        	$lstCodes=listeCodesPci();
	        	$title="PCI - Site";
	        }
	        else {
	        	$lstCodes=listeCodesPciMp('MP'.$_GET['mp']);
	        	$title="PCI - MP".$_GET['mp'];
	        }
	        include 'tempTablePci.php';?>
		</div>  
	</div>	

</div>

<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/js/Chart.bundle.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/bootstrap-datepicker/locales/bootstrap-datepicker.fr.min.js"></script>
<script src="js/evt.js"></script>
</body>

</html>
