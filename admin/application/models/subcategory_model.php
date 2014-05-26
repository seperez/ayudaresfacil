<?php

class Subcategory_model extends CI_Model
{
	public function getSubcategories(){
		$this->db->select('*');	
		$this->db->from('publication_subcategory');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('publication_subcategory');
		$this->db->where('subcategory_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}