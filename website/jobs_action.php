<?php
require_once("std.php");
if(!$Auth->LoggedIn())	$Auth->SendHome();

require_once("classes/Job.php");
require_once("classes/JobRepository.php");

$sortByPosted = false;
if( isset($_GET["sortByPosted"]) && $_GET["sortByPosted"] == "1" ){
    $sortByPosted = true;
}

if ($Auth->User()->type==User::$EMPLOYER){
	$_POST['sort']="title";
	$_POST['employerID']=$Auth->User()->userID;
}
if (isset($_POST['ranked']) && sizeof($_POST) > 1){
	$jobs = JobRepository::SearchRankedJobs($_POST);
}else{
	if (isset($_POST['ranked'])) unset($_POST['ranked']);
	$jobs = JobRepository::SearchJobs($_POST);
}


?>



<table>
    <tr>
	    <th style="width:175px;"><b>Employer Name</th>
	    <th style="width:150px;"><b>Job Title</th>
	    <th style="width:150px;"><b>Location</th>
	    <th style="width:150px;"><b>Match Rank (0-5)</th>	
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
	<td>
	    <?php echo $job->rank;?>
	</td>
	<?php if ($Auth->User()->type==User::$EMPLOYER){// user == employer and posted the job ?>
	<td>
	    <a href="editjobpost.php?id=<?php echo $job->jobID;?>">Edit Job</a>
	</td>
	<?php } ?>
    </tr>
<?php } ?>
</table>

