<?php
require_once("std.php");

if(!$Auth->LoggedIn())	$Auth->SendHome();


$Template->Title("Jobs");
$Template->CSS("form");
$Template->CSS("buttons");
$Template->JS("jobs");
$Template->Header();
if ($Auth->User()->type==User::$EMPLOYER){
	include("jobs_action.php");
}else{
?>

<label class="label" for="title">Title</label>
<input class="field input" name="title" id="title" type="text" /><br/>

<label class="label" for="jobcategory">Category</label>
<input class="field input" name="jobcategory" id="jobcategory" type="text" /><br/>

<label class="label" for="jobType">Type/Description</label>
<input class="field input" name="jobType" id="jobType" type="text" /><br/>

<label class="label" for="jobkeywords">Keywords</label>
<input class="field input" name="jobkeywords" id="jobkeywords" type="text" /><br/>

<label class="label" for="education">Education Level</label>	
<select class="field select" name="education" >
	<?php 
	$education=array("","High School","College","PostGraduate");
	foreach($education as $option){
		echo "<option>$option</option>";
	}
	?>
</select><br/>

<label class="label" for="jobskills">Skills</label>
<input class="field input" name="jobskills" id="jobskills" type="text" /><br/>

<label class="label" for="sort">Sort By</label>	
<select class="field select" name="sort" >
	<option value="true">Title</option>
	<option value="false">Date Posted</option>
</select><br/>


<br/>
<span id="search_button" class="action_button">Search</span>
<span id="search_ranked_button" class="action_button">Search Ranked</span>
<br/>
<br/>

<div id="jobs"></div>

<?php
}
$Template->Footer();
?>
