<?php

require_once("std.php");
require_once("classes/Job.php");

//Boot out anyone who's not logged in
$Auth->UsersOnly();

$user = $Auth->User();
$job = new Job($_GET['id']);

$Template->Title(" Job");
$Template->CSS("buttons");
$Template->CSS("jobposting");
$Template->JS("jobposting");
$Template->Header();

$categories = $job->Categories();
$categoryString = implode(", ",array_map('ucfirst',$categories));

$keywords = $job->Keywords();
$keywordString = implode(", ",array_map('ucfirst',$keywords));

$skills = $job->Skills();
$skillString = implode(", ",array_map('ucfirst',$skills));
?>

	<!-- Loader for ajax stuff -->
	<span id="loading" class="hidden"><img src="images/loading.gif"/></span>
	
	<!-- Alert after ajax stuff happens -->
	<span id="alert" class="hidden">Alert will be shown here!</span>

	<?php if( $user->type == User::$EMPLOYEE ){ ?>
		<!-- Only Prospective Employees should see these buttons -->
		<div id="buttons">
			<span class="action_button" id="bookmark">Bookmark Job</span>
			<span class="action_button" id="interested">Express Interest</span>
		</div>
	<?php }else{ ?>
		<!-- Only admin should see this button -->
		<div id="buttons">
			<span class="action_button" id="delete_job">Delete Job Posting</span>
		</div>
	<?php } ?>

	<!-- Everyone sees this -->
	<span class="row">
		<label>Employer Name: </label>
		<span><?php echo $job->employer->name;?></span>
	</span>

	<span class="row">
		<label>Job Title: </label>
		<span><?php echo $job->title;?></span>
	</span>

	<span class="row">
		<label>Time Posted: </label>
		<span><?php echo PrettyDate($job->posted, true);?></span>
	</span>
	
	<span class="row">
		<label>Closing Date: </label>
		<span><?php echo $job->closingDate;?></span>
	</span>

	<span class="row">
		<label>Location: </label>
		<span><?php echo $job->location;?></span>
	</span>

	<span class="row">
		<label>Job Type: </label>
		<span><?php echo $job->jobType;?></span>
	</span>

	<span class="row">
		<label>Description: </label>
		<span><?php echo $job->description;?></span>
	</span>

	<span class="row">
		<label>Education Level Required: </label>
		<span><?php echo $job->education;?></span>
	</span>

	<span class="row">
		<label>Category: </label>
		<span>
			<?php echo $categoryString; ?>
		</span>
	</span>

	<span class="row">
		<label>Keyword: </label>
		<span>
			<?php echo $keywordString; ?>
		</span>
	</span>
	
		<span class="row">
		<label>Skills: </label>
		<span>
			<?php echo $skillString; ?>
		</span>
	</span>
	
	<br style="clear:both"/>
	<span id="buttons">
		<span class="action_button" id="search_employees">Find Prospective Employees</span>
		<input type="hidden" id="jobID" value="<?php echo $job->jobID;?>"/>
	</span>
<?php
$Template->Footer();
?>
