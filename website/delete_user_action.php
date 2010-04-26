<?php
/*
Deletes a user from the database.
Note: Only administrators have the ability to delete users.
*/

require_once("std.php");

$Auth->Restrict(User::$ADMIN);

$userID = $_GET['userID'];

$DB->Query("DELETE FROM users
			WHERE userID = %s",
			Array($userID));
			
header('Location: users.php');