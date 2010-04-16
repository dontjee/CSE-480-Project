//Main Javascript file, controls things like the main menu.

$(document).ready(InitEmployee);

function InitEmployee(){
	$("#notify_employee").click(Notify);
}

function Notify(){
	var jobID = $("#notify_job").val();
	var userID = GetParam("id");
	
	if(jobID == -1){
		alert("Please Select which job you would like to notify this user about.");
		return;
	}

	$.ajax({
		url: "notify_action.php",
		data: {
			jID: jobID,
			userID: userID
		},
		success: Notified
	});

}

function Notified(data){
	alert("The user has been notified of your interest in them.");
}