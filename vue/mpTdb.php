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
<!-- <div class="col-lg-4+2"> -->	 		
		<?php 
		$page="vue/siteTdb.php";
		include_once 'temp/date.php';
		?>
<!-- </div> -->	
	</div>

<!-- /.row -->
	<div class="row">
	    <div class="col-lg-12">
			<?php 
	        $title="PCI - Site";
	        $id="nbPci Site";
	        include 'temp/tablePci.php';?>
		</div>  
	</div>	

</div>

<?php include 'footer.php';?>
</body>

</html>
