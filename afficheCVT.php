<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9">
        <title>Affiche un CVT</title>
	    <script src="../assets/js/jquery-2.2.3.min.js"></script>
		<script src="../assets/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
		<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
		<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
		<link rel="stylesheet" href="../assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" />
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="../assets/bootstrap-select/dist/css/bootstrap-select.min.css">
    	<link rel="stylesheet" href="../assets/bootstrap-table/bootstrap-table.min.css">

		<style type="text/css">
		    .bs-example{
		    	margin: 20px;
		    }
		</style>
    </head>
    <style>
	    form
	    {
	        text-align:center;
	    }
	    th
	    {
		text-align:center;
		}
	
		h1 {text-align:center;}
		.logo-small {
	      color: #f4511e;
	      font-size: 30px;}
    </style>

<body>
<?php
function arrQuotes($arrComma)
{
	$exploded=explode(",", $arrComma);
	$arrCommaQuotes=array();
	foreach ($exploded as $c){
		$arrCommaQuotes[]="'".$c."'";
	}
	return implode(",", $arrCommaQuotes);
}


include('connexionPG.php');
$reponse = $bdd->query('SELECT * FROM CVT WHERE reference=\''.$_POST['cvt_ref'].'\'');
//echo "<p>".$_POST['cvt_ref']."</p>";
while ($donnees = $reponse->fetch())
{
	$titre=$donnees['titre'];
	$ref=$donnees['reference'];
	$texte=$donnees['texte'];
	$action=$donnees['action'];
	$dateCVT=$donnees['datecvt'];
	$sect_emet=$donnees['serv_emet']."-".$donnees['sect_emet'];
	$sect_conc=$donnees['serv_conc']."-".$donnees['sect_conc'];
	$emetteur=$donnees['emetteur'];
	$arrCodes=$donnees['codes'];
	$exploded=explode(",", $arrCodes);
	$arrCodesQuotes=array();
	foreach ($exploded as $c){
		$arrCodesQuotes[]="'".$c."'";
	}
	$strCodes=implode(",", $arrCodesQuotes);
	$strSP=arrQuotes($donnees['sp']);
}
$reponse->closeCursor();
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
  				<br><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span class="glyphicon glyphicon-circle-arrow-left logo-small"></span></a>
			</p>
		</div>
	    <div class="col-lg-8">
	        <h1 id="titre" class="page-header"><?php echo $_POST['cvt_ref'] ?></h1>
	    </div>
	    <div class="col-lg-2">
	      <p></p>
	    </div>
	</div>
	<div class="bs-example">
  		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Date du constat</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $dateCVT;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Emis par</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $emetteur;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Section</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $sect_emet;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Section Concern&eacute;e</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $sect_conc;?>
  				</div>
			</div>
		</div>           	
    </div>     
 	<div class="bs-example">
  		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Codification</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $strCodes;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">SP concern&eacute;s</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $strSP;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Cat&eacute;gorie</h3>
  				</div>
  				<div class="panel-body">
   					4 - Conserv&eacute; pour tendance
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Type CVT</h3>
  				</div>
  				<div class="panel-body">
   					PPT
  				</div>
			</div>
		</div>          	
</div>          	
			
    <div class="bs-example">
        <div class="col-xs-12">
            <div class="panel panel-default">
  				<div class="panel-body">
    				<b><?php echo $titre;?></b><br><br>
    				<?php echo $texte;?><br><br>
    				<?php echo $action;?><br>
  				</div>
			</div>
        </div>
    </div>    
</div>
     
</div>

</body>
</html>