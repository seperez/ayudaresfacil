<?php

class Offer_type_model extends CI_Model
{
	public function getOfferTypes(){
		$this->db->select('*');	
		$this->db->from('offer_type');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('offer_type');
		$this->db->where('offer_type_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}