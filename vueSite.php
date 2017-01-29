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
  				<br><a href="main.php"><span class="glyphicon glyphicon-home logo-small-red"></span></a>
			</p>
	    </div>
	    <div class="col-lg-1">
	        <p>			</p>
		</div>
			    <div class="col-lg-1">
	        <p>			</p>
		</div>
		<div class="col-lg-3">   
			    <h2><?php echo "RMPAC-M : CVT du "; ?></h2>
		</div>
		<form action=<?php echo "vueSite.php"; ?> method="post" enctype="multipart/form-data">
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
	    <div class="col-lg-1">
	      <p></p>
	    </div>
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
			<?php 
	        $title="Nb CVT par trimestre";
	        $id="nbCVT";
	        $data_url="CVTparSiteTrim.php";
	        $datafield1="trim";
	        $datafield1_Header="Trimestre";
	        $datafield2="nb";
	        $datafield2_Header="Total";
	        include 'tempTable2col.php';?>
		</div>
		<div class="col-lg-6">
	        <?php 
	        $title="Nb CVT par mois";
	        $id="cvtparmois";
	        include 'tempBarGraph.php';?>
		</div>       
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="Top 10 ";
	        $id="nbCVT";
	        $data_url="top10Site.php";
	        $datafield="code";
	        $datafield_Header="Code";
	        include 'tempTableComplete.php';?>
		</div>
		<div class="col-lg-6">
	    	<div class="panel panel-default">
				<div class="panel-heading">
				    <i class="fa fa-comment fa-fw"></i> Commentaires
				</div>
			<!-- /.panel-heading -->
				<div  class="panel-body">
				    <div id="comment" >Les commentaires du top 10</div>
				     <button type="button" class="btn btn-xs">Sauvegarde</button>
				</div>
			 <!-- /.panel-body -->
			</div>
	    </div>
	        
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="S&ucirc;ret&eacute; ";
	        $id="surete";
	        include 'tempBarGraph.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME";
	        $id="nqme";
	        include 'tempBarGraph.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
	<div class="row">
	    <div class="col-lg-6">
	        <?php 
	        $title="S&ucirc;ret&eacute; ";
	        $id="lineSurete";
	        include 'tempLineChart.php';?>
		</div>
		<div class="col-lg-6">
			<?php 
	        $title="NQME";
	        $id="lineNQME";
	        include 'tempLineChart.php';?>	    	
	     </div>       
	</div>
<!-- /.row -->
</div>
<!-- jQuery -->
<script src="../assets/js/jquery-2.2.3.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/bootstrap-table/bootstrap-table.min.js"></script>
<script src="../assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="../assets/js/Chart.bundle.js"></script>
<script src="../assets/js/quill.js"></script>
<script src="js/evt.js"></script>
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
			include "codeparSiteMois.php";
			global $libCodes;
			$nqme=array("EM01", "EM02", "EM06", "EM08", "EM09", "EM17", "EM19", "OM11", "PH05");
			$surete=array("EM05", "EM08", "EM13", "MA14", "SN01", "SN03", "SN14", "SN16");
			//TODO : debugger le $tab dans count.php
			$tab=array("2016-01", "2016-02", "2016-03",  "2016-04", "2016-05", "2016-06", "2016-07", "2016-08", "2016-09", "2016-10",  "2016-11", "2016-12");
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
