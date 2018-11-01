<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Model extends CI_Model {
	
	protected $_table_name = '';
	protected $_primary_key = 'id';
	protected $_primary_filter = 'intval';
	protected $_order_by = '';
	protected $_timestamps = false;
	
	public function get($id = NULL, $is_single = FALSE){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'row_array';
		} else if($is_single == TRUE) {
			$method = 'row_array';
		} else {
			$method = 'result_array';
		}
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_by($where, $is_single = FALSE){
		$this->db->where($where);
		return $this->get(NULL, $is_single);
	}
	
	public function save($data, $id = NULL){
		//INSERT
		if($id === NULL){
			//!isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
			$this->db->set($data);
			$this->db->insert($this->_table_name);
			$id = $this->db->insert_id();
		}
		//UPDATE
		else{
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->set($data);
			$this->db->where($this->_primary_key,$id);
			$this->db->update($this->_table_name);
			
		}
		return $id;
	}
	
	public function delete($id){
		$filter = $this->_primary_filter;
		$id = $filter($id);
		if(!$id){
			return FALSE;
		}
		
		$this->db->where($this->_primary_key, $id);
		$this->db->limit(1);
		if($this->db->delete($this->_table_name)){
			return true;
		}else{
			return false;
		}
		
	}
	
	public function save_by($data = [],$where = []){
			$this->db->set($data);
			$this->db->where($where);
			if($this->db->update($this->_table_name)){
				return true;
			}else{
				return false;
			}
		
	}
	
	public function get_where($table = NULL ,$columns = NULL,$where = []){
			$this->db->select($columns);
			if(count($where)>0){
				$this->db->where($where);
			}			
			$query = $this->db->get($table);
			if($query->num_rows()>0){
				if(count($where)>0){
					return $query->row_array();
				}else{
					return $query->result_array();
				}	
			}else{
				return false;
			}
	}	
	
	
	public function get_where_all($table = NULL ,$columns = NULL,$where = []){
			$this->db->select($columns);
			if(count($where)>0){
				$this->db->where($where);
			}			
			$query = $this->db->get($table);
			if($query->num_rows()>0){
				return $query->result_array();
			}else{
				return false;
			}	
	}
	
	public function get_join($table = NULL,$columns = false,$where = [],$join_table = FALSE,$is_single = FALSE){
		
		if($columns){
			$this->db->select($columns);
		}
			if($join_table){
				if(is_array($join_table) && !empty($join_table)){
					foreach($join_table as $key => $field){
						$this->db->join($key,$field);
					}
				}
			}
			if(count($where)>0){
				$this->db->where($where);
			}			
			$query = $this->db->get($table);
			if($query->num_rows()>0){
				if($is_single){
					return $query->row_array();
				}else{
					return $query->result_array();
				}
				
			}else{
				return false;
			}	
	}
	
	public function row_delete($table,$where){	
		$this->db->where($where);	
		if($this->db->delete($table)){	
		return true;	
		}else{		
		return false;	
		}	
	}
	
	
	public function get_count($id = NULL){
		if($id != NULL){
			$filter = $this->_primary_filter;
			$id = $filter($id);
			$this->db->where($this->_primary_key, $id);
			$method = 'num_rows';
		} 
		 $method = 'num_rows';
		return $this->db->get($this->_table_name)->$method();
	}
	
	public function get_count_by($where=null){
		if(!empty($where))
		$this->db->where($where);
		return $this->get_count(NULL);
	}
}