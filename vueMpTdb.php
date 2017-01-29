<?php
session_start();
include_once 'session.php';
if (isset($_GET['serv'])) {
	$_SESSION["serv"]=$_GET['serv'];
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="IE=9">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Exploitation Visites Terrain</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">
	<link rel="stylesheet" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/vue.css" type="text/css">
    <!-- Custom Fonts -->
    <link href="../assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style type="text/css">

.pcigreen {background-color: rgb(80, 158, 47);} 
.pcired {background-color: rgb(254, 88, 21);}
</style>
</head>

<body>
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
	    <div class="col-lg-12">
			<?php 
	        $title="PCI - Site";
	        $id="nbPci Site";
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
<script src="js/evt.js"></script>
</body>

</html>
