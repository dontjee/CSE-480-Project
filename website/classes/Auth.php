<?php
//The different Menu views to show for different users

class Auth{
	
	public function User(){
		if(isset($_SESSION['user']))
			return $_SESSION['user'];
		return null;
	}
	
	public function LoggedIn(){
		return isset($_SESSION['user']);
	}
	
	//Restrict this page to ONLY users of the given type
	public function UsersOnly(){
		if(!$this->LoggedIn())
			$this->SendHome();
	}
	
	//Restrict this page to ONLY users of the given type
	public function Restrict($userType){
	    if(!$this->LoggedIn() || $userType != $_SESSION['user']->type ){
			$this->SendHome();
	    }
	}
	
	//If the current user is of this type, redirect them to the home page.
	public function DontAllow($userType){
		if($this->User()->type == $userType)
			$this->SendHome();
	}
	
	//Only allow the specified user to see this page
	public function Only($userID){
		if($this->User()->userID != $userID)
			$this->SendHome();
	}
	
	public function SendHome(){
		header("Location: index.php");
		die();
	}
	
	public function Login($userID){
		$_SESSION['user'] = new User($userID);
	}
	
	public function Logout(){
		unset($_SESSION['user']);
	}
	
}
