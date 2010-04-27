
<?php

class Comment{

	public $commentID;
	public $employerID;
	public $employeeID;
	public $message;
	public $postedTime;
	public $employeeName;

	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		case 3:
		    self::construct3($argv[0], $argv[1], $argv[2]);
		    break;
		case 4:
			self::construct4($argv[0], $argv[1], $argv[2], $argv[3]);
			break;
		default:
		case 5:
		    self::construct5($argv[0], $argv[1], $argv[2], $argv[3], $argv[4] );
		    break;
	    }
	}
	function construct5($commentID, $employerID, $employeeID, $message, $postedTime){
		$this->commentID = $commentID;
		$this->employerID = $employerID;
		$this->employeeID = $employeeID;
		$this->message = $message;
		$this->postedTime = $postedTime;
	}
	function construct3($employeeName, $message, $postedTime){
		$this->employeeName = $employeeName;
		$this->message = $message;
		$this->postedTime = $postedTime;
	}
	function construct4($employeeName, $message, $postedTime, $employeeID){
		$this->employeeName = $employeeName;
		$this->message = $message;
		$this->postedTime = $postedTime;
		$this->employeeID = $employeeID;
	}
}
