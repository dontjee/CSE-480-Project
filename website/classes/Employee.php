<?php

require_once("User.php");

class Employee{

	public $type;

	public $userID;
	public $loginID;
	public $fname;
	public $mname;
	public $lname;
	public $dob;
	public $email;
	public $education;
	public $resumefile;
	public $rank;

	function __construct() {
		$this->type = User::$EMPLOYEE;
		
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
			case 1:
				self::construct1($argv[0]);
				break;
			case 9:
				self::construct9($argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $argv[6], $argv[7], $argv[8] );
				break;
	    }
	}
	
	function construct1($userID){
		global $DB;
	
		$check = $DB->QueryRow("SELECT userID, loginID, fname, mname, lname, dob, email, education, resumefile FROM users AS u INNER JOIN employees AS e ON u.userID = e.users_userID WHERE u.userID = %s", array($userID));

		if($check){
			$this->userID = $userID;
			$this->loginID = $check['loginID'];
			$this->fname = $check['fname'];
			$this->mname = $check['mname'];
			$this->lname = $check['lname'];
			$this->dob = $check['dob'];
			$this->email = $check['email'];
			$this->education = $check['education'];
			$this->resumefile = $check['resumefile'];
		}else{
			$this->employeeID = -1;
		}

	}
	
	function construct9($userID, $loginID, $fname, $mname, $lname, $dob, $email, $education, $resumefile){
		$this->userID = $userID;
		$this->loginID = $loginID;
		$this->fname = $fname;
		$this->mname = $mname;
		$this->lname = $lname;
		$this->dob = $dob;
		$this->email = $email;
		$this->education = $education;
		$this->resumefile = $resumefile;
	}
	
	function FullName(){
		return $this->fname . ' ' . $this->mname . ' ' . $this->lname;
	}
	
	function GetComments($employerID)
	{
		global $DB;
		$tempCommentArray = array();

		$comments = $DB->Query("SELECT commentID, employerID, employeeID, message, postedTime FROM comments WHERE employerID = %s AND employeeID = %s", array( $employerID, $this->userID ));
		if($comments)
		{
		    foreach( $comments as &$comment )
		    {
			$comment = new Comment($comment['commentID'], $comment['employerID'], $comment['employeeID'], $comment['message'], $comment['postedTime']);
			array_push($tempCommentArray, $comment);
		    }
		}
		return $tempCommentArray;
	}
	
	function Get($item){
		global $DB;
		switch($item){
			case('keywords'):
				$table='employeekeywords';
				$field='keyword';
				break;
			case('categories'):
				$table='employeecategory';
				$field='name';
				break;
			case('skills'):
				$table='employeeskills';
				$field='name';
				break;
			default:
				return false;
		}
		
		$tempArray = $DB->Query("SELECT $field FROM $table WHERE employeeID=$this->userID");
		
		$names = array();
		foreach ($tempArray as $row){
			$names[] = $row[$field];
		}
		
		return $names; 
	}
	
	
	function Set($item,$array){
		global $DB;
		switch($item){
			case('keywords'):
				$table='employeekeywords';
				$field='keyword';
				break;
			case('categories'):
				$table='employeecategory';
				$field='name';
				break;
			case('skills'):
				$table='employeeskills';
				$field='name';
				break;
			default:
				return false;
		}
		
		$array = array_map('trim',$array);
		$array = array_map('strtolower',$array);
		$array = array_unique($array);
		
		$current = $this->Get($item);
		$new = array();
		foreach($array as $a){
			if ($a != "") $new[] = $a;
		} 				


		// our db has some redundancy, so we have to do a manual check to make sure things 
		// are not replicated.
		$add = array_diff($new, $current);
		$remove = array_diff($current, $new);
		
		if (sizeof($remove) > 0){
			$query = "DELETE FROM $table WHERE employeeID=$this->userID AND (";
			foreach($remove as $name){
				$query.= "$field='$name' OR "; 
			}
			$query = substr($query,0,-4);
			$query.= ")";
			
			$DB->Query($query);
		}
		
		
		if (sizeof($add) > 0){
			$query = "INSERT INTO $table (employeeID, $field) VALUES ";
			foreach($add as $name){
				if ($name!="") $query.= "($this->userID, '$name'),"; 
			}
			$query = substr($query,0,-1);
			
			$DB->Query($query);
		} 
	}
	

}
