<?php

require_once("std.php");

$Auth->Restrict("Employee");

$user = $Auth->User();

$jobID = $_GET['jID'];

$employerID = $DB->QueryRow("SELECT employerID FROM jobannouncement WHERE jobID = %s;", array($jobID));

$employerID = $employerID['employerID'];

    $createResponse = $DB->Query("INSERT INTO bookmarks(employeeID, jobID, jobannouncement_employerID) VALUES(%s, %s, %s);", array($user->userID, $jobID, $employerID));

    header("Location: jobposting.php?id=" . $jobID);
