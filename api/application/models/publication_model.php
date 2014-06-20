<?php

class Publication_model extends CI_Model
{
	public function create($options){
		$this->db->trans_start();
		$data = array 	(
							'user_id' => $options->user->getId(),
							'publication_type_id' => $options->type->getId(),
							'creation_date' => $options->creationDate,
							'title' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $options->category->getId(),
							'subcategory_id' => $options->subcategory->getId(),
							'views' => $options->views,
							'process_state_id' => $options->processState->getId(),
						);
		$this->db->insert('publication', $data);
		$id = $this->db->insert_id();
		$data = array 	(
							'publication_id' => $id,
							'object_id' => $options->object->getId(),
							'quantity' => $options->quantity,
						);
		$this->db->insert('publication_object', $data);
		if ($options->type->getId() == 1) {
			$data = array 	(
								'publication_id' => $id,
								'process_state_offer' => $options->processStateIdOffer,
								'offer_type_id' => $options->offerTypeId,
								'quantity_users_to_paused' => $options->quantityUsersToPaused,
							);
			$this->db->insert('publication_offer', $data);
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return $id;
	}

	public function update($options){
		$this->db->trans_start();
		$data = array 	(
							'user_id' => $options->userId,
							'publication_type_id' => $options->publicationTypeId,
							'creation_date' => $options->creationDate,
							'title' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $options->categoryId,
							'subcategory_id' => $options->subcategoryId,
							'views' => $options->views,
							'process_state_id' => $options->processStateId,
						);
		$this->db->where('publication_id', $options->publicationId);
		$this->db->update('publication', $data);
		$data = array 	(
							'object_id' => $options->objectId,
							'quantity' => $options->quantity,
						);
		$this->db->where('publication_id', $options->publicationId);
		$this->db->update('publication_object', $data);
		if ($options->publicationTypeId == 1) {
			$data = array 	(
								'process_state_offer' => $options->processStateIdOffer,
								'offer_type_id' => $options->offerTypeId,
								'quantity_users_to_paused' => $options->quantityUsersToPaused,
							);
			$this->db->where('publication_id', $options->publicationId);
			$this->db->update('publication_offer', $data);
		}
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
	}

	public function delete($publicationId){

		$this->db->trans_start();
		$data = array ('process_state_id' => 'C');
		$this->db->where('publication_id', $publicationId);
		$this->db->update('publication',$data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}

		return $publicationId;
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

	public function setAsFavorite($options){
		$data = array 	(
							'publication_id' => $options['publicationId'],
							'user_id' => $options['userId']
						);
		$this->db->insert('publication_favorite', $data);
		$id = $this->db->insert_id();

		return $id;
	}

	public function deleteFromFavorites($options){
		$data = array 	(
							'publication_id' => $options['publicationId'],
							'user_id' => $options['userId']
						);
		return $this->db->delete('publication_favorite', $data);
	}

	// TODO: PASAR A OFFER_MODEL

	// public function getOffersFavourites($userId){		
	// 	$this->db->select('*');	
	// 	$this->db->from('publication');	
	// 	$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
	// 	$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
	// 	$this->db->join('publication_favourite', "publication.publication_id = publication_favourite.publication_id");
	// 	$this->db->where('publication_favourite.user_id', $userId);	
	// 	$this->db->where('publication.publication_type_id', 1);	
	// 	$this->db->where('publication.process_state_id', 'V');	
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function pauseOffer($publicationId){

	// 	$this->db->trans_start();
	// 	$data = array ('process_state_offer' => 'P');
	// 	$this->db->where('publication_id', $publicationId);
	// 	$this->db->update('publication_offer',$data);
	// 	$this->db->trans_complete();

	// 	if ($this->db->trans_status() === FALSE){
	// 		$publicationId = null;
 	//    	log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
	// 	}

	// 	return $publicationId;
	// }
	
	// TODO: PASAR A REQUEST_MODEL
	// public function getRequests($userId){
	// 	$this->db->select('*');	
	// 	$this->db->from('publication');	
	// 	$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
	// 	if ($userId > 0) {
	// 		$this->db->where('user_id', $userId);	
	// 	}
	// 	$this->db->where('publication_type_id', 2);	
	// 	$this->db->where('process_state_id', 'V');			
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	// public function getRequestsFavourites($userId){		
	// 	$this->db->select('*');	
	// 	$this->db->from('publication');	
	// 	$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
	// 	$this->db->join('publication_favourite', "publication.publication_id = publication_favourite.publication_id");
	// 	$this->db->where('publication_favourite.user_id', $userId);	
	// 	$this->db->where('publication.publication_type_id', 2);	
	// 	$this->db->where('publication.process_state_id', 'V');	
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }
}