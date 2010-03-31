<?php

require_once("User.php");

class Employer{

	public $type;

	public $userID;
	public $loginID;
	public $name;
	public $streetNumber;
	public $city;
	public $state;
	public $zip;
	public $email;
	public $phone;
	public $website;
	public $companyType;
	public $description;

	function __construct() {
		$this->type = User::$EMPLOYER;
	
	    $argv = func_get_args();
	    switch( func_num_args() ){
			case 1:
				self::construct1($argv[0]);
				break;
	    }
	}
	
	function construct1($userID){
		global $DB;
	
		$check = $DB->QueryRow("SELECT * 
								FROM users, employers
								WHERE users.userID = %s AND employers.users_userID = users.userID",
								array($userID));

		if($check){
			$this->userID = $userID;
			$this->loginID = $check['loginID'];
			$this->name = $check['name'];
			$this->streetNumber = $check['streetNumber'];
			$this->city = $check['city'];
			$this->state = $check['state'];
			$this->zip = $check['zip'];
			$this->email = $check['email'];
			$this->phone = $check['phone'];
			$this->website = $check['website'];
			$this->companyType = $check['companyType'];
			$this->description = $check['description'];
		}else{
			$this->employeeID = -1;
		}

	}
	
	//Get all the jobs from this employer.
	function GetJobs($includeExpired = false){
		require_once("Job.php");
		global $DB;
		$jobs = Array();
		
		if($includeExpired){
			$result = $DB->Query("	SELECT jobID
									FROM jobannouncement
									WHERE employerID = %s",
									Array($this->userID));
		}else{
			//TODO: Make this only show non-expired jobs
			$result = $DB->Query("	SELECT jobID
									FROM jobannouncement
									WHERE employerID = %s",
									Array($this->userID));
		}
		
		foreach($result as $row)
			array_push($jobs, new Job($row['jobID']));
			
		return $jobs;
	}

}