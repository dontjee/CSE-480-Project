<?php

class Employee{

	public $userID;
	public $loginID;
	public $fname;
	public $mname;
	public $lname;
	public $dob;
	public $email;
	public $education;
	public $resumefile;

	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
                case 1:
		    self::construct1($argv[0]);
		    break;
		case 11:
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
			$this->resumeFile = $check['resumefile'];
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
}
