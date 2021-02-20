<?php

namespace App\Services\Data;

use App\Models\UserModel;
use App\Services\Data\Utility\Database;
use Exception;

class SecurityDAO {	
	
	private $connection;
	
	/**
	 * Default Constuctor inorder to initialze the connection varible to the database
	 */
	public function __construct() {
		$database = new Database();
		$this->connection = $database->getConnection();
	}
	
	
	// Method to find a user
	public function findByUser(UserModel $user) {
		
		try {
			//SQL statment to select the user matching the parameter
			$sqlQuery = "SELECT * FROM USERS WHERE USERNAME = '{$user->getUsername()}' AND PASSWORD = '{$user->getPassword()}'";
			mysqli_query($this->connection, $sqlQuery);
			
			if($this->connection->affected_rows == 0) {
				return false;
			}			
			else {
				return true;
			}
		}
		catch(Exception $e) {
			//Throw exception
			throw new Exception("Exception: " . $e->getMessage(), 0, $e);
		}
	}
	
}

