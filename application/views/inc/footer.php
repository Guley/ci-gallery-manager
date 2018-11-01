<!-- footer content -->
        <footer>
        <div class="pull-left">Designed & Developed by <a href="http://gulshan.atspace.co.uk" target="_blank" title="Gulshan">Gulshan</a></div>
            <div class="pull-right copy-right">&copy; <?php echo date('Y'); ?> All Rights Reserved.</div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content --> 
    </div>
</div>
		<!-- jQuery --> 
		<script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script> 
		<script src="<?php echo base_url('assets/js/admin.js'); ?>"></script>
		<script>var SITE_URL = '<?php echo base_url(); ?>'; </script>
		<?php if(!empty($add_js)) {
			foreach($add_js as $jsval){
				echo '<script src="'.base_url('assets/js/'.$jsval.'.js').'"></script>';			
			}
		} ?>		
		<script>
			$(document).ready(function(){
				$('[data-toggle="tooltip"]').tooltip();
			});
		</script>
	</body>
</html>