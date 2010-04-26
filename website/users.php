<?php

require_once("std.php");

$Auth->Restrict(User::$ADMIN);

$Template->CSS("users");
$Template->Title("Users");
$Template->Header();

$employers = $DB->Query("SELECT * FROM users RIGHT JOIN employers ON employers.users_userID = users.userID");
ShowUsers($employers, "Employers", "viewemployee.php?id=");

$employees = $DB->Query("SELECT * FROM users RIGHT JOIN employees ON employees.users_userID = users.userID");
ShowUsers($employees, "Prospective Employees", "viewemployee.php?id=");


$Template->Footer();



//Show the users in a table with the given header
function ShowUsers($users, $title, $url){
	echo "<div class='users'>";
	echo "<div class='title'>$title</div>";
	foreach($users as $user){
		echo "<div class='row'><a href='{$url}{$user['userID']}'>{$user['loginID']}</a></div>";
	}
	echo "</div>";
}