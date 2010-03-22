<?php

class BookmarkRepository{

	public static function GetBookmarks($userID){
		global $DB;
		$tempBookmarksArray = array();
	
		$bookmarksResult = $DB->Query("SELECT b.employeeID, b.jobID, b.jobannouncement_employerID, j.title, ers.name FROM bookmarks AS b INNER JOIN employees AS ees ON b.employeeID = ees.users_userID INNER JOIN employers AS ers ON b.jobannouncement_employerID = ers.users_userID INNER JOIN jobannouncement AS j ON j.jobID = b.jobID WHERE b.employeeID = %s", array($userID));

		if($bookmarksResult)
		{
		    foreach( $bookmarksResult as &$bookmark )
		    {
			$bookmark = new Bookmark($bookmark['employeeID'], $bookmark['jobID'], $bookmark['jobannouncement_employerID'], $bookmark['title'], $bookmark['name']);
			array_push($tempBookmarksArray, $bookmark);
		    }
		}
		return $tempBookmarksArray;
	}
}
