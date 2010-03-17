<?php

require_once("std.php");

$Auth->Logout();

$loginID = $_POST['loginID'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];

if( $password == $confirmPassword )
{
	$createResponse = $DB->Query("INSERT INTO INSERT INTO users(loginID, passwd) VALUES ('%s', '%s')", array($loginID, $password));
}
else
{
	//unsuccessful signup
        header("Location: signup.php");
}

//Succesful login
$Auth->Login($checkID['userID']);
header("Location: index.php");
