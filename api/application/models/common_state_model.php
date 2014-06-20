<?php

class Common_state_model extends CI_Model
{
	public function getCommonStates(){
		$this->db->select('*');	
		$this->db->from('common_state');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('common_state');
		$this->db->where('common_state_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}