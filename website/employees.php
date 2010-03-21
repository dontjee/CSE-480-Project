<?php

require_once("std.php");
require_once("classes/Employee.php");
require_once("classes/EmployeeRepository.php");

$Auth->Restrict("Employer");

$Template->Title("Employees");
$Template->Header();

$employees = EmployeeRepository::GetEmployees();
?>
<table>
    <tr>
	    <th style="width:175px;"><b>Employee Name</th>
	    <th style="width:150px;"><b>Education</th>
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
    </tr>
<?php } ?>
</table>

<?php
$Template->Footer();
?>
