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
  				<br><a href="../index.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
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
		<?php 
		$page="siteTdb.php?mp=0";
		include_once 'temp/date.php';
		?>		
	</div>

<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
			<?php
			include_once "../modele/countTdb.php";
	        
	        $id="nbPci Site";
	        if ($_GET['mp']==0) {
	        	$lstCodes=listeCodesPci();
	        	$title="PCI - Site";
	        }
	        else {
	        	$lstCodes=listeCodesPciMp('MP'.$_GET['mp']);
	        	$title="PCI - MP".$_GET['mp'];
	        }
	        include 'temp/tablePci.php';?>
		</div>  
	</div>	

</div>

<?php include('footer.php')?>
</body>

</html>
