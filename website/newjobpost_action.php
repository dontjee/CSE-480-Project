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
$skill = $_POST['skill'];

$createResponse = $DB->Query("INSERT INTO jobannouncement(employerID, title, posted, closingDate, location, jobType, description, education) VALUES (%s, '%s', NOW(), '%s', '%s', '%s', '%s', '%s')",
array($user->userID, $title, $closingDate, $location, $jobType, $description, $education)); 

$userIdResult = $DB->QueryRow("SELECT jobID, posted FROM jobannouncement WHERE employerID = %s ORDER BY posted DESC LIMIT 1", array($user->userID));
$jobID = $userIdResult['jobID'];


$categories = explode( ",", $category);
foreach( $categories as &$catToInsert )
{
    $createResponse2 = $DB->Query("INSERT INTO jobcategory(jobID, name) VALUES (%s, '%s')",
    array($jobID, $catToInsert)); 
}

$skills = explode( ",", $skill);
foreach( $skills as &$skillToInsert )
{
    $createResponse4 = $DB->Query("INSERT INTO jobskills(jobID, name) VALUES (%s, '%s')",
    array($jobID, $skillToInsert)); 
}

$words = explode( ",", $keyword);
foreach( $words as &$word )
{
    $createResponse3 = $DB->Query("INSERT INTO jobkeywords(jobID, name) VALUES (%s, '%s')",
    array($jobID, $word)); 
}



$Template->CSS("form");
$Template->Header();

?>
    <h2> Successfully added the job</h2>
<?php
$Template->Footer();
?>
