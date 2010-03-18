<?php
//The different Menu views to show for different users

class Auth{
	
	public function UserType(){
	    if( LoggedIn() )
	    {
		if( $_SESSION['user']->type == "Employer" )
		{
			return Auth::$EMPLOYER;
		}
		if( $_SESSION['user']->type == "Employee" )
		{
			return Auth::$EMPLOYEE;
		}
	    }
	}
	
	public function User(){
		if(isset($_SESSION['user']))
			return $_SESSION['user'];
		return null;
	}
	
	public function LoggedIn(){
		return isset($_SESSION['user']);
	}
	
	//Restrict this page to ONLY users of the given type
	public function Restrict($userType){
	    if( $userType != $_SESSION['user']->type )
	    {
		header("Location: index.php");
	    }
	}
	
	//If the current user is of this type, redirect them to the home page.
	public function DontAllow($userType){
		//TODO: Redirect to homepage.
	}
	
	public function Login($userID){
		$_SESSION['user'] = new User($userID);
	}
	
	public function Logout(){
		unset($_SESSION['user']);
	}
	
}
