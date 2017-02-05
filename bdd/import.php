<?php
include('../modele/connexionPG.php');

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$importFileType = pathinfo($target_file,PATHINFO_EXTENSION);


//n'autorise que du csv
if ($importFileType == "csv")
{
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	//$file =  basename( $_FILES["fileToUpload"]["name"]);
	$reponse = $bdd->query("DELETE FROM importcvt");
	
	$req = $bdd->prepare('INSERT INTO importcvt (
			titre, reference, createur, date_creation, date_cvt,
			domaine, sous_domaine, famille,  pfi, theme_visite,
			nature,  systeme , mp, sp, processus_metier,
			service_emetteur, section_emetteur, source, emis_par , num_visite,
			service_concerne, section_concernee, decouvert, type_acteur, nature_danger,
			lieu, categorie, tranche, etat_tranche, accompagne,
			classement, suivi, etat_circuit, contenu, ligne_defense,
			commentaire, url)
			VALUES 
			(?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?, ?, ?, ?, ?,
			 ?,  ?)');
	if (($handle = fopen($target_file, "r")) !== FALSE)
		{
			$i=0;
			while (($data = fgetcsv($handle, 5000, ";")) !== FALSE) 
			{
				$u = array_map("utf8_encode", $data);
				$req->execute(array($u[0], $u[1], $u[2], $u[3], $u[4], $u[5], $u[6], $u[7], $u[8], $u[9], 
						$u[10], $u[11], $u[12], $u[13], $u[14], $u[15], $u[16], $u[17], $u[18], $u[19], $u[20], $u[21], $u[22], $u[23], $u[24],
						$u[25], $u[26], $u[27], $u[28], $u[29], $u[30], $u[31], $u[32], $u[33], $u[34], $u[35],
						$u[36]));
				$i++;
			}
			fclose($handle);
		}
	$reponse = $bdd->exec("DELETE FROM importcvt WHERE reference NOT LIKE 'CVT%'");
	echo 'import r&eacute;ussi de '.$i.' CVT'.' - suppression de '.$reponse.' FOA';
}
else 
{
	echo "Choisir un fichier csv";
}
?>
