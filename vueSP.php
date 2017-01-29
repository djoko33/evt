<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - CVT par SP";
include_once 'header.php';
?>

<div class="container">
	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="main.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
			</p>

	    </div>
	    <div class="col-lg-1">
	        <p>
  				<br><a class="link tooltip-link"   data-toggle="tooltip"   data-original-title="D&eacute;tails CVT N&eacute;gatifs" href="<?php echo "afficheTableConstats.php?sp=".$_GET['sp']."&nature=0"; ?>"><span class="glyphicon glyphicon-list-alt logo-small-red"></span></a>
			</p>
		</div>
			    <div class="col-lg-1">
	        <p>
  				<br><a class="link tooltip-link"   data-toggle="tooltip"   data-original-title="D&eacute;tails CVT Positifs" href="<?php echo "afficheTableConstats.php?sp=".$_GET['sp']."&nature=1"; ?>"><span class="glyphicon glyphicon-list-alt logo-small-green"></span></a>
			</p>
		</div>
		<div class="col-lg-3">   
			    <h2><?php echo $_SESSION["sp"]." : CVT du "; ?></h2>
		</div>
		<form action=<?php echo "vueSP.php?sp=". $_SESSION["sp"]; ?> method="post" enctype="multipart/form-data">
			<div class="col-lg-4">   
				<br> 			
					<div class="input-daterange input-group" id="datepicker">	    
					    <input type="text" class="input form-control" data-provide="datepicker" name="debut" value=<?php echo $_SESSION["debut"] ?> data-date-format="yyyy-mm-dd"/>
					    <span class="input-group-addon">au</span>
					    <input type="text" class="input form-control" data-provide="datepicker" name="fin" value=<?php echo $_SESSION["fin"] ?> data-date-format="yyyy-mm-dd"/>
						
					</div>						
			</div>
			<div class="col-lg-2"> 
				<br>  
			    <input type="submit" class="btn btn-default" value="Rafraichir">
			</div>
		</form>	
	</div>
	<div class="row">
	    <div class="col-lg-6">
			<?php 
	        $title="Nb CVT - ".$_GET['sp'];
	        $id="nbCVT";
	        $data_url="CVTparSPTrim.php?sp=".$_GET['sp'];
	        $datafield="trim";
	        $datafield_Header="Trimestre";
	        include 'tempTableComplete.php';?>
		</div>
		<div class="col-lg-6">
	        <?php 
	        $title="Nb CVT - ".$_GET['sp'];
	        $id="graphSP";
	        include 'tempLineChart.php';?>
		</div>
	</div>
<!-- /.row -->
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title=$_GET['sp']." - Services &eacute;metteurs";
	        $id="graphSPEmet";
	        include 'tempBarGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title=$_GET['sp']." - Services concern&eacute;s";
	        $id="graphSPConc";
	        include 'tempBarGraph.php';?>	    	
	     </div>       
	</div>
	<!-- /.row -->

<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/Chart.bundle.js"></script>
<script src="js/evt.js"></script>
<script>	
	var sp=getQuerystring('sp');	
	barGraph('serviceparSP.php?sp='+sp+'&sens=emet', "graphSPEmet");
	barGraph('serviceparSP.php?sp='+sp+'&sens=conc', "graphSPConc");
	lineGraph('CVTparSP.php?sp='+sp, "graphSP", sp);

	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 
				
</script>
</body>

</html>
