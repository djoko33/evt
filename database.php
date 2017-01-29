<?php
class Database
{
	private static $dbName = 'crud_tutorial' ;
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = 'root';

	private static $cont  = null;
	
	public function __construct() 
	{
		        die('Init function is not allowed');
	}

	public static function connect()
	{
// One connection through whole application
		if ( null == self::$cont)
		{
			try
			{
				self::$cont = new PDO("mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
			}
			catch(PDOException $e){}
		}
		return self::$cont;
	}

	public static function disconnect()
	{
		self::$cont = null;
	}
}
?>

utilisation
include 'database.php';
$pdo = Database::connect();
$sql = 'SELECT * FROM customers ORDER BY id DESC';
foreach ($pdo->query($sql) as $row) {
                           
                   }
Database::disconnect();