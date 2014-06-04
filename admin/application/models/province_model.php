<?php

class Province_model extends CI_Model
{
	public function getProvinces(){
		$this->db->select('*');	
		$this->db->from('province');
		$query = $this->db->get();
		return $query->result();
	}

	public function getProvinceByDepartmentId($id){
		$this->db->select('*');	
		$this->db->from('department');
		$this->db->join('province', 'department.province_id = province.province_id');
		$this->db->where('department.department_id',$id);
		$query = $this->db->get();
		return $query->result();
	}	
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('province');
		$this->db->where('province_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
}