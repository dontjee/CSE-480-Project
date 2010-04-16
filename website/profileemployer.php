<?php 
require_once("std.php");
require_once("classes/Employer.php");

$Auth->Restrict("Employer");

$Template->CSS_JS("profile");
$Template->CSS("buttons");
$Template->CSS("form");
$Template->Title("Employer Profile");
$Template->Header();

$Employer = new Employer($CurrentUser->userID);

?>
<form action="profileemployer_action.php" method="post" id="profile">
	<label class="label" for="name">Name</label>
	<input class="field input" name="name" type="text" value="<?php echo $Employer->name;?>" /><br/>
	
	<label class="label" for="streetNumber" >Street</label>
	<input class="field input" name="streetNumber" type="text" value="<?php echo $Employer->streetNumber;?>" /><br/>
	
	<label class="label" for="city" >City</label>
	<input class="field input" name="city" type="text" value="<?php echo $Employer->city;?>" /><br/>
	
	<label class="label" for="state">State</label>
	<input class="field input" name="state" type="text" value="<?php echo $Employer->state;?>" /><br/>
	
	<label class="label" for="zip">Zip code</label>
	<input class="field input" name="zip" type="text" value="<?php echo $Employer->zip;?>" /><br/>
	
	<label class="label" for="email">Email Address</label>
	<input class="field input" name="email" type="text" value="<?php echo $Employer->email;?>" /><br/>
	
	<label class="label" for="phone">Phone Number</label>
	<input class="field input" name="phone" type="text" value="<?php echo $Employer->phone;?>" /><br/>
	
	<label class="label" for="website">Website</label>
	<input class="field input" name="website" type="text" value="<?php echo $Employer->website;?>" /><br/>
	
	<label class="label" for="companyType">Type of Company</label>
	<select class="field select" name="companyType">
		<?php 
		$type=array("Education","Retail","Finance","Services","Telecommunication","Healthcare","Marketing","Technology","Others");
		foreach($type as $option){
			$selected="";
			if ($option==$Employer->companyType){
				$selected=' selected="selected"';
			}
			echo "<option$selected>$option</option>";
		}
		?>
	</select><br/>
	
	<label class="label" for="description" style="vertical-align:top;">Description</label>
	<textarea class="field textarea" name="description"><?php echo $Employer->description;?></textarea><br/>
	
	<!--<input type="submit" class="action button" value="Update"/>-->
	<br/>
	<label class="label"></label>
	<span id="update" class="action_button">Update</span>
	
</form>

<?php $Template->Footer(); ?>
