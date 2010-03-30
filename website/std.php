<?php
//Standard PHP file which should be included on every page in the site

require_once("classes/MySQL.php");
require_once("classes/User.php");

session_start();

require_once("classes/Auth.php");
$Auth = new Auth();
$CurrentUser = $Auth->User();

require_once("classes/Template.php");
$Template = new Template();



//Returns a standard time/date format for consitency in the site
function PrettyDate($datetime, $includeTime = false){
	$timestamp = strtotime($datetime);
	if($includeTime)
		return date("h:ia \o\\n F jS, Y", $timestamp);
	return date("F jS, Y", $timestamp);
}