<?php 
require_once("std.php");
error_reporting(E_ALL);
$Auth->Restrict("Employer");

if (sizeof($_POST)==0){
	header("location: profileemployer.php");
	die;
}

$_POST=array_map("mysql_real_escape_string",$_POST);

$query ="UPDATE employers SET ";
foreach($_POST as $key=>$value){
	$query.="$key='$value', ";
}
$query=substr($query,0,-2);
$query.=" WHERE users_userID=$CurrentUser->userID";
$DB->Query($query);

header("location: profileemployer.php");
?>