<?php

require_once("Job.php");
require_once("User.php");

class Notification{

	public $job;
	public $from;
	public $to;
	public $timestamp;
	
	function __construct() {
	    $argv = func_get_args();
	    switch( func_num_args() )
	    {
		default:
			case 3:
				self::construct1($argv[0], $argv[1], $argv[2]);
				break;
	    }
	}
	
	function construct1($jobID, $toID, $fromID){
		global $DB;
		
		$check = $DB->QueryRow("SELECT *
								FROM notification
								WHERE jobID = %s AND $toID = %s AND fromID = %s",
								Array($jobID, $toID, $fromID));
								
		if($check){
			$this->job = new Job($check['jobID']);
			$this->to = User::GetUserSubclass($check['toID']);
			$this->from = User::GetUserSubclass($check['fromID']);
			$this->timestamp = $check['timeSent'];
		}
	}
	
	function KeyToVars(){
		return "&jobID=" . $this->job->jobID . "&toID=" . $this->to->userID . "&fromID=" . $this->from->userID;
	}
	
	/*
	*	Static Stuff
	*/
	
	//Get a list of notifications sent to a particular user
	static function GetNotificationsTo($toID){
		global $DB;

		$notifs = Array();
		$result = $DB->Query("	SELECT *
								FROM notification
								WHERE toID = %s",
								Array($toID));
		if($result){
			foreach($result as $row){
				array_push($notifs, new Notification($row['jobID'],$row['toID'],$row['fromID']));
			}
		}
		return $notifs;
	}
}
