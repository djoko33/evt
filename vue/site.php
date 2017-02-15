<?php
session_start();
$_SESSION["fin"]=date("Y-m-d",strtotime("now"));
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - RMPAC-M";
include_once 'header.php';

include('../modele/connexionPG.php');
$reponse = $bdd->query('SELECT * FROM codification');
$libCodes=array();
while ($donnees = $reponse->fetch())
{
 	$libCodes[$donnees['quad']]=$donnees['libelle_court'];
}
$reponse->closeCursor();?>

<div class="container">
	<div class="row">
	    <div class="col-lg-1">
	        <p>
  				<br><a href="../index.php"><span class="glyphicon glyphicon-home logo-small"></span></a>
			</p>
	    </div>
	    <div class="col-lg-1">
	        <p>			</p>
		</div>
			    <div class="col-lg-1">
	        <p>			</p>
		</div>
		<div class="col-lg-3">   
			    <h2><?php echo "RMPAC-M "; ?></h2>
		</div>
		<?php 
		$page="site.php";
		include_once 'temp/date.php';
		?>
	    <div class="col-lg-1">
	      <p></p>
	    </div>
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-2">
			<?php 
	        $title="Nb CVT par trimestre";
	        $id="nbCVT";
	        $data_url="../contr/cvtParSiteTrim.php";
	        $datafield1="trim";
	        $datafield1_Header="Trimestre";
	        $datafield2="nb";
	        $datafield2_Header="Total";
	        include '/temp/table2col.php';?>
		</div>
		<div class="col-lg-4">
	        <?php 
	        $title="Nb CVT par mois";
	        $id="cvtparmois";
	        include 'temp/lineChart.php';?>
		</div>
		<div class="col-lg-6">
	        <?php 
	        $title="Top 10 sur les 12 derniers mois";
	        $id="nbCVT";
	        $data_url="../contr/top10Site.php";
	        $datafield="code";
	        $datafield_Header="Code";
	        include 'temp/tableComplete.php';?>
		</div>      
	</div>
<!-- /.row -->
	<div class="row">
		<div class="col-lg-6">
	        <?php 
	        $title="Presence tracee EM";
	        $id="cvtparemetEm";
	        include 'temp/barGraph.php';?>
		</div>  
	    <div class="col-lg-6">
	        <?php 
	        $title="Presence tracee CdS";
	        $id="cvtparemetCds";
	        include 'temp/barGraph.php';?>
		</div>  	        
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="S&ucirc;ret&eacute; sur les 12 derniers mois";
	        $id="surete";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME sur les 12 derniers mois";
	        $id="nqme";
	        include 'temp/barGraph.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="S&ucirc;ret&eacute; sur les 12 derniers mois ";
	        $id="lineSurete";
	        include 'temp/lineChart.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME sur les 12 derniers mois";
	        $id="lineNQME";
	        include 'temp/lineChart.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
</div>
<?php include 'footer.php';?>

<script src="../../assets/js/quill.js"></script>
<script>

function createConfig(donnees) {
    return {
	type: 'line',
	data: donnees,
	options: 
	{
		title:{
			display:false,
			text:""
		},
		legend: {
			display: true,
			fullWidth : true,
			position : 'bottom',
			labels: {boxWidth: 10}
		},		    			    			
		tooltips: {mode: 'label'},
		animation: {duration: 0},
		responsive: true,
		scales: {
			xAxes: [{}],
			yAxes: [{stacked: false}]
		}
	}};
}


<?php 
	$f=strtotime($_SESSION["fin"]);
	$_SESSION["debutAnnee"]=date("Y-m-d", mktime(0,0,0,1,1,date("Y", $f)));//1er janvier de l'année de fin
	$d=strtotime($_SESSION["debutAnnee"]);
	//calcul les cibles de VT
	$cibleCds="'".ceil(($f-$d)*48/(365*24*3600))."'";
	$cibleEm="'".ceil(($f-$d)*36/(365*24*3600))."'";
	
	
