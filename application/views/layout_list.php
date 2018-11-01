<!-- header -->
<?php $this->load->view('inc/header'); ?>
<!-- page content -->

<div class="right_col" role="main">
<div class="">
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard </a></li>
                <?php echo $breadcrumb; ?>
            </ol>
        </div>
    </div>
    <div class="row">
		<div class="page-title">
			<div class="title_left col-md-6 col-xs-12 col-sm-6">
				<h3> <?php echo $icon; ?> <small> <?php echo $page_title; ?> </small> </h3>
			</div>
			<?php echo $path; ?>

		
				<?php if(uri_string() == 'newsletter'){ ?>
					<div class="pull-right newsletter_btn">
						<a href="<?php echo base_url('newsletter/download'); ?>" title="Subscribe List" class="btn btn-primary"><span class="fa fa-file-excel-o"></span> Export</a>
					</div>
				<?php } ?>
			
		
		</div>
	
     </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row"> 
						<?php 
							$grid_column = '';
							if(uri_string() == 'category'){
								$grid_column = 'col-md-3 col-sm-3';
							}else if(uri_string() == 'product'){
								$grid_column = 'col-md-3 col-sm-3';
							}
							else if(uri_string() == 'user'){
								$grid_column = 'col-md-3 col-sm-3';
							}else{
								$grid_column = 'col-md-4 col-sm-4';
							}
							echo form_open('');
						?>
                        <div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <?php if($title && !empty($title)) { ?>
                            <?php echo form_input($title); ?>
                            <?php } ?>
                        </div>
						
					 <?php if(uri_string() == 'user'){ ?>
						<div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <?php 
								
								echo form_input(array(
									'type'  => 'text',
									'name'  => 'email',
									'id'    => 'email',
									'value' => '',
									'class' => 'form-control',
									'placeholder' => 'Search by email'
									));
							?>
                        </div>
						<?php } ?>
						
						<?php if(uri_string() == 'category'){ ?>
						<div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <?php 
								$feature_category = $this->config->item('options');
								echo form_dropdown('feature_category',$feature_category['feature_category'],'','class="form-control" id="feature_category"');
							?>
                        </div>
						<?php } ?>
						
						<?php if(uri_string() == 'product'){ ?>
						<div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <?php 
								$feature_product = $this->config->item('options');
								echo form_dropdown('feature_product',$feature_product['feature_product'],'','class="form-control" id="feature_product"');
							?>
                        </div>
						<?php } ?>
						
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <div id="reportrange" class="form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 100%;margin-bottom:11px;"> <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>&nbsp; <span></span> <b class="caret"></b> 
							</div>
							
                        </div>
						<?php if(uri_string() == 'contact'){ ?>
						<div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <div class="input-group"> 
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary" id="filter_search"> <i class="fa fa-search-plus"></i> Search </button>
								</span> 
							</div>
                        </div>
						<?php } ?>
						
						
					
					<?php if(!in_array(uri_string(),['contact','newsletter'])){ ?>
                        <div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <div class="input-group"> 
							<?php echo form_dropdown('status',$status,'','class="form-control" id="status"'); ?>
							<span class="input-group-btn">
                                <button type="button" class="btn btn-primary" id="filter_search"> <i class="fa fa-search-plus"></i> Search </button>
                                </span> 
							</div>
                        </div>
					<?php } ?>	
					
					<?php if(uri_string() == 'newsletter'){ ?>
					
					   <div class="<?php echo $grid_column; ?> col-xs-12 form-group">
                            <div class="input-group"> 
								<span class="input-group-btn">
									<button type="button" class="btn btn-primary" id="filter_search">  <i class="fa fa-search-plus"></i> Search </button>
                                </span> 
							</div>
                       </div>
						
					<?php } ?> 
						
                        <?php echo form_close(''); ?> </div>
                    <div class="clearfix"></div>
                </div>
                <div class="modal fade" id="confirm-modal" tabindex="-1" role="dialog" aria-labelledby="modal_label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="modal_label">.</h4>
                            </div>
                            <div class="modal-body">.</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo 'Cancel'; ?> </button>
                                <button type="button" class="btn btn-primary" id="confirm-modal-submit"> <?php echo 'Yes'; ?> </button>
                            </div>
                        </div>
                    </div>
                </div>

						<div class="spinner" style="display:none;">
							<div class="bounce1"></div>
							<div class="bounce2"></div>
							<div class="bounce3"></div>
						</div>
						<?php $this->load->view('notification'); ?>
						<div class="x_content table-responsive">
							<?php $this->load->view($template_file); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /page content --> 
<!-- footer -->
<?php $this->load->view('inc/footer'); ?>
