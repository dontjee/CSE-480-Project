function showResumeUpload(){	
	$('#chooseResume').css('display','inline-block');
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

		