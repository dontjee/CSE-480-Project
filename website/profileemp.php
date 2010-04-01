<?php
require_once("std.php");
require_once("classes/Employee.php");

//error_reporting(E_ALL);
$Auth->Restrict("Employee");
$Emp = new Employee($CurrentUser->userID);

$Template->CSS_JS("profile");
$Template->CSS("form");
$Template->CSS("smoothness/jquery-ui-1.8.custom");
$Template->JS("jquery-ui-1.8.custom.min");
$Template->Title("Employee Profile");
$Template->Header();

?>
<form action="profileemp_action.php" method="post">

	<span class="left">First Name</span>
	<input name="fname" type="text" value="<?php echo $Emp->fname;?>"/><br/>
	
	<span class="left">Middle Name</span>
	<input name="mname" type="text" value="<?php echo $Emp->mname;?>"/><br/>
	
	<span class="left">Last Name</span>
	<input name="lname" type="text" value="<?php echo $Emp->lname;?>"/><br/>
	
	<span class="left">Date of Birth</span>
	<input id="dob" name="dob" type="text" value="<?php echo str_replace('-','/',$Emp->dob);?>"/><br/>
	
	<span class="left">Email Address</span>
	<input name="email" type="text" value="<?php echo $Emp->email;?>"/><br/>
	
	
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
	
	<br/>
	<span>Please seperate Skills and Keywords with commas.</span><br/>
	<br/>
	
	
	<span class="left" style="vertical-align:top;">Skills</span>
	<textarea name="skills"><?php 
		$array=$Emp->Get('skills');
		$result="";
		foreach($array as $name){
			$result.=ucwords($name).", ";	
		}
		echo substr($result,0,-2);
	?></textarea><br/>
		
	
	<span class="left" style="vertical-align:top;">Job Keywords</span>
	<textarea name="keywords"><?php 
		$array=$Emp->Get('keywords');
		$result="";
		foreach($array as $name){
			$result.=ucwords($name).", ";	
		}
		echo substr($result,0,-2);
	?></textarea><br/>
	<br/>
	
	<span class="left" style="vertical-align:top;">Seeking Categories</span>
	<select name="categories[]" size="5" multiple="multiple"><?php 
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

	<span class="left"></span>
	<input type="submit" value="Update"/>
	
</form>
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
<br/>




	


<?php $Template->Footer();?>