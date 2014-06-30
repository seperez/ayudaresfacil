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

	public function getConversation($firstMessageId){
		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('message_id',$firstMessageId);
		$this->db->where('delete_date',null);
		$query1 = $this->db->get()->result();

		$this->db->select('*');
		$this->db->from('message');
		$this->db->where('first_message_id',$firstMessageId);
		$this->db->where('delete_date',null);
		$this->db->order_by('create_date','asc');
		$query2 = $this->db->get()->result();

		$query = array_merge($query1, $query2);

		return $query;
	}

	public function create($options){
		$this->db->trans_start();
		$data = array 	(
							'user_Id_From' => $options->UserIdFrom,
							'user_Id_To' => $options->UserIdTo,
							'publication_Id' => $options->publicationId,
							'first_Message_Id' => $options->firstMessageId,
							'FAQ' => $options->FAQ,
							'common_State_Id' => $options->commonState->getId(),
							'subject' => $options->subject,
							'text' => $options->text,
							'create_date' => $options->createDate
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
							'user_Id_From' => $options->UserIdFrom,
							'user_Id_To' => $options->UserIdTo,
							'publication_Id' => $options->publicationId,
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
