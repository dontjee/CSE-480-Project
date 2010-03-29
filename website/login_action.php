<?php

require_once("std.php");

$Auth->Logout();

$loginID = $_POST['loginID'];
$password = $_POST['password'];


$checkID = $DB->QueryRow("SELECT userID FROM Users WHERE loginID = '%s' AND passwd = '%s'",
						array($loginID, $password));

if($checkID){
	//Succesful login
	$Auth->Login($checkID['userID']);
	header("Location: index.php");
}else{
	//Unsuccesful login
	header("Location: login.php");
}	

