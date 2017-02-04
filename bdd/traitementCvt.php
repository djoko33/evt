<?php
include('../connexionPG.php');
include('traitementFn.php');
$reponse = $bdd->query('SELECT * FROM importcvt');
$sql = array();
$sqlLdd = array();
while ($donnees = $reponse->fetch())
{
	//echo '<p>'.$donnees['reference'].$donnees['section_concernee'].'</p>';
	if ($donnees['date_cvt']!= ''){
		$dat=date_convert($donnees['date_cvt']);
	}
	else $dat=date_convert($donnees['date_creation']);
	

	$exploded=explode(",", codes($donnees['ligne_defense']));
	
	foreach ($exploded as $c){
		$sqlLdd[]= '('.$bdd->quote($donnees['reference']).','.
				$bdd->quote($c).')';
	}
	$sql[] = '('.$bdd->quote($donnees['reference']).
			', '.$bdd->quote($donnees['titre']).
			', '.$bdd->quote(emet_convert($donnees['emis_par'])).
			', '.$bdd->quote($donnees['service_emetteur']).
			', '.$bdd->quote(section($donnees['section_emetteur'])).
			', '.$bdd->quote($donnees['service_concerne']).
			', '.$bdd->quote(section($donnees['section_concernee'])).
			', '.$bdd->quote($donnees['etat_circuit']).
			', '.$bdd->quote($donnees['contenu']).
			', '.$bdd->quote($dat).
			', '.$bdd->quote(codes($donnees['ligne_defense'])).
			', '.$bdd->quote(sousProcessus($donnees['processus_metier'])).
			', '.$bdd->quote(nature($donnees['nature'])).
			', '.$bdd->quote(pfi($donnees['pfi'])).
			', '.$bdd->quote($donnees['classement']).
			')';	
}
$reponse->closeCursor();
foreach ($sql as $s){
	$req = $bdd->exec('INSERT INTO CVT (reference, titre, emetteur, serv_emet, sect_emet, serv_conc, sect_conc, texte, action, dateCVT, codes, sp, nature, pfi, pci) VALUES '.$s);
}
echo "Traitement Termine : ".count($sql).' CVT traites';
?>