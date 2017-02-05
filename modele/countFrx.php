<?php
//session_start();
//$_SESSION["debut"]='2017-01-01';
//$_SESSION["fin"]='2017-12-01';
include('connexionPG.php');
include('connexionPtirex.php');
//prepare un tableau accessible � toutes les fonctions permettant d'ajouter les libelles courts

//correspondance code national - code terrain
$reponse = $bdd->query('SELECT * FROM codification');
$libCodes=array();
while ($donnees = $reponse->fetch())
{
	//$libCodes[$donnees['code_nat']]=$donnees['libelle_court'];
	$libCodes[$donnees['quad']]=$donnees['code_nat'];
}
$reponse->closeCursor();

function convertCode($code) {
	global $libCodes;
	return $libCodes[$code];
}


//fournit la liste ordonn�e des codes TOP 10 
//ex countCodesSite
function top10() {
	//global $libCodes;
	//include('connexionPtirex.php');
	$result=array();
	$lstCodes=$ptirex->prepare("SELECT code, COUNT(*) as nb FROM codesfrx WHERE (dateevt BETWEEN ? AND ?) GROUP BY code ORDER BY nb DESC LIMIT 10");
	$lstCodes->execute(array($_SESSION["debut"], $_SESSION["fin"]));
	while ($code = $lstCodes->fetch())
	{
		$result[$code[0]]=$code[1];
	}
	return $result;
}

function top10Flot() {
	include('connexionPtirex.php');
	$result='var d1 = [';
	$lstCodes=$ptirex->prepare("SELECT code, COUNT(*) as nb FROM codesfrx WHERE (dateevt BETWEEN ? AND ?) GROUP BY code ORDER BY nb DESC LIMIT 10");
	$lstCodes->execute(array('2017-01-01', '2017-12-31'));
	while ($code = $lstCodes->fetch())
	{
		$result.='['.$code[0].', '.$code[1].'], ';
	}
	return $result.'];';
}

function countCodeTrim($code) {
	include('connexionPtirex.php');
	$result=array();
	$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (QUARTER from dateevt)) as trim, (EXTRACT (YEAR from dateevt)) as annee,".
			" COUNT(reference) as nb from codesfrx WHERE (code=?) AND (dateevt BETWEEN ? AND ?) GROUP BY trim, annee ORDER BY annee, trim");
	$lstNbCVT->execute(array($code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("x"=>$nb[1].'-T'.$nb[0], "nbTot"=>$nb[2], "nbNeg"=>$nb[2],"nbPos"=>0));
		//$result[$nb[1].'-T'.$nb[0]]=$nb[2];
	}
	return $result;
}

//print_r(countCodeQuarter('ESN01'));

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//fournit la liste ordonn�e des codes pour un service donn� et un sens donn�
function countCodesService($serv, $sens, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	if ($sens=='conc') {
		$lstCodes=$ptirex->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (code <> '') AND (dateevt BETWEEN ? AND ?) GROUP BY code");
	}
	else 
		{
			$lstCodes=$ptirex->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (code <> '') AND (dateevt BETWEEN ? AND ?) GROUP BY code");
		}
	$lstCodes->execute(array($serv, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]  ));
	while ($code = $lstCodes->fetch())
	{
		$result[$code[0]]=$code[1];
	}
	arsort($result);
	return $result;
}


