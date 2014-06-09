<?php

class Offer_model extends CI_Model
{
	public function getOffers(){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$query = $this->db->get();
		return $query->result();
	}

	public function getById($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->where('publication.publication_id', $id);	
		$query = $this->db->get();
		return $query->result();
	}

	public function getOffersByUserId($id){	
		$this->db->select('*');	
		$this->db->from('publication');
		$this->db->join('publication_offer', "publication.publication_id = publication_offer.publication_id");
		$this->db->where('publication.user_id', $id);	
		$query = $this->db->get();
		return $query->result();
	}	
}