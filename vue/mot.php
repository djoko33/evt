<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - CVT par mot clef";
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
  				<br>
			</p>
		</div>
		<div class="col-lg-1">
	        <p>
  				<br>
			</p>
		</div>       	     

		<div class="col-lg-3">   
			    <h2><?php echo "  "; ?></h2>
		</div>
		<?php 
			$page="\"vue/mot.php\"";
			include_once 'temp/date.php';
		?>	
</div>
<!-- /.row -->
<br><br>
<div class="row">
	    <div class="col-lg-6">
			<form action="../afficheTableConstats.php" method="get" enctype="text/plain">
				<span class="label label-default">Recherche Terrain</span>
			    <div class="input-group">
					
	      			<input type="text" name="keyword" class="form-control" placeholder="mot par mot s&eacute;par&eacute;s par des &">
	      			<span class="input-group-btn">
	        			<button class="btn btn-default" type="submit">Go!</button>
	      			</span>
	      		</div>
      		</form>		
		</div>
		<div class="col-lg-6">
			
	    </div>	        	
	</div>
<!-- /.row -->
<div class="row">
	    <div class="col-lg-6">
			<form action="../afficheTableConstats.php" method="get" enctype="text/plain">
				<span class="label label-default">Recherche PtiREX</span>
			    <div class="input-group">
	      			<input type="text" name="keywordPtiRex" class="form-control" placeholder="mot par mot s&eacute;par&eacute;s par des &">
	      			<span class="input-group-btn">
	        			<button class="btn btn-default" type="submit">Go!</button>
	      			</span>	
	      		</div>
      		</form>
		</div>
		<div class="col-lg-6">
			
	    </div>	        	
</div>
<!-- /.row -->
</div>
<?php include('footer.php');?>
</body>
</html>
