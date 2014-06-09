<?php

class Request_model extends CI_Model
{
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
}