<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - CVT par Service";
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
  				<br><a class="link tooltip-link"   data-toggle="tooltip"   data-original-title="D&eacute;tails CVT N&eacute;gatifs" href="<?php echo "afficheTableConstatsServCode.php?serv_conc=".$_GET['serv']."&nature=0&code=EM01"; ?>"><span class="glyphicon glyphicon-list-alt logo-small-red"></span></a>
			</p>
		</div>
		<div class="col-lg-1">
	        <p>
  				<br><a class="link tooltip-link"   data-toggle="tooltip"   data-original-title="D&eacute;tails CVT Positifs" href="<?php echo "afficheTableConstats.php?serv_conc=".$_GET['serv']."&nature=1"; ?>"><span class="glyphicon glyphicon-list-alt logo-small-green"></span></a>
			</p>
		</div>       	     

		<div class="col-lg-3">   
			    <h2><?php echo $_SESSION["serv"]." : constats du "; ?></h2>
		</div>
		<form action=<?php echo "\"vueService.php?serv=". $_SESSION["serv"]."\""; ?> method="post" enctype="multipart/form-data">
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
	    <div class="col-lg-3">
			<?php 
	        $title="Nb CVT - ".$_GET['serv']." &eacute;metteur";
	        $id="nbCVT";
	        $data_url="CVTparService.php?serv=".$_GET['serv'];
	        $datafield1="trim";
	        $datafield1_Header="Trimestre";
	        $datafield2="nb";
	        $datafield2_Header="Total";
	        include 'tempTable2col.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="PFI - ".$_GET['serv']." &eacute;metteur";
	        $id="nbPFI";
	        $data_url="PFIparService.php?serv=".$_GET['serv'];
	        $datafield1="pfi";
	        $datafield1_Header="PFI";
	        $datafield2="nb";
	        $datafield2_Header="Total";
	        include 'tempTable2col.php';?>
	    </div>	        
	    <div class="col-lg-3">
	        <?php 
	        $title="Services Observ&eacute;s par ".$_GET['serv'];
	        $id="nbServConc";
	        $data_url="servicesObserves.php?serv=".$_GET['serv'];
	        $datafield1="serv";
	        $datafield1_Header="Services Observ&eacute;s";
	        $datafield2="nb";
	        $datafield2_Header="";
	        include 'tempTable2col.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="Services Observants ".$_GET['serv'];
	        $id="nbServEmet";
	        $data_url="servicesObservants.php?serv=".$_GET['serv'];
	        $datafield1="serv";
	        $datafield1_Header="Services Observants";
	        $datafield2="nb";
	        $datafield2_Header="";
	        include 'tempTable2col.php';?>
	    </div>	        	        
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	    	<?php 
	    	$title="Commentaires Generaux";
	    	$idComment=$_GET['serv']."gen";
	    	include 'tempComment.php';?>
		</div>
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="Top 10 - ".$_GET['serv']." &eacute;metteur";
	        $id="nbCVT";
	        $data_url="top10.php?serv=".$_GET['serv']."&sens=emet";
	        $datafield="code";
	        $datafield_Header="Code";
	        include 'tempTableComplete.php';?>
		</div>
		<div class="col-lg-6">
	    	<?php 
	        $title="Top 10 - ".$_GET['serv']." concern&eacute;";
	        $id="nbCVT";
	        $data_url="top10.php?serv=".$_GET['serv']."&sens=conc";
	        $datafield="code";
	        $datafield_Header="Code";
	        include 'tempTableComplete.php';?>
	    </div>
	        
	</div>
	<div class="row">
	    <div class="col-lg-3">
	        <?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." &eacute;metteur";
	        $id="SurEmet";
	        include 'tempBarGraph.php';?>
		</div>	
	    <div class="col-lg-3">
	        <?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." &eacute;metteur";
	        $pa="surete";
	        $sens="emet";
	        include 'tempTablesCVT.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." concern&eacute;";
	        $id="SurConc";
	        include 'tempBarGraph.php';?>	    	
	     </div>       
		<div class="col-lg-3">
			<?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." concern&eacute;";
	        $pa="surete";
	        $sens="conc";
	        include 'tempTablesCVT.php';?>
	     </div>       
	</div>
	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-3">
	        <?php 
	        $title="NQME - ".$_GET['serv']." &eacute;metteur";
	        $id="NqmeEmet";
	        include 'tempBarGraph.php';?>
		</div>   
	    <div class="col-lg-3">
	        <?php 
	        $title="NQME - ".$_GET['serv']." &eacute;metteur";
	        $pa="MQME";
	        $sens="emet";
	        include 'tempTablesCVT.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="NQME - ".$_GET['serv']." concern&eacute;";
	        $id="NqmeConc";
	        include 'tempBarGraph.php';?>	    	
	     </div>    
		<div class="col-lg-3">
			<?php 
	        $title="NQME - ".$_GET['serv']." concern&eacute;";
	        $pa="MQME";
	        $sens="conc";
	        include 'tempTablesCVT.php';?>
	     </div>       
	</div>
	<!-- /.row -->
		<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="Codes Sp&eacute;cifiques Service - ".$_GET['serv']." &eacute;metteur";
	        $id="ServEmet";
	        include 'tempBarGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="Codes Sp&eacute;cifiques Service - ".$_GET['serv']." concern&eacute;";
	        $id="ServConc";
	        include 'tempBarGraph.php';?>	    	
	     </div>       
	</div>
	<!-- /.row -->
	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="Codes Sp&eacute;cifiques - ".$_GET['serv']." &eacute;metteur";
	        $pa=$_GET['serv'];
	        $sens="emet";
	        include 'tempTablesCVT.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="Codes Sp&eacute;cifiques - ".$_GET['serv']." concern&eacute;";
	        $pa=$_GET['serv'];
	        $sens="conc";
	        include 'tempTablesCVT.php';?>
	     </div>       
	</div>
	<!-- /.row -->
</div>
<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/js/Chart.bundle.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="js/evt.js"></script>
<script src="../assets/js/quill.js"></script>

<script>

<?php 
include_once('fnComment.php');
echo initCommentPanel($_GET['serv']."gen");

?>

	var service=getQuerystring('serv');	
	graph('codeparService.php?serv='+service+'&pa=MQME&sens=conc', "NqmeConc");
	graph('codeparService.php?serv='+service+'&pa=MQME&sens=emet', "NqmeEmet");
	graph('codeparService.php?serv='+service+'&pa=surete&sens=conc', "SurConc");
	graph('codeparService.php?serv='+service+'&pa=surete&sens=emet', "SurEmet");
	graph('codeparService.php?serv='+service+'&pa='+service+'&sens=conc', "ServConc");
	graph('codeparService.php?serv='+service+'&pa='+service+'&sens=emet', "ServEmet");

	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 

</script>
</body>

</html>
