<?php

class Job{

	public $jobID;
	public $name;
	public $title;
	public $posted;
	public $closingDate;
	public $location;
	public $jobType;
	public $description;
	public $education;
	public $category;
	public $keyword;

	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
                case 1:
		    self::construct1($argv[0]);
		    break;
		case 11:
		    self::construct11($argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $argv[6], $argv[7], $argv[8], $argv[9], $argv[10] );
		    break;
	    }
	}
	
	function construct1($jobID){
		global $DB;
	
		$check = $DB->QueryRow("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education, jc.name AS category, jk.name AS keyword FROM jobannouncement AS ja INNER JOIN jobcategory AS jc ON ja.jobID = jc.jobID INNER JOIN jobkeywords AS jk ON ja.jobID = jk.jobID INNER JOIN employers AS er ON er.users_userID = ja.employerID WHERE ja.jobID = %s", array($jobID));

		if($check){
			$this->jobID = $jobID;
			$this->name = $check['name'];
			$this->title = $check['title'];
			$this->posted = $check['posted'];
			$this->closingDate = $check['closingDate'];
			$this->location = $check['location'];
			$this->jobType = $check['jobType'];
			$this->description = $check['description'];
			$this->education = $check['education'];
			$this->category = $check['category'];
			$this->keyword = $check['keyword'];
		}else{
			$this->jobID = -1;
		}

	}
	function construct11($jobID, $name, $title, $posted, $closingDate, $location, $jobType, $description, $education, $category, $keyword){

		$this->jobID = $jobID;
		$this->name = $name;
		$this->title = $title;
		$this->posted = $posted;
		$this->closingDate = $closingDate;
		$this->location = $location;
		$this->jobType = $jobType;
		$this->description = $description;
		$this->education = $education;
		$this->category = $category;
		$this->keyword = $keyword;
	}
}
