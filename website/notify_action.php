<?php
require_once("std.php");
require_once("classes/Job.php");

$Auth->UsersOnly();
$Auth->DontAllow(User::$ADMIN);

$user = $Auth->User();
$jobID = $_GET['jID'];

$job = new Job($jobID);

if($user->type == User::$EMPLOYEE){
	//This is being sent from an employee, to an employer
	$fromID = $user->userID;
	$toID = $job->employerID;
}else{
	//This is being sent from an emploer, to an employee
	$fromID = $job->employerID;
	$toID = $_GET['userID'];
}

$DB->Query("INSERT INTO notification
			VALUES(%s, %s, %s, NOW())",
			array($jobID, $toID, $fromID));
