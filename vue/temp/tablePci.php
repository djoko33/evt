<?php 
$lstServ=array('1_EM', 'AUT', 'CDT', 'EC', 'ECE', 'ING', 'LOG' ,'MSR' , 'MTE' , 'PPSI', 'QSPR' , 'S3P', 'SIR', 'MRH', 'MCG', 'MCOM');

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
<i class="fa fa-table fa-fw"></i> <?php echo $title; ?>
</div>
<!-- /.panel-heading -->
<div class="panel-body">
<div >
<table data-toggle="table">
    <thead>
    <tr>
        <th>Serv</th>
		<?php foreach ($lstServ as $s)
    			{
    				echo '<th>'.$s.'</th>';
    			}
    			echo '<th>Total</th>';
    			echo '<th>Total Redr./Cible</th>';
		?>
    </tr>
    </thead>
    <tbody>
    <?php
    $i=1;
    //$tot=pciSyntheseSite();
    $totRealMP=0;
    $totCibleMP=0;
    $totRealRedresseMP=0;
    $totRealServ=array();
    foreach ($lstServ as $s) {
    	//$totRealServ[$s]=0;
    	$totRealRedresseServ[$s]=0;
    	$totCibleServ[$s]=0;
    }
    
    foreach ($lstCodes as $c)
    {
    	$totReal=0;
    	$totRealRedresse=0;
    	$totCible=0;
    	$cible=ciblePciCodeSite($c);
    	$real=pciCodeSite($c);
    	
    	echo '<tr id="tr-id-'.$i.'" class="tr-class-'.$i.'">';
    	echo '<td id="td-id-'.$i.'" class="td-class-'.$i.'"><a href=afficheTableConstats.php?pci='.$c.'>'.$c.'</a></td>';
    	foreach ($lstServ as $s)
		    {		    	
		    	$totReal+=$real[$s];
		    	//$totRealServ[$s]+=$real[$s];
		    	if ($cible[$s]!==0) {
		        	echo '<td class="'.couleur($cible[$s], $real[$s]).'">'.$real[$s].' / '.$cible[$s].'</td>';
		        	$totCible+=$cible[$s];
		        	$totCibleServ[$s]+=$cible[$s];
		        	if ($real[$s]>=$cible[$s]) {
		        		$totRealRedresse+=$cible[$s];
		        		$totRealRedresseServ[$s]+=$cible[$s];
		        	}else {
		        		$totRealRedresse+=$real[$s];
		        		$totRealRedresseServ[$s]+=$real[$s];
		        	}
		        	
		        }
		    	else {
		    		echo '<td>-</td>';
		    	}
		    	
		    }
		//echo '<td>'.$tot[$c]['real'].'</td>';
		    echo '<td>'.$totReal.'</td>';
		echo '<td class="'.couleur($totCible, $totRealRedresse).'">'.$totRealRedresse.'/'.$totCible.'</td>';
		$i++;
		$totRealMP+=$totReal;
		$totCibleMP+=$totCible;
		$totRealRedresseMP+=$totRealRedresse;
    }
    echo '<tr id="tr-id-'.($i+1).'" class="tr-class-'.($i+1).'">';
    echo '<td id="td-id-'.($i+1).'" class="td-class-'.($i+1).'">Total</td>';
    foreach ($lstServ as $s) {
    	echo '<td>'.$totRealRedresseServ[$s].' / '.$totCibleServ[$s].'</td>';
    }
    echo '<td>'.$totRealMP.' / '.$totCibleMP.'</td>';
    echo '<td>'.$totRealRedresseMP.' / '.$totCibleMP.'</td>';
    echo '</tr>';
    ?>
    </tbody>
</table>
<b>Taux de r&eacute;alisation PCI : 
<?php 
$tauxRedresse=$totRealRedresseMP/$totCibleMP*100;
$tauxReel=$totRealMP/$totCibleMP*100;
echo $totRealRedresseMP.'/'.$totCibleMP.' soit '.number_format($tauxRedresse,2).' % ('.$totRealMP.'/'.$totCibleMP.' soit '.number_format($tauxReel,2).' % non redress&eacute;)'?></b>
</div>
</div>
<!-- /.panel-body -->
</div>
<!-- /.panel -->