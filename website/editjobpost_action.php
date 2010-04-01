<?php

require_once("std.php");

$Auth->Restrict(User::$EMPLOYER);

$user = $Auth->User();

$id = $_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$closingDateString = $_POST['closingDate'];
$closingDate = strtotime($closingDateString);
$location = $_POST['location'];
$jobType = $_POST['jobType'];
$education = $_POST['education'];
$keyword = $_POST['keyword'];
$category = $_POST['category'];

$createResponse = $DB->Query("UPDATE jobannouncement SET title='%s', closingDate=FROM_UNIXTIME(%s), location='%s', jobType='%s', description='%s', education='%s' WHERE jobID = %s",
array($title, $closingDate, $location, $jobType, $description, $education, $id)); 

$deleteResponse = $DB->Query("DELETE FROM jobcategory WHERE jobID = %s AND employerID = %s",
    array($id, $user->userID)); 
$categories = explode( ",", $category);
foreach( $categories as &$catToInsert )
{
    $createResponse2 = $DB->Query("INSERT INTO jobcategory(jobID, employerID, name) VALUES (%s, %s, '%s')",
    array($id, $user->userID, $catToInsert)); 
}


$deleteResponse2 = $DB->Query("DELETE FROM jobkeywords WHERE jobID = %s AND employerID = %s",
    array($id, $user->userID)); 
$words = explode( ",", $keyword);
foreach( $words as &$word )
{
    $createResponse3 = $DB->Query("INSERT INTO jobkeywords(jobID, employerID, name) VALUES (%s, %s, '%s')",
    array($id, $user->userID, $word)); 
}


header("Location: jobposting?id=" . $id);
?>
