<?php

require_once("std.php");

$HOME = array(
	User::$EMPLOYEE=>"employee_home.php",
	User::$EMPLOYER=>"employer_home.php",
	User::$ADMIN=>"index.php"
);

$Auth->Logout();

$loginID = $_POST['loginID'];
$password = $_POST['password'];


$checkID = $DB->QueryRow("SELECT userID FROM users WHERE loginID = '%s' AND passwd = '%s'",
						array($loginID, $password));

if($checkID){
	//Succesful login
	$Auth->Login($checkID['userID']);
	header("Location: " . $HOME[$Auth->User()->type]);
}else{
	//Unsuccesful login
	header("Location: login.php");
}	

