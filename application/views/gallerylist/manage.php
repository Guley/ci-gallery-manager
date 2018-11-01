<?php 
		$attributes = array('class' => 'form-horizontal form-label-left','id' => 'gallery_form');
		echo form_open('',$attributes); ?>

<div class="form-group">
    <?php $label = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12'); ?>
    <?php echo form_label('Title <span class="required">*</span>','',$label);?>
    <div class="col-md-6 col-sm-6 col-xs-12"> <?php echo form_input($title); ?> <?php echo ($title['text-muted'])?'<small class="text-muted">'.$title['text-muted'].'</small>':''; ?> <span class="error_title"></span> </div>
</div>

 <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Main Image 
	<span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_content">
            <div class="input-group img-browse-col">
                <label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn" onclick="openGallery(1)"> <span class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> </label>
                <div id="image_print_1">
                    <?php 
					$logo_image   = isset($thumb_path)?$thumb_path:'';
					if($logo_image!=''){ ?>
                    <img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/small/".$logo_image; ?>"/>
                    <?php } else { ?>
                    <input type="text" class="form-control" placeholder="No Image Available" disabled="" >
                    <?php } ?>
                </div>
                <input type="hidden" name="thumb_path" id="thumb_path_1" value="<?php echo  isset($thumb_path)?$thumb_path:'';?>"/>
                <input type="hidden" name="logo" class="logo" id="image_id_1" value="<?php echo  isset($logo)?$logo:'';?>"/>
                <input type="hidden" name="ckeditor_button" id="ckeditor_button" onclick="openGallery(1,'ckeditor')" data-toggle="modal" data-target=".bs-gallery-modal-lg"/>
                <span class="text-danger" id="logoError"></span> </div>
        </div>
        <span class="error_image_id"></span> 
		<?php echo ($image_mute['text-muted'])?'<small class="text-muted">'.$image_mute['text-muted'].'</small>':''; ?>	
	</div>
</div>


	<div class="form-group">
		<?php $label = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12'); ?>
		<?php echo form_label('Feature Category','',$label);?>
		<div class="col-md-6 col-sm-6 col-xs-12 "> 
			<?php echo form_checkbox($featured_category); ?> 
			<?php echo ($featured_category['text-muted'])?'<small class="text-muted">'.$featured_category['text-muted'].'</small>':''; ?> 
			<span class="error_featured_category"></span> 
		</div>
	</div>


 <div class="form-group feature_icon_1" style="display:none;">
    <label class=" col-md-offset-3 col-md-1 col-sm-3 col-xs-12"> Icon 1
		<span class="required">*</span> </label>
	 <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_content">
            <div class="input-group img-browse-col">
                <label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn" onclick="openGallery(1,'icon')"> 
				<span class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> 
				</label>
                <div id="icon_print_1">
                    <?php 
					$icon_image   = isset($icon_path)?$icon_path:'';
					if($icon_image!=''){ ?>
                    <img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$icon_image; ?>" />
                    <?php } else { ?>
                    <input type="text" class="form-control" placeholder="No Icon Available" disabled="" />
                    <?php } ?>
                </div>
                <input type="hidden" name="icon_path" id="icon_path_1" value="<?php echo  isset($icon_image)?$icon_image:'';?>" />
                <input type="hidden" name="icon_path_id" class="logo" id="icon_id_1" value="<?php echo  isset($icon_path_id)?$icon_path_id:'';?>" />
               
                <span class="text-danger" id="logoError"></span> 
			</div>
        </div>
        
		<?php echo ($icon_mute['text-muted'])?'<small class="text-muted">'.$icon_mute['text-muted'].'</small>':''; ?>
		<span class="error_icon_id"></span> 
		
		</div>
</div>


