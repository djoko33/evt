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
  				<br><a href="../index.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
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
		<?php 
			$page="\"vue/service.php?serv=". $_SESSION["serv"]."\"";
			include_once 'temp/date.php';
		?>		
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
	        include 'temp/table2col.php';?>
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
	        include 'temp/table2col.php';?>
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
	        include 'temp/table2col.php';?>
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
	        include 'temp/table2col.php';?>
	    </div>	        	        
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
	    	<?php 
	    	$title="Commentaires Generaux";
	    	$idComment=$_GET['serv']."gen";
	    	include 'temp/comment.php';?>
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
	        include 'temp/tableComplete.php';?>
		</div>
		<div class="col-lg-6">
	    	<?php 
	        $title="Top 10 - ".$_GET['serv']." concern&eacute;";
	        $id="nbCVT";
	        $data_url="top10.php?serv=".$_GET['serv']."&sens=conc";
	        $datafield="code";
	        $datafield_Header="Code";
	        include 'temp/tableComplete.php';?>
	    </div>
	        
	</div>
	<div class="row">
	    <div class="col-lg-3">
	        <?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." &eacute;metteur";
	        $id="SurEmet";
	        include 'temp/barGraph.php';?>
		</div>	
	    <div class="col-lg-3">
	        <?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." &eacute;metteur";
	        $pa="surete";
	        $sens="emet";
	        include 'temp/tablesCvt.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." concern&eacute;";
	        $id="SurConc";
	        include 'temp.barGraph.php';?>	    	
	     </div>       
		<div class="col-lg-3">
			<?php 
	        $title="S&ucirc;ret&eacute; - ".$_GET['serv']." concern&eacute;";
	        $pa="surete";
	        $sens="conc";
	        include 'temp/tablesCvt.php';?>
	     </div>       
	</div>
	<!-- /.row -->
	<div class="row">
	    <div class="col-lg-3">
	        <?php 
	        $title="NQME - ".$_GET['serv']." &eacute;metteur";
	        $id="NqmeEmet";
	        include 'temp/barGraph.php';?>
		</div>   
	    <div class="col-lg-3">
	        <?php 
	        $title="NQME - ".$_GET['serv']." &eacute;metteur";
	        $pa="MQME";
	        $sens="emet";
	        include 'temp/tablesCvt.php';?>
		</div>
		<div class="col-lg-3">
			<?php 
	        $title="NQME - ".$_GET['serv']." concern&eacute;";
	        $id="NqmeConc";
	        include 'temp/barGraph.php';?>	    	
	     </div>    
		<div class="col-lg-3">
			<?php 
	        $title="NQME - ".$_GET['serv']." concern&eacute;";
	        $pa="MQME";
	        $sens="conc";
	        include 'temp/tablesCvt.php';?>
	     </div>       
	</div>
	<!-- /.row -->
		<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="Codes Sp&eacute;cifiques Service - ".$_GET['serv']." &eacute;metteur";
	        $id="ServEmet";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="Codes Sp&eacute;cifiques Service - ".$_GET['serv']." concern&eacute;";
	        $id="ServConc";
	        include 'temp/barGraph.php';?>	    	
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
	        include 'temp/tablesCvt.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="Codes Sp&eacute;cifiques - ".$_GET['serv']." concern&eacute;";
	        $pa=$_GET['serv'];
	        $sens="conc";
	        include 'temp/tablesCvt.php';?>
	     </div>       
	</div>
	<!-- /.row -->
</div>
<?php include 'footer.php';?>
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
