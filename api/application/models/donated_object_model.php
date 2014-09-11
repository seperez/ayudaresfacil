<?php

class Donated_object_model extends CI_Model
{
	public function getById($id){
		$this->db->select('*');	
		$this->db->from('donated_object');
		$this->db->where('donated_obj_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDonatedObjects(){
		$this->db->select('*');	
		$this->db->from('donated_object');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getByPublicationId($publicationId){
		$this->db->select('*');	
		$this->db->from('donated_object');
		$this->db->where("donation_id IN (SELECT donation_id FROM donation WHERE publication_id = $publicationId)",NULL, FALSE);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function getByDonationId($donationId){
		$this->db->select('*');	
		$this->db->from('donated_object');
		$this->db->where('donation_id',$donationId);
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options){
	$this->db->trans_start();
	$data = array 	(
						'donation_Id' => $options->donationId,
						'object_Id' => $options->objectId,
						'quantity' => $options->quantity
					);
	$this->db->insert('donated_object', $data);
	$id = $this->db->insert_id();
	$this->db->trans_complete();

	if ($this->db->trans_status() === FALSE){
		$id = null;
  		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
	}

	return $id;
	
	}
}