<div class="form-group feature_icon_2" style="display:none;">
    <label class="col-md-offset-3 col-md-1 col-sm-3 col-xs-12"> Icon 2 
		<span class="required">*</span> </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_content">
            <div class="input-group img-browse-col">
                <label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn" onclick="openGallery(1,'icon_hover')"> 
				<span class="btn btn-primary">
				<i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> 
				</label>
                <div id="icon_print_hover_1">
                    <?php 
					$icon_image_hover   = isset($icon_path_hover)?$icon_path_hover:'';
					if($icon_image_hover!=''){ ?>
                    <img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$icon_image_hover; ?>" />
                    <?php } else { ?>
                    <input type="text" class="form-control" placeholder="No Icon  Available" disabled="" />
                    <?php } ?>
                </div>
                <input type="hidden" name="icon_path_hover" id="icon_path_hover_1" value="<?php echo  isset($icon_image_hover)?$icon_image_hover:'';?>" />
                <input type="hidden" name="icon_path_hover_id" class="logo" id="icon_hover_id_1" value="<?php echo  isset($icon_path_hover_id)?$icon_path_hover_id:'';?>" />
               
                <span class="text-danger" id="logoError"></span> 
			</div>
        </div>
        
		<?php echo ($icon_hover_mute['text-muted'])?'<small class="text-muted">'.$icon_hover_mute['text-muted'].'</small>':''; ?>
		<span class="error_icon_hover_id"></span> 	
		</div>
	</div>


	<div class="form-group featured_title" style="display:none;">
		<?php echo form_label('Title','',array('class' => 'col-md-offset-3 col-md-1 col-sm-3 col-xs-12')); ?>
		<div class="col-md-6 col-sm-6 col-xs-12 "> 
			<?php echo form_input($featured_title); ?> 
			<?php echo ($featured_title['text-muted'])?'<small class="text-muted">'.$featured_title['text-muted'].'</small>':''; ?> 
			<span class="error_featured_title"></span> 
		</div>
	</div>


	<div class="form-group"> 
	<?php echo form_label('Sort Order <span class="required">*</span>','',$label);?>
		<div class="col-md-6 col-sm-6 col-xs-12"> 
			<?php echo form_input($sort_order); ?> 
			<?php echo ($sort_order['text-muted'])?'<small class="text-muted">'.$sort_order['text-muted'].'</small>':''; ?> 
			<span class="error_sort_order"></span> 
		</div>
	</div>
<div class="form-group"> <?php echo form_label('Meta Title <span class="required">*</span>','',$label);?>
    <div class="col-md-6 col-sm-6 col-xs-12"> <?php echo form_input($meta_title); ?> <?php echo ($meta_title['text-muted'])?'<small class="text-muted">'.$meta_title['text-muted'].'</small>':''; ?> <span class="error_meta_title"></span> </div>
</div>
<div class="form-group"> <?php echo form_label('Meta Description <span class="required">*</span>','',$label);?>
    <div class="col-md-6 col-sm-6 col-xs-12"> <?php echo form_textarea($meta_description); ?> <?php echo ($meta_description['text-muted'])?'<small class="text-muted">'.$meta_description['text-muted'].'</small>':''; ?> <span class="error_meta_description"></span> </div>
</div>
<div class="form-group"> <?php echo form_label('Meta keyword <span class="required">*</span>','',$label);?>
    <div class="col-md-6 col-sm-6 col-xs-12"> <?php echo form_textarea($meta_keyword); ?> <?php echo ($meta_keyword['text-muted'])?'<small class="text-muted">'.$meta_keyword['text-muted'].'</small>':''; ?> <span class="error_meta_keyword"></span> </div>
