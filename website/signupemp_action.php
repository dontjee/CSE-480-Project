<?php

require_once("std.php");

$Auth->Logout();

$loginID = $_POST['loginID'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];

if( $password == $confirmPassword )
{
	$createResponse = $DB->Query("INSERT INTO users(loginID, passwd) VALUES ('%s', '%s')", array($loginID, $password));

	$userIdResult = $DB->QueryRow("SELECT userID FROM users WHERE loginID = '%s'", array($loginID));
	$userId = $userIdResult['userID'];

	$userUpdate = $DB->Query("INSERT INTO employees(users_userID, fname, lname) VALUES (%s, '%s', '%s')", array($userId, $firstName, $lastName));
	
	// automatically login the user
	$Auth->Login($userId);
	header("Location: index.php");
}
else
{
	//unsuccessful signup
        header("Location: signupemp.php");
}
