<?php

require_once("Employer.php");

class Job{

	//From this table
	public $jobID;
	public $employerID;
	public $title;
	public $posted;
	public $closingDate;
	public $location;
	public $jobType;
	public $description;
	public $education;
	public $rank;

	//Useful values
	public $employer;
	
	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
			case 1:
				self::construct1($argv[0]);
				break;
			case 9:
				self::construct9($argv[0], $argv[1], $argv[2], $argv[3], $argv[4], $argv[5], $argv[6], $argv[7], $argv[8]);
				break;
	    }
	}
	
	function construct1($jobID){
		global $DB;
	
		$check = $DB->QueryRow("SELECT * 
								FROM jobannouncement
								WHERE jobID = %s",
								array($jobID));

		if($check){
			$this->jobID = $jobID;
			$this->employerID = $check['employerID'];
			$this->title = $check['title'];
			$this->posted = $check['posted'];
			$this->closingDate = $check['closingDate'];
			$this->location = $check['location'];
			$this->jobType = $check['jobType'];
			$this->description = $check['description'];
			$this->education = $check['education'];
			
			$this->employer = new Employer($this->employerID);
		}else{
			$this->jobID = -1;
		}

	}
	
	function construct9($jobID, $employerID, $name, $title, $posted, $closingDate, $location, $jobType, $description, $education){
		$this->jobID = $jobID;
		$this->name = $employerID;
		$this->name = $name;
		$this->title = $title;
		$this->posted = $posted;
		$this->closingDate = $closingDate;
		$this->location = $location;
		$this->jobType = $jobType;
		$this->description = $description;
		$this->education = $education;
	}
	
	function Keywords(){
		global $DB;
	
		$check = $DB->Query("SELECT * 
					FROM jobkeywords
					WHERE jobID = %s",
					array($this->jobID));

		$keywords = array();
		if($check){
			foreach( $check as &$keyword )
			{
				array_push( $keywords, $keyword['name'] );
			}
		}

		return $keywords;
	}
	
	function Categories(){
		global $DB;
	
		$check = $DB->Query("SELECT * 
					FROM jobcategory
					WHERE jobID = %s",
					array($this->jobID));

		$categories = array();
		if($check){
			foreach( $check as &$category )
			{
				array_push( $categories, $category['name'] );
			}
		}

		return $categories;
	}
	
	function Skills(){
		global $DB;
	
		$check = $DB->Query("SELECT * 
					FROM jobskills
					WHERE jobID = %s",
					array($this->jobID));

		$skills = array();
		if($check){
			foreach( $check as &$skill )
			{
				array_push( $skills, $skill['name'] );
			}
		}

		return $skills;
	}
}
