<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Images extends Admin_Controller {

	public function __construct(){
		parent::__construct();		
		$this->load->model('gallery_m');
		$this->load->library('form_validation');
	}
	
	public function index()
	{
		$data['title']         = [
									 "name" 	=> "title",
									 "id" 		=> "title",
									 "value" 	=> "",
                                     "placeholder" => "Search by title",
									 "class" => "form-control",
								  ];
								  
		$options 				 = [];
		$options 				 = $this->config->item('options');
		
		$data['status'] 		 = $options['status_options'];

		
		$data['add_js'] 		= ['moment.min','daterangepicker','jquery.colorbox-min','datajs'];								  
		$data['template_file']  = 'gallerylist/list.php';
		$data['page_title'] 	= 'Gallery Management';
		$data['icon'] 			= '<i class="fa fa-file-image-o"></i>';
		$data['path'] 			= '<div class="col-md-5 col-sm-5 col-xs-12 pull-right text-right">
									<a href="'.base_url('images/manage').'" class="btn btn-primary" title="Add New"> <i class="fa fa-file-image-o"></i>
									Add New </a></div>';
		$data['breadcrumb'] 	= '<li class="active"><a href="'.base_url("images").'"> <i class="fa fa-file-image-o"></i>  Gallery Management </a></li>';
		$this->load->view('layout_list',$data);
	}
	
	public function search(){
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}		
		$where_date = [];
		$title 		= '';
		$status 	= '';
		$page 		= '';
		$range      = $this->input->post('range');
		$title      = $this->input->post('title');
		$status     = $this->input->post('status');
		$page     	= $this->input->post('page');
				
		if($range){
				$range_date = explode('-',$range);
				$start_date = '';
				$end_date   = '';
				$start_date = date('Y-m-d',strtotime($range_date[0]));
				$end_date   =  date('Y-m-d',strtotime($range_date[1]));
				$where_date = [
						 'start_date' => $start_date,
						 'end_date'   => $end_date,
		              ];
			}
		
		$columns_filter =[];
		$columns_list 	=[];
		$search_filter 	=[];
		$search_filter =[
						 'range' => $where_date,
						 'title' => $title,
						 'status' => $status,
						 ];
						 
		$columns_filter	= $this->config->item('columns');
		$columns_list 	= $columns_filter['gallery'];	
		
						 						
		$gallery_list = [];
		$search_list = [];
		
		$gallery_list = $this->_get_search('lr_gallery',$search_filter,'sort_order',$page,TRUE,$columns_list);

		if(is_array($gallery_list) && !empty($gallery_list)){		 	
				 $count   	  = $gallery_list['count'];
				 $result_list = $gallery_list['output'];
				 $search_list = $result_list;
				 
				 if(is_array($search_list) && !empty($search_list)){
					foreach($search_list as $key => $list){
						$edit_link 	= base_url('images/manage/'.$list['gallery_id']);
						$view_link 	= base_url('images/detail/'.$list['gallery_id']);
						$search_list[$key]['image_id'] = CDN_DOMAIN.'/uploads/gallery/small/'.$list['image_id'];
						$search_list[$key]['orignal'] = CDN_DOMAIN.'/uploads/gallery/orignal/'.$list['image_id'];
						$search_list[$key]['updated'] = date('M d,Y',strtotime($list['updated']));
						$author_id = $this->gallery_m->get_where('lr_admin','admin_firstname,admin_lastname',['admin_id'=>$list['author_id']]);				
						$search_list[$key]['author_id'] = $author_id['admin_firstname'].' '.$author_id['admin_lastname'];
						
						//<a href="javascript:void(0);" title="delete" onclick ="return bannerDelete('.$list['banner_id'].')" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
						$search_list[$key]['action'] = '<a href="'.$edit_link.'" title="Edit"  data-toggle="tooltip"><i class="fa fa-pencil-square-o"></i></a> <a href="'.$view_link.'" title="Gallery Detail" data-toggle="tooltip"><i class="fa fa-info-circle" aria-hidden="true"></i></a>'; 
						 
					}		
						 $json_response['status'] = 1;
						 $json_response['message'] = $search_list;
						 $json_response['count'] = $count;
						 
						 if($count > TOTAL_RECORD_PER_PAGE){
							 $json_response['pagination'] = $gallery_list['pagination'];
						 }else{
							 $json_response['pagination'] = '';
						 }
						 
						 echo json_encode($json_response);
						 exit;
				 }else{
						 $error_message = $this->config->item('message');
						 $json_response['status'] = 2;
						 $json_response['message'] = $error_message['gallery_form'];
						 $json_response['pagination'] = '';
						 echo json_encode($json_response);
						 exit;
					}		 
				}		
	}
		
	public function manage($id=''){
		
		$gallery_list 		= [];
		$gallery_options	= [];
		$title 				= "";
		$image 				= "";
		$image_id 			= "";
		$icon_id 			= "";
		$icon 				= "";
		$icon_hover_id 		= "";
		$icon_hover 		= "";
		$status 			= "";
		$sort_order 		= "";
		$meta_title 		= "";
		$meta_description 	= "";
		$meta_keyword 		= "";
		$feature_category	= "";
		$featured_title		= "";
		$data 				= array();
		$gallery_options 	= array();
		$icon_list 			= array();
		$icon_hover_list 	= array();
		
		if(!empty($id)){
			
			$gallery_list 	= $this->gallery_m->get_view($id,FALSE);			
			$data['method'] = 'update';
			
			if(is_array($gallery_list) && !empty($gallery_list)){
				
				$icon_list 		= $this->gallery_m->get_where('lr_uploads','thumb_path as icon',['id' =>$gallery_list['icon_id']]);
				
				$icon_hover_list = $this->gallery_m->get_where('lr_uploads','thumb_path as icon_hover',['id' =>$gallery_list['icon_hover_id']]);
				
				$title 				= $gallery_list['title'];
				$image 				= $gallery_list['image'];
				$feature_category   = $gallery_list['feature_category'];
				$featured_title   	= $gallery_list['featured_title'];
				$icon_id 			= $gallery_list['icon_id'];
				$icon 				= $icon_list['icon'];
				$icon_hover_id 		= $gallery_list['icon_hover_id'];
				$icon_hover 		= $icon_hover_list['icon_hover'];
				$status 			= $gallery_list['status'];
				$sort_order 		= $gallery_list['sort_order'];
				$image_id 			= $gallery_list['mid'];
				$meta_title 		= $gallery_list['meta_title'];
				$meta_description 	= $gallery_list['meta_description'];
				$meta_keyword 		= $gallery_list['meta_keyword'];		
				$gallery_options  	= $this->gallery_m->get_view($id,TRUE);
		
			}else{
				$this->session->set_flashdata('error', 'Unable to gallery id.');
				redirect('images','refresh');
			 }
		}else{
			$data['method'] = 'add';
			$image_id 		= '';
			$icon_id 		= '';
			$icon_hover_id 	= '';
		}	
	
		$data['add_js'] = ['moment.min','daterangepicker','plugin/ckeditor','datajs'];
		
		$data['title']	  =	array(
							'name' 		  =>  'title',
							'id' 		  =>  'title',
							'type' 		  =>  'text',
							'value'       =>  $title,
							'class' 	  =>  'form-control col-md-7 col-xs-12',
							'placeholder' =>  'Gallery title',
							'text-muted'  =>  '',
							);
		
						
		$data['sort_order']	= array(
								'name' 		 =>  'sort_order',
								'id' 		 =>  'sort_order',
								'type' 		 =>	 'number',
								'value'      =>  $sort_order,
								'min'		 => '1',
								'class' 	 => 'form-control col-md-7 col-xs-12',
								'placeholder' => 'Sort order',
								'text-muted' => '',
								);
		
		
		$data['meta_title']	=	array(
								'name' 		 =>  'meta_title',
								'id' 		 =>  'meta_title',
								'type' 		 =>	 'text',
								'value'      =>  $meta_title,
								'class' 	 => 'form-control col-md-7 col-xs-12',
								'placeholder' => 'Meta title seo purpose',
								'text-muted' => '',
								);
		
		$data['meta_description']	=	array(
									'name' 		  =>  'meta_description',
									'id' 		  =>  'meta_description',
									'rows' 		  =>  '5',
									'cols' 		  =>  '15',
									'value'       => $meta_description,
									'class' 	  => 'form-control col-md-7 col-xs-12',
									'placeholder' => 'Meta description seo purpose',
									'text-muted'  => '',
								);
		
		$data['meta_keyword']	=	array(
									'name' 		  =>  'meta_keyword',
									'id' 		  =>  'meta_keyword',
									'rows' 		  =>  '5',
									'cols' 		  =>  '15',
									'value'       =>  $meta_keyword,
									'class' 	  =>  'form-control col-md-7 col-xs-12',
									'placeholder' =>  'Meta keyword seo purpose',
									'text-muted'  =>  '',
							);
		
		$data['featured_category'] =  array(
										'name'          => 'featured_category',
										'id'            => 'featured_category',
										'value'         => '1',
										'checked'       => ($feature_category ==0)?FALSE:TRUE,
										'class'         => '',
										'text-muted'    => 'Enable',
									);
									
		$data['featured_title']	=	array(
								'name' 		 =>  'featured_title',
								'id' 		 =>  'featured_title',
								'type' 		 =>	 'text',
								'value'      =>  $featured_title,
								'class' 	 =>  'form-control col-md-7 col-xs-12',
								'placeholder' => 'Featured Category Title',
								'text-muted' =>  'Category title to display under featured category block',
								);							
		
		$options 				 = [];
		$options 				 = $this->config->item('options');
		
		$data['status'] 		 = $options['status_options'];
		$data['status_mute'] 	 = ['text-muted' => 'Select the status active if status is InActive then gallery is block(not display on the front end)'];
		
		$data['image_mute'] 	 = ['text-muted' => 'Only jpg,jpeg,gif,png image format allowed'];
		
		$data['icon_mute'] 	 	 = ['text-muted'  => 'Only png image format and (48x48) size is allowed'];
		
		$data['icon_hover_mute'] = ['text-muted'  => 'Only png image format and (48x48) size is allowed'];
		
		$data['status_selected'] 	= $status;
		$data['thumb_path'] 	 	= $image;
		$data['logo'] 	 		 	= $image_id;
		
		$data['icon_path'] 	 	 	= $icon;
		$data['icon_path_id'] 	 	= $icon_id;
		
		$data['icon_path_hover'] 	= $icon_hover;
		$data['icon_path_hover_id'] = $icon_hover_id;
		
		$data['result_id'] 	 	 	= $id;
		$data['gallery_options'] 	= $gallery_options;
		
		if(!empty($gallery_options)){
			$data['gallery_options_count'] 	= count($gallery_options);
		}else{
			$data['gallery_options_count'] 	= 1;
		}
		
		$data['submit']	=	array(
			'name'		   => 'submit',
			'type' 		   => 'submit',
			'value'		   => 'true',
			'class' 	   => 'save_button btn btn-success',
			'content'	   => '<i aria-hidden="true" class="fa fa-check"></i> Save Gallery'
		);
		
		$data['select_box']   	= $this->_gallery_select_box('gallery');
		
		$data['template_file'] 	= 'gallerylist/manage.php';
		$data['page_title'] 	= 'Gallery Management';
		$data['icon'] 			= '<i class="fa fa-file-image-o"></i>';
		$data['path'] 			= '';
		$data['breadcrumb'] 	= '<li class="active"><a href="'.base_url("images").'"> <i class="fa fa-file-image-o"></i> Gallery Management </a></li>';
		$this->load->view('layout_page',$data);
	}
	
	public function method(){
		
		if (!$this->input->is_ajax_request()) {
		   exit('No direct script access allowed');
		}
		 $rules = [];
		 $rules = $this->config->item('rules');
		 
		 $validation 	= [];
		 
	     $json_response = [
                            'status' => 0,
                            'message' => ''
                          ];
						  
		$postData 		= $this->input->post();
		$type     		= $postData['type'];
		$id       		= $postData['id'];
		$where    		= [];
		$multi_title 	= [];
		$multi_sort	 	= [];
		$multi_pic 	 	= [];
		$validation_multi = [];

		if(!empty($id)){
			$where = ['gallery_id'	=>	$id];
		}
		
		/* Multi Product Images Post Values */
		
		$multi_title 	= $postData['field']['multi_title'];
		$multi_sort 	= $postData['field']['multi_sort'];
		$multi_pic 		= isset($postData['field']['multi_pic'])?$postData['field']['multi_pic']:'';
		
		/* Start Multi Image Validation */ 
		
		/* Post Multi Title Validation */
				
		if(is_array($multi_title) && !empty($multi_title)){
			foreach($multi_title as $index => $title_error){
			
				if($multi_title[$index] == ''){
				$validation_multi[]  = ['error_field'=>"error_multi_title_".$index,'field'=>'field[multi_title][]','label'=>'image title','rules'=>'callback_multi_title'];
				}
			}
		}
		
		/* Post Multi Sort Validation */
				
		if(is_array($multi_sort) && !empty($multi_sort)){
			foreach($multi_sort as $index => $sort_error){		
				if($multi_sort[$index] == ''){
				 $validation_multi[]  = ['error_field'=>"error_multi_sort_".$index,'field'=>'field[multi_sort][]','label'=>'image sort','rules'=>'callback_multi_sort'];
				}
			}
		}
		
		/* Post Multi Pic Validation */
				
		if(is_array($multi_pic) && !empty($multi_pic)){			
			foreach($multi_pic as $index => $pic_error){
				if($multi_pic[$index] == ''){				
				 $validation_multi[]  = ['error_field'=>"error_multi_pic_".$index,'field'=>'field[multi_pic][]','label'=>'gallery image','rules'=>'callback_multi_pic'];
				
				}
			}
		}
		
		
	 /* End Multi Image Validation */ 
		
	   	if(is_array($rules) && !empty($rules)){
			if(is_array($postData) && !empty($postData)){	 
				foreach($postData['field'] as $key => $post){
						switch($key){
							case 'meta_title':
							$label = "meta title";
							break;
							case 'meta_keyword':
							$label = "meta keyword";
							break;
							case 'meta_description':
							$label = "meta description";
							break;
							case 'image_id':
							$label = "image";
							break;
							case 'feature_category':
							$label = "Feature Category";
								if($postData['field']['feature_category'] ==1){
								$icon_id = $rules['gallery_form']['icon_id'];
								$icon_hover_id = $rules['gallery_form']['icon_hover_id'];
								$featured_title = $rules['gallery_form']['featured_title'];
								
								$new_rules  = "required|trim|callback_valid_image";
								$new_rules_featured_title  = "required|trim";
								$icon_id = substr_replace($icon_id,$new_rules,0);
								$icon_hover_id = substr_replace($icon_hover_id,$new_rules,0);
								$featured_title = substr_replace($featured_title,$new_rules_featured_title,0);
								$rules['gallery_form']['icon_id'] = $icon_id;
								$rules['gallery_form']['icon_hover_id'] = $icon_hover_id;
								$rules['gallery_form']['featured_title'] = $featured_title;
								
				
								}
							break;
							case 'featured_title':
							$label = "category title";
							break;
							case 'icon_id':
							$label = "icon 1";
							break;
							case 'icon_hover_id':
							$label = "icon 2";
							break;
							
							case 'sort_order':
							$label = "sort order";
							if($type == 'update'){
							$sort_order = $rules['gallery_form']['sort_order'];
							$rules['gallery_form']['sort_order'] =  $this->validation_rules_edit($sort_order);
							}
							break;
							default:
							$label = $key;
						}							
						$validation[] = [
									'error_field' 	=> 'error_' . $key,
				                    'field' => 'field['.$key.']',
				                    'label' => $label,
				                    'rules' => $rules['gallery_form'][$key]
					               ];
			
			}
		  }	
		}
			
		$error_validation  = array_merge_recursive($validation,$validation_multi);
		$errors_array 	   = $this->validation_errors_to_array($error_validation);
		 
		 if (is_array($errors_array) && !empty($errors_array)){
			 
			 $json_response['status'] = 0;
             $json_response['message'] = $errors_array;
             echo json_encode($json_response);
             exit; 		 
		 }else{
			 
			   $postData['field']['feature_category'] = ($postData['field']['feature_category'] == 1)?$postData['field']['feature_category']:0;
			   $postData['field']['icon_id'] = ($postData['field']['feature_category'] == 1)?$postData['field']['icon_id']:NULL;
			   $postData['field']['icon_hover_id'] = ($postData['field']['feature_category'] == 1)?$postData['field']['icon_hover_id']:NULL;
			   
			   $postData['field']['featured_title'] = ($postData['field']['feature_category'] == 1)?$postData['field']['featured_title']:'';
			   
				$msg = '';	
				$gallery = [];
				$data['title'] 		 		= $postData['field']['title'];
				$data['image_id'] 	 		= $postData['field']['image_id'];
				$data['feature_category'] 	= $postData['field']['feature_category'];
				$data['icon_id'] 	 		= $postData['field']['icon_id'];
				$data['icon_hover_id'] 	 	= $postData['field']['icon_hover_id'];
				$data['featured_title'] 	= $postData['field']['featured_title'];
				$data['meta_title']  		= $postData['field']['meta_title'];
				$data['meta_keyword'] 		= $postData['field']['meta_keyword'];
				$data['meta_description'] 	= $postData['field']['meta_description'];
				$data['sort_order'] 		= $postData['field']['sort_order'];
				$data['status'] 			= $postData['field']['status'];
				$data['author_id'] 			= 1;
				$data['created'] 			= date('Y-m-d h:i:s');
				$data['updated'] 			= date('Y-m-d h:i:s');
				if($type == 'add'){
			    $content_id 				= null;
				}else{
				$content_id  = $id;
				}
				$content_id 				= $this->gallery_m->save($data,$content_id);
				if($content_id){
					if($type == 'add'){
						$this->generateslug($postData['field']['title'], 'gallery', $content_id,'add');
					}else{
						$this->generateslug($postData['field']['title'],'gallery',$where['gallery_id'],'update');
					}
					
					
					$multi_title 	= isset($postData['field']['multi_title'])?$postData['field']['multi_title']:'';
					$multi_sort 	= isset($postData['field']['multi_sort'])?$postData['field']['multi_sort']:'';
					$multi_pic 		= isset($postData['field']['multi_pic'])?$postData['field']['multi_pic']:'';
					$gallery_option_id 		= isset($postData['field']['gallery_option_id'])?$postData['field']['gallery_option_id']:'';
	
					if(!empty($multi_title)){
						$this->gallery_m->deleteOptions($gallery_option_id,$content_id);
						for($i=0;$i<count($multi_title);$i++){
							$options  = [];
							$option_id = null;
							$options['gallery_id']    = $content_id;
							$options['title'] 		  = $multi_title[$i];
							$options['sort_order'] 	  = $multi_sort[$i];
							$options['image_id'] 	  = $multi_pic[$i];
							$options['status'] 	  	  = 1;
							
							if($gallery_option_id[$i]!=''){
								$option_id = $gallery_option_id[$i];
							}else{
								$options['created'] 	  = date('Y-m-d h:i:s');
							}					
								$this->gallery_m->saveOptions($options,$option_id);
					
						}					
					}
					
				 $msg = ($type == 'update')?'Update':'Add';
				 $this->session->set_flashdata('success', 'Succssfully '.$msg.' Record');	
				 $json_response['status'] = 1;
				 
				
				 $json_response['message'] = 'Succssfully '.$msg.' Record';
				 $json_response['action'] = $type;
				 $json_response['form_id'] = 'gallery_form';
                 echo json_encode($json_response);
                 exit; 
			  }else{
				  $error_list = [];
				  $error_list = ['error_falied' => '<p>Falied Record.</p>'];
				  $json_response['status'] = 0;
				  $json_response['message'] = $error_list;
				  echo json_encode($json_response);
				  exit; 
			  }
			  
		 }
	}
	
	public function multi_title(){
	 $title =[];
	 $title = $this->input->post('field[multi_title][]');
	 if($title){
		 $this->form_validation->set_message('multi_title', 'image title is required');
		 return FALSE;
	 }else{
		 return TRUE;
	 }
 }  
 
 public function multi_sort(){
	 
	 $title = [];
	 $title = $this->input->post('field[multi_sort][]');
	 if($title){
		 $this->form_validation->set_message('multi_sort', 'sort order is required');
		 return FALSE;
	 }else{
		 return TRUE;
	 }
	 
 }
 
  public function multi_pic(){
	 
	 $pic  = [];
	 $pic  = $this->input->post('field[multi_pic][]');

	 if($pic){
		 $this->form_validation->set_message('multi_pic', 'gallery image is required');
		 return FALSE;
	 }
	  else{
		 return TRUE;
	 }
	 
 }
 
	public function valid_image($id){
		if(empty($id)){
			$id = NULL;
			$this->form_validation->set_message('valid_image', 'The image is required');
			return FALSE;
		}
		$result = $this->validMedia($id,'image');
		if($result){
			return TRUE;
		}else{
			$this->form_validation->set_message('valid_image', 'invalid image format');
			return FALSE;
		}
	}
	
	
	public function detail($id=''){
		
		$gallery_list 		= [];
		$gallery_options	= [];
		$author				= [];
		$title 				= "";
		$image 				= "";
		$image_id 			= "";
		$icon_id 			= "";
		$icon 				= "";
		$icon_hover_id 		= "";
		$icon_hover 		= "";
		$status 			= "";
		$sort_order 		= "";
		$meta_title 		= "";
		$meta_description 	= "";
		$meta_keyword 		= "";
		$feature_category	= "";
		$featured_title		= "";
		$data 				= array();
		$gallery_options 	= array();
		$icon_list 			= array();
		$icon_hover_list 	= array();
		
		if(!empty($id)){
			
			$gallery_list 	= $this->gallery_m->get_view($id,FALSE);		
		
			if(is_array($gallery_list) && !empty($gallery_list)){
				
				$icon_list 		= $this->gallery_m->get_where('lr_uploads','thumb_path as icon',['id' =>$gallery_list['icon_id']]);
				
				$icon_hover_list = $this->gallery_m->get_where('lr_uploads','thumb_path as icon_hover',['id' =>$gallery_list['icon_hover_id']]);
				
				$data['title'] 				= $gallery_list['title'];
				
				$data['feature_category']   = ($gallery_list['feature_category'] == 0)?FALSE:$gallery_list['feature_category'];
				$data['featured_title']   	= $gallery_list['featured_title'];
		
				$data['sort_order'] 		= $gallery_list['sort_order'];			
				$data['meta_title'] 		= $gallery_list['meta_title'];
				$data['meta_description'] 	= $gallery_list['meta_description'];
				$data['meta_keyword'] 		= $gallery_list['meta_keyword'];
				$data['updated'] 			= date('M d,Y',strtotime($gallery_list['updated']));
				$image_id 					= $gallery_list['mid'];	
				$icon_id 					= $gallery_list['icon_id'];
				$icon 						= $icon_list['icon'];
				$icon_hover_id 				= $gallery_list['icon_hover_id'];
				$icon_hover 				= $icon_hover_list['icon_hover'];
				$status 					= $gallery_list['status'];
				$image 						= $gallery_list['image'];				
				$gallery_options  			= $this->gallery_m->get_view($id,TRUE);
				$data['author_id']	= $this->gallery_m->get_where('lr_admin','admin_firstname,admin_lastname',['admin_id'=>$gallery_list['author_id']]);				
				$data['author'] 			= $data['author_id']['admin_firstname'].' '.$data['author_id']['admin_lastname'];;
		
			}else{
				$this->session->set_flashdata('error', 'Unable to gallery id.');
				redirect('images','refresh');
			 }
		}
		
		$data['add_js'] 			= ['jquery.colorbox-min'];
		
		$options 				 	= [];
		$options 				 	= $this->config->item('options');
		
		$data['status'] 		 	= $options['status_options'];
	
		$data['status_selected'] 	= $status;
		$data['thumb_path'] 	 	= $image;
		$data['logo'] 	 		 	= $image_id;
		
		$data['icon_path'] 	 	 	= $icon;
		$data['icon_path_id'] 	 	= $icon_id;
		
		$data['icon_path_hover'] 	= $icon_hover;
		$data['icon_path_hover_id'] = $icon_hover_id;
		
		$data['id'] 	 	 		= $id;
		$data['gallery_options'] 	= $gallery_options;
		
		if(!empty($gallery_options)){
			$data['gallery_options_count'] 	= count($gallery_options);
		}else{
			$data['gallery_options_count'] 	= 1;
		}
				
		$data['template_file'] 	= 'gallerylist/detail.php';
		$data['page_title'] 	= 'Gallery Detail';
		$data['icon'] 			= '';
		$data['path'] 			= '';
		$data['breadcrumb'] 	= '<li class="active"><a href="'.base_url("images").'"> <i class="fa fa-file-image-o"></i> Gallery Management </a></li><li> Detail</li>';
		//echo '<!--'.print_r($data,true).'-->';
		$this->load->view('layout_detail',$data);
	}
}