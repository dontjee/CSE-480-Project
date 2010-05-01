<?php
/*
Deletes a job from the database.
Note: Only administrators have the ability to delete jobs.
*/

require_once("std.php");

$jobID = $_GET['jobID'];



$DB->Query("DELETE FROM jobannouncement
			WHERE jobID = %s",
			Array($jobID));