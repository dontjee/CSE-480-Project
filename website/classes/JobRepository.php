<?php

class JobRepository{
	//public $jobs = array();

	public static function GetJobs($userIdMakingCall){
		global $DB;
		$tempJobsArray = array();
		
		$jobsResult = $DB->Query("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education, jc.name AS category, jk.name AS keyword FROM jobannouncement AS ja INNER JOIN jobcategory AS jc ON ja.jobID = jc.jobID INNER JOIN jobkeywords AS jk ON ja.jobID = jk.jobID INNER JOIN employers AS er ON er.users_userID = ja.employerID LEFT JOIN bookmarks AS b ON ja.jobID = b.jobID WHERE b.employeeID IS NULL OR b.employeeID != %s", array($userIdMakingCall));

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

	public static function GetJobsForListing($userIdMakingCall, $sortByPostedDate){
		global $DB;
		$tempJobsArray = array();
	
		if( $sortByPostedDate )
		{
		    $jobsResult = $DB->Query("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education FROM jobannouncement AS ja INNER JOIN employers AS er ON er.users_userID = ja.employerID LEFT JOIN bookmarks AS b ON ja.jobID = b.jobID WHERE b.employeeID IS NULL OR b.employeeID != %s ORDER BY posted", array($userIdMakingCall));
		}
		else
		{
		    $jobsResult = $DB->Query("SELECT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education FROM jobannouncement AS ja INNER JOIN employers AS er ON er.users_userID = ja.employerID LEFT JOIN bookmarks AS b ON ja.jobID = b.jobID WHERE b.employeeID IS NULL OR b.employeeID != %s ORDER BY title", array($userIdMakingCall));
		}

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
	
	public static function SearchJobs($searchArray=array(), $sortByPostedDate=false){
		global $DB;
		
		$query = "SELECT DISTINCT ja.jobID, er.name, ja.title, ja.posted, ja.closingDate, ja.location, ja.jobType, ja.description, ja.education 
				FROM jobannouncement AS ja 
				LEFT JOIN jobcategory AS jc ON ja.jobID = jc.jobID 
				LEFT JOIN jobkeywords AS jk ON ja.jobID = jk.jobID 
				LEFT JOIN employers AS er ON er.users_userID = ja.employerID 
				";
		
		$args = array();

		if ($searchArray!=array()){
			$query.="WHERE ";
		}
		
		if( isset($searchArray["title"]) && $searchArray['title']!=""){
			$query.="ja.title LIKE '%%%s%%' OR ";
			array_push($args,$searchArray['title']);
		}
		if (isset($searchArray['jobType']) && $searchArray['jobType']!=""){
			$query.="ja.jobType LIKE '%%%s%%' OR ";
			$args[]=$searchArray['jobType'];
		}
		if (isset($searchArray['education']) && $searchArray['education']!=""){
			$query.="ja.education LIKE '%%%s%%' OR ";
			$args[]=$searchArray['education'];
		}
		if (isset($searchArray['jobskills']) && $searchArray['jobskills']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobskills']));
			foreach($fields as $field){
				if ($field=="") continue;
				
				$query.="jc.name LIKE '%%%s%%' OR ";
				$args[]=$field;				
			}		
		}
		if (isset($searchArray['jobcategory']) && $searchArray['jobcategory']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobcategory']));
			foreach($fields as $field){
				if ($field=="") continue;
				
				$query.="jk.name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}			
		}
		
		if ($searchArray!=array()){
			$query=substr($query,0,-3);
		}
				
		$orderBy = "ORDER BY title ";
		if ($sortByPostedDate){
			$orderBy = "ORDER BY posted ";
		}
		
		$query.=$orderBy;
		
		$jobsResult = $DB->Query($query, $args);
		
		
		$tempJobsArray = array();
		if($jobsResult){
		    foreach( $jobsResult as &$job ){
				$job = new Job($job['jobID'], $job['name'], $job['title'], $job['posted'], $job['closingDate'], $job['location'], $job['jobType'], $job['description'], $job['education'], '', '');
				array_push($tempJobsArray, $job);
		    }
		}

		return $tempJobsArray;
	}
	
	
	
	public static function SearchRankedJobs($searchArray=array()){
		global $DB;
		$ranking = array();
	
//		print_rr($searchArray);
		
		
		// match job title
		if( isset($searchArray["title"]) && $searchArray['title']!=""){
			$jobids=$DB->Query("SELECT DISTINCT jobID FROM jobannouncement WHERE title LIKE '%%%s%%'", array($searchArray['title']));
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=1;
			}
		}
			
		
		// match education
		// note that educational level must match, not exceed
		if (isset($searchArray['education']) && $searchArray['education']!=""){
			$jobids=$DB->Query("SELECT DISTINCT jobID FROM jobannouncement WHERE education LIKE '%%%s%%'", array($searchArray['education']));
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=1;
			}
		}
		
		
		// match skills
		if (isset($searchArray['jobskills']) && $searchArray['jobskills']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobskills']));
			$query="SELECT DISTINCT jobID FROM jobskills WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$jobids=$DB->Query($query, $args);
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=1;
			}
		}
		
		
		// match categories
		if (isset($searchArray['jobcategory']) && $searchArray['jobcategory']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobcategory']));
			$query="SELECT DISTINCT jobID FROM jobcategory WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$jobids=$DB->Query($query, $args);
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=1;
			}
		}
		

	
		
		// match job type and description
		if (isset($searchArray['jobType']) && $searchArray['jobType']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobType']));
			$query="SELECT DISTINCT jobID FROM jobannouncement WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="jobType LIKE '%%%s%%' OR description LIKE '%%%s%%' OR ";
				$args[]=$field;
				$args[]=$field;	
			}
			$query=substr($query,0,-3);
			
			$jobids=$DB->Query($query, $args);
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=0.5;
			}
		}
		
		
		// match keywords
		if (isset($searchArray['jobkeywords']) && $searchArray['jobkeywords']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['jobkeywords']));
			$query="SELECT DISTINCT jobID FROM jobkeywords WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$jobids=$DB->Query($query, $args);
			foreach($jobids as $jobid){
				$ranking[$jobid['jobID']]+=0.5;
			}
		}
		

		
//		print_rr($ranking);
		// sort rankings
		if(!asort(&$ranking)){
			echo "Sort Error<br/>";
			return;
		}
		$ranking = array_reverse($ranking, true);
		
		// get the employees
		$tempJobArray=array();
		foreach($ranking as $jobid=>$rank){
			$job = new Job($jobid);
			$job->rank = $rank;
			$tempJobArray[]=$job;
		}		
		
		return $tempJobArray;
	
	}	
	
	
	
	
	
}
