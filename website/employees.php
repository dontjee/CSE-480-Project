<?php

require_once("std.php");

$Auth->Restrict("Employer");

$Template->Title("Employees");
$Template->CSS("form");
$Template->CSS("buttons");
$Template->JS("employees");
$Template->Header();


// education level, skill set, job categories, and keywords
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
<br/>
<br/>

<div id="employees"></div>
<?php
$Template->Footer();
?>
