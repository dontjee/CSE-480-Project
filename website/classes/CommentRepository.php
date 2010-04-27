<?php

class CommentRepository{

	public static function GetComments($userID){
		global $DB;
		$tempCommentsArray = array();
	
		$commentsResult = $DB->Query("SELECT c.employeeID as employeeID, emp.fname AS fname, emp.lname AS lname, c.message AS message, c.postedTime AS postedTime FROM comments AS c INNER JOIN employees AS emp ON emp.users_userID = c.employeeID WHERE c.employerID = %s", array($userID));

		if($commentsResult)
		{
		    foreach( $commentsResult as &$comment )
		    {
				$comment = new Comment($comment['fname']." ".$comment['lname'], $comment['message'], $comment['postedTime'], $comment['employeeID']);
				array_push($tempCommentsArray, $comment);
		    }
		}
		return $tempCommentsArray;
	}
}
