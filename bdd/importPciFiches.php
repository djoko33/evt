<?php
include('../modele/connexionPG.php');
if (($handle = fopen("pciFiches.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) 
	{
		$u = array_map("utf8_encode", $data);
		$sql = '('.intval($u[0]).', '.$bdd->quote($u[1]).', '.$bdd->quote($u[2]).', '.$bdd->quote($u[3]).')';
		$req = $bdd->exec('INSERT INTO pci_fiches (mp, code, titre, libelle) VALUES '.$sql);//, fichier, trameCr) VALUES '.$sql);
	}
	fclose($handle);
}

echo "import PciFiches r&ecaute;ussi";
?>

