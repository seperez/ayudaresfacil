<?php

class Request_model extends CI_Model
{
	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication.publication_id', $id);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication.process_state_id <>', 'B');
		$query = $this->db->get();
		return $query->result();
	}

	public function getByUser($userId){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication.process_state_id <>', 'B');
		$query = $this->db->get();
		return $query->result();
	}	

	public function getCurrentRequests(){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
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

	public function getFavoritesByUser($userId){
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_favorite', "publication.publication_id = publication_favorite.publication_id");
		$this->db->join('publication_object', "publication_object.publication_id = publication_favorite.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication_favorite.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication.expiration_date >', date('Y/m/d H:i:s'));
		$this->db->where('publication.process_state_id <>', 'B');
		$query = $this->db->get();
		return $query->result();
	}

	public function checkExistingFavorite($data){
		$this->db->select('*');	
		$this->db->from('publication_favorite');
		$this->db->where('publication_id', $data["publication_id"]);	
		$this->db->where('user_id', $data["user_id"]);	
		$query = $this->db->get();

		if (!empty($query->result())){
			return FALSE;
		}else{
			return TRUE;			
		}				
	}

	public function setAsFavorite($data){
		$this->db->trans_start();
		$this->db->insert('publication_favorite', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}

	public function deleteFromFavorites($data){
		$this->db->trans_start();
		$this->db->where('publication_id', $data["publication_id"]);
		$this->db->where('user_id', $data["user_id"]);
		$this->db->delete('publication_favorite');
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}
		
	public function getMonetaryRequestsByUser($userId){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication_object.object_id', 0); 
		$this->db->where('publication.process_state_id <>', 'B');
		$this->db->where('publication.expiration_date >', date('Y/m/d H:i:s'));
		$query = $this->db->get();
		return $query->result();
	}

	public function getObjectRequestsByUser($userId){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication_object.object_id <>', 0); 
		$this->db->where('publication.process_state_id <>', 'B');
		$this->db->where('publication.expiration_date >', date('Y/m/d H:i:s'));
		$query = $this->db->get();
		return $query->result();
	}

	public function getExpiredByUser($userId){
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_object', "publication_object.publication_id = publication.publication_id");
		$this->db->join('publication_image', "publication.publication_id = publication_image.publication_id");
		$this->db->where('publication.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 2);
		$this->db->where('publication.expiration_date <', date('Y/m/d H:i:s'));
		$query = $this->db->get();
		return $query->result();
	}

	public function setVote($data){
		$this->db->trans_start();
		$this->db->insert('publication_vote', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}

	public function getVotes($publicationId){
		$this->db->select('count(*)');	
		$this->db->from('publication_vote');
		$this->db->where('publication_vote.publication_id', $publicationId);
		$query = $this->db->get();
		return $query->result();
	}

	public function setSponsor($data){
		$this->db->trans_start();
		$this->db->insert('publication_sponsor', $data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}
	
	public function getSponsors($publicationId){
		$this->db->select('user_tw');	
		$this->db->from('publication_sponsor');
		$this->db->where('publication_sponsor.publication_id', $publicationId);
		$query = $this->db->get();
		return $query->result();
	}
}