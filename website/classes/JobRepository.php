<?php

class JobRepository{
	//public $jobs = array();

	public static function GetJobs(){
		global $DB;
		$tempJobsArray = array();
	
		$jobsResult = $DB->Query("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education, jc.name AS category, jk.name AS keyword FROM jobannouncement AS ja INNER JOIN jobcategory AS jc ON ja.jobID = jc.jobID INNER JOIN jobkeywords AS jk ON ja.jobID = jk.jobID INNER JOIN employers AS er ON er.users_userID = ja.employerID", array());

		if($jobsResult)
		{
		    foreach( $jobsResult as &$job )
		    {
			$job = new Job($job['jobID'], $job['name'], $job['title'], $job['posted'], $job['closingDate'], $job['location'], $job['jobType'], $job['description'], $job['education'], $job['category'], $job['keyword']);
			array_push($tempJobsArray, $job);
		    }
		}
		return $tempJobsArray;
	}

	public static function GetJobsForListing(){
		global $DB;
		$tempJobsArray = array();
	
		$jobsResult = $DB->Query("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education FROM jobannouncement AS ja INNER JOIN employers AS er ON er.users_userID = ja.employerID", array());

		if($jobsResult)
		{
		    foreach( $jobsResult as &$job )
		    {
			$job = new Job($job['jobID'], $job['name'], $job['title'], $job['posted'], $job['closingDate'], $job['location'], $job['jobType'], $job['description'], $job['education'], '', '');
			array_push($tempJobsArray, $job);
		    }
		}
		return $tempJobsArray;
	}
}
