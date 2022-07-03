<?php
require_once "Database.php";

class User
{
	// private static $database;

	private $User_ID;
	private $First_Name;
	private $Last_Name;
	private $Email;
	private $username;
	private $Password;
	private $Salt;
	private $Role_ID;

	function User($first_Name, $last_Name, $email, $username, $password, $role_ID, $user_ID = NULL)
	{
		$this->First_Name = $first_Name;
		$this->Last_Name  = $last_Name;
		$this->Email = $email;
		$this->username = $username;
		$this->Salt = $this->CreateSalt();
		$this->Password = crypt($password, $this->Salt);
		$this->Role_ID = $role_ID;
		$this->User_ID = $user_ID;
	}

	// public static function Init_Database()
	// {
	// 	if (!isset(self::$database)) {
	// 		self::$database = new Database();
	// 	}
	// }

	private function CreateSalt()
	{
		$algorithms = array("2a", "2x", "2y"); // BlowFish Algorithm
		$random_algo = rand(0, 2);
		$string = substr(MD5($this->Last_Name), 0, 22);
		$salt = "$" . $algorithms[$random_algo] . "$" . "05" . "$" . $string . "$";
		return $salt;
	}

	// private function GetSalt()
	// {
	// 	$database=Database::GetInstance();
	// }

	public function Insert()
	{
		try {
			$database = Database::GetInstance();
			$query = "INSERT INTO users (First_Name, Last_Name, Email, username, Password, Salt, Role_ID)";
			$query .= " VALUES(?,?,?,?,?,?,?)";
			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->bindParam(1, $this->First_Name);
			$statement->bindParam(2, $this->Last_Name);
			$statement->bindParam(3, $this->Email);
			$statement->bindParam(4, $this->username);
			$statement->bindParam(5, $this->Password);
			$statement->bindParam(6, $this->Salt);
			$statement->bindParam(7, $this->Role_ID);

			$statement->execute();
			// echo "User inserted ID = ".$connection->lastInsertId();

		} catch (PDOException $e) {
			echo "INSERT Query Failed : " . $e->getMessage();
		}
	}
	public static function Email_Exists($email)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE Email = '$email'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);


			if (!empty($result['user_id'])) {
				return true;
			}

			return false;
		} catch (PDOException $e) {
			echo "INSERT Query Failed : " . $e->getMessage();
		}
	}
	public static function username_Exists($username)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT COUNT(*) FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);

			if ($result['COUNT(*)'] > 0) {
				return true;
			}
			return false;
		} catch (PDOException $e) {
			echo "INSERT Query Failed : " . $e->getMessage();
		}
	}
	public static function  Emailusername_Exists($username, $email)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);


			if (!empty($result['Email'] == $email)) {
				return true;
			}

			return false;
		} catch (PDOException $e) {
			echo "INSERT Query Failed : " . $e->getMessage();
		}
	}
	//? ANTHER WAY TO CHECK.
	// public static function Emailusername_Exists($username,$email)
	// {
	// 	try {
	// 		$database=Database::GetInstance();
	// 		$query = "SELECT COUNT(*) FROM users WHERE username = '$username' AND Email= '$email'";

	// 		$connection = $database->Get_Connection();
	// 		$statement  = $connection->prepare($query);
	// 		$statement->execute();

	// 		$result = $statement->fetch(PDO::FETCH_ASSOC);

	// 		if ($result['COUNT(*)'] > 0) {
	// 			return true;
	// 		}
	// 		return false;
	// 	} catch (PDOException $e) {
	// 		echo "INSERT Query Failed : " . $e->getMessage();
	// 	}
	// }


	public static function Login($username, $password)
	{
		try {
			if (self::username_Exists($username)) {
				$database = Database::GetInstance();
				$connection = $database->Get_Connection();

				$query = "SELECT salt FROM users WHERE username = '$username'";

				$statement  = $connection->prepare($query);
				$statement->execute();
				$result = $statement->fetch(PDO::FETCH_ASSOC);

				$salt = $result["salt"];

				$passwordSalt = crypt($password, $salt);

				$query = "SELECT * FROM users WHERE username = '$username' and password = '$passwordSalt'";
				// $connection = $database->Get_Connection();
				$statement  = $connection->prepare($query);
				$statement->execute();
				$result = $statement->fetch(PDO::FETCH_ASSOC);
				// echo "</br>";
				// print_r($result);
				if (!empty($result['user_id'])) {
					return true;
				}
			}
			return false;
		} catch (PDOException $e) {
			echo "Select Login Query Failed: " . $e->getMessage();
		}
	}

	public static function GetField($username, $fieldName)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
			return $result[$fieldName];
		} catch (PDOException $e) {
			echo "Encrypt Query Failed : " . $e->getMessage();
		}
	}

	private static function GetSalt($username)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
			return $result['salt'];
		} catch (PDOException $e) {
			echo "Encrypt Query Failed : " . $e->getMessage();
		}
	}
	public static function GetRoleID($username)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
			return $result['Role_ID'];
		} catch (PDOException $e) {
			echo "Encrypt Query Failed : " . $e->getMessage();
		}
	}
	public static function GetUserID($username)
	{
		try {
			$database = Database::GetInstance();
			$query = "SELECT * FROM users WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->prepare($query);
			$statement->execute();

			$result = $statement->fetch(PDO::FETCH_ASSOC);
			//print_r($result);
			return $result['user_id'];
		} catch (PDOException $e) {
			echo "Encrypt Query Failed : " . $e->getMessage();
		}
	}
	public static function  UpdatePassword($username, $password)
	{
		try {
			$database = Database::GetInstance();
			$salt = self::GetSalt($username);
			$encryptedPassword = crypt($password, $salt);
			$query = "UPDATE users SET password = '$encryptedPassword'";
			$query .= " WHERE username = '$username'";

			$connection = $database->Get_Connection();
			$statement  = $connection->exec($query);
		} catch (PDOException $e) {
			echo "Update Query Failed : " . $e->getMessage();
		}
	}
}
