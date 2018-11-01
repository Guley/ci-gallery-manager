<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends MY_Controller {
	public $username;
	public $logo;
	public $last_login;
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('search_m');
		$this->load->library('pagination');
		
	}
	
	public function _gallery_select_box($type=''){
		
			$this->db->select("type");
            $this->db->distinct();
            $list       =  $this->db->get("lr_uploads")->result_array();
            $select_box     = "<select class='form-control' id='type_value'><option value='all'>All</option>";
            foreach($list as $li){
                $value          = ucFirst(str_replace("_"," ",$li['type']));
                if($value==''){
                    $select_box     .="<option value='media'>Uncategorised </option>";
                }
                else if($type==$li['type']){
                    $select_box     .="<option value='{$li['type']}' selected='selected'>{$value}</option>";
                }
                else{
                    $select_box     .="<option value='{$li['type']}'>{$value}</option>";
                }
                
            }
             $select_box     .= "</select>";
             return $select_box;
			 
    }
	
	public function _get_search($table,$search,$order_by,$page =1,$is_image,$columns){
		
		     $cur_page = $page;
			 $page -= 1;
			 $per_page = TOTAL_RECORD_PER_PAGE;
			 $start = $page * $per_page;
             $data['count']  = $this->search_m->get_search($table,$start,FALSE,$search,$order_by,$is_image,$columns);
             $data['output'] = $this->search_m->get_search($table,$start,TRUE,$search,$order_by,$is_image,$columns);		 
			 $this->_pagination($data['count'],$per_page);			
		     $data['pagination'] = $this->pagination->create_links();		
			 return $data;		 
	}
	
	public function _get_search_by($table,$search,$order_by,$page =1,$is_image,$columns,$where){
		
		     $cur_page = $page;
			 $page -= 1;
			 $per_page = TOTAL_RECORD_PER_PAGE;
			 $start = $page * $per_page;
             $data['count']  = $this->search_m->get_search_by($table,$start,FALSE,$search,$order_by,$is_image,$columns,$where);
             $data['output'] = $this->search_m->get_search_by($table,$start,TRUE,$search,$order_by,$is_image,$columns,$where);		 
			 $this->_pagination($data['count'],$per_page);			
		     $data['pagination'] = $this->pagination->create_links();	
			 return $data;
			 
	}
	
	/* Generate slug for all */
	public function generateslug($slug, $content_type, $content_id, $action = false){
		$this->load->model('Routes_m');
		$slug = url_title(strtolower($slug));
		$chk_slug_exist = $this->Routes_m->get_by(array('content_id' => $content_id,'content_type'=>$content_type));
		/* Recursive call - if slug found in the DB */
		if($chk_slug_exist){
			if($action == 'add'){
				$newslug = $slug.rand();
				return $this->generateslug($newslug, $content_type, $content_id);
			}else{
				$insData = array(
				'slug' => $slug
			);
			return $this->Routes_m->save_by($insData,['content_id' => $content_id,'content_type'=>$content_type]);
			}
			
		} else {
			/* if not found in the database then insert it. */
			$insData = array(
				'content_type' => $content_type,
				'slug' => $slug,
				'content_id' => $content_id
			);
			return $this->Routes_m->save($insData);
		}
	}
	
	public function validation_rules_edit($key){
		$edit_key = explode('|', $key);
		$end = '';
		$begin = '';
		if(count($edit_key) > 0){
			$end = array_pop($edit_key);

			if(count($edit_key) > 0){
				$begin = implode('|', $edit_key); 
			}
		}
		return $begin;
	}
	
	public function _pagination($count = NULL,$per_page = NULL){
		
		$config = array();
		$config['base_url'] 	  = '#';
		$config['total_rows'] 	  = $count;
		$config['per_page'] 	  = $per_page;
		$config['use_page_numbers'] = TRUE;
		//$config['uri_segment'] = 5;
        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] ='<li class="prev">';
        $config['prev_tag_close'] ='</li>';
        $config['next_link'] ='&raquo';
        $config['next_tag_open'] ='<li>';
        $config['next_tag_close'] ='</li>';
        $config['last_tag_open'] ='<li>';
        $config['last_tag_close'] ='</li>';
        $config['cur_tag_open'] ='<li class="active"><a href="#" data-ci-pagination-page="1">';
        $config['cur_tag_close'] ='</a></li>';
        $config['num_tag_open'] ='<li>';
        $config['num_tag_close'] ='</li>';	
		$this->pagination->initialize($config);
		return TRUE;
	}
	

	public function validation_errors_to_array($validation_rules){
 
        $this->form_validation->set_rules($validation_rules);
 
        $errors_array = array();//array is initialized
         
        //if form validation is false means their are errors
        if($this->form_validation->run() == false){
 
            //$row as Each individual field array 
            foreach($validation_rules as $row){
 
                $field = (isset($row['error_field'])) ? $row['error_field'] : $row['field'];
                $error = form_error($row['field']);
				
                if($error) {
					$errors_array[$field] = $error;
				}
            }
 
            return $errors_array;
 
        }
        else
            return false;
       }
	
}