</div>
<div class="form-group"> <?php echo form_label('Multi Galleries Images','',$label);?>
    <div class="table-responsive col-md-8 col-sm-8 col-xs-12">
        <table class="table" id="addBoxes">
            <tr>
                <th>Title</th>
                <th>Sort Order</th>
                <th>Gallery</th>
                <th><a href="javascript:;" class="btn btn-primary" title="Add New" onclick="addRow()"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </a></th>
            </tr>
            <?php if(!empty($gallery_options)){ 
					$i=3;
					foreach($gallery_options as $key => $options){ 
					$image   = isset($options['image'])?$options['image']:'';$gallery_option_id   = isset($options['gallery_option_id'])?$options['gallery_option_id']:'';
			?>
				<tr <?php echo ($key !=0)?'id="row_'.$options['mid'].'"':''; ?>>
                <td>
					<input type="text" name="multi_title[]" class="form-control multi_module" placeholder="Type image title" value="<?php echo $options['title']; ?>" />
                    <input type="hidden" name="gallery_option_id[]" value="<?php echo $gallery_option_id; ?>" />
                    <p class="error_multi_title_<?php echo $key; ?> <?php if($key != 0) { echo "title_multiple" ; }?>" id="title11_<?php echo $key; ?>" data-no="<?php echo $key; ?>"></p>
				</td>
                <td>
					<input type="number" name="sort[]" min = "1" class="form-control multi_module" value="<?php echo $options['sort_order']; ?>" />
					<p class="error_multi_sort_<?php echo $key; ?>" id="sort11_<?php echo $key; ?>">
					</p>
				</td>
                <td colspan="2" class="img-browse-col"><label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn" onclick="openGallery(<?php echo $key+1; ?>,'mutli_images')">
                    <span class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> <span class="multi_target_<?php echo $key+1; ?>">
					<?php if($image) { ?>
					<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/gallery/small/".$image; ?>" />
					<?php }else{ ?>
					   <img draggable="false" src="/uploads/no_image.png" class="img-thumbnail">
					<?php } ?>
                    <input type="hidden" name="gid[]" value="<?php echo $options['mid']; ?>" />
                    </span>
                    <p class="error_multi_pic_<?php echo $key; ?>" id="pic11_<?php echo $key; ?>"></p>
                    </label>
                    <input type="hidden" name="target" id="target" value=""/></td>
                <?php if($key != 0) { ?>
                <td><a href="javascript:;" class="btn btn-danger remove_link" title="Remove mutli image" > <i class="fa fa-minus" aria-hidden="true"></i> </a></td>
                <?php } ?>
            </tr>
            <tr class = "error_gallery_<?php echo $key+1; ?>"></tr>
            <?php $i++; } 
					}
					else { ?>
            <tr>
                <td><input type="text" name="multi_title[]" class="form-control multi_module" placeholder="Type image title" />
                    <input type="hidden" name="gallery_option_id[]" />
                    <p class="error_multi_title_0"></p></td>
                <td><input type="number" name="sort[]" min = "1" class="form-control multi_module" placeholder ="Sort Order" />
                    <p class="error_multi_sort_0"></p></td>
                <td colspan="2" class="img-browse-col">
					<label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn" onclick="openGallery(1,'mutli_images')"><span class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> <span class="multi_target_1"><input type="hidden" name="gid[]" value ="" />
					</span>
					</label>
					<p class="error_multi_pic_0"></p>
					<input type="hidden" name="target" id="target" value=""/>
				</td>
            </tr>
            <tr class = "error_gallery_1"></tr>
            <?php } ?>
        </table>
    </div>
</div>
<div class="form-group"> <?php echo form_label('Status <span class="required">*</span>','',$label);?>
    <div class="col-md-6 col-sm-6 col-xs-12"> <?php echo form_dropdown('status',$status,$status_selected,['class' =>"form-control" ,'id'=>"status"]); ?> <?php echo ($status_mute['text-muted'])?'<small class="text-muted">'.$status_mute['text-muted'].'</small>':''; ?> <span class="error_status"></span> </div>
</div>
<div class="form-group">
    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3"> <?php echo form_button($submit); ?> </div>
