<?php

require_once("std.php");
require_once("classes/Employee.php");
require_once("classes/Comment.php");

$Auth->Restrict("Employer");

$user = $Auth->User();

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


<?php
	$comments = $employee->GetComments($user->userID);
?>
<table>
    <tr>
	    <th style="width:175px;"><b>Comment</th>
	    <th style="width:150px;"><b>Posted Time </th>
    </tr>
<?php foreach($comments as &$comment){ ?>
	<tr>
	    <td>
	    	<?php echo $comment->message; ?>
	    </td>
	    <td>
		<?php echo $comment->postedTime;?>
	    </td>
	</tr>
<?php } ?>
    </table>

	<p><a href="addcomment.php?uid=<?php echo $employee->userID ?>">Add Comment</a></p>
<?php
$Template->Footer();
?>
