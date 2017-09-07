$(document).ready(function() {

	//======================= MODAL =======================

	$('.add-article').click(function(event){
		$('.block-form').css('display', 'block');
	});

	$('#exit').click(function(event){
		$('.block-form').css('display', 'none');
	});

});
