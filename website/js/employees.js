$(document).ready(InitEmployees);

function InitEmployees(){
	
	$("#search_button").click(SearchEmployees);
	$("#search_ranked_button").click(SearchRankedEmployees);
	

}

function SearchRankedEmployees(){
	// add search ajax here

	var allInputs = $(":input");
	var obj={};
	obj['ranked']=true;
	
	for (var n=0; n<allInputs.length; n++){
		if (allInputs[n].value != "") {
			obj[allInputs[n].name]=allInputs[n].value;
		}
	}
		
	$('#employees').load("employees_action.php",obj);
}

function SearchEmployees(){
	// add search ajax here

	var allInputs = $(":input");
	var obj={};
	
	for (var n=0; n<allInputs.length; n++){
		if (allInputs[n].value != "") {
			obj[allInputs[n].name]=allInputs[n].value;
		}
	}
		
	$('#employees').load("employees_action.php",obj);
}
	