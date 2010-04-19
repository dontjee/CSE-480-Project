<?php
error_reporting(E_ALL);
require_once("std.php");
require_once("classes/Job.php");
require_once("classes/JobRepository.php");

$sortByPosted = false;
if( isset($_GET["sortByPosted"]) && $_GET["sortByPosted"] == "1" ){
    $sortByPosted = true;
}

if ($Auth->User()->type==User::$EMPLOYER){
	$jobs = JobRepository::GetJobsForListing($Auth->User()->userID, $sortByPosted);
}else{
	$jobs = JobRepository::SearchJobs($_POST, $sortByPosted);
}



?>



<p>Sort By: 
    <a href="jobs.php">Title</a> | <a href="jobs.php?sortByPosted=1">Date Posted</a>
</p>
<table>
    <tr>
	    <th style="width:175px;"><b>Employer Name</th>
	    <th style="width:150px;"><b>Job Title</th>
	    <th style="width:150px;"><b>Location</th>
		<?php if ($Auth->User()->type==User::$EMPLOYER){// user == employer and posted the job ?>
	    <th><b>Edit Link</th>
		<?php } ?>
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
	<?php if ($Auth->User()->type==User::$EMPLOYER){// user == employer and posted the job ?>
	<td>
	    <a href="editjobpost.php?id=<?php echo $job->jobID;?>">Edit Job</a>
	</td>
	<?php } ?>
    </tr>
<?php } ?>
</table>