?>
barGraphXYMix('../contr/cvtParEmet.php?type=em', 'cvtparemetEm', 'nb CVT',<?php echo $cibleEm;?>);
barGraphXYMix('../contr/cvtParEmet.php?type=cds', 'cvtparemetCds', 'nb CVT',<?php echo $cibleCds;?>);	

	<?php 
			include "../contr/codeParSiteMois.php";
			global $libCodes;
			//les 12 derniers mois
			$_SESSION["debut"]=date("Y-m-d", strtotime("-12 month", strtotime($_SESSION["fin"])));
			
			$nqme=lstCodesPA('MQME');
			$surete=lstCodesPA('surete');
			
			$t=tabMois(12);
			$strTabData=tabDonnnesJs($nqme, $t);
			
			//creation de labels ["yyyy-mm", "yyyy-mm"...]
			$labels="[\"";
			foreach ($t as $value) {
				$labels.=$value."\", \"";
			}
			$labels=substr($labels,0 ,-3)."]";
			
			$color[0]="\"rgba(80,158,47,1)\"";
			$color[1]="\"rgba(254,88,21,1)\"";
			$color[2]="\"rgba(255,160,47,1)\"";
			$color[3]="\"rgba(9,53,122,1)\"";
			$color[4]="\"rgba(196,214,0,1)\"";
			$color[5]="\"rgba(0,91,187,1)\"";
			$color[6]="\"rgba(117,120,123,1)\"";
			$color[7]="\"rgba(117,120,123,1)\"";
			$color[8]="\"rgba(117,120,123,1)\"";
			$color[9]="\"rgba(117,120,123,1)\"";
			$color[10]="\"rgba(80,158,47,1)\"";
			$color[11]="\"rgba(254,88,21,1)\"";
			$color[12]="\"rgba(255,160,47,1)\"";
			$color[13]="\"rgba(9,53,122,1)\"";
			$color[14]="\"rgba(196,214,0,1)\"";
			$color[15]="\"rgba(0,91,187,1)\"";
			$color[16]="\"rgba(117,120,123,1)\"";
			$color[17]="\"rgba(117,120,123,1)\"";
			$color[18]="\"rgba(117,120,123,1)\"";
			$color[19]="\"rgba(117,120,123,1)\"";
			

			?>

			    var chartData = {
			        labels: <?php echo $labels?>,
			        datasets:
			         
			        [<?php 
			        $max=count($nqme);
			        for ($i = 0; $i < $max-2; $i++) 
			        {
			        echo "
			        {
			            label: '".$libCodes[$nqme[$i]]."',
			            backgroundColor:".$color[$i].",
			            borderColor:" .$color[$i].",
			            lineTension: 0,
			            fill: false,
			            data: ".$strTabData[$i]."
			        },"; 
					}
					echo "
			        {
			            label:  '".$libCodes[$nqme[$max-1]]."',
			            backgroundColor:".$color[1].",
			            borderColor:" .$color[1].",
			            lineTension: 0,
			            fill: false,
			            data: ".$strTabData[$max-1]."
			        }";// le dernier n'a pas de virgule à la fin !
			        ?>]
			    };
				
				var ctx = document.getElementById('lineNQME').getContext("2d");
				var config=createConfig(chartData);
				var nqme = new Chart(ctx, config);
						


				<?php 
				//TODO : factoriser les 2 graphes
						//include "codeparSiteMois.php";
						$strTabData=tabDonnnesJs($surete, $t);
						
						
						?>

						    var chartData = {
						        labels: <?php echo $labels?>,
						        datasets:
						         
						        [<?php 
						        $max=count($surete);
						        for ($i = 0; $i < $max-2; $i++) 
						        {
						        echo "
						        {
						            label: '".$libCodes[$surete[$i]]."',
						            backgroundColor:".$color[$i].",
						            borderColor:" .$color[$i].",
						            lineTension: 0,
						            fill: false,
						            data: ".$strTabData[$i]."
						        },"; 
								}
								echo "
						        {
						            label:  '".$libCodes[$surete[$max-1]]."',
						            backgroundColor:".$color[$max-1].",
						            borderColor:" .$color[$max-1].",
						            lineTension: 0,
						            fill: false,
						            data: ".$strTabData[$max-1]."
						        }";
						        ?>]
						    };
							
							var ctx = document.getElementById('lineSurete').getContext("2d");
							var config=createConfig(chartData);
							var surete = new Chart(ctx, config);

							graph('../contr/codeParSite.php?pa=nqme', "nqme");
							graph('../contr/codeParSite.php?pa=surete', "surete");
							lineGraphSite('../contr/cvtParSite.php', 'cvtparmois');
							
</script>
</body>

</html>
