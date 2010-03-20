<?php

require_once("std.php");
require_once("classes/Job.php");

if(!$Auth->LoggedIn())
{
	header("location:index.php");
}

$job = new Job($_GET['id']);

$Template->Title(" Job");
$Template->Header();

?>
	<span class="row">
		<b><label class="label">Employer Name: </label></b>
		<?php echo $job->name;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Title: </label></b>
		<?php echo $job->title;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Time Posted: </label></b>
		<?php echo $job->posted;?>

	</span>
	<br/>
	
	<span class="row">
		<b><label class="label">Job Closing Date: </label></b>
		<?php echo $job->closingDate;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Location: </label></b>
		<?php echo $job->location;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Type: </label></b>
		<?php echo $job->jobType;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Description: </label></b>
		<?php echo $job->description;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Education Level Required: </label></b>
		<?php echo $job->education;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Category: </label></b>
		<?php echo $job->category;?>

	</span>
	<br/>

	<span class="row">
		<b><label class="label">Job Keyword: </label></b>
		<?php echo $job->keyword;?>

	</span>
	<br/>

<?php
$Template->Footer();
?>
