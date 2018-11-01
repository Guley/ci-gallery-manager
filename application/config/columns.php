<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['columns'] = [
						'banner' => [
										 'l.banner_id',
										 'l.title',
										 'u.thumb_path as image_id',
										 'l.link',
										 'l.status',										 
										 'l.updated',
										 'l.author_id'
									],
									
						'solution' => [
										 'l.solution_id',
										 'l.title',
										 'u.thumb_path as image_id',
										 'l.status',
										 'l.updated',
										 'l.author_id'
									],	
						'gallery' => [
										 'l.gallery_id',
										 'l.title',
										 'u.thumb_path as image_id',
										 'l.status',
										 'l.updated',
										 'l.author_id'
									],
									
						'product' => [
										 'l.product_id',
										 'l.title',
										 'l.feature_product',
										 'u.thumb_path as image_id',
										 'l.status',
										 'l.updated',
										 'l.author_id'
									],			

						'contact' => [
										 'l.id',
										 'l.name',
										 'l.type',
										 'l.email',
										 'l.telphone',
										 'l.updated',
						   ],
						   
						 'newsletter' => [
										 'l.id',							
										 'l.email',
										 //'l.status',
										 'l.created',
										 'l.updated',
						      ],

						'redirection' => [
										 'l.id',
										 'l.old_url',
										 'l.new_url',
										 'l.status',
										 'l.author_id',
										 'l.updated',
						   ],						   

						'contactlist' => [
										 'l.id',
										 'l.message',
										 'l.status',
										 'l.created',
										 'l.author_id',							 
						   ],

						'enquirylist' => [
										 'l.id',
										 'l.name',
										 'l.product_name',
										 'l.email',
										 'l.telphone',
										 'l.message',
										 'l.product_id',
										 'l.created',						 
						   ],						   
									
						'user' => [
										 'l.admin_id as id',
										 'CONCAT(l.admin_firstname," ",l.admin_lastname) as admin_firstname',
										 'u.thumb_path as image_id',
										 'l.admin_email',
										 'l.status',
										 'l.updated',
										 'l.author_id'
									],

						'profile' => [
										 'l.admin_id as id',
										 'l.admin_firstname',
										 'u.thumb_path as image_id',
										 'l.admin_email',
										 'l.updated',
										 'l.author_id'
									],									
						'menu' => [
								   'l.id',
								   'l.title',								   
								   'l.menu_type',         
								   'l.module_name',     
								   'l.page_slug',     
								   'l.nav_type',								       
								   'l.status',     
								   'l.updated',
								   'l.author_id'								   
								  ],
						'content' => [
					                 'id',
									 'title',
									 'meta_title',
									 'status',
									 'updated',
									 'author_id'	
									 ],
									 
						'category' => [
										 'l.category_id',
										 'l.title',
										 'l.feature_category',
										 'u.thumb_path as image_id',
										 'l.status',
										 'l.updated',
										 'l.author_id'
									],			 

						'news' => [
					                 'l.news_id',
									 'l.title',
									 'l.date',
									 'l.status',
									 'l.updated',
									 'l.author_id'									 
									 ],	

						'testimonial' => [
										 'l.testimonial_id',
										 'l.title',	 
										 'u.thumb_path as image_id',
										 'l.author_name',
										 'l.status',
										 'l.sort_order',
										 'l.updated',
										 'l.author_id'
									],									 
				
												 
                    ];
					
$config['join_columns']  = 	[			
							 'menu' => [
									  'table' => [
												'nc_routes as c' => 'c.content_id = l.page_slug and l.module_name = c.content_type' 
											   ],
									   ],
							];