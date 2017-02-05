<?php

include '../modele/count.php';

function tabPA($pa, $tabMois){
	$result=array();
	foreach ($pa as $c) 
	{
		$result[$c]=countCode($c,0,2);
	}	
	foreach ($pa as $c) 
	{
		//supprime les mois non retenus
		foreach (array_keys($result[$c]) as $m) 
		{
			if (!in_array($m, $tabMois))
			{
				unset($result[$c][$m]);
			}
		}
		//remplit les mois vides (non intercalaires car d�j� trait�s par CountCodes)
		foreach ($tabMois as $m)
		{
			if (!isset($result[$c][$m]))
			{
				$result[$c][$m]=0;
			}
		}
		ksort($result[$c]);
	}
	return $result;
}
$nqme=lstCodesPA("MQME");
$surete=lstCodesPA("surete");
$r=tabPA($nqme,tabAnneeMois(2015, 5, 2016, 8));

$strtabMois="[\"";
foreach (array_keys($r[$nqme[0]]) as $m) {
	$strtabMois=$strtabMois.$m."\", \"";
}
$strtabMois=substr($strtabMois,0 ,-3)."]";
$strTabData="[";
foreach (array_values($r[$nqme[0]]) as $d) {
	$strTabData=$strTabData.$d.", ";
}
$strTabData=substr($strTabData,0 ,-2)."]";
//print_r($strTabData);
?>