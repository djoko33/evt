<?php
include('../connexionPG.php');
//todo � generer la liste des services
$lstServ=array('1_EM', 'AUT', 'CDT', 'EC' , 'ECE', 'ING', 'LOG' ,'MSR' , 'MTE' , 'PPSI', 'QSPR' , 'S3P', 'SIR', 'MRH', 'MCG', 'MCOM');
//todo changer le chemin de pci.csv vers le repertoire upload
if (($handle = fopen("pci.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) {
		$u = array_map("utf8_encode", $data);
		// on commence � 1 pour �viter le code dans la premiere colonne
		for ($i = 1; $i < count($u); $i++)
		{
			if ($u[$i]!='') 
			{
				$sql = '('.$bdd->quote($u[0]).', '.intval($u[$i]).', '.$bdd->quote($lstServ[$i-1]).')';
				$req = $bdd->exec('INSERT INTO pci_cible (code, nb, serv) VALUES '.$sql);
			}
		}
	}
	fclose($handle);
}

echo "import PciCible r&ecaute;ussi";
?>

