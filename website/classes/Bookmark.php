<?php

class Bookmark{

	public $employeeID;
	public $jobID;
	public $jobTitle;
	public $employerName;

	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
                case 3:
		    self::construct5($argv[0], $argv[1], $argv[2], $argv[3]);
		    break;
	    }
	}
	
	function construct5($employeeID, $jobID, $jobTitle, $employerName){
		$this->employeeID = $employeeID;
		$this->jobID = $jobID;
		$this->jobTitle = $jobTitle;
		$this->employerName = $employerName;
	}
}
