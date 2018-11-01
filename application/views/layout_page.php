<!-- header -->
<?php $this->load->view('inc/header'); ?>
<!-- page content -->
    <div class="right_col" role="main">
		<div class="">
		
			<div class="row">
                    <div class="col-md-12">
				<ol class="breadcrumb">
					  <li>
						<a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Dashboard </a>		  
					  </li>
					  <?php echo $breadcrumb; ?>
				</ol>
                </div>
			</div>
			
			<div class="page-title">
				<div class="title_left">
					<h3> <?php echo $icon; ?> <small> <?php echo $page_title; ?> </small> </h3>
				</div>			   
			</div>
			
			<div class="clearfix"></div>
			
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12">
					<div class="x_panel">
						
							<div class="col-md-offset-3 col-md-6 col-md-offset-3">
								<span class="error_falied text-center"></span>
							</div>	
						
							<div class="spinner" style="display:none;">
								<div class="bounce1"></div>
								<div class="bounce2"></div>
								<div class="bounce3"></div>
							</div>
						
							<div class="respones"></div>
								
							<!-- Files Modal -->
							<div id="imagesModal" class="modal fade" role="dialog">
							  <div class="modal-dialog">
								<!-- Modal content-->
								<div class="modal-content">
								  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title"> Files </h4>
								  </div>
								  <div class="modal-body">
								    <div class="files_exist_already"></div>
									<div class="spinner_image_delete" style="display:none;">
										<div class="bounce1"></div>
										<div class="bounce2"></div>
										<div class="bounce3"></div>
									</div>
								  </div>
								  <div class="modal-footer">
									
								  </div>
								</div>

							  </div>
							</div>
						
							<div class="x_content"> 
								<?php $this->load->view('notification'); ?>
								<?php $this->load->view($template_file); ?> 
							</div>
			  
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