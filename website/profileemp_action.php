<?php 
require_once("std.php");
//error_reporting(E_ALL);
$Auth->Restrict("Employee");

if (sizeof($_POST)==0){
	header("location: profileemp.php");
	die;
}
$_POST=array_map("mysql_real_escape_string",$_POST);

// check if they are uploading a resume
if(isset($_FILES['resume'])){
	if($_FILES["resume"]["error"] > 0 ){
		echo "Error: ".$_FILES["resume"]["error"]."<br/>";
		die;
	}
	
	$type=$_FILES['resume']['type'];
	if($type!='application/msword'){// && end(explode($_FILES['resume']['name']))!="pdf"){
		echo "Error: Invalid Filetype.";
		die;
	}
	
	         
	// Prepend timestamp to file names to prevent naming conflicts.
	// An alternative would be to use seperate dirs for each user  
	$uploaddir = 'resumes/';
	$uploadfile = (string)time().'.'.basename($_FILES['resume']['name']);
	$uploadpath = $uploaddir.$uploadfile;

	// move the temp file to the resumes dir
	if (!move_uploaded_file($_FILES['resume']['tmp_name'], $uploadpath)){
		// from the php.net site...
	    echo "Possible file upload attack!\n";
	    die;
	}
	
	// Delete the old resume
	$query="SELECT resumefile FROM employees WHERE users_userID=$CurrentUser->userID";
	$currentResume=$DB->QueryRow($query);
	if ($currentResume){
		$currentResume=$currentResume['resumefile'];
		
		if ($currentResume!='' && $currentResume!=null){
			if(!unlink('resumes/'.$currentResume)){
				// There was an error, but ignore it for now.
				// May want to do something later.
			}
		}
	}
	
	
	// update the database with the new filename
	$query="UPDATE employees SET resumefile='$uploadfile' WHERE users_userID=$CurrentUser->userID";
	$DB->Query($query);


	header("location: profileemp.php");
	die;	
}


$query ="UPDATE employees SET ";
foreach($_POST as $key=>$value){
	$query.="$key='$value', ";
}
$query=substr($query,0,-2);
$query.=" WHERE users_userID=$CurrentUser->userID";
$DB->Query($query);

echo $query;

header("location: profileemp.php");

?>