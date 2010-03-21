<?php

class EmployeeRepository{
	public static function GetEmployees(){
		global $DB;
		$tempEmployeeArray = array();
	
		$employeeResult = $DB->Query("SELECT userID, loginID, fname, mname, lname, dob, email, education, resumefile FROM users AS u INNER JOIN employees AS e ON u.userID = e.users_userID", array());

		if($employeeResult)
		{
		    foreach( $employeeResult as &$employee )
		    {
			$employee = new Employee($employee['userID'], $employee['fname'], $employee['mname'], $employee['lname'], $employee['dob'], $employee['email'], $employee['education'], $employee['resumefile']);
			array_push($tempEmployeeArray, $employee);
		    }
		}
		return $tempEmployeeArray;
	}
}
?>
