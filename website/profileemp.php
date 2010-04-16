<?php
require_once("std.php");
require_once("classes/Employee.php");

//error_reporting(E_ALL);
$Auth->Restrict("Employee");
$Emp = new Employee($CurrentUser->userID);

$Template->CSS_JS("profile");
$Template->CSS("smoothness/jquery-ui-1.8.custom");
$Template->CSS("buttons");
$Template->CSS("form");
$Template->JS("jquery-ui-1.8.custom.min");
$Template->Title("Employee Profile");
$Template->Header();

?>
<form action="profileemp_action.php" method="post" id="profile">

	<label class="label" for="fname">First Name</label>
	<input class="field input" name="fname" type="text" value="<?php echo $Emp->fname;?>"/><br/>
	
	<label class="label" for="mname">Middle Name</label>
	<input class="field input" name="mname" type="text" value="<?php echo $Emp->mname;?>"/><br/>
	
	<label class="label" for="lname">Last Name</label>
	<input class="field input" name="lname" type="text" value="<?php echo $Emp->lname;?>"/><br/>
	
	<label class="label" for="dob">Date of Birth</label>
	<input class="field input" id="dob" name="dob" type="text" value="<?php echo str_replace('-','/',$Emp->dob);?>"/><br/>
	
	<label class="label" for="email">Email Address</label>
	<input class="field input" name="email" type="text" value="<?php echo $Emp->email;?>"/><br/>
	
	
	<label class="label" for="education">Education</label>	
	<select class="field input" name="education" >
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
	
	<br/>
	<label>Please seperate Skills and Keywords with commas.</label><br/>
	<br/>
	
	
	<label class="label" for="skills" style="vertical-align:top;">Skills</label>
	<textarea class="field textarea"name="skills"><?php 
		$array=$Emp->Get('skills');
		$result="";
		foreach($array as $name){
			$result.=ucwords($name).", ";	
		}
		echo substr($result,0,-2);
	?></textarea><br/>
		
	
	<label class="label" for="keywords" style="vertical-align:top;">Job Keywords</label>
	<textarea class="field textarea" name="keywords"><?php 
		$array=$Emp->Get('keywords');
		$result="";
		foreach($array as $name){
			$result.=ucwords($name).", ";	
		}
		echo substr($result,0,-2);
	?></textarea><br/>
	<br/>
	
	<label class="label" for="categories" style="vertical-align:top;">Seeking Categories</label>
	<select class="field select" name="categories[]" size="5" multiple="multiple"><?php 
		$type=array("Admin Support","Sales","Finance","Technology","Healthcare","Human Resources","Hourly/Skilled","Management","Public Service","Education");
		asort($type);
		$categories=$Emp->Get('categories');
		foreach($type as $option){
			$selected="";
			if (in_array(strtolower($option), $categories)){
				$selected=' selected="selected"';
			}
			echo "<option$selected>$option</option>";
		}
	?></select>
	<br/>

	<label class="label"></label>
	<!--<input type="submit" value="Update"/>-->
	<br/>
	<label class="label"></label>
	<span id="update" class="action_button">Update</span>
	
</form>
<br/>
<form action="profileemp_action.php" enctype="multipart/form-data" method="post" id="resume">
	<label class="label">Resume</label>
	<span id="currrent_resume">
		<?php 
		if($Emp->resumefile != ""){
			echo "<a href=\"resumes/$Emp->resumefile\">".substr($Emp->resumefile,11)."</a>";
		}else{
			echo "Not Uploaded";
		}
		?>
		<!--<button onclick="showResumeUpload()">Change</button><br/>-->
		<span onclick="showResumeUpload()" class="action_button">Change</span>
	</span>


	<span id="choose_resume" style="display:none">
		<input type="hidden" name="MAX_FILE_SIZE" value="10485760" />
		<input name="resume" type="file" value="Choose..." />
		<!--<input type="submit" value="Upload"/>-->
		<span id="resume_upload" class="action_button">Upload</span>
	</span>
</form> 
<br/>




	


<?php $Template->Footer();?>
