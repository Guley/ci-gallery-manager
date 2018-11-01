<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title><?php echo $page_title; ?></title>
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.min.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/daterangepicker.css');?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/admin.css')?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/colorbox.css')?>">
		<link href="<?php echo SITE_URL; ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
		<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="scroll-view">
						<div class="navbar nav_title" style="border: 0;"> 
							 <a href="<?php echo  base_url(); ?>" class="site_title"> 
								<img src="<?php echo  base_url('assets/images/gul.ico'); ?>" width="50" height="50" class="img-responsive" alt ="Gulshan" />
							 </a> 
						</div>
					<div class="clearfix"></div>
                
                <!-- Menu profile quick info --> 
				<div class="profile row">
                    <div class="profile_pic">
						
							<img src="<?php echo base_url('assets/images/user.png'); ?>"  alt="Admin picture" class="img-circle profile_img"/>
					</div>
                    <div class="profile_info"> 
						<span> Welcome, </span>
                        <h2>Gulshan Sharma</h2>
                    </div>
					
                </div>
				
                <!-- /Menu profile quick info --> 
                <!-- Sidebar Menu -->     
				<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
				  
                    <div class="menu_section">
                        <ul class="nav side-menu">
                            
							<li class="current-page">
								<a href="<?php echo base_url('images'); ?>"><i class="fa fa-file-image-o"></i> Gallery Management </a>
                       
                            </li>
							
				
							
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Top Navigation -->	
        <div class="right-container">
			<div class="top_nav">
				<div class="nav_menu">
					<nav>
						<div class="nav toggle"> 
							<a id="menu_toggle">
								<i class="fa fa-bars"></i>
							</a> 
						</div> 
					</nav>
				</div>
			</div>