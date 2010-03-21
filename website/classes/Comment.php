
<?php

class Comment{

	public $commentID;
	public $employerID;
	public $employeeID;
	public $message;
	public $postedTime;

	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
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
}
