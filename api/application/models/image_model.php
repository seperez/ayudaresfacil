<?php

class Image_model extends CI_Model
{
	public function getImages(){
		$this->db->select('*');	
		$this->db->from('publication_image');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('publication_image');
		$this->db->where('image_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}