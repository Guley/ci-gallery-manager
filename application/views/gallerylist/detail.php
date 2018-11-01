	<div class="form-group clearfix">
		<?php $label = array('class' => 'col-md-3 col-sm-3 col-xs-12'); ?>
		<?php echo form_label('Title','',$label);?>
		<div class="col-md-3 col-sm-3 col-xs-12"> 
			<?php echo $title; ?> 
		</div>
	</div>

	 <div class="form-group clearfix">
		<label class="control-label col-md-3 col-sm-3 col-xs-12"> Main Image </label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div id="image_print_1">
					<?php 
					$logo_image   = isset($thumb_path)?$thumb_path:'';
					if($logo_image!=''){ ?>
					<a href="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$logo_image; ?>" title="<?php echo $title; ?>" class="group2">
					<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/small/".$logo_image; ?>" />
					</a>
					<?php } else { ?>
						<img draggable="false" src="/uploads/no_image.png" class="img-thumbnail">
					<?php } ?>
			</div>
		</div>    
	</div>

	<?php 
	if(isset($feature_category) && $feature_category == 1) { ?>
		<div class="form-group clearfix">
			<?php $label = array('class' => 'control-label col-md-3 col-sm-3 col-xs-12'); ?>
			<?php echo form_label('Feature Category','',$label);?>
			<div class="col-md-3 col-sm-3 col-xs-12 "> 
				<?php echo ($feature_category == 1)?'Enable':''; ?> 
			</div>
		</div>


	 <div class="form-group feature_icon_1 clearfix">
		<label class=" col-md-offset-3 col-md-1 col-sm-3 col-xs-12"> Icon 1 </label>
		 <div class="col-md-3 col-sm-3 col-xs-12">
				<div id="icon_print_1">
					<?php 
					$icon_image   = isset($icon_path)?$icon_path:'';
					if($icon_image!=''){ ?>
					<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$icon_image; ?>" />
					<?php } else { ?>
						<img draggable="false" src="/uploads/no_image.png" class="img-thumbnail">
					<?php } ?>
				</div> 		
		</div>
	 </div>


		<div class="form-group feature_icon_2 clearfix">
			<label class="col-md-offset-3 col-md-1 col-sm-3 col-xs-12"> Icon 2 </label>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<div id="icon_print_hover_1">
					<?php 
					$icon_image_hover   = isset($icon_path_hover)?$icon_path_hover:'';
					if($icon_image_hover!=''){ ?>
					<img draggable="false" class="img-thumbnail" src="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$icon_image_hover; ?>" />
					<?php } else { ?>
						<img draggable="false" src="/uploads/no_image.png" class="img-thumbnail">
					<?php } ?>
				</div>
			</div>
		</div>


		<div class="form-group featured_title clearfix">
			<?php echo form_label('Title','',array('class' => 'col-md-offset-3 col-md-1 col-sm-3 col-xs-12')); ?>
			<div class="col-md-3 col-sm-3 col-xs-12 "> 
				<?php echo $featured_title; ?> 
			</div>
		</div>

	<?php } ?>

	<div class="form-group clearfix"> 
	<?php echo form_label('Sort Order','',$label);?>
		<div class="col-md-6 col-sm-6 col-xs-12"> 
			<?php echo $sort_order; ?> 
		</div>
	</div>
	
	<div class="form-group clearfix"> 
	<?php echo form_label('Meta Title','',$label);?>
		<div class="col-md-3 col-sm-3 col-xs-12"> 
			<?php echo $meta_title; ?> 
		</div>
	</div>
	<div class="form-group clearfix"> 
		<?php echo form_label('Meta Description','',$label); ?>
		<div class="col-md-3 col-sm-3 col-xs-12">
			<?php echo $meta_description; ?>
		</div>
	</div>
	
	<div class="form-group clearfix"> 
		<?php echo form_label('Meta keyword','',$label);?>
		<div class="col-md-3 col-sm-3 col-xs-12"> 
			<?php echo $meta_keyword; ?> 
		</div>
	</div>
	
	<div class="form-group clearfix">
		<?php echo form_label('Multi Galleries Images','',$label);?>
		
		<div class="table-responsive col-md-6 col-sm-6 col-xs-12">
			<table class="table table-bordered">
				<tr>
					<th>Title</th>
					<th>Sort Order</th>
					<th>Gallery</th>
				</tr>
				<?php if(!empty($gallery_options)){ 
						$i=3;
						foreach($gallery_options as $key => $options){ 
						$image   = isset($options['image'])?$options['image']:'';$gallery_option_id   = isset($options['gallery_option_id'])?$options['gallery_option_id']:'';
				?>
				<tr <?php echo ($key !=0)?'id="row_'.$options['mid'].'"':''; ?>>
					<td> <?php echo $options['title']; ?> </td>
					<td> <?php echo $options['sort_order']; ?> </td>
					<td colspan="2" class="img-browse-col">
						<?php if($image) { ?>
						<a href="<?php echo CDN_DOMAIN."uploads/gallery/orignal/".$image; ?>" title="<?php echo $options['title']; ?>" class="group2">
							<img draggable="false" src="<?php echo CDN_DOMAIN."uploads/gallery/small/".$image; ?>" />
						</a>	
						<?php }else{ ?>
						   <img draggable="false" src="/uploads/no_image.png" class="img-thumbnail">
						<?php } ?>
					</td>
				</tr>
				<?php $i++; } 
				}else { ?>
				<tr>
					<td></td>
					<td></td>
					<td colspan="2" class="img-browse-col">
					</td>
				</tr>
				<?php } ?>
			</table>
		</div>
	</div>
	
		<div class="form-group clearfix">
			<?php echo form_label('Date modified','',$label);?>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<?php echo $updated; ?>   last update by <?php echo $author; ?>
			</div>
		</div>
				
					
		<div class="form-group">
			<?php echo form_label('Status','',$label);?>
			<div class="col-md-3 col-sm-3 col-xs-12">			
				<?php 
				if(array_key_exists($status_selected,$status)){
					echo $status[$status_selected];
				} 
				?>		
			</div>
			<a href="<?php echo base_url('images/manage/'.$id); ?>" title="Gallery Edit"  data-toggle="tooltip" class="btn-sm btn-primary"> Edit</a>
		</div>
		
	<script>
		$(function(){
			$(".group2").colorbox({maxWidth:'90%'});
		});
	</script>	
