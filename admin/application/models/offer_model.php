<?php

class Offer_model extends CI_Model
{
	public function getOffers(){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->where('publication.publication_type_id', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->join('publication_object', "publication.publication_id = publication_object.publication_id");
		$this->db->where('publication.publication_id', $id);	
		$this->db->where('publication.publication_type_id', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options, $user, $type){
		$this->db->trans_start();
		$data = array 	(
							'user_id' => $user,
							'publication_type_id' => $type,
							'creation_date' => $options->creationDate,
							'title' => $options->title,
							'description' => $options->description,
							'expiration_date' => $options->expirationDate,
							'category_id' => $options->category->id,
							'subcategory_id' => $options->subcategory->id,
							'views' => $options->views,
							'process_state_id' => $options->processState->id,
						);
		$this->db->insert('publication', $data);
		$id = $this->db->insert_id();
		$data = array 	(
							'publication_id' => $id,
							'object_id' => $options->object->id,
							'quantity' => $options->quantity,
						);
		$this->db->insert('publication_object', $data);
		$data = array 	(
							'publication_id' => $id,
							'process_state_offer' => $options->processStateOffer->id,
							'offer_type_id' => $options->type->id,
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
}