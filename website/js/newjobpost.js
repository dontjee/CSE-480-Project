$(function() {
	$("#closingDate").datepicker({
		changeMonth: true,
		changeYear: true,
		showAnim: "slideDown",
		buttonText: "",
		constrainInput: true, 
		dateFormat:"yy-mm-dd", 
		yearRange: "1920:2010"
	});	
});