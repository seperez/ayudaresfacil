<?php

class PhoneType_model extends CI_Model
{
	public function getPhoneTypes(){
		$this->db->select('*');	
		$this->db->from('type_phone');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('type_phone');
		$this->db->where('type_phone_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}