<?php
//session_start();
include('connexionPG.php');
$lstServ=array('1_EM', 'AUT', 'CDT', 'EC' , 'ECE', 'ING', 'LOG' ,'MSR' , 'MTE' , 'PPSI', 'QSPR' , 'S3P', 'SIR', 'MCG', 'MRH', 'MCOM');
//$_SESSION["debut"] = '2016-01-01';
//$_SESSION["fin"] = '2016-06-01';
// fournit la liste de tous les codes de la base pci_cible
function listeCodesPci() {
	include('connexionPG.php');
	$result=array();
	$rep=$bdd->query("SELECT DISTINCT(code) FROM pci_cible ORDER BY code ASC");
	while ($r = $rep->fetch())
	{
		array_push($result, $r[0]);	}
	return $result;
}

// fournit la liste de tous les codes de la base pci_cible pour un MP
function listeCodesPciMp($mp) {
	include('connexionPG.php');
	$result=array();
	$rep=$bdd->prepare("SELECT DISTINCT(code) FROM pci_cible WHERE code LIKE ? ORDER BY code ASC");
	$rep->execute(array($mp.'%'));
	while ($r = $rep->fetch())
	{
		array_push($result, $r[0]);	}
		return $result;
}


//fournit la liste ordonn�e du nb de cvt �mis par les agents d'un service donn�
function countNbCvtEmet($serv) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT emetteur, count(reference) AS nb FROM cvt WHERE serv_emet = ? AND (datecvt BETWEEN ? AND ?) GROUP BY emetteur ORDER BY nb DESC");
	$lstEmet->execute(array($serv, $_SESSION["debut"], $_SESSION["fin"]));
	while ($emet = $lstEmet->fetch())
	{
		array_push($result, array("emet"=>$emet[0], "nb"=>$emet[1]));
	}
	return $result;
}

//fournit la liste ordonn�e du nb de PCI �mis par  agent d'un service donn� par code "class"= code ; "nb"=nb  "emet"=emetteur pour un service
function countNbPciEmet($serv) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT class, emetteur, count(class) FROM pci WHERE serv_emet = ? AND (datecvt BETWEEN ? AND ?) GROUP BY class, emetteur ORDER BY class ASC");
	$lstEmet->execute(array($serv, $_SESSION["debut"], $_SESSION["fin"]));
	//$lstEmet->execute(array($serv,'2016-01-01', '2016-10-01'));
	while ($emet = $lstEmet->fetch())
	{
		array_push($result, array("class"=> $emet[0], "emet"=>$emet[1], "nb"=>$emet[2]));
	}
	return $result;
}

// fournit "class"= code ; "nb"=nb pour un service
function countNbPci($serv) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT class, count(class) FROM pci WHERE serv_emet = ? AND (datecvt BETWEEN ? AND ?) GROUP BY class ORDER BY class ASC");
	$lstEmet->execute(array($serv, $_SESSION["debut"], $_SESSION["fin"]));
	while ($emet = $lstEmet->fetch())
	{
		array_push($result, array("class"=> $emet[0], "nb"=>$emet[1]));
	}
	return $result;
}

// fournit [code]=nb pour un service
function countNbPciServ($serv) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT class, count(class) FROM pci WHERE serv_emet = ? AND (datecvt BETWEEN ? AND ?) GROUP BY class ORDER BY class ASC");
	$lstEmet->execute(array($serv, $_SESSION["debut"], $_SESSION["fin"]));
	while ($emet = $lstEmet->fetch())
	{
		$result[$emet[0]]=$emet[1];
	}
	return $result;
}

