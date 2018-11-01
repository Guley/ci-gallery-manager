<button id="media_library" class="hide"></button>

<!-- Delete File -->
<div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modal_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modal_label">.</h4>
      </div>
      <div class="modal-body">.</div>
      <div class="modal-footer">
         <button type="button" class="btn btn-default" data-dismiss="modal">
			<?php echo 'Cancel'; ?>
		 </button>
         <button type="button" class="btn btn-primary" id="confirm-modal-submit">
			<?php echo 'Yes'; ?>
		 </button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade bs-gallery-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"> Files </h4>
      </div>
      <div class="modal-body">
		<div class="panel with-nav-tabs panel-default">	
			<div data-gallery-id="togglable-tabs" role="tabpanel" class="">
			
			  <div class="panel-heading">
				<ul role="tablist" class="nav nav-tabs bar_tabs" id="myTab">
				
					<li class="active" role="presentation"><a aria-expanded="false" data-toggle="tab" id="profile-tab" role="tab" href="#tab_content2"> Select File </a> </li>
				
					<li class="" role="presentation"><a aria-expanded="true" data-toggle="tab" role="tab" id="home-tab" href="#tab_content1"> Upload File </a> </li>
					
				</ul>
			 </div>
			 
			 <div class="spinner_gallery" style="display:none;">
				<div class="bounce1"></div>
				<div class="bounce2"></div>
				<div class="bounce3"></div>
			 </div>
			 
		<div class="tab-content" id="myTabContent">
		
			<div aria-labelledby="home-tab" id="tab_content1" class="tab-pane fade" role="tabpanel">
							
				<div class="upload-files">
				
					<div class="upload-detail">	
						 <div style='height: 0px;width: 0px; overflow:hidden;'>
							<input id="fileupload" type="file" value="upload"  name="files" accept=".jpg,.jpeg,.png,.gif,.pdf,.docx" />
						 </div> 
						 <a href="javascript:;" onclick="getFile()" title="Select Files" class="btn btn-primary"> Select Files </a>
						<small class="clearfix"> 
							Files formats allowed: jpg, jpeg, gif & png,pdf,docx
						</small>
						<div class="upload_error"></div>	
				  </div>
				  
                </div>  
				
			</div>
			
		  <div aria-labelledby="profile-tab" class="tab-pane fade active in" role="tabpanel" id="tab_content2">
			 <div class="row">
		        <div class="col-md-6 col-sm-6 col-xs-12">
					<div class="gallery-img-list">					
						<?php echo $select_box; ?>
						<input type="hidden" id="search_keyword" class="form-control" placeholder="Search"/>
                        <div class="add-gallery-col">
							<ul id="appenNewImage">
							</ul>
                            </div>
							<input type="hidden" value="" id="imageName" />
							<input type="hidden" value="" id="extension_name" />
							<div id= "pagination" class="pagination-col text-center">					
						</div>
					</div>
			  </div>
			  
			  <div class="col-md-6 col-sm-6 col-xs-12">
			     <div class="gallery-img-list-detail ">	
					 <div class="row">
						 <div class="col-md-6 col-sm-6 col-xs-6"> 
							<div class="thumbnail1" id="showSinglePic"> </div>
						 </div>
						<div class="col-md-6 col-sm-6 col-xs-6">
							<p class="filename"   id="showSinglePicName"></p>
							<p class="uploaded"   id="showSinglePicDate"></p>
							<p class="dimensions" id="showSinglePicSize"></p>
						</div>
					</div>
					<div class="row" id="showtitle" style="display:none;">
						<div class="col-md-12">
							<div class="form-group">
								<span id="done" class="text-success" style="display:none;"> Successfully update title </span>
								<span id="done_delete" class="text-success" style="display:none;"> Successfully delete file </span>
								<span id="done_falied" class="text-danger" style="display:none;"> Failed delete file </span>
								
							</div>
								
							<div class="form-group">
								<label data-setting="title" class="setting"> Title </label>
								<input type="text" placeholder="Type Title here" value="" id="imgTitle"  class="form-control">
							</div>
							
							<div class="form-group">
								<button type="button" class="btn btn-primary" onclick="updateTitle();"> Update</button>
								<button type="button" class="btn btn-danger" onclick="deleteFile();"> Delete </button>
								<input type="hidden" value="" id="boxId" />
								<input type="hidden" value="" id="imageId" />		 
								<input type="button" value="Pick File" onclick="pickImage()" id="pickImage" class="btn btn-success pull-right"  />
							</div>
												
						</div>
					</div>
										 
                </div>    
				
			</div> 
		</div>
		<!--<select id="imagePath" class="pull-right btn btn-default">
				 <option value="orignal">Orignal</option>
				 <option value="extra-large">Extra Large</option>
				 <option value="large">Large</option>
				 <option value="medium">Medium</option>
				 <option value="small">Small</option>
				 </select> -->
			  </div>	  
		</div>
      </div>
    </div>
  </div>
