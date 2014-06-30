<?php

class Request_model extends CI_Model
{
	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.publication_id', $id);	
		$this->db->where('publication.publication_type_id', 2);
		$query = $this->db->get();
		return $query->result();
	}

	public function getByUser($userId){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$query = $this->db->get();
		return $query->result();
	}	

	public function getCurrentRequests(){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.process_state_id <>', 'B');
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication.expiration_date >', date('Y/m/d H:i:s'));
		$query = $this->db->get();
		return $query->result();
	}

	public function create($arrInfo){
		$request = $arrInfo['request'];
		$category = $request->category;
		$subcategory = $request->subcategory;
		$processState = $request->processState;
		$object = $request->object;

		$this->db->trans_start();
		$data = array 	(
							'user_id' => $arrInfo['user'],
							'publication_type_id' => $arrInfo['type'],
							'creation_date' => $request->creationDate,
							'title' => $request->title,
							'description' => $request->description,
							'expiration_date' => $request->expirationDate,
							'category_id' => $category->id,
							'subcategory_id' => $subcategory->id,
							'views' => $request->views,
							'process_state_id' => $processState->id,
						);
		$this->db->insert('publication', $data);
		$id = $this->db->insert_id();
		$data = array 	(
							'publication_id' => $id,
							'object_id' => $object->id,
							'quantity' => $request->quantity,
						);
		$this->db->insert('publication_object', $data);		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return $id;
	}

	public function update($options){
		$category = $options->category;
		$subcategory = $options->subcategory;
		$processState = $options->processState;
		$object = $options->object;

		$this->db->trans_start();
		$data = array 	(
							'creation_date' => $options->creationDate,
							'title' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $category->id,
							'subcategory_id' => $subcategory->id,
							'views' => $options->views,
							'process_state_id' => $processState->id,
						);
		$this->db->where('publication_id', $options->id);
		$this->db->update('publication', $data);
		$data = array 	(
							'object_id' => $object->id,
							'quantity' => $options->quantity,
						);
		$this->db->where('publication_id', $options->id);
		$this->db->update('publication_object', $data);		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
	}

	public function delete($publicationId){

		$this->db->trans_start();
		$data = array ('process_state_id' => 'B');
		$this->db->where('publication_id', $publicationId);
		$this->db->update('publication',$data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}
	
	/*

	public function create($options, $userId){
		$category = $options->category;
		$subcategory = $options->subcategory;
		$processState = $options->processState;
		$object = $options->object;

		$this->db->trans_start();
		$data = array 	(
							'user_id' => $userId,
							'publication_type_id' => 2,
							'creation_date' => $options->creationDate,
							'title' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $category->id,
							'subcategory_id' => $subcategory->id,
							'views' => $options->views,
							'process_state_id' => $processState->id,
						);
		$this->db->insert('publication', $data);
		$id = $this->db->insert_id();
		$data = array 	(
							'publication_id' => $id,
							'object_id' => $object->id,
							'quantity' => $options->quantity,
						);
		$this->db->insert('publication_object', $data);		
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return $id;
	}
	
	public function getRequests(){	
		$this->db->select('*');	
		$this->db->from('publication');		
		$this->db->where('publication_type_id', 2);
		$this->db->or_where('publication_type_id', 3);
		$query = $this->db->get();
		ma($this->db->queries);
		return $query->result();
	}

	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->where('publication.publication_id', $id);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->or_where('publication.publication_type_id', 3);
		$query = $this->db->get();
		return $query->result();
	}

	public function getRequestsByUserId($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->where('publication.user_id', $id);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->or_where('publication.publication_type_id', 3);
		$query = $this->db->get();
		return $query->result();
	}	

	public function getMonetaryRequestsByUserId($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->where('publication.user_id', $id);	
		$this->db->where('publication.publication_type_id', 2);
		$query = $this->db->get();
		return $query->result();
	}

	public function getObjectRequestsByUserId($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->where('publication.user_id', $id);	
		$this->db->where('publication.publication_type_id', 3);
		$query = $this->db->get();
		return $query->result();
	}

	public function getFavoritesByUserId($userId){		
		$this->db->select('*');	
		$this->db->from('publication');	
		$this->db->join('publication_request', "publication.publication_id = publication_request.publication_id");
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_favourite', "publication.publication_id = publication_favourite.publication_id");
		$this->db->where('publication_favourite.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->or_where('publication.publication_type_id', 3);	
		$query = $this->db->get();
		return $query->result();
	}
	*/
}