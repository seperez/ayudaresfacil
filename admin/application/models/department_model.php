<?php

class Department_model extends CI_Model
{
	public function getDepartmentsByProvinceId($id){
		$this->db->select('*');	
		$this->db->from('departments');
		$this->db->where('province_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getDepartmentByCityId($id){
		$this->db->select('*');	
		$this->db->from('city');
		$this->db->join('department', 'city.department_id = department.department_id');
		$this->db->where('city.city_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id){
		$this->db->select('*');	
		$this->db->from('department');
		$this->db->where('department_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}