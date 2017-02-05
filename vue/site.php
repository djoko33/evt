<?php
session_start();
include_once 'session.php';

$pageTitle="Exploitation Visites Terrain - RMPAC-M";
include_once 'header.php';

include('connexionPG.php');
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
		$page="vue/site.php";
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
	        $data_url="CVTparSiteTrim.php";
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
	        $title="Top 10 ";
	        $id="nbCVT";
	        $data_url="top10Site.php";
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
	        $title="S&ucirc;ret&eacute; ";
	        $id="surete";
	        include 'temp/barGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME";
	        $id="nqme";
	        include 'temp/barGraph.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="S&ucirc;ret&eacute; ";
	        $id="lineSurete";
	        include 'temp/lineChart.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME";
	        $id="lineNQME";
	        include 'temp/lineChart.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
</div>
<?php include 'footer.php';?>

<script src="../assets/js/quill.js"></script>
<script>
var toolbarOptions = [
                      ['bold', 'italic', 'underline'],        // toggled buttons
                      [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                      [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                      [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                      [{ 'align': [] }],

                      ['clean']                                         // remove formatting button
                    ];

                    var quill = new Quill('#comment', {
                      modules: {
                        toolbar: toolbarOptions
                      },
                      theme: 'snow'
                    });
	
	
	
	graph('codeparSite.php?pa=nqme', "nqme");
	graph('codeparSite.php?pa=surete', "surete");
	lineGraphSite('CVTparSite.php', 'cvtparmois');

	<?php 
	$d=strtotime($_SESSION["debut"]);
	$f=strtotime($_SESSION["fin"]);
	$cibleCds="'".ceil(($f-$d)*48/(365*24*3600))."'";
	$cibleEm="'".ceil(($f-$d)*36/(365*24*3600))."'";
	?>
	barGraphXYMix('cvtParEmet.php?type=em', 'cvtparemetEm', 'nb CVT',<?php echo $cibleEm;?>);
	barGraphXYMix('cvtParEmet.php?type=cds', 'cvtparemetCds', 'nb CVT',<?php echo $cibleCds;?>);

	<?php 
			include "codeparSiteMois.php";
			global $libCodes;
			$nqme=array("EM01", "EM02", "EM06", "EM08", "EM09", "EM17", "EM19", "OM11", "PH05");
			$surete=array("EM05", "EM08", "EM13", "MA14", "SN01", "SN03", "SN14", "SN16");
			//TODO : debugger le $tab dans count.php
			$tab=array("2016-01", "2016-02", "2016-03",  "2016-04", "2016-05", "2016-06", "2016-07", "2016-08", "2016-09", "2016-10",  "2016-11", "2016-12", "2017-01");
			$r=tabPA($nqme, $tab);//tabAnneeMois(2016, 1, 2016, 8));

			$strtabMois="[\"";
			foreach (array_keys($r[$nqme[0]]) as $m) {
				$strtabMois=$strtabMois.$m."\", \"";
			}
			$strtabMois=substr($strtabMois,0 ,-3)."]";
			$strTabData=array();
			$i=0;
			foreach ($nqme as $c) {
				$strData="[";
				foreach (array_values($r[$nqme[$i]]) as $d) {
					$strData=$strData.$d.", ";
				}
				$strTabData[$i]=substr($strData,0 ,-2)."]";
				$i+=1;
			}
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
			

			?>

			    var ChartData = {
			        labels: <?php echo $strtabMois?>,
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
			        }";
			        ?>]
			    };
				
				var ctx = document.getElementById('lineNQME').getContext("2d");
				window.myLine = new Chart(ctx, 
						{
				            type: 'line',
				            data: ChartData,
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
			            			labels: {
					    				boxWidth: 10}
				    			},
				    			
				                tooltips: {
				                    mode: 'label'
				                },
				                animation: {
					                duration: 0},
				                responsive: true,
				                scales: 
				                {
				                    xAxes: [{

				                    }],
				                    yAxes: [{
				                        stacked: false
				                    }]
				                }
				            }
				        });

				<?php 
				//TODO : factoriser les 2 graphes
						//include "codeparSiteMois.php";
						$surete=array("EM05", "EM08", "EM13", "MA14", "SN01", "SN03", "SN14", "SN16");
						$tab=array("2016-01", "2016-02", "2016-03",  "2016-04", "2016-05", "2016-06", "2016-07", "2016-08", "2016-09", "2016-10",  "2016-11", "2016-12");
						$r=tabPA($surete, $tab);//tabAnneeMois(2015, 5, 2016, 8));

						$strtabMois="[\"";
						foreach (array_keys($r[$surete[0]]) as $m) {
							$strtabMois=$strtabMois.$m."\", \"";
						}
						$strtabMois=substr($strtabMois,0 ,-3)."]";
						$strTabData=array();
						$i=0;
						foreach ($surete as $c) {
							$strData="[";
							foreach (array_values($r[$surete[$i]]) as $d) {
								$strData=$strData.$d.", ";
							}
							$strTabData[$i]=substr($strData,0 ,-2)."]";
							$i+=1;
						}
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
						
						?>

						    var ChartData = {
						        labels: <?php echo $strtabMois?>,
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
							window.myLine = new Chart(ctx, 
									{
							            type: 'line',
							            data: ChartData,
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
						            			labels: {
								    				boxWidth: 10}
							    			},
							                tooltips: {
							                    mode: 'label'
							                },
							                animation: {
								                duration: 0},
							                responsive: true,
							                scales: 
							                {
							                    xAxes: [{

							                    }],
							                    yAxes: [{
							                        stacked: false
							                    }]
							                }
							            }
							        });








	
	$(function() 
			 {  
			 $(".tooltip-link").tooltip(); 
			 }); 
</script>
</body>

</html>
