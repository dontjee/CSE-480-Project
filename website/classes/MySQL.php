<?php
/*
Purpose: Database connection class

Usage:
	dbquery("SELECT * FROM Users WHERE user_id = %s", array(1));
*/

$DB_INFO = array();

//$DB_INFO['host']		= 'mysql-user.cse.msu.edu';
$DB_INFO['host']		= 'localhost';
$DB_INFO['username']	= 'mille449';
$DB_INFO['passwd']		= 'A24503389';
$DB_INFO['dbname']		= 'mille449';

/*
$DB_INFO['host']		= 'localhost';
$DB_INFO['username']	= 'cse480';
$DB_INFO['passwd']		= 'cse480';
$DB_INFO['dbname']		= 'cse480';
*/
/* Set up the default DB */
$DB = new MySQL_DB();

// The actual class
class MySQL_DB{

	private $dbh;
	
	function __construct(){
		global $DB_INFO;

		$this->dbh = mysql_connect($DB_INFO['host'],$DB_INFO['username'],$DB_INFO['passwd']);	
		if (!$this->dbh ){
			die("<b>Error establishing a database connection!</b>");
		}
		mysql_select_db($DB_INFO['dbname']);
	}

	function Query($query, $values=array()){
		foreach($values as $value){
			$value = mysql_escape_string($value);
		}
		
		$query = vsprintf($query, $values);

		$result = mysql_query($query, $this->dbh);
		
		// debugging code
		$error=mysql_error($this->dbh);
		if ($error!=""){
			echo $query."<br/>";
			echo $error."<br/>";			
		}
		
		if(!$result){
			return false;
		}
		
		if(stripos($query, 'SELECT') !== false){
			//This is a select query
			$final_array = array();
			while($row = mysql_fetch_assoc($result))
				array_push($final_array, $row);

			return $final_array;
		}else{
		    return $result;
		}
	}
	
	function QueryRow($query, $values=array()){
		$result = $this->Query($query, $values);
		if(count($result)){
			return $result[0];
		}
		return null;
	}
	
}
