<?php
class Gallery_m extends MY_Model{
	protected $_table_name = 'lr_gallery';
	protected $_option_table = 'lr_gallery_options';
	protected $_primary_key = 'gallery_id';
	protected $_secondary_key = 'gallery_option_id';
	protected $_image_key = 'lr_uploads';
	
	public function get_view($id,$option = FALSE){
		if($option){
			$table = $this->_option_table;
			$key   =  $this->_primary_key;
			$this->db->select('b.gallery_id,b.gallery_option_id,b.image_id as mid,b.title,u.thumb_path as image,b.sort_order,b.status');
			
		}else{
			$table =  $this->_table_name;
			$key   =  $this->_primary_key;
			$this->db->select('b.gallery_id,b.image_id as mid,b.feature_category,b.featured_title,b.icon_id,b.icon_hover_id,b.title,b.meta_title,b.meta_description,b.meta_keyword,u.thumb_path as image,b.sort_order,b.status,b.created,b.updated,b.author_id');
		}
		
		
		$this->db->from($table .' as b');
		$this->db->join($this->_image_key  .' as u','u.id = b.image_id','left');
		$this->db->where($key,$id);
		$query = $this->db->get();
		if($query->num_rows() >0){
			if($option){
				return $query->result_array();
			}else{
			return $query->row_array();	
			}
			
		}else{
			return false;
		}
		
	}

	
	public function saveOptions($data, $id = NULL){
		//INSERT
		if($id === NULL){
			//!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_option_table);
			$id = $this->db->insert_id();
		}
		//UPDATE
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_secondary_key,$id);
			$this->db->update($this->_option_table);
			
		}
		return $id;
	}
	public function deleteOptions($optionIds,$solutionId){
		$this->db->where_not_in("gallery_option_id",$optionIds);
		$this->db->where("gallery_id",$solutionId);
		$this->db->delete($this->_option_table);
	}
}