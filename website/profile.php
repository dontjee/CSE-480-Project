<?php

require_once("std.php");

$Template->CSS("profile");
$Template->Header();

if($CurrentUser->type==User::$EMPLOYEE){
?>
<form action="javascript: employeeValidate()">
	<span class="left">First Name</span><input name="fname" type="text" /><br/>
	<span class="left">Middle Name</span><input name="mname" type="text"/><br/>
	<span class="left">Last Name</span><input name="lname" type="text"/><br/>
	<span class="left">Date of Birth</span><input name="day" type="text" style="width:20px"/><input name="month" type="text" style="width:20px"/><input name="year" type="text" style="width:40px"/><br/>
	<span class="left">Email Address</span><input name="email" type="text"/><br/>
	<span class="left">Education</span>
	<select name="education" >
		<option>High School</option>
		<option>College</option>
		<option>Post Graduate</option>
	</select><br/>
	<span class="left">Resume</span><br/>
	<span class="left" style="vertical-align:top;">Skills</span><textarea name="skills"></textarea><br/>
	<span class="left" style="vertical-align:top;">Seeking</span>
	<select name="category" size="5" multiple="multiple">
		<option>Admin Support</option>
		<option>Sales</option>
		<option>Finance</option>
		<option>Technology</option>
		<option>Healthcare</option>
		<option>Human Resources</option>
		<option>Hourly/Skilled</option>
		<option>Management</option>
		<option>Public Service</option>
		<option>Education</option>
	</select><br/>
	<span class="left" style="vertical-align:top;">Job Keywords</span><textarea name="skills"></textarea><br/>
	<input type="submit" value="Submit"/>
</form>
<?php 
}else if($CurrentUser->type==User::$EMPLOYER){
?>
<form action="javascript: employerValidate()">
	<span class="left">Name</span><input name="name" type="text" /><br/>
	<span class="left">Street</span><input name="streetNumber" type="text" /><br/>
	<span class="left">City</span><input name="city" type="text" /><br/>
	<span class="left">State</span><input name="city" type="text" /><br/>
	<span class="left">Zip code</span><input name="zip" type="text" /><br/>
	<span class="left">Email Address</span><input name="email" type="text" /><br/>
	<span class="left">Phone Number</span><input name="phone" type="text" /><br/>
	<span class="left">Website</span><input name="website" type="text" /><br/>
	<span class="left">Type of Company</span>
	<select name="companyType">
		<option>Education</option>
		<option>Retail</option>
		<option>Finance</option>
		<option>Services</option>
		<option>Telecommunication</option>
		<option>Healthcare</option>
		<option>Technology</option>
		<option>Others</option>
	</select><br/>
	<span class="left" style="vertical-align:top;">Description</span><textarea name="description"></textarea><br/>
	<input type="submit" value="Submit" />
</form>
<?php 
}
//
//
//if($CurrentUser){
//	echo "Userid: ".$CurrentUser->$userID."<br/>";
//	echo "loginID: ".$CurrentUser->$loginID."<br/>";
//	echo "type: ".$CurrentUser->$type."<br/>";
//	echo "passwd: ".$CurrentUser->$passwd."<br/>";
//}else{	
//	echo "no user";
//}



$Template->Footer();