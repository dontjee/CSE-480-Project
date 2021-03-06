<?php

require_once("std.php");
require_once("classes/Employee.php");
require_once("classes/Comment.php");

$Auth->UsersOnly();
$Auth->DontAllow(User::$EMPLOYEE);

$employee = new Employee($_GET['id']);

//$Template->Title("Employee Profile | " . $employee->FullName());
$Template->CSS("buttons");
$Template->CSS("form");
$Template->CSS("viewemployee");
$Template->JS("viewemployee");
$Template->Header();

	if($Auth->User()->type == User::$ADMIN){ ?>
		<!-- Only admin should see this button -->
		<div id="buttons">
			<a href="delete_user_action.php?userID=<?php echo $employee->userID; ?>">
				<span class="action_button" id="delete_user">Delete User</span>
			</a>
		</div>
	<?php } ?>
	
	<span class="employee_name"><?php echo $employee->FullName(); ?></span>
		
	<span class="row">
		<label class="label">User Name: </label>
		<span><?php echo $employee->fullName();?></span>
	</span>

	<span class="row">
		<label class="label">Date Of Birth: </label>
		<span><?php echo $employee->dob;?></span>
	</span>

	<span class="row">
		<label class="label">Email: </label>
		<span><?php echo $employee->email;?></span>
	</span>

	<span class="row">
		<label class="label">Education Level: </label>
		<span><?php echo $employee->education;?></span>
	</span>
	
	<span class="row">
		<label class="label">Skills: </label>
		<span><?php
			$results = $employee->Get('skills');
			$results = array_map('ucfirst',$results);
			echo implode(', ',$results); 
		?></span>
	</span>
	
	<span class="row">
		<label class="label">Keywords: </label>
		<span><?php
			$results = $employee->Get('keywords');
			$results = array_map('ucfirst',$results);
			echo implode(', ',$results); 
		?></span>
	</span>
	
	<span class="row">
		<label class="label">Categories: </label>
		<span><?php
			$results = $employee->Get('categories');
			$results = array_map('ucfirst',$results);
			echo implode(', ',$results); 
		?></span>
	</span>
	
	
	<span class="row">
		<label class="label">Resume: </label>
		<span><?php echo $employee->resume;?></span>
	</span>

	<!-- Allow employers to notify this employee if they are desired a certain job -->
	<div class="group">
		<span>Interested in this person for </span>
		<select id="notify_job" class="input">
			<option value="-1">Select a Job</option>
			<?php 
			$jobs = $Auth->User()->GetJobs();
			foreach($jobs as $job){
				echo "<option value='{$job->jobID}'>{$job->title}</option>";
			}
			?>
		</select>
		<span id="notify_employee" class="action_button">Notify</span>
	</div>
	

	<!-- Allow Employers to comment on this person internally -->
	<?php
	echo "before";
		$comments = $employee->GetComments($Auth->User()->userID);
		echo "after";
	?>
	<div class="group">
		<table id="comments">
			<tr>
				<th style="width:175px;">Comment</th>
				<th style="width:150px;">Posted Time </th>
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
		<a href="addcomment.php?uid=<?php echo $employee->userID ?>">Add Comment</a>
	</div>
	
<?php
$Template->Footer();
?>
