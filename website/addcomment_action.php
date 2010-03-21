<?php

require_once("std.php");
require_once("classes/Employee.php");

$Auth->Restrict("Employer");

$user = $Auth->User();

$employeeID = $_POST['userID'];
$message = $_POST['comment'];

    $createResponse = $DB->Query("INSERT INTO comments(employerID, employeeID, message, postedTime) VALUES(%s, %s, '%s', NOW())", array($user->userID, $employeeID, $message));

    header("Location: viewemployee.php?id=" . $employeeID);
