<?php

class City_model extends CI_Model
{
	public function getCitiesByDepartmentId($id){
		$this->db->select('*');	
		$this->db->from('city');
		$this->db->where('department_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('city');
		$this->db->where('city_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}