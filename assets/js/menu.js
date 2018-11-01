$(function(){
	
	changeMenuType()
	/* get current module data */
	getModulePages();
})

function changeMenuType(){
	var currentType = $('select[name="menu_type"]').val();
	if(currentType == 'module'){
		$(".external_box").addClass('hide');
		$(".module_box").removeClass('hide');
	} else {
		$(".module_box").addClass('hide');
		$(".external_box").removeClass('hide');
	}
}

function getModulePages(){
	var hash 			= $( "input[name='csrf_test_name']" ).val();
	var selected_module = $('select[name="module_name"]').val();
	$('select[name="inner_pages"]').html('<option value="">Select</option>');
	if(selected_module != 'gallery'){
		$(".gallery_box").removeClass('hide');
		$('select[name="inner_pages"]').html('<option value="">Please wait...</option>');
		$.ajax({
			url: SITE_URL+'menu/getSlugs',
			data: {m: selected_module,csrf_test_name:hash},
			//data: {m: selected_module},
			dataType: 'json',
			type: 'POST',
			success: function(data, status){
				$('select[name="inner_pages"]').html(data.success);
				$('select[name="inner_pages"]').val($('input[name="inner_page_val"]').val());
			},
			error: function(data, status){
				alert('Something went wrong! Please reload the page.');
			}
		})
	} else {
		$(".gallery_box").addClass('hide');
	}
}