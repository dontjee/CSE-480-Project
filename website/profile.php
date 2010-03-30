<?php
error_reporting(E_ALL);
require_once("std.php");
if ($CurrentUser->type==User::$EMPLOYEE){
	header("location: profileemp.php");
}
else if ($CurrentUser->type==User::$EMPLOYER){
	header("location: profileemployer.php");
}
//else if ($CurrentUser->type ==User::$ADMIN){
//	
//}
else{
	header("location: index.php");
}
?>