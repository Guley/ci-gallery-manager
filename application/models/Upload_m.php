<?php
class Upload_m extends MY_Model{
	protected $_table_name = 'lr_uploads';
	 
	public function imageSearch($file_id){
		$this->db->select('u.file_name,u.file_extension,u.thumb_path,u.type');
		$this->db->from('lr_uploads as u');
		$this->db->where('u.id',$file_id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			return $query->row_array();
		}else{
			return false;
		}
	} 
	
}