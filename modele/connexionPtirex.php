<?php
$dsn = 'pgsql:host=localhost;dbname=ptirex;';
$user = 'postgres';
$password = 'postgres';

// Connexion � la base de donn�es
try
{
	$ptirex = new PDO($dsn, $user, $password);
}
catch(PDOException $e)
{
	die('Erreur : '.$e->getMessage());
}
?>
