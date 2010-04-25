<?php

class EmployeeRepository{
	public static function GetEmployees($searchArray=array()){
		global $DB;
		$tempEmployeeArray = array();
	
		// we use left joins here so that an employee who did not specify keywords/skills/categories is still found
		$query="SELECT DISTINCT users_userID, fname, mname, lname, dob, email, education, resumefile 
				FROM employees AS e
				LEFT JOIN employeecategory AS ec ON e.users_userID = ec.employeeID 
				LEFT JOIN employeekeywords AS ek ON e.users_userID = ek.employeeID 
				LEFT JOIN employeeskills AS es ON e.users_userID = es.employeeID";
		
				
		
		if($searchArray != array()){
			$query.=" WHERE ";
		}		

		if (isset($searchArray['education']) && $searchArray['education']!=""){
			$query.="e.education LIKE '%%%s%%' OR ";
			$args[]=$searchArray['education'];
		}
		if (isset($searchArray['empkeywords']) && $searchArray['empkeywords']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empkeywords']));
			foreach($fields as $field){
				if ($field=="") continue;
				
				$query.="ek.keyword LIKE '%%%s%%' OR ";
				$args[]=$field;				
			}		
		}	
		if (isset($searchArray['empskills']) && $searchArray['empskills']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empskills']));
			foreach($fields as $field){
				if ($field=="") continue;
				
				$query.="es.name LIKE '%%%s%%' OR ";
				$args[]=$field;				
			}		
		}
		if (isset($searchArray['empcategory']) && $searchArray['empcategory']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empcategory']));
			foreach($fields as $field){
				if ($field=="") continue;
				
				$query.="ec.name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}			
		}
		
		if ($searchArray!=array()){
			$query=substr($query,0,-3);
		}
	
		$employeeResult = $DB->Query($query, $args);
		
		

		if($employeeResult)
		{
		    foreach( $employeeResult as &$employee )
		    {
			$employee = new Employee($employee['users_userID'], $employee['fname'], $employee['mname'], $employee['lname'], $employee['dob'], $employee['email'], $employee['education'], $employee['resumefile']);
			array_push($tempEmployeeArray, $employee);
		    }
		}
		return $tempEmployeeArray;
	}	
	
	// get ranked employees
	public static function GetEmployeesForJob($jobID){
	
		if(!is_numeric($jobID)){
			echo "Invalid Request<br/>";
			return;
		}
		global $DB;
		
			
		$ranking=array();
		$job = new Job($jobID);		
		$jobKeywords = $DB->Query("SELECT name FROM jobkeywords WHERE jobID=%s", array($jobID));
		$jobCategories = $DB->Query("SELECT name FROM jobkeywords WHERE jobID=%s", array($jobID));
		$jobSkills = $DB->Query("SELECT name FROM jobkeywords WHERE jobID=%s", array($jobID));
		

		// match education
		// note that educational level must match, not exceed
		if($job->education != ""){
			$userids=$DB->Query("SELECT DISTINCT users_userID FROM employees WHERE education LIKE '%s'", array($job->education));
			foreach($userids as $userid){
				$ranking[$userid['users_userID']]+=1;
			}
		}
		

		// match skills
		if($jobSkills!=array()){
			$query="SELECT DISTINCT employeeID FROM employeeskills WHERE ";
			$args=array();
			foreach ($jobSkills as $field){
			
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field['name'];
			}
			$query=substr($query,0,-3);
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
			}
		}
		

		// match categories
		if ($jobCategories!=array()){
			$query="SELECT DISTINCT employeeID FROM employeecategory WHERE ";
			$args=array();
			foreach ($jobCategory as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field['name'];
			}
			$query=substr($query,0,-3);
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
			}
		}
		

		// match job title with keywords
		if($job->title != ""){
			$userids=$DB->Query("SELECT DISTINCT employeeID FROM employeekeywords WHERE keyword LIKE '%s'", array($job->title));
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
			}
		}
	
	
		// match job description/type with keywords
		if($job->jobType!="" || $job->description!=""){
			$query="SELECT DISTINCT employeeID FROM employeekeywords WHERE ";
			$args=array();
			
			if($job->jobType!= ""){
				$query.="keyword LIKE '%%%s%%' OR ";
				$args[]=$job->jobType;
			}
			if($job->description!=""){
				$fields=explode(' ',str_replace(',',' ',$job->description));
				foreach($fields as $field){
					if ($field=="") continue;
					
					$query.="keyword LIKE '%%%s%%' OR ";
					$args[]=$field;
				}
			}
			
			$query=substr($query,0,-3);
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=0.5;
			}
		}			


		// match keywords with keywords
		if($jobKeywords!=array()){
			$query="SELECT DISTINCT employeeID FROM employeekeywords WHERE ";
			$args=array();		
			
			foreach($jobKeywords as $field){
				$query.="keyword LIKE '%%%s%%' OR ";
				$args[]=$field['name'];				
			}	
			$query=substr($query,0,-3);
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=0.5;
			}
		}
		
		// sort rankings
		if(!asort(&$ranking)){
			echo "Sort Error<br/>";
			return;
		}
		$ranking = array_reverse($ranking, true);
		
		// get the employees
		$tempEmployeeArray=array();
		foreach($ranking as $userid=>$rank){
			$employee = new Employee($userid);
			$employee->rank = $rank;
			$tempEmployeeArray[]=$employee;
		}		
		
		return $tempEmployeeArray;
	}
	
	
	public static function GetRankedEmployees($searchArray=array()){
		global $DB;
		$ranking = array();
	
//		print_rr($searchArray);
		
		// match education
		// note that educational level must match, not exceed
		if (isset($searchArray['education']) && $searchArray['education']!=""){
			$userids=$DB->Query("SELECT DISTINCT users_userID FROM employees WHERE education LIKE '%s'", array($searchArray['education']));
			foreach($userids as $userid){
				$ranking[$userid['users_userID']]+=1;
			}
		}
		
		
		// match skills
		if (isset($searchArray['empskills']) && $searchArray['empskills']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empskills']));
			$query="SELECT DISTINCT employeeID FROM employeeskills WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
			}
		}
		
		
		// match categories
		if (isset($searchArray['empcategory']) && $searchArray['empcategory']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empcategory']));
			$query="SELECT DISTINCT employeeID FROM employeecategory WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="name LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
			}
		}
		

		// match keywords
		if (isset($searchArray['empkeywords']) && $searchArray['empkeywords']!=""){
			$fields=explode(' ',str_replace(',',' ',$searchArray['empkeywords']));
			$query="SELECT DISTINCT employeeID FROM employeekeywords WHERE ";
			$args=array();
			foreach ($fields as $field){
				$query.="keyword LIKE '%%%s%%' OR ";
				$args[]=$field;
			}
			$query=substr($query,0,-3);
			
			$userids=$DB->Query($query, $args);
			foreach($userids as $userid){
				$ranking[$userid['employeeID']]+=1;
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
		$tempEmployeeArray=array();
		foreach($ranking as $userid=>$rank){
			$employee = new Employee($userid);
			$employee->rank = $rank;
			$tempEmployeeArray[]=$employee;
		}		
		
		return $tempEmployeeArray;
	
	}	
}
?>