//fournit la liste ordonn�e des services pour un code donn� et un sens donn�
function countServicesCode($code, $sens, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	if ($sens=='conc') {
		$lstServices=$ptirex->prepare("SELECT serv_conc, COUNT(*) as nb FROM codesCVT WHERE (code=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY serv_conc ORDER BY nb DESC");
	}
	else
	{
		$lstServices=$ptirex->prepare("SELECT serv_emet, COUNT(*) as nb FROM codesCVT WHERE (code=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY serv_emet ORDER BY nb DESC");
	}
	$lstServices->execute(array($code, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($serv = $lstServices->fetch())
	{
		//array_push($result, array("serv"=>$serv[0], "nb"=>$serv[1]));
		$result[$serv[0]]=$serv[1];
	}
	return $result;
}

//fournit la liste ordonn�e des services pour un sp donn� et un sens donn�
function countServicesSP($sp, $sens, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	if ($sens=='conc') {
		$lstServices=$ptirex->prepare("SELECT serv_conc, COUNT(*) as nb FROM spCVT WHERE (sp=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY serv_conc ORDER BY nb DESC");
	}
	else
	{
		$lstServices=$ptirex->prepare("SELECT serv_emet, COUNT(*) as nb FROM spCVT WHERE (sp=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY serv_emet ORDER BY nb DESC");
	}
	$lstServices->execute(array($sp, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($serv = $lstServices->fetch())
	{
		//array_push($result, array("serv"=>$serv[0], "nb"=>$serv[1]));
		$result[$serv[0]]=$serv[1];
	}
	return $result;
}



// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par trimestre et par ann�ee
function countCVTService($serv, $sens, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	if ($sens=='conc') {
		$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (QUARTER from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	}
	else
	{
		$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (QUARTER from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	}
	$lstNbCVT->execute(array($serv, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("trim"=>$nb[1].'-T'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par trimestre et par ann�ee
function countCVTSiteTrim($nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (QUARTER from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from cvt WHERE (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("trim"=>$nb[1].'-T'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par mois et par ann�ee
function countCVTSite($nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (MONTH from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from cvt WHERE (nature BETWEEN ? AND ?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("mois"=>$nb[1].'-'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}




// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par mois et par ann�ee pour un code
function countCodeDict($code, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (MONTH from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from codescvt WHERE (nature BETWEEN ? AND ?) AND (code=?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("mois"=>$nb[1].'-'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}

function tabAnneeMois($anDebut, $moisDebut, $anFin, $moisFin){
	$tabAnneeMois=array();
	for ($y = $anDebut; $y < $anFin+1; $y++) {
		for ($m = $moisDebut; $m < $moisFin+1; $m++) {
			array_push($tabAnneeMois, $y.'-'.moisAvecZero($m));
		}
	}
	return $tabAnneeMois;
}

// ajoute un zero devant les mois � 1 chiffre (utile pour le tri)
function moisAvecZero($mois) {
	if ($mois<10) {
		return '0'.$mois;
	}
	else {
		return $mois;
	}
}

function countCode($code, $nat1, $nat2) {
	include('connexionPtirex.php');
	$result=array();
	$tabMois=array();
	$lstNbCVT=$ptirex->prepare("SELECT (EXTRACT (MONTH from dateevt)) as mois, (EXTRACT (YEAR from dateevt)) as annee, COUNT(reference) as nb from codescvt WHERE (nature BETWEEN ? AND ?) AND (code=?) AND (dateevt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		$result[$nb[1].'-'.moisAvecZero($nb[0])]=$nb[2];
	}
	// remplit les mois intercalaires vides par des z�ros ou renvoie NULL (utile pour graphiques chronologiques)
	if ($result!=NULL) {		
	$tabMoisComplet=tabAnneeMois(2015, 1, 2016, 12);
	$tabMois=array_keys($result);
	$debut=array_search($tabMois[0], $tabMoisComplet);
	$fin=array_search($tabMois[count($tabMois)-1], $tabMoisComplet);
	$tabMoisComplet=array_slice($tabMoisComplet, $debut, $fin-$debut+1);
	$tabMoisCompletZero=array();
	foreach ($tabMoisComplet as $t) {
		$tabMoisCompletZero[$t]=0;
	}
	 return array_merge($tabMoisCompletZero, $result);
	}
	else { 
		return $result;
	}
}





function countCodeParMois($code)
{
	$tot=countCode($code, 0, 1);
	$neg=countCode($code, 0, 0);
	$pos=countCode($code, 1, 1);
	$result=array();
	for ($i = 0; $i < count($tot); $i++) {
		list($key, $val) = each($tot);
		$mois=$key;
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
		array_push($result, array("mois"=>$mois, "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $result;
}



function countCodeParTrim($code)
{
	$tot=countCodeQuarter($code, 0, 1);
	$neg=countCodeQuarter($code, 0, 0);
	$pos=countCodeQuarter($code, 1, 1);
	$result=array();
	for ($i = 0; $i < count($tot); $i++) {
		list($key, $val) = each($tot);
		$trim=$key;
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
		array_push($result, array("trim"=>$trim, "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $result;
}




