<?php 
$USERNAME = 'root';
$PASSWORD = '';
$HOST = 'localhost';
$DB = 'project_db';

class Database{
	
	// Step 1 of Singleton: Create Private static Instance 
	private static $instance;

	private $Connection;
	
	// Step 2 Singleton: Create Private Constructor
	private function Database(){
		$this->Open_Connection();
	}
	
	// Step 3 Singleton: Create public  static method to Get instance of Database.
	public static function GetInstance(){
		if(!isset(self::$instance)){
			self::$instance = new Database();
		}
		return self::$instance;
	}
	public function Open_Connection(){
		global $HOST, $DB, $USERNAME, $PASSWORD;
		try{
			$this->Connection = new PDO("mysql:host=$HOST; dbname=$DB", $USERNAME, $PASSWORD);
			$this->Connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			// echo "You are connected !";
		}catch(PDOException $e){
			echo "Connection failed : ".$e->getMessage();
		}
	}
	
	public function Close_Connection(){
		$this->Connection = NULL;
	}
	
	public function Get_Connection(){
		return $this->Connection;
	}
}
?>