</div>

<input type="hidden" value="1" id="page_no" />

<script src="<?php echo CDN_DOMAIN.'assets/js/jquery.ui.widget.js'; ?>"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo CDN_DOMAIN.'assets/js/jquery.iframe-transport.js'; ?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo CDN_DOMAIN.'assets/js/jquery.fileupload.js'; ?>"></script>
<script>
function getFile(){
	   document.getElementById("fileupload").click();
	 }
	 function openGallery(no,called_by){
		$('#boxId').val(no);
		$('#target').val(called_by);
		
        //setTimeout(function(){ adjust_popup_height(); }, 1000);
        
          //adjust_popup_height();
	}
    
    // get Equal height
/*function adjust_popup_height() {
    var gallery_list = $(".gallery-img-list");
    var gallery_list_height = gallery_list.height();
    var gallery_detail  = $(".gallery-img-list-detail");
    var gallery_detail_height  = gallery_detail.height();
    
    if(gallery_list.height() > gallery_detail.height()){
           gallery_detail.height(gallery_list_height);
     } else {
           gallery_list.height(gallery_detail_height);
     }
}
*/
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
		var url = "<?php echo  base_url("upload/save_image/") ; ?>";
		$('#fileupload').fileupload({
        url: url,
        dataType: 'json',
		add: function(e, data) {
			var uploadErrors = [];
			var ext = '';
			ext = data.originalFiles[0]['type'];
			if($.inArray(ext, ['image/gif','image/png','image/jpg','image/jpeg','application/pdf','application/vnd.openxmlformats-officedocument.wordprocessingml.document']) == -1) {
				uploadErrors.push('Not an accepted file type');
			}
			if(data.originalFiles[0]['size'].length && data.originalFiles[0]['size'] > 5000000) {
				uploadErrors.push('Filesize is too big');
			}
			if(uploadErrors.length > 0) {
				alert(uploadErrors.join("\n"));
			} else {
				data.submit();
			}
	 },	 
        done: function (e, data) {
			$('.upload_error').html('');
            $.each(data.result.files, function (index, file) {
				
				if(file.error){
					$('.spinner_gallery').hide();
					$('.upload_error').html(file.error).css({'color':'#e50017'});
				}else{
				//	$('#profile_pic_hide').html('');
				//	$('#subfile4').val(file.name);
				var imgName		  = "'"+file.name+"'";
					var url			= '<?php echo site_url('upload/update_image'); ?>';
					$.ajax({
									async : false,
									url : url,
									type : "POST",
									data : {'image' : file.name,'type' : categoryType,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
									dataType : 'text',
									timeout : 1000,
									error:function(){
									   alert('Error!');
									},
									success:function(dataType) {	
                                  
									if(dataType!='1'){
									var obj				    = jQuery.parseJSON(dataType);
									var imgName				= obj.file_name+obj.file_extension;
									var date				= "<?php echo date('F,d Y') ; ?>";
									var path				= imgName;
									
									var imgWidth			= obj.image_width;
									var imgHeight			= obj.image_height;
									var imgId				= obj.id;
									
							if(obj.file_extension == '.pdf'){
								var path1 = "<?php echo CDN_DOMAIN."uploads/pdf_large_icon.png"; ?>";
							}else if(obj.file_extension == '.docx'){
								var path1 = "<?php echo CDN_DOMAIN."uploads/docx_large_icon.png"; ?>";
							}
							else{
								if(imgWidth == 48 || imgHeight == 48){
									var path1 = "<?php echo CDN_DOMAIN.'uploads/gallery/orignal'; ?>/"+obj.thumb_path;
								}else{
									var path1 = "<?php echo CDN_DOMAIN.'uploads/gallery/small'; ?>/"+obj.thumb_path;
								}
								
							}			
								
						$('.deselectBox').removeClass('selected-box');
						$('#appenNewImage').prepend(' <li class="deselectBox selected-box" id="selctedBox_'+imgId+'" ><a href="javascript:;" onclick="selectThisImage('+imgId+')" ><input type="hidden" id="path_'+imgId+'" value="'+path+'" /><input type="hidden" id="width_'+imgId+'" value="'+imgWidth+'" /><input type="hidden" id="height_'+imgId+'" value="'+imgHeight+'" /><input type="hidden" id="date_'+imgId+'" value="'+date+'" /><input type="hidden" id="name_'+imgId+'" value="'+imgName+'" /><img src="'+path1+'" /></a><a title="" href="javascript:;" class="check" ><div class="media-modal-icon"></div></a></li>');
				
		
		$('#showtitle').show();
		$('#done').hide();
		$('#showSinglePic').html('');

		$('#showSinglePic').html('<img draggable="false" src="'+path1+'"  class="img-thumbnail" />');
		$('#showSinglePicName').html('');
		$('#showSinglePicName').html(imgName);
		$('#showSinglePicDate').html('');
		$('#showSinglePicDate').html(date);
		$('#imageName').val(path);
		$('#extension_name').val(obj.file_extension);
		$('#imageId').val(imgId);
		$('#pickImage').removeAttr('disabled');
		
		$('#showSinglePicSize').html('');
		
		if(obj.file_extension == '.pdf' || obj.file_extension == '.docx'){
			$('#showSinglePicSize').html();
		}else{
			$('#showSinglePicSize').html('Dimension: '+imgWidth+' px '+' x '+imgHeight+' px ');
		}	
		
		$('.spinner_gallery').hide();
		//$('#browse1').click();
		$('.nav-tabs a:first').tab('show'); 
		}
		else {
		$('.spinner_gallery').hide();
			alert("Error: Please upload only jpg ,png ,gif images and pdf ,docx files");			
		}
      
	}
	}); 
  }	
});

}/* ,
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
			if(progress>=99)
			{
				$('#progress').hide();
			}
        } */
	
    }).on('fileuploadprogressall', function (e, data) {
		$('.spinner_gallery').show().css({'position':'absolute','left':'45%','top':'45%','z-index':'9999'});
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
		
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
		
		
});


function selectThisImage(id)
	{
		var imgName				= $('#name_'+id).val();
		var extension			= $('#extension_'+id).val();
		var date				= $('#date_'+id).val();
		var imgWidth			= $('#width_'+id).val();
		var imgHeight			= $('#height_'+id).val();
		var title				= $('#title_'+id).val();
		$('.deselectBox').removeClass('selected-box');
		$('#selctedBox_'+id).addClass('selected-box');
		$('#showSinglePic').html('');
		if(extension == '.pdf'){
			$('#showSinglePic').html('<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/pdf_large_icon.png"; ?>" />');
		}else if(extension == '.docx'){
			$('#showSinglePic').html('<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/docx_large_icon.png"; ?>" />');
		}
		else{
			if(imgWidth == 48 || imgHeight == 48){
				$('#showSinglePic').html('<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName+'"  class="img-thumbnail"/>');
			}else{
				$('#showSinglePic').html('<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/gallery/small"; ?>/'+imgName+'"  class="img-thumbnail"/>');
			}
			
		}
	
		$('#showSinglePicName').html('');
		$('#showSinglePicName').html(imgName);
		$('#showSinglePicDate').html('');
		$('#showSinglePicDate').html(date);
		$('#imageName').val(imgName);
		$('#extension_name').val(extension);
		$('#imgTitle').val(title);
		$('#imageId').val(id);
		$('#pickImage').removeAttr('disabled');
		$('#showtitle').show();
		$('#done').hide();
		$('#showSinglePicSize').html('');
		
		if(extension == '.pdf' || extension == '.docx'){
			$('#showSinglePicSize').html();
		}else{
			$('#showSinglePicSize').html('Dimension: '+imgWidth+' px ' + ' x '+imgHeight+' px ');
		}	
	}
	function pickImage(){
		
		var target 		= $('#target').val();
		var imgName		= $('#imageName').val();
		var imageId		= $('#imageId').val();
		var imagePath	= $('#imagePath').val();
		var ext			= $('#extension_name').val();
		var no 			= $('#boxId').val();
		
		if(target == 'ckeditor'){
			var oEditor = CKEDITOR.instances.description;
				
			if(ext == '.pdf'){
				var html = '<a href="<?php echo CDN_DOMAIN."uploads/gallery/orignal"
				?>/'+imgName+'"><img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/pdf_icon.png"; ?>" /></a>';
				}else if(ext == '.docx'){
					var html = '<a href="<?php echo CDN_DOMAIN."uploads/gallery/orignal"
				?>/'+imgName+'"><img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/docx_icon.png"; ?>" /></a>';
				}else{
					var html = '<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName+'" />';
				}			
			
			var newElement = CKEDITOR.dom.element.createFromHtml( html, oEditor.document );
			oEditor.insertElement( newElement );
			$('.deselectBox').removeClass('selected-box');
			$('.close').click();
			
		}else if(target == 'ckeditor_link'){
			
			if(ext == '.pdf'){
				var html = '<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName;
			}else if(ext == '.docx'){
				var html = '<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName;
			}else{
				var html = '<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName;
			}			
			
			var oEditor = CKEDITOR.currentInstance.name;  
			
			
			$('.cke_editor_'+oEditor+'_dialog').show();
			$('.cke_dialog_background_cover').show();
			
			
			var d = CKEDITOR.dialog.getCurrent();
            d.setValueOf('info', 'url', html);
      
					
			$('.deselectBox').removeClass('selected-box');
			$('.close').click();
		} 
		else if(target == 'mutli_images'){
			
			var no = $('#boxId').val();
			if(ext == '.pdf'){
				$('.error_gallery_'+no).html('<td colspan="2">PDF file is not allow in multi images.</td>').css({"color":"#e50017"});
			}else if(ext == '.docx'){
				$('.error_gallery_'+no).html('<td colspan="2">DOCX file is not allow in multi images.</td>').css({"color":"#e50017"});
			}else{
				$('.error_gallery_'+no).html('');
				$('.multi_target_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/small"; ?>/'+imgName+'" /><input type="hidden" name="gid[]" value ="'+imageId+'" />');
			}
			
			$('.deselectBox').removeClass('selected-box');
			$('.close').click();
		}
		else if(target == 'mutli_related'){
			
			var no = $('#boxId').val();
			if(ext == '.pdf'){
				
				$('.error_related_'+no).html('');
				$('.multi_related_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/pdf_icon.png"; ?>" /><input type="hidden" name="rid[]" value ="'+imageId+'" />');
			}else if(ext == '.docx'){
				$('.error_related_'+no).html('');
				$('.multi_related_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/docx_icon.png"; ?>" /><input type="hidden" name="gid[]" value ="'+imageId+'" />')
			}
			else{
				$('.error_related_'+no).html('');
				$('.error_related_'+no).html('<td colspan="2">Images is not allow in related documents.</td>').css({"color":"#e50017"});
			}
			
			$('.deselectBox').removeClass('selected-box');
			$('.close').click();
		}
		else if(target == 'icon'){
				var no 		= $('#boxId').val();
				var max_width  = $('#width_'+imageId).val();
				var max_height = $('#height_'+imageId).val();
						
				if(max_width == 48 && max_height == 48){
					
					$('#icon_id_'+no).val(imageId);
					$('#pick_image_path_'+no).val(imagePath);
					$('#icon_path_'+no).val(imgName);
				
					var extension = imgName.split('.').pop();
					if(extension == 'png'){
					$('#icon_print_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName+'" />');
					}else{
					$('.error_icon_id').html('');
					$('.error_icon_id').html('<p>Only PNG format is allow in icon.</p>').css({"color":"#e50017","clear":"both"});
					}
				}else{
					$('.error_icon_id').html('');
					$('.error_icon_id').html('<p>Only PNG format and 48x48 is allow in icon.</p>').css({"color":"#e50017","clear":"both"});
				}	
				$('.deselectBox').removeClass('selected-box');
				$('.close').click();
				
		}
		else if(target == 'icon_hover'){
				var no 			= $('#boxId').val();
				var max_width  	= $('#width_'+imageId).val();
				var max_height 	= $('#height_'+imageId).val();
						
				if(max_width == 48 && max_height == 48){
					
					$('#icon_hover_id_'+no).val(imageId);
					$('#pick_image_path_'+no).val(imagePath);
					$('#icon_path_hover_'+no).val(imgName);
				
					var extension = imgName.split('.').pop();
					if(extension == 'png'){
					$('#icon_print_hover_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/'+imgName+'" />');
					}else{
					$('.error_icon_hover_id').html('');
					$('.error_icon_hover_id').html('<p>Only PNG format is allow in icon.</p>').css({"color":"#e50017","clear":"both"});
					}
				}else{
					$('.error_icon_hover_id').html('');
					$('.error_icon_hover_id').html('<p>Only PNG format and 48x48 is allow in icon.</p>').css({"color":"#e50017","clear":"both"});
				}	
				$('.deselectBox').removeClass('selected-box');
				$('.close').click();
				
		}
		else{
			if(imgName!=''){
				var no 		= $('#boxId').val();
				$('#image_id_'+no).val(imageId);
				$('#pick_image_path_'+no).val(imagePath);
				$('#thumb_path_'+no).val(imgName);
				
				if(ext == '.pdf'){
				$('#image_print_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/pdf_icon.png"; ?>" />');
				}else if(ext == '.docx'){
					$('#image_print_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/docx_icon.png"; ?>" />');
				}else{
					$('#image_print_'+no).html('<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/small"; ?>/'+imgName+'" />');
				}
			
				
				$('.deselectBox').removeClass('selected-box');
				$('.close').click();
			 }
		}
		
		
	}
	
	function updateTitle(){
		
		var url	= '<?php echo site_url('upload/update_image_title'); ?>';
		
		var title = $('#imgTitle').val();
		var id	  = $('#imageId').val();
			$.ajax({
						async : false,
						url : url,
						type : "POST",
						data : {'title' : title,'id' : id,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
						dataType : 'text',
						timeout : 1000,
						error:function(){
						   alert('Error!');
						},
						success:function(dataType) {
							$('#title_'+id).val(title);	
							$('#done').hide();								
							$('#done').show().fadeOut(5000);							
						}
				}); 
	}
	
	function deleteFile(){
		var ImagesID = [];
		var multi_pic = [];
		var target = $('#target').val();
		multi_pic =  $("input[name='gid[]']")
			  .map(function(){return $(this).val();}).get();
	    ImagesID = $("input[name='rid[]']")
				  .map(function(){return $(this).val();}).get();
		var main_image = $('#image_id_1').val();				  
		var icon_image = $('#icon_id_1').val();				  
		var imageId = $('#imageId').val();		
	
			var flag = 0;
			if(main_image == imageId || icon_image == imageId){
				flag =1;
			}if($.inArray(imageId,multi_pic) !== -1){	
				flag =1;
			}if($.inArray(imageId,ImagesID) !== -1){	
				flag =1;
			}
			if(flag==1){
				 	
				$('#imagesModal .modal-title').html('<p>File in Use</p>');
				$("#imagesModal").modal().css({'top':'12%','z-index':'9999'});
				$('#imagesModal .modal-header').removeClass( "modal-header-success" ).addClass('modal-header-danger');
				$('#imagesModal .modal-body .files_exist_already').html('<p>This file already use in current page!</p>');	
				$('#imagesModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
				return false;
			}
		var timer = false;
		$('#imagesModal .modal-header').removeClass( "modal-header-success modal-header-danger");
		
		var url	= '<?php echo site_url('upload/delete_file'); ?>';
		var id	= $('#imageId').val();
		$("#imagesModal").modal().css({'top':'12%','z-index':'9999'});
		$('#imagesModal .modal-title').html('Delete File');
        $('#imagesModal .modal-body .files_exist_already').html('<p>Do you really want delete file?</p>');		
		
        $('#imagesModal .modal-footer').html('<button type="button" class="btn btn-danger" data-dismiss="modal" id="confirm-modal-submit">Yes</button><button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
		$('#confirm-modal-submit').click(function() {
			spinnerImageLoading(timer);
				setTimeout(function(){ 
				 $('.spinner_image_delete').hide();
				 $.ajax({
					async : false,
					url : url,
					type : "POST",
					data : {'id' : id,'<?php echo $this->security->get_csrf_token_name();?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
					dataType : 'json',
					timeout : 1000,
					
					beforeSend:function(){
						$('#imagesModal .modal-header').removeClass( "modal-header-success modal-header-danger" );
					},
			
					error:function(){
						$('#done_falied').show();
					},
					success:function(dataType) {
						if(dataType.status == 1){
							dataResult = '';	
							$('#imagesModal .modal-title').html('<p>File in Use</p>');
							$("#imagesModal").modal().css({'top':'12%','z-index':'9999'});
							$('#imagesModal .modal-header').removeClass( "modal-header-success" ).addClass('modal-header-danger');
							
							dataResult = '<p class="text-danger text-center">'+dataType.message+'</p>';
							dataResult += '<div class="clearfix"></div>';
							dataResult += '<div class="col-md-12">';
							dataResult += '<div class="col-md-3">';
							dataResult += dataType.url;
							dataResult += '</div>';
							dataResult += '<div class="col-md-9">';
							$.each(dataType.section,function(key,value){
								dataResult +=value+'<br/>';
							});
							
							
							dataResult += '</div>';
							dataResult += '</div>';
							dataResult += '<div class="clearfix"></div>';
							$(".files_exist_already").html(dataResult);
							$('#imagesModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
							
						}else if(dataType.status == 2){	
							$('#imagesModal .modal-title').html('<p>File Delete</p>');	
							$('#imagesModal .modal-header').removeClass( "modal-header-danger" ).addClass('modal-header-success');	
							dataResult = '';
							dataResult = '<p>'+dataType.message+'</p>';							
							$(".files_exist_already").html(dataResult);
							$('#imagesModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
							$("#media_library").click();
							
							//$('#thisdiv').load(window.top.location.href +  ' #thisdiv');
						}else{
							$('#imagesModal .modal-title').html('<p>File Delete</p>');
							$('#imagesModal .modal-header').removeClass( "modal-header-success" ).addClass('modal-header-danger');								
							dataResult = '';
							dataResult = '<p class="text-center">'+dataType.message+'</p>';							
							$(".files_exist_already").html(dataResult);
							$('#imagesModal .modal-footer').html('<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
						}
						$('.gallery-img-list-detail').html('');
					}
				});		
				}, 1000);
 
		});		
	}
	
	function spinnerImageLoading(timer){
		$('.spinner_image_delete').show().css({'text-align':'center','line-height':'143px'});
		$('.files_exist_already').html('');
		$('#imagesModal .modal-title').html('Deleting File ...');
		$('#imagesModal .modal-footer').html('');
		return timer;
	}
	
	
	
	$(document).ready(function() {
		//console.log(window.top.location.href);
			var SITE_URL		= "<?php echo CDN_DOMAIN."uploads/gallery/small"; ?>/";
				$("#media_library").click(function(e){
					e.preventDefault();
					
				var type 	= $("#type_value").val();
				var page 	= $("#page_no").val();
				var search 	= $("#search_keyword").val();
				var format  = formatType;
				
				  $.ajax({
					     beforeSend: function(){
						// Handle the beforeSend event
						$('#appenNewImage').fadeIn(900);
						$('.spinner_gallery').show().css({'position':'absolute','left':'20%','top':'45%','z-index':'9999'});
						},
							url: "<?php echo base_url('ajax_media/index'); ?>/"+type+"/"+format+"/"+page+"/"+search,
						})
				.done(function( msg ) {
					$('.spinner_gallery').hide();
					var output 	= '' ;
					var data   	= jQuery.parseJSON(msg);
					var inc12 	= 1;
					var incId  	= 0;
				$.each(data.output, function( key, obj ) {
					if(inc12==1){
						output +='<li class="deselectBox  selected-box" id="selctedBox_'+obj.id+'" >';
						incId = obj.id;
					}else{
						output +='<li class="deselectBox" id="selctedBox_'+obj.id+'" >';
					}	
					
					if(obj.image_width == 48 && obj.image_height == 48){
						SITE_URL		= "<?php echo CDN_DOMAIN."uploads/gallery/orignal"; ?>/";
					}else{
						SITE_URL = "<?php echo CDN_DOMAIN."uploads/gallery/small"; ?>/";
					}
				output +='<a href="javascript:;" onclick="selectThisImage('+obj.id+')" >';
				output +='<input type="hidden" id="width_'+obj.id+'" value="'+obj.image_width+'" />';
				output +='<input type="hidden" id="height_'+obj.id+'" value="'+obj.image_height+'" />';
				output +='<input type="hidden" id="date_'+obj.id+'" value="'+obj.created+'" />';
				output +='<input type="hidden" id="extension_'+obj.id+'" value="'+obj.file_extension+'" />';
				if(obj.file_extension == '.pdf' || obj.file_extension == '.docx'){
					output +='<input type="hidden" id="name_'+obj.id+'" value="'+obj.file_name+obj.file_extension+'" />';
				}else{
					output +='<input type="hidden" id="name_'+obj.id+'" value="'+obj.thumb_path+'" />';
				}
				
				output +='<input type="hidden" id="title_'+obj.id+'" value="'+obj.title+'" />';
				
				if(obj.file_extension == '.pdf'){
					output +='<img src="/uploads/pdf_icon.png" /></a>';
				}else if(obj.file_extension == '.docx'){
					output +='<img src="/uploads/docx_icon.png" /></a>';
				}else{
					output +='<img src="'+SITE_URL+obj.thumb_path+'" /></a>';
				}
				
				output +='<a title="" href="javascript:;" class="check" ><div class="media-modal-icon"></div></a></li>';
				inc12++;
		  });	
		
		
				$("#appenNewImage").html(output);
				if(incId!=0){
					selectThisImage(incId);
				}
				$("#pagination").html(data.pagination);
				$(".pagination-col ul li a").removeAttr("href").css("cursor","pointer");
				$('.pagination li a').click(function(e){
					var page = $(this).data('ci-pagination-page');
					$("#page_no").val(page);
					$("#media_library").click();
				});
				
				$('#page_dropdown').change(function(){
					var page = $(this).val();
					$("#page_no").val(page);
					$("#media_library").click();
				}); 
				
		    });
				return false;
		});
		
	$("#media_library").click();
	
    $('#type_value').change(function(){
        $("#page_no").val(1);
        $("#media_library").click();
    }); 
	
    $('#search_keyword').keyup(function(){
        $("#page_no").val(1);
        var value = $(this).val().length;
        $("#media_library").click();
    });  		
	$('.gallery_view').click(function(){
		$('.modal').modal('show');
		
	});	
	
	
	$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
		var target = $(e.target).attr("href") 
		// Activated tab
		if(target == '#tab_content1'){
			$('#pickImage').hide();
		}else{
			$('#pickImage').show();
		}
	});
	
	$('.modal').on('show.bs.modal', function (e) {
		$(".modal-lg").css({"padding-left":"4%"});
	});
});

</script>
