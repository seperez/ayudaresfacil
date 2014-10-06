<?php

class User_model extends CI_Model
{
	public function getUsers(){
		$this->db->select('*');	
		$this->db->from('user');
		$this->db->join('user_data', 'user.user_id = user_data.user_id');	
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('user');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function create($options){
		$this->db->trans_start();
		$data = array 	(
							'email' => $options->email,
							'password' => sha1($options->password)
						);
		$this->db->insert('user', $data);
		$id = $this->db->insert_id();
		$data = array 	(
							'user_id' => $id,
							'name' => $options->name
						);
		$this->db->insert('user_data', $data);
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return $id;
	}
	
	public function update($post){
		$data = array 	(
							'roleId' => $post->roleId,
							'email' => $post->email,
							'name' => $post->name,
							'surname' => $post->surname,
							'email' => $post->email
						); 
		$this->db->where('id', $post->id);
		return $this->db->update('user', $data);
	}
	
	public function delete($id){
		$this->db->trans_start();
		
		$data = array ('deleted' => 1);
		$this->db->where('user_id', $id);
		$this->db->update('user',$data);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}

	public function getByUsernameAndPassword($options){
		$this->db->select('*');	
		$this->db->from('user');
		$this->db->where('email',$options['email']);
		$this->db->where('password',sha1($options['password']));
		$this->db->where('enabled',1);
		$this->db->where('deleted',0);
		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function confirmAccount($id){
		$this->db->trans_start();
		
		$data = array ('enabled' => 1);
		$this->db->where('user_id', $id);
		$this->db->update('user',$data);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}
}