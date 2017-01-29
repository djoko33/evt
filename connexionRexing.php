<?php
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
?>
