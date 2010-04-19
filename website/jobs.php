<?php
require_once("std.php");

if(!$Auth->LoggedIn())
{
	header("location:index.php");
}

$Template->Title("Jobs");
$Template->CSS("form");
$Template->CSS("buttons");
$Template->JS("jobs");
$Template->Header();
if ($Auth->User()->type==User::$EMPLOYER){
	include("jobs_action.php");
}else{
?>

<label class="label" for="title">Job Title</label>
<input class="field input" name="title" id="title" type="text" /><br/>

<label class="label" for="jobcategory">Job Category</label>
<input class="field input" name="jobcategory" id="jobcategory" type="text" /><br/>

<label class="label" for="jobType">Job Type</label>
<input class="field input" name="jobType" id="jobType" type="text" /><br/>

<label class="label" for="education">Education Level</label>
<input class="field input" name="education" id="education" type="text" /><br/>

<label class="label" for="jobskills">Skills</label>
<input class="field input" name="jobskills" id="jobskills" type="text" /><br/>

<br/>
<span id="search_button" class="action_button">Search</span>
<br/>
<br/>

<div id="jobs"></div>

<?php
}
$Template->Footer();
?>
