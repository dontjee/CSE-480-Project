<?php 
require_once("std.php");
if ($CurrentUser->type!=User::$EMPLOYER){
	header("location: index.php");
}
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

header("location: profileemployer.php");
?>