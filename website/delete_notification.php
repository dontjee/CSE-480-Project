<?php
/*
Deletes a notification given the key as parameters in the url string.
Note: Only the person who the notification was sent to can delete it.
*/


require_once("std.php");

$jobID = $_GET['jobID'];
$toID = $_GET['toID'];
$fromID = $_GET['fromID'];

echo $toID . "<br>";
echo $Auth->User()->userID;

$Auth->Only($toID);

$DB->Query("DELETE FROM notification
			WHERE jobID = %s AND toID = %s AND fromID = %s",
			Array($jobID, $toID, $fromID));