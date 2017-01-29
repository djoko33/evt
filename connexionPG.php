<?php
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
?>
