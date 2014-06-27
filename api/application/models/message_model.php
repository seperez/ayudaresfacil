<?php

class Message_model extends CI_Model
{

	public function getById($id){
		$this->db->select('*');	
		$this->db->from('message');
		$this->db->where('message_id',$id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getByUserIdFrom($userId){
		$this->db->select('*');	
		$this->db->from('message');
		$this->db->where('user_id_from',$userId);
		$this->db->where('delete_date',null);
		$query = $this->db->get();
		return $query->result();
	}

	public function getByUserIdTo($userId){
		$this->db->select('*');	
		$this->db->from('message');
		$this->db->where('user_id_to',$userId);
		$this->db->where('delete_date',null);
		$query = $this->db->get();
		return $query->result();
	}

	public function getByPublicationId($publicationId){
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('publication_Id',$publicationId);
		$this->db->where('delete_date',null);
		$query = $this->db->get();
		return $query->result();
	}

	public function getAll(){
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('delete_date',null);
		$query = $this->db->get();
		return $query->result();
	}

	public function create($options){
		$this->db->trans_start();
		$data = array 	(
							'user_Id_From' => $options->userFrom[0]->getId(),
							'user_Id_To' => $options->userTo[0]->getId(),
							'publication_Id' => $options->publication,
							'first_Message_Id' => $options->firstMessageId,
							'FAQ' => $options->FAQ,
							'common_State_Id' => $options->commonState->getId(),
							'subject' => $options->subject,
							'text' => $options->text,
							'create_Date' => $options->createDate
						);
		$this->db->insert('message', $data);
		$this->db->trans_complete();

		$id = $this->db->insert_id();

		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}

		return $id;
	}

	public function update($options){
		$this->db->trans_start();
		
		$data = array 	(
							'user_Id_From' => $options->userFrom->getId(),
							'user_Id_To' => $options->userTo->getId(),
							'publication_Id' => $options->publication->getId(),
							'first_Message_Id' => $options->firstMessageId,
							'FAQ' => $options->FAQ,
							'common_State_Id' => $options->commonState->getId(),
							'subject' => $options->subject,
							'text' => $options->text,
							'update_Date' => $options->updateDate
						); 

		$this->db->where('message_id', $options->id);
		$this->db->trans_complete();

		if ($this->db->trans_status() === FALSE){
      		$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}

		return $this->db->update('message', $data);
	}

	public function delete($id){
		$this->db->trans_start();
		
		$data = array ('delete_date' => date('Y/m/d H:i:s'));
		$this->db->where('message_id', $id);
		$this->db->update('message',$data);
		$this->db->trans_complete();
		
		if ($this->db->trans_status() === FALSE){
			$id = null;
      		log_message('error', "DB Error: (".$this->db->_error_number().") ".$this->db->_error_message());
		}
		
		return $id;
	}

}
