<?php

class Address_model extends CI_Model
{
	public function getAddressesByUserId($id){
		$this->db->select('*');	
		$this->db->from('user_address');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getAddressById($id){
		$this->db->select('*');	
		$this->db->from('user_address');
		$this->db->where('address_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options){
		$data = array 	(
							'user_id' => $options->userId,
							'street' => $options->street,
							'number' => $options->number,
							'postal_code' => $options->postalCcode,
							'floor' => $options->floor,
							'apartment' => $options->apartment,
							'city_id' => $options->city,
							'principal' => $options->principal
						);
		$this->db->insert('user_address', $data);
		return $this->db->insert_id();
	}
	
	public function update($post){
		$data = array 	(
							'street' => $options->street,
							'number' => $options->number,
							'postal_code' => $options->postalCcode,
							'floor' => $options->floor,
							'apartment' => $options->apartment,
							'city_id' => $options->city,
							'principal' => $options->principal
						); 
		$this->db->where('address_id', $post->id);
		return $this->db->update('user_address', $data);
	}
	
	public function delete($id){
		$this->db->trans_start();		

		$this->db->where('address_id', $id);
		return $this->db->delete('user_address');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}
}