<?php

require_once("std.php");
require_once("classes/Employee.php");

$Auth->Restrict("Employer");

$Template->Title("Add Comment");
$Template->Header();

?>

<form action="addcomment_action.php" method="post" id="signup_form">

	<span class="row">
		<label class="label" for="comment">Comment</label>
		<textarea name="comment"></textarea>
	</span>
	<br/>
	<input name="userID" type="text" style="visibility:hidden;" value="<?php echo $_GET['uid'] ?>" />
	<input id="submit" type="submit" value="Submit" />
	
</form>

<?php
$Template->Footer();
?>
