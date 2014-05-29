<?php

class Phone_model extends CI_Model
{
	public function getPhonesByUserId($id){
		$this->db->select('*');	
		$this->db->from('user_phone');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getPhoneById($id){
		$this->db->select('*');	
		$this->db->from('user_phone');
		$this->db->where('phone_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options){
		$data = array 	(
							'user_id' => $options->userId,
							'number' => $options->number,
							'type_phone_id' => $options->type
						);
		$this->db->insert('user_phone', $data);
		return $this->db->insert_id();
	}
	
	public function update($post){
		$data = array 	(
							'number' => $post->number,
							'type_phone_id' => $post->type
						); 
		$this->db->where('phone_id', $post->id);
		return $this->db->update('user_phone', $data);
	}
	
	public function delete($id){
		$this->db->trans_start();		

		$this->db->where('phone_id', $id);
		return $this->db->delete('user_phone');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}
}