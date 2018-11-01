<?php
class Menu_m extends MY_Model{
	protected $_table_name = 'lr_menus';
	protected $_primary_key = 'id';
	
	public function getSlugs($module){
		
		if($module == 'product'){
			$selectFields = 'lr_products.title, lr_routes.content_id';	
			$this->db->select($selectFields);
			$this->db->from('lr_products');
		}else{
			$selectFields = 'lr_'.$module.'.title, lr_routes.content_id';
			$this->db->select($selectFields);
			$this->db->from('lr_'.$module);
		}
				

		if($module == 'category'){
			$this->db->join('lr_routes', 'lr_'.$module.'.category_id=lr_routes.content_id', 'left');
		}elseif($module == 'news'){
			$this->db->join('lr_routes', 'lr_'.$module.'.news_id=lr_routes.content_id', 'left');
		}
		elseif($module == 'product'){
			$this->db->join('lr_routes', 'lr_products.product_id=lr_routes.content_id', 'left');
		}
		else{
			$this->db->join('lr_routes', 'lr_'.$module.'.id=lr_routes.content_id', 'left');
		}
		
		$module_value = $module;
		$this->db->where('lr_routes.content_type',$module_value);
		return $this->db->get()->result_array();
	}
}