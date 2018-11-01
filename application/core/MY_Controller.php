<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
   
	public function save($postData = [],$table = '',$type = '',$where = []){
	
	    if(is_array($postData) && !empty($postData)){
			$this->CI =& get_instance();
			if($type == 'update'){
				 $postData['field']['author_id'] = $this->session->userdata('admin_id');
				 $postData['field']['updated']   = date('Y-m-d h:i:s');
				if($this->CI->db->update($table,$postData['field'],$where)){
					 
					switch($table){
						case 'lr_content':
						$this->generateslug($postData['field']['title'],'content',$where['id'],'update');
						break;
					
						case 'lr_category':
						$this->generateslug($postData['field']['title'],'category',$where['category_id'],'update');
						break;
						
						case 'lr_news':
						$this->generateslug($postData['field']['title'],'news',$where['news_id'],'update');
						break;
						
					}					
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
			$postData['field']['author_id'] = $this->session->userdata('admin_id');
			$postData['field']['created']   = date('Y-m-d h:i:s');
			$this->CI->db->insert($table,$postData['field']);
			$content_id =$this->db->insert_id(); 
			if($content_id){
				
				switch($table){
					case 'lr_content':
				    $this->generateslug($postData['field']['title'], 'content', $content_id,'add');
					break;
					case 'lr_category':
				    $this->generateslug($postData['field']['title'], 'category', $content_id,'add');
					break;
					case 'lr_news':
				    $this->generateslug($postData['field']['title'], 'news', $content_id,'add');
					break;	
					case 'lr_solutions':
					$this->generateslug($postData['field']['title'], 'solution', $content_id,'add');
					$this->save_setting();
					break;					
				}								
				return TRUE;
			}else{
				return FALSE;
			}
		  }	
		}		
	}
	public function secureAjaxCall(){
		
		//if($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
			//if(@isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']=="http://yourdomain/ajaxurl")
			if(@isset($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], base_url()) === 0)
			{
				//valid call nothing
			} else {
				echo json_encode(array('error' => 'Invalid call.'));
				exit;
			}
		//}
	}   
	
	public function change_date_format($date = '', $format = 'Y/m/d') {
		$parts = explode('/', $date);
		if(count($parts) == 3) {
			$mktime = mktime(0, 0, 0, (int)$parts[1], (int)$parts[0], (int)$parts[2]);
			if($mktime) {
				$date = date($format, $mktime);
			}
		}
		return $date;
	}
	
	public function check_url($url){
		
		 $current_url = parse_url($url, PHP_URL_HOST);
		 $scheme      = parse_url($url, PHP_URL_SCHEME);
		 $scheme      = ($scheme == 'http' || $scheme == 'https' )?$scheme:'';
		 $base_url    = str_replace('/portal/','',base_url());
		 
		 if($scheme && ($base_url == $scheme.'://'.$current_url) ){
			 $url = str_replace($scheme.'://'.$current_url,'',$url);
		 }
		return $url;	
		
	}
	
	public function view_url($url){
		
		 $current_url = $_SERVER['HTTP_HOST'];
		 $scheme      = parse_url($url, PHP_URL_SCHEME);
		 $scheme      = ($scheme == 'http' || $scheme == 'https' )?$scheme:'';
	 
		 if($scheme == ''){
			$url = 'http://'.$current_url.$url; 
		 }
		 
		 return $url;	
		
	}
	
	public function validate_url($url,$table,$columns,$where){
		
		$scheme      = parse_url($url, PHP_URL_SCHEME);
		$scheme      = ($scheme == 'http' || $scheme == 'https' )?$scheme:'';
		$record		 = '';
		
		switch($scheme){
			case 'http':
			$this->valid_link($url,$table,$columns,$where,FALSE);
			break;
			case 'https':
			$this->valid_link($url,$table,$columns,$where,FALSE);
			break;
			case '':
			$this->valid_link($url,$table,$columns,$where,TRUE);
			break;
			default:
			return FALSE;
			
		}
		 
		
	}
	
	public function valid_link($url,$table,$columns,$where,$is_exist = FALSE){
		$record = '';
		$exist  = '';
		$this->CI =& get_instance();
		$record = $this->CI->auth_m->get_where($table,$columns,$where,TRUE);
	
		if($record[$columns] == $url){
			return 'yes';
		}else{
			$exist = $this->CI->auth_m->get_count_by([$columns => $url]);
			if($exist > 0){
				return 'link already exist';
				
			}else{
				if($is_exist){
					return 'yes';
				}else{
					if(filter_var($url, FILTER_VALIDATE_URL) || empty($url)){
					return 'yes';
					}else{
						return 'Please Enter Valid Link';
					}	
				}
								
			}				
		}
	}
	
	public function validMedia($id,$type){
		
		$type_files = [];
		$result     = FALSE;
		
		if($id == 0){
			return FALSE;
		}
		
		$type_files = [
						'image' => ['.jpg','.jpeg','.png','.gif'],
						'pdf' 	=> ['.pdf'],
						'docx' 	=> ['.docx'],
					 ];
		$this->CI =& get_instance();
		$query = $this->CI->db->select('file_extension')->where('id',$id)->get('lr_uploads')->row_array();
		
		if(is_array($query) && !empty($query)){
			if($type == 'image' && !empty($id)){
				if(in_array($query['file_extension'],$type_files['image'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}else if($type == 'pdf' && !empty($id)){
				if(in_array($query['file_extension'],$type_files['pdf'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}else if( $type == 'docx' && !empty($id) ){
				if(in_array($query['file_extension'],$type_files['docx'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}
		}else{
			$result = FALSE;
		}
		
		return $result;
			    			 
	}
	
	
	public function validMediaFile($id,$type){
		
		$type_files = [];
		$result     = FALSE;
		
	
		$type_files = [
						'image' => ['.jpg','.jpeg','.png','.gif'],
						'pdf' 	=> ['.pdf'],
						'docx' 	=> ['.docx'],
					 ];
		$this->CI =& get_instance();
		$query = $this->CI->db->select('file_extension')->where('id',$id)->get('lr_uploads')->row_array();
		
		if(is_array($query) && !empty($query)){
			if($type == 'image' && !empty($id)){
				if(in_array($query['file_extension'],$type_files['image'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}else if($type == 'pdf' && !empty($id)){
				if(in_array($query['file_extension'],$type_files['pdf'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}else if( $type == 'docx' && !empty($id) ){
				if(in_array($query['file_extension'],$type_files['docx'])){
					$result = TRUE;
				}else{
					$result = FALSE;
				}
			}
		}else{
			$result = TRUE;
		}
		
		return $result;
			    			 
	}
	
	
}