<?php

class Phone_model extends CI_Model
{
	public function getPhonesByUserId(){
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

	// TODO: ARMAR CORRECTAMENTE ESTE METODO 
	// public function create($options){
	// 	$this->db->trans_start();
	// 	$data = array 	(
	// 						'email' => $options->email,
	// 						'password' => sha1($options->password)
	// 					);
	// 	$this->db->insert('user', $data);
	// 	$id = $this->db->insert_id();
	// 	$data = array 	(
	// 						'user_id' => $id,
	// 						'name' => $options->name
	// 					);
	// 	$this->db->insert('user_data', $data);
	// 	$this->db->trans_complete();
	// 	if ($this->db->trans_status() === FALSE){
	// 		$id = null;
 //      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
	// 	}
	// 	return $id;
	// }
	
	public function update($post){
		$data = array 	(
							'number' => $post->number,
							'phone_type_id' => $post->type
						); 
		$this->db->where('id', $post->id);
		return $this->db->update('phone_user', $data);
	}
	
	public function delete($id){
		$this->db->trans_start();		

		$this->db->where('id', $id);
		return $this->db->delete('notes');

		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}
}