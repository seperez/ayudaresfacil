<?php

class Category_model extends CI_Model
{
	public function getCategories(){
		$this->db->select('*');	
		$this->db->from('publication_category');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('publication_category');
		$this->db->where('category_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}