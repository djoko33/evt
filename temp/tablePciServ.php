<?php 
include_once "countTdb.php";
$lstCodes=listeCodesPci();
//$lstCodes=array('MP107', 'MP201', 'MP202', 'MP207', 'MP502');
$serv=$_GET['serv'];
function couleur($cible, $real) 
{
	$x=intval($real)/intval($cible);
	if ($x<0.5)					{$res="pcired";}
	elseif ($x>=0.5 and $x<1)	{$res="pciorange";}
	else						{$res="pcigreen";}
	return $res;
}?>


<div class="panel panel-default">
<div class="panel-heading">
<i class="fa fa-file-text-o fa-fw"></i> <?php echo $title; ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div >
<table data-toggle="table">
    <thead>
    <tr>
        <th>Code</th>
		<th><?php echo $serv;?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    $totReal=0;
    $totRealRedresse=0;
    $totCible=0;
    foreach ($lstCodes as $c)
    {
    	$cible=ciblePciCodeSite($c);
    	$real=pciCodeSite($c);
    	$totReal+=$real[$serv];
    	if ($cible[$serv]!==0)
    	{
    	echo '<tr id="tr-id-'.$i.'" class="tr-class-'.$i.'">';
    	echo '<td id="td-id-'.$i.'" class="td-class-'.$i.'">'.$c.'</a></td>';	    	
		echo '<td class="'.couleur($cible[$serv], $real[$serv]).'">'.$real[$serv].' / '.$cible[$serv].'</td>';
		$totCible+=$cible[$serv];
		if ($real[$serv]>=$cible[$serv]) {
			$totRealRedresse+=$cible[$serv];
		}else {
			$totRealRedresse+=$real[$serv];
		}
		}
    }
    ?>
    </tbody>
</table>
<b>Taux de r&eacute;alisation PCI : 
<?php 
$tauxRedresse=$totRealRedresse/$totCible*100;
$tauxReel=$totReal/$totCible*100;
echo $totRealRedresse.'/'.$totCible.' soit '.number_format($tauxRedresse,2).' %';// ('.$totReal.'/'.$totCible.' soit '.number_format($tauxReel,2).' % non redress&eacute;)'?></b>
</div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->