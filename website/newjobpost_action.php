<?php

require_once("std.php");

$Auth->Restrict(User::$EMPLOYER);

$user = $Auth->User();

$title = $_POST['title'];
$description = $_POST['description'];
$closingDateString = $_POST['closingDate'];
$closingDate = date($closingDateString);
$location = $_POST['location'];
$jobType = $_POST['jobType'];
$education = $_POST['education'];
$keyword = $_POST['keyword'];
$category = $_POST['category'];

$createResponse = $DB->Query("INSERT INTO jobannouncement(employerID, title, posted, closingDate, location, jobType, description, education) VALUES (%s, '%s', NOW(), '%s', '%s', '%s', '%s', '%s')",
array($user->userID, $title, $closingDate, $location, $jobType, $description, $education)); 

$userIdResult = $DB->QueryRow("SELECT jobID, posted FROM jobannouncement WHERE employerID = %s ORDER BY posted DESC LIMIT 1", array($user->userID));
$jobID = $userIdResult['jobID'];


$createResponse2 = $DB->Query("INSERT INTO jobcategory(jobID, name) VALUES (%s, '%s')",
array($jobID, $category)); 


$createResponse2 = $DB->Query("INSERT INTO jobkeywords(jobID, name) VALUES (%s, '%s')",
array($jobID, $keyword)); 


$Template->CSS("form");
$Template->Header();

?>
    <h2> Successfully added the job</h2>
<?php
$Template->Footer();
?>
