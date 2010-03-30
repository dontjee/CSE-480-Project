<?php
//Standard PHP file which should be included on every page in the site

require_once("classes/MySQL.php");
require_once("classes/User.php");

session_start();
error_reporting(E_STRICT);

require_once("classes/Auth.php");
$Auth = new Auth();
$CurrentUser = $Auth->User();

require_once("classes/Template.php");
$Template = new Template();

function print_rr($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}