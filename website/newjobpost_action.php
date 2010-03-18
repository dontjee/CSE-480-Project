<?php

require_once("std.php");

$user = $Auth->User();

$employerID = $_POST['title'];
$title = $_POST['title'];
$description = $_POST['description'];
$closingDateString = $_POST['closingDate'];
$closingDate = date(closingDateString);
$location = $_POST['location'];
$jobType = $_POST['jobType'];
$education = $_POST['education'];

$createResponse = $DB->Query("INSERT INTO jobannouncement(employerID, title, posted, closingDate, location, jobType, description, education) VALUES (%s, '%s', NOW(), '%s', '%s', '%s', '%s', '%s')",
array($user->userID, $title, $closingDate, $location, $jobType, $description, $education)); 


$Template->CSS("job");
$Template->CSS("form");
$Template->Header();

if( $createResponse )
{
?>
    <h2> Successfully added the job</h2>
<?php
}
else
{
?>
    <h2> Failed to add the job</h2>
<?php
}


$Template->Footer();
?>
