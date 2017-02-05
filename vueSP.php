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
			    <h2><?php echo $_SESSION["sp"]; ?></h2>
		</div>
		<?php 
			$page="vueSP.php?sp=". $_SESSION["sp"];
			include_once 'temp/date.php';
		?>		
	</div>
	<div class="row">
	    <div class="col-lg-6">
			<?php 
	        $title="Nb CVT - ".$_GET['sp'];
	        $id="nbCVT";
	        $data_url="CVTparSPTrim.php?sp=".$_GET['sp'];
	        $datafield="trim";
	        $datafield_Header="Trimestre";
	        include 'temp/tableComplete.php';?>
		</div>
		<div class="col-lg-6">
	        <?php 
	        $title="Nb CVT - ".$_GET['sp'];
	        $id="graphSP";
	        include 'temp/lineChart.php';?>
		</div>
	</div>
<!-- /.row -->
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title=$_GET['sp']." - Services &eacute;metteurs";
	        $id="graphSPEmet";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title=$_GET['sp']." - Services concern&eacute;s";
	        $id="graphSPConc";
	        include 'temp/barGraph.php';?>	    	
	     </div>       
	</div>
	<!-- /.row -->
</div>
<?php include('footer.php');?>
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
