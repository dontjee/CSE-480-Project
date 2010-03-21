<?php

require_once("std.php");

$Template->CSS("login");
$Template->CSS("form");
$Template->Header();
?>


<form action="login_action.php" method="post" id="login_form">

	<span class="row">
		<label class="label" for="loginID">Login ID</label>
		<input name="loginID" class="field input" type="text"/>
	</span>
	
	<span class="row">
		<label class="label" for="password">Password</label>
		<input name="password" class="field input" type="password"/>
	</span>
	
	<input id="submit" type="submit" value="Login" />
	
</form>


<?php
$Template->Footer();
