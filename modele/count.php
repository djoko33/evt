<?php
include('connexionPG.php');
//prepare un tableau accessible � toutes les fonctions permettant d'ajouter les libelles courts
$reponse = $bdd->query('SELECT * FROM codification');
$libCodes=array();
while ($donnees = $reponse->fetch())
{
	$libCodes[$donnees['quad']]=$donnees['libelle_court'];
}
$reponse->closeCursor();

//renvoie une liste de code issus des PA
function lstCodesPA($plan) {
	include('connexionPG.php');
	$reponse = $bdd->prepare('SELECT code FROM pa WHERE pa=?');
	$reponse->execute(array($plan));
	$lstCodesPA=array();
	while ($donnees = $reponse->fetch())
	{
		array_push($lstCodesPA, $donnees['code']);
	}
	return $lstCodesPA;
	$reponse->closeCursor();
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//fournit la liste ordonn�e des codes pour un service donn� et un sens donn�
function countCodesService($serv, $sens, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstCodes=$bdd->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (code <> '') AND (datecvt BETWEEN ? AND ?) GROUP BY code");
	}
	else 
		{
			$lstCodes=$bdd->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (code <> '') AND (datecvt BETWEEN ? AND ?) GROUP BY code");
		}
	$lstCodes->execute(array($serv, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]  ));
	while ($code = $lstCodes->fetch())
	{
		$result[$code[0]]=$code[1];
	}
	arsort($result);
	return $result;
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//fournit la liste ordonn�e des codes pour le site donn� et un sens donn�
function countCodesSite($nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$lstCodes=$bdd->prepare("SELECT code, COUNT(*) as nb FROM codesCVT WHERE (nature BETWEEN ? AND ?) AND (code <> '') AND (datecvt BETWEEN ? AND ?) GROUP BY code");
	$lstCodes->execute(array($nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($code = $lstCodes->fetch())
	{
		$result[$code[0]]=$code[1];
	}
	arsort($result);
	return $result;
}
//fournit la liste ordonn�e des services pour un code donn� et un sens donn�
function countServicesCode($code, $sens, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstServices=$bdd->prepare("SELECT serv_conc, COUNT(*) as nb FROM codesCVT WHERE (code=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY serv_conc ORDER BY nb DESC");
	}
	else
	{
		$lstServices=$bdd->prepare("SELECT serv_emet, COUNT(*) as nb FROM codesCVT WHERE (code=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY serv_emet ORDER BY nb DESC");
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
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstServices=$bdd->prepare("SELECT serv_conc, COUNT(*) as nb FROM spCVT WHERE (sp=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY serv_conc ORDER BY nb DESC");
	}
	else
	{
		$lstServices=$bdd->prepare("SELECT serv_emet, COUNT(*) as nb FROM spCVT WHERE (sp=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY serv_emet ORDER BY nb DESC");
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
//compte les pfi observ�es
function countPFIService($serv, $sens, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstPFI=$bdd->prepare("SELECT pfi, COUNT(pfi) as nb FROM CVT WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (pfi<> 'NO') AND (datecvt BETWEEN ? AND ?) GROUP BY pfi ORDER BY pfi DESC");
	}
	else
	{
		$lstPFI=$bdd->prepare("SELECT pfi, COUNT(pfi) as nb FROM CVT WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (pfi<> 'NO') AND (datecvt BETWEEN ? AND ?) GROUP BY pfi ORDER BY pfi DESC");
	}
	$lstPFI->execute(array($serv, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($pfi = $lstPFI->fetch())
	{
		array_push($result, array("pfi"=>$pfi[0], "nb"=>$pfi[1]));
	}
	return $result;
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par trimestre et par ann�ee
function countCVTService($serv, $sens, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (QUARTER from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	}
	else
	{
		$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (QUARTER from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
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
	include('connexionPG.php');
	$result=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (QUARTER from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
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
	include('connexionPG.php');
	$result=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("mois"=>$nb[1].'-'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}



// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par mois et par ann�ee
function _oldcountCVTService($serv, $sens, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	if ($sens=='conc') {
		$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_conc=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	}
	else
	{
		$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from cvt WHERE (serv_emet=?) AND (nature BETWEEN ? AND ?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	}
	$lstNbCVT->execute(array($serv, $nat1, $nat2, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		array_push($result, array("mois"=>$nb[1].'-'.$nb[0], "nb"=>$nb[2]));
	}
	return $result;
}

// $nat1=$nat2 -> nature, si $nat1=0 et $nat2=2 total
//compte les CVT par mois et par ann�ee pour un code
function countCodeDict($code, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from codescvt WHERE (nature BETWEEN ? AND ?) AND (code=?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
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
	include('connexionPG.php');
	$result=array();
	$tabMois=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from codescvt WHERE (nature BETWEEN ? AND ?) AND (code=?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		$result[$nb[1].'-'.moisAvecZero($nb[0])]=$nb[2];
	}
	// remplit les mois intercalaires vides par des z�ros ou renvoie NULL (utile pour graphiques chronologiques)
	if ($result!=NULL) {		
	$tabMoisComplet=tabAnneeMois(2015, 1, 2019, 12);//todo à rendre parametrable
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

function countSP($sp, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$tabMois=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (MONTH from datecvt)) as mois, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from spcvt WHERE (nature BETWEEN ? AND ?) AND (sp=?) AND (datecvt BETWEEN ? AND ?) GROUP BY mois, annee ORDER BY annee, mois");
	$lstNbCVT->execute(array($nat1, $nat2, $sp, $_SESSION["debut"], $_SESSION["fin"]));
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

function countCodeQuarter($code, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (QUARTER from datecvt)) as trim, (EXTRACT (YEAR from datecvt)) as annee,".
	" COUNT(reference) as nb from codescvt WHERE (nature BETWEEN ? AND ?) AND (code=?) AND (datecvt BETWEEN ? AND ?) GROUP BY trim, annee ORDER BY annee, trim");
	$lstNbCVT->execute(array($nat1, $nat2, $code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		$result[$nb[1].'-T'.$nb[0]]=$nb[2];
	}
	return $result;
}

function countSPQuarter($sp, $nat1, $nat2) {
	include('connexionPG.php');
	$result=array();
	$lstNbCVT=$bdd->prepare("SELECT (EXTRACT (QUARTER from datecvt)) as trim, (EXTRACT (YEAR from datecvt)) as annee, COUNT(reference) as nb from spcvt WHERE (nature BETWEEN ? AND ?) AND (sp=?) AND (datecvt BETWEEN ? AND ?) GROUP BY trim, annee ORDER BY annee, trim");
	$lstNbCVT->execute(array($nat1, $nat2, $sp, $_SESSION["debut"], $_SESSION["fin"]));
	while ($nb = $lstNbCVT->fetch())
	{
		$result[$nb[1].'-T'.$nb[0]]=$nb[2];
	}
	return $result;
}

function countServConc($servEmet) 
{
	include('connexionPG.php');
	$result=array();
	$lstServConc=$bdd->prepare("SELECT serv_conc, COUNT(*) AS nb FROM cvt WHERE serv_emet=? AND (datecvt BETWEEN ? AND ?) GROUP BY serv_conc ORDER BY nb DESC LIMIT 6");
	$lstServConc->execute(array($servEmet, $_SESSION["debut"], $_SESSION["fin"]));
	
	$nbCVT=$bdd->prepare("SELECT COUNT(*) AS nb FROM cvt WHERE serv_emet=? AND (datecvt BETWEEN ? AND ?)");
	$nbCVT->execute(array($servEmet, $_SESSION["debut"], $_SESSION["fin"]));
	$tot=$nbCVT->fetchall();
	while ($nb = $lstServConc->fetch())
	{
		$prop=((int)$nb[1]/(int)$tot[0]['nb'])*100;
		array_push($result, array("serv"=>$nb[0], "nb"=>number_format($prop, 0).' %'));
	}
	return $result;
}

function countServEmet($servConc)
{
	include('connexionPG.php');
	$result=array();
	$lstServ=$bdd->prepare("SELECT serv_emet, COUNT(*) AS nb FROM cvt WHERE serv_conc=? AND (datecvt BETWEEN ? AND ?) GROUP BY serv_emet ORDER BY nb DESC LIMIT 6");
	$lstServ->execute(array($servConc, $_SESSION["debut"], $_SESSION["fin"]));

	$nbCVT=$bdd->prepare("SELECT COUNT(*) AS nb FROM cvt WHERE serv_conc=? AND (datecvt BETWEEN ? AND ?) ");
	$nbCVT->execute(array($servConc, $_SESSION["debut"], $_SESSION["fin"]));
	$tot=$nbCVT->fetchall();
	while ($nb = $lstServ->fetch())
	{
		$prop=((int)$nb[1]/(int)$tot[0]['nb'])*100;
		array_push($result, array("serv"=>$nb[0], "nb"=>number_format($prop, 0).' %'));
	}
	return $result;
}

//compte les constats emis par type d'emetteur (em ou cde)
function countCvtEmis($type) {
	include('connexionPG.php');
	$result=array();
	$emet=array();
	//cree un tableau avec tous les noms
	$lst=$bdd->prepare("SELECT nom FROM emetteur WHERE type=?");
	$lst->execute(array($type));
	while ($x = $lst->fetch())
	{
		array_push($emet, $x[0]);
	}
	//cree un tableau avec tous les noms ayant émis au moins 1 constat
	$lst=$bdd->prepare("SELECT cvt.emetteur, COUNT(cvt.emetteur) FROM cvt INNER JOIN emetteur ON (emetteur.type=?) AND (emetteur.nom=cvt.emetteur) AND (cvt.datecvt BETWEEN ? AND ?)GROUP BY cvt.emetteur ORDER BY cvt.emetteur");
	$lst->execute(array($type, $_SESSION["debutAnnee"], $_SESSION["fin"]));
	while ($x = $lst->fetch())
	{
		array_push($result, array("x"=>$x[0], "y"=>$x[1]));
	}
	//complete avec 0 les autres noms
	$emetZero=array_diff($emet, array_column($result, 'x'));
	foreach ($emetZero as $e) {
		array_push($result, array("x"=>$e, "y"=>0));		
	}
	return $result;
}


function top10($serv, $sens)
{
	global $libCodes;
	$tot=countCodesService($serv, $sens, 0, 1);
	$neg=countCodesService($serv, $sens, 0, 0);
	$pos=countCodesService($serv, $sens, 1, 1);
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
		array_push($top10, array("code"=>$code." (".$libCodes[$code].")", "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $top10;
}

function top10Site()
{
	global $libCodes;
	$tot=countCodesSite(0, 1);
	$neg=countCodesSite(0, 0);
	$pos=countCodesSite(1, 1);
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
		array_push($top10, array("code"=>$code." (".$libCodes[$code].")", "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $top10;
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

function countSPParMois($sp)
{
	$tot=countSP($sp, 0, 1);
	$neg=countSP($sp, 0, 0);
	$pos=countSP($sp, 1, 1);
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

function countSPParTrim($sp)
{
	$tot=countSPQuarter($sp, 0, 1);
	$neg=countSPQuarter($sp, 0, 0);
	$pos=countSPQuarter($sp, 1, 1);
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

function planAction($serv, $sens, $listCodes)
{
	global $libCodes;
	$tot=countCodesService($serv, $sens, 0, 1);
	$neg=countCodesService($serv, $sens, 0, 0);
	$pos=countCodesService($serv, $sens, 1, 1);
	$result=array();
	foreach ($listCodes as $key) {

		if (isset($tot[$key])) {
			$nbTot=(int)$tot[$key];
		}
		else {
			$nbTot=0;
		}
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
		array_push($result, array("x"=>$libCodes[$key], "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos,"code"=>$key));
	}
	return $result;
}

function planActionSite($listCodes)
{
	global $libCodes;
	$tot=countCodesSite(0, 1);
	$neg=countCodesSite(0, 0);
	$pos=countCodesSite(1, 1);
	$result=array();
	foreach ($listCodes as $key) {

		if (isset($tot[$key])) {
			$nbTot=(int)$tot[$key];
		}
		else {
			$nbTot=0;
		}
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
		array_push($result, array("x"=>$libCodes[$key], "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $result;
}

function codeParServicesTot($code, $sens)
{
	$tot=countServicesCode($code, $sens, 0, 1);
	$neg=countServicesCode($code, $sens, 0, 0);
	$pos=countServicesCode($code, $sens, 1, 1);
	$result=array();
	for ($i = 0; $i < count($tot); $i++) {
		list($key, $val) = each($tot);
		if (isset($tot[$key])) {
			$nbTot=(int)$tot[$key];
		}
		else {
			$nbTot=0;
		}
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
		array_push($result, array("x"=>$key, "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $result;
}

function SPParServicesTot($sp, $sens)
{
	$tot=countServicesSP($sp, $sens, 0, 1);
	$neg=countServicesSP($sp, $sens, 0, 0);
	$pos=countServicesSP($sp, $sens, 1, 1);
	$result=array();
	for ($i = 0; $i < count($tot); $i++) {
		list($key, $val) = each($tot);
		if (isset($tot[$key])) {
			$nbTot=(int)$tot[$key];
		}
		else {
			$nbTot=0;
		}
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
		array_push($result, array("x"=>$key, "nbTot"=>$nbTot, "nbNeg"=>$nbNeg,"nbPos"=>$nbPos));
	}
	return $result;
}
