<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - TdB Service";
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
			    <h2><?php echo $_SESSION["serv"]; ?></h2>
		</div>

		<?php 
		$page="vueServiceTdB.php?serv=". $_SESSION["serv"];
		include_once 'temp/date.php';
		?>		
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
			<?php 
	        $title="PCI - ".$_GET['serv'];
	        $id="nbPciEmet";
	        $data_url="CvtPciTdbEmet.php?serv=".$_GET['serv'];
	        $datafield1="class";
	        $datafield1_Header="Code PCI";
	        $datafield2="emet";
	        $datafield2_Header="Emetteur";
	        $datafield3="nb";
	        $datafield3_Header="Nb";
	        include 'temp/table3col.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="PCI - ".$_GET['serv'];
	        $id="nbPci Service";
	        include 'temp/tablePciServ.php';?>
	    </div>       
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
			<?php 
	        $title="Nb CVT - ".$_GET['serv']." &eacute;metteur - PCI + PPT";
	        $id="nbCVT";
	        $data_url="CvtTdbEmet.php?serv=".$_GET['serv'];
	        $datafield1="emet";
	        $datafield1_Header="Emetteur";
	        $datafield2="nb";
	        $datafield2_Header="Nb CVT";
	        include 'temp/table2col.php';?>
		</div>
	    <div class="col-lg-6">
			<?php 
			$id="nbPci";
	        $title="PCI - ".$_GET['serv'];
	        $data_url="CvtPciTdb.php?serv=".$_GET['serv'];
	        $datafield1="class";
	        $datafield1_Header="Code PCI";
	        $datafield2="nb";
	        $datafield2_Header="Nb";
	        include 'temp/table2col.php';?>
	    </div>	        
	</div>

</div>
<?php include 'footer.php';?>
<script>

	
	var service=getQuerystring('serv');	
	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 

</script>
</body>

</html>
