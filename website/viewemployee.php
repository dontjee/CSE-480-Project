<?php

require_once("std.php");
require_once("classes/Employee.php");

$Auth->Restrict("Employer");

$employee = new Employee($_GET['id']);

$Template->Title("Employer User View");
$Template->Header();

?>
	<span class="row">
		<b><label class="label">Employee User Name: </label></b>
		<?php echo $employee->loginID;?>

	</span>
	<br/>
	<span class="row">
		<b><label class="label">Employee Name: </label></b>
		 <?php echo $employee->fname;?>&nbsp;<?php echo $employee->mname;?>&nbsp;<?php echo $employee->lname;?>
	</span>
	<br/>
	<span class="row">
		<b><label class="label">Employee Date Of Birth: </label></b>
		<?php echo $employee->dob;?>

	</span>
	<br/>
	<span class="row">
		<b><label class="label">Email: </label></b>
		<?php echo $employee->email;?>

	</span>
	<br/>
	<span class="row">
		<b><label class="label">Education Level: </label></b>
		<?php echo $employee->education;?>

	</span>
	<br/>
	<span class="row">
		<b><label class="label">Resume: </label></b>
		<?php echo $employee->resume;?>

	</span>
	<br/>

	<p><a href="addcomment.php?uid=<?php echo $employee->userID ?>">Add Comment</a></p>
<?php
$Template->Footer();
?>
