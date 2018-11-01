<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_media extends Admin_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('Ajax_model');
    }
    /*
	Function Name		: index
	Purpose				: get images with type check
	Created Date		: 21/Sep/2016
	*/
    public function index($type='',$format = '',$page=1,$search=''){	
		/* check if its valid ajax call */
		if (!$this->input->is_ajax_request()) {
           exit('No direct script access allowed');
          }  
		
		$page -= 1;
		$per_page = TOTAL_IMAGES_PER_PAGE;
		$start = $page * $per_page;
		
		/*Check the file type*/
		$file_rules = [];
		$format_type = '';
		$file_rules = $this->config->item('file_type');
		
		if($format == ''){
			$format = 'image';
		}
		
		if(array_key_exists($format,$file_rules)){
			$format_type = $file_rules[$format];
		}
		
				
		$data['count']  		= $this->Ajax_model->get_images($type,$start,FALSE,$search,$format_type);
		$data['output'] 		= $this->Ajax_model->get_images($type,$start,TRUE,$search,$format_type);
		
		if(is_array($data['output']) && !empty($data['output'])){
			foreach($data['output'] as $key => $list){
				$data['output'][$key]['created'] = date('F,d Y',strtotime($list['created']));
			}
		}
		//print_r($data['output']);
	
		//$page_url = 'ajax_media/index/'.$type;	
		$this->_pagination($data['count'],$per_page);
				
		$data['pagination'] = $this->pagination->create_links();	
		echo json_encode($data);
		exit;
    }
}
