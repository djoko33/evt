<?php
session_start();
function codeParService($code) {
	$timestart=microtime(true);
	
	$sql="SELECT serv_emet, COUNT(serv_emet) AS nb FROM cvt WHERE (nature=?) AND (codes LIKE ?) GROUP BY serv_emet";
	$arrServ=array("AUT"=>0, "CDT"=>0, "EC"=>0, "ECE"=>0, "1_EM"=>0, "ING"=>0, "LOG"=>0, "MSR"=>0, "MTE"=>0, "PPSI"=>0, "QSPR"=>0, "SIR"=>0, "S3P"=>0);
	include('connexionPG.php');
	$reponse = $bdd->prepare($sql);
	$reponse->execute(array(1, "%".$code."%"));//$stmt->execute(array("%$_GET[code]%"));
	$arrPos=$arrServ;
	while ($donnees = $reponse->fetch())
	{
	
		if (array_key_exists($donnees['serv_emet'], $arrPos))//permet de pas reprendre les services type REX et EGE
		{
			$arrPos[$donnees['serv_emet']]=$donnees['nb'];
		}
	}
	
	$reponse->execute(array(0, "%EM01%"));
	$arrNeg=$arrServ;
	while ($donnees = $reponse->fetch())
	{
		if (array_key_exists($donnees['serv_emet'], $arrNeg)) //permet de pas reprendre les services type REX et EGE
		{
			$arrNeg[$donnees['serv_emet']]=$donnees['nb'];
		}
	}
	$reponse->closeCursor();
	$arr=array();
	foreach ($arrNeg as $k => $v) {
		$arr[]=array("serv_emet"=>$k, "nbNeg"=>$v, "nbPos"=>$arrPos[$k]);
	}
	$timeend=microtime(true);
	$time=$timeend-$timestart;
	print_r($time);
	print_r(" - ");
	return $arr;
}

function nbcode($code, $serv) {
	$sql="SELECT serv_emet, COUNT(serv_emet) AS nb FROM cvt WHERE (nature=?) AND (codes LIKE ?) AND (serv_emet=?) GROUP BY serv_emet";
	include('connexionPG.php');
	$reponse = $bdd->prepare($sql);
	$reponse->execute(array(1, "%".$code."%", $serv));
	$donnees = $reponse->fetchAll();
	if (isset($donnees[0]['nb']))
	{
		$pos=$donnees[0]['nb'];
	}
		else
		{
		$pos=(int)0;
		}
	
	$reponse->execute(array(0, "%".$code."%", $serv));
	$donnees = $reponse->fetchAll();
	if (isset($donnees[0]['nb']))
	{
		$neg=$donnees[0]['nb'];
	}
		else
		{
			$neg=(int)0;			
		}
	$tot=$neg+$pos;
	return array("code"=>$code, "nbPos"=>$pos,"nbNeg"=> $neg, "nbTot"=>$tot);
}

function nbcodeTot($code, $serv) {
	$sql="SELECT serv_emet, COUNT(serv_emet) AS nb FROM cvt WHERE (codes LIKE ?) AND (serv_emet=?) GROUP BY serv_emet";
	include('connexionPG.php');
	$reponse = $bdd->prepare($sql);
	$reponse->execute(array("%".$code."%", $serv));
	$donnees = $reponse->fetchAll();
	if (isset($donnees[0]['nb']))
	{
		$tot=$donnees[0]['nb'];
	}
	else
	{
		$tot=(int)0;
	}
	return $tot;
}
// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
function countCodesService($serv, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$lstCodes=$bdd->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) GROUP BY code");
	$lstCodes->execute(array($serv, $nat1, $nat2));
	while ($code = $lstCodes->fetch())
	{
		$result[$code[0]]=$code[1];
	}
	arsort($result);
	return $result;
}


//$a=codeParService("EM01");
//$service=array_column($a, 'serv_emet');
//$key = array_search('MSR', $service);
//print_r($a[$key]['nbNeg']);
//print_r($a[$key]['nbPos']);
$tot=countCodesService('MSR', 0, 1);
$neg=countCodesService('MSR', 0, 0);
$pos=countCodesService('MSR', 1, 1);
$top10=array();
for ($i = 0; $i < 9; $i++) {
	list($key, $val) = each($tot);
	$code=$key;
	$nbTot=(int)$val;
	if (isset($neg[$key])) {
		$nbNeg=(int)$neg[$key];
	}
	else {
		$nbNeg=0;
	}
	if (isset($pos[$key])) {
		$nbPos=(int)$pos[$key];
	}
	else {
		$nbPos=0;
	}
	array_push($top10, array("code"=>$code, "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
}

//print_r(json_encode($top10));
//$nqme=array("EM01", "EM02", "EM03");
//$serv=$_GET['serv'];
//$result=array();
//foreach ($nqme as $c) {
//	array_push($result, nbcode($c, $serv));
//	;
//}
print_r(json_encode($top10));
//print_r(json_encode(codeParService("EM01")));
?>