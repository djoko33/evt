<?php

function date_convert($dateText)
//convertit la date de Terrain jj/mm/aaaa en date format MySQL yyyy-mm-dd
{
	$exploded = explode("/", $dateText);
	$year = $exploded[2];
	$month = $exploded[1];
	$day = $exploded[0];
	return $year."-".$month."-".$day;	
}

function emet_convert($emetteur)
//enleve le /A/EDF de l'émetteur
{
	$exploded = explode("/", $emetteur);
	return $exploded[0];
}

function section($section_emet)
// recupere la seule section du couple service-section en supprimant les --
{
if ($section_emet!="") {
		$section_emet=str_replace("--", "-",$section_emet);
		$exploded=explode("-", $section_emet);
		if (count($exploded)==2){
			return $exploded[1];}
		else 
		{	return "";}
	} else
	{ 	return "";
	}
}

function sousProcessus($sp){
	if ($sp!=""){
		$exploded=explode(";", $sp);
		$lstSP=array();
		foreach ($exploded as $s){
			$exp=explode(":", $s);
			$lstSP[]=trim($exp[0]);
			}
		return implode(",",$lstSP);
		}
	else 
	{	return "";}
}

function codes($cod){
	// recuperation de la liste des codes (4 premiers caractères de chaque codif séparée par ;)	
	if ($cod!=""){
		$exploded=explode(";", $cod);
		$arrCodes=array();
		foreach ($exploded as $c){
			$quad=str_split($c, 4);
			$arrCodes[]=$quad[0];
		}
		return implode(",",$arrCodes);
	}
	else
	{	return "";}
}

function nature($nat){
	if ($nat==""){
		return 2;
		}
	elseif ($nat=="Constat positif"){
			return 1;
		}
	else
		{	return 0;}
}

function pfi($pfi) {
	$code=str_split($pfi, 2);
	switch ($code[0]) //les 2 premiers caracteres de PFI (numero)
	{
    case "":
        return "NO";
        break;
    case "00":
        return "NO";
        break;
    case "01":
        return "PJB";
        break;
	case "02":
	    return "MA";
	    break;
	case "03":
	    return "AC";
	    break;
	case "04":
	    return "CC";
	    break;
	case "05":
	   	return "CS";
	    break;
	case "06":
	    return "DBF";
	    break;
	}
}

?>