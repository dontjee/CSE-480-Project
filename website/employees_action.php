<?php
require_once("std.php");
$Auth->Restrict("Employer");

require_once("classes/Job.php");
require_once("classes/Employee.php");
require_once("classes/EmployeeRepository.php");
if (isset($_GET['jobID'])) {
	$employees = EmployeeRepository::GetEmployeesForJob($_GET['jobID']);
}else if (isset($_POST['ranked']) && sizeof($_POST) > 1){
	$employees = EmployeeRepository::GetRankedEmployees($_POST);
}else{
	if (isset($_POST['ranked'])) unset($_POST['ranked']);
	$employees = EmployeeRepository::GetEmployees($_POST);
}

?>


<table>
    <tr>
	    <th style="width:175px;"><b>Employee Name</th>
	    <th style="width:150px;"><b>Education</th>
		<th style="width:150px;"><b>Match Rank (0-5)</th>		
    </tr>
<?php
foreach( $employees as &$employee )
{?>
    <tr>
	<td>
	    <a href="viewemployee.php?id=<?php echo $employee->userID;?>" style="color:#CCC; text-decoration:underline;"><?php echo $employee->fname;?>&nbsp;<?php echo $employee->lname;?></a>
	</td>
	<td>
	    <?php echo $employee->education;?>
	</td>
	<td>
	    <?php echo $employee->rank;?>
	</td>
    </tr>
<?php } ?>
</table>