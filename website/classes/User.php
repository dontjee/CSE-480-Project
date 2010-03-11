<?php
/*

Purpose: User class

Usage:	$user = new User(1);
		echo $user-loginID();
		
*/

class User{

	public $userID;
	public $loginID;
	public $passwd;
	
	//Constructor
	function __construct($userID){

		$check = dbquery("SELECT * FROM users WHERE user_id = %s", array($user_id));

		if(count($check)){
			$this->userID = $userID;
			$this->loginID = $check[0]['loginID'];
			$this->passwd = $check[0]['passwd'];
		}else{
			$this->userID = 0;
		}

	}

}