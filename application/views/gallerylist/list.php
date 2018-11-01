<script>
page = '';
$(document).ready(function(){
	var page = $(".pagination li a").data('ci-pagination-page');

	page = (page)?page:1;
	info = [];
	var info = [
					'Title',
					'Image',
					'Status',					
					'Date Modified',
					'Edit',
				];		
		   $( ".x_content" ).search({
				columns:info,
				range:$('#reportrange span').text(),
				title:$('#title').val(),
				status:$('#status').val(),
				page:page,
				url:"<?php echo site_url('images/search') ;?>",
				token:"<?php echo $this->security->get_csrf_token_name();?>",
				key:"<?php echo $this->security->get_csrf_hash(); ?>"
			});
		
			$("#filter_search").bind('click',function(e){
				$(this).siblings().removeClass('active');
				$(this).addClass('active');
					
				page = (e.page)?e.page:page;
				$( ".x_content" ).search({
				columns:info,
				range:$('#reportrange span').text(),
				title:$('#title').val(),
				status:$('#status').val(),
		        page:page,
				url:"<?php echo site_url('images/search/') ;?>"+page,
				token:"<?php echo $this->security->get_csrf_token_name();?>",
				key:"<?php echo $this->security->get_csrf_hash(); ?>"
			   });
		    });	

			$(".x_content .pagination li a.active").bind("click",function(e){				
			    page = $(this).data('ci-pagination-page');
				$("#filter_search").trigger('click');
		});
		$(".group2").colorbox({maxWidth:'90%'});
});
</script>