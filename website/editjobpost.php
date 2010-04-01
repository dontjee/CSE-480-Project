<?php

require_once("std.php");
require_once("classes/Job.php");

$Auth->Restrict("Employer");

$Template->CSS("job");
$Template->CSS("form");
$Template->Header();

$job = new Job($_GET['id']);
// if the job was not found or the owner of the job is not this user
if( $job->jobID == -1 || $job->employerID != $Auth->User()->userID )
{
	header("Location: index.php");
}

//get category text
$categoryText = "";
$categories = $job->Categories();
foreach( $categories as &$category )
{
	$categoryText = $categoryText . $category . ", ";
}
$categoryText = trim($categoryText, ", ");

//get keyword text
$keywordText = "";
$keywords = $job->Keywords();
foreach( $keywords as &$keyword )
{
	$keywordText = $keywordText . $keyword . ", ";
}
$keywordText = trim($keywordText, ", ");
?>


<form action="editjobpost_action.php" method="post" id="signup_form">
	<h2>Edit Job Announcement</h2>
	<span class="row">
		<label class="label" for="title">Title</label>
		<input name="title" class="field input" type="text" value="<?php echo $job->title; ?>"/>
	</span>
	<br/>
	<span class="row">
		<label class="label" for="description">Description</label>
		<textarea name="description" rows="2" cols="20"><?php echo $job->description; ?></textarea>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="closingDate">Job Close Date</label>
		<input name="closingDate" class="field input" type="text" value="<?php echo $job->closingDate; ?>"/>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="location">Location</label>
		<input name="location" class="field input" type="text" value="<?php echo $job->location; ?>"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="jobType">Job Type</label>
		<select name="jobType" class="field">
			<option value="Full Time" <?php if($job->jobType == "Full Time") echo "selected='selected'"; ?>>Full Time</option>
			<option value="Temporary" <?php if($job->jobType == "Temporary") echo "selected='selected'"; ?>>Temporary</option>
			<option value="Contract" <?php if($job->jobType == "Contract") echo "selected='selected'"; ?>>Contract</option>
		</select>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="education">Education Requirement</label>
		<select name="education" class="field">
			<option value="High School" <?php if($job->education == "High School") echo "selected='selected'"; ?>>High School</option>
			<option value="College" <?php if($job->education == "College") echo "selected='selected'"; ?>>College</option>
			<option value="Postgraduate" <?php if($job->education == "Postgraduate") echo "selected='selected'"; ?>>Postgraduate</option>
		</select>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="category">Category</label>
		<input name="category" class="field input" type="text" value="<?php echo $categoryText; ?>"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="keyword">Job Keywords (separated by commas)</label>
		<input name="keyword" class="field input" type="text" value="<?php echo $keywordText; ?>"/>
	</span>
	<br/>
	<input type="hidden" value="<?php echo $job->jobID; ?>" name="id" />
	<input id="submit" type="submit" value="Update" />
	
</form>


<?php
$Template->Footer();
