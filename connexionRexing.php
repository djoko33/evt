<?php
$dsn = 'pgsql:host=localhost;dbname=rexing;';
$user = 'postgres';
$password = 'postgres';

// Connexion � la base de donn�es
try
{
	$bdd = new PDO($dsn, $user, $password);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
?>
