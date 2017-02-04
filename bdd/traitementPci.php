<?php
//injecte dans la table PCI les donn�es n�cessaires au TdB
include_once 'traitementFn.php';
include('../connexionPG.php');// todo changer le chemin
$reponse = $bdd->query("SELECT * FROM importcvt WHERE decouvert LIKE 'PCI%'");


$sql = array();
while ($donnees = $reponse->fetch())
{
	if ($donnees['date_cvt']!= ''){
		$dat=date_convert($donnees['date_cvt']);
	}
	else $dat=date_convert($donnees['date_creation']);

	$sql[] = '('.$bdd->quote($donnees['reference']).
			', '.$bdd->quote(emet_convert($donnees['emis_par'])).
			', '.$bdd->quote($donnees['service_emetteur']).
			', '.$bdd->quote($donnees['classement']).
			', '.$bdd->quote($dat).
			')';
	
}

$reponse->closeCursor();
foreach ($sql as $s){
	$req = $bdd->exec('INSERT INTO pci (reference, emetteur, serv_emet,  class, datecvt) VALUES '.$s);
}
//suppression des doublons (m�me date, m�me emetteur, m�me code)
$req = $bdd->exec('DELETE FROM pci AS t1 WHERE t1.reference < ANY (SELECT reference FROM pci as t2 WHERE t1.reference<>t2.reference
		AND   t1.emetteur = t2.emetteur
		AND   t1.serv_emet = t2.serv_emet
		AND   t1.class = t2.class
		AND t1.datecvt = t2.datecvt)');
echo "Traitement Termin&eacute;";

//requete pour trouver les doublons
//SELECT DISTINCT * FROM pci t1 WHERE EXISTS (SELECT * FROM pci t2 WHERE t1.reference <> t2.reference
//AND   t1.emetteur = t2.emetteur AND t1.serv_emet = t2.serv_emet AND t1.class = t2.class AND t1.datecvt = t2.datecvt ) ORDER by reference



?>