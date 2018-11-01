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
        <?php echo $path; ?> </div>
        </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
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
