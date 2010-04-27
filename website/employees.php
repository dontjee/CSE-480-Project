<?php

require_once("std.php");

$Auth->Restrict("Employer");

$Template->Title("Employees");
$Template->CSS("form");
$Template->CSS("buttons");
$Template->JS("employees");
$Template->Header();


?>

<label class="label" for="empcategory">Seeking Category</label>
<input class="field input" name="empcategory" id="empcategory" type="text" /><br/>

<label class="label" for="empkeywords">Seeking Keywords</label>
<input class="field input" name="empkeywords" id="empkeywords" type="text" /><br/>

<label class="label" for="education">Education Level</label>
<input class="field input" name="education" id="education" type="text" /><br/>

<label class="label" for="empskills">Skills</label>
<input class="field input" name="empskills" id="empskills" type="text" /><br/>

<br/>
<span id="search_button" class="action_button">Search</span>
<span id="search_ranked_button" class="action_button">Search Ranked</span>
<br/>
<br/>

<div id="employees"><?php 
	if (isset($_GET['jobID']) && $_GET['jobID']!=""){
		include("employees_action.php");
	}?></div>
<?php
$Template->Footer();
?>
