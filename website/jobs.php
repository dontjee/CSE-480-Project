<?php

require_once("std.php");
require_once("classes/Job.php");
require_once("classes/JobRepository.php");

if(!$Auth->LoggedIn())
{
	header("location:index.php");
}

$Template->Title("Jobs");
$Template->Header();

$sortByPosted = false;
if( $_GET["sortByPosted"] == "1" )
{
    $sortByPosted = true;
}
$jobs = JobRepository::GetJobsForListing($Auth->User()->userID, $sortByPosted);
?>
<p>Sort By: 
    <a href="jobs.php">Title</a> | <a href="jobs.php?sortByPosted=1">Date Posted</a>
</p>
<table>
    <tr>
	    <th style="width:175px;"><b>Employer Name</th>
	    <th style="width:150px;"><b>Job Title</th>
	    <th style="width:150px;"><b>Location</th>
	    <th><b>Edit Link</th>
    </tr>
<?php
foreach( $jobs as &$job )
{?>
    <tr>
	<td>
	    <?php echo $job->employer->name;?>
	</td>
	<td>
	    <a href="jobposting.php?id=<?php echo $job->jobID;?>" style="color:#CCC; text-decoration:underline;"><?php echo $job->title;?></a>
	</td>
	<td>
	    <?php echo $job->location;?>
	</td>
	<td>
	    <a href="editjobpost.php?id=<?php echo $job->jobID;?>">Edit Job</a>
	</td>
    </tr>
<?php } ?>
</table>

<?php
$Template->Footer();
?>
