<?php

class User_model extends CI_Model
{
	public function listUsers($limit, $offset){
		$this->db->select('*');	
		$this->db->from('users');		
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('users');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function listUserRoles($limit, $offset){
		$this->db->select('*');	
		$this->db->from('user_roles');
		$this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getUserRoleById($id){
		$this->db->select('*');	
		$this->db->from('user_roles');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function login($username, $password){
		$this->db->select('*');	
		$this->db->from('users');
		$this->db->where('username',$username);
		$this->db->where('password',sha1($password));
		$query = $this->db->get();
		return $query->result();
	}
	
	public function create($post){
		$data = array 	(
							'roleId' => $post->roleId,
							'username' => $post->username,
							'password' => sha1($post->password),
							'name' => $post->name,
							'surname' => $post->surname,
							'email' => $post->email
						);
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}
	
	public function update($post){
		$data = array 	(
							'roleId' => $post->roleId,
							'username' => $post->username,
							'name' => $post->name,
							'surname' => $post->surname,
							'email' => $post->email
						); 
		$this->db->where('id', $post->id);
		return $this->db->update('users', $data);
	}
	
	public function delete($id){	
		$this->db->where('id', $id);
		return $this->db->delete('users');
	}
}
