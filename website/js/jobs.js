$(document).ready(InitJobs);

function InitJobs(){
	$("#search_button").click(SearchJobs);
	$("#search_ranked_button").click(SearchRankedJobs);
}
function SearchRankedJobs(){
	// add search ajax here

	var allInputs = $(":input");
	var obj={};
	obj['ranked']=true;
	
	for (var n=0; n<allInputs.length; n++){
		if (allInputs[n].value != "") {
			obj[allInputs[n].name]=allInputs[n].value;
		}
	}
		
	$('#jobs').load("jobs_action.php",obj);
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

	