$(document).ready(InitProfile);

function InitProfile(){
	$("#update").click(Update);
	if($("#resume_upload")!=null){
		$("#resume_upload").click(Upload);
	}
}

function Update(){
	$("#profile").submit();
}
function Upload(){
	$("#resume").submit();
}

function showResumeUpload(){	
	$("#currrent_resume").css('display','none');
	$('#choose_resume').css('display','inline-block');
}

$(function() {
	$("#dob").datepicker({
		changeMonth: true,
		changeYear: true,
		showAnim: "slideDown",
		buttonText: "",
		constrainInput: true, 
		dateFormat:"mm/dd/yy", 
		yearRange: "1920:2010"
	});	
});

//$.datepicker.setDefaults({
//	   showOn: 'both'
//});

		
