<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['rules'] = [
						'banner_form' => [
					                   "title"		 => "required|trim",
					                   "description" => "required|trim",
					                   "link" 		 => "trim|callback_link_check",
					                   "image_id" 	 => "required|trim|callback_valid_image",
					                   "sort_order"  => "required|trim|is_natural_no_zero|is_unique[lr_banner.sort_order]",
					                   "status" 	 => "required|trim",
									  ],
									  
						'solution_form' => [
					                   "title" 				=> "required|trim",
					                   "description" 		=> "required|trim",
					                   "image_id" 			=> "required|trim|callback_valid_image",
									   "feature_category" 	=> "",
									   "featured_title" 	=> "",
									   "icon_id" 			=> "",
									   "icon_hover_id" 		=> "",
					                   "sort_order" 		=> "required|trim|is_natural_no_zero|is_unique[lr_solutions.sort_order]",
									   "meta_title" 		=> "required|trim",
					                   "meta_keyword" 		=> "required|trim",
					                   "meta_description" 	=> "required|trim",
					                   "status" 			=> "required|trim",
					                   "multi_title" 		=> "required|trim",
					                   "multi_sort" 		=> "required|trim",
					                   "multi_pic" 			=> "required|trim",
					                   "solution_option_id" => "",
									  ],
									  
						'product_form' => [
					                   "title" 						=> "required|trim",
					                   "description" 				=> "required|trim",
									   "sku" 						=> "required|trim|callback_checksku",
					                   "feature_product" 			=> "callback_check_feature",
					                   "image_id" 					=> "required|trim|callback_valid_image",
					                   "category_id" 				=> "required|trim",
					                   "sort_order" 				=> "required|trim|is_natural_no_zero|is_unique[lr_products.sort_order]",
									   "meta_title" 				=> "required|trim",
					                   "meta_keyword" 				=> "required|trim",
					                   "meta_description" 			=> "required|trim",
					                   "status" 					=> "required|trim",
					                   "multi_title" 				=> "",
					                   "multi_sort" 				=> "",
					                   "multi_pic" 					=> "",
					                   "product_option_id" 			=> "",
									   "multi_related_title" 		=> "",
					                   "multi_related_sort" 		=> "",
					                   "multi_related_file" 		=> "",
					                   "product_related_option_id" 	=> "",
									   "multi_multimedia_title" 	=> "",
					                   "multi_multimedia_sort" 		=> "",
					                   "multi_multimedia_link" 		=> "",
					                   "product_multimedia_option_id" => "",
									  ],				  
									  
						'contact_form' => [		                   
					                   "message" 		=> "required|trim",
									   "name"			=> '',
									   "email"			=> '',
									  ],

						'gallery_form' => [
					                   "title" 				=> "required|trim",				         
					                   "image_id" 			=> "required|trim|callback_valid_image",
									   "feature_category" 	=> "",
									   "featured_title" 	=> "",
									   "icon_id" 			=> "",
									   "icon_hover_id" 		=> "",
					                   "sort_order" 		=> "required|trim|is_natural_no_zero|is_unique[lr_gallery.sort_order]",
									   "meta_title" 		=> "required|trim",
					                   "meta_keyword" 		=> "required|trim",
					                   "meta_description" 	=> "required|trim",
					                   "status" 			=> "required|trim",
					                   "multi_title" 		=> "",
					                   "multi_sort" 		=> "",
					                   "multi_pic" 			=> "",
					                   "gallery_option_id" => "",
									  ],									  
									  
						'user_form' => [
					                   "admin_firstname" 	=> "required|trim",
					                   "admin_lastname"  	=> "required|trim",
					                   "admin_email"    	=> "required|trim|valid_email|callback_user_check|is_unique[lr_admin.admin_email]",
					                   "admin_phone"     	=> "required|trim|callback_valid_phone",
					                   "image_id"        	=> "trim|callback_valid_image",									   
					                   "admin_password"     => "trim|required|min_length[8]|max_length[16]'",									   
					                   "confirm_password"   => "trim|required|callback_password_check",									   
					                   "status" 		    => "required|trim",
									  ],	

						'profile_form' => [
					                   "admin_firstname" 	=> "required|trim",
					                   "admin_lastname"  	=> "required|trim",
					                   "admin_email"    	=> "required|trim|valid_email|callback_user_check|is_unique[lr_admin.admin_email]",
					                   "admin_phone"     	=> "required|trim|callback_valid_phone",
					                   "image_id"        	=> "trim|callback_valid_image",									   
					                   "admin_password"     => "trim|required|min_length[8]|max_length[16]'",									   
					                   "confirm_password"   => "trim|required|callback_password_check",									  	                 
									  ],										  
						'menu_form' => [
					                   "title" => "required|trim",
					                   "menu_type" => "required|trim",
					                   "module_name" => "required|trim",
					                   "page_slug" => "required|trim",
					                   "nav_type" => "required|trim",
					                   "sort_order" => "required|trim|is_natural_no_zero|is_unique[lr_menus.sort_order]",
					                   "status" => "required|trim",
									  ],
						'content_form' => [
					                   "title" 			=> "required|trim",
					                   "description" 	=> "required|trim",
					                   "meta_title" 	=> "required|trim",
					                   "meta_keyword" 	=> "required|trim",
					                   "meta_description" => "required|trim",
					                   "status" => "required|trim",
									  ],
									  
					  'redirection_form' => [
									   "old_url" 		=> "required|trim|callback_link_check|is_unique[lr_redirection.old_url]",
									   "new_url" 		=> "required|trim|callback_link_check|is_unique[lr_redirection.new_url]",
									   "status" 		=> "required|trim",
									],
									  
						'news_form' => [
					                   "title" 			=> "required|trim",
					                   "description" 	=> "required|trim",
									   "date" 			=> "required|trim",
					                   "meta_title" 	=> "required|trim",
					                   "meta_keyword" 	=> "required|trim",
					                   "meta_description" => "required|trim",
					                   "sort_order" => "required|trim|is_natural_no_zero|is_unique[lr_news.sort_order]",
					                   "status" => "required|trim",
									  ],
					 			  
					 
					    'setting_general_form' => [
					                   "site_name" => "required|trim",
					                   "phone_no" => "required|trim",
					                   "linkdin_url" => "callback_link_check|trim",
					                   "twitter_url" => "callback_link_check|trim",
					                   "youtube_url" => "callback_link_check|trim",
									   "email" => "required|valid_email|trim",
					                   "contact" => "required|trim",
					                   "fax" => "required|trim",
					                   "product_info" => "required|trim",
					                   "seo_title" => "required|trim",
					                   "seo_description" => "required|trim",
					                   "seo_keyword" => "required|trim",
									   "link" 		 => "required|trim|callback_link_check",
					                   "image_id" 	 => "required|trim",
					                   "site_info" 	 => "required|trim",
					                   "site_info_link" => "required|trim|callback_link_check",
									  ],		
						'category_form' => [
					                   "title" => "required|trim|is_unique[lr_category.title]",
					                   "description" => "",
									   "image_id" => "required|trim|callback_valid_image",
									   "feature_category" 	=> "",
									   "featured_title" 	=> "",
									   "icon_id" 			=> "",
									   "icon_hover_id" 		=> "",
					                   "meta_title" => "required|trim",
					                   "meta_keyword" => "required|trim",
					                   "meta_description" => "required|trim",
					                   "sort_order" => "required|trim|is_natural_no_zero|is_unique[lr_category.sort_order]",
					                   "status" => "required|trim",
									  ],	

				
							'password_form' => [
					                   "admin_password" => "trim|required|min_length[8]",
									   "confirm_password" => "trim|required|callback_password_match"
									  ],
									  
							'testimonial_form' => [
					                   "title"		 => "required|trim",
					                   "description" => "required|trim",
					                   "author_name" => "required|trim",
					                   "image_id" 	 => "required|trim|callback_valid_image",
					                   "sort_order"  => "required|trim|is_natural_no_zero|is_unique[lr_testimonial.sort_order]",
					                   "status" => "required|trim",
									  ],		  

															  
                    ];
					
			$config['options'] =	[
										'status_options'  => [
															   ''  => 'Select Status',
															   '1' => 'Active',
															   '0' => 'InActive'
															],
										'account_options'  => [
															   ''  => 'Account Status',
															   '1' => 'Active',
															   '0' => 'InActive'
															],
															
										'feature_category' => [
																'all' 		=> 'Show All Categories',	
																'feature' 	=> 'Featured Categories Only',
																'exclude' 	=> 'Exclude Featured Categories',	
															  ],
										'feature_product' => [
																'all' 		=> 'Show All Products',	
																'feature' 	=> 'Featured Products Only',
																'exclude' 	=> 'Exclude Featured Products',	
															  ]															  
									];	
									
			/* Search error message */
			$config['message'] =	[
										'user_form'  	=> 'Not user found!',												   
										'banner_form'   => 'Not slide show found!',												   
										'content_form'  => 'Not static page found!',												   
										'menu_form'  	=> 'Not menu found!',												   
										'news_form'  	=> 'Not news found!',												   
										'solution_form' => 'Not solution found!',												   
										'gallery_form' => 'Not gallery found!',												   
										'contact_form' => 'Not contact found!',												   
										'redirection_form' => 'Not URl found!',												   
										'category_form' => 'Not category found!',												   
										'product_form' => 'Not product found!',												   
										'newsletter_form' => 'Not newsletter found!',												   
										'testimonial_form' => 'Not testimonial found!',												   
										'enquiry_form' => 'Not product enquiry found!',												   
									];	
		/* View media file according module. */
		$config['file_type'] = [
								'image' => ['image/jpeg','image/jpg','image/png','image/gif'],
								'document' => ['pdf','docx'],
							   ];
							   
	/* Feature count in category && product */
	  $config['feature_count'] = [
									'feature_category' => 4,
									'feature_product'  => 5,
								 ];	
			