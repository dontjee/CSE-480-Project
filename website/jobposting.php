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
$categoryString = "";
foreach( $categories as &$category )
{
   $categoryString = $categoryString . ', ' . $category;
}
$categoryString = trim($categoryString, ", ");

$keywords = $job->Keywords();
$keywordString = "";
foreach( $keywords as $keyword )
{
   $keywordString = $keywordString . ', ' . $keyword;
}
$keywordString = trim($keywordString, ", ");
?>

	<!-- Loader for ajax stuff -->
	<span id="loading" class="hidden"><img src="images/loading.gif"/></span>
	
	<!-- Alert after ajax stuff happens -->
	<span id="alert" class="hidden">Alert will be shown here!</span>

	<!-- Only Users should see these buttons -->
	<?php if( $user->type == "Employee" ){ ?>
	<div id="buttons">
		<span class="action_button" id="bookmark">Bookmark Job</span>
		<span class="action_button" id="interested">Express Interest</span>
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
		
<?php
$Template->Footer();
?>
