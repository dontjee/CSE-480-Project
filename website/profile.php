<?php
require_once("std.php");
if ($CurrentUser->type ==User::$EMPLOYEE){
	header("location: profileemp.php");
}
else if ($CurrentUser->type ==User::$EMPLOYER){
	header("location: profileemployer.php");
}
//else if ($CurrentUser->type ==User::$ADMIN){
//	
//}
else{
	header("location: index.php");
} 
$_REQUEST=array_map("mysql_real_escape_string",$_REQUEST);

$Template->CSS_JS("profile");
$Template->Header();

if($CurrentUser->type==User::$EMPLOYEE){
	$user=$DB->Query("SELECT * FROM Employees WHERE Users_userID=$CurrentUser->userID");
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<span class="left">First Name</span><input name="fname" type="text" value="<?php echo $user['fname'];?>"/><br/>
	<span class="left">Middle Name</span><input name="mname" type="text" value="<?php echo $user['mname'];?>"/><br/>
	<span class="left">Last Name</span><input name="lname" type="text" value="<?php echo $user['lname'];?>"/><br/>
	<span class="left">Date of Birth</span><input name="day" type="text" style="width:20px"/><input name="month" type="text" style="width:20px"/><input name="year" type="text" style="width:40px"/><br/>
	<span class="left">Email Address</span><input name="email" type="text" value="<?php echo $user['email'];?>"/><br/>
	<span class="left">Education</span>
	<select name="education" >
<?php 
	$education=array("High School","College","PostGraduate");
	foreach($education as $option){
		$selected="";
		if ($option==$user['education']){
			$selected=' selected="selected"';
		}
		echo "<option$selected>$option</option>";
	}
?>
	</select><br/>
	<span class="left" style="vertical-align:top;">Skills</span><textarea name="skills"></textarea><br/>
	<span class="left" style="vertical-align:top;">Seeking</span>
	<select name="category" size="5" multiple="multiple">
<?php 
	$type=array("Admin Support","Sales","Finance","Technology","Healthcare","Human Resources","Hourly/Skilled","Management","Public Service","Education");
	foreach($type as $option){
		$selected="";
//		if ($option==$user['companyType']){
//			$selected=' selected="selected"';
//		}
		echo "<option$selected>$option</option>";
	}
?>	
	</select><br/>
	<span class="left" style="vertical-align:top;">Job Keywords</span><textarea name="skills"></textarea><br/>
	<button onclick="employeeValidate()">Update</button>
</form>
<span class="left">Resume</span><a href="<?php echo $user['resumefile']?>">
<?php 
	if($user['resumefile']!= ""){
		echo "resume";
	}else{
		echo "not uploaded";
	}
?></a><button onclick="showResumeUpload()">Change</button><br/>
<form  name="chooseResume" action="upload_resume_action.php" method="post" style="display:none">
<span class="left"></span><input name="resume" type="file" value="Choose..." /><br/>
<input type="submit" value="Upload"/>
</form> 
<?php 
}else if($CurrentUser->type==User::$EMPLOYER){
	$user=$DB->Query("SELECT * FROM Employers WHERE Users_userID=$CurrentUser->userID");
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
	<span class="left">Name</span><input name="name" type="text" value="<?php echo $user['name'];?>" /><br/>
	<span class="left">Street</span><input name="streetNumber" type="text" value="<?php echo $user['streetNumber'];?>" /><br/>
	<span class="left">City</span><input name="city" type="text" value="<?php echo $user['city'];?>" /><br/>
	<span class="left">State</span><input name="state" type="text" value="<?php echo $user['state'];?>" /><br/>
	<span class="left">Zip code</span><input name="zip" type="text" value="<?php echo $user['zip'];?>" /><br/>
	<span class="left">Email Address</span><input name="email" type="text" value="<?php echo $user['email'];?>" /><br/>
	<span class="left">Phone Number</span><input name="phone" type="text" value="<?php echo $user['phone'];?>" /><br/>
	<span class="left">Website</span><input name="website" type="text" value="<?php echo $user['website'];?>" /><br/>
	<span class="left">Type of Company</span>
	<select name="companyType">
<?php 
	$type=array("Education","Retail","Finance","Services","Telecommunication","Healthcare","Technology","Others");
	foreach($type as $option){
		$selected="";
		if ($option==$user['companyType']){
			$selected=' selected="selected"';
		}
		echo "<option$selected>$option</option>";
	}
?>
	</select><br/>
	<span class="left" style="vertical-align:top;">Description</span><textarea name="description"><?php echo $user['description'];?></textarea><br/>
	<button onclick="employerValidate()">Update</button>
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