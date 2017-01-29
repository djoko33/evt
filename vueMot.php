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
  				<br><a href="main.php"><span class="glyphicon glyphicon-home logo-small-red"></span></a>
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
			    <h2><?php echo " Constats du "; ?></h2>
		</div>
		<form action=<?php echo "\"vueMot.php\""; ?> method="post" enctype="multipart/form-data">
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
<br><br>
	<div class="row">
	    <div class="col-lg-6">
			<form action="afficheTableConstats.php" method="get" enctype="text/plain">
			<span class="label label-default">Recherche Terrain</span>
		    <div class="input-group">
				
      			<input type="text" name="keyword" class="form-control" placeholder="mot par mot s&eacute;par&eacute;s par des &">
      			<span class="input-group-btn">
        			<button class="btn btn-default" type="submit">Go!</button>
      			</span>

		
		</div></form>
		<div class="col-lg-6">
			
	    </div>	        	
</div>
<!-- /.row -->
<div class="row">
	    <div class="col-lg-6">
			<form action="afficheTableConstats.php" method="get" enctype="text/plain">
			<span class="label label-default">Recherche PtiREX</span>
		    <div class="input-group">
      			<input type="text" name="keywordPtiRex" class="form-control" placeholder="mot par mot s&eacute;par&eacute;s par des &">
      			<span class="input-group-btn">
        			<button class="btn btn-default" type="submit">Go!</button>
      			</span>	
		</div></form>
		<div class="col-lg-6">
			
	    </div>	        	
</div>
<!-- /.row -->
<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<script src="js/evt.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
</body>

</html>
