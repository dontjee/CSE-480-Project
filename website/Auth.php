<?php
//The different Menu views to show for different users

class Auth{
	public static $NONE = "none";
	public static $EMPLOYEE = "employee";
	public static $EMPLOYER = "employer";
	public static $ADMIN = "admin";
	
	public function UserType(){
		return Auth::$EMPLOYEE;
	}
	
	//Restrict this page to ONLY users of the given type
	public function Restrict($userType){
	}
	
	//If the current user is of this type, redirect them to the home page.
	public function DontAllow($userType){
		//TODO: Redirect to homepage.
	}
	
}