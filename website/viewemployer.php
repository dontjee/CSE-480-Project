<?php

require_once("std.php");
require_once("classes/Employer.php");

//$Auth->UsersOnly();

$employer = new Employer($_GET['id']);

$Template->Title("Employer Profile | " . $employer->name);
$Template->CSS("buttons");
$Template->CSS("form");
$Template->CSS("viewemployee");
$Template->JS("viewemployee");
$Template->Header();


	if($Auth->User()->type == User::$ADMIN){ ?>
		<!-- Only admin should see this button -->
		<div id="buttons">
			<a href="delete_user_action.php?userID=<?php echo $employer->userID; ?>">
				<span class="action_button" id="delete_user">Delete User</span>
			</a>
		</div>
	<?php } ?>


	<span class="employee_name"><?php echo $employer->name; ?></span>
		
	<span class="row">
		<label class="label">Street Number: </label>
		<span><?php echo $employer->streetNumber;?></span>
	</span>
		
	<span class="row">
		<label class="label">City: </label>
		<span><?php echo $employer->city;?></span>
	</span>
		
	<span class="row">
		<label class="label">State: </label>
		<span><?php echo $employer->state;?></span>
	</span>
		
	<span class="row">
		<label class="label">Zip: </label>
		<span><?php echo $employer->zip;?></span>
	</span>
		
	<span class="row">
		<label class="label">Email: </label>
		<span><a href="mailto:<?php echo $employer->email;?>"><?php echo $employer->email;?></a></span>
	</span>
		
	<span class="row">
		<label class="label">Phone: </label>
		<span><?php echo $employer->phone;?></span>
	</span>
		
	<span class="row">
		<label class="label">Website: </label>
		<span><a href="http://<?php echo $employer->website;?>"><?php echo $employer->website;?></a></span>
	</span>
		
	<span class="row">
		<label class="label">Company Type: </label>
		<span><?php echo $employer->companyType;?></span>
	</span>
		
	<span class="row">
		<label class="label">Description: </label>
		<span><?php echo $employer->description;?></span>
	</span>	
	
<?php
$Template->Footer();
?>