<?php 
require_once("std.php");
if ($CurrentUser->type!=User::$EMPLOYER){
	header("location: index.php");
}
require_once("classes/Employer.php");
$Template->CSS_JS("profile");
$Template->CSS("form");
$Template->Title("Employer Profile");
$Template->Header();

$Employer = new Employer($CurrentUser->userID);

?>
<form action="profileemployer_action.php" method="post">
	<span class="left">Name</span><input name="name" type="text" value="<?php echo $Employer->name;?>" /><br/>
	<span class="left">Street</span><input name="streetNumber" type="text" value="<?php echo $Employer->streetNumber;?>" /><br/>
	<span class="left">City</span><input name="city" type="text" value="<?php echo $Employer->city;?>" /><br/>
	<span class="left">State</span><input name="state" type="text" value="<?php echo $Employer->state;?>" /><br/>
	<span class="left">Zip code</span><input name="zip" type="text" value="<?php echo $Employer->zip;?>" /><br/>
	<span class="left">Email Address</span><input name="email" type="text" value="<?php echo $Employer->email;?>" /><br/>
	<span class="left">Phone Number</span><input name="phone" type="text" value="<?php echo $Employer->phone;?>" /><br/>
	<span class="left">Website</span><input name="website" type="text" value="<?php echo $Employer->website;?>" /><br/>
	<span class="left">Type of Company</span>
	<select name="companyType">
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
	<span class="left" style="vertical-align:top;">Description</span><textarea name="description"><?php echo $Employer->description;?></textarea><br/>
	<input type="submit" value="Update"/>
</form>
<?php 

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
?>