<?php

require_once("std.php");

$Template->CSS("stats");
$Template->Title("Website Statistics");
$Template->Header();

$numEmployees = $DB->Query("SELECT COUNT(*) AS num FROM employees");
$numEmployees = $numEmployees[0]["num"];

$numEmployers = $DB->Query("SELECT COUNT(*) AS num FROM employers");
$numEmployers = $numEmployers[0]["num"];

$totalJobs = $DB->Query("SELECT COUNT(*) AS num FROM jobannouncement");
$totalJobs = $totalJobs[0]["num"];

$recentJobs = $DB->Query("SELECT COUNT(*) AS num FROM jobannouncement WHERE posted > NOW() - INTERVAL 3 DAY");
$recentJobs = $recentJobs[0]["num"];

$popularJobs = $DB->Query("	SELECT job.jobID, job.title, COUNT(*) AS num FROM jobannouncement AS job
							INNER JOIN notification AS notif ON job.jobID = notif.jobID AND job.employerID = notif.toID
							GROUP BY (job.jobID)
							ORDER BY num DESC
							LIMIT 3");
?>

<div class="panel">
	<span id="title">Users</span>
	<div id="row">
		<span id="label">Employers:</span>
		<span id="value"><?php echo $numEmployers; ?></span>
	</div>
	<div id="row">
		<span id="label">Prospective Employees:</span>
		<span id="value"><?php echo $numEmployees; ?></span>
	</div>
</div>

<div class="panel">
	<span id="title">Job Postings</span>
	<div id="row">
		<span id="label">Total:</span>
		<span id="value"><?php echo $totalJobs; ?></span>
	</div>
	<div id="row">
		<span id="label">Last 3 days:</span>
		<span id="value"><?php echo $recentJobs; ?></span>
	</div>
	
	<!-- most popular jobs -->
	<?php 
		for($i=0; $i<3; $i++){
			if($i >= count($popularJobs))
				break;
			?>
			<div id="row">
				<span id="label"><?php echo $i == 0 ? "Most Popular:" : "&nbsp"; ?></span>
				<span id="value">
					<?php 
						$job = $popularJobs[$i];
						echo "<a href='jobposting.php?id={$job['jobID']}'>";
						echo $job['title']; 
						echo "</a> ({$job['num']})";
					?>
				</span>
			</div>
			<?php 
		}
	?>

</div>

<?php
$Template->Footer();