</div>
<?php echo form_close();?> 
<script>
$(document).ready(function(){
	info = {};
	
	if($("#featured_category").prop('checked') == true){
		$('.feature_icon_1').show();
		$('.feature_icon_2').show();	
		$('.featured_title').show();	
	}else{
		$('.feature_icon_1').hide();
		$('.feature_icon_2').hide();	
		$('.featured_title').hide();	
	}
	
    $(".save_button").click(function(){
		
		var title 				= $('#title').val();
		var image_id 			= $('#image_id_1').val();
		
		if($("#featured_category").prop('checked') == true){
			var icon_id 			= $('#icon_id_1').val();
			var icon_hover_id 		= $('#icon_hover_id_1').val();				
			var featured_title 		= $('#featured_title').val();				
		}
		
		var meta_title 			= $('#meta_title').val();
		var meta_keyword 		= $('#meta_keyword').val();
		var meta_description 	= $('#meta_description').val();
		var status 				= $('#status').val();
		var sort_orders 		= $('#sort_order').val();
		
		var multi_title 		=  $("input[name='multi_title[]']")
              .map(function(){return $(this).val();}).get();
			  
		var multi_sort 		=  $("input[name='sort[]']")
		  .map(function(){return $(this).val();}).get();
		  
		var multi_pic 		=  $("input[name='gid[]']")
		  .map(function(){return $(this).val();}).get();

		var gallery_option_id 		=  $("input[name='gallery_option_id[]']")
		  .map(function(){return $(this).val();}).get();

			if($("#featured_category").prop('checked') == true){
				
				var info = {
							'title': title,
							'image_id':image_id,
							'image_id':image_id,
							'feature_category':1,
							'featured_title':featured_title,
							'icon_id':icon_id,
							'icon_hover_id':icon_hover_id,
							'meta_title':meta_title,
							'meta_keyword':meta_keyword,
							'meta_description':meta_description,
							'status':status,
							'sort_order':sort_orders,
							'multi_title':multi_title,
							'multi_sort':multi_sort,
							'multi_pic':multi_pic,
							'gallery_option_id':gallery_option_id,
						};
			}else{
				var info = {
							'title': title,
							'image_id':image_id,
							'feature_category':2,
							'meta_title':meta_title,
							'meta_keyword':meta_keyword,
							'meta_description':meta_description,
							'status':status,
							'sort_order':sort_orders,
							'multi_title':multi_title,
							'multi_sort':multi_sort,
							'multi_pic':multi_pic,
							'gallery_option_id':gallery_option_id,
						};
			}	
		
		
	    $( ".respones" ).save({
			action: '<?php echo $method; ?>',
			<?php if($method == 'update'){ ?>
			id:'<?php echo $result_id; ?>',
			<?php } ?>
			field: info,
			url:"<?php echo site_url('images/method') ;?>",
			token:"<?php echo $this->security->get_csrf_token_name();?>",
			key:"<?php echo $this->security->get_csrf_hash(); ?>"
		});
	});	
});
	var inc					= 011; 
	
	var multi_title = <?php echo $gallery_options_count; ?>;
	var multi_sort  = <?php echo $gallery_options_count; ?>;
	var multi_pic   = <?php echo $gallery_options_count; ?>;
	
	function addRow(){
			inc++;
			$('#addBoxes').append('<tr id="row_'+inc+'"><td><input type="text" placeholder = "Type image title" name="multi_title[]"  class="form-control multi_module" /> <input type="hidden" name="gallery_option_id[]" /><p id="title11_'+inc+'" class="error_multi_title_'+(multi_title++)+' title_multiple" data-no="'+inc+'" ></p></td><td><input type="hidden" name="image_name[]" id="image_id_'+inc+'" /><input type="hidden" name="imgId[]"/><input type="number" min = "1" name="sort[]" class="form-control multi_module" placeholder="Sort Order"/><p class="error_multi_sort_'+(multi_sort++)+'" id="sort11_'+inc+'"></p><input type="hidden" name="valueId[]"/></td><td colspan="2" class="img-browse-col"><label data-toggle="modal" data-target=".bs-gallery-modal-lg" class="input-group-btn multi_gallery_images" onclick="openGallery('+inc+',\'mutli_images\')"><span class="btn btn-primary"><i class="fa fa-folder-open" aria-hidden="true"></i> Browse… </span> <span class="multi_target_'+inc+'"><input type="hidden" name="gid[]" value ="" /></span></label><p class="error_multi_pic_'+(multi_pic++)+' " id="pic11_'+inc+'"></p></td><td><a href="javascript:;" class="btn btn-danger remove_link" title="Remove multi images"><i class="fa fa-minus" aria-hidden="true"></i></a></td></tr><tr class = "error_gallery_'+inc+'"></tr>');
	}
	
	function update(id){ 
			var inc = 1;
			$("."+id).each(function(){
				var no = $(this).data('no');
				$("#title11_"+no).removeClass();
				$("#sort11_"+no).removeClass();
				$("#pic11_"+no).removeClass();
				$("#title11_"+no).addClass('title_multiple error_multi_title_'+inc);
				$("#sort11_"+no).addClass('error_multi_sort_'+inc);
				$("#pic11_"+no).addClass('error_multi_pic_'+inc);
				inc++;
			});
	}
	
	$(document).on('click', '.remove_link', function() {
		$(this).closest('tr').remove();
		update('title_multiple');
	});
	
	$('#featured_category').click(function() {
        if($(this).is(":checked")) {
           
            $(this).attr("checked", true);
			$('.feature_icon_1').show();
			$('.feature_icon_2').show();
			$('.featured_title').show();
        }else{
			$('.feature_icon_1').hide();
			$('.feature_icon_2').hide();
			$('.featured_title').hide();
		}
               
    });
	
var categoryType = "gallery";
var formatType   = 'image';
</script>
<?php $this->load->view('gallery/manage'); ?>