// fournit [serv]=nb pour un code
function countNbPciCode($code) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT serv_emet, count(class) FROM pci WHERE class = ? AND (datecvt BETWEEN ? AND ?) GROUP BY serv_emet");
	$lstEmet->execute(array($code, $_SESSION["debut"], $_SESSION["fin"]));
	while ($emet = $lstEmet->fetch())
	{
		$result[$emet[0]]=$emet[1];
	}
	return $result;
}
// fournit "class"= code ; "nb"=nb pour un MP
function countNbPciMp($mp) {
	include('connexionPG.php');
	$result=array();
	$lstEmet=$bdd->prepare("SELECT class, count(class) FROM pci WHERE class LIKE ? AND (datecvt BETWEEN ? AND ?) GROUP BY class ORDER BY class ASC");
	$lstEmet->execute(array($mp.'%', $_SESSION["debut"], $_SESSION["fin"]));
	//$lstEmet->execute(array($mp.'%','2016-01-01', '2016-10-01'));
	while ($emet = $lstEmet->fetch())
	{
		array_push($result, array("class"=> $emet[0], "nb"=>$emet[1]));
	}
	return $result;
}
// fournit un tableau des [codes PCI]= nb � faire pour un service
function ciblePciServ($serv) {
	include('connexionPG.php');
	$result=array();
	$lst=$bdd->prepare("SELECT code, count(code) FROM pci_cible WHERE serv = ? GROUP BY code");
	$lst->execute(array($serv));
	while ($c = $lst->fetch())
	{
		$result[$c[0]]=$c[1];
	}
	return $result;
}

// fournit un tableau des [serv]= nb � faire pour un code
function ciblePciCode($code) {
	include('connexionPG.php');
	$result=array();
	$lst=$bdd->prepare("SELECT serv, nb FROM pci_cible WHERE code = ?");
	$lst->execute(array($code));
	while ($c = $lst->fetch())
	{
		$result[$c[0]]=$c[1];
	}
	return $result;
}
// tableau complet (avec des 0) [serv]=ciblePci pour un code
function ciblePciCodeSite($code) {
	$result=array();
	$cible=ciblePciCode($code);
	global $lstServ;
	foreach ($lstServ as $s) {
		if(isset($cible[$s]))
		{
			$result[$s]=$cible[$s];
		}else 
		{
			$result[$s]=0;
		}
	}
	return $result;
}

// tableau complet (avec des 0) [code]=ciblePci pour un serv
function ciblePciServSite($serv) {
	$result=array();
	$cible=ciblePciServ($serv);
	$lstCodes=listeCodesPci();
	foreach ($lstCodes as $s) {
		if(isset($cible[$s]))
		{
			$result[$s]=$cible[$s];
		}else
		{
			$result[$s]=0;
		}
	}
	return $result;
}
// tableau complet (avec des 0) [serv]=PciReal pour un code
function pciCodeSite($code) {
	$result=array();
	$cible=countNbPciCode($code);
	global $lstServ;
	foreach ($lstServ as $s) {
		if(isset($cible[$s]))
		{
			$result[$s]=$cible[$s];
		}else
		{
			$result[$s]=0;
		}
	}
	return $result;
}

// tableau complet (avec des 0) [code]=PciReal pour un serv
function pciServSite($serv) {
	$result=array();
	$cible=countNbPciServ($serv);
	$lstCodes=listeCodesPci();
	foreach ($lstCodes as $s) {
		if(isset($cible[$s]))
		{
			$result[$s]=$cible[$s];
		}else
		{
			$result[$s]=0;
		}
	}
	return $result;
}

function pciSyntheseCodeSite($code) {
	$result=array();
	$cible=ciblePciCodeSite($code);
	$real=pciCodeSite($code);
	global $lstServ;
	foreach ($lstServ as $s) 
	{
		array_push($result, array("serv"=>$s, "cible"=> $cible[$s], "real"=>$real[$s]));
	}
	return $result;
}

// tableau pour un mp donn� des codes associ�s, du total r�alis�, redress� (real si inf � cible, cible sinon)
function pciSyntheseLstCodes($lstCodes) {
	//$lstCodes=listeCodesPci();
	$result=array();
	global $lstServ;
   	foreach ($lstCodes as $c)
    	{
		    $totReal=0;
		    $totRealRedresse=0;
		    $totCible=0;
		    $cible=ciblePciCodeSite($c);
		    $real=pciCodeSite($c);
		    foreach ($lstServ as $s)
				{		    	
				    $totReal+=$real[$s];
				    if ($cible[$s]!==0) {
				        $totCible+=$cible[$s];
				        if ($real[$s]>=$cible[$s]) {
				        	$totRealRedresse+=$cible[$s];
				        }else 
				        {
				        	$totRealRedresse+=$real[$s];
				        }
				        	
				    }
				    	
				}
			$result[$c]=array("cible"=> $totCible, "real"=>$totReal, "redresse"=>$totRealRedresse);
		}
	return $result;
}    


?>