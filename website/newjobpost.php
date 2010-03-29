<?php

require_once("std.php");

$Auth->Restrict("Employer");

$Template->CSS("job");
$Template->CSS("form");
$Template->Header();


?>


<form action="newjobpost_action.php" method="post" id="signup_form">
	<h2>New Job Announcement</h2>
	<span class="row">
		<label class="label" for="title">Title</label>
		<input name="title" class="field input" type="text"/>
	</span>
	<br/>
	<span class="row">
		<label class="label" for="description">Description</label>
		<textarea name="description" rows="2" cols="20"></textarea>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="closingDate">Job Close Date</label>
		<input name="closingDate" class="field input" type="text"/>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="location">Location</label>
		<input name="location" class="field input" type="text"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="jobType">Job Type</label>
		<select name="jobType" class="field">
			<option value="Full Time">Full Time</option>
			<option value="Temporary">Temporary</option>
			<option value="Contract">Contract</option>
		</select>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="education">Education Requirement</label>
		<select name="education" class="field">
			<option value="High School">High School</option>
			<option value="College">College</option>
			<option value="Postgraduate">Postgraduate</option>
		</select>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="category">Category</label>
		<input name="category" class="field input" type="text"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="keyword">Job Keyword</label>
		<input name="keyword" class="field input" type="text"/>
	</span>
	<br/>
	<input id="submit" type="submit" value="Create" />
	
</form>


<?php
$Template->Footer();
