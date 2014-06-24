<?php

class Offer_model extends CI_Model
{
	public function getCurrentOffers(){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.process_state_id <>', 'B');
		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.publication_id', $id);	
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options, $arrInfo){
		$category = $options->category;
		$subcategory = $options->subcategory;
		$processState = $options->processState;
		$object = $options->object;
		$processStateOffer = $options->processStateOffer;
		$type = $options->type;

		$this->db->trans_start();
		$data = array 	(
							'user_id' => $arrInfo['user'],
							'publication_type_id' => $arrInfo['type'],
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
		$data = array 	(
							'publication_id' => $id,
							'process_state_offer' => $processStateOffer->id,
							'offer_type_id' => $type->id,
							'quantity_users_to_paused' => $options->quantityUsersToPaused,
						);
		$this->db->insert('publication_offer', $data);
		
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
		$processStateOffer = $options->processStateOffer;
		$type = $options->type;

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
		$data = array 	(
							'process_state_offer' => $processStateOffer->id,
							'offer_type_id' => $type->id,
							'quantity_users_to_paused' => $options->quantityUsersToPaused,
							);
		$this->db->where('publication_id', $options->id);
		$this->db->update('publication_offer', $data);
		
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

	public function pause($publicationId){
		$this->db->trans_start();
		$data = array ('process_state_offer' => 'P');
		$this->db->where('publication_id', $publicationId);
		$this->db->update('publication_offer',$data);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
			$publicationId = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		return TRUE;
	}

	/*
	public function getOffersByUserId($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->where('publication.user_id', $id);	
		$this->db->where('publication.publication_type_id', 1);
		$query = $this->db->get();
		return $query->result();
	}	

	public function getFavoritesByUserId($userId){		
		$this->db->select('*');	
		$this->db->from('publication');	
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->join('publication_favourite', "publication.publication_id = publication_favourite.publication_id");
		$this->db->where('publication_favourite.user_id', $userId);	
		$this->db->where('publication.publication_type_id', 1);	
		$query = $this->db->get();
		return $query->result();
	}
	*/
}