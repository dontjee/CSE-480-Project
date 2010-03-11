<?
/*
Purpose: Database connection class

Usage:
	dbquery("SELECT * FROM Users WHERE user_id = %s", array(1));
*/

$DB = array();
$DB['host']			= 'localhost';
$DB['username']		= '';
$DB['passwd']		= '';
$DB['dbname']		= '';


/* Set up the default DB */
$default_db = new MySQL_DB();

function dbquery($query, $values){
	global $default_db;
	return $default_db->query($query, $values);
}


// The actual class
class MySQL_DB{

	private $dbh;
	
	
	function __construct(){
			global $DB;

			$this->dbh = mysql_connect($DB['host'],$DB['username'],$DB['passwd']);	
			if (!$this->dbh ){
				die("<b>Error establishing a database connection!</b>");
			}
			mysql_select_db($DB['dbname']);
		}

	function query($query, $values=array()){
		foreach($values as $value){
			$value = mysql_escape_string($value);
		}
		
		$query = vsprintf($query, $values);
		
		$result = mysql_query($query, $this->dbh);
		
		if(!$result){
			return;
		}
		
		if(stripos($query, 'SELECT') !== false){
			//This is a select query
			$final_array = array();
			while($row = mysql_fetch_assoc($result))
				array_push($final_array, $row);

			return $final_array;
		}
	}
	
}