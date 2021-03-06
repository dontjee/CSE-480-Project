<?php
/*

Purpose: User class

Usage:	$user = new User(1, User::$Employee);	//Contructor accepts userID and optional user type
		echo $user-loginID();
		
*/

require_once("Employee.php");
require_once("Employer.php");

class User{

	//User types enumerations
	public static $EMPLOYEE = "Employee";
	public static $EMPLOYER = "Employer";
	public static $ADMIN = "Admin";
	
	public $userID;
	public $loginID;
	public $type;
	public $passwd;
	
	function __construct($userID, $type=null){
		global $DB;
	
		$check = $DB->QueryRow("SELECT * FROM users WHERE userID = %s", array($userID));

		if($check){
			$this->userID = $userID;
			$this->loginID = $check['loginID'];
			$this->passwd = $check['passwd'];
			
			//Autofind type if not included
			if($type)
				$this->type = $type;
			else
				$this->type = User::TypeFromID($userID);
				
		}else{
			$this->userID = 0;
		}

	}
	
	
	
	
	/*
	*	Static stuff
	*/
	
	//Return the type of user based on which
	public static function TypeFromID($userID){
		global $DB;
		if($DB->QueryRow("SELECT users_userID FROM employees WHERE users_userID = %s", array($userID)) )
			return User::$EMPLOYEE;
		if($DB->QueryRow("SELECT users_userID FROM employers WHERE users_userID = %s", array($userID)) )
			return User::$EMPLOYER;
		if($DB->QueryRow("SELECT users_userID FROM admins WHERE users_userID = %s", array($userID)) )
			return User::$ADMIN;
		return null;
	}
	
	//Return the subclass based on the user type, given the user ID.
	public static function GetUserSubclass($userID){
		switch(User::TypeFromID($userID)){
			case User::$EMPLOYEE:
				return new Employee($userID);
			case User::$EMPLOYER:
				return new Employer($userID);
			case User::$ADMIN:
				return new User($userID);
		}
	}

}