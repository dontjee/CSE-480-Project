<?php
require_once("std.php");

$Auth->Restrict("Employee");

$user = $Auth->User();
$jobID = $_GET['jID'];

$createResponse = $DB->Query("INSERT INTO bookmarks(employeeID, jobID) VALUES(%s, %s);", array($user->userID, $jobID));