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
				LEFT JOIN employeeskills AS es ON e.users_userID = es.employeeID
				";
		
				
		
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
				
				$query.="ek.name LIKE '%%%s%%' OR ";
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
}
?>
