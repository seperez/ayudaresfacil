<?php

class ProcessState_model extends CI_Model
{
	public function getProcessStates(){
		$this->db->select('*');	
		$this->db->from('process_state');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('process_state');
		$this->db->where('process_state_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}