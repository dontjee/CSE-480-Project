$(document).ready(JP_Init);


function JP_Init(){
	$('#bookmark').click(Bookmark);
	$('#interested').click(Interest);
}

//Bookmark this notification
function Bookmark(){
	var id = GetParam("id");
	
	$.ajax({
		method: "GET",
		url: "bookmark_action.php?jID=" + id,
		success: Bookmarked
	});
	
	StartLoading();
}

function Bookmarked(){
	StopLoading();
	ShowAlert("This job has been succesfully bookmarked.");
}

//Create a notification to the employer that this employee is interested
function Interest(){
	var id = GetParam("id");
	
	$.ajax({
		method: "GET",
		url: "notify_action.php?jID=" + id,
		success: InterestShown
	});
	
	StartLoading();
}

function InterestShown(){
	StopLoading();
	ShowAlert("The employer has been notified of your interest.");
}

function StartLoading(){
	$("loading").show();
}

function StopLoading(){
	$("loading").hide();
}

function ShowAlert(alert){
	$("#alert").html(alert).fadeIn('slow').animate({opacity: 1.0}, 2000).fadeOut('slow');
}