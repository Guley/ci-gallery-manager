<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Search_m extends CI_Model {
	
    public function get_search($table,$offset,$limit,$search='',$order_by = '',$is_image = FALSE,$columns = FALSE) { 

			if($is_image){
				if($columns){
					$columns = rtrim(implode(',',$columns), ','); 
					$this->db->select($columns);
					$this->db->from($table.' as l');
					 if($table == 'lr_admin'){
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }else{
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }
					
				}else{
				$this->db->select('l.*,u.thumb_path');
				$this->db->from($table.' as l');
				
				if($table == 'lr_admin'){
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }else{
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }
				}
				
			}else{
				if($columns){
					$columns = rtrim(implode(',',$columns), ','); 
					$this->db->select($columns);
					$this->db->from($table.' as l');
				}else{
					$this->db->select('l.*');
					$this->db->from($table.' as l');
				}			 
			}
	
	    if(is_array($search) && !empty($search)){
			foreach($search as $key => $filter){
				if($key == 'range'){
					
					if(!empty($filter['start_date']) && !empty($filter['end_date'])){
						$start_date = $filter['start_date'];
						$end_date = $filter['end_date'];
						$this->db->where('date(l.updated) BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
					}
				}else if($key == 'status'){
					if($filter == 0 && $filter != ''){
						$this->db->where('l.'.$key, $filter);
					}					
				}else if($key == 'title' && !empty($filter)){		
						$this->db->like('l.'.$key, $filter);
				}else if($key == 'feature_category' && !empty($filter)){
					
					if( $filter == 'feature' ){
						$filter = 1;
						$this->db->like('l.'.$key, $filter);
					}
					else if($filter == 'exclude'){
						$filter = NULL;
						$this->db->where('l.'.$key, $filter);
					}
						
				}
				else if($key == 'feature_product' && $filter){
					if( $filter == 'feature' ){
						$filter = 1;
						$this->db->like('l.'.$key, $filter);
					}
					else if($filter == 'exclude'){
						$filter = NULL;
						$this->db->where('l.'.$key, $filter);
					}
				}
				else{
					if(!empty($filter)){
						$this->db->like('l.'.$key, $filter);
					}
				}
				
			}
			
		}
        $this->db->order_by('l.'.$order_by, 'desc');
        if($limit){
			$this->db->limit(TOTAL_RECORD_PER_PAGE, $offset);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if($limit){
                return $query->result_array();
            }
            else{
                 return count($query->result_array());
            }
        }
        return false;
    }
	
	
	public function get_search_by($table,$offset,$limit,$search='',$order_by = '',$is_image = FALSE,$columns = FALSE,$where = []) { 

			if($is_image){
				if($columns){
					$columns = rtrim(implode(',',$columns), ','); 
					$this->db->select($columns);
					$this->db->from($table.' as l');
					 if($table == 'lr_admin'){
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }else{
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }
					
				}else{
				$this->db->select('l.*,u.thumb_path');
				$this->db->from($table.' as l');
				
				if($table == 'lr_admin'){
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }else{
						 $this->db->join('lr_uploads as u','u.id = l.image_id','left');
					 }
				}
				
			}else{
				if($columns){
					$columns = rtrim(implode(',',$columns), ','); 
					$this->db->select($columns);
					$this->db->from($table.' as l');
					
				}else{
					$this->db->select('l.*');
					$this->db->from($table.' as l');
				}			 
			}

	    if(is_array($search) && !empty($search)){
			foreach($search as $key => $filter){
				if($key == 'range'){
					
					if(!empty($filter['start_date']) && !empty($filter['end_date'])){
						$start_date = $filter['start_date'];
						$end_date 	= $filter['end_date'];
						$this->db->where('date(l.updated) BETWEEN "'.$start_date.'" AND "'.$end_date.'"');
					}
				}else if($key == 'status'){
					if($filter == 0 && $filter != ''){
						$this->db->where('l.'.$key, $filter);
					}					
				}else if($key == 'title' && !empty($filter)){
					
						$this->db->like('l.'.$key, $filter);
					
				}else if($key == 'email' && !empty($filter)){
					
					$this->db->where('l.'.$key, $filter);
						
				}else if($key == 'admin_firstname' && !empty($filter)){
					
					$this->db->like('CONCAT(l.admin_firstname, " ", l.admin_lastname)', $filter);
						
				}
				
				else{
					if(!empty($filter)){
						$this->db->like('l.'.$key, $filter);
					}
				}
				
			}
			
		}
		
		$this->db->where($where);
        $this->db->order_by('l.'.$order_by, 'desc');
        if($limit){
			$this->db->limit(TOTAL_RECORD_PER_PAGE, $offset);
        }
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            if($limit){
                return $query->result_array();
            }
            else{
                 return count($query->result_array());
            }
        }
        return false;
    }
}
?>