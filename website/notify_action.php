<?php
require_once("std.php");
require_once("classes/Job.php");

$Auth->UsersOnly();
$Auth->DontAllow(User::$ADMIN);

$user = $Auth->User();
$jobID = $_GET['jID'];
$toID = $_GET['userID'];

$job = new Job($jobID);

if($user->type == User::$EMPLOYEE){
	//This is being sent from an employee, to an employer
	$fromID = $user->userID;
}else{
	//This is being sent from an employer, to an employee
	$fromID = $job->employerID;
}

$DB->Query("INSERT INTO notification
			VALUES(%s, %s, %s, NOW())",
			array($jobID, $toID, $fromID));
