<?php

class Publication_model extends CI_Model
{
	public function getPublications(){
		$this->db->select('*');	
		$this->db->from('publication');		
		$query = $this->db->get();
		return $query->result();
	}

	
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->where('publication_id',$id);
		$this->db->where('deleted',0);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function create($options){
		$data = array 	(
							'user_id' => $options->userId,
							'creation_date' => $options->creationDate,
							'tittle' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $options->categoryId,
							'subcategory_id' => $options->subcategoryId,
							'views' => $options->views,
						);
		$this->db->insert('publication', $data);
		$id = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return $id;
	}
	
	public function delete($id){

		$this->db->trans_start();
		$data = array ('deleted' => 1);
		$this->db->where('publication_id', $id);
		$this->db->update('publication',$data);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}
	
	public function update($options){
		$data = array 	(
							'user_id' => $options->userId,
							'creation_date' => $options->creationDate,
							'tittle' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $options->categoryId,
							'subcategory_id' => $options->subcategoryId,
							'views' => $options->views,
						);
		$this->db->where('publication_id', $options->id);
		return $this->db->update('publication', $data);
	}

}