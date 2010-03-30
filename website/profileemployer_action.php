<?php 
require_once("std.php");
if ($CurrentUser->type!=User::$EMPLOYER){
	header("location: index.php");
}
$_REQUEST=array_map("mysql_real_escape_string",$_REQUEST);

$query ="UPDATE employers SET ";
$query.="name='$_POST[name]', streetNumber='$_POST[streetNumber]', city='$_POST[city]', state='$_POST[state]', ";
$query.="zip='$_POST[zip]', email='$_POST[email]', phone='$_POST[phone]', website='$_POST[website]', ";
$query.="companyType='$_POST[companyType]', description='$_POST[description]' ";
$query.="WHERE users_userID=$CurrentUser->userID";

//if($DB->Query($query)){
//	header("location: profileemployer.php?update=successful");	
//}
//header("location: profileemployer.php?update=unsuccessful");

header("location: profileemployer.php");
?>