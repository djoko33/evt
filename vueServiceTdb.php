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
			    <h2><?php echo $_SESSION["serv"]." : constats du "; ?></h2>
		</div>
		<form action=<?php echo "vueServiceTdB.php?serv=". $_SESSION["serv"]; ?> method="post" enctype="multipart/form-data">
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
	        include 'tempTable3col.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="PCI - ".$_GET['serv'];
	        $id="nbPci Service";
	        include 'tempTablePciServ.php';?>
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
	        include 'tempTable2col.php';?>
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
	        include 'tempTable2col.php';?>
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
<script src="js/evt.js"></script>
<script>

	
	var service=getQuerystring('serv');	
	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 

</script>
</body>

</html>
