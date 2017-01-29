<?php
session_start();
include('connexionPG.php');

$arrCVT=array();
if (isset($_GET['serv_conc']))
	{$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (serv_conc = ?) AND (nature = ?) AND (datecvt BETWEEN ? AND ?)');
	$reponse->execute(array($_GET['serv_conc'], $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));}
elseif (isset($_GET['serv_emet']))
	{$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (serv_emet = ?) AND (nature = ?) AND (datecvt BETWEEN ? AND ?)');
	$reponse->execute(array($_GET['serv_emet'], $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));}
elseif (isset($_GET['sp']))
	{$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (sp LIKE ?) AND (nature = ?) AND (datecvt BETWEEN ? AND ?)');
	$reponse->execute(array("%".$_GET['sp']."%", $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));}
elseif (isset($_GET['pci']))
	{$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE (pci LIKE ?) AND (datecvt BETWEEN ? AND ?)');
	$reponse->execute(array("%".$_GET['pci']."%", $_SESSION["debut"], $_SESSION["fin"]));}
elseif (isset($_GET['keyword']))
{
	$words=str_replace("+","",$_GET['keyword']);
	$word=explode(',',$words);
	$search=trim($word[0]);
	for ($i = 1; $i < count($word); $i++) {
		$search=$search." & ".trim($word[$i]);
	}
	
	$sql="SELECT reference, titre, texte, action, serv_emet, serv_conc FROM cvt WHERE index @@ to_tsquery('".$search."')";
	//echo $sql;
	$reponse=$bdd->query($sql);
}
elseif (isset($_GET['keywordPtiRex']))
{
	$dsn = 'pgsql:host=localhost;dbname=rexing;';
$user = 'postgres';
$password = 'postgres';

// Connexion à la base de données
try
{
	$bdd = new PDO($dsn, $user, $password);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
	
	$words=str_replace("+","",$_GET['keywordPtiRex']);
	$word=explode(',',$words);
	$search=trim($word[0]);
	for ($i = 1; $i < count($word); $i++) {
		$search=$search." & ".trim($word[$i]);
	}
	
	$sql="SELECT numrex AS reference, titre, descri AS texte FROM rex  WHERE index_titre @@ to_tsquery('".$search."')";
	//echo $sql;
	$reponse=$bdd->query($sql);
}

else 
	{
		$reponse = $bdd->prepare('SELECT reference, titre, texte, action, serv_emet, serv_conc FROM CVT WHERE codes LIKE ? AND nature = ? AND (datecvt BETWEEN ? AND ?)');
		$reponse->execute(array("%".$_GET['code']."%", $_GET['nature'], $_SESSION["debut"], $_SESSION["fin"]));	}

		//conserver reference en premier (adhérence avec le JS pour le lien vers la reference)

while ($donnees = $reponse->fetch())
{
 	//$arrCVT[]=$donnees;
 	array_push($arrCVT, $donnees);
}
$reponse->closeCursor();
echo json_encode($arrCVT);
?>