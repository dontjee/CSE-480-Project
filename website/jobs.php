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

$jobs = JobRepository::GetJobs();
?>
<table>
    <tr>
	    <th style="width:175px;"><b>Employer Name</th>
	    <th style="width:150px;"><b>Job Title</th>
	    <th><b>Location</th>
    </tr>
<?php
foreach( $jobs as &$job )
{?>
    <tr>
	<td>
	    <?php echo $job->name;?>
	</td>
	<td>
	    <a href="jobposting.php?id=<?php echo $job->jobID;?>" style="color:#CCC; text-decoration:underline;"><?php echo $job->title;?></a>
	</td>
	<td>
	    <?php echo $job->location;?>
	</td>
    </tr>
<?php } ?>
</table>

<?php
$Template->Footer();
?>
