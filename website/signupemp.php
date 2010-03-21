<?php

require_once("std.php");

$Template->CSS("signup");
$Template->CSS("form");
$Template->Header();
?>


<form action="signupemp_action.php" method="post" id="signup_form">

	<span class="row">
		<label class="label" for="loginID">Login ID</label>
		<input name="loginID" class="field input" type="text"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="password">Password</label>
		<input name="password" class="field input" type="password"/>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="passwordConfirm">Confirm Password</label>
		<input name="confirmPassword" class="field input" type="password"/>
	</span>
	<br/>
	
	<span class="row">
		<label class="label" for="firstName">First Name</label>
		<input name="firstName" class="field input" type="text"/>
	</span>
	<br/>

	<span class="row">
		<label class="label" for="lastName">Last Name</label>
		<input name="lastName" class="field input" type="text"/>
	</span>
	<br/>
	<input id="submit" type="submit" value="Signup" />
	
</form>


<?php
$Template->Footer();
