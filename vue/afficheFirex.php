<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=9">
        <title>Affiche une fiche BIP/CID/Firex BLA</title>
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
function strBase($base)
{   if ($base=='1') {return "CID";}
	if ($base=='2') {return "Firex BLA";}
	if ($base=='3') {return "CID";}
}

include('../modele/connexionRexing.php');
$reponse = $bdd->query('SELECT numrex AS reference, titre, descri AS texte, auteur as emetteur, date as datecvt, notes as url, site, palier, base, type FROM rex WHERE numrex=\''.$_POST['fiche_ref'].'\'');
//echo "<p>".$_POST['cvt_ref']."</p>";
while ($donnees = $reponse->fetch())
{
	$titre=$donnees['titre'];
	$ref=$donnees['reference'];
	$texte=$donnees['texte'];
	$site=$donnees['site'];
	$palier=$donnees['palier'];
	$base=strBase($donnees['base']);
	$type=$donnees['type'];
	//$action=$donnees['action'];
	$dateCVT=$donnees['datecvt'];
	//$sect_emet=$donnees['serv_emet']."-".$donnees['sect_emet'];
	//$sect_conc=$donnees['serv_conc']."-".$donnees['sect_conc'];
	$emetteur=$donnees['emetteur'];
	//$arrCodes=$donnees['codes'];
	//$exploded=explode(",", $arrCodes);
	//$arrCodesQuotes=array();
	//foreach ($exploded as $c){
		//$arrCodesQuotes[]="'".$c."'";
	//}
	//$strCodes=implode(",", $arrCodesQuotes);
	//$strSP=arrQuotes($donnees['sp']);
	$url=$donnees['url'];
}
$reponse->closeCursor();
?>   
<div class="container">
	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="../main.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
			</p>
	    </div>
	    <div class="col-lg-1">
	        <p>
  				<br><a href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><span class="glyphicon glyphicon-circle-arrow-left logo-small"></span></a>
			</p>
		</div>
	    <div class="col-lg-8">
	        <h3 id="titre" class="page-header"><a href='<?php echo $url;?>'><?php echo $ref.' : '.$titre; ?></a></h3>
	    </div>
	    <div class="col-lg-2">
	      <p></p>
	    </div>
	</div>
	<div class="bs-example">
  		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Date de l'evenement</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $dateCVT;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Auteur</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $emetteur;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Site</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $site;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Palier</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $palier;?>
  				</div>
			</div>
		</div>           	
    </div>     
 	<div class="bs-example">
		<div class="col-xs-9">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Type Evt</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $type;?>
  				</div>
			</div>
		</div>
		<div class="col-xs-3">
            <div class="panel panel-default">
  				<div class="panel-heading">
    				<h3 class="panel-title">Base</h3>
  				</div>
  				<div class="panel-body">
   					<?php echo $base;?>
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
     

</body>
</html>