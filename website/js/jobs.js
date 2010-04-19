$(document).ready(InitJobs);

function InitJobs(){
	$("#search_button").click(SearchJobs);

}

function SearchJobs(){
	// add search ajax here

	var allInputs = $(":input");
	var obj={};
	
	for (var n=0; n<allInputs.length; n++){
		if (allInputs[n].value != "") {
			obj[allInputs[n].name]=allInputs[n].value;
		}
	}
		
	$('#jobs').load("jobs_action.php",obj);
}

	