var output = "";
(function ( $ ) {
	
    $.fn.save = function( options ) {
		
		var method = $.extend({
            // These are the defaults.
			    action:'update',
				id:'',
				check:'',
				field:'',
				token:'',
				key:'',
				url: false,
				type: 'json',
			}, options );
			
		  $.ajax({
					type:'POST',
					url: method.url,
					dataType:method.type,
					async:false,
					data:{
						  field:method.field,
						  type:method.action,
						  id:method.id,
						  check:method.check,
						  csrf_test_name:method.key
						 },							
				   beforeSend: function() {
						$('.spinner').show().css({"z-index":"9999","position":"absolute","top":"15%","width":"100%"});   
						$('#error_list').html('').hide();
						$('.alert-danger').html('').show();
						$('.alert-success').html('').show();
						$('.output_result').show();
					},	
					success: function(response) {
							var topscroll = '';
							var topclass  = '';
							topscroll = 1000;
							topclass  = '.x_panel';					
						if(response.status == 0){
							$('.spinner').hide();
							//$('.tooltip_error').html('');
							$('.error_message').html('');
							$.each(response.message,function(key,err){				
							   // $('.'+key).html(err).removeClass('tooltip_error').addClass('tooltip_error').css({"color":'#E50017'});
							    $('.'+key).html(err).removeClass('error_message').addClass('error_message').css({"color":'#E50017'});
							});
							$('html, body').animate({
								scrollTop: $(topclass).offset().top
							}, topscroll);
							
						}else{		
							$('.spinner').hide();
							$('.error_message').html('');
							if(response.action == 'add'){
								document.getElementById(response.form_id).reset();									
							}
							
							output = '<div class="alert alert-success">'+response.message+'</div>';
							if(response.form_id != 'password_form' ){
								switch(response.form_id){
									case 'gallery_form':
									window.location.href = "/media/images";
									break;												
									case 'profile_form':
									location.reload();
									break;										
								}
							}							
						}							
					},
			   });	
		//console.log(this.selector);
		//console.log(output);
		$(this).html(output);
		//console.clear();		
    };
		
	$.fn.search = function( options ) {
		var search_filter = [];
		var active_cl = '';
		var last_c = '';
		var method = $.extend({
            // These are the defaults.
			    columns:'',
				range:false,
				title:false,
				name:false,
				email:false,
				feature_category:false,
				feature_product:false,
				telephone:false,
				status:false,
				page:'',
				listid:false,
				message:false,
				old_url:false,
				token:false,
				key:false,
				url: false,
				type: 'json',
			}, options );
	
			search_filter.push({name: 'csrf_test_name', value: method.key});
			(method.range != '')?search_filter.push({name: 'range', value: method.range}):false;
			(method.title != '')?search_filter.push({name: 'title', value: method.title}):false;
			(method.telephone != '')?search_filter.push({name: 'telephone', value: method.telephone}):false;
			(method.name != '')?search_filter.push({name: 'name', value: method.name}):false;
			(method.email != '')?search_filter.push({name: 'email', value: method.email}):false;
			(method.status != '')?search_filter.push({name: 'status', value: method.status}):false;
			(method.page != '')?search_filter.push({name: 'page', value: method.page}):false;
			(method.listid != '')?search_filter.push({name: 'listid', value: method.listid}):false;
			(method.message != '')?search_filter.push({name: 'message', value: method.message}):false;
			(method.old_url != '')?search_filter.push({name: 'old_url', value: method.old_url}):false;
			(method.feature_category != '')?search_filter.push({name: 'feature_category', value: method.feature_category}):false;
			(method.feature_product != '')?search_filter.push({name: 'feature_product', value: method.feature_product}):false;
			
		  $.ajax({
					type:'POST',
					url: method.url,
					dataType:method.type,
					async:false,
					data:search_filter,							
					beforeSend: function() {
						$('.spinner').show().css({"z-index":"9999","position":"absolute","top":"15%","width":"100%"}); 
						$('#error_list').html('').hide();
						$('#success_message').html('').hide();
					},	
					success: function(response) {
						if(response.status == 0){
							$('.spinner').hide();
							output = '<div class="alert alert-danger">'+response.message+'</div>';
						}else if(response.status == 2){
							
							$('.spinner').hide();  
							output = '<table class="table table-striped responsive-utilities jambo_table">';
							output += '<thead>';
							output += '<tr class="headings">';
							$.each( method.columns, function( key, value ) {
								output += '<th>'+value+'</th>';
							});	
							
							output += '</tr>';
							output += '</thead>';
							output += '<tbody>';
							output += '<tr>';
							output += '<td>';
							output += response.message;
							output += '</td>';
							output += '</tr>';
							output += '</tbody>';	
							output += '</table>';	
                            output += '</div>';	
							output += '<div class="pagination-center text-center">'+response.pagination+'</div>';
								  
						}else{
							$('.spinner').hide();  
							output = '<table class="table table-striped responsive-utilities jambo_table">';
							output += '<thead>';
							output += '<tr class="headings">';
							$.each( method.columns, function( key, value ) {
								output += '<th>'+value+'</th>';
							});	
							
							output += '</tr>';
							output += '</thead>';
							output += '<tbody>';
															
							$.each( response.message, function( key, data ) {
								active_cl = (key%2 == 0)?'even pointer':'odd pointer';
								
								output += '<tr class="'+active_cl+'">';							
								 $.each( data, function( index, value ) {
						
									 if(index == 'action') {
									    last_c = 'class="last"';
									}else{
										last_c = '';
									}
									//console.log(index);							
									switch(index){
									case 'title':
									if(data.feature_category == 1 || data.feature_product == 1 ){
										output += '<td>'+value+' <span class="label label-success">Featured</span>'+'</td>';
									}else{
										output += '<td>'+value+'</td>';
									}
									break;
                                     case 'feature_category':
                                     break;
									 case 'feature_product':
                                     break;
									 case 'banner_id':
                                     break;
									 case 'orignal':
                                     break;
								     case 'id':
                                     break;		
									 case 'category_id':
                                     break;
									 case 'product_id':
                                     break;
									 case 'solution_id':
                                     break;
									 case 'gallery_id':
                                     break;
									 case 'news_id':
                                     break;
									  case 'image_id':
										var is_image = true;
										is_image = openFile(value);
					
										 if(is_image){
											 if(data.orignal){
												 var popup_title = '';
												 if(data.title){
													 popup_title = data.title;
												 }
												 output += '<td class="img-browse-col"><a href="'+data.orignal+'" class="group2" title="'+popup_title+'"><img src="'+value+'" class="img-thumbnail"></a></td>';
											 }else{
												 output += '<td class="img-browse-col"><img src="'+value+'" class="img-thumbnail"></td>';
											 }
											 
										 }else{
											 output += '<td class="img-browse-col"><img src="/uploads/no_image.png" class="img-thumbnail"></td>';
										 }
										
									  break;
                                      case 'link':
									  output += '<td><a href="'+value+'" target="_blank"><i class="fa fa-link" aria-hidden="true"></i></a></td>';
									  break;
									  case 'status':
									  output += (value == 1)?'<td>Active</td>':'<td>InActive</td>';
									  break;								  
									  case 'phone':
									  output += '<td>'+value+'</td>';
									  break;
									  case 'updated':
									  if(data.author_id){
										  output += '<td><span data-toggle="tooltip" data-placement="top" title="Last updated by '+data.author_id+'" >'+value+'</span></td>'; 
									  }else{
										   output += '<td><span data-toggle="tooltip" data-placement="top" title="Update" >'+value+'</span></td>';
									  }
									 
									  break;
									  case 'author_id':
									  break;
									  default:
									  output += '<td '+last_c+'>'+value+'</td>';
									}
															
								});
															 
								output += '</tr>'; 
						    });	
							output += '</tbody>';	
							output += '</table>';	
                            output += '</div>';	
                       
						}
                      
						output += '<div class="pagination-center text-center">'+response.pagination+'</div>';				
                        
					},
			   });
        
		$(this).html(output);
		  $(".pagination li a").removeAttr("href").css("cursor","pointer");
		  $('[data-toggle="tooltip"]').tooltip();
		//$(".pagination li a").attr("href", "javascript:void(0)");
		
		$(".pagination-center ul li a").bind("click",function(e){
			
			//$(this).siblings().removeClass('active');
			//$(this).addClass('active');
			  
			  var page = '';		
			  id = $(this).data('ci-pagination-page');			  
			  var data2 = {type:"click",page:id};
			  $("#filter_search").trigger(data2);
		});	
    };
	 
	  $("form").on("submit", function(e){
			return false; 
	  });
		 
		 
	  function cb(start, end) {
		$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
	  }
	  
	  function openFile(file) {
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var result;
		switch(extension) {
			case 'jpg':
			result =  true;
			break;
			case 'JPG':
			result =  true;
			break;
			case 'jpeg':
			result =  true;
			break;
			case 'png':
			result =  true;
			break;
			case 'gif':
			result =  true;
			break;                         
			case 'docx':
			result =  true;
		    break;
			case 'pdf':
			result =  true;
			break;
			default:
			result =  false;
		}
		return result;
};

		
		cb(moment().subtract(29, 'days'), moment());
		$('#reportrange span').text('');

		$('#reportrange').daterangepicker({
			ranges: {
			   'Today': [moment(), moment()],
			   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
			   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
			   'This Month': [moment().startOf('month'), moment().endOf('month')],
			   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			   autoUpdateInput: false,
			   locale: {
			  cancelLabel: 'Clear'
		  }
		}, cb);
		
		 $('#reportrange').on('cancel.daterangepicker', function(ev, picker) {
			$('#reportrange span').html('');
		 });		
		 	 
}( jQuery ));