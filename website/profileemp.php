<?php
require_once("std.php");
error_reporting(E_ALL);
if ($CurrentUser->type!=User::$EMPLOYEE){
	header("location: index.php");
}
require_once("classes/Employee.php");
$Template->CSS_JS("profile");
$Template->CSS("form");
$Template->CSS("smoothness/jquery-ui-1.8.custom");
$Template->JS("jquery-ui-1.8.custom.min");
$Template->Title("Employee Profile");
$Template->Header();
$Emp = new Employee($CurrentUser->userID);

?>
<form action="profileemp_action.php" method="post">
	<span class="left">First Name</span><input name="fname" type="text" value="<?php echo $Emp->fname;?>"/><br/>
	<span class="left">Middle Name</span><input name="mname" type="text" value="<?php echo $Emp->mname;?>"/><br/>
	<span class="left">Last Name</span><input name="lname" type="text" value="<?php echo $Emp->lname;?>"/><br/>
	<span class="left">Date of Birth</span><input id="dob" name="dob" type="text" value="<?php echo $Emp->dob;?>"/><br/>
	<span class="left">Email Address</span><input name="email" type="text" value="<?php echo $Emp->email;?>"/><br/>
	<span class="left">Education</span>
	<select name="education" >
	<?php 
	$education=array("High School","College","PostGraduate");
	foreach($education as $option){
		$selected="";
		if (strtolower($option)==strtolower($Emp->education)){ // the database is storing PostGraduate as Postgraduate.... ????
			$selected=' selected="selected"';
		}
		echo "<option$selected>$option</option>";
	}
	?>
	</select><br/>
	
	<input type="submit" value="Update"/>
</form>
<br/>
<br/>
<br/>
<span class="left">Resume</span>
<?php 
if($Emp->resumefile != ""){
	echo "<a href=\"resumes/$Emp->resumefile\">".substr($Emp->resumefile,11)."</a>";
}else{
	echo "Not Uploaded";
}
?>

<button onclick="showResumeUpload()">Change</button><br/>
<form action="profileemp_action.php" enctype="multipart/form-data" method="post" >
	<div id="chooseResume" style="display:none">
		<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
		<span class="left"></span><input name="resume" type="file" value="Choose..." />
		<input type="submit" value="Upload"/>
	</div>
</form> 

<span class="left" style="vertical-align:top;">Skills</span><textarea name="skills"></textarea><br/>
<span class="left" style="vertical-align:top;">Seeking</span>
	<select name="category" size="5" multiple="multiple">
	<?php 
	$type=array("Admin Support","Sales","Finance","Technology","Healthcare","Human Resources","Hourly/Skilled","Management","Public Service","Education");
	foreach($type as $option){
		$selected="";
		if ($option==$user['companyType']){
			$selected=' selected="selected"';
		}
		echo "<option$selected>$option</option>";
	}
	?>	
	</select><br/>
	<span class="left" style="vertical-align:top;">Job Keywords</span><textarea name="skills"></textarea><br/>
<?php $Template->Footer();?>
