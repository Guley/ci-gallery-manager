$(function () {
    "use strict";
    $('.contact_us_form').on("click", function (event) {
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
			var type 			=  $('.modal.fade.in').attr('id');
            var name 			= $.trim($('.contact_form input[name=customer_name]').val());
            var company 		= $.trim($('.contact_form input[name=company]').val());
            var email 			= $.trim($('.contact_form input[name=email]').val());
            var telphone 		= $.trim($('.contact_form input[name=telphone]').val());
            var message 		= $.trim($('.contact_form #message').val());
            var token 			= $.trim($('.contact_form input[name=security_token]').val());
            var captcha 		= $.trim($('.contact_form input[name=captcha]').val());
   
			$('.contact_form').hide();
			$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
			setTimeout(function(){ 
			
			$.ajax({
				
					async : false,
					url : '/method',
					type : "POST",
					data : {
							'name':name,
							'company':company,
							'email':email,
							'telphone':telphone,
							'message':message,
							'security_token':token,
							'captcha':captcha,
							'type':type,
						   },
					dataType : 'json',				
					beforeSend:function(){
						$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
						$('.contact_message').html('');
						$('.contact_error').html('');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						if(xhr.status==403) {
							$('.loading').hide();
							$('.contact_error').html('<h4 style="margin-bottom: 25px;color:#ff0000;">This article contains basic troubleshooting instructions for 403 Forbidden errors.</h4>');
						}
					  },					
					success:function(dataType) {
						$('.loading').hide();
					 if(dataType.status == 1){
						   $('.contact_message').html('<h4 class="alert alert-success" style="margin-bottom: 25px;">'+dataType.message+'</h4>').fadeOut(3000);
						   $('.contact_form').show();
						   $('.contact_form')[0].reset();
						   $('input[name=security_token]').val(dataType.token);
						   $('.captcha_image').html(dataType.captcha);
						   
						   
					 }else{						 
						 $('.contact_error').html('<h4 class="subscribe-title" style="margin-bottom: 25px;color:#ff0000;">'+dataType.message+'</h4>').fadeTo(300, 1);
						 $('.contact_form').show();
						 $('input[name=security_token]').val(dataType.token);						 
						 $('.captcha_image').html(dataType.captcha);
					 }
			       
					}			
			}) }, 2000);	
		});
		
	$('.request_us_form').on("click", function (event) {
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
			var type 			= $('.modal.fade.in').attr('id');
            var name 			= $.trim($('.quote_form input[name=customer_name]').val());
            var company 		= $.trim($('.quote_form input[name=company]').val());
            var email 			= $.trim($('.quote_form input[name=email]').val());
            var telphone 		= $.trim($('.quote_form input[name=telphone]').val());
            var message 		= $.trim($('.quote_form #message').val());
            var token 			= $.trim($('.quote_form input[name=security_token]').val());
            var captcha 		= $.trim($('.quote_form input[name=captcha]').val());
   
			$('.quote_form').hide();
			$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
			setTimeout(function(){ 
			
			$.ajax({
				
					async : false,
					url : '/method',
					type : "POST",
					data : {
							'name':name,
							'company':company,
							'email':email,
							'telphone':telphone,
							'message':message,
							'security_token':token,
							'captcha':captcha,
							'type':type,
						   },
					dataType : 'json',				
					beforeSend:function(){
						$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
						$('.quote_message').html('');
						$('.quote_error').html('');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						if(xhr.status==403) {
							$('.loading').hide();
							$('.quote_error').html('<h4 style="margin-bottom: 25px;color:#ff0000;">This article contains basic troubleshooting instructions for 403 Forbidden errors.</h4>');
						}
					  },					
					success:function(dataType) {
						$('.loading').hide();
					 if(dataType.status == 1){
						   $('.quote_message').html('<h4 class="alert alert-success" style="margin-bottom: 25px;">'+dataType.message+'</h4>').fadeOut(3000);
						   $('.quote_form').show();
						   $('.quote_form')[0].reset();
						   $('input[name=security_token]').val(dataType.token);
						   $('.captcha_image').html(dataType.captcha);
						   
						   
					 }else{						 
						 $('.quote_error').html('<h4 class="subscribe-title" style="margin-bottom: 25px;color:#ff0000;">'+dataType.message+'</h4>').fadeTo(300, 1);
						 $('.quote_form').show();
						 $('input[name=security_token]').val(dataType.token);						 
						 $('.captcha_image').html(dataType.captcha);
					 }
			       
					}			
			}) }, 3000);	
		});	
		
		
	    $('.product_us_form').on("click", function (event) {
        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
            var name 			= $.trim($('.product_form input[name=customer_name]').val());
            var product_name 	= $.trim($('.product_form input[name=product_name]').val());
            var email 			= $.trim($('.product_form input[name=email]').val());
            var telphone 		= $.trim($('.product_form input[name=telphone]').val());
            var message 		= $.trim($('.product_form #message').val());
            var token 			= $.trim($('.product_form input[name=security_token]').val());
            var captcha 		= $.trim($('.product_form input[name=product_captcha]').val());
            var id 				= $('.product_form input[name=product_id]').val();

   
			$('.product_form').hide();
			$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
			setTimeout(function(){ 
			
			$.ajax({
				
					async : false,
					url : '/products/method',
					type : "POST",
					data : {
							'name':name,
							'product_name':product_name,
							'email':email,
							'telphone':telphone,
							'message':message,
							'security_token':token,
							'captcha':captcha,
							'id':id,
						   },
					dataType : 'json',				
					beforeSend:function(){
						$('.loading').show().css({'left':'33%','position':'relative','top':'10%','width':'30%','z-index':'9999'});
						$('.product_message').html('');
						$('.product_error').html('');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						if(xhr.status==403) {
							$('.loading').hide();
							$('.product_error').html('<h4 style="margin-bottom: 25px;color:#ff0000;">This article contains basic troubleshooting instructions for 403 Forbidden errors.</h4>');
						}
					  },					
					success:function(dataType) {
						$('.loading').hide();
					 if(dataType.status == 1){
						   $('.product_message').html('<h4 class="alert alert-success" style="margin-bottom: 25px;">'+dataType.message+'</h4>').fadeOut(3000);
						   $('.product_form').show();
						   $('.product_form')[0].reset();
						   $('input[name=security_token]').val(dataType.token);
						   $('.product_form .captcha_image').html(dataType.captcha);
						   
						   
					 }else{						 
						 $('.product_error').html('<h4 class="subscribe-title" style="margin-bottom: 25px;color:#ff0000;">'+dataType.message+'</h4>').fadeTo(300, 1);
						 $('.product_form').show();
						 $('input[name=security_token]').val(dataType.token);						 
						 $('.product_form .captcha_image').html(dataType.captcha);
					 }
			       
					}			
			}) }, 2000);	
		});	
		
	$('#quote_form').on('show.bs.modal', function (e) {
       $('.quote_message').html('');
       $('.quote_error').html('');
	   $('.quote_form')[0].reset();
	});
	
	
	$('#product_enquiry_model').on('shown.bs.modal', function (e) {
       $('.product_message').html('');
       $('.product_error').html('');
	   $('.product_form')[0].reset();
	});
		
	$('#mail_model').on('show.bs.modal', function (e) {
       $('.contact_message').html('');
       $('.contact_error').html('');
	   $('.contact_form')[0].reset();
	});
	
	$(".extra_icon a").mouseover(function() { 
		var src = $(this).data("alt-src");
		var img = $(this).find('img');
		if(src){
			$(img).attr("src", src);
		}					
	});
	$(".extra_icon a").mouseout(function() {
		var src = $(this).data("main-src");
		var img = $(this).find('img');
		if(src){
			$(img).attr("src", src);
		}
	});
	
	
	/* Newsletter */
	
	$('.subscribe_email_form').on("click", function (event) {

        // Stop form from submitting normally
        event.preventDefault();
        // Get some values from elements on the page:
            var email 			= $.trim($('input[name=subscriber_email]').val());
  
            var token 			= $.trim($('input[name=security_token]').val());
            
 
			$('.loading_1').show().css({'left':'2%','position':'relative','top':'10%','width':'15%','z-index':'9999'});
			setTimeout(function(){ 
			
			$.ajax({
				
					async : false,
					url : '/subscribe',
					type : "POST",
					data : {
							'email':email,
							'security_token':token,
						   },
					dataType : 'json',				
					beforeSend:function(){
						$('.loading_1').show().css({'left':'2%','position':'relative','top':'10%','width':'15%','z-index':'9999'});
						$('.newsletter_message').html('');
						$('.newsletter_error').html('');
					},
					error: function (xhr, ajaxOptions, thrownError) {
						if(xhr.status==403) {
							$('.loading_1').hide();
							$('.newsletter_error').html('<h4 style="margin-bottom: 25px;color:#ff0000;">This article contains basic troubleshooting instructions for 403 Forbidden errors.</h4>');
						}
					  },					
					success:function(dataType) {
						$('.loading_1').hide();
					 if(dataType.status == 1){
						   $('.newsletter_message').html('<h4 class="alert alert-success" style="margin-bottom: 25px;">'+dataType.message+'</h4>').fadeOut(3000);
						   $('input[name=security_token]').val(dataType.token);   
					 }else{						 
						 $('.newsletter_error').html('<h4 class="subscribe-title" style="margin-bottom: 25px;color:#ff0000;">'+dataType.message+'</h4>').fadeTo(300, 1); 
						 $('input[name=security_token]').val(dataType.token);						 
					 }
			       
					}			
			}) }, 3000);	
		});	
		
				
});