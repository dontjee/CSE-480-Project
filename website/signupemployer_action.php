<?php

require_once("std.php");

$Auth->Logout();

$loginID = $_POST['loginID'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$name = $_POST['name'];

if( $password == $confirmPassword )
{
	$createResponse = $DB->Query("INSERT INTO users(loginID, passwd) VALUES ('%s', '%s')", array($loginID, $password));

	$userIdResult = $DB->QueryRow("SELECT userID FROM users WHERE loginID = '%s'", array($loginID));
	$userId = $userIdResult['userID'];

	$userUpdate = $DB->Query("INSERT INTO employers(users_userID, name) VALUES (%s, '%s')", array($userId, $name));

	// automatically login the user
	$Auth->Login($userId);
	header("Location: index.php");
}
else
{
	//unsuccessful signup
        header("Location: signupemployer.php");
}
