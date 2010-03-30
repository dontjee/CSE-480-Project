<?php 
require_once("std.php");
error_reporting(E_ALL);
if ($CurrentUser->type!=User::$EMPLOYEE){
	header("location: index.php");
}
if (sizeof($_POST)==0){
	header("location: profileemp.php");
	die;
}
$_POST=array_map("mysql_real_escape_string",$_POST);

//print_rr($_POST);


if(isset($_FILES['resume'])){
	print_rr($_FILES);	
//	var_dump($_FILES);	
	print_rr($_POST);
	print_rr($_REQUEST);
	if($_FILES["resume"]["error"] > 0 ){
		echo "Error: " . $_FILES["resume"]["error"] . "<br/><br/><br/>";
	}
	$type=$_FILES['resume']['type'];
	if($type!='application/msword'){
		// invalid filetype
		header("location: profileemp.php");
		die;
	}
	
	         
	// prepend timestamp to file names to prevent naming conflicts.
	$uploaddir = 'resumes/';
	$uploadfile = (string)time().'.'.basename($_FILES['resume']['name']);
	$uploadpath = $uploaddir.$uploadfile;
	echo '<pre>';
	if (move_uploaded_file($_FILES['resume']['tmp_name'], $uploadpath)){
	    echo "File is valid, and was successfully uploaded.\n";
	} else {
	    echo "Possible file upload attack!\n";
	    die;
	}
	
	$query="SELECT resumefile FROM employees WHERE users_userID=$CurrentUser->userID";
	echo $query.'<br/>';
	$currentResume=$DB->QueryRow($query);
	$currentResume=mysql_real_escape_string($currentResume['resumefile']);
	
	if ($currentResume && $currentResume!='' && $currentResume!=null){
		echo "Trying to delete current resume...<br/>";		
		if(!unlink('resumes/'.$currentResume)){
			echo "error deleting current resume<br/>";
			die;
		}
		echo "Resume deleted.<br/>";
	}
	
	$query="UPDATE employees SET resumefile='$uploadfile' WHERE users_userID=$CurrentUser->userID";
	echo $query.'<br/>';
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

?>-->