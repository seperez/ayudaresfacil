<?php

class PublicationType_model extends CI_Model
{
	public function getPublicationTypes(){
		$this->db->select('*');	
		$this->db->from('publication_type');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('publication_type');
		$this->db->where('publication_type_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}