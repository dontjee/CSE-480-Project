<?php 
require_once("std.php");
if ($CurrentUser->type!=User::$EMPLOYEE){
	header("location: index.php");
}
$_REQUEST=array_map("mysql_real_escape_string",$_REQUEST);

$query ="UPDATE employees SET ";
$query.="fname='$_POST[fname]', mname='$_POST[mname]', lname='$_POST[lname]', dob='$_POST[dob]', ";
$query.="email='$_POST[email]', education='$_POST[education]' ";
$query.="WHERE users_userID=$CurrentUser->userID";

header("location: profileemployee.php");



//, resumefile='$_POST[resumefile]', 
?>