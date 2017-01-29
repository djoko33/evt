<?php
include('connexion.php');
$reponse = $bdd->query('SELECT * FROM codification');
while ($donnees = $reponse->fetch())
{
$sql[] = '('.$bdd->quote($donnees['quad']).
', '.$bdd->quote($donnees['libelle']).
', '.$bdd->quote($donnees['categorie']).
', '.$bdd->quote($donnees['libelle_court']).
')';
}
$reponse->closeCursor();

$dsn = 'pgsql:host=localhost;dbname=terrain;';
$user = 'postgres';
$password = 'danielP0508';

// Connexion à la base de données
try
{
	$bdd = new PDO($dsn, $user, $password);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
foreach ($sql as $s){
$req = $bdd->exec('INSERT INTO codification (quad, libelle, categorie, libelle_court) VALUES ' .$s);}
?>