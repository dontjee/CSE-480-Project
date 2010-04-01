<?php 
require_once("std.php");
error_reporting(E_ALL);
$Auth->Restrict("Employee");

$Emp = new Employee($CurrentUser->userID);

if (sizeof($_POST)==0){
	header("location: profileemp.php");
	die;
}

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
	$query="SELECT resumefile FROM employees WHERE users_userID=%s";
	$currentResume=$DB->QueryRow($query, Array($CurrentUser->userID));
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
	$query="UPDATE employees SET resumefile='%s' WHERE users_userID=%s";
	$DB->Query($query, Array($uploadfile, $CurrentUser->userID));

	header("location: profileemp.php");
	die;	
}


if (isset($_POST['skills'])){
	$string = $_POST['skills'];
	$array = array();
	
	if ($string != ""){
		$array = explode(",",$string);
		$Emp->Set('skills',$array);
	}

	$_POST['skills']='';
	unset($_POST['skills']);
}


if (isset($_POST['keywords'])){
	$string = $_POST['keywords'];
	$array = array();
	
	if ($string != ""){
		$array = explode(",",$string);
		$Emp->Set('keywords',$array);
	}

	$_POST['keywords']='';
	unset($_POST['keywords']);
}


if (isset($_POST['categories'])){
	$array = $_POST['categories'];
	
	if (sizeof($array) > 0){
		$Emp->Set('categories',$array);
//		$Emp->Set('categories',array($array)); // multi-select is only passing one value
	}

	$_POST['categories']='';
	unset($_POST['categories']);
}


$query ="UPDATE employees SET ";
foreach($_POST as $key=>$value){
	$query.="$key='$value', ";
}
$query=substr($query,0,-2);
$query.=" WHERE users_userID=$CurrentUser->userID";
$DB->Query($query);



header("location: profileemp.php");

?>