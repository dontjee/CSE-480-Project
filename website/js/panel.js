//Main Javascript file, controls things like the main menu.

$(document).ready(InitPanels);

function InitPanels(){

	$('.panel .delete').click(DeleteObject);

}

function DeleteObject(e){
	if(!confirm("Do you really want to delete this notification?"))
		return false;

	var target = e.currentTarget;
	var url = $(target).attr('href');
	
	$.ajax({
		url: url,
		success: function(){ $(target).parent().parent().slideUp("medium") }
	});
	
	return false;
}