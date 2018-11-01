<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Ajax_model extends CI_Model {
    /*
	Function Name		: get_images
	Purpose				: get admin images with type check
	Created Date		: 18/Feb/2016
	*/
    public function get_images($type,$offset,$limit,$search='',$format = '') {
		if($type == "media"){
			$type = '';
		}
        $this->db->select('u.*');
        $this->db->from('lr_uploads as u');
        if($search!=''){
            $this->db->like('u.thumb_path', $search);
        }
		if($format!= ''){
			$this->db->where_in('u.mime_type',$format);
		}
        if($type!="all"){
            $this->db->where('u.type', $type);
        }
        $this->db->order_by('u.id', 'desc');
        if($limit){
        $this->db->limit(TOTAL_IMAGES_PER_PAGE, $offset